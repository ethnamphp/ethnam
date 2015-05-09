# Ethna 2.3.0 から 2.5.0 への移行ガイド
Ethna 2.3.x で作った古いプロジェクトを新しいバージョン 2.5.x 系に対応させるためのガイドラインです。(これに従えばうまくいく、というわけではありません。必ずバックアップを用意した上で、確認しながら作業するようにしてください。)

※ Ethna 2.1.0 から 2.3.0 への移行については、 [こちら](ethna-document-dev_guide-misc-migrate_project210to230.html "ethna-document-dev\_guide-misc-migrate\_project210to230 (1217d)") を御覧下さい。

- Ethna 2.3.0 から 2.5.0 への移行ガイド 
  - タグの説明 
  - 必ずチェックし、対応すべき点 
    - [必須] [Appid]\_Controller#getDefaultLanguage メソッドのオーバライド 
    - [必須] ロケール指定に伴うディレクトリ名の変更 
    - [必須] Ethna が出力するデフォルトメッセージファイルのコピー 
    - [必須] Smarty のデリミタの変更方法 
    - [必須] Ethnaクラス は PEAR に依存しない 
    - [必須] gettext を使うときは明示的に設定ファイルに記す 
    - [必須] 国名指定の定数の再定義 
    - [必須] Ethna\_Plugin\_CacheManager\_Memcache の接続設定 
    - [必須] 互換性確保のためのAPIを削除 
  - 移行の際に注意すべき点 
    - [注意] Ethna\_ActionForm のバリデータ 
    - [注意] [Appid]\_Controllerで定義したinclude\_path の順番 
    - [注意] ethna コマンドで自動生成されるスケルトン 

| 書いた人 | mumumu | 2008-06-25 | 新規作成 |

### タグの説明 [](ethna-document-dev_guide-misc-migrate_project230to250.html#y6e019f5 "y6e019f5")

2.3.x から 2.5.x に移行する際の考慮点として、

- 「必ずチェックし、対応すべき点」([必須])
- 「移行の際に注意すべき点」([注意])

の2つのレベルがあります。[必須]は、以前のバージョンとの互換性がない変更であり、移行する人が必ずチェックする必要があります。[注意] は、互換性がない変更ではあるものの、一応影響がないと思われるもの、または注意すべき項目を並べました。一応チェックしてみてください。

### 必ずチェックし、対応すべき点 [](ethna-document-dev_guide-misc-migrate_project230to250.html#b2dcb122 "b2dcb122")

#### [必須] [Appid]\_Controller#getDefaultLanguage メソッドのオーバライド [](ethna-document-dev_guide-misc-migrate_project230to250.html#f5e86308 "f5e86308")

2.5.x では、Ethna のソースコードそのものからエンコーディング依存のエラーメッセージを追い出し、プロジェクトで使用するエンコーディングをユーザが自由に指定できるように変更されました。 これは Ethna が世に出てから脈々と息付いてきた「utf-8固定」の常識を破る一番大きな変更です。

それにより、[appid]\_Controller.php での ロケール指定、エンコーディング指定が必須になりました。2.3.x 以前で作ったプロジェクトを 2.5.x へ移行させる方は、[appid]\_Controller.php で、Ethna\_Controller#\_getDefaultLanguage メソッドを以下の形で必ずオーバーライドするようにしてください。

    /**
     * デフォルト状態での使用言語を取得する
     * 外部に出力されるEthnaのエラーメッセージ等のエンコーディングを
     * 切り替えたい場合は、このメソッドをオーバーライドする。
     *
     * @access protected
     */
    function _getDefaultLanguage()
    {
        // ロケール名(e.x ja_JP, en_US 等),
        // システムエンコーディング名,
        // クライアントエンコーディング(= テンプレートのエンコーディング) の配列
        //
        // 古いプロジェクトで、テンプレートをutf-8で記述してきた人は、以下のよう
        // に記述する。これが移行コストが一番小さい書き方。
        return array('ja', 'utf-8', 'utf-8');
    
        // ソースコードを強制的にUTF-8に変更してきた人は、以下のように記述
        //return array('ja', 'UTF-8', 'UTF-8');
    }

上では、3つの要素からなる配列を返していますが、1番目と3番目が重要です。新しいやり方では、1番目の要素は ja\_JP のようなロケールを指定するのが新しい流儀ですが、単に「ja」と指定しておけば 2. で述べるディレクトリ名の変更をする必要もなくなります。

また、3番目の要素はテンプレートのエンコーディングを指定して下さい。このエンコーディングでブラウザからの入力があることを 2.5.x では想定するため、この指定も非常に重要です。

上記3つの要素のそれぞれの意味や、影響する範囲の詳細については、 [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.html "ethna-document-dev\_guide-app-setlanguage (737d)") のページを御覧下さい。

#### [必須] ロケール指定に伴うディレクトリ名の変更 [](ethna-document-dev_guide-misc-migrate_project230to250.html#s1ec04c7 "s1ec04c7")

2.5.x では、国際化対応も見据えた形で、テンプレートやメッセージファイルを格納するディレクトリをロケール単位で指定するように変更されました。よって、2.3.x より前に作られたプロジェクトを 2.5.x に移行させたい方で、国際化を考慮したいプロジェクトでは、以下のディレクトリ名を変更する必要があります。

    (変更前)
    - [appid]/locale/ja
    - [appid]/template/ja 
    (変更後)
    - [appid]/locale/ja_JP
    - [appid]/template/ja_JP

但し、上記 1. で [appid]\_Controller#\_getDefaultLanguage で返す配列の第1要素を 「ja」とオーバーライドした人は、この変更は必要ありません。

#### [必須] Ethna が出力するデフォルトメッセージファイルのコピー [](ethna-document-dev_guide-misc-migrate_project230to250.html#sa36b66d "sa36b66d")

2.5.x では、エンコーディングにプロジェクトが依存しないようにするため、Ethnaが吐き出す（エラー等の)メッセージを外部ファイルに追い出すように変更されています。ethna add-project コマンドで生成される以下のファイルに格納されています。

    [appid]/locale/ja_JP/LC_MESSAGES/ethna_sysmsg.ini

デフォルトのスケルトンファイルは、以下にあります。 (ETHNA\_BASE は、Ethnaをインストールしたディレクトリを指します)

    ETHNA_BASE/skel/locale/ethna_sysmsg.default.ini
    ETHNA_BASE/skel/locale/ja_JP/ethna_sysmsg.ini

古い 2.3.x 系のプロジェクトを移行する人は、ファイル ETHNA\_BASE/skel/locale/ja\_JP/ethna\_sysmsg.ini を [appid]/locale/ja[\_JP]/LC\_MESSAGES/ ディレクトリに必ずコピーする必要があります。

これらのファイルは、iniファイルライクな形式をとっており、以下のようになります。

    ;
    ; ethna_sysmsg.ini
    ;
    ; Ethna が出力するシステムメッセージ及びエラーメッセー
    ; ジの翻訳を格納するファイルです。エンコーディングは常にUTF-8です。
    ; ini ファイルの形式になっており、以下の書式をとります。
    ;
    ; "msgid" = "翻訳された文字列"
    ;
    ; msgid と翻訳された文字列は、かならずダブルクオートで
    ; 囲まれていなければなりません。文字列中にダブルクオート
    ; を含めたい場合は、バックスラッシュ[\]でエスケープします。
    ; また、コメントは行頭をセミコロン[;]ではじめます。
    ;
    ; msgid は絶対に変更しないで下さい！
    ;
    
    ; class/Ethna_ActionForm.php, class/Plugin/Validator/*.php
    "{form} contains machine dependent code." = "{form}に機種依存文字が入力されています"

このファイルの "翻訳された文字列" の部分を変更することで、Ethnaが吐き出すメッセージをカスタマイズすることができるようになっています。

#### [必須] Smarty のデリミタの変更方法 [](ethna-document-dev_guide-misc-migrate_project230to250.html#w53078fc "w53078fc")

Smarty のデフォルトのデリミタ 「{」は JavaScript との兼ね合いで問題があることが多いので、変更している方も多いと思います。Ethna 2.5.0 以降では、この設定方法を[APPID]-ini.php に固定するやり方に流儀が変更されました。以下のように設定します

    $config = array(
    
        // Smarty
        'renderer' => array(
            'smarty' => array(
                'left_delimiter' => '{{',
                'right_delimiter' => '}}',
            ),
        ),
    );

これ以外の方法で設定している場合でも、[APPID]-ViewClass#\_setDefault メソッドに設定している場合は上記の変更の影響を受けませんが、それ以外の場合は必ずチェックするようにしてください。

#### [必須] Ethnaクラス は PEAR に依存しない [](ethna-document-dev_guide-misc-migrate_project230to250.html#oc346a8d "oc346a8d")

2.3.x までは、Ethna.php に定義されていた Ethna クラスは PEAR.php にある [PEARクラス](http://pear.php.net/manual/ja/core.pear.php) を継承することで、エラー処理を全て PEAR に依存していました。

2.5.0 以降では、以下の理由から この継承関係を排除しました。

    a) PEAR が PEAR2 に移行するに伴い、APIが不安定になること
     b) Ethna が依存している PEAR_Error は既に非推奨であること
     c) 外部ライブラリにできうる限り依存しない方がユーザの便宜となる
     d) PEAR に依存していると、PHPライセンスと抵触しているライセンスで配布できない

これによって、以下の影響があります。必ずチェックし、必要な箇所は対応するようにして下さい。

    1. Ethna クラスから、PEAR クラスの機能 が使用できなくなっています。但し、
       エラー処理まわりの関数 raise[Error|Warning|Notice], isError メソッド
       は残してあります。 
    2. Ethna::isError($obj) の呼び出しに PEAR_Error オブジェクトを渡しても
       falseが返るようになりました。PEAR_Error に関しては、PEAR::isError を
       利用するようにして下さい。
    3. PEAR クラスで定義されていた OS_WINDOWS 定数が利用できなくなっていま
       す。代替の定数として ETHNA_OS_WINDOWS 定数を定義しているので、使用し
       ていた場合はそちらを利用するようにして下さい

#### [必須] gettext を使うときは明示的に設定ファイルに記す [](ethna-document-dev_guide-misc-migrate_project230to250.html#e1afff0f "e1afff0f")

2.5.x では、gettext を利用した国際化を行う際には、[appid]/etc/[appid]-ini.php での設定が明示的に必須となりました。そのため、2.3.x 以前で gettext を使用していた方は、以下のように指定して下さい

    ([appid]/etc/[appid]-ini.php)
    $config = array(
        // .... 
        // gettext を使用したい人は、明示的に指定
        'use_gettext' => true,
    );

#### [必須] 国名指定の定数の再定義 [](ethna-document-dev_guide-misc-migrate_project230to250.html#b1da0607 "b1da0607")

Ethna 2.5.x では、ロケール指定への移行に伴い、国名を指定するための LANG\_JA, LANG\_EN の定数が Ethna.php から削除されました。これらは、Ethna\_I18N.php でのみ使用されており、ロケール指定の観 点から不要なためです。

    (削除された定数定義)
    /** クライアント言語定義: 英語 */
    define('LANG_EN', 'en');
    /** クライアント言語定義: 日本語 */
    define('LANG_JA', 'ja');

よって、これらの定数を万が一使用していた古いプロジェクトでは、[appid]\_Controller.php の先頭 で再定義する必要があります。

#### [必須] Ethna\_Plugin\_CacheManager\_Memcache の接続設定 [](ethna-document-dev_guide-misc-migrate_project230to250.html#v07c9131 "v07c9131")

2.3.x までは、Ethna\_Plugin\_CacheManager\_Memcache の接続設定は、持続的接続がデフォルトでON になっていました。持続的でない通常接続を使用する場合は、以下のように [appid]/etc/[appid]-ini.php で設定する必要がありました。

    'memcache_use_connect' => true, // 2.3.x まで

2.5.x では、通常の接続をデフォルトでONにするように変更されました。これにより、持続的変更をONにしたい場合は、以下のように設定する必要があります。

    'memcache_use_pconnect' => true, // デフォルトはfalse

よって、既存の memcache\_use\_connect の設定は意味をなさなくなっています。 持続的接続は、memcached サーバへの接続コストを低減する必要がある場合に使用します。

#### [必須] 互換性確保のためのAPIを削除 [](ethna-document-dev_guide-misc-migrate_project230to250.html#q8acedb9 "q8acedb9")

互換性を保つために残されていた以下のAPIが削除されています。代替として示す関数を利用するようにして下さい

    1. Ethna_ViewClass の _getTemplateEngineメソッドが削除されています。
       代替として、Ethna_ViewClass の _getRenderer メソッドを利用するようにして下さい。

### 移行の際に注意すべき点 [](ethna-document-dev_guide-misc-migrate_project230to250.html#d8c2ed08 "d8c2ed08")

#### [注意] Ethna\_ActionForm のバリデータ [](ethna-document-dev_guide-misc-migrate_project230to250.html#g6e921af "g6e921af")

2.5.x では、フォームの入力値検証にプラグインのみを使用し、プラグインを使用しないコードは全 て削除されました。2.3.x からの移行の観点からは、明示的な影響はないようにコードは書かれている はずですが、自動生成されるアクションスクリプトの $use\_validator\_plugin = true; の指定は最早 不要です。

#### [注意] [Appid]\_Controllerで定義したinclude\_path の順番 [](ethna-document-dev_guide-misc-migrate_project230to250.html#w81d9301 "w81d9301")

2.5.x では、include\_path の順番が [appid]/app,lib を最も優先するように変更されました。これは自由に外部スクリプトをインストールできないレンタルサーバを考慮した変更であり、新しいプロジェクトのみに適用されます。

#### [注意] ethna コマンドで自動生成されるスケルトン [](ethna-document-dev_guide-misc-migrate_project230to250.html#o030cf55 "o030cf55")

2.5.x では、自動生成されたスケルトンがエンコーディングに依存しないようにするため、ソースコメントがすべてASCIIで記述されています。つまり英語コメントになっているということです。

日本語の方がいいのに、、と仰る方がおられるとは思いますが、エンコーディングに依存させないための変更ですので、御理解頂ければと思います。(2.3.x では、これがutf-8直打ちだったために、UTF-8を望む人が強制的に変換を行わなければなりませんでした)

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

