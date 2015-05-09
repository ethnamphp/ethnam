<title>
開発マニュアル - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# 開発マニュアル 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > 開発マニュアル 
## 開発マニュアル [](ethna-document-dev_guide.html#kae62ae1 "kae62ae1")

実際の開発に必要なドキュメントがまとめてあります。ドキュメントがない部分については順次追加予定です（ユーザの方々によるドキュメントもお待ちしています:）。

### 基本編 [](ethna-document-dev_guide.html#b6964420 "b6964420")

- [アクション定義](ethna-document-dev_guide-action.html "ethna-document-dev\_guide-action (1058d)")

- [フォーム定義・入力の自動検証](ethna-document-dev_guide-form.html "ethna-document-dev\_guide-form (1006d)")

- [遷移先定義、テンプレートの扱い方](ethna-document-dev_guide-forward.html "ethna-document-dev\_guide-forward (737d)")

- [エラー処理](ethna-document-dev_guide-error.html "ethna-document-dev\_guide-error (1240d)")

### 応用編 [](ethna-document-dev_guide.html#r2abfb5a "r2abfb5a")

- [セッションを利用する](ethna-document-dev_guide-app-session.html "ethna-document-dev\_guide-app-session (737d)")

- [データベースアクセス](ethna-document-dev_guide-db.html "ethna-document-dev\_guide-db (1240d)")

### 実践編 [](ethna-document-dev_guide.html#if8219fa "if8219fa")

- [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.html "ethna-document-dev\_guide-app-setlanguage (737d)")  
言語設定に関する説明です。

- [複数のエントリポイントを作成する](ethna-document-dev_guide-app-multientrypoint.html "ethna-document-dev\_guide-app-multientrypoint (1181d)")  
/index.phpに加えて、/user/index.phpや/admin/index.phpのように複数のエントリポイントを簡単に作ることができます

- [エントリポイント毎に実行可能なアクションを制限する](ethna-document-dev_guide-app-limitentrypoint.html "ethna-document-dev\_guide-app-limitentrypoint (706d)")  
「/admin/index.phpでは管理権限関連のアクションのみを実行する」というように、各エントリポイント毎に実行可能なアクションを制限することができます

- [未定義のアクションがリクエストされた場合に特定のアクションを実行する](ethna-document-dev_guide-app-fallbackentrypoint.html "ethna-document-dev\_guide-app-fallbackentrypoint (1240d)")  
アプリケーションで定義されていない、あるいは許可されていないアクションがリクエストされた場合に、予め指定しておいた特定のアクションを実行させることができます

- [フィルタチェインを使用する](ethna-document-dev_guide-app-filterchain.html "ethna-document-dev\_guide-app-filterchain (1240d)")  
TomcatやMojaviにあるようなフィルタチェインを使用することができます

- [ユニットテストを実行する](ethna-document-dev_guide-misc-unittest.html "ethna-document-dev\_guide-misc-unittest (1240d)")  
simpletest を利用したユニットテストを行えます。

- [メールを送信する](ethna-document-dev_guide-app-mail.html "ethna-document-dev\_guide-app-mail (737d)")  
Ethna\_MailSender クラスを利用して、様々な種類のメールを送信できます。

- [二重POSTを防止する](ethna-document-dev_guide-app-duplicatepost.html "ethna-document-dev\_guide-app-duplicatepost (1240d)")  
ブラウザ側で複数回ボタンを押した場合に、それを検知することができます。

- [(ほぼ)スタティックなページを表示させる](ethna-document-dev_guide-app-static.html "ethna-document-dev\_guide-app-static (1240d)")

- [アプリケーションの設定ファイル](ethna-document-dev_guide-app-config.html "ethna-document-dev\_guide-app-config (858d)")  
etc/XXXX-ini.php に書く設定値に関する説明です。

- [フォーム定義を動的に変更する](ethna-document-dev_guide-app-dynamicform.html "ethna-document-dev\_guide-app-dynamicform (182d)")  
動的に、入力フォームとActionFormの定義を変更したい場合の対処法です。

- [ページャを作成する](ethna-document-dev_guide-misc-pager.html "ethna-document-dev\_guide-misc-pager (738d)")  
Ethna\_Util クラスの getDirectLinkList メソッドを使って容易にページャを追加できます。

- [ログ出力を行う](ethna-document-dev_guide-log.html "ethna-document-dev\_guide-log (874d)")  
ログ出力を行う方法と、必要なアプリケーションの設定について説明しています。

- [URLルーティング](ethna-document-dev_guide-urlhandler.html "ethna-document-dev\_guide-urlhandler (926d)")  
URLHandler と呼ばれる機能を利用すれば、RESTfulなURLを実現できます。

- [Ethnaプロジェクト内で PEAR パッケージを管理する](ethna-document-dev_guide-pearlocal.html "ethna-document-dev\_guide-pearlocal (858d)")  
ethna コマンドの pear-local コマンドで、プロジェクト毎に独立してPEARパッケージを管理できます。

- [コマンドラインから実行するスクリプトを書く](ethna-document-dev_guide-cli.html "ethna-document-dev\_guide-cli (512d)")  
バッチ処理など、CLIを使う処理もEthnaで簡単に記述できます。

- [ethnaコマンドリファレンス](ethna-document-dev_guide-ethna_command.html "ethna-document-dev\_guide-ethna\_command (520d)")  
プロジェクトに対して様々な操作を行う ethnaコマンドの操作一覧です。

### 発展編 [](ethna-document-dev_guide.html#ie30054e "ie30054e")

- [アプリケーションオブジェクト](ethna-document-dev_guide-appobj-overview.html "ethna-document-dev\_guide-appobj-overview (273d)")
  - 機能は弱いながら、ORマッピングのようなものを提供します。
- [アプリケーションマネージャ](ethna-document-dev_guide-appobj-manager.html "ethna-document-dev\_guide-appobj-manager (965d)")  

  - Webアプリケーションの共通処理を記述するオブジェクトについて説明します。

- [フォームヘルパ](ethna-document-dev_guide-view-form_helper.html "ethna-document-dev\_guide-view-form\_helper (998d)")  
テンプレートでフォームタグが簡単にかけるヘルパの説明です。
  - [フォームヘルパ タグリファレンス](ethna-document-dev_guide-view-form_helper-ref.html "ethna-document-dev\_guide-view-form\_helper-ref (999d)")  
フォームヘルパで使えるタグのリファレンスです。
  - [フォームヘルパ サンプル集](ethna-document-dev_guide-view-form_helper-samples.html "ethna-document-dev\_guide-view-form\_helper-samples (999d)")  
フォームヘルパは強力な分複雑なので、サンプルを集めてみました。

- [プロジェクトの国際化](ethna-document-dev_guide-i18n.html "ethna-document-dev\_guide-i18n (737d)")  
Ethnaプロジェクトを複数の言語に対応(i18n)させる方法を紹介します。

### 拡張編 [](ethna-document-dev_guide.html#paea4153 "paea4153")

- Ethnaのプラグイン機構一般
  - [Ethna\_Pluginに関する説明(2.3.x, 2.5.0)](ethna-document-dev_guide-plugin.html "ethna-document-dev\_guide-plugin (737d)")

- プラグインを書いてみる
  - [バリデータプラグイン](ethna-document-dev_guide-form-validate_with_plugin.html "ethna-document-dev\_guide-form-validate\_with\_plugin (513d)")
  - [フィルタプラグイン](ethna-document-dev-guide-make-filterplugin.html "ethna-document-dev-guide-make-filterplugin (737d)")
  - [Smartyプラグイン](ethna-document-dev-guide-make-smartyplugin.html "ethna-document-dev-guide-make-smartyplugin (737d)")
    - [Ethnaの組込みSmartyプラグイン一覧](ethna-document-dev_guide-view-smarty-plugin.html "ethna-document-dev\_guide-view-smarty-plugin (737d)")  

### 補足編 [](ethna-document-dev_guide.html#p5423fcb "p5423fcb")

- 古いプロジェクトを新しいEthnaに対応させる  
古いバージョンのEthnaで作ったプロジェクトを新しいバージョンに対応させるガイドです。
  - [Ethna 2.5.x から 2.6.0 への移行ガイド (準備中)](ethna-document-dev_guide-misc-migrate_project250to260.html "ethna-document-dev\_guide-misc-migrate\_project250to260 (157d)")
  - [Ethna 2.3.x から 2.5.0 への移行ガイド](ethna-document-dev_guide-misc-migrate_project230to250.html "ethna-document-dev\_guide-misc-migrate\_project230to250 (737d)")
  - [Ethna 2.1.x から 2.3.0 への移行ガイド](ethna-document-dev_guide-misc-migrate_project210to230.html "ethna-document-dev\_guide-misc-migrate\_project210to230 (1217d)")  
  
- [スクリプトを1ファイルに統合する](ethna-document-dev_guide-misc-unify.html "ethna-document-dev\_guide-misc-unify (1240d)")  
ファイルシステムへの負荷を低減したい場合、全てのスクリプトを1ファイルに統合することも出来ます

- [設定情報や定義済みアクション等を一覧する](ethna-document-dev_guide-misc-info.html "ethna-document-dev\_guide-misc-info (1240d)")  
バージョン0.1.2で追加された\_\_ethna\_info\_\_アクションを利用することで、設定情報や定義したアクションやビューの状態を一覧することが出来ます

- [EthnaでShift\_JISなサイトを作る](ethna-document-dev_guide-app-sjis.html "ethna-document-dev\_guide-app-sjis (1240d)")

- [".ethna"ファイルについて](ethna-document-dev_resourcefile.html "ethna-document-dev\_resourcefile (1240d)")

- [クロスサイトリクエストフォージェリの対策コードについて](ethna-document-dev_guide-csrf.html "ethna-document-dev\_guide-csrf (1240d)")

## 開発FAQ [](ethna-document-dev_guide.html#kca6d8b4 "kca6d8b4")

開発に関するFAQはこちらをご覧ください。

**[開発FAQ](ethna-document-faq-dev_guide_faq.html "ethna-document-faq-dev\_guide\_faq (155d)")**

## その他 [](ethna-document-dev_guide.html#la427e0f "la427e0f")

- [リリース手順](ethna-document-misc-release.html "ethna-document-misc-release (855d)")

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
