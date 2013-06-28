変更点一覧
==================

2.6.0
---------

* Ethna 2.5.0 preview5 に含まれていて、Ethna 2.5.0 に含まれなかった変更点について、CHANGES の整理 (多少重複します)

features
^^^^^^^^

Ethna本体に関する変更点
  * [Breaking B.C] PHP 5.3 対応のための変更 (B.C. PHP 4 非対応となります)

    * 非推奨シンタックスの除去 (Remove DEPRECATED syntax)
    * 不要な参照渡し($obj =& new)をやめました。
    * アクセス修飾子、static修飾子の導入
    * コンストラクタメソッド名の変更(クラス名から__construct()へ)

    * ファイル名を短くしました。(例 class/Ethna_ActionClass.php -> class/ActionClass.php)
  * skeleton 関係のファイルを変更しました。
  * UrlHandler と .htaccess (mod_rewrite) を利用するためのひな形を生成
  * セッションハンドラのなど，セッションに関する設定の変更をするための記述を APPID-ini.php にできるようになりました．
DB に関する変更点
  * これまではADOdbのみで使われていたDSNのパースを、公式スペックとしました(PEAR_DBには直接渡されていたため)。ただし、このパーサが使われるかどうかは各DBドライバに依存します。

  * Creole 削除
UrlHandler に関する変更点
  * path_regexp が定義されている場合、path の定義は必須ではなくなりました (sf#19237)
  * UrlHandler_Simple という軽量 UrlHandler を同梱しました (thx. riaf #17 on GitHub)

Renderer/View に関する変更点
  * Smarty3 追加
  * Rhaco 削除
  * 汎用ビュークラスを実装
  * レイアウトテンプレートを実装

    * HTMLの外側に当たる雛形のテンプレートを描くためのもの。各アクションの出力はこのテンプレートの出力でラップされる
    * デフォルトは template/{locale_name}/layout.tpl に置かれている。
    * この機能はデフォルトで有効になっている。無効にしたければ、[appid]_ViewClass.php の $use_layout を false にする(既存プロジェクトをEthna 2.6に移行する場合、こうすれば動作するはず)

  * PROJECT_DIR/lib/Ethna/extlib/Plugin/Smarty  をデフォルトでSmartyプラグインディレクトリに指定するように，skel に追加
  * renderer の設定を config に書けるようになりました (一部、かつ、実装は renderer 依存)

    * Smarty2 の場合 'smarty', Smarty3 の場合 'smarty3' をキーとした配列に、left/right delimiter の設定を記述できます
    * 'path' として、include するファイルの path を指定できるようになりました
    * Ethna Info は、Smarty2 を利用するため、Smarty3 を使う場合でも Ethna Info を見るみは Smarty2 が必要です

  * Ethna_Renderer の仕様変更 (Breaking B.C.)

    * レンダラとしての Ethna_Renderer の仕様変更

      * Smarty 以外にも実は PHP などで利用できる Ethna_Renderer でしたが、以下のように仕様を変更しました。
      * テンプレートは何度でも render 可能になりました (これまで include_once だったので1度しか render できませんでした)
      * setProp() された変数(assignされた変数) は、$assign名 でアクセスできるようになりました。

    * レンダラエンジンの親クラスとしての Ethna_Renderer (Renderer プラグイン開発者向け情報)

      * 今後エンジンは getName() を実装し、エンジン名を返す必要があります
      * Renderer の $config プロパティには、iniで定義された配列 $config の、$config['renderer'][エンジン名] が入ります

プラグイン機構に関する変更点
  * Ethna_Plugin::import という，プラグインソースをincludeするための，staticメソッドを追加．
  * すべてのPluginの基底となる抽象クラス，Ethna_Plugin_Abstractを追加

    * 既存のプラグインの親クラスを，Ethna_Plugin_Abstract を継承するように変更
    * Plugin に設定を受け渡す方法を変更したため，etcのskelを変更。
    * また、それに伴い，Ethna_Plugin_Cachemanager_Memcacheの設定方法を変更

  * Ethna_Plugin_Cachemanager に config からデフォルト の namespace を指定可能とした
  * pecl::memcached 版に対応した Ethna_Plugin_Cachemanager_Memcached のバンドル

  * [Breaking B.C] プラグインに関する変更
  * [Breaking B.C] プラグインから名前空間を除去することで、複数アプリケーションでの利用を可能に

    * 検索用のアプリケーションIDを削除した
    * ファイル名の命名規則を変更
    * extlibの設置

  * プラグイン関連のethnaコマンドを整理

    * channel-update (削除)
    * info-plugin (削除)
    * install-plugin (削除)
    * uninstall-plugin (削除)
    * upgrade-plugin (削除)
    * list-plugin (削除)

  * ethna create-plugin コマンドの出力から ethna make-plugin-package を実行できるようにコマンドを再実装

    * これにより、複数のプラグインを含んだパッケージの作成が可能に

  * Debugtoolbar同梱 (extlibのサンプルとして。本体に取り込むほどのクオリティでもないためこちらに追加)

その他の変更
  * Config に URL が設定されていない場合、アクセスされたURLから自動的に検出されるようになりました。(Ethna_Util::getUrlFromRequestUri())

