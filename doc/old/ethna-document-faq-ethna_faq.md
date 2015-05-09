# Ethna全般のFAQ
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

# Ethna全般のFAQ 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [FAQ](ethna-document-faq.html) > Ethna全般のFAQ 

- Ethna全般のFAQ 
  - Ethnaとはなんですか？ 
  - フレームワークとは何ですか? 
  - 利用にあたり何が必要ですか? 
  - Smartyをインストールしたのに動きません 
  - ライセンスは何ですか? 
  - インストールはどうやればいいでしょう? 
  - ドキュメントになってない機能をまとめてみました。／スマートな使い方を見つけました。 
  - どうしてEthnaという名前なんですか? 
  - 開発者は誰ですか? 

## Ethna全般のFAQ [](ethna-document-faq-ethna_faq.html#t61f5bb8 "t61f5bb8")

### Ethnaとはなんですか？ [](ethna-document-faq-ethna_faq.html#a9fa99d8 "a9fa99d8")

PHPを利用した、webアプリケーションフレームワークです。2004年に開発が開始され、国産のPHPによるwebフレームワークでは代表的なものの一つです。

Ethnaは実際にさまざまなwebアプリケーションに利用されています。たとえば、日本発のSNS（ソーシャル･ネットワーキング･サービス） [GREE](http://www.gree.jp)のフレームワークとしてEthnaが利用されています。運用と開発が一体となって行われていることは、大きな特徴のひとつであると言えます。  
くわしくは [こちら](ethna-about.html "ethna-about (11d)")。

### フレームワークとは何ですか? [](ethna-document-faq-ethna_faq.html#zc1c39ad "zc1c39ad")

狭義には、ユーザ･コードを「呼び出す」クラスライブラリのことです。定型的な処理をパッケージ化しているため、開発者が本質的な機能の開発に集中することができます。また、開発されたアプリケーションの品質が安定しやすくなります。したがって、効率的でかつバグの少ないwebアプリケーションの開発が可能になります。

### 利用にあたり何が必要ですか? [](ethna-document-faq-ethna_faq.html#k8519831 "k8519831")

Ethnaを利用するためには、PHPが実行できるwebサーバおよび開発環境が必要になります。  
またEthnaは以下の3つのクラスライブラリに依存しています\*1のみの依存となりましたが、事実上ので、これらのライブラリがインストールされているかどうかご確認ください。

- PEAR
- PEAR::DB
- Smarty ([[http://smarty.php.net/](http://smarty.php.net/)])

いずれのライブラリに関しても(Ethna自体は)バージョンには依存しません。

PHPバージョンは4.1.2以降をサポートしていますが、4.3.x以降を推奨します(backtraceが取れるので)

### Smartyをインストールしたのに動きません [](ethna-document-faq-ethna_faq.html#m32f4918 "m32f4918")

Ethna以外ではSmartyをちゃんと使えているのに、Ethnaでは

    Fatal error: require_once() [function.require]: Failed opening required 'Smarty/Smarty.class.php'

といったエラーが表示される場合、次のような問題が考えられます。

EthnaはSmartyがinclude\_path以下の "Smarty" ディレクトリにインストールされていることを前提としています。特に、大文字小文字の違いが区別されることに気を付けてください。

Smartyのインストール先もしくは$ETHNA\_HOME/class/Renderer/Ethna\_Smarty\_Renderer.phpの最初のrequire\_once文

    require_once 'Smarty/Smarty.class.php';

の部分を修正してください(この問題は今後改善される予定です)。

- 自分でtar.gzを展開した場合は "smarty/lib/Smarty.class.php" になっていることが多いです。
- pear install pearified/smarty でインストールした場合は、 "Pearified/Smarty/Smarty.class.php" となっています。

### ライセンスは何ですか? [](ethna-document-faq-ethna_faq.html#d1f52301 "d1f52301")

EthnaはBSDライセンスを採用しています。  
詳しくは [こちら](ethna-document-faq-license.html "ethna-document-faq-license (1240d)")をご覧ください。

### インストールはどうやればいいでしょう? [](ethna-document-faq-ethna_faq.html#z4fb2347 "z4fb2347")

[インストールガイド](ethna-document-tutorial-install_guide.html "ethna-document-tutorial-install\_guide (16d)")を参照してください。

### ドキュメントになってない機能をまとめてみました。／スマートな使い方を見つけました。 [](ethna-document-faq-ethna_faq.html#m7ca1700 "m7ca1700")

[開発マニュアル](ethna-document-dev_guide.html "ethna-document-dev\_guide (302d)")に追加していただけるとありがたいです。

### どうしてEthnaという名前なんですか? [](ethna-document-faq-ethna_faq.html#rc214e81 "rc214e81")

- [多分これです](http://www.ff12.com/)

### 開発者は誰ですか? [](ethna-document-faq-ethna_faq.html#bdaf9dfe "bdaf9dfe")

Ethnaのもともとの開発者は藤本真樹です。 [グリー株式会社](http://www.gree.jp)CTOでもあります。ブログは [こちら](http://diary.eth.jp)。

現在はオープンソースとして開発しています．

- [http://sourceforge.jp/projects/ethna/memberlist](http://sourceforge.jp/projects/ethna/memberlist)

これを読んだあなたも是非一緒に開発を:)

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1Ethna-2.3.0からはPEAR::DB, Smartyは必ずしも必要ではなくなりましたが、まだ検証が不十分なところがあります。  

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
