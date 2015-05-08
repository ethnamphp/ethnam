<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
VAR_TYPE_STRING の max, min 属性に関する詳細 - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# VAR\_TYPE\_STRING の max, min 属性に関する詳細 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [フォーム定義](ethna-document-dev_guide-form.html) > [フォーム値の自動検証を行う(基本編)](ethna-document-dev_guide-form-validate.html) > VAR\_TYPE\_STRING の max, min 属性に関する詳細 

- VAR\_TYPE\_STRING の max, min 属性に関する詳細 
- Ethna 2.5.0 以降での max, min の検証 
  - 文字数単位(全角半角区別なし)の検証
    - mbstrmax, mbstrmin 属性を使う 
  - バイト数単位(全角半角区別あり)の検証 
    - クライアントエンコーディングを utf-8(eucJP-Win) に変更する 
    - strmaxcompat, strmincompat 属性を使う 
  - シングルバイト文字列の検証 
- Ethna 2.3.5 より前でのmax, min属性の検証 

## VAR\_TYPE\_STRING の max, min 属性に関する詳細 [](ethna-document-dev_guide-form-validate-vartypestring.html#yea703ed "yea703ed")

form 定義の type を 以下のように VAR\_TYPE\_STRING と設定した場合、Ethna のバージョンによって、max と min 属性の解釈に違いがあります。2.5.0 以降と、2.3.x以前のバージョンでこの違いが表れます。

    $form = array(
        'sample' => array(
            'type' => VAR_TYPE_STRING,
            // ....
       ),
    );

以下、その違いについて詳細を説明します。

## Ethna 2.5.0 以降での max, min の検証 [](ethna-document-dev_guide-form-validate-vartypestring.html#b1714d90 "b1714d90")

### 文字数単位(全角半角区別なし)の検証 [](ethna-document-dev_guide-form-validate-vartypestring.html#i96dbb09 "i96dbb09")

Ethna 2.5.0 以降では、maxとmin 属性のチェックがデフォルトで「文字数」を基本として行われ、全角と半角を区別しなくなりました。required, (mb)regexp 属性についての扱いは従来と同様です。

これは Ethna 2.5.0 以降、Ethna で扱う内部のエンコーディングが　utf-8 から UTF-8に変更となったことによるものです。

フォーム定義を以下のように設定した場合は、

- sampleは入力必須
- 文字数が最大で6文字
- 文字数が最小で2文字

という意味として解釈されます。

    $form = array(
        'sample' => array(
            'type' => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_TEXT,
            'required' => true,
            'max' => 6,
            'min' => 2,
       ),
    );

この場合に検証結果がエラーになった場合、エラーメッセージは全角半角を区別しない形で以下のように表示されます。

    {form}は6文字以下で入力して下さい
    {form}は2文字以上で入力して下さい

#### mbstrmax, mbstrmin 属性を使う [](ethna-document-dev_guide-form-validate-vartypestring.html#za9eb899 "za9eb899")

上記の「全角半角を区別しない、文字数ベースの検証」は、以下のように mbstrmax, mbstrmin 属性を設定したときの動きと同じです。これらの属性を使うと、後で述べるクライアントエンコーディングに関わらず、全角半角の区別がない文字数ベースの検証が行われます。

    $form = array(
        'sample' => array(
            'type' => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_TEXT,
            'required' => true,
            'mbstrmax' => 6,
            'mbstrmin' => 2,
       ),
    );

### バイト数単位(全角半角区別あり)の検証 [](ethna-document-dev_guide-form-validate-vartypestring.html#h4401591 "h4401591")

#### クライアントエンコーディングを utf-8(eucJP-Win) に変更する [](ethna-document-dev_guide-form-validate-vartypestring.html#v51832a6 "v51832a6")

※ クライアントエンコーディングとは、プロジェクトの内部エンコーディングと、テンプレートのエンコーディングのふたつを指します。詳しくは [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.html "ethna-document-dev\_guide-app-setlanguage (737d)") のページを参照して下さい。

Ethna 2.5.0 preview1 以降で、古いプロジェクトを維持するために utf-8 のような全角半角のバイト数が決まっている文字コードをクライアントエンコーディングとして用いるときは、バイト数単位の検証を行いたいかもしれません。

その場合は、[appid]\_Controller.php の \_getDefaultLanguage メソッドを以下のようにオーバーライドし、クライアントエンコーディングを utf-8に変更することで、デフォルトでバイト数単位で、全角半角を区別した検証が行われるようになります。

    警告！：以下のようにオーバーライドすると、テンプレートのエンコーディング及
    び、プロジェクトの内部エンコーディングが utf-8 であると Ethna は看做します！
    これは utf-8 がデフォルトであった 2.3.x との互換性を維持するための設定です！

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
        return array('ja_JP', 'utf-8', 'utf-8');
    }

つまり、上記のように設定し、フォーム定義を以下のように設定した場合は、

- sampleは入力必須
- 文字数が最大で全角3文字、半角6文字
- 文字数が最小で全角1文字、半角2文字

という意味として解釈されます。

    $form = array(
        'sample' => array(
            'type' => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_TEXT,
            'required' => true,
            'max' => 6,
            'min' => 2,
       ),
    );

上記の設定で検証結果がエラーになった場合、エラーメッセージは以下のように全角半角を区別した形で表示されます。

    {form}には全角1文字以上(半角2文字以上)で入力して下さい
    {form}には全角3文字以下(半角6文字以下)で入力して下さい

#### strmaxcompat, strmincompat 属性を使う [](ethna-document-dev_guide-form-validate-vartypestring.html#j6390c67 "j6390c67")

新しいプロジェクトで、クライアントエンコーディングを utf-8 に設定しない場合でも、バイト数単位で、全角半角区別ありの検証を行いたいかもしれません。その場合は、strmaxcompat, strmincompat 属性を以下のようにして使用します。

    $form = array(
        'sample' => array(
            'type' => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_TEXT,
            'required' => true,
            'strmaxcompat' => 6,
            'strmincompat' => 2,
       ),
    );

### シングルバイト文字列の検証 [](ethna-document-dev_guide-form-validate-vartypestring.html#g034b9d6 "g034b9d6")

ASCII しか入ってこないことがわかっている場合で、全角半角を区別「しない」検証を行いたい場合に備えて、strmax, strmin 属性が追加されました。以下のようにして使用します。

    $form = array(
        'sample' => array(
            'type' => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_TEXT,
            'required' => true,
            'strmax' => 6,
            'strmin' => 2,
       ),
    );

この場合のエラーメッセージは、デフォルトの場合と同様、以下のように全角半角を区別しない形になります。

    {form}は6文字以下で入力して下さい
    {form}は2文字以上で入力して下さい

    この属性は、mbstring が入っていない場合の、min, max のデフォルトの
    動きになります。

## Ethna 2.3.5 より前でのmax, min属性の検証 [](ethna-document-dev_guide-form-validate-vartypestring.html#o87f6308 "o87f6308")

Ethna 2.3.5 以前では、一貫して「バイト数単位で、全角半角を区別する」検証がmax, min 属性では行われます。

つまり、フォーム定義を以下のように設定した場合は、

- sampleは入力必須
- 文字数が最大で全角3文字、半角6文字
- 文字数が最小で全角1文字、半角2文字

という意味として解釈されます。

    $form = array(
        'sample' => array(
            'type' => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_TEXT,
            'required' => true,
            'max' => 6,
            'min' => 2,
       ),
    );

上記の設定で検証結果がエラーになった場合、エラーメッセージは以下のように全角半角を区別した形で表示されます。

    {form}には全角1文字以上(半角2文字以上)で入力して下さい
    {form}には全角3文字以下(半角6文字以下)で入力して下さい

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
