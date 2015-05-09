# Ethna でのログ出力を制御する
Ethna では、実行時に様々なログを出力することができます。これは開発時、リリース後の双方に必要な出力を考慮して設計されており、ログレベルを変えることで様々なニーズに応えることができます。

ここでは、Ethna でサポートしているログ出力について説明します。

- Ethna でのログ出力を制御する 
  - ログ出力の設定方法 
  - ログレベルについて 
  - ログの出力方式と出力オプション 
    - echo 
    - file 
    - syslog 
    - Alertmail 
    - default 
  - ログ出力のフィルタ 
  - プログラムでログ出力を制御する方法 
    - Ethna\_Logger へ直接指示する 
    - Ethna::raiseError() が実行されたとき 
    - trigger\_error() や fatal errorなどが発生したとき 
  - ログ出力設定のサンプル 
    - ログをファイルに出力する 
    - ログレベルに応じてアラートメールを送信させる 
    - アプリ開発中の詳細なログ 
    - 公開する本番環境のログ 

| 書いた人 | ------ | ---------- | 新規作成 |
| 書いた人 | mumumu | 2009-05-24 | 最新版に追随する形で全面的に修正 |

### ログ出力の設定方法 [](ethna-document-dev_guide-log.html#qfc3e2d8 "qfc3e2d8")

アプリケーションの etc/[アプリケーションID]-ini.php の $config グローバル変数に 'log' というキーで設定を記述します。その中にログ出力方式をキーとして設定を記述していきます。

共通のログ設定については log\_option, log\_filter\_do, log\_filter\_ignoreにて設定可能です。

    $config = array( 
    
         'log' => array(
             // 各ログ出力方式に応じた設定
             'echo' => array( // ログ出力法式(ここではecho)
                 'level' => 'notice', // ログレベル
                 'option' => 'pid,function,pos', // ログ出力オプション
             ),
             //
             // ログ出力方式は複数設定可能
             //
         ),
    
         // グローバルな設定は以下のように設定可能
         'log_option' => 'pid,function,pos', // ログ出力オプション
         'log_filter_do' => '', // マッチしたログを出力
         'log_filter_ignore' => 'Undefined index.*%%.*tpl', // 無視するパターン
     );

### ログレベルについて [](ethna-document-dev_guide-log.html#md5faa05 "md5faa05")

ログレベルは、出力する情報の重要度をあらわすものです。Ethnaでは、 「LOG\_」 というプレフィックスがついたPHPの定数が定義されています。

また、PHPスクリプトのパースエラー等のPHP組み込みのエラーについては、それらのエラーレベルに対応するログレベルが定義されています。利用できるログレベルは、緊急度の順に以下の通りです。

Ethna では、設定されたログレベルより高いレベルのログを出力するようになっているので注意して下さい。たとえば、alert に設定した場合は alert と emerg は出力されますが、notice レベルのログは出力されません。

| ログレベル | 設定ファイルへの記述 | 説明 | 対応するPHPの組み込みエラーレベル |
| LOG\_EMERG | emerg | システムが使用不可となるような状態 | ----- |
| LOG\_ALERT | alert | 対応が直ちに必要な緊急の状態 | ----- |
| LOG\_CRIT | crit | システムに対して致命的な影響があるもの | E\_PARSE |
| LOG\_ERR | err | エラーが発生する条件 | E\_ERROR, E\_USER\_ERROR |
| LOG\_WARNING | warning | 警告が発生する条件 | E\_WARNING, E\_USER\_WARNING |
| LOG\_NOTICE | notice | 通常の動作だが、特徴的な条件 | E\_NOTICE, E\_USER\_NOTICE, E\_STRICT |
| LOG\_INFO | info | 情報を与えたい場合 | ----- |
| LOG\_DEBUG | debug | デバッグ時の情報を与えたい場合 | 上記以外の全て |

ログレベルの決定方針は明確ではありませんが、LOG\_NOTICE までは、アプリケーションとして正常な動作でも発生することがあります(フォーム値の検証でエラーが発生した場合など)。また、LOG\_DEBUGレベルでは、Ethna内部で実行される情報がかなり詳細に出力されます(ethnaコマンドなど)。

### ログの出力方式と出力オプション [](ethna-document-dev_guide-log.html#l0627d02 "l0627d02")

Ethna\_LoggerはLogwriterプラグインを使ってログの出力をします。Logwriterプラグインには以下の5通りが用意されています。それぞれのオプションについてはログの設定方法の項を参照してください。

#### echo [](ethna-document-dev_guide-log.html#c33327bf "c33327bf")

アプリケーションの実行画面(ブラウザ等)にそのまま表示します。具体的には、ログ出力が指示された段階でPHPの echo関数 を実行します。設定は以下のようにします。

    'log' => array(
        'echo' => array(
            // ログレベルを設定。
            // 「ログレベルについて」の項を参照
            'level' => 'notice',
            // pid, function, pos を カンマ区切りで指定
            // pid : pid を記録
            // function : 関数名を記録
            // pos : ログを出力したファイル名と行を記録する
            'option' => 'pid,function,pos',
        ),

#### file [](ethna-document-dev_guide-log.html#mdd742a1 "mdd742a1")

アプリケーションのログディレクトリにログファイル (標準ではlog/appid.log)を作って出力します。設定は以下のようにします。

    'log' => array(
        'file' => array(
            // ログレベルを設定。
            // 「ログレベルについて」の項を参照
            'level' => 'notice',
            // pid, function, pos を カンマ区切りで指定
            // pid : pid を記録
            // function : 関数名を記録
            // pos : ログを出力したファイル名と行を記録する
            'option' => 'pid,function,pos',
            // ログ出力ファイル名の設定
            // デフォルトは [アプリケーションID].log 
            'file' => 'hoge.log',
            // 上記の'file' が指定されていない場合、デフォルトの
            // [アプリケーションID].log を出力するディレクトリを指定
            // デフォルトは Ethna_Controller の log ディレクトリに
            // 指定したもの
            'dir' => '....',
            // ログファイルのパーミッション(chmodします)
            // デフォルトは666
            'mode' => '666',
        ),

#### syslog [](ethna-document-dev_guide-log.html#pc3e1321 "pc3e1321")

syslogを使ってログを出力します。出力先は syslog の設定、及びプラットフォームによって異なります。設定は以下のようにしますが、使い方は echo のものと同様です。

    'log' => array(
        'syslog' => array(
            // ログレベルを設定。
            // 「ログレベルについて」の項を参照
            'level' => 'notice',
            // pid, function, pos を カンマ区切りで指定
            // pid : pid を記録
            // function : 関数名を記録
            // pos : ログを出力したファイル名と行を記録する
            'option' => 'pid,function,pos',
        ),

#### Alertmail [](ethna-document-dev_guide-log.html#ia88f74f "ia88f74f")

ログの内容を指定されたアドレスにメールで送信します。1回のログにつき1通のメールが送信され、backtraceが付加されます。緊急事態が発生したときなどに使います。設定は以下のようにします。

    'log' => array(
        'alertmail' => array(
            // ログレベルを設定。
            // 「ログレベルについて」の項を参照
            'level' => 'crit',
            // pid, function, pos を カンマ区切りで指定
            // pid : pid を記録
            // function : 関数名を記録
            // pos : ログを出力したファイル名と行を記録する
            'option' => 'pid,function,pos',
            // 送信先のメールアドレスを設定
            // カンマで区切って複数指定可能
            'mailaddress' => 'alert@ml.example.jp, bhoge@ml.example.com',
        ),

#### default [](ethna-document-dev_guide-log.html#u381aa61 "u381aa61")

何もしません。設定では 'default' を というキーを使いますが、これを使用することはないでしょう。

### ログ出力のフィルタ [](ethna-document-dev_guide-log.html#d41b4d84 "d41b4d84")

各ログの出力方式の設定には、'filter\_do', 'filter\_ignore' というキーでそれぞれ「マッチするログを出力する」, 「出力しない」、を設定できます。たとえば echoの設定を例にとると、以下のようになります。

    'log' => array(
        'echo' => array(
            // ログレベルを設定。
            // 「ログレベルについて」の項を参照
            'level' => 'notice',
            // pid, function, pos を カンマ区切りで指定
            // pid : pid を記録
            // function : 関数名を記録
            // pos : ログを出力したファイル名と行を記録する
            'option' => 'pid,function,pos',
            // マッチするログのみを出力
            // 設定が空ならば、全て出力されます。
            'filter_do' => '',
            // マッチしたものを無視する
            'filter_ignore' => 'Undefined index.*%%.*tpl',
        ),

### プログラムでログ出力を制御する方法 [](ethna-document-dev_guide-log.html#a3c9d31a "a3c9d31a")

Ethna では基本的にEthna\_Loggerクラスを使ってアプリケーションのログを管理していますが、出力されるタイミングは以下の3つがあります。

#### Ethna\_Logger へ直接指示する [](ethna-document-dev_guide-log.html#r50d9af4 "r50d9af4")

Ethna\_Logger クラスは、Ethna\_Controller, Ethna\_Backend から以下の形で取得できます。

    // Ethna_Controller から直接取得する
    $ctl =& Ethna_Controller::getInstance();
    $logger = $ctl->getLogger();
    
    // Ethna_Backend から取得する(アクションクラス、ビュークラス上で有効
    $logger =& $backend->getLogger();

こうして取得した Ethna\_Loggerクラスのインスタンスに対して、ログレベルとメッセージを引数として以下の形で直接指示します。エラー関連の処理については [エラー処理](ethna-document-dev_guide-error.html "ethna-document-dev\_guide-error (1240d)") のページも参照してください。

    // NOTICE レベルのメッセージを出力
    $logger->log(LOG_NOTICE, "メッセージ");

#### Ethna::raiseError() が実行されたとき [](ethna-document-dev_guide-log.html#b27aaf40 "b27aaf40")

    $errobj =& Ethna::raiseError("エラーだよ[%s]", E_USER_ERROR, $err_submsg);

#### trigger\_error() や fatal errorなどが発生したとき [](ethna-document-dev_guide-log.html#xbdd6d3c "xbdd6d3c")

    trigger_error("大変だ！エラーだよ！");

### ログ出力設定のサンプル [](ethna-document-dev_guide-log.html#g2688ca5 "g2688ca5")

ここでは、ログ出力設定の典型的な例についていくつか紹介します。

#### ログをファイルに出力する [](ethna-document-dev_guide-log.html#x87bc522 "x87bc522")

ログをファイルに出力するには、「file」という名前をキーにして設定を記述します。以下は、/tmp/hoge.log にパーミッション666で、noticeレベル以上のログを出力します。

通知するレベルを変更するには、level の値を変更します。 [ログレベルの説明](ethna-document-dev_guide-log.html#md5faa05)も参照して下さい。

    $config = array(
        'log' => array(
            'file' => array(
                'level' => 'notice',
                'option' => 'pid,function,pos',
                'file' => 'hoge.log',
                'dir' => '/tmp',
                'mode' => '666',
            ),
        ),

#### ログレベルに応じてアラートメールを送信させる [](ethna-document-dev_guide-log.html#ed4210ad "ed4210ad")

以下のようにして、メールの送信先のメールアドレスを記述します。  
カンマで区切って複数のメールアドレスが指定できます。

通知するレベルを変更するには、level の値を変更します。 [ログレベルの説明](ethna-document-dev_guide-log.html#md5faa05)も参照して下さい。

    $config = array(
        'log' => array(
            'alertmail' => array(
                'level' => 'err',
                'mailaddress' => 'alert@ml.example.jp',
            ),

#### アプリ開発中の詳細なログ [](ethna-document-dev_guide-log.html#y88cf8fa "y88cf8fa")

方針: typoを発見するためにLOG\_NOTICEレベル(E\_NOTICEを出力するレベル)まで画面に表示し、fileにはデータベースに問い合わせた全てのSQL文を出力する。

    $config = array( 
    
         'debug' => true,
         // ....
         'log' => array(
             'echo' => array(
                 'level' => 'notice',
                 'option' => 'pid,function,pos',
                 'filter_do' => '',
                 'filter_ignore' => 'Undefined index.*%%.*tpl',
             ),
             'file' => array(
                 'level' => 'debug',
                 'option' => 'pid,function,pos',
                 'filter_do' => '',
                 'filter_ignore' => 'Undefined index.*%%.*tpl',
             ),
          ),

#### 公開する本番環境のログ [](ethna-document-dev_guide-log.html#j2977732 "j2977732")

方針: とにかく画面にはなにも表示しない。回避可能だが意図した動作になっていないなどのLOG\_WARNINGレベルはファイルに出力。データベースに接続できないなどの緊急時に発生するLOG\_ERRレベルのログはメールでアラート用メーリングリストに送信する。

    $config = array( 
    
        'debug' => false,
        // ...
        'log' => array(
            'echo' => array(
                'level' => 'crit',
            ),
            'file' => array(
                'level' => 'warning',
            ),
            'alertmail' => array(
                'level' => 'err',
                'mailaddress' => 'alert@ml.example.jp',
            ),
        ),
        'log_option' => 'pid,function,pos',
        'log_filter_do' => '',
        'log_filter_ignore' => 'Undefined index.*%%.*tpl',

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
