<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
Ethna オフラインミーティング @Cake開発合宿 - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# Ethna オフラインミーティング @Cake開発合宿 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ethna-yakiniku](ethna-yakiniku.html) > [ethna-yakiniku-cakephp](ethna-yakiniku-cakephp.html) > [ethna-yakiniku-cakephp-onsen](ethna-yakiniku-cakephp-onsen.html) > Ethna オフラインミーティング @Cake開発合宿 
## Ethna オフラインミーティング @Cake開発合宿 [](ethna-yakiniku-cakephp-onsen-20090411.html#qc9871a1 "qc9871a1")

箱根で行われた CakePHP 開発合宿にて、Ethnaのコミッタが集う機会がありました。その際に行われた議論を以下に残しておきます。

- Ethna オフラインミーティング @Cake開発合宿 
  - Ethna\_ActionForm#validate + フィルタの実行タイミング 
  - JavaScript の連携 
  - フォームヘルパについて 
  - ドキュメント 
  - プラグイン読み込み順序の変更 
  - tarball 配布パッケージ化 
  - 複数定義にまたがる ActionForm 定義の記述法 
  - skel ファイルの命名規則 
  - 拡張子を判断した View の挙動変更 
  - ViewHelper の汎用化 
  - 各自の作業内容 
    - mumumu 
    - sotarok 
    - ichii386 
    - maru\_cc 

| 書いた人 | mumumu | 2009-04-11 | 新規作成 |

### Ethna\_ActionForm#validate + フィルタの実行タイミング [](ethna-yakiniku-cakephp-onsen-20090411.html#j636dd2a "j636dd2a")

- 現在はActionFormのvalidateメソッド実行時に、filter定義を実行してから、validateを実行している。
  - このフィルタ実行のタイミングはもっとユーザが制御できてもいいのではないか
  - validateせずにfilter定義のみを実行したいというニーズもあるはず
  - フィルタ処理をメソッドとして独立させればよいのではないか

### JavaScript の連携 [](ethna-yakiniku-cakephp-onsen-20090411.html#hd331d23 "hd331d23")

- JavaScriptの連携がもっとあってもいいはず
  - js ファイルが定義されていたら勝手にincludeしてくれるとか

### フォームヘルパについて [](ethna-yakiniku-cakephp-onsen-20090411.html#m5e4e31c "m5e4e31c")

- {form} で生成されるタグにid属性つけてもよくね？
  - それは配列を使うフォームでおかしくなる場合がある（CHECKBOX, RADIO等）のでやらない
- booleanなcheckboxをuncheckedでpostしてもpostされない(?)ので、default値を設定するとそれで上書きされてしまう

### ドキュメント [](ethna-yakiniku-cakephp-onsen-20090411.html#kd6667c4 "kd6667c4")

- entrypoint, configのurl, mod\_rewriteとかの設定のサンプル
- 環境差異の設定サンプル

### プラグイン読み込み順序の変更 [](ethna-yakiniku-cakephp-onsen-20090411.html#r40239ae "r40239ae")

これは，やる． extlibディレクトリの配置とか．(sotarok)

- [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=15930](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15930)

### tarball 配布パッケージ化 [](ethna-yakiniku-cakephp-onsen-20090411.html#qd14e4a0 "qd14e4a0")

(sotarok) これも，やる

- [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=15931](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15931)

### 複数定義にまたがる ActionForm 定義の記述法 [](ethna-yakiniku-cakephp-onsen-20090411.html#g7c80511 "g7c80511")

- required\_if とか(sotarok)
- DBが絡むものは手をつけない．とりあえずaf内でできることだけ

### skel ファイルの命名規則 [](ethna-yakiniku-cakephp-onsen-20090411.html#j95bdcb3 "j95bdcb3")

決定したい．

- skel/action.foo.php
- skel/view.foo.php とかとか

### 拡張子を判断した View の挙動変更 [](ethna-yakiniku-cakephp-onsen-20090411.html#ub051872 "ub051872")

たとえば， [http://example.com/hoge/fuga](http://example.com/hoge/fuga) などでは，デフォルトのヘッダとデフォルトのテンプレート (たとえば， fuga.tpl) で， [http://example.com/hoge/fuga.js](http://example.com/hoge/fuga.js) でアクセスすると， js用のヘッダ，fuga.js.tpl を探す，など．

URLハンドラーがかかってくるのでURLハンドラーの変更のがあってからかな？と． 案くらいはまとめたい

### ViewHelper の汎用化 [](ethna-yakiniku-cakephp-onsen-20090411.html#scdcca2b "scdcca2b")

ViewHelperが現状は Smartyプラグインとして実装されているため、他の Rendererに変更しづらい ViewHelperの機能は、ViewHelperとして個別のプラグインに分割する Smartyのプラグインとしての register 方法は要検討 ＞Smartyを継承して プラグインサーチの方法を拡張する？

### 各自の作業内容 [](ethna-yakiniku-cakephp-onsen-20090411.html#o495e13e "o495e13e")

#### mumumu [](ethna-yakiniku-cakephp-onsen-20090411.html#v194d4b2 "v194d4b2")

- Ethna Viewまわりの改善(4/11中に済ませる,required)
- 動的フォームAPIの追加(フォームヘルパ用, required)
- チケット潰し(required)
- ORMの改善（optional)

#### sotarok [](ethna-yakiniku-cakephp-onsen-20090411.html#zef61a13 "zef61a13")

- プラグイン読み込み順序の変更
- tarball 配布パッケージ化
- 複数定義にまたがる ActionForm 定義の記述法
- book.ethna.jp は仕様きめて作り出す

#### ichii386 [](ethna-yakiniku-cakephp-onsen-20090411.html#e19afa31 "e19afa31")

- 現状にcatch up
- ドキュメント整備(catch upしつつ)
- <select>のoptgroup対応

#### maru\_cc [](ethna-yakiniku-cakephp-onsen-20090411.html#a5708eb8 "a5708eb8")

- 新規プロジェクト時のエントリポイントのフルパスを相対パスに
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16089](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16089)
- add-entry-point の挙動も要変更ではないか？
  - あと、作成すると同盟の actionを作ろうとするのは変なのでは？
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16102](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16102)
- Ethna\_Renderer\_Php.php Ethna\_Renderer\_Flexy.php とか
  - Smartyプラグインにべったりな部分を ViewHelperとして切り出したい
  - プラグインの仕様変更の話が出たのでそれ次第
- ethnaコマンドが縦に長すぎる件をなんとかする
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16093](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16093)
- 存在しない action名を指定された場合に app/action 以下を全includeをなんとかしたい
  - テストがapp/action以下にあることも関係しているが、不正なアクセス時に全ファイル読み込みという状況が発生してしまっている
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16094](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16094)
- testを別ディレクトリ、appと並列なtestディレクトリに移動したい
- add-project 時に、APPIDのディレクトリを自動作成する挙動を無くしたい
  - APPIDを固定にしようかという話が議題に出ていまして、それにも関係するかと思ってます
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16103](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16103)
- APPID\_Controller.php から var $smarty\_xxx\_plugin 関連の定義を消したい
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16107](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16107)

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
