# データベースアクセス
  - 一番簡単なやり方(PEAR::DBを使う) 
  - PEAR::DB 以外のDBアクセスライブラリを使う 
  - 複数のDBオブジェクトを扱う場合 
  - リードオンリーのDBを複数台設定したい場合 
  - AppManager内でのDBオブジェクトの使用方法 

## データベースアクセス [](ethna-document-dev_guide-db.html#l9112123 "l9112123")

この部分、Randolph@IRCが、fujimotoさんに頂いたメールを元にして書いてます。

### 一番簡単なやり方(PEAR::DBを使う) [](ethna-document-dev_guide-db.html#x4d22c42 "x4d22c42")

1. etc/[appid]-ini.phpにdsn定義を行う。

    $config = array(
        'debug' => false,
        'dsn' => 'mysql://user:pass@unix+localhost/dbname',
    );

2. Ethna\_Backend::getDBメソッドを利用してDBオブジェクトを取り出す。

    function perform()
    {
        $db =& $this->backend->getDB();
        // ...
        return 'index';
    }

Ethnaの デフォルトの DB接続クラス( [Ethna\_DB\_PEAR](doc/Ethna/Ethna_DB_PEAR.html)) はPEAR::DBを継承しているので、

    $sql = "SELECT id FROM test";
    $result =& $db->query($sql);
    $i = 0;
    while ($data[$i] = $result->fetchRow()) {
    	$i++;
    }

こんな感じでQueryを実行して、データ取得。

### PEAR::DB 以外のDBアクセスライブラリを使う [](ethna-document-dev_guide-db.html#ef9e8b38 "ef9e8b38")

Ethna では、デフォルトの PEAR::DB の他に、 [ADODB](http://adodb.sourceforge.net/) 及び [Creole](http://creole.phpdb.org/trac/) の クラスが同梱されています。

それぞれのライブラリをインストールしてあれば、あとはちょっとした変更を加えるだけで、上記の PEAR::DB とほぼ同じように利用することができます。

ADODB についての詳細は、下記をご覧下さい。

_see also:_ [ADODB を Ethna で使う](ethna-document-dev_guide-adodb.html "ethna-document-dev\_guide-adodb (1240d)")

### 複数のDBオブジェクトを扱う場合 [](ethna-document-dev_guide-db.html#zc5316fe "zc5316fe")

1. iniファイルに「dsn\_（接続名）」でエントリを追加

    'dsn_r' => 'mysql://user:pass@unix+localhost/dbname',

2. [appid]\_Controller.phpに

    /**
     * @var array DBアクセス定義
     */
    var $db = array(
        '' => DB_TYPE_RW,
    );

って部分があるので、ここに使いたいDBオブジェクト名を追加。

    /**
     * @var array DBアクセス定義
     */
    var $db = array(
        '' => DB_TYPE_RW,
        'r' => DB_TYPE_RO, // READ ONLY
    );

3. DBオブジェクト作成時に接続名を指定する。

    // 今までどおりのDB接続
    $db =& $this->backend->getDB();
    // SELECT専用のDB接続
    $db_r =& $this->backend->getDB('r'); // 引数が「r」になっている。

### リードオンリーのDBを複数台設定したい場合 [](ethna-document-dev_guide-db.html#a6241772 "a6241772")

    'dsn_r' => array(
                   'mysql://user:pass@unix+localhost/dbname1',
                   'mysql://user:pass@unix+localhost/dbname2',
                );

上記のように、array形式で指定します。

    $db_r =& $this->backend->getDB('r'); // 引数が「r」になっている。

ランダムで、dbname1とdbname2を割り振ってくれます。

### AppManager内でのDBオブジェクトの使用方法 [](ethna-document-dev_guide-db.html#a6241772 "a6241772")

Ethna\_AppManagerのコンストラクタにより、既にDBオブジェクトは 取得されていますので、下記の様に操作する事が可能です。

    $this->db->query("SELECT id FROM test");
    // 上記「複数のDBオブジェクトを扱う場合」の(1)を行った場合の例
    $this->db_r->query("SELECT id FROM test");

なお、上記方法で取得できるクラスはEthna\_DB\_PEARクラスです。 prepared statementなど、PEAR\_DBの機能をフルに使うには、Ethna\_DB\_PEARクラスのメンバに直接アクセスする必要があります。

    $sql = "SELECT id FROM test WHERE id = ?";
    $data = array($id);
    $stmt =& $this->db->db->prepare($sql);
    $res =& $this->db->db->execute($stmt, $data);

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
