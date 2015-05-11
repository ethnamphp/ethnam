# 開発マニュアル
実際の開発に必要なドキュメントがまとめてあります。ドキュメントがない部分については順次追加予定です（ユーザの方々によるドキュメントもお待ちしています:）。

### 基本編

- [アクション定義](ethna-document-dev_guide-action.md "ethna-document-dev\_guide-action (1058d)")

- [フォーム定義・入力の自動検証](ethna-document-dev_guide-form.md "ethna-document-dev\_guide-form (1006d)")

- [遷移先定義、テンプレートの扱い方](ethna-document-dev_guide-forward.md "ethna-document-dev\_guide-forward (737d)")

- [エラー処理](ethna-document-dev_guide-error.md "ethna-document-dev\_guide-error (1240d)")

### 応用編

- [セッションを利用する](ethna-document-dev_guide-app-session.md "ethna-document-dev\_guide-app-session (737d)")

- [データベースアクセス](ethna-document-dev_guide-db.md "ethna-document-dev\_guide-db (1240d)")

### 実践編

- [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.md "ethna-document-dev\_guide-app-setlanguage (737d)")  
言語設定に関する説明です。

- [複数のエントリポイントを作成する](ethna-document-dev_guide-app-multientrypoint.md "ethna-document-dev\_guide-app-multientrypoint (1181d)")  
/index.phpに加えて、/user/index.phpや/admin/index.phpのように複数のエントリポイントを簡単に作ることができます

- [エントリポイント毎に実行可能なアクションを制限する](ethna-document-dev_guide-app-limitentrypoint.md "ethna-document-dev\_guide-app-limitentrypoint (706d)")  
「/admin/index.phpでは管理権限関連のアクションのみを実行する」というように、各エントリポイント毎に実行可能なアクションを制限することができます

- [未定義のアクションがリクエストされた場合に特定のアクションを実行する](ethna-document-dev_guide-app-fallbackentrypoint.md "ethna-document-dev\_guide-app-fallbackentrypoint (1240d)")  
アプリケーションで定義されていない、あるいは許可されていないアクションがリクエストされた場合に、予め指定しておいた特定のアクションを実行させることができます

- [フィルタチェインを使用する](ethna-document-dev_guide-app-filterchain.md "ethna-document-dev\_guide-app-filterchain (1240d)")  
TomcatやMojaviにあるようなフィルタチェインを使用することができます

- [ユニットテストを実行する](ethna-document-dev_guide-misc-unittest.md "ethna-document-dev\_guide-misc-unittest (1240d)")  
simpletest を利用したユニットテストを行えます。

- [メールを送信する](ethna-document-dev_guide-app-mail.md "ethna-document-dev\_guide-app-mail (737d)")  
Ethna\_MailSender クラスを利用して、様々な種類のメールを送信できます。

- [二重POSTを防止する](ethna-document-dev_guide-app-duplicatepost.md "ethna-document-dev\_guide-app-duplicatepost (1240d)")  
ブラウザ側で複数回ボタンを押した場合に、それを検知することができます。

- [(ほぼ)スタティックなページを表示させる](ethna-document-dev_guide-app-static.md "ethna-document-dev\_guide-app-static (1240d)")

- [アプリケーションの設定ファイル](ethna-document-dev_guide-app-config.md "ethna-document-dev\_guide-app-config (858d)")  
etc/XXXX-ini.php に書く設定値に関する説明です。

- [フォーム定義を動的に変更する](ethna-document-dev_guide-app-dynamicform.md "ethna-document-dev\_guide-app-dynamicform (182d)")  
動的に、入力フォームとActionFormの定義を変更したい場合の対処法です。

- [ページャを作成する](ethna-document-dev_guide-misc-pager.md "ethna-document-dev\_guide-misc-pager (738d)")  
Ethna\_Util クラスの getDirectLinkList メソッドを使って容易にページャを追加できます。

- [ログ出力を行う](ethna-document-dev_guide-log.md "ethna-document-dev\_guide-log (874d)")  
ログ出力を行う方法と、必要なアプリケーションの設定について説明しています。

- [URLルーティング](ethna-document-dev_guide-urlhandler.md "ethna-document-dev\_guide-urlhandler (926d)")  
URLHandler と呼ばれる機能を利用すれば、RESTfulなURLを実現できます。

- [Ethnaプロジェクト内で PEAR パッケージを管理する](ethna-document-dev_guide-pearlocal.md "ethna-document-dev\_guide-pearlocal (858d)")  
ethna コマンドの pear-local コマンドで、プロジェクト毎に独立してPEARパッケージを管理できます。

- [コマンドラインから実行するスクリプトを書く](ethna-document-dev_guide-cli.md "ethna-document-dev\_guide-cli (512d)")  
バッチ処理など、CLIを使う処理もEthnaで簡単に記述できます。

- [ethnaコマンドリファレンス](ethna-document-dev_guide-ethna_command.md "ethna-document-dev\_guide-ethna\_command (520d)")  
プロジェクトに対して様々な操作を行う ethnaコマンドの操作一覧です。

### 発展編

- [アプリケーションマネージャ](ethna-document-dev_guide-appobj-manager.md "ethna-document-dev\_guide-appobj-manager (965d)")  

  - Webアプリケーションの共通処理を記述するオブジェクトについて説明します。

- [フォームヘルパ](ethna-document-dev_guide-view-form_helper.md "ethna-document-dev\_guide-view-form\_helper (998d)")  
テンプレートでフォームタグが簡単にかけるヘルパの説明です。
  - [フォームヘルパ タグリファレンス](ethna-document-dev_guide-view-form_helper-ref.md "ethna-document-dev\_guide-view-form\_helper-ref (999d)")  
フォームヘルパで使えるタグのリファレンスです。
  - [フォームヘルパ サンプル集](ethna-document-dev_guide-view-form_helper-samples.md "ethna-document-dev\_guide-view-form\_helper-samples (999d)")  
フォームヘルパは強力な分複雑なので、サンプルを集めてみました。

- [プロジェクトの国際化](ethna-document-dev_guide-i18n.md "ethna-document-dev\_guide-i18n (737d)")  
Ethnaプロジェクトを複数の言語に対応(i18n)させる方法を紹介します。

### 拡張編

- Ethnaのプラグイン機構一般
  - [Ethna\_Pluginに関する説明(2.3.x, 2.5.0)](ethna-document-dev_guide-plugin.md "ethna-document-dev\_guide-plugin (737d)")

- プラグインを書いてみる
  - [バリデータプラグイン](ethna-document-dev_guide-form-validate_with_plugin.md "ethna-document-dev\_guide-form-validate\_with\_plugin (513d)")
  - [フィルタプラグイン](ethna-document-dev-guide-make-filterplugin.md "ethna-document-dev-guide-make-filterplugin (737d)")
  - [Smartyプラグイン](ethna-document-dev-guide-make-smartyplugin.md "ethna-document-dev-guide-make-smartyplugin (737d)")
    - [Ethnaの組込みSmartyプラグイン一覧](ethna-document-dev_guide-view-smarty-plugin.md "ethna-document-dev\_guide-view-smarty-plugin (737d)")  

### 補足編
  
- [スクリプトを1ファイルに統合する](ethna-document-dev_guide-misc-unify.md "ethna-document-dev\_guide-misc-unify (1240d)")  
ファイルシステムへの負荷を低減したい場合、全てのスクリプトを1ファイルに統合することも出来ます

- [".ethna"ファイルについて](ethna-document-dev_resourcefile.md "ethna-document-dev\_resourcefile (1240d)")

- [クロスサイトリクエストフォージェリの対策コードについて](ethna-document-dev_guide-csrf.md "ethna-document-dev\_guide-csrf (1240d)")

- [開発FAQ](ethna-document-faq-dev_guide_faq.md "ethna-document-faq-dev\_guide\_faq (155d)")**
