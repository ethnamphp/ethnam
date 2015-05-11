# 開発マニュアル

### 基本編

- [アクション定義](dev_guide-action.md)
- [フォーム定義・入力の自動検証](dev_guide-form.md)
- [遷移先定義、テンプレートの扱い方](dev_guide-forward.md)
- [エラー処理](dev_guide-error.md)

### 応用編

- [セッションを利用する](dev_guide-app-session.md)
- [データベースアクセス](dev_guide-db.md)

### 実践編

- [言語とエンコーディングの設定](dev_guide-app-setlanguage.md)  
言語設定に関する説明です。
- [複数のエントリポイントを作成する](dev_guide-app-multientrypoint.md)  
/index.phpに加えて、/user/index.phpや/admin/index.phpのように複数のエントリポイントを簡単に作ることができます

- [エントリポイント毎に実行可能なアクションを制限する](dev_guide-app-limitentrypoint.md)  
「/admin/index.phpでは管理権限関連のアクションのみを実行する」というように、各エントリポイント毎に実行可能なアクションを制限することができます
- [未定義のアクションがリクエストされた場合に特定のアクションを実行する](dev_guide-app-fallbackentrypoint.md)  
アプリケーションで定義されていない、あるいは許可されていないアクションがリクエストされた場合に、予め指定しておいた特定のアクションを実行させることができます
- [フィルタチェインを使用する](dev_guide-app-filterchain.md)  
TomcatやMojaviにあるようなフィルタチェインを使用することができます
- [ユニットテストを実行する](dev_guide-misc-unittest.md)  
simpletest を利用したユニットテストを行えます。
- [メールを送信する](dev_guide-app-mail.md)  
Ethna\_MailSender クラスを利用して、様々な種類のメールを送信できます。
- [二重POSTを防止する](dev_guide-app-duplicatepost.md)  
ブラウザ側で複数回ボタンを押した場合に、それを検知することができます。
- [(ほぼ)スタティックなページを表示させる](dev_guide-app-static.md)
- [アプリケーションの設定ファイル](dev_guide-app-config.md)  
etc/XXXX-ini.php に書く設定値に関する説明です。
- [フォーム定義を動的に変更する](dev_guide-app-dynamicform.md)  
動的に、入力フォームとActionFormの定義を変更したい場合の対処法です。
- [ページャを作成する](dev_guide-misc-pager.md)  
Ethna\_Util クラスの getDirectLinkList メソッドを使って容易にページャを追加できます。
- [ログ出力を行う](dev_guide-log.md)  
ログ出力を行う方法と、必要なアプリケーションの設定について説明しています。
- [URLルーティング](dev_guide-urlhandler.md)  
URLHandler と呼ばれる機能を利用すれば、RESTfulなURLを実現できます。
- [Ethnaプロジェクト内で PEAR パッケージを管理する](dev_guide-pearlocal.md)  
ethna コマンドの pear-local コマンドで、プロジェクト毎に独立してPEARパッケージを管理できます。
- [コマンドラインから実行するスクリプトを書く](dev_guide-cli.md)  
バッチ処理など、CLIを使う処理もEthnaで簡単に記述できます。
- [ethnaコマンドリファレンス](dev_guide-ethna_command.md)  
プロジェクトに対して様々な操作を行う ethnaコマンドの操作一覧です。

### 発展編

- [アプリケーションマネージャ](dev_guide-appobj-manager.md)  
  - Webアプリケーションの共通処理を記述するオブジェクトについて説明します。
- [フォームヘルパ](dev_guide-view-form_helper.md)  
テンプレートでフォームタグが簡単にかけるヘルパの説明です。
  - [フォームヘルパ タグリファレンス](dev_guide-view-form_helper-ref.md)  
フォームヘルパで使えるタグのリファレンスです。
  - [フォームヘルパ サンプル集](dev_guide-view-form_helper-samples.md)  
フォームヘルパは強力な分複雑なので、サンプルを集めてみました。
- [プロジェクトの国際化](dev_guide-i18n.md)  
Ethnaプロジェクトを複数の言語に対応(i18n)させる方法を紹介します。

### 拡張編

- Ethnaのプラグイン機構一般
  - [Ethna\_Pluginに関する説明(2.3.x, 2.5.0)](dev_guide-plugin.md)
- プラグインを書いてみる
  - [バリデータプラグイン](dev_guide-form-validate_with_plugin.md)
  - [フィルタプラグイン](dev-guide-make-filterplugin.md)
  - [Smartyプラグイン](dev-guide-make-smartyplugin.md)
    - [Ethnaの組込みSmartyプラグイン一覧](dev_guide-view-smarty-plugin.md)  

### 補足編
- [".ethna"ファイルについて](dev_resourcefile.md)
- [クロスサイトリクエストフォージェリの対策コードについて](dev_guide-csrf.md)
- [開発FAQ](faq-dev_guide_faq.md)
