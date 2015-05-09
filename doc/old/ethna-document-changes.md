# 変更点一覧 - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# 変更点一覧 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > 変更点一覧 

- 変更点一覧 
  - 2.6.0 beta (beta1 .. beta2) 
    - features 
    - \* Ethna本体に関する変更点 
    - \* Renderer/View に関する変更点 
    - \* プラグイン機構に関する変更点 
    - bug fix 
    - \* beta1 .. beta2 
  - 2.5.0 
    - features 
    - bug fix 
  - 2.5.0-preview5 
    - features 
    - bug fix 
  - 2.5.0-preview4 
    - bug fix 
  - 2.5.0-preview3 
    - features 
    - bug fix 
  - 2.5.0-preview2 
    - features 
    - bug fix 
  - 2.5.0-preview1 
    - features 
    - bug fixes 
  - 2.3.7 
    - bug fix 
  - 2.3.6 
    - features 
    - bug fixes 
  - 2.3.5 
    - features 
    - bug fixes 
  - 2.3.2 
    - features 
    - bug fixes 
  - 2.3.1 
    - features 
    - bug fixes 
  - 2.3.0 
  - 2.3.0-dev (preview3) 
    - features 
    - bug fixes 
  - 2.3.0-dev (preview2まで) 
    - features 
    - bug fixes 
  - [2006/06/07] 2.1.2 
    - bug fixes 
  - [2006/06/07] 2.1.1 
    - bug fixes 
  - [2006/06/06] 2.1.0 
    - features 
    - bug fixes 
  - [2006/01/29] 0.2.0 
    - features 
    - bug fixes 
  - [2005/03/02] 0.1.5 
    - features 
    - bug fixes 
  - [2005/01/14] 0.1.4 
    - features 
    - bug fixes 
  - [2004/01/13] 0.1.3 
    - アップデート時の注意点 
    - features 
    - bug fixes 
  - [2004/12/23] 0.1.2 
    - features 
    - bug fixes 
  - [2004/12/10] 0.1.1 
    - bug fixes 
  - [2004/12/09] 0.1.0 

## 変更点一覧 [](ethna-document-changes.html#v03b4ac0 "v03b4ac0")

### 2.6.0 beta (beta1 .. beta2) [](ethna-document-changes.html#f019cfd1 "f019cfd1")

- Ethna 2.5.0 preview5 に含まれていて、Ethna 2.5.0 に含まれなかった変更点について、CHANGES の整理 (多少重複します)
  - 2.6.0 の変更点一覧が、preview5 からの差分となっていたため、preview5 -> (元)preview6 での fix事項等はCHANGESから削除

#### features [](ethna-document-changes.html#d8a77ff3 "d8a77ff3")

#### \* Ethna本体に関する変更点 [](ethna-document-changes.html#fb790004 "fb790004")

- [Breaking B.C] PHP 5.3 対応のための変更 (B.C. PHP 4 非対応となります)
  - 非推奨シンタックスの除去 (Remove DEPRECATED syntax)
    - 不要な参照渡し、new演算子の参照代入の除去
    - アクセス修飾子、static修飾子の導入(一部)
    - コンストラクタメソッド名の変更(クラス名から\_\_construct()へ)
- 命名規則の変更
  - class/ 以下のクラスついて、命名規則を変更しました (ファイル名がフルクラス名ではなくなりました)
- skeleton 関係
  - デフォルトで生成されるレイアウトテンプレートの調整
  - cssの変更
  - UrlHandler と .htaccess (mod\_rewrite) を利用するためのひな形を生成
- セッションハンドラのなど，セッションに関する設定の変更をするための記述を APPID-ini.php にできるようになりました．

#### \* Renderer/View に関する変更点 [](ethna-document-changes.html#l3a7643f "l3a7643f")

- Smarty3 追加
- Rhaco 削除: rhacoテンプレートレンダラは以後サポートしません(いつのrhacoのバージョンで動くのかもわかりませんでした)
- Ethna\_ActionClass から、Ethna\_ViewClass#preforward に引数を渡せるようにした
  - return array('forward\_name', $params); の形式で渡せば、$params が preforwardの引数として渡される
- 汎用ビュークラスを実装
  - ビューへの出力時によく使われる処理を雛形として実装したもの
  - Ethna\_View\_Json.php
  - Ethna\_View\_403.php
  - Ethna\_View\_404.php
  - Ethna\_View\_500.php
  - Ethna\_View\_Redirect.php
    - アクションクラスで return array('redirect', ' [http://example.com');](http://example.com');) とすれば [http://example.com](http://example.com) にリダイレクトされる
- レイアウトテンプレートを実装
  - HTMLの外側に当たる雛形のテンプレートを描くためのもの。各アクションの出力はこのテンプレートの出力でラップされる
  - デフォルトは template/{locale\_name}/layout.tpl に置かれている。
  - この機能はデフォルトで有効になっている。無効にしたければ、[appid]\_ViewClass.php の $use\_layout を false にする(既存プロジェクトをEthna 2.6に移行する場合、こうすれば動作するはず)
- PROJECT\_DIR/lib/Ethna/extlib/Plugin/Smarty をデフォルトでSmartyプラグインディレクトリに指定するように，skel に追加

#### \* プラグイン機構に関する変更点 [](ethna-document-changes.html#l5f6ca35 "l5f6ca35")

- Ethna\_Plugin::import という，プラグインソースをincludeするための，staticメソッドを追加．
- すべてのPluginの基底となる抽象クラス，Ethna\_Plugin\_Abstractを追加
  - 既存のプラグインの親クラスを，Ethna\_Plugin\_Abstract を継承するように変更
  - Plugin に設定を受け渡す方法を変更したため，etcのskelを変更
    - それに伴い，Ethna\_Plugin\_Cachemanager\_Memcacheの設定方法を変更
- Ethna\_Plugin\_Cachemanager に config からデフォルト の namespace を指定可能とした
- pecl::memcached 版に対応した Ethna\_Plugin\_Cachemanager\_Memcached のバンドル
- [Breaking B.C] プラグインに関する変更
  - プラグインから名前空間を除去することで、複数アプリケーションでの利用を可能に
  - 検索用のアプリケーションIDを削除した
  - ファイル名の命名規則を変更
  - extlibの設置
- プラグイン関連のethnaコマンドを整理し、インストール、アンインストール関連コマンドは ethna pear-local コマンドに一本化
  - ethna channel-update (削除)
  - ethna info-plugin (削除)
  - ethna install-plugin (削除)
  - ethna uninstall-plugin (削除)
  - ethna upgrade-plugin (削除)
  - ethna list-plugin (削除)
- プラグインパッケージのスケルトンを生成するコマンドとして ethna create-plugin コマンドを追加
  - 複数のtypeのプラグイン同時作成が可能に
  - Ethnaプロジェクト内でのプラグインの自動生成が可能に
  - ethna make-plugin-package との連動が可能に
- ethna create-plugin コマンドの出力から ethna make-plugin-package を実行できるようにコマンドを再実装
  - これにより、複数のプラグインを含んだパッケージの作成が可能に

#### bug fix [](ethna-document-changes.html#b7aca9be "b7aca9be")

- ethna make-plugin-package のデフォルトインストールディレクトリが誤っていたバグを修正
- Ethna\_Plugin::includePlugin メソッドの実装が動作するものではなかったので変更
- Ethna\_Plugin\_Cachemanager のクラスのプロパティに指定する $namespace が意味をなしていなかったので修正 (#17753)
- PROJECT\_DIR/lib/Ethna/extlib 以下にファイルを設置するタイプのプラグインを pear-local などでインストールすると、それ以後ethnaコマンドが使えなくなる問題を修正
- 新しいプラグインの命名規則に従っていない古いプラグインを別物として読み込もうとしてクラス名がかぶる問題を修正(#17875) thanks: id:okonomi

#### \* beta1 .. beta2 [](ethna-document-changes.html#e3c0275e "e3c0275e")

- require のパスを修正 (thx. seiya, [https://github.com/sotarok/ethna/issues/#issue/1)](https://github.com/sotarok/ethna/issues/#issue/1))

### 2.5.0 [](ethna-document-changes.html#b00186c9 "b00186c9")

#### features [](ethna-document-changes.html#m1aecc8b "m1aecc8b")

- フォーム定義に関する変更
  - フォーム定義を動的に変更するためのAPIをさらに追加
  - Ethna\_ActionForm#setFormDef\_ViewHelper
- APPID\_Controller.php のスケルトンに継承を想定したメソッドを追加
  - skel/app.controller.php \_setDefaultTemplateEngin
- add-project 時の www 以下に出来るエントリポイントから APPID\_Controller へのパスを相対パスに変更
- ethna コマンドの挙動変更
  - add-project -b オプションの挙動変更
  - ethna help コマンドを追加
  - Filterは一貫してプラグインを使うように変更したため、add-project時の app/filter ディレクトリを削除。
- 指定 Action が存在しない場合、app/action 以下を全て include する仕様を変更
- controller での smarty\_xx\_plugin の機能を削除
  - フォームヘルパのテキストエリアに value 属性を付加していた動きを修正。(thanks: syachi5150)
    - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16326](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16326)
  - [Breaking B.C] ルールがユーザにとって直感的ではないとの理由から、フォーム定義の max と フォームヘルパの maxlength の連携機能を削除 (thanks: syachi5150)
    - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16325](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16325)
  - Windowsユーザへの便宜のため、zipアーカイブで成果物を配布するオプションを追加
- 組み込みの Smarty プラグインの追加
  - modifier\_explode (文字列を，ある文字で分割して配列に変換する）
- 国際化に関する変更
  - デフォルトのタイムゾーンとして、date.timezone を 'Asia/Tokyo' に設定
  - Ethna\_I18N クラス に setTimeZone メソッドを追加 (static呼出)
    - PHP 5.1.0 以降でのみ意味がある関数。それ以前では、呼んでもタイムゾーンは設定されません。
- Ethna\_MailSender にて、メール送信に問題がある場合の設定として 'mail\_func\_workaround' を追加
  - この値を true に設定すると、メールヘッダの改行コードを一律 CRLF にする処理を回避する
  - $mail = new Ethna\_MailSender(); $mail->setOption(array('mail\_func\_workaround')); でも設定可能
- Smarty の設定（現在はデリミタのみ）を [appid]-ini.php に書くことが出来るようにした

#### bug fix [](ethna-document-changes.html#b5599012 "b5599012")

- Ethna\_Controller#getTemplatedir を無視してテンプレートディレクトリを決定していたバグを修正(thanks: hiko)
  - getTemplatedirメソッドをオーバライドしても強制的にロケールが付加されていた
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=15570](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15570)
- "ethna pear-local list -a" の実行結果がエラーになってしまうバグを修正
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=15760](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15760)
- safe-mode が ON の際に、CacheManager\_Localfile がディレクトリを生成できないので、tmp ディレクトリ直下にキャッシュファイルを作成するようにした
  - skel/skel.app\_manager.php も修正
- APPID-ini.php が存在しない場合，またはURLが設定にない場合，デフォルトURLが HTTP\_HOST で設定されていたが，末尾に / がなかったので修正
- フォームヘルパで自動的に出力されるhiddenタグの閉じ忘れを修正(thanks: id:syachi5150)
- ethna add-app-manager コマンドで生成されるファイル名およびクラス名が間違っていたバグを修正(thanks: id:syachi5150)
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16137](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16137)
- Validatorが出力するメッセージからフォーム名の後ろのスペースを削るように修正。(thanks: id:syachi5150)
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16336](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16336)
- Smarty 拡張プラグインの wordwrap\_i18n にアルファベットのみを渡した場合に正しい結果が返らないバグを修正
  - 末尾のスペースを取り除く挙動も wordwrap に合わせて削除
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16839](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16839)
- ethna add-test コマンドのヘルプが機能していなかったバグを修正
- 存在しない(or 削除された) ethnaコマンドを指定すると Fatal Error が起きるバグを修正 (thanks:kondo\_)
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=17894](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=17894)
- Ethna\_Plugin\_Logwriter の debug\_backtrace の一部が取得できず、E\_NOTICE が出るバグを修正 (thanks: [http://www.remix.gr.jp/)](http://www.remix.gr.jp/))
- cli 環境で Ethna\_Session::start を叩いたときに $\_SERVER 変数がないために E\_NOTICE が出る問題を修正
- PHP 5.3.0 で新設された E\_DEPRECATED を ON にすると Fatal Error が起きるバグを修正 (#18418)
- iniディレクティブ date.timezone が設定されてないために、E\_WARNING が PHP 5.3.0 で出ていたバグを修正
- Smartyのデリミタを変更している場合にi18nコマンドが機能しないバグを修正 (#18668)
- formタグのname属性が設定できなくなっていたバグを修正 (thanks: shutta) (#19037)
- Ethna\_Session#isAnonymous メソッドが状態を正しく取得できない場合があるバグを修正(thanks:longkey1)
  - [http://ml.ethna.jp/pipermail/users/2008-February/000899.html](http://ml.ethna.jp/pipermail/users/2008-February/000899.html)
- Ethna\_ActionForm::setDef に渡す値によっては、空キーにフォーム定義が入ってしまうバグを修正。(thanks:tohokuaki #18856)

### 2.5.0-preview5 [](ethna-document-changes.html#x29fc02d "x29fc02d")

#### features [](ethna-document-changes.html#z01f3383 "z01f3383")

- フォーム定義に関する変更
  - フォーム定義を動的に変更するためのAPIをさらに追加
  - Ethna\_ActionForm#setFormDef\_ViewHelper
- APPID\_Controller.php のスケルトンに継承を想定したメソッドを追加
  - skel/app.controller.php \_setDefaultTemplateEngin
- add-project 時の www 以下に出来るエントリポイントから APPID\_Controller へのパスを相対パスに変更
- ethna コマンドの挙動変更
  - ethna help コマンドを追加
- 指定 Action が存在しない場合、app/action 以下を全て include する仕様を変更
  - include せず、fallback用のactionを実行する
- add-project -b オプションの挙動変更- controller での smarty\_xx\_plugin の機能を削除
- ビューまわりの変更
  - Ethna\_ActionClass から、Ethna\_ViewClass#preforward に引数を渡せるようにした
    - return array('forward\_name', $params); の形式で渡せば、$params が preforwardの引数として渡される
  - 汎用ビュークラスを実装
    - ビューへの出力時によく使われる処理を雛形として実装したもの
    - Ethna\_View\_Json.php
    - Ethna\_View\_403.php
    - Ethna\_View\_404.php
    - Ethna\_View\_500.php
    - Ethna\_View\_Redirect.php
    - アクションクラスで return array('redirect', ' [http://example.com');](http://example.com');) とすれば [http://example.com](http://example.com) にリダイレクトされる
  - レイアウトテンプレートを実装
    - HTMLの外側に当たる雛形のテンプレートを描くためのもの。各アクションの出力はこのテンプレートの出力 でラップされる
    - デフォルトは template/{locale\_name}/layout.tpl に置かれている。
    - この機能はデフォルトで有効になっている。無効にしたければ、[appid]\_ViewClass.php の $use\_layout >を false にする
  - フォームヘルパのテキストエリアに value 属性を付加していた動きを修正。(thanks: syachi5150)
    - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16326](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16326)
- [Breaking B.C] プラグインに関する変更
  - プラグインから名前空間を除去することで、複数アプリケーションでの利用を可能に
  - 検索用のアプリケーションIDを削除した
  - ファイル名の命名規則を変更
  - extlibの設置
  - プラグイン関連のethnaコマンドを整理し、インストール、アンインストール関連コマンドは ethna pear-local コマンドに一本化
    - ethna channel-update (削除)
    - ethna info-plugin (削除)
    - ethna install-plugin (削除)
    - ethna uninstall-plugin (削除)
    - ethna upgrade-plugin (削除)
    - ethna list-plugin (削除)
  - プラグインパッケージのスケルトンを生成するコマンドとして ethna create-plugin コマンドを追加
    - 複数のtypeのプラグイン同時作成が可能に
    - Ethnaプロジェクト内でのプラグインの自動生成が可能に
    - ethna make-plugin-package との連動が可能に
  - ethna create-plugin コマンドの出力から ethna make-plugin-package を実行できるようにコマンドを再実 装
    - これにより、複数のプラグインを含んだパッケージの作成が可能に
  - Filterは一貫してプラグインを使うように変更したため、add-project時の app/filter ディレクトリを削除 。
- Smartyに関する変更
  - Smarty を 2.6.26 に追随
  - 組み込みの Smarty プラグインの追加
    - explode修正子 (文字列を，ある文字で分割して配列に変換する）
- その他雑多な変更
  - [Breaking B.C] ルールがユーザにとって直感的ではないとの理由から、フォーム定義の max と フォームヘ ルパの maxlength の連携機能を削除 (thanks: syachi5150)
    - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16325](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16325)
  - Windowsユーザへの便宜のため、zipアーカイブで成果物を配布するオプションを追加

#### bug fix [](ethna-document-changes.html#r607929c "r607929c")

- Ethna\_Controller#getTemplatedir を無視してテンプレートディレクトリを決定していたバグを修正(thanks: hiko)
  - getTemplatedirメソッドをオーバライドしても強制的にロケールが付加されていた
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=15570](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15570)
- "ethna pear-local list -a" の実行結果がエラーになってしまうバグを修正
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=15760](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15760)
- safe-mode が ON の際に、CacheManager\_Localfile がディレクトリを生成できないので、tmp ディレクトリ>直下にキャッシュファイルを作成するようにした
  - skel/skel.app\_manager.php も修正
- APPID-ini.php が存在しない場合，またはURLが設定にない場合，デフォルトURLが HTTP\_HOST で設定されて>いたが，末尾に / がなかったので修正
- フォームヘルパで自動的に出力されるhiddenタグの閉じ忘れを修正(thanks: id:syachi5150)
- ethna add-app-manager コマンドで生成されるファイル名およびクラス名が間違っていたバグを修正(thanks: id:syachi5150)
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16137](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16137)
- Validatorが出力するメッセージからフォーム名の後ろのスペースを削るように修正。(thanks: id:syachi5150)
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16336](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16336)
- Smarty 拡張プラグインの wordwrap\_i18n にアルファベットのみを渡した場合に正しい結果が返らないバグを 修正
  - 末尾のスペースを取り除く挙動も wordwrap に合わせて削除
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=16839](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16839)
- Ethna\_Session#isAnonymous メソッドが状態を正しく取得できない場合があるバグを修正(thanks:longkey1)
  - [http://ml.ethna.jp/pipermail/users/2008-February/000899.html](http://ml.ethna.jp/pipermail/users/2008-February/000899.html)
- ethna add-test コマンドのヘルプが機能していなかったバグを修正

### 2.5.0-preview4 [](ethna-document-changes.html#d9b94c09 "d9b94c09")

#### bug fix [](ethna-document-changes.html#o92b594b "o92b594b")

- フォーム定義が配列で、Ethna\_ActionForm#getHiddenVars の値を Ethna\_ActionForm#setAppNE した場合、クロスサイトスクリプティング 脆弱性が存在するバグを修正 (thanks: shuitic)
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=17332](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=17332)

### 2.5.0-preview3 [](ethna-document-changes.html#y2250027 "y2250027")

#### features [](ethna-document-changes.html#u51a14cc "u51a14cc")

- アクションフォームに関する変更
  - フォーム定義を多次元配列に対応させました (thanks: id:syachi5150)
    - [http://d.hatena.ne.jp/syachi5150/20081022/1224676038](http://d.hatena.ne.jp/syachi5150/20081022/1224676038)
  - フォーム定義を「'def' => array(),」 と定義しなくても、「'def',」 と定義するだけで親のフォームテンプレートの定義を補うようにした (thanks: sotarok)
  - フォーム定義を動的に変更するためのAPIを追加
    - Ethna\_ActionForm#setFormDef\_PreHelper
    - Ethna\_Backend や Ethna\_Session が初期化後に呼ばれる
- フォームヘルパに関する変更
  - 1つのテンプレートに 複数 {form} が指定されたときに、submitされたformに対してのみ補正処理が働くように改善 この場合、{form name=...} 属性の指定が必須
  - 1つのテンプレートに 複数 {form} が置かれた場合に、それぞれのフォームの配列を区別するようにした
- Smarty プラグインに関する変更
  - Ethna 組み込みの Smarty プラグインを分割
    - Ethna 組み込みの Smarty プラグインとして class/Plugin/Smarty/ に Smarty のプラグイン形式で個別に作成
    - それに伴い Ethna\_Smarty\_Plugin クラスは削除
    - 読み込み順は次のように指定 1. Controller の plugin ディレクトリ 2. Ethna 組み込みの Plugin/Smarty/ ディレクトリ 3. samrty デフォルトのプラグイン
  - デフォルトの smarty プラグイン よりも Controller の plugins ディレクトリに定義されたプラグインを優先させるように変更
  - アプリケーション独自のSmarty Pluginの定義場所を app/plugin/Smarty にできるようデフォルトでディレクトリの作成、コントローラに値のセットするよう変更
- その他雑多な変更
  - Smarty を 2.6.22 に追随
  - アプリケーションの最終処理を行うメソッドとして、Ethna\_Controller#end を追加
  - フィルタを一貫してプラグインから取得するように変更

#### bug fix [](ethna-document-changes.html#n92f13e4 "n92f13e4")

- safe-mode が ON の際に、Ethna\_View\_Test がエラーを吐く現象を回避 (thanks:longkey1 [ethna-users:1059])
- "ethna add-view" コマンドにて、locale 及び client encoding のデフォルト設定が誤っていたバグを修正
- Ethna\_Renderer\_Rhaco.php を 1.x 系の最新バージョン 1.6.1 に追随 (thanks: id:akiraneko [ethna-users:1081])
- 複数ファイルをアップロード(つまり配列を使用)する際、必須チェックが機能しなかったバグを修正(thanks: id:syachi5150)
- ethna add-app-manager コマンドで生成されるアプリケーションマネージャのクラス名が、[Appid]\_Controller#getManagerClassName の設定を反映するように修正。
- smarty\_modifier\_unique プラグインが、仕様通り動作していなかったバグを修正
- Ethna\_PearWrapper のエラー処理が誤っていたのを修正 (thanks: id:nazo)
  - [http://wassr.jp/user/nazo/statuses/SkfJTckkN2](http://wassr.jp/user/nazo/statuses/SkfJTckkN2)
- Ethna\_ActionForm#getHiddenVars メソッドで、フォーム定義が配列で設定された値がスカラーの場合に警告が出ていたのを修正(thanks: maru\_cc)
  - 逆に、フォーム定義がスカラーで値が配列の場合は救いようがないので警告扱い
- www/info.php を実行したり、www/unittest.php を実行すると、サーバが応答しなくなることがあるバグを修正
  - アクションクラスの書き方によっては、Ethna\_InfoManager が 無限ループに陥っていたため
  - [http://sourceforge.jp/tracker/index.php?func=detail&aid=10006&group\_id=1343&atid=5092](http://sourceforge.jp/tracker/index.php?func=detail&aid=10006&group_id=1343&atid=5092)

### 2.5.0-preview2 [](ethna-document-changes.html#d0c37223 "d0c37223")

#### features [](ethna-document-changes.html#v7014ff2 "v7014ff2")

- PEAR依存を排除するための変更。依存を排除する理由は以下の通り。
  1. PEAR が PEAR2 に移行するに伴い、APIが不安定になること
  2. Ethna が依存している PEAR\_Error は既に非推奨であること
  3. 外部ライブラリにできうる限り依存しない方がユーザの便宜となる
  4. PEAR に依存していると、PHPライセンスと抵触しているライセンスで配布できない

  - Console\_Getopt の代替として、Ethna\_Getopt.php を追加 (Public Domain)
  - 性質上依存せざるを得ない以下のファイルを除き、Console\_Getopt への依存を排除
    - ETHNA\_BASE/bin/ethna\_make\_package.php
    - ETHNA\_BASE/class/Ethna\_PearWrapper.php
  - [Breaking B.C] Ethna から PEAR\_Error まわりの依存を排除。これに伴い、Ethnaクラス が持っていた PEARコアコンポーネンツ の機能は使えなくなっている。
    - Ethnaクラス に PEAR ライクなエラーチェックメソッドを追加し、それに伴う変更
    - Ethna\_Error で PEAR を呼び出していた部分を修正し、PEARに任せていたメンバ設定等を最実装
    - PEAR.php で定義されていた OS\_WINDOWS 定数の代替として、 ETHNA\_OS\_WINDOWS 定数を定義した。これは PEAR が、OS\_WINDOWS 定数が再定義されているかをチェックしていないため
- 国際化メッセージの生成支援機構として、i18n コマンドを実装
  - gettext, Ethna組み込みのメッセージカタログに対応
  - ethna i18n [-b|--basedir=dir] [-l|--locale=locale] [-g|--gettext] [extdir1] [extdir2] ...
  - メッセージファイルが存在する場合は、Ethna 組み込みのメッセージカタログの場合は、既存の翻訳を自動的にマージする。gettext の場合は、新たにファイルを生成し、msgmerge プログラムを使って翻訳を既存のものとマージするように促す
- 配布する Smarty を 2.6.20 に追随
- [Breaking B.C] 互換性を保つために残されていた内部メソッドを削除
  - Ethna\_ViewClass#\_getTemplateEngine
- Ethna\_ActionClass のメンバに $logger(Ethna\_Logger) を追加
- Ethna\_ViewClass のメンバに $ctl(Ethna\_Controller) を追加
  - i18n 周りの情報を容易に変更させるようにするため
- Ethna\_Controller#\_setLanguage メソッドを、backend, Session, actionform の初期化が終わってから呼ぶようにした。
- 2.5.0 preview1 で追加した Ethna\_ViewClass#\_setLanguage メソッドを削除
  - アクション実行後のロケール変更はあまり意味がないため ![:(](image/face/sad.png)

#### bug fix [](ethna-document-changes.html#e1d76bcb "e1d76bcb")

- テストディレクトリの変更のタイミングによっては、Ethna\_UnitTestMangerがWARNINGを出す問題を回避 (thanks: maru\_cc)
- selected="selected" の修正漏れを修正 (thanks:maru\_cc)
- [Breaking B.C] Ethna\_Plugin\_CacheManager\_Memcache の接続デフォルトが persistent になっていたのを通常接続に変更
  - [appid]/etc/[appid]-ini.php の memcache\_use\_connect 設定を memcache\_use\_pconnect に変更
- プラグインのクラス名にアンダーバーを許していなかったが、PHPのクラス名的に正当な文字であればOKにするように変更(thanks:maru\_cc)
- Ethna\_I18N.php で、メッセージをパースする際に空行を見逃していたバグを修正
- Ethna\_MailSender にてメールを送信する際、テンプレートが存在しなかった場合にも空メールを送ってしまうバグを修正 (thanks: ryosuke at sekido dot info -> [ethna-users:1053])
- smarty\_modifier\_checkbox が仕様に反する動作をしていたバグを修正し、仕様を厳密化した(thanks: maru\_cc)
  - checked が付くのはスカラーで、0 と空文字列、null, false 以外の場合とする
- Ethna\_ActionError#\_getActionForm で、E\_NOTICE が出る問題を回避

### 2.5.0-preview1 [](ethna-document-changes.html#f9c85729 "f9c85729")

#### features [](ethna-document-changes.html#r6a33c8a "r6a33c8a")

- ソースコード全体をUTF-8化
  - 但し、日本語のソースコードコメントはそのまま
  - [Breaking B.C] フレームワークで扱う内部エンコーディング(mb\_internal\_encoding)もデフォルトはUTF-8に変更。但し、これはEthna\_Controller#\_getDefaultLanguageをオーバーライドし、クライアントエンコーディングの値を変えることで変更可能です。
  - 内部エンコーディングの変更に伴い、動作しなくなった箇所を修正
    - Ethna\_Plugin\_Validator\_Min.php
    - Ethna\_Plugin\_Validator\_Max.php
  - VAR\_TYPE\_STRING の場合の、最大値最小値のプラグインを再編し、マルチバイトのものとそうでないものを分離。互換性確保用途のプラグインも追加
    - Ethna\_Plugin\_Validator\_MbStrMax.php (マルチバイト文字列最大値)
    - Ethna\_Plugin\_Validator\_MbStrMin.php (マルチバイト文字列最小値)
    - Ethna\_Plugin\_Validator\_StrMax.php (シングルバイト文字列最大値)
    - Ethna\_Plugin\_Validator\_StrMin.php (シングルバイト文字列最小値)
    - Ethna\_Plugin\_Validator\_StrMaxCompat.php (2.3.x までの互換性確保用)
    - Ethna\_Plugin\_Validator\_StrMinCompat.php (2.3.x までの互換性確保用)
  - 内部エンコーディングの変更に伴う動作の変更
    - Ethna\_Plugin\_Validator\_Mbregexp のデフォルトのエンコーディングは、クライアントエンコーディングが仮定されます。デフォルトはUTF-8です。
- 国際化 (i18n) のための機能追加および変更
  - [Breaking B.C] 言語名として解釈していた部分をロケール名に変更
    - これにより、[appid]template/ja, [appid]/locale/ja の「ja」の部分が ja\_JP に置き換わります。よって、古いバージョンから移行する場合はディレクトリ名の変更が必要です。
    - Ethna\_ViewClass に、言語切り替え用の \_setLanguage メソッドを追加 (protected)
    - Ethna.php で定義されていた、LANG\_JA, LANG\_EN はこの変更により使用されないので削除
  - [Breaking B.C] gettext を使用する際には [appid]/etc/[appid]-ini.php で 'use\_gettext' => true と設定しないと gettext を使わないようにした
    - 2.3.5 までのコードは、gettext.so がロードされていれば \*無条件に\* gettext が実行されるようになっているので、Ethna 独自のメッセージカタログとの選択がわかりづらいため。
    - 2.3.5までのコードで gettext を利用している場合は、設定が明示的に必要です。
  - "ethna add-project" コマンドに [-l|--locale] [-e|--encoding] オプションを追加
  - "ethna add-[view|templete]" コマンドに [-l|--locale] [-e|--encoding] オプションを追加
  - スケルトンの日本語コメントをすべてASCIIに変更(好みのエンコーディングで編集できるようにするため)
  - gettextを使わない場合向けに、Ethna独自のメッセージカタログを実装
    - ini ファイルライクなフォーマットで msgid と翻訳を格納する方式
    - Ethna\_I18N#setLanguage で出力ロケールの切り替えも可能
- [Breaking B.C] レンタルサーバを考慮して、[appid]\_Controllerの include\_path を、[appid]/lib を優先するように変更
  - include\_path の順番に依存するコードは少ないとは思いますが、移行の際は注意すべきです。
- "ethna add-project" コマンドに [-s|skeldir] オプションを追加
  - 指定されたスケルトンディレクトリに、ETHNA\_HOME/skel と同じファイル名のものが存在する場合はそちらを優先した上で、ETHNA\_HOME/skel にないファイルは [appid]/skel にコピーする
- [Breaking B.C] Ethna\_ActionForm のバリデータは、プラグインのものしか使用しなくなりました。
  - Ethna\_ActionForm, [Appid]ActionForm の use\_validator\_plugin 変数を削除

#### bug fixes [](ethna-document-changes.html#x32355b8 "x32355b8")

- tpl/info.tpl のタグミスを修正
- smarty\_modifier\_plugin が配列の場合に、プラグインとして登録されないバグを修正
- フォームヘルパでセレクトボックスの配列フォームを作ると値が保持されない点を修正 (ethna-users:0868)
- smarty\_modifier\_select の戻り値が、諸々のHTML標準と異なっていたバグを修正(thanks: maru\_cc)
  - selected="true" -> selected="selected"
- アプリケーションIDの始めの文字に数値を許していたバグを修正
  - クラス名のprefixになるため、数値を許すと自動生成物がコンパイルエラーを起こす
- Ethna\_Util#getRandom で open\_basedir が有効な場合に、 /proc を開けず警告が出る点を回避(thanks. sotarok)
  - [http://d.hatena.ne.jp/sotarok/20070813/1187055110](http://d.hatena.ne.jp/sotarok/20070813/1187055110)
- Ethna\_ClassFactory#getManager の第1引数を、大文字小文字を区別しないように修正。(thanks:maru\_cc)
  - 第1引数はクラス名の一部として扱われており、PHPがクラス名の大文字小文字を区別しないことから、大文字小文字を区別せず同じインスタンスを返すのが妥当と考えられる。
- Ethna\_Plugin\_LogWriter クラスにて、バックトレース走査時の軽微なバグを修正(ethna-users:1024, thanks:sfio)
- Ethna\_Config.php にて、設定ファイルのロックが機能していなかったバグを修正

### 2.3.7 [](ethna-document-changes.html#ca10ecac "ca10ecac")

#### bug fix [](ethna-document-changes.html#qb2a22c6 "qb2a22c6")

- フォーム定義が配列で、Ethna\_ActionForm#getHiddenVars の値を Ethna\_ActionForm#setAppNE した場合、クロスサイトスクリプティング 脆弱性が存在するバグを修正 (thanks: shuitic)
  - [http://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=17332](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=17332)

### 2.3.6 [](ethna-document-changes.html#w8dda865 "w8dda865")

#### features [](ethna-document-changes.html#f44940f9 "f44940f9")

- レンタルサーバを考慮して、[appid]\_Controllerの include\_path を、[appid]/lib を優先するように変更

#### bug fixes [](ethna-document-changes.html#mf615558 "mf615558")

- 2.5.0 preview3からのバックポート

- 複数ファイルをアップロード(つまり配列を使用)する際、必須チェックが機能しなかったバグを修正(thanks: id:syachi5150)
  - このバグは重大なので全ての安定版ユーザはアップデートを推奨
- プラグインを使用しない場合に、required\_num の場合について、ファイルの場合は1つ入力されていたらvalidとされていたのを、 プラグインの動作に合わせて一応修正
  - この点は通常ユーザには影響しない。プラグインを使用するのがデフォルトだから。
- Ethna\_Renderer\_Rhaco.php を 1.x 系の最新バージョン 1.6.1 に追随 (thanks: id:akiraneko [ethna-users:1081])
- smarty\_modifier\_unique プラグインが、仕様通り動作していなかったバグを修正
- Ethna\_ActionForm#getHiddenVars メソッドで、フォーム定義が配列で設定された値がスカラーの場合に警告が出ていたのを修正(t hanks: maru\_cc)
  - 逆に、フォーム定義がスカラーで値が配列の場合は救いようがないので警告扱い
- www/info.php を実行したり、www/unittest.php を実行すると、サーバが応答しなくなることがあるバグを修正
  - アクションクラスの書き方によっては、Ethna\_InfoManager が 無限ループに陥っていたため
  - [http://sourceforge.jp/tracker/index.php?func=detail&aid=10006&group\_id=1343&atid=5092](http://sourceforge.jp/tracker/index.php?func=detail&aid=10006&group_id=1343&atid=5092)

- 2.5.0 preview2からのバックポート

- selected="selected" の修正漏れを修正 (thanks:maru\_cc)
- Ethna\_MailSender にてメールを送信する際、テンプレートが存在しなかった場合にも空メールを送ってしまうバグを修正 (thanks : [ryosuke@sekido.info](mailto:ryosuke@sekido.info) -> [ethna-users:1053])
- smarty\_modifier\_checkbox が仕様に反する動作をしていたバグを修正し、仕様を厳密化した(thanks: maru\_cc)
  - checked が付くのはスカラーで、0 と空文字列、null, false 以外の場合とする
- Ethna\_ActionError#\_getActionForm で、E\_NOTICE が出る問題を回避

- 2.5.0 preview1からのバックポート

- tpl/info.tpl のタグミスを修正
- smarty\_modifier\_select の戻り値が、諸々のHTML標準と異なっていたバグを修正(thanks: maru\_cc)
  - selected="true" -> selected="selected"
- アプリケーションIDの始めの文字に数値を許していたバグを修正
  - クラス名のprefixになるため、数値を許すと自動生成物がコンパイルエラーを起こす
- Ethna\_Plugin\_LogWriter クラスにて、バックトレース走査時の軽微なバグを修正(ethna-users:1024, thanks:sfio)
- Ethna\_Config.php にて、設定ファイルのロックが機能していなかったバグを修正

- その他安定版にのみ影響するもの

- アクションフォームクラスのスケルトンの一部で、$use\_validator\_plugin = false となっていたのをデフォルトのtrueに修正
  - これはプロジェクト作成時の app/action/Index.php にのみ影響する。ユーザはこれを通常は再利用しないと考えられるので、通 常は影響ない

### 2.3.5 [](ethna-document-changes.html#n605ffb5 "n605ffb5")

#### features [](ethna-document-changes.html#sf8db2f7 "sf8db2f7")

- PEAR チャンネルサーバに ethna/simpletest, ethna/Smarty を追加
  - インストール後のsimpletest, Smartyのパスで悩む罠を軽減することが目的
  - pear コマンドで Ethna をインストールするときにこれらを Optional に依存するように設定。既存のインストールを考慮して、required にはしていない。
    - pear channel-discover pear.ethna.jp
    - pear install ethna/[Smarty|simpletest]
- Ethnaコマンドに一般的なテストケースコマンドとして add-test コマンドを追加(thanks: BoBpp)
  - ethna add-test -s [skelname] [name] で実行できます
  - [http://blog.as-roma.com/BoBlog/index.php?itemid=1338](http://blog.as-roma.com/BoBlog/index.php?itemid=1338)
  - これは自動登録されるため、[appid]\_UnitTestManager に定義を追加する必要はありません(thanks: id:okonomi)
    - [http://d.hatena.ne.jp/okonomi/20080408](http://d.hatena.ne.jp/okonomi/20080408)
- Ethna\_Renderer\_Rhacoを追加(experimental)
- Ethna\_DB\_ADOdbのdebug時のログ出力をEthnaのLoggerに変更(@see　 [http://d.hatena.ne.jp/sotarok/20071224](http://d.hatena.ne.jp/sotarok/20071224) )
- Ethna add-[|action|view]-test コマンドで生成されるテストケースがデフォルトでfailするように改善
- Ethna のユニットテスト実行時に [appid]/etc/[appid]-ini.php のデバッグ設定がfalseの場合のエラー処理を改善
  - エラー処理をphpに任せて画面を真っ白にするのではなく、親切なエラーメッセージを表示する
- [action|view] のユニットテスト生成時、対応するアクション(ビュー)スクリプトがない場合は警告を生成するようにした。
- Ethna の add-[action|view] コマンドで、同時にユニットテストを作成できるようにするオプションを追加。
  - ただし、add-view コマンドで -t を指定した場合は、これらのオプションは無視される。
  - ethna add-[action|view] add-view [-w|--with-unittest] [-u|--unittestskel=file] [action|view]

#### bug fixes [](ethna-document-changes.html#x7a33d3a "x7a33d3a")

- ethna pear-local コマンドで Ethna を [appid]/lib/ にインストールすると、[appid]\_Controller.php のinclude\_path の設定によっては ethnaコマンドが動かなくなるのを回避 (thanks: sotarok)
  - ethna pear-local コマンドで Ethna を [appid]/lib にインストールしても、[appid]/bin/ethna が使えるようにした。
- 配列のフォームをvalidateする際、値がnullだとフィルタが適用されないバグを修正
- Ethna\_Plugin\_Cachemanager\_Memcache に引数がなかったためにプラグイン呼び出しに失敗していたバグを修正(thanks sfio, ethna-users:0818)
- Ethna\_PearWrapper、Ethna\_Plugin\_Csrf\_Session, Ethna\_InfoManager 等を微調整(thanks sfio, ethna-users:0825)
- form\_input の default 属性が、入力値で上書きできなかったバグを修正(thanks sotarok, ethna-users:0836)
- call\_user\_func の戻り値がオブジェクトだった場合に、E\_NOTICEが出る問題を回避(PHP 4.4限定) [ethna-users:0910]
- ActionForm の validate test の結果が、次のテストに引き継がれてしまうバグを修正(thanks: maru\_cc)

### 2.3.2 [](ethna-document-changes.html#z20dc470 "z20dc470")

#### features [](ethna-document-changes.html#faeefb6c "faeefb6c")

- [breaking B.C.] Ethna\_UrlHandler (URLハンドラ) をプラグイン化
  - Ethna\_Plugin\_Urlhandler\_Default を追加
  - $action\_map を App\_Urlhandler から App\_Plugin\_Urlhandler\_Defaultに移動する必要があります 
  - やっぱり戻しました。プラグインを呼び出したいときにApp\_UrlHandlerクラスで指定するように変更。
- プラグインのクラスが既に存在する場合は特別にファイルの検索をスキップするようにした。
- Ethna\_ViewClass::\_getFormInput\_\* で $separator のデフォルトを '' から "\n" に変更
- Ethna\_Controller::\_trigger\_XMLRPC で $GLOBALS['HTTP\_RAW\_POST\_DATA'] を使わずに 'php://input' を使うように変更
  - php.ini の設定が不要になりました。
- Ethna\_MailSender
  - $type 引数を $template と rename して、より積極的にテンプレート名と解釈するようにした。
    - $def を特に指定しなければ ViewClass の forward\_name と同様に template/ja/mail/ 以下からテンプレートを探します。
  - multipart: 2 つ以上の添付、ファイル名を指定した添付に対応しました。
    - ただしデフォルトの content-type は application/octet-stream でごまかしているのと、日本語ファイル名がてきとうです。
- Ethna\_Renderer, Ethna\_Renderer\_Smarty
  - perform() の第2引数に $capture フラグを追加
  - true のときは Smarty 的に display でなく fetch になります。
- Ethna\_Util::isRootDir() 追加
- ethna\_make\_packageで.svnに対応
- Ethna\_Plugin\_Validator\_Mbregexp　追加 (thx: mumumu)
  - mb\_eregを使ったマルチバイト対応正規表現プラグイン
  - [http://ethna.jp/ethna-document-dev\_guide-form-validate.html](ethna-document-dev_guide-form-validate.html)
- Ethna\_Plugin\_Handle\_PearLocal　追加
  - PEARパッケージを各プロジェクト毎に管理できるプラグイン
  - [http://ethna.jp/ethna-document-dev\_guide-pearlocal.html](ethna-document-dev_guide-pearlocal.html)
- View のユニットテストができなくなっていたバグを修正(thx: sfio, ethna-users:0651)

#### bug fixes [](ethna-document-changes.html#v1862c6a "v1862c6a")

- raiseError()類の引数が間違っていたのを修正 (thx: sfio)
- プラグインパッケージインストール時に '{$application\_id}' が置換されないバグを修正
- add-template が正しく動作していなかったのを修正
- Ethna\_ViewClass::\_getFormInput\_Select で multiple を考慮していなかったのを修正
- Ethna\_AppObject::\_getSQL\_SearchId で救済になってないエラーのスキップを削除
  - 有効な key がないときに、どちらにしろ SQL エラーになってた
- OS\_WINDOWSでgetAppController()が無限ループになっていたのを修正
  - ルートディレクトリ判定に失敗していた
- Console\_Getoptなどのアップグレードに対応
  - php4対応のreference返しがなくなっていたのに伴って発生していたnoticeを回避
- xmlrpcのパラメータがActionFormに渡っていなかったのを修正(#9845)
- file\_type の検査 が機能しない問題を修正
- MailSenderでテンプレートファイルを指定しない場合の挙動を修正
- MailSenderのBare LFをCRLFに置換(#9898, ethna-users:0588)
- Smarty の $script 変数の値が、PATH\_INFOの値が含まれると潜在的に誤動作するバグを修正(thx: cockok, ethna-users:0687)

### 2.3.1 [](ethna-document-changes.html#v441c2bd "v441c2bd")

#### features [](ethna-document-changes.html#fc9fb6d9 "fc9fb6d9")

- ethnaコマンドで@PHP-BIN@が置換されずに残っている場合(CVS版を使っているときなど)に対応
- デフォルトテンプレートにバージョン番号をこっそり追加

#### bug fixes [](ethna-document-changes.html#ce09d4b1 "ce09d4b1")

- Mac/Windowsでpear経由でのインストールに失敗していた問題を解消
  - すべてのroleをphpにして、ethna.{sh,bat}のみscriptを指定
- Ethna\_ViewClass::setPlugin() で $plugin の検証に is\_callable を使用 (ethna-users:0507)
- install-plugin が正しく動いていなかったのを修正 (#9582)
- ethna.shでPHPのパスが指定されていなかったのを修正(ethna-users:0508)
- Ethna\_AppObjectで'key'の条件にunique\_key, multiple\_keyが漏れていたのを修正
- Ethna\_ViewClassで<label id="foo">となっていたのを<label for="foo">に修正
- AppObject::searchPropとAppObject::searchIdの動作がおかしかったので修正

### 2.3.0 [](ethna-document-changes.html#y59f79c2 "y59f79c2")

2.3.0-dev (preview3) と機能的に大きな変更はありません。

### 2.3.0-dev (preview3) [](ethna-document-changes.html#td6ece9d "td6ece9d")

#### features [](ethna-document-changes.html#d0a66a59 "d0a66a59")

- ethnaコマンドのハンドラ再編
  - 全般的にgetopt化
    - "--basedir" で対象アプリの場所を指定
    - "--skelfile" で生成元のスケルトンファイルを指定
  - 全てのgeneratorで "アプリ -> Ethna本体" の順にスケルトンファイルを探すように変更
  - add-action-cli, add-action-xmlrpcを廃止、add-actionに "--gateway=www|cli|xmlrpc" を追加
  - add-entry-point追加
    - ethna add-entry-point --gateway=cli foo で bin/foo.php, app/action/Foo.php を生成
  - pearコマンドを使うハンドラに "--pearopt" を追加(experimental)
    - ethna install-plugin -p--alldeps -p--force foo bar のように指定する
  - Ethna\_Handle::\_getopt()の出力を変更

- misc追加
  - plugin packagerのサンプル
  - おまけ: \_ethna (zshの補完関数)

- Smarty, PEAR\_DBのincludeのタイミングを変更
  - 必要時に Ethna\_ClassFactory::\_include() を使うようにした。

- Ethna\_AppObjectをpostgres, sqliteに簡易対応
  - 1テーブルの1レコードが1オブジェクトに対応するような単純なモデルのみ対応
  - まだdb typeごとに調整が必要になることがあります。
  - pgsqlでsequenceに対応
  - テーブル名、カラム名の自動quoteに対応

- add-\* ハンドル機能追加
  - add-template: --skelfile オプションで生成元のスケルトンファイルを指定できるようにした

- {form\_input}ヘルパー
  - select, radio, checkboxに対応
  - 選択肢をフォーム定義で指定できるようにした(afのmethod, property, managerなど)
  - 外側の{form}ブロックからaction名, default値を取得できるようにした
  - フォーム定義からもdefault値を指定できるようにした

- Ethna\_Plugin\_Handle\_{Install,Upgrade}Plugin に --state オプションを追加
- local のプラグインの prefix を App に変更(app\_idの予約語扱い)

- Ethna\_Plugin\_Handle\_ClearCache 追加
  - 現状 smarty, pear, cachemanager\_localfile, tmp以下問答無用で削除、のみの対応
- ethna\_error\_handler() の print 条件を変更
  - Logwriter プラグイン化に伴う $has\_echo 条件のバグを修正
  - $has\_echo に加えて $config->get('debug') を見るようにした
- Ethna\_Handle で Ethna\_Controller と App\_Controller が共存する場合の扱いが混乱していたのを整理
- Ethna\_Hanlde に mkdir(), chmod(), purgeDir() を追加
- Cachemanager プラグイン中の PEAR::raiseError() を Ethna::raiseError() に変更
- Ethna\_Logger で Ethna\_Config オブジェクトの取得に失敗したときの処理を修正
- ethna {install,uninstall,upgrade}-plugin で skel から generate されるファイルの上書き確認を廃止

- Ethna\_Plugin\_Handle\_ListPlugin
  - パッケージ管理に係わらずプラグインの一覧を表示
  - パッケージ管理下にあるときはパッケージ名とバージョンを表示
- Ethna\_Plugin\_Handle\_UpgradePlugin, Ethna\_Plugin\_Handle\_ChannelUpdate
  - プラグインパッケージのupgrade, pear channelのupdateに対応
  - [http://pear.server/get/Package-1.2.3.tgz](http://pear.server/get/Package-1.2.3.tgz) のようなinstall, upgradeに対応
- PearWrapper, Ethna\_Handleでのデフォルトターゲット(localかmasterか)をlocalに変更、統一
- Ethna\_Plugin\_Handle\_{Install,Uninstall,Info,List}Plugin
  - master, localのハンドラを分けていたのを統合
  - ダウンロード済みの tgz に対応
  - Console\_GetOpt で --channel, --basedir, --local, --master のオプションを追加
  - new PEAR\_Error() 時の error handler を callback($ui, 'displayFatalError') に変更

- Ethna\_UrlHandlerクラスを追加(ステキurl対応)
- Smartyプラグイン関数smarty\_function\_url追加
- Ethna\_AppObjectからのフォーム定義生成サポート追加
  - [2006/08/23] 激しくα
- Ethna\_ClassFactory::getObject()でクラス定義に無いキーが渡された場合はEthna\_AppObject()のキーであると仮定してオブ>ジェクト生成
- アプリケーションスケルトン生成時にアプリケーション固有のActionClass, ActionForm, ViewClassも生成するように変更
- Ethna\_SkeltonGeneratorクラスをEthna\_Generatorクラスに名称変更
- Ethna\_SkeltonGeneratorクラスの各メソッドをプラグイン化
- Ethna\_Config::get()で引数を指定しないと全設定を格納した配列を返すように変更
- Ethna\_ViewClass::\_getTemplateEngine()で設定値を格納した$configテンプレート変数を設定するように変更
- Ethnaのパッケージシステムを追加
  - ethna用のpear channelからプラグインのパッケージをインストールできるようになります
  - Ethna\_PearWrapper, Ethna\_Plugin\_Handle\_{Install,Info,List,Uninstall}\_Plugin\_{Master,Local}を追加
  - local: アプリケーション(プロジェクト)のディレクトリ、master: Ethna本体のあるディレクトリのイメージです
  - PearWrapperはethnaコマンド(Handle)から呼び出されることが前提
  - Ethna\_SkeltonGeneratorにあったメソッドをEthna\_Handleに移動、少し追加

- エラーハンドリング方針を多少変更
  - @演算子を使ったエラー抑制を廃止

#### bug fixes [](ethna-document-changes.html#f7229bed "f7229bed")

- [#9009](http://sourceforge.jp/tracker/index.php?func=detail&aid=9009&group_id=1343&atid=5092)(%s等があるSQLをEchoLoggerでDebugするとWarning)
- アクション定義のform\_pathが正しく動作していなかった問題を修正
- コントローラが複数あるときにset\_error\_handler()が何度も実行されるのを回避
- CacheManager\_Localfileの@statでのWARNINGを回避
- Ethna\_Plugin\_Validator\_Customでエラーが2重登録されていたのを修正
- プラグインの親クラスがないときにエラーになっていたのを修正

### 2.3.0-dev (preview2まで) [](ethna-document-changes.html#ab6db952 "ab6db952")

#### features [](ethna-document-changes.html#gdfb14bc "gdfb14bc")

- [breaking B.C.] Ethna\_ClassFactoryのリファクタリング
  - Ethna\_Backend::getObject()メソッドを追加しました
  - これにより、Ethna\_Controllerの$classメンバに

    $class = array(
      // ...
      'user' => 'Some_Foo_Bar',
    ),

と記述することで

    $user =& $this->backend->getObject('user');

としてSome\_Foo\_Barクラスのオブジェクトを取得することが出来ます
  - クラス定義が見つからない場合は下記の順でファイルを探しに行きます(include\_path)
    1. Some\_Foo\_Bar.php
    2. Foo/Some\_Foo\_Bar.php
    3. Foo/Bar.php
    4. Some/Foo/Bar.php

- アプリケーションマネージャの生成もEthna\_ClassFactoryで行われます(Ethna\_ClassFactory::getManager()が追加されています)
- これに伴い、〜2.1.xではコントローラクラスに

    $manager = array(
      'um' => 'User',
    );

のように記述されていると、Ethna\_ActionClass、Ethna\_ViewClass、Ethna\_AppObject、Ethna\_\*Managerで

    $this->um

としてマネージャオブジェクトにアクセスできていたのですが、この機能が廃止されています(不評なら戻します@preview2)

- Ethna\_Plugin\_Logwriter\_File::begin()でログファイルのパーミッションを設定するように変更
- ハードタブ -> ソフトタブ
- test runnerの追加
- [breaking B.C.] Ethna\_Loggerリファクタリング
  - Ethna\_LogWriterのプラグイン化
  - カンマ区切りでの複数ファシリティサポート
  - \_getLogWriter()クラスをオーバーライドしている方に影響があります(2.3.0以降はPlugin/Logwriter以下にLogwriterクラスを置いて、ファシリティでその名前を指定すれば任意のLogwriterを追加可能です)
- [breaking B.C.] Ethna\_Renderer追加
  - 〜2.1.xでは直接扱っいてたテンプレートエンジンオブジェクトをEthna\_Rendererクラスでwrapしました
  - Ethna\_Controller::getTemplateEngine()はobsoleteとなりますので今後はEthna\_Controller::getRenderer()をご利用ください
  - Ethna\_Controller::\_setDefaultTemplateEngine(), Ethna\_View::\_setDefault(), Ethna\_Controller::getTemplateEngine()の引数、戻り値は2.1.xまでのSmartyオブジェクトではなくEthna\_Rendererオブジェクトとなります
  - これに伴い、Ethna\_Controller::\_setDefaultTemplateEngine(), Ethna\_Controller::getTemplateEngine()を利用しているアプリケーションではアップデート時にEthna\_Renderer::getEngine()を利用して後方互換性を維持するように変更が必要となります

    e.g.
    $smarty =& $this->controller->getTemplateEngine();
    →
    $renderer =& $this->controller->getTemplateEngine();
    $smarty =& $renderer->getEngine();- プラグインシステム追加(w/ Ethna_Pluginクラス)

  - Ethna\_Handle, Ethna\_CacheManager, Ethna\_LogWriterをプラグインシステムに移行
  - Ethna\_ActionFormのバリデータをプラグインシステムに移行(Ethna\_ActionForm::use\_validator\_pluginがtrueのときのみ)
  - see also
    - [Ethna\_Pluginのつかいかた](ethna-document-dev_guide-plugin.html)
    - [フォーム値の自動検証を行う(プラグイン編)](ethna-document-dev_guide-form-validate_with_plugin.html)
- ethnaコマンドにアクション名、ビュー名のチェック処理を追加(Ethna\_Controller::checkActionName(), Ethna\_Controller::checkViewName()を追加)
- Ethna\_CacheManager\_Memcache(キャッシュマネージャのmemcacheサポート)追加
- Ethna\_Sessionにregenerate\_idメソッドの追加
- Ethna\_Plugin\_Csrf(CSRF対策コード)追加

#### bug fixes [](ethna-document-changes.html#rca73e53 "rca73e53")

- Ethna\_DB\_PEAR, Ethna\_AppObjectのWARNINGを回避([ethna-users:0383])
- Windowsでホームディレクトリの.ethnaファイルが参照されない問題を修正
- session\_startしていないとrestoreメソッドがうまく動かない問題を修正
- ethnaコマンドにサポートされていないオプションのみを指定して起動した場合(ethna -hなど)にFatal Errorとなる問題を修正
- Ethna\_Backend::getDBのNoticeエラーを修正
- キャッシュマネージャのエラーコードが256以上(アプリケーション用)になっていた問題を修正
- ethna add-action-testしたときにファイルがapp/action\_cliに生成されてしまう問題を修正
- Ethna\_SkeltonGeneratorクラスのtypoを修正(proejct -> project)

### [2006/06/07] 2.1.2 [](ethna-document-changes.html#g8fcb364 "g8fcb364")

#### bug fixes [](ethna-document-changes.html#kbc428f8 "kbc428f8")

- Ethna\_Controller::getActionRequest()メソッドのデフォルト状態の振舞いを修正

### [2006/06/07] 2.1.1 [](ethna-document-changes.html#oc69ebd0 "oc69ebd0")

#### bug fixes [](ethna-document-changes.html#i7461adf "i7461adf")

- ethna.batのパスを修正

### [2006/06/06] 2.1.0 [](ethna-document-changes.html#dbbb91ac "dbbb91ac")

#### features [](ethna-document-changes.html#gab2078d "gab2078d")

- ethnaコマンドのETHNA\_HOMEをインストール時に決定するように改善
- Ethna\_ActionForm::validate() で多次元配列が渡されたときのnoticeを回避
- Ethna\_Backend::setActionForm(), Ethna\_Backend::setActionClass()メソッドを追加
- Ethna\_FilterのスケルトンにpreActionFilter()/postActionFilter()を追加
- Ethna\_AppObject::\_getPropDef()にキャッシュ処理を追加
- Ethna\_CacheManagerクラスを追加(w/ localfile) - from GREE:)
- Ethna\_DB::getDSN()メソッドを追加
- iniファイルのスケルトンにdsnサンプル追加
- add-templateコマンド追加(by nnno)
- add-project時のデフォルトテンプレートデザインを変更
- ethnaコマンドに-v(--version)オプションを追加
- smarty\_modifier\_select(), smarty\_function\_select()の"selected"属性のxhtml対応(selected="true")
- {form\_name}, {form\_input}プラグイン追加(激しくexperimentalというかongoing)
- Ethna\_ViewClassでhelperアクションフォーム対応
  - Ethna\_ViewClass->helper\_action\_form = array('some\_action\_name' => null, ...)とすると{form\_name}とかで使えます
- [breaking B.C.] Ethna\_ActionClassのpreforward()サポート(むかーしのコードにありましたのです)削除
- (ぷち)省エネブロックプラグイン{form}...{/form}追加
  - ethna\_action引数も追加(勝手にhiddenタグ生成)
- Ethna\_Controllerに$smarty\_block\_pluginプロパティを追加
- ethnaコマンドにadd-action-cliを追加
- [breaking B.C.] main\_CLIのアクション定義ディレクトリをaction\_cliに変更
  - controllerのdirectoryプロパティに'bin'要素を追加
- ethnaコマンドにadd-app-managerを追加(thanks butatic)
- Ethna\_ActionForm リファクタリング (by いちい)
  - $this->form の省略値補正を setFormVars() からコンストラクタに移動
  - フォーム値のスカラー/配列チェックを setFormVars() でするように変更
    - vaildate() する前に setFormVars() でエラー (handleError()) が発生することがあります
  - フォーム値のスカラー/配列チェックでフォーム値定義と異なる場合は null にする
  - ファイルデータの再構成を常に行うように変更
  - フォーム値定義が配列で required, max/min の設定がある場合のバグを修正
  - \_filter\_alnum\_zentohan() を追加 (mb\_convert\_kana($value, "a"))
- XMLRPCゲートウェイにfaultCodeサポートを追加
  - actionでEthna\_Error(あるいはPEAR\_Error)オブジェクトを返すとエラーを返せます
- XMLRPCゲートウェイサポート追加(experimental)
  - ethna add-action-xmlrpc [action]でXMLRPCメソッドを追加可能
  - 引数1つとフォーム定義1つが定義順に対応します
  - ToDo
    - 出力バッファチェック
    - method not foundなどエラー処理対応
- Ethna\_ActionFormクラスのコンストラクタでsetFormVars()を実行しないように変更
- スケルトンに含まれる'your name'をマクロ({$author})に変更(~/.ethna対応)
- なげやり便利関数file\_exists\_ex(), is\_absolute\_path()を追加
- SimpleTestとの連携機能を追加(ethnaコマンドにadd-action-test,add-view-testの追加など)
  - SimpleTestのインストールチェックを追加
- package.xml生成スクリプト改善(ethnaコマンドインストール対応など)
- Haste\_ADOdb, Haste\_Creoleマージ(from Haste Project by haltさん)
- Ethna\_AppObjectクラスのテーブル/プロパティ定義自動生成サポート追加(from generate\_app\_object originally by 井上さん+haltさん)
- Ethna\_Controller::getAppdir()メソッドを追加
- Ethna\_Controller::getDBType()の引数がnullだった場合に定義一覧を返すように変更
- ethnaコマンドラインハンドラを追加(+ハンドラをpluggableに+add-viewでテンプレート生成サポート)−please cp bin/ethna to /usr/local/bin or somewhere

    generate_project_skelton.php -> ethna add-project
    generate_action_script.php -> ethna add-action
    generate_view_script.php -> ethna add-view
    generate_app_object.php -> ethna add-app-object

- [breaking B.C.] client\_typeを廃止 -> gateway追加
  - CLIENT\_TYPE定数廃止
  - Ethna\_Controller::getClientType(), Ethna\_Controller::setClientType()廃止
  - Ethna\_Controller::setCLI()/Ethna\_Controller::getCLI() -> obsolete
  - GATEWAY定数追加(GATEWAY\_WWW, GATEWAY\_CLI, GATEWAY\_XMLRPC, GATEWAY\_SOAP)
  - Ethna\_Controller::setGateway()/Ethna\_Controller::getGateway()追加
  - 作りかけのAMFゲートウェイサポートを(一旦)廃止
- Ethna\_SkeltonGenerator::\_checkAppId()をEthna\_Controller::checkAppId()に移動
- generate\_app\_objectを追加
- クラスのメソッドもSmartyFunctionとして登録できるように修正

#### bug fixes [](ethna-document-changes.html#x4119af0 "x4119af0")

- [#8435](http://sourceforge.jp/tracker/index.php?func=detail&aid=8435&group_id=1343&atid=5092)(Ethna\_AppObject prop\_def[]['seq']が未設定)
- [#8079](http://sourceforge.jp/tracker/index.php?func=detail&aid=8079&group_id=1343&atid=5092)(FilterでBackendを呼ぶとActionFormの値が空になる)
- [#8200](http://sourceforge.jp/tracker/index.php?func=detail&aid=8200&group_id=1343&atid=5092)(PHP5.1.0以降でafのvalidate()で日付チェックが効かない)
- [#8179](http://sourceforge.jp/tracker/index.php?func=detail&aid=8179&group_id=1343&atid=5092)(getManagerの戻り値が参照渡しになっていない)
- [#8400](http://sourceforge.jp/tracker/index.php?func=detail&aid=8400&group_id=1343&atid=5092)(AppObject prop\_def[]['form\_name']がNULL)
- [#7751](http://sourceforge.jp/tracker/index.php?func=detail&aid=7751&group_id=1343&atid=5092)(SAFE\_MODEでmail関数の第５引数があるとWaning)を修正
- [#8496](http://sourceforge.jp/tracker/index.php?func=detail&aid=8496&group_id=1343&atid=5092)(Ethna\_AppObject.php内のtypo)を修正
- [#8387](http://sourceforge.jp/tracker/index.php?func=detail&aid=8387&group_id=1343&atid=5092)(checkMailaddressやcheckURLでNotice)を修正
- [#8130](http://sourceforge.jp/tracker/index.php?func=detail&aid=8130&group_id=1343&atid=5092)(Noticeつぶし)を修正
- typo fixed (aleady -> already)
- [#7717](http://sourceforge.jp/tracker/index.php?func=detail&aid=7717&group_id=1343&atid=5092)(Ethna\_AppObject::add()でNotice)を修正
- [#7664](http://sourceforge.jp/tracker/index.php?func=detail&aid=7664&group_id=1343&atid=5092)(Ethna\_AppObjectのバグ)を修正
- [#7729](http://sourceforge.jp/tracker/index.php?func=detail&aid=7729&group_id=1343&atid=5092)(ethna\_infoがFirefoxだとずれる)を修正

- (within beta) ethna\_handle.phpが無用にob\_end\_clean()する問題を修正
- (within beta) ethna add-viewでプロジェクトディレクトリを指定した場合に正しくファイルが生成されない問題を修正
- (within beta) Windows版のethnaコマンドがパッケージからインストールした場合実行できない問題を修正
- (within beta) ActionFormの配列のフォーム値が破壊される問題を修正(by sfioさん)

### [2006/01/29] 0.2.0 [](ethna-document-changes.html#k8791d15 "k8791d15")

#### features [](ethna-document-changes.html#h9cea2ed "h9cea2ed")

- 文字列のmin/maxエラーのデフォルトエラーメッセージを修正
- フォーム値定義にカスタムエラーメッセージを定義できるように変更
- Ethna\_Controller::main\_CLI()メソッドにフィルタを無効化させるオプションを追加
- Ethna\_ActionFormクラスのフォーム値定義をダイナミックに変更出来るように修正
- Ethna\_ActionFormクラスのフォーム値定義にテンプレート機能を追加
- Ethna\_Backend::getActionClass()メソッドの追加(実行中のアクションクラスを取得)
- $HOME/.ethnaファイルによるユーザ定義スケルトンマクロの追加
- smarty\_function\_selectに$empty引数を追加
- mb\_\*の変換元エンコーディングを、utf-8固定から内部エンコーディングに変更
- Ethna\_Backend::begin()、Ethna\_Backend::commit()、Ethna\_Backend::rollback()を廃止
- Ethna\_Controller::getDB()をEthna\_Controller::getDBType()に変更
- Ethna\_DBクラスを抽象クラス(扱い)として新たにEthna\_DBクラスを実装したEthna\_DB\_PEARクラスを追加
- Ethna\_LogWriterクラスを抽象クラス(扱い)として新たにEthna\_LogWriterクラスを実装したEthna\_LogWriter\_Echo、Ethna\_LogWriter\_File、Ethna\_LogWriter\_Syslogクラスを追加
- log\_facilityがnullの場合のログ出力クラスをEthna\_LogWriter\_EchoからEthna\_LogWriterに変更(ログ出力なし)
- log\_facilityにクラス名を書いた場合はそのクラスをログ出力クラスとして利用するように変更
- Ethna\_Filter::preFilter()、Ethna\_Filter::postFilter()がEthna\_Errorオブジェクトを返した場合は実行を中止するように変更
- Ethna\_InfoManagerの設定表示項目を追加
- Ethna\_ActionForm::isForceValidatePlus()、Ethna\_ActionForm::setForceValidatePlus()メソッドと、$force\_validate\_plusメンバを追加($force\_validate\_plusをtrueに設定すると、通常検証でエラーが発生した場合でも\_validatePlus()メソッドが実行される−デフォルト:false)
- フォーム値定義のcustom属性にカンマ区切りでの複数メソッドサポートを追加

#### bug fixes [](ethna-document-changes.html#sa74560e "sa74560e")

- htmlspecialcharsにENT\_QUOTESオプションを追加
- Ethna\_AppSQLクラスのコンストラクタメソッド名を修正
- [#7659](http://sourceforge.jp/tracker/index.php?func=detail&aid=7659&group_id=1343&atid=5092)(Ethna\_Config.phpでNoticeエラー)を修正
- Ethna\_SOAP\_ActionForm.phpのtypoを修正
- [#6616](http://sourceforge.jp/tracker/index.php?func=detail&aid=6616&group_id=1343&atid=5092)(セッションにObjectを格納できない)を修正
- [#7640](https://sourceforge.jp/tracker/index.php?func=detail&aid=7640&group_id=1343&atid=5092)(機種依存文字のチェックでエラーメッセージが表示されない。)を修正
- [#6566](https://sourceforge.jp/tracker/index.php?func=detail&aid=6566&group_id=1343&atid=5092)(skel.action.phpのサンプルでtypo)を修正
- [#7451](https://sourceforge.jp/tracker/index.php?func=detail&aid=7451&group_id=1343&atid=5092)(PHP 5.0.5対応)を修正
- .museum対応
- Ethna\_Backendクラスのクラスメンバ多重定義を修正
- BASE定数の影響でコントローラの継承が困難な問題を修正
- Windows環境で定義されていないLOG\_LOCAL定数を評価してしまう問題を修正
- [#6423](http://sourceforge.jp/tracker/index.php?func=detail&aid=6423&group_id=1343&atid=5092)(php-4.4.0で大量のエラーの後、Segv(11))を修正(patch by ramsyさん)
- [#6074](http://sourceforge.jp/tracker/index.php?func=detail&aid=6074&group_id=1343&atid=5092)(generate\_project\_skelton.phpの動作異常)を修正
- safe\_mode=onの場合にuid/gid warningが発生する(可能性のある)問題を修正
- 不要な参照渡しを削除
- その他細かな修正(elseif -> else if等)
- PATH\_SEPARATOR/DIRECTORY\_SEPARATORが未定義の場合(PHP 4.1.x等)の問題を修正
- smarty\_modifier\_wordwrap\_i18n()の改行対応
- ユーザ定義フォーム検証メソッドが呼び出されない(ことがある)問題を修正
- マルチカラムプライマリキー利用時にオブジェクトの正当性が正しく判別できない問題を修正
- Ethna\_AppObjectのJOIN検索がSQLエラーになる（ことがある）問題を修正
- セッションを復帰させるタイミングを遅延(無限ループする問題を修正)
- Ethna\_MalSenderからmail()関数にオプションを渡せるように修正
- Ethna\_View\_List::\_fixNameObjectに対象オブジェクトも渡すように修正

### [2005/03/02] 0.1.5 [](ethna-document-changes.html#rel-0-1-5 "rel-0-1-5")

#### features [](ethna-document-changes.html#scfb0108 "scfb0108")

- Ethna\_Controller::getCLI()(CLIで実行中かどうかを返すメソッド)を追加
- ethna\_error\_handlerがphp.iniの設定に応じてPHPログも出力するように変更
- Smartyプラグイン(truncate\_i18n)を追加
- Ethna\_AppObject/Ethna\_AppManagerにキャッシュ機構を追加(experimental)
- メールテンプレートエンジンのフックメソッドを追加
- MIMEエンコード用ユーティリティメソッドを追加
- include\_pathのセパレータのwin32対応

#### bug fixes [](ethna-document-changes.html#z0759cf5 "z0759cf5")

- ethna\_error\_handlerのtypoを修正
- Ethna\_Sessionクラスでログが正しく出力されない問題を修正

### [2005/01/14] 0.1.4 [](ethna-document-changes.html#rel-0-1-4 "rel-0-1-4")

#### features [](ethna-document-changes.html#je3ba4db "je3ba4db")

- Ethna\_AppObjectでJOINした場合に、(可能なら)プライマリキーでGROUP BYするように変更

#### bug fixes [](ethna-document-changes.html#f2e0771a "f2e0771a")

- \_\_ethna\_info\_\_が全く動作しない問題を修正:(

### [2004/01/13] 0.1.3 [](ethna-document-changes.html#rel-0-1-3 "rel-0-1-3")

#### アップデート時の注意点 [](ethna-document-changes.html#xb217e10 "xb217e10")

バージョン0.1.2以前のバージョンから0.1.3へアップデートする場合は以下の2点にご注意ください。

1. Ethna\_ActionForm::\_handleError()のメソッド名変更  

&nbsp;
Ethna\_ActionForm::\_handleError()をpublicメソッドに変更した影響で、メソッド名がEthna\_ActionForm::handleError()に変更されています。アプリケーションで直接\_handleError()を呼び出している場合は、これをhandleError()に変更してください。  

&nbsp;
2. コントローラの$classメンバの変更  

&nbsp;
Ethna\_ClassFactoryの導入により、コントローラの$classメンバに設定が必要なエントリが追加されています。アプリケーションのコントローラの$classメンバを以下のように変更してください。  

    var $class = array(
    + 'class' => 'Ethna_ClassFactory',
    + 'backend' => 'Ethna_Backend',
         'config' => 'Ethna_Config',
         'db' => 'Ethna_DB',
    + 'error' => 'Ethna_ActionError',
    + 'form' => 'Ethna_ActionForm',
    + 'i18n' => 'Ethna_I18N',
         'logger' => 'Ethna_Logger',
    + 'session' => 'Ethna_Session',
         'sql' => 'Ethna_AppSQL',
    + 'view' => 'Ethna_ViewClass',
     );

#### features [](ethna-document-changes.html#ec80b849 "ec80b849")

- Ethna\_AppSearchObjectの複合条件対応
- Ethna\_ClassFactoryクラスを追加
- Ethna\_Controllerのbackend, i18n, session, action\_errorメンバを廃止
- Ethna\_Controller::getClass()メソッドを廃止
- Ethna\_ActionClassにauthenticateメソッドを追加
- preActionFilter/postActionFilterを追加(experimental)
- Ethna\_View\_List(リスト表示用ビュー基底クラス)のソート対応
- 組み込みSmarty関数is\_error()を追加
- Ethna\_ActionForm::handleErrorの第2引数を廃止
- Ethna\_ActionForm::\_handleErrorをpublicメソッドに変更(Ethna\_ActionForm::handleErrorに名称変更)
- Ethna\_ActionForm::getDefメソッドに引数を追加(省略可)

#### bug fixes [](ethna-document-changes.html#qeb63a6e "qeb63a6e")

- フォーム定義に配列を指定していた場合のカスタムチェックメソッドの呼び出しが正しく行われない問題を修正
- フォーム定義に配列を指定していた場合の必須チェックが正しく行われない問題を修正
- \_\_ethna\_info\_\_がサブディレクトリに定義されたアクションを正しく取得できない問題を修正
- VAR\_TYPE\_FILEの場合はregexp属性が無効になるように修正

### [2004/12/23] 0.1.2 [](ethna-document-changes.html#rel-0-1-2 "rel-0-1-2")

#### features [](ethna-document-changes.html#n8933f4c "n8933f4c")

- \_\_ethna\_info\_\_アクションを追加
- class\_path, form\_path, view\_path属性のフルパス指定サポートを追加
- スクリプトを1ファイルにまとめるツール(bin/unify\_script.php)を追加

#### bug fixes [](ethna-document-changes.html#v3acc77d "v3acc77d")

- プロジェクトスケルトン生成時にアプリケーションIDの文字種/予約語をチェックするように修正
- 'form\_name'を指定すると無用に警告が発生する問題を修正
- 絶対パス判定のプラットフォーム依存を修正(Windows対応改善)
- VAR\_TYPE\_INTとVAR\_TYPE\_FLOATの定義値が重複していた問題を修正
- SOAP/Mobile(AU)でアクションスクリプトのパスが正しく取得できない問題を修正
- Ethna\_Util::getRandom()でmt\_srand()しつつrand()を呼んでいた箇所をmt\_rand()を呼び出すように修正
- CHANGESのエンコーディング修正(ISO-2022-JP -> utf-8)
- フレームワークが発行するSQL文に一部残っていたセミコロンを削除
- エントリポイント(index.php)に記述されたデフォルトアクション名の1要素目にアスタリスクが使用されていると、正しく動作しない(かもしれない)問題を修正  
例(こんな場合):

    <?php
    include_once('../../app/Sample_Controller.php');
    Sample_Controller::Main('Sample_Controller', array(
     'login*',
    ));
    ?>

### [2004/12/10] 0.1.1 [](ethna-document-changes.html#rel-0-1-1 "rel-0-1-1")

#### bug fixes [](ethna-document-changes.html#vbdfa3ac "vbdfa3ac")

- ビューオブジェクトのpreforward()が呼ばれないことがある問題を修正
- アクション/ビューのスケルトン生成時にファイルを上書きしないように修正
- ビューのスケルトンでクラス名が正しく置換されない問題を修正

### [2004/12/09] 0.1.0 [](ethna-document-changes.html#rel-0-1-0 "rel-0-1-0")

- 初期リリース

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
