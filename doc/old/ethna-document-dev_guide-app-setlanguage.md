<title>
言語とエンコーディングの設定 - Ethna - PHPウェブアプリケーションフレームワーク</title>
 <link rel="stylesheet" href="skin/ethna/ethna.css" title="ethna" type="text/css" charset="utf-8">

 <link rel="alternate" type="application/rss+xml" title="RSS" href="cmd=rss.html">

 <script type="text/javascript" src="skin/trackback.js"></script>

</head>
ここは以前の ethna.jp サイトを表示したものです。ここにあるドキュメントはバージョン2.6以降更新されません。  
最新のドキュメントは [現在のethna.jp](http://ethna.jp/) を閲覧してください。現ドキュメントが整備されるまでは、ここを閲覧してください。

<!-- ??BEGIN id:wrapper --><!-- ?? Navigator ?? ======================================================= -->

[![Ethna](image/navlogo.gif)](/)

[トップ](ethna.html "ethna (11d)") [二ュース](ethna-news.html "ethna-news (11d)") [概要](ethna-about.html "ethna-about (11d)") [ダウンロード](ethna-download.html "ethna-download (25d)") [ドキュメント](ethna-document.html "ethna-document (884d)") [コミュニティ](ethna-community.html "ethna-community (619d)") [FAQ](ethna-document-faq.html "ethna-document-faq (1240d)")

<!-- ?? Header ?? ========================================================== -->

# 言語とエンコーディングの設定 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [ethna-document-dev\_guide-app](ethna-document-dev_guide-app.html) > 言語とエンコーディングの設定 
## 言語とエンコーディングの設定 [](ethna-document-dev_guide-app-setlanguage.html#uf44dd22 "uf44dd22")

    注意：このページで記述している機能を使うには、Ethna 2.5.0 以降が必要です。

ここでは、Ethna での言語とエンコーディングの設定、およびそれを切り替える方法について説明します。\*1

- 言語とエンコーディングの設定 
  - Ethna における言語設定の要素とその設定 
    - プロジェクトで使用するロケールの設定と影響範囲 
    - プロジェクトで使用するエンコーディングの設定と影響範囲 
  - ethna コマンドでの言語設定 
    - ethna add-project コマンド 
    - ethna add-view, add-template コマンド 
  - 言語設定を動的に変更する 
    - ロケールの変更 
    - プロジェクトで使用するエンコーディングの変更 
    - Ethna\_Controller#\_setLanguage メソッドをオーバーライドする 
    - 言語設定の変更は慎重に行うべき 
  - 言語設定を取得する 
    - ロケール名、エンコーディングの設定を一気に取得する 
    - ロケール名を取得する 
    - エンコーディングを取得する 

| 書いた人 | mumumu | 2008-06-30 | 新規作成 |

### Ethna における言語設定の要素とその設定 [](ethna-document-dev_guide-app-setlanguage.html#v4c471ad "v4c471ad")

Ethna では、[appid]\_Controller の \_getDefaultLanguage メソッドをオーバーライドすることで言語設定を行い、ロケール名とテンプレートのエンコーディング(クライアントエンコーディングと呼びます)を設定します。デフォルトの実装は以下のようになります。

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
        return array('ja_JP', 'UTF-8', 'UTF-8');
    }

このメソッドでは、以下の3つの値を配列として返します。

- 1. ロケール名(デフォルト ja\_JP)  
ロケールとは地域の文化、言語等を表す規則です。具体的には ja\_JP, en\_US のように、[言語コード]\_[国名コード] の値を設定します。  
  
- 2. システムエンコーディング（デフォルトUTF-8)  
現状未使用ですが、将来の拡張のために予約されています。基本的には何を設定しても構いませんが、将来の拡張に備えて意味のあるエンコーディングを設定するようにしましょう。  
  
- 3. クライアントエンコーディング（デフォルトUTF-8）  
ブラウザに表示するテンプレートのエンコーディングであり、プロジェクトの内部エンコーディングのことです。[appid]/template ディレクトリ以下に置くテンプレートのエンコーディングを設定します。以下で特に断らずに「エンコーディング」と述べている箇所は、このクライアントエンコーディングのことを指しています。  

#### プロジェクトで使用するロケールの設定と影響範囲 [](ethna-document-dev_guide-app-setlanguage.html#q5ae4f6f "q5ae4f6f")

プロジェクトで設定するロケールは、ethnaコマンドの add-project 時に決まります([appid]\_Controller の \_getDefaultLanguage メソッドでも変更可)。すでに述べたように、何も指定しないとデフォルトのロケールとして ja\_JP が仮定されますが、ethna コマンド実行時にそれを変更することも出来ます。

    ethna add-project -l en_US sample

こうすると、デフォルトのロケールは en\_US となり、テンプレートディレクトリとして [appid]/template/en\_US が作られます。また、Ethnaが出力するエラーメッセージのカタログファイルが以下の場所に作成されます。

    [appid]/locale/en_US/LC_MESSAGES/ethna_sysmsg.ini

つまり、Ethnaのロケール設定/変更 で影響するのは以下の二つです。

- テンプレートのディレクトリ
- Ethnaが吐き出すエラーメッセージカタログのディレクトリ

#### プロジェクトで使用するエンコーディングの設定と影響範囲 [](ethna-document-dev_guide-app-setlanguage.html#kd2b4c1d "kd2b4c1d")

ロケールと同様、プロジェクトで使用するエンコーディングは、ethnaコマンドの add-project 時に決まります([appid]\_Controller の \_getDefaultLanguage メソッドでも変更可)。すでに述べたように、何も指定しないとデフォルトのエンコーディングとして UTF-8 が仮定されますが、ethna コマンド実行時にそれを変更することも出来ます。

    ethna add-project -e utf-8 sample

こうすると、プロジェクトのエンコーディングとして EUC\_JP が仮定されます。但し、ここで設定するエンコーディングは、 [PHPの mbstring が認識できるもの](http://www.php.net/manual/en/function.mb-list-encodings.php) を設定して下さい。\*2

つまり、Ethnaのエンコーディング設定/変更 で影響するのは以下の2つです。

- テンプレートのエンコーディング（Ethnaから出力するエラーメッセージも含む)
- Ethna 内部で mbstring が使用する内部エンコーディング(validate, filterの際のエンコーディング等)

### ethna コマンドでの言語設定 [](ethna-document-dev_guide-app-setlanguage.html#racdd706 "racdd706")

ethna コマンドには、ロケールやエンコーディング指定を行えるようになっているコマンドが複数あります。

#### ethna add-project コマンド [](ethna-document-dev_guide-app-setlanguage.html#gccd6093 "gccd6093")

add-project コマンドでは、下の通りロケールとエンコーディングを指定できます。これによって、ロケールとプロジェクトのエンコーディングが指定できるようになっています。

    ethna add-project ... [-l|--locale] [-e|--encoding] [Application id]

#### ethna add-view, add-template コマンド [](ethna-document-dev_guide-app-setlanguage.html#o8497894 "o8497894")

add-view コマンドおよび、add-template コマンドでもロケールとエンコーディングを指定できます。これによって、テンプレートを置くディレクトリと、テンプレートの charset 属性が決まります。指定されたエンコーディングで文字が書き込まれるわけではないことに注意して下さい。

また、add-view コマンドの場合は、-t オプションが指定されない限り、ロケールとエンコーディングのオプションは無視されます。

    ethna add-view -> add new view to project:
       add-view [options...] [view name]
       [options ...] are as follows.
           [-b|--basedir=dir] [-s|--skelfile=file]
           [-w|--with-unittest] [-u|--unittestskel=file]
           [-t|--template] [-l|--locale] [-e|--encoding]
       NOTICE: "-w" and "-u" options are ignored when you specify -t option.
               "-l" and "-e" options are enabled when you specify -t option.

    ethna add-template ... [-l|--locale] [-e|--encoding] [template]

### 言語設定を動的に変更する [](ethna-document-dev_guide-app-setlanguage.html#vb7a5a10 "vb7a5a10")

Web からのリクエストに応じて、[appid]\_Controller の \_getDefaultLanguage で行った設定を変えたい場合もあると思います。その方法を以下で説明します。

#### ロケールの変更 [](ethna-document-dev_guide-app-setlanguage.html#kadebb5f "kadebb5f")

Ethna\_Controller#setLocale メソッドを使います。ただし、このメソッドを使うとテンプレートのディレクトリや、Ethna が出力するエラーメッセージのカタログディレクトリもそのロケールに変更されますので注意して下さい。

[appid]/locale 指定したロケールファイルがない場合は、デフォルトの英語のシステムメッセージが使われます。また、[appid]/template 以下に指定したロケールのディレクトリがない場合は単にエラーになるでしょう。

    $ctl = Ethna_Controller::getInstance();
    $ctl->setLocale('en_US');

#### プロジェクトで使用するエンコーディングの変更 [](ethna-document-dev_guide-app-setlanguage.html#fed0b5fe "fed0b5fe")

Ethna\_Controller#setClientEncoding メソッドを使います。ただし、このメソッドを使うと Ethna が mbstring で使う内部エンコーディングも変更されるので注意して下さい。つまり、Ethnaが出力するエラーメッセージのエンコーディングも変更されます。

    $ctl = Ethna_Controller::getInstance();
    $ctl->setClientEncoding('utf-8');

#### Ethna\_Controller#\_setLanguage メソッドをオーバーライドする [](ethna-document-dev_guide-app-setlanguage.html#y8a9062e "y8a9062e")

言語を変更するためのフックとして Ethna\_Controllerクラスに \_setLanguage メソッドが用意されています。このメソッドはアクションクラスが呼ばれる直前、かつ Session, Backend, ActionForm が初期化された直後に必ず呼び出されます。ここで、Ethna\_Controller のプロパティを書き換えた上で、Ethna\_I18n#setLanguage を呼び出してロケールやカタログの中身を再ロードさせるようにします。

    function _setLanguage($locale, $system_encoding = null, $client_encoding = null)
       {
           // ロケールを ko_KR に、クライアントエンコーディングを
           // 'EUC_KR' に変更する   
           $this->locale = 'ko_KR';
           $this->system_encoding = $system_encoding;
           $this->client_encoding = 'EUC_KR';
    
           // ロケールを変更した際は、必ず $i18n のsetLanguageメソッド
           // も呼び出すこと。
           $i18n =& $this->getI18N();
           $i18n->setLanguage($locale, $system_encoding, $client_encoding);
       }

コントローラーを複数用意し、それぞれに \_getDefaultLanguage をオーバライドしてエントリポイントから呼び出してやるという手もあります。

#### 言語設定の変更は慎重に行うべき [](ethna-document-dev_guide-app-setlanguage.html#g13ca01b "g13ca01b")

既に述べたように、言語設定の変更は、Ethnaが見に行くディレクトリの変更や、内部エンコーディングの変更など、内部の動作をそれなりに変更するものです。

よって上記のAPIを用いるときは、 [影響範囲に関する記述](ethna-document-dev_guide-app-setlanguage.html#q5ae4f6f) を読み、自分が何をしているのかをしっかりと理解した上で慎重に使用するようにして下さい。

### 言語設定を取得する [](ethna-document-dev_guide-app-setlanguage.html#h6412575 "h6412575")

Ethna\_Controller クラスに、\_getDefaultLanguage メソッドや、set[Locale|ClientEncoding] メソッドで設定された言語設定を取得するAPIが定義されているので、それを使います。

#### ロケール名、エンコーディングの設定を一気に取得する [](ethna-document-dev_guide-app-setlanguage.html#kcd361c9 "kcd361c9")

Ethna\_Controller#getLanguage メソッドを使います。

    $ctl = Ethna_Controller::getInstance();
    list($locale, $system_encoding, $client_encoding) = $ctl->getLanguage();

#### ロケール名を取得する [](ethna-document-dev_guide-app-setlanguage.html#ve0ec797 "ve0ec797")

Ethna\_Controller#getLocale メソッドを使います。

    $ctl = Ethna_Controller::getInstance();
    $locale = $ctl->getLocale();

#### エンコーディングを取得する [](ethna-document-dev_guide-app-setlanguage.html#tda63aae "tda63aae")

Ethna\_Controller#getClientEncoding メソッドを使います。

    $ctl = Ethna_Controller::getInstance();
    $client_encoding = $ctl->getClientEncoding();

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1Ethna 2.5.0 以降では、内部のエンコーディング、およびエラーメッセージが utf-8 決め打ちから、エンコーディングに依存しない方式に変更されました。それに伴う変更について述べています。  
\*2PHP5以降でEthnaを使用した場合、-eオプションで不正なエンコーディングを入力するとエラーにしています。PHP4 では、サポートされるエンコーディングがわからないため、このチェックは行われません。(mb\_list\_encodings 関数がPHP5以降なため  

<!-- ??END id:note -->
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
