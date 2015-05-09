# フォーム定義 - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# フォーム定義 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > フォーム定義 
## フォーム定義 [](ethna-document-dev_guide-form.html#i664c08c "i664c08c")

**[フォーム値にアクセスする](ethna-document-dev_guide-form-overview.html "ethna-document-dev\_guide-form-overview (1240d)")**  
Ethnaを利用した際に、フォーム値へアクセスする方法について説明します。

**[ファイルや配列にアクセスする](ethna-document-dev_guide-form-type.html "ethna-document-dev\_guide-form-type (1006d)")**  
単純な文字列以外のフォーム値(ファイルや配列)へアクセスする方法について説明します。

**[多次元配列にアクセスする](ethna-document-dev_guide-form-multiarray.html "ethna-document-dev\_guide-form-multiarray (737d)")**  
ファイルや配列へアクセスする要領で、多次元配列にアクセスすることもできます。

**[フォーム値の自動検証を行う(基本編)](ethna-document-dev_guide-form-validate.html "ethna-document-dev\_guide-form-validate (737d)")**  
フォーム値の属性を記述しておけば、チェックコードを書かなくても自動でフォーム値を検証することができます。

**[フォーム値の自動検証を行う(フィルタ編)](ethna-document-dev_guide-form-filter.html "ethna-document-dev\_guide-form-filter (619d)")**  
自動検証だけではなく、入力値を自動で変換する(半角→全角変換、不要な空白やNULLバイトの削除等)フィルタを設定することができます。

**[フォーム値の自動検証を行う(カスタムチェック編)](ethna-document-dev_guide-form-customvalidate.html "ethna-document-dev\_guide-form-customvalidate (1120d)")**  
3.でご説明した、既定の属性以外のチェックをフレームワークに組み込むことも出来ます

**[フォーム値の自動検証を行う(複合チェック編)](ethna-document-dev_guide-form-complexvalidate.html "ethna-document-dev\_guide-form-complexvalidate (1240d)")**  
実際のアプリケーションでは、（「デフォルトでは必須ではないが、"foo"がチェックされていたら必須」等）複雑な条件でのチェック処理が必要になることもあります。Ethnaはこういった処理にも対応することができます。

**[エラーメッセージをカスタマイズする](ethna-document-dev_guide-form-message.html "ethna-document-dev\_guide-form-message (619d)")**  
フォーム値の自動検証でエラーが発生した場合のエラーメッセージはデフォルトでも用意されていますが、任意のメッセージにカスタマイズすることも簡単にできます。

**[フォームテンプレート](ethna-document-dev_guide-form_template.html "ethna-document-dev\_guide-form\_template (737d)")**  
アクションフォームのForm定義に毎回書くのが面倒な場合、親クラスのActionFormにForm定義のテンプレートを作成できます。

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
