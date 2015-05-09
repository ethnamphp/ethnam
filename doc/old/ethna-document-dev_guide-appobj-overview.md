# アプリケーションオブジェクトについて
  - (1) DB設定 
  - (2) AppObject 
  - (2-1) AppObject を自力で書く 
  - (3) 使い方 
  - (4) トランザクションをかける場合の注意 

## アプリケーションオブジェクトについて

[http://ml.ethna.jp/pipermail/users/2005-March/000006.html](http://ml.ethna.jp/pipermail/users/2005-March/000006.html) より。

- 更新履歴
  - トランザクションをかける場合の注意点を記載(2006/11/22, key)
  - Ethna-2.3.0に対応した内容に修正 (2006/11/20, いちい)

### (1) DB設定

[http://ethna.jp/ethna-document-dev\_guide-db.html](ethna-document-dev_guide-db.md)みたいな感じでDSNを設定します

### (2) AppObject

ethnaコマンドを使って簡単に作れます。あらかじめ'user'というテーブルをデータ ベースに作っておけば、

    % ethna add-app-object user

とすると、app/Sample\_User.phpが作られ、いっしょにapp managerも作られます。中身はほとんどありませんが、(2-1)でやるのとほぼ同様です。

### (2-1) AppObject を自力で書く

こんな感じで、Ethna\_AppObjectを継承したクラスを書きます。

    class Sample_User extends Ethna_AppObject
    {
       /**#@+
        * @access private
        */
       /**
        * @var array テーブル定義
        */
       var $table_def = array(
           'user_tbl' => array(
               'primary' => true,
           ),
       );
    
       /**
        * @var array プロパティ定義
        */
       var $prop_def = array(
           // user_tbl
           'user_id' => array(
               'primary' => true, 'key' => true, 'seq' => true,
               'type' => VAR_TYPE_INT, 'form_name' => 'user_id',
           ),
           'name' => array(
               'primary' => false, 'key' => false, 'type' => VAR_TYPE_STRING,
               'form_name' => 'user_name',
           ),
       );
       /**#@-*/
    }

$table\_defメンバにはそのAppObjectと対応するDB上のテーブル名を指定しま す。  
現在はJOINにはほとんど対応していないので、記述可能なテーブルは常に 1つで、'primary'も常にtrueです。

$prop\_defメンバには、フィールド定義を記述します。  
今のところ、スキーマの自動取得は対応していません（有った方がいいですかねー？)。 Ethna-2.3.0では自動取得されるようになりました。

    'フィールド名' => array(プロパティ...)

という形での記述になります。プロパティは:

| primary | そのフィールドがプライマリキーならtrueとします |
| key | そのフィールドがプライマリキー、あるいはuniqueならtrueとします |
| seq | そのフィールドが(MySQL的に言うと)AUTO\_INCREMENTである場合はtrueとします |
| type | 今のところ基本的に使っていませんので、VAR\_TYPE\_INTかVAR\_TYPE\_STRINGを適当に指定してください |
| form\_name | そのフィールドに対応する値がウェブから送信される場合のフォーム名を指定します |

という感じです。form\_nameはイマイチ意味が分かりにくいですが、  
例えば管理画面等のアクションを書いているとして、

    $user =& $this->backend->getObject('User');
    $user->importForm();

とすると、form\_nameに指定されたフォーム名に対応するフォーム値を自動的 にプロパティにセットしてくれます。  
僕が手抜きしたいがために作ったメソッドで、要するに

    $user->set('name', $this->af->get('user_name'));
    $user->set('pref', $this->af->get('user_pref'));
    ...

とか延々と書くのも頭悪いよね、ということで...。

### (3) 使い方

話が前後しましたが、簡単な使い方は以下のようになります。オブジェクトは直接newしてしまっても構いませんが、Ethna\_BackendクラスのgetObject()メソッドを利用すれば、オブジェクトのソースファイルを自動的にincludeしてくれます。

[通常の場合]

    $user =& $this->backend->getObject('User', 'user_id', $user_id);

として、第2引数にオブジェクトを特定するためのフィールド名、第3引数にその値を指定します。

で、

    $user->get('name');

とするとプロパティを取得できます。

    $user->set('name', 'foo');

で、プロパティの更新です（当然）。

でもって、

    $user->update();

とするとDBを更新できます。

    $user->remove();

とすると削除です。

[追加する場合]  
新しくDBにエントリを追加する場合は以下のようになります。

    // 引数を省略してnew
    $user =& $this->backend->getObject('User');
    
    $user->set('user_name', 'foo');
    $r = $user->add();
    if (Ethna::isError($r)) {
        //...
    }
    $id = $user->getId();

プライマリキーのseqフィールドがtrueならプライマリキーのプロパティは設 定しなくてOKです。

[その他]

    $user->getName('user_name');

というメソッドもあります。これはプロパティ値と、表示用の値が違う場合 (「県」等）に、オーバーライドしてその表示用の値を返す形で利用します。 つまり

    $user->get('user_pref');

では4とかが返ってきて

    $user->getName('user_pref');

では「岩手県」が返ってくる、みたいな感じです。

さらには

    $user->getNameObject();

というのもあります。これは、全てのプロパティのgetName()の結果を配列に して返します。

### (4) トランザクションをかける場合の注意

AppObjectとEthna\_PEAR\_DBを同時に利用してトランザクションをかける場合、問題があるようなので逃げ方をここに記します。

    $db = $this->backend->getDB();
    $db->begin();
    $db->query("INSERT〜");
    
    $user =& new AppId_UserMst($this->backend);
    $user->set('username', 'key');
    $user->add();
    
    $db->commit();

などとしたい場合、begin()が走っているのでトランザクションが効くと思われるのですが、実際にやるとAutoCommitのまま処理が進んでしまいます。これでは困るので、

    $db = $this->backend->getDB();
    $db->db->autocommit(false); <--- これを追加
    $db->begin();
    $db->query("INSERT〜");
    
    $user =& new AppId_UserMst($this->backend);
    $user->set('username', 'key');
    $user->add();
    
    $db->commit();

のようにして、$db->db->autocommit(false)を挟むことでトランザクション処理をすることが出来ます。たいへん気持ち悪いですが…。

