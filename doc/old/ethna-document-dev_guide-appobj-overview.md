# アプリケーションオブジェクトについて
  - (1) DB設定 
  - (2) AppObject 
  - (2-1) AppObject を自力で書く 
  - (3) 使い方 
  - (4) トランザクションをかける場合の注意 

## アプリケーションオブジェクトについて [](ethna-document-dev_guide-appobj-overview.html#ybe71f82 "ybe71f82")

[http://ml.ethna.jp/pipermail/users/2005-March/000006.html](http://ml.ethna.jp/pipermail/users/2005-March/000006.html) より。

- 更新履歴
  - トランザクションをかける場合の注意点を記載(2006/11/22, key)
  - Ethna-2.3.0に対応した内容に修正 (2006/11/20, いちい)

### (1) DB設定 [](ethna-document-dev_guide-appobj-overview.html#ja11592b "ja11592b")

[http://ethna.jp/ethna-document-dev\_guide-db.html](ethna-document-dev_guide-db.html)みたいな感じでDSNを設定します

### (2) AppObject [](ethna-document-dev_guide-appobj-overview.html#df755ca4 "df755ca4")

ethnaコマンドを使って簡単に作れます。あらかじめ'user'というテーブルをデータ ベースに作っておけば、

    % ethna add-app-object user

とすると、app/Sample\_User.phpが作られ、いっしょにapp managerも作られます。中身はほとんどありませんが、(2-1)でやるのとほぼ同様です。

### (2-1) AppObject を自力で書く [](ethna-document-dev_guide-appobj-overview.html#df755ca4 "df755ca4")

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

### (3) 使い方 [](ethna-document-dev_guide-appobj-overview.html#medde72c "medde72c")

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

### (4) トランザクションをかける場合の注意 [](ethna-document-dev_guide-appobj-overview.html#qd868894 "qd868894")

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

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
<!-- ??BEGIN id:trackback -->
<!-- ?? END id:trackback --><!-- ?? END id:attach -->
<!-- ?? END id:summary -->
<!-- ??END id:content -->
<!-- ?? END id:wrap_content --><!-- ??sidebar?? ========================================================== -->
<!-- ??BEGIN id:wrap_sidebar -->

<!-- ??BEGIN id:search_form -->

## 検索

<form action="http://ethna.jp/index.php?cmd=search" method="post">
            <input type="hidden" name="encode_hint" value="??">
            <input type="text" name="word" value="" size="20">
            <input type="submit" value="検索"><br>
            <input type="radio" name="type" value="AND" checked id="and_search"><label for="and_search">AND検索</label>
            <input type="radio" name="type" value="OR" id="or_search"><label for="or_search">OR検索</label>
    </form>

<!-- END id:search_form -->
<!-- ??BEGIN id:download_link -->

## ダウンロード

[![](image/minilogo.gif)Ethna-2.6.0(beta2)](ethna-download.html)

[![](image/minilogo.gif)Ethna-2.5.0(stable)](ethna-download.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:download_link -->

## Quick Links

- [フォーラム(質問/要望等)](ethna-community-forum.html)
- [メーリングリスト](http://ml.ethna.jp/mailman/listinfo/users)

- [チュートリアル](ethna-document-tutorial.html)
- [開発マニュアル](ethna-document-dev_guide.html)
- [変更点一覧](ethna-document-changes.html)

- [TODO(ロードマップ)](TODO.html)
- [ロゴ](ethna-logo.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:search_form -->

## Powered by GREE

 [![GREE Labs](http://labs.gree.jp/image/greelabs_logo.gif)](http://labs.gree.jp/)

<!-- END id:search_form -->
 [![SourceForge.jp](http://sourceforge.jp/sflogo.php?group_id=1343)](http://sourceforge.jp/)

<!-- ??END id:sidebar -->
<!-- ??END id:wrap_sidebar -->
<!-- ??END id:main --><!-- ?? Footer ?? ========================================================== -->
<!-- ??BEGIN id:footer -->
<!-- ??BEGIN id:copyright --> **PukiWiki 1.4.6** Copyright © 2001-2005 [PukiWiki Developers Team](http://pukiwiki.sourceforge.jp/). License is [GPL](http://www.gnu.org/licenses/gpl.html).  
 Based on "PukiWiki" 1.3 by [yu-ji](http://factage.com/yu-ji/).
<!-- ??END id:copyright -->
<!-- ??END id:footer --><!-- ?? END ?? ============================================================= -->
<!-- ??END id:wrapper -->
