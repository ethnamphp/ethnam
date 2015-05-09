# Ethnaアプリケーションの設定ファイル
Ethna では、PHPファイルやテンプレートファイルを ethnaコマンドで生成し、生成したものを主に弄っていきます。しかし、アプリケーション全体に共通する設定というのも存在しており、それらは別に記述する必要があります。ここでは、そうしたアプリケーション全体の設定について説明します。

- Ethnaアプリケーションの設定ファイル 
  - 設定ファイルの置き場所 
  - 設定値を制御する 
    - 設定値を記述する 
    - 設定値を取得する 
  - 個別の設定値の詳細 
    - デバッグ設定 
    - データベース接続設定 
    - ログ出力の設定 
    - memcached 
    - 国際化設定 
    - CSRF対策 
  - 設定値をiniファイルで管理する 
  - 設定値をyamlで管理する 

| 書いた人 | ---- | ---------- | 新規作成 |
| 書いた人 | mumumu | 2009-06-15 | 最新版に追随する形で全面的に修正 |

### 設定ファイルの置き場所

以下のようにアプリケーションIDを「sample」としてプロジェクトを作成すると、sample/etc/sample-ini,php に設定ファイルが作成されます。

    $ ethna add-project sample 
    $ cd sample/etc
    $ ls
    sample-ini.php

つまり、etc/[アプリケーションID]-ini.php が設定ファイルの置き場所ということになります。

### 設定値を制御する

#### 設定値を記述する

Ethnaの設定ファイルは素のPHPを使って記述します。上で説明した etc/[アプリケーションID]-ini.php に、$config というグローバル変数を書き、そこに配列の形で定義を行います。

    $config = array(
        'debug' => false,
        'dsn' => 'mysql://user:pass@unix+localhost/dbname',
    );

ここに設定した値は、変更すると次のリクエストからすぐに反映されます。この変数に一ヶ所に纏めることで、環境が変わった場合の対応も容易になります。

#### 設定値を取得する

Ethnaには設定値の制御を行うクラスとして Ethna\_Config があります。このクラスを利用すれば、上記で設定したファイルの設定値が容易に取得できます。

ユーザーが主に触ることになるアクションクラスやビュークラス、アプリケーションマネージャークラスには、$config というメンバで Ethna\_Config クラスのインスタンスが定義されています。よって、getメソッドを使って設定値を取得することができます。

以下はアクションクラスで設定値を取得する例です。 [Ethna\_ConfigクラスのAPIドキュメント](doc/Ethna/Ethna_Config.html)も参照してください。

    class Sample_Action_Index extends Ethna_ActionClass
    {
        function prepare()
        {
            return null;
        }
    
        function perform()
        {
            // dsn という設定値を取得
            $dsn = $this->config->get('dsn');
            
            //.... 残りの処理
        }
    }

### 個別の設定値の詳細

ここでは、Ethna で設定できる設定値のすべてを詳細に示します。

#### デバッグ設定

    $config = array(
        'debug' => false, // デフォルトはfalse
    );

デバッグ設定は開発時に使用するもので、true または false で指定します。 この値をtrueにした場合、以下の機能が実行できるようになります。

1. www/info.php によるアプリケーション情報の一覧
2. www/unittest.php による単体テスト実行

[ユニットテストを実行する](ethna-document-dev_guide-misc-unittest.html "ethna-document-dev\_guide-misc-unittest (1240d)") と [設定情報や定義済みアクション等を一覧する](ethna-document-dev_guide-misc-info.md "ethna-document-dev\_guide-misc-info (1240d)") も参照してください。

**本番環境でこの値を絶対trueに設定しないで下さい！ 上記の機能はユーザーに見せるものではないからです！**

#### データベース接続設定

    $config = array(
       // sample-1: single db
       'dsn' => 'mysql://user:password@server/database',
       // sample-2: single db w/ multiple users
       'dsn' => 'mysql://rw_user:password@server/database', // read-write
       'dsn_r1' => 'mysql://ro_user:password@server/database', // read-only
       // sample-3: multiple db (slaves)
       'dsn' => 'mysql://rw_user:password@master/database', // read-write(master)
       'dsn_r2' => array(
            'mysql://ro_user:password@slave1/database', // read-only(slave)
            'mysql://ro_user:password@slave2/database', // read-only(slave)
        ),
    );

上記のようにdsnというkeyにDSNを記述することでBackendからgetDBによってDBオブジェクトが呼び出されてコネクトするときのDSNを指定することができます。

データベースオブジェクトを、アクションクラスやアプリケーションマネージャーでは以下の形で取得することが出来ます。

    $this->backend->getDB('r'); // dsn_r の設定を返す

ひとつのdsnに複数の接続先が配列で指定された場合は、ランダムに接続先が返ってきます。

    $this->backend->getDB('r2'); // dsn_r2 の接続を返す。

[データベースアクセス](ethna-document-dev_guide-db.md)のページも参照してください。

#### ログ出力の設定

ログ出力の設定の詳細については、 [Ethnaでログ出力を制御する](ethna-document-dev_guide-log.md "ethna-document-dev\_guide-log (874d)") のページを参照してください。

#### memcached

memcached も、データベース接続設定と同様に多様な設定が可能です。memcached がひとつの場合の設定を以下に示します。

    $config = array(
       // sample-1: single (or default) memcache
       'memcache_host' => 'localhost', // memcached を置いているホスト
       'memcache_port' => 11211, // ポート番号
       'memcache_use_pconnect' => false, // 永続的な接続をサポートするか
       'memcache_retry' => 3, // 接続に失敗した場合のリトライ回数
       'memcache_timeout' => 3, // 接続タイムアウト値
     );

以下のように名前空間を指定して複数台のmemcached を指定することも可能です。

    $config = array(
       // sample-2: multiple memcache servers (distributing w/ namespace and ids)
       'memcache' => array(
            'namespace1' => array(
                0 => array(
                    'memcache_host' => 'cache1.example.com',
                    'memcache_port' => 11211,
                ),
                1 => array(
                    'memcache_host' => 'cache2.example.com',
                    'memcache_port' => 11211,
                ),
            ),
        ),
     );

#### 国際化設定

    この機能を利用するには、Ethna 2.5.0 preview2 以降が必要です。

    $config = array(
        'use_gettext' => false,
    );

Ethnaプロジェクトを国際化する手段として、iniファイルを利用する方法と、gettext を利用する方法の２種類が用意されています。デフォルトは iniファイルを利用する方法です。詳細は [プロジェクトの国際化(2.5.0 preview2以降)](ethna-document-dev_guide-i18n.md "ethna-document-dev\_guide-i18n (737d)") を参照してください。

gettext を利用する場合に、この値を true にします。

#### CSRF対策

    $config = array(
        'csrf' => 'Session',
    );

CSRF とは、ログイン済みのユーザーに細工したURLを踏ませることで、ログイン済みユーザの権限を利用して意図しない操作を実行させるものです。詳細は [クロスサイトリクエストフォージェリの対策コードについて](ethna-document-dev_guide-csrf.md "ethna-document-dev\_guide-csrf (1240d)") を参照してください。

デフォルト値は、上記のように 'Session' となっており、正当な値をセッションに格納するようになっています。現状はこの値を変更できません。

### 設定値をiniファイルで管理する

etc/[appid]-ini.phpの中では変数の定義だけでなくロジックの記述もできるので

config.ini

    debug = false
    dsn = mysql://user:password@localhost/db

を用意しておいて

etc/[app-id]-ini.php内で

    $config = parse_ini_file('config.ini', true);

としておけば設定値をiniファイルに記述することができます。\*1

### 設定値をyamlで管理する

iniファイルとほとんど同じ手法でできます。 bogoYAMLのスタイルでよければharukiさんが作ったbogoYAMLを利用して YAMLで記述したデータを配列として取得するだけです。詳しくは、以下を参照して下さい。

[http://hatotech.org/kumatch/archives/000492.html](http://hatotech.org/kumatch/archives/000492.html)


* * *
\*1この例では、 [parse\_ini\_file 関数](http://jp.php.net/manual/ja/function.parse-ini-file.php)への第二引数を true にして、セクション定義を解釈させるようになっていますが、dsn のようなEthnaの動作の根本に関わる一部の設定値については、 [セクション定義されていないことを前提に値を取得する実装](doc/ __filesource/fsource_Ethna__ classEthna_Controller.php.html#a1878)が Ethna でなされているため、セクション定義しない方が無難かもしれません  

