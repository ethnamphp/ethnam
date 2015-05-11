# ADODBをEthnaで使う
  - はじめに 
  - ADODB を Ethna のプロジェクトにインストール 
  - コントローラークラスの書き換え 
  - dsn の設定 
  - 実際に使ってみる 

| 書いた人 | 日付 | 備考 |
| mumumu | 2007-02-14 | 初版 |

## ADODBをEthnaで使う

### はじめに

[ADODB](http://adodb.sourceforge.net/) は、デフォルトで Ethna で利用できる [PEAR::DB](http://pear.php.net/manual/ja/package.database.db.php) に比してスピードが速いと言われており\*1、使いやすいAPI が実装されている PHP 4/5 に対応したデータベースアクセスライブラリです。ここでは、そのADODBをEthnaで使う方法を説明します。

このドキュメントは、以下の作業が完了していることを前提にして書かれています。仮に以下の作業が完了していなければ、下のリンクを参考に作業を行っておいてください。

- [Ethna のインストール](tutorial-install_guide.md "ethna-document-tutorial-install\_guide (16d)")
- [Ethna のプロジェクトを生成する](tutorial-practice1.md#ud75ed71)

以下では、プロジェクトの アプリケーションID が「sample」、アプリケーション配置ディレクトリを /tmp として説明を行います。  
あなたのプロジェクトに合わせて適宜読み替えるようにして下さい。

### ADODB を Ethna のプロジェクトにインストール

まずは ADODB を sourceforge.net から [ダウンロード](http://adodb.sourceforge.net/#download)します。  
PHP 4/5 対応版\*2 の出来るだけ最新のものを取得すると良いでしょう。

ダウンロードしたら、任意の場所に展開します。ここでは、執筆時点での最新版 4.94 を使います。

    unzip adodb494.zip
    tar xvfz adodb494.tgz

すると、adodb というディレクトリができると思いますので、それを プロジェクトの lib ディレクトリ以下に移動します。

    mv adodb /tmp/sample/lib/

これで ADODB を Ethna のプロジェクトにインストールできました。\*3

### コントローラークラスの書き換え

インストール作業が終わったら、app/Sample\_Controller.php の以下の部分を書き換えます。

    /**
        * @var array クラス定義
        */
       var $class = array(
           /*
            * TODO: 設定クラス、ログクラス、SQLクラスをオーバーライド
            * した場合は下記のクラス名を忘れずに変更してください
            */
           'class' => 'Ethna_ClassFactory',
           'backend' => 'Ethna_Backend',
           'config' => 'Ethna_Config',
    - 'db' => 'Ethna_DB_PEAR',
    + 'db' => 'Ethna_DB_ADOdb',

### dsn の設定

Ethna の通常のDBアクセスと同じく、etc/sample-ini.php の dsn を設定しておいて下さい。

    $config = array(
       'debug' => false,
       'dsn' => 'mysql://user:pass@unix+localhost/dbname',
    );

これで Ethna で ADODB を使う準備は整いました。

### 実際に使ってみる

あとは、通常のデータベースアクセスと使い方は同じです。但し、ADODB を使用しているので、アクセスのAPI は Ethna\_DB\_ADOdb クラスのそれに従います。\*4 [クラスリファレンス](doc/Ethna/Ethna_DB_ADOdb.html)を参考にして、利用してみて下さい。

    $db = $this->backend->getDB();
    $rs = $db->query('SELECT * FROM test');
    var_dump($rs);


* * *
\*1PEAR::DB より [速いといわれる根拠の一例](http://phplens.com/lens/adodb/)。ベンチマークの結果はともかく、データベースへのアクセス速度を決定付ける最も重要な要素はDBスキーマやインデックス等の DB設計にあると思います。  
\*2sourceforge では adodb-バージョン番号-for-php4-and-5 のような名前が付いています。また、本ドキュメント執筆時点で、PHP5 専用のバージョンはまだベータ版です。  
\*3adodb の配布物には、多様な用途に合わせて多数のファイルが含まれています。 [Minimum Install](http://phplens.com/lens/adodb/docs-adodb.htm#mininstall)のページを参考にして、あなたの用途に照らして不要なものは削除しておくと良いでしょう。  
\*4Ethna では実際に使用しているDBアクセスライブラリは、総じて見事に隠蔽されています。  

