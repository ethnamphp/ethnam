# 汎用View
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

# 汎用View 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [アイデア](ethna-document-ideas.html) > 汎用View 
## 汎用View [](ethna-document-ideas-extended_viewclass.html#l4314414 "l4314414")

### 概要 [](ethna-document-ideas-extended_viewclass.html#m19384a2 "m19384a2")

- Ticket
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=15799](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15799)
- Branch URL
  - [http://svn.sourceforge.jp/view/ethna/branches/IDEAS/Idea\_Extended\_ViewClass/?root=ethna](http://svn.sourceforge.jp/view/ethna/branches/IDEAS/Idea_Extended_ViewClass/?root=ethna)

Ethna 2.5.0 preview3 の時点では、Webアプリケーションで良く使われる出力処理をどこに書けばよいのか 全く分からない状態になっている。たとえば以下のような処理である

1. 404や503 など、特定のステータスコードを吐き出す処理
2. JSONを吐き出す処理
3. リダイレクト(302) の処理

こうした処理は汎用のViewクラスとして実装する方が良いと考えられる [http://ethna.jp/ethna-yakiniku-meeting-20090125.html#mb0a884d](ethna-yakiniku-meeting-20090125.html#mb0a884d)

### 実装したいこと [](ethna-document-ideas-extended_viewclass.html#w20c481c "w20c481c")

- 任意のheaderを吐けるようにする
- エラー画面、Flush、リダイレクトなどの処理の汎用的なものを用意する
- 多分レイアウトテンプレートの実装にも影響すると思われる
- HTMLヘッダの出力なども担当したい（Smartyヘルパ？）
- kQoZjVxfe -- oxsotqykfwu [?](cmd=edit&page=oxsotqykfwu&refer=ethna-document-ideas-extended_viewclass.html) 2010-09-29 (水) 06:50:30
  
<form action="http://ethna.jp/index.php" method="post"> 
<div><input type="hidden" name="encode_hint" value="ぷ"></div>
 <div>
  <input type="hidden" name="plugin" value="comment">
  <input type="hidden" name="refer" value="ethna-document-ideas-extended_viewclass">
  <input type="hidden" name="comment_no" value="0">
  <input type="hidden" name="nodate" value="0">
  <input type="hidden" name="above" value="1">
  <input type="hidden" name="digest" value="b8d4fb68fff3a1d5b6df508abe3c3b52">
  <label for="_p_comment_name_0">お名前: </label><input type="text" name="name" id="_p_comment_name_0" size="15">

  <input type="text" name="msg" id="_p_comment_comment_0" size="70">
  <input type="submit" name="comment" value="コメントの挿入">
 </div>
</form>
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
