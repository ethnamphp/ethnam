# ロードマップ - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# ロードマップ 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > ロードマップ 
## ロードマップ [](ethna-document-roadmap.html#u795f0b7 "u795f0b7")

### 2.3.x〜 [](ethna-document-roadmap.html#y4640d3b "y4640d3b")

#### 2.3.0-preview1(2006/07/09) [](ethna-document-roadmap.html#qba96067 "qba96067")

- Ethna\_Plugin追加
- Ethna\_Renderer追加

- Ethna\_Handleのプラグイン対応
- Ethna\_CacheManagerのプラグイン対応

- Ethna\_LogWriterのプラグイン対応

#### 2.3.0-preview2(2006/07/16) [](ethna-document-roadmap.html#ib2ef94a "ib2ef94a")

- (Ethna自体の)UnitTestサポート

- ハードタブをソフトタブに

- Ethna\_ClassFactoryの汎用化
- Ethna\_AppManagerの汎用化(やっぱりやめました→近い将来プラグインのネットワークインストール対応→アプリケーションマネージャ、アプリケーションオブジェクトのネットワークインストール対応、という形で進めていきます)

#### 2.3.0-preview3(2006/07/23) [](ethna-document-roadmap.html#b1e7dab8 "b1e7dab8")

- Ethna\_ActionForm改善
  - フォームレンダリングサポート

- Ethna\_AppObject改善
  - テーブル定義->フォーム定義自動生成
  - 直SQLサポート
  - DB依存改善

- プラグインリポジトリ構築/ネットワークインストール対応

#### それ以降... [](ethna-document-roadmap.html#u26460b0 "u26460b0")

- Ethna\_DBのダサダサ加減を何とかする

- Ethna\_SmartyPluginのプラグイン対応

- ethnaコマンド改善
  - crudアクション一括生成

- Ajaxサポート(+ prototype.js (+ script.aculo.us連携))
  - JSONビュー対応
  - innerHTML対応
  - prototype.js連携
  - (?)script.aculo.us連携

- ビューコンポーネントサポート

- REST対応

- add-projectでプロジェクトの上書き時の挙動をもっと賢く

- PHP 5専用版(Ethna 3.x?)

### 完了 [](ethna-document-roadmap.html#a08e1c2e "a08e1c2e")

- ジェネレータの命名規則修正(先頭の数字禁止)

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
