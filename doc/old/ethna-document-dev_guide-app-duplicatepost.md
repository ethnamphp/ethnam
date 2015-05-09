<title>
二重POSTを防止する - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# 二重POSTを防止する 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [ethna-document-dev\_guide-app](ethna-document-dev_guide-app.html) > 二重POSTを防止する 

- 二重POSTを防止する 
  - (1) 登録画面の前のページ(確認画面等)にユニークIDを仕込む 
  - (2) 登録処理の Action で二重POSTをチェックする 
  - (捕捉) 動作原理 

## 二重POSTを防止する [](ethna-document-dev_guide-app-duplicatepost.html#g92d6077 "g92d6077")

### (1) 登録画面の前のページ(確認画面等)にユニークIDを仕込む [](ethna-document-dev_guide-app-duplicatepost.html#cbf75c27 "cbf75c27")

ethnaには二重POSTのチェック用のユニークIDを出力するSmartyプラグイン {uniqid} が用意されています。 以下のように確認画面(ない場合は登録画面) のテンプレートにユニークIDを仕込みます。

POSTの場合(hidden)

    <form method=POST action=index.php>
    <input type="hidden" name="action_user_regist_do" value="1">
     {uniqid}
     :
     :
    </form>

{uniqid} の部分には以下のようなhiddenタグが出力されます。

    <input type="hidden" name="uniqid" value="a0f24f75e...e48864d3e">

GET の場合

    <a href="?action_user_regist_do=1&...&{uniqid type=get}">登録</a>

### (2) 登録処理の Action で二重POSTをチェックする [](ethna-document-dev_guide-app-duplicatepost.html#m5409740 "m5409740")

Ethna\_Util::isDuplicatePost() の返り値が true の場合二重POSTです。 それ以降の処理をスキップして return します。

    function perform()
    	{
               if (Ethna_Util::isDuplicatePost()) {
                  // 二重POSTの場合
                  return 'regist_done';
               }
    
               // 登録処理
                    :
                    :
               return 'regist_done';
    	}

### (捕捉) 動作原理 [](ethna-document-dev_guide-app-duplicatepost.html#a97dbd70 "a97dbd70")

Ethna\_Util::isDuplicatePost() が呼ばれると、project\_root/tmp/ から  
uniqid\_{REMOTE\_ADDR}\_{uniqid} というファイルを探します。  
そのファイルが既に存在する場合は二重POSTとみなし true を返し、ない場合は作成します。  
リクエストに uniqid というパラメータがない場合は 常に falseを返します。  
一時ファイルは1時間で削除されます。

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
