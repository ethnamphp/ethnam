<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
エラーメッセージをカスタマイズする - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# エラーメッセージをカスタマイズする 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [フォーム定義](ethna-document-dev_guide-form.html) > エラーメッセージをカスタマイズする 

- エラーメッセージをカスタマイズする 

## エラーメッセージをカスタマイズする [](ethna-document-dev_guide-form-message.html#r1985191 "r1985191")

mixi:Ethnaコミュニティ:雑談:74(いちいさん)より

エラーメッセージの変更は、各フォームのActionFormのform値に 以下のように設定すると、変更が可能となっている。

    'required' => true,
    	'type' => VAR_TYPE_INT,
    	'required_error' => '入力してね',
    	'type_error' => '整数にしてね',

上記の例の場合、'required'に対してのエラーが'required\_error'に対応していて、エラーが起きると「入力してね」が、'type'に対してのエラーが'type\_error'に対応していて「整数にしてね」とエラーメッセージが設定される。

エラーのタイプとしては、Ethna\_ActionFormのhandleErrorでマッピングされているとおり、

    'required_error'	E_FORM_REQUIRED
    	'type_error' E_FORM_WRONGTYPE_SCALAR
    				E_FORM_WRONGTYPE_ARRAY
    				E_FORM_WRONGTYPE_INT	
    				E_FORM_WRONGTYPE_FLOAT
    				E_FORM_WRONGTYPE_DATETIME
    				E_FORM_WRONGTYPE_BOOLEAN
    	'min_error' E_FORM_MIN_INT
    				E_FORM_MIN_FLOAT
    				E_FORM_MIN_DATETIME
    				E_FORM_MIN_FILE
    				E_FORM_MIN_STRING
    	'max_error' E_FORM_MAX_INT
    				E_FORM_MAX_FLOAT
    				E_FORM_MAX_DATETIME
    				E_FORM_MAX_FILE
    				E_FORM_MAX_STRING
    	'regexp_error' E_FORM_REGEXP

　5種類が用意されている。

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
