# 変更点一覧
## 2.20での変更点
* [core] 文字コードをutf8のみサポートするようにしました。
* [plugin] EUC_JP用の文字列長バリデーション(strmaxcpmat, strmincompat)は廃止しました。


## 2.19での変更点
* [core] mbstringモジュールを必須要件としました。
* [core] system_encoding変数は使われていなかったので廃止しました。
* [core] その他、language/encodingまわりの無駄なメソッドを削除しました。
* [mail] (B.C.) MailSenderがcharset=utf8でメール送信するようになりました。内部エンコーディングがUTF-8になっているのを前提としています。

## 2.18での変更点
* [core] ethna.sh周りをシンプル化。ethna_handle.phpをcommand.phpにリネームし、中身をEthna_Commandクラスに移動。
* [plugin] PEARのパッケージを管理する機能を削除
* [plugin] クラス名がわかりにくかったので変更('Handle' -> 'Subcommand')
* [test] Travis-ci を使うようにしました。
* [core] class/ ディレクトリを廃止しました。(B.C.)


## 2.17での変更点
* [core]「アクション定義」機能を廃止しました。古い仕組みでほとんど使われていなかったため。( #21 )

## 2.15から2.16への変更点
* [core] ActionFormで、$form_templateと$formをマージするロジックを変更しました。( #20 )

## 2.14から2.15への変更点
* [i18n] バリデーションエラーメッセージで、form_nameにi18n変換が適用されるようになりました。
* [i18n] form_submitのvalueでi18n変換が適用されるようになりました。

## 2.13から2.14への変更点
* [config] 設定ファイル名を`{$appid}-ini.php`から`config.php`に変更しました。

## 2.12から2.13への変更点
* [log] ログファイル名のデフォルトを`{$appid}.log`から`app.log`に変更しました。
* [core] クラスファイルの置き場所のディレクトリを`class`から`src`に変更しました。(PSR4に準拠させるための準備)
* [core] Packagistに公開しました！

## 2.11から2.12への変更点
* [core] composerでインストールできるようになりました。
* [core] PHP5.3のサポートを廃止しました。
* [i18n] Form定義の'name'がバリデーションエラーの際にi18n適用されるようになりました。
* [i18n] Form定義の'option'でi18n変換が適用されるようになりました。


## 2.10から2.11への変更点

* Managerを$weak=trueで呼び出す機能を削除しました。
* Managerを自動でincludeしなくなりました。自前でオートロードしてください。
* Ethna_MailSenderのpreg_replace eを修正しました。

## 2.9から2.10への変更点

* RendererクラスでSmartyをロードしなくなりました。Appid_ControllerでSmartyをrequireするか、自前でオートロードしてください。
* SOAP Gatewayを廃止しました。
* Ethna_DB_PEARを廃止しました。
* Ethna_Controllerでpreg_matchがPHP5.5でDEPRECATEDになるのを修正しました。

## 2.8から2.9への変更点

* Backend#performを Controller#performへ引っ越ししました。
* ActionClassからViewClassにパラメータを渡す機能を廃止しました。
* E_DEPRECATED エラーを拾えるようにしました。(E_USER_DEPRECATEDについては未対応)
* Smarty のi18n modifierで引数を渡してsprintf的に使えるようになりました。(see Plugin/Smarty/modifier.i18n.php)
* GATEWAY_XMLRPCを廃止。
* UnitTestMamger, InfoMangerを廃止
* インストール方法をREADME.mdに書きました。

## 2.7から2.8への変更点

* AppObject, AppSQL, AppSearchObjectを廃止しました。[[e871a1a](https://github.com/DQNEO/ethnam/commit/e871a1addafae0314bd62dfc8a3e209359ac4a2f)]
* Windowsサポートを廃止しました。[[4ec5802](https://github.com/DQNEO/ethnam/commit/4ec580224232122b29a2a9ccf5824bf8d985f424)]

## Ethna 2.6(beta4)からEthnam 2.7への変更点

* Ethnaコア
 * PHP5.4に対応しました。(主な変更はhtmlspecialcharsの第三引数です。)
 * インストール方法が変わりました。(pear installはできなくなりました。)
 * 主なプロパティ・メソッドでprivate,protected だったものをpublicにしました。これはEthna2.5との後方互換を確保するためです。
 * ActionFormの配列バリデーション, {form ..}, {form_input ..},などの仕様を古い(2.3.5あたり?)状態に戻しました。 [[cc6d63e](https://github.com/DQNEO/ethnam/commit/cc6d63eae1a615b3868e309ff53fd77414bbd4c7)]
 * bin/ethna.batを廃止しました。今後、Windowsは推奨環境から外れます。
 * PHP4の名残であった参照の&を除去しました。
 * EthnaManagerを廃止しました。
 * `__ethna_info__`, `__ethna_unittest__`を廃止しました。
 * 設定ファイル(etc/{appid}_ini.php)が存在しないときに自動で作成する機能を廃止しました。
 * 雑多なコンテンツファイルを補完するためのresourcesディレクトリを追加
 * Ethna本体がinclude_pathに置いてなくても(なるべく)大丈夫なように改善しました。
* プラグインまわり
 * Puginの命名規則を2.5に近い状態に戻しました。プラグインのクラス名で2.5と同じようにAppIDが使えます。(例：Project_Plugin_Cachemanager_Memcache)
 * extlibを廃止しました。
 * Ethna_Plugin_Abstractを廃止しました。これによりプラグインの基底クラスはなくなりました。
 * CacheManager_LocalFileでsafeモードを無視するようにしました。
* ログ関連
 * Ethna_ActionError#AddError()した際のログ出力をLOG_NOTICE -> LOG_INFO に変更しました。
 * ADODBのログ出力処理をオーバーライドできるようにしました。(`ethna_adodb_logger`というグローバル関数内で処理がべた書きされていたのを改善)
 * ログファイルにメモリ使用量を記録するようにしました。
 * ログファイルに現在時刻をミリ秒単位まで記録するようにしました。
 * Validationのログをもう少し詳細に出すようにしました。
* テンプレート関連
 * Smartyがテンプレートを出力する際に、メモリ使用量をHTTPヘッダ(`X-MemoryUsage`)で出力するようにしました。
 * HTML5の`<input type="email">`に対応しました。(あくまで当座しのぎ的)
* セッション関連
 * check_remote_addrをデフォルトで無効にしました。
* その他
 * `adodb/adodb.inc.php`をEthna側でrequireしなくなりました。(アプリケーション側でrequire_onceする必要があります。)
* テスト関連
 * UnitTestManagerを廃止しました。

### bug fix
 * メールアドレスのバリデーションで、@の左側の?を許可するようにしました。
 * Ethna_ActionFormで、nullを''空文字列に変換してしまうバグを修正しました。[[de1442bd](https://github.com/DQNEO/ethnam/commit/de1442bd55397834a7b6228c3c0ae694849237db)]
 * Controllerの終了直前にaction_formのプロパティをunsetすることで、PHP5.1でのメモリリークを改善しました。c.f. http://qiita.com/DQNEO/items/f2cbe7f15f92f5f4f05d


## Ethna 2.5.0から2.6(beta4)への変更点

* Ethna本体に関する変更点
  * [Breaking B.C] PHP 5.3 対応のための変更 (B.C. PHP 4 非対応となります)
     * 非推奨シンタックスの除去 (Remove DEPRECATED syntax)
     * 不要な参照渡し($obj =& new)をやめました。
     * アクセス修飾子、static修飾子の導入
     * コンストラクタメソッド名の変更(クラス名から__construct()へ)
     * ファイル名を短くしました。(例 Ethna_ActionClass.php -> ActionClass.php)
  * skeleton 関係のファイルを変更しました。
  * UrlHandler と .htaccess (mod_rewrite) を利用するためのひな形を生成
  * セッションハンドラのなど，セッションに関する設定の変更をするための記述を APPID-ini.php にできるようになりました．
* DB に関する変更点
  * これまではADOdbのみで使われていたDSNのパースを、公式スペックとしました(PEAR_DBには直接渡されていたため)。ただし、このパーサが使われるかどうかは各DBドライバに依存します。
  * Creole 削除
* UrlHandler に関する変更点
  * path_regexp が定義されている場合、path の定義は必須ではなくなりました (sf#19237)
  * UrlHandler_Simple という軽量 UrlHandler を同梱しました (thx. riaf #17 on GitHub)
* Renderer/View に関する変更点
  * Smarty3 追加
  * Rhaco 削除
  * 汎用ビュークラスを実装
  * レイアウトテンプレートを実装
     * HTMLの外側に当たる雛形のテンプレートを描くためのもの。各アクションの出力はこのテンプレートの出力でラップされる
     * デフォルトは template/{locale_name}/layout.tpl に置かれている。
     * この機能はデフォルトで有効になっている。無効にしたければ、[appid]_ViewClass.php の $use_layout を false にする(既存プロジェクトをEthna 2.6に移行する場合、こうすれば動作するはず)
  * renderer の設定を config に書けるようになりました (一部、かつ、実装は renderer 依存)
     * Smarty2 の場合 'smarty', Smarty3 の場合 'smarty3' をキーとした配列に、left/right delimiter の設定を記述できます
     * 'path' として、include するファイルの path を指定できるようになりました
  * Ethna_Renderer の仕様変更 (Breaking B.C.)
     * レンダラとしての Ethna_Renderer の仕様変更
        * Smarty 以外にも実は PHP などで利用できる Ethna_Renderer でしたが、以下のように仕様を変更しました。
        * テンプレートは何度でも render 可能になりました (これまで include_once だったので1度しか render できませんでした)
        * setProp() された変数(assignされた変数) は、$assign名 でアクセスできるようになりました。
    * レンダラエンジンの親クラスとしての Ethna_Renderer (Renderer プラグイン開発者向け情報)
        * 今後エンジンは getName() を実装し、エンジン名を返す必要があります
        * Renderer の $config プロパティには、iniで定義された配列 $config の、$config['renderer'][エンジン名] が入ります
* プラグイン機構に関する変更点
  * Ethna_Plugin::import という，プラグインソースをincludeするための，staticメソッドを追加．
  * Ethna_Plugin_Cachemanager に config からデフォルト の namespace を指定可能とした
  * pecl::memcached 版に対応した Ethna_Plugin_Cachemanager_Memcached のバンドル
  * [Breaking B.C] プラグインに関する変更
      * ファイル名の命名規則を変更
  * プラグイン関連のethnaコマンドを整理
      * channel-update (削除)
      * info-plugin (削除)
      * install-plugin (削除)
      * uninstall-plugin (削除)
      * upgrade-plugin (削除)
      * list-plugin (削除)
* その他の変更
  * Config に URL が設定されていない場合、アクセスされたURLから自動的に検出されるようになりました。(Ethna_Util::getUrlFromRequestUri())


### bug fix
* Ethna_Plugin::includePlugin メソッドの実装が動作するものではなかったので変更
* Ethna_Plugin_Cachemanager のクラスのプロパティに指定する $namespace が意味をなしていなかったので修正 (#17753)
* checkMailAddress でメールアドレスの@以前に/が含まれる場合にvalidationに引っかかる問題を修正 (#3 thx. DQNEO) https://github.com/ethna/ethna/pull/3
* setFormDef_PreHelper() 内で $this->af がセットされていない問題の修正 (#4 thx. DQNEO) https://github.com/ethna/ethna/pull/4
* Ethna_DB_PEAR のバグ修正 (thx. polidog, #40)
* clear-cache コマンドのバグ修正 (thx. ucchee, #41)
* Ethna_Plugin_CacheManager_Memcache の修正。
 * delete コマンド
 * 複数サーバのバランシングができていなかった件を修正 (thx. DQNEO #30)
* Ethna_DB_ADOdb のエラーハンドリング, Ethna_DB_* の実装・コメントの修正
 * thx. ryuzo98 #38, DQNEO #48
