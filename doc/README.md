# Ethnamドキュメント目次

*   [概要](00-intro.md)

##    チュートリアル
*  [インストール](10-install.md)
*  [ディレクトリ解説](11-directories.md)
*  [Hello画面を作成する(アクション、ビュー、テンプレートを追加する)](12-add-action-view-template.md)
*  [実用的なアプリケーション開発 1 ログイン画面](13-login-form.md)
*  [実用的なアプリケーション開発 2 ログイン処理](14-login-do.md)
*  [実用的なアプリケーション開発 3 バリデーションエラー](15-login-validation-error.md)
*  [実用的なアプリケーション開発 4 ビジネスロジック(設計)](16-business-logic.md)
*  [実用的なアプリケーション開発 5 ビジネスロジック(実装)](17-business-logic-actual.md)
*  [Ethnamの内部動作の概要](18-internals.md)

## 開発マニュアル

### 基本編

- [アクション定義](action.md)
- [フォーム定義・入力の自動検証](form.md)
- [遷移先定義、テンプレートの扱い方](forward.md)
- [エラー処理](error.md)

### 応用編

- [セッションを利用する](app-session.md)
- [データベースアクセス](db.md)
- [言語とエンコーディングの設定](app-setlanguage.md)  
言語設定に関する説明です。
- [複数のエントリポイントを作成する](app-multientrypoint.md)  
/index.phpに加えて、/user/index.phpや/admin/index.phpのように複数のエントリポイントを簡単に作ることができます

- [エントリポイント毎に実行可能なアクションを制限する](app-limitentrypoint.md)  
「/admin/index.phpでは管理権限関連のアクションのみを実行する」というように、各エントリポイント毎に実行可能なアクションを制限することができます
- [未定義のアクションがリクエストされた場合に特定のアクションを実行する](app-fallbackentrypoint.md)  
アプリケーションで定義されていない、あるいは許可されていないアクションがリクエストされた場合に、予め指定しておいた特定のアクションを実行させることができます
- [フィルタチェインを使用する](app-filterchain.md)  
TomcatやMojaviにあるようなフィルタチェインを使用することができます
- [ユニットテストを実行する](misc-unittest.md)  
simpletest を利用したユニットテストを行えます。
- [メールを送信する](app-mail.md)  
Ethna_MailSender クラスを利用して、様々な種類のメールを送信できます。
- [二重POSTを防止する](app-duplicatepost.md)  
ブラウザ側で複数回ボタンを押した場合に、それを検知することができます。
- [(ほぼ)スタティックなページを表示させる](app-static.md)
- [アプリケーションの設定ファイル](app-config.md)  
etc/XXXX-ini.php に書く設定値に関する説明です。
- [フォーム定義を動的に変更する](app-dynamicform.md)  
動的に、入力フォームとActionFormの定義を変更したい場合の対処法です。
- [ページャを作成する](misc-pager.md)  
Ethna_Util クラスの getDirectLinkList メソッドを使って容易にページャを追加できます。
- [ログ出力を行う](log.md)  
ログ出力を行う方法と、必要なアプリケーションの設定について説明しています。
- [URLルーティング](urlhandler.md)  
URLHandler と呼ばれる機能を利用すれば、RESTfulなURLを実現できます。
- [Ethnaプロジェクト内で PEAR パッケージを管理する](pearlocal.md)  
ethna コマンドの pear-local コマンドで、プロジェクト毎に独立してPEARパッケージを管理できます。
- [コマンドラインから実行するスクリプトを書く](cli.md)  
バッチ処理など、CLIを使う処理もEthnaで簡単に記述できます。
- [アプリケーションマネージャ](appobj-manager.md)  
  - Webアプリケーションの共通処理を記述するオブジェクトについて説明します。
- [フォームヘルパ](view-form_helper.md)  
テンプレートでフォームタグが簡単にかけるヘルパの説明です。
  - [フォームヘルパ タグリファレンス](view-form_helper-ref.md)  
フォームヘルパで使えるタグのリファレンスです。
  - [フォームヘルパ サンプル集](view-form_helper-samples.md)  
フォームヘルパは強力な分複雑なので、サンプルを集めてみました。
- [プロジェクトの国際化](i18n.md)  
Ethnaプロジェクトを複数の言語に対応(i18n)させる方法を紹介します。

### 拡張編

- Ethnaのプラグイン機構一般
  - [Ethna_Pluginに関する説明(2.3.x, 2.5.0)](plugin.md)
- プラグインを書いてみる
  - [バリデータプラグイン](form-validate_with_plugin.md)
  - [フィルタプラグイン](dev-guide-make-filterplugin.md)
  - [Smartyプラグイン](dev-guide-make-smartyplugin.md)
    - [Ethnaの組込みSmartyプラグイン一覧](view-smarty-plugin.md)  

## 補足
- [".ethna"ファイルについて](dotethna.md)
- [クロスサイトリクエストフォージェリの対策コードについて](csrf.md)
- [FAQ](faq.md)
- [Ethna 2.3から 2.5への移行ガイド](migration_2.3to2.5.md)
- [Ethna 2.1から2.3への移行ガイド](migration_2.1to2.3.md)

## Ethnam本体の開発者向け
*   [リリースルール](90-release.md)
*   [UnitTest](98-unittest.md)
*   [Ethna本家との関係](99-relationship-with-ethna.md)
*   [DocumentのTODO](DOCTODO.md)

## (参考)Ethnaドキュメント
* http://ethna.jp/doc/index.html
* http://ethna.jp/old/
