# PATH_INFOを使ったRequest-URIからのパラメータの取得
- PATH_INFOを使ったRequest-URIからのパラメータの取得 
  - 概要 
  - 使用例 
    - $action_map の設定 
    - _getPath_Index() 関数の定義 
    - URL_HANDLER 変数の設定 
    - $config['url'] の設定 
    - echo_msg アクションを追加 
  - 細かい使いかた 
    - PATH_INFOから複数のパラメータを取得する 
    - path_extのパラメータ 
    - PATH_INFOの正規化 
    - _getPath_\*() の返り値 

書いた人: いちい

### 概要

Request-URIからパラメータを取得したいときは、Ethna_UrlHandlerクラスを使うと便利です。

Ethna_UrlHandlerは次の2つの機能を持っています。

- PATH_INFOからaction, リクエストパラメータへの変換
  - エントリポイントとPATH_INFOからactionを決定する
  - PATH_INFOから$_REQUESTなどにパラメータをインポートする
  - コントローラに組込み済み

- action, パラメータからPATH_INFO(に相当するパス文字列)への変換
  - actionからエントリポイントを決定
  - その他のパラメータからPATH_INFOを生成
  - Ethnaで定義済みのSmartyプラグイン {url} で利用可能

また、Ethna-2.3.2からEthna_UrlHandlerがプラグインを使っても利用できるようになりました。

**[Net_URL_Mapperを使ったUrlhandlerプラグイン](dev_guide-urlhandler-plugin-neturlmapper.md)**

UrlHandlerとエントリポイント、mod_rewriteとの関係などについては、以下を参照してください。

**[URLHandlerの設定例](dev_guide-urlhandler-example.md)**

### 使用例

新規にプロジェクトを作ると、app/Appid_UrlHandler.phpファイルが作られ、アプリケーションのUrlHandlerクラスが用意されます。この中の$action_mapを設定することでUrlHandlerが利用できます。デフォルトではなにもしません。

以下では、 [http://localhost/sample/index.php/echo/hello](http://localhost/sample/index.php/echo/hello) のアクセスで、エントリポイント index.php にパラメータ echo='hello' を指定するための例を説明します。

#### $action_map の設定

- app/Appid_UrlHandler.php

    var $action_map = array(
        'index' => array(
            'echo_msg' => array(
                'path' => 'echo',
                'path_regexp' => '|^echo/(.*)$|',
                'path_ext' => array('msg' => array()),
            ),
        ),
    );

- 'index'
  - 明確な位置づけはないですが、エントリポイントごとに設定を切替えるための見出しとして使います。詳しくは後述します。
- 'echo_msg'
  - 以下のpathの設定に対応するEthnaでのアクション名を指定します。
- 'path'
  - PATH_INFOの中でパラメータではなくパス部分と解釈されるprefixです。PATH_INFO生成時にprefixとして付加されるときと、path_regexpより低コストのマッチングをするときに使われます。
- 'path_regexp'
  - PATH_INFOからパラメータを切り出すための正規表現です。なお、この例では正規表現のデリミタを (よくある '/' ではなく) '|' としています。
- 'path_ext'
  - PATH_INFOに埋め込まれるパラメータと、Ethnaでのフォーム名との対応を記述します。正規表現の後方参照と、arrayの要素の順序が対応します。

#### _getPath_Index() 関数の定義

アクションとパラメータからPATH_INFOを含むURLを生成するときに使われます。現在のところ、Ethna組込みのSmarty関数{url}を利用するときのみ必要な作業です。

上のエントリポイントで指定した 'index' に対応するものとして、 _getPath_Index() という関数名になります。

- app/Appid_UrlHandler.php

    function _getPath_Index()
    {
        return array("/index.php/", array());
    }

#### URL_HANDLER 変数の設定

$action_map の中で 'index' の設定を使うことを指示するために、エントリポイントで $_SERVER['URL_HANDLER'] の値を 'index' に設定します。

- エントリポイントに記述する場合
  - www/index.php を以下のように設定

    <?php
    include_once('/path/to/appid/app/Appid_Controller.php');
    $_SERVER['URL_HANDLER'] = 'index';
    
    Appid_Controller::main('Appid_Controller', 'index');
    ?>

- Apache の .htaccess に記述する場合
  - エントリポイントのファイル名を拡張子 '.php' なしで使いたい場合には以下のように設定するとよいでしょう(詳しくはApacheのマニュアルを参照してください)。

    DirectoryIndex index
    <FilesMatch "^index$">
    ForceType application/x-httpd-php
    SetEnv URL_HANDLER index
    </FilesMatch>

$_SERVER や SetEnv を経由するのは複雑なようですが、 $action_map のエントリが膨大になった場合に、リクエストのたびに膨大な量の照合が発生することを避ける意図があります。

#### $config['url'] の設定

さらに、アプリケーションの(ベースとなる)URLを設定します。これは、htmlの相対パス指定がPATH_INFOによって混乱するのを避けるためです。

- etc/app-ini.php

    $config = array(
        ...
        'url' => '/sample/',
        ...

#### echo_msg アクションを追加

- echo_msg アクションを追加

    $ ethna add-action echo_msg

- app/action/Echo/Msg.php を編集

    var $form = array(
        'msg' => array(),
        ...
    );

    function prepare()
    {
        $this->af->validate();
    }

- echo_msg のテンプレートを追加 (ビューは省略)

    $ ethna add-template echo_msg

- template/ja/echo/msg.tpl を編集

    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        </head>
        <body>
            <h1>Appid</h1>
            <p>message = {$form.msg}</p>
    	 <p>a url to echo "good morning" is <a href={url action="echo_msg" msg="good morning"}>here</a>.</p>
        </body>
    </html>

これで [http://localhost/sample/index.php/echo/hello](http://localhost/sample/index.php/echo/hello) にアクセスし、"message = hello" と表示されれば成功です。

### 細かい使いかた

#### PATH_INFOから複数のパラメータを取得する

例:

    'printf_msg => array(
        'path' => 'printf,
        'path_regexp' => array(
            1 => '|^printf/([^/]*)$|',
            2 => '|^printf/([^/]*)/([^/]*)$|',
        ),
        'path_ext' => array(
            1 => array(
                'msg' => array(),
            ),
            2 => array(
                'format' => array(),
                'param' => array(),
            ),
        ),
    ),

1の正規表現にマッチしたときは'msg'にパラメータを、2にマッチしたときは'format'と'param'にパラメータを入れる、という使いかたができます。

#### path_extのパラメータ

'path_ext' => array('msg' => array()) の array() の中には、次のパラメータが指定できます。

- input_filter
  - PATH_INFOの各パラメータの入力フィルタです。PATH_INFOからフォーム値に変換するときに作用します。Appid_UrlHandlerクラスのメソッド名を指定します。
- output_filter
  - PATH_INFOの各パラメータの出力フィルタです。フォーム値からPATH_INFOを作るときに作用します。
- form_prefix, form_suffix
  - input_filter/output_filterのprefix, suffixに特化したフィルタです。入出力時にprefix, suffixを付加／削除します。たとえば実際の値は複雑だが、PATH_INFOでの表現は簡潔にしたいときに指定します。
- url_prefix, url_suffix
  - form_prefixなどとは逆に、PATH_INFOでの表現を修飾したいときに使います。

なお、PATH_INFO生成はrawurlencode()を用いたエンコードを施します。フィルタなどの処理は上に書いた順に行われ、rawurlencode()はurl_prefix/suffixを付加する直前に実行されます。

#### PATH_INFOの正規化

'path_regexp' で指定した正規表現とマッチングされるPATH_INFOは、スラッシュ ('/') の重複と先頭、末尾のスラッシュを取り除いた状態に正規化されています。

#### _getPath_\*() の返り値

先ほどの例では、 array('/index.php/', array()) という2つの要素を含む配列を返していました。この意味について説明します。(この内容はPATH_INFOを生成するときの話です。)

- 1つめの要素
  - PATH_INFOにprefixとして付加する文字列。すなわち、エントリポイントのパスになります。
- 2つめの要素
  - リクエストパラメータのうち、PATH_INFOに埋め込むパラメータとそうでないパラメータが存在します。UrlHandlerがパラメータをPATH_INFOに埋め込んだ場合は、そのパラメータをリクエストパラメータ("?"以降につけるパラメータ)に付加しないようにしなければなりません。2つめの要素に array('foo', 'bar') のように指定すると、実際にPATH_INFOに加えた'foo', 'bar' というパラメータはリクエストパラメータに入らなくなります。(?? ちょっと意図が不明)

