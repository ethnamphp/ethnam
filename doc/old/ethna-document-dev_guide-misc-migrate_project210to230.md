# Ethna 2.1.0 から 2.3.0 への移行ガイド
Ethna 2.1.x で作った古いプロジェクトを新しいバージョン 2.3.x 系に対応させるためのガイドラインです。(これに従えばうまくいく、というわけではありません。必ずバックアップを用意した上で、確認しながら作業するようにしてください。)

※ Ethna 2.3.0 から 2.5.0 への移行については、 [こちら](ethna-document-dev_guide-misc-migrate_project230to250.html "ethna-document-dev\_guide-misc-migrate\_project230to250 (737d)") を御覧下さい。

- Ethna 2.1.0 から 2.3.0 への移行ガイド 
  - タグの説明 
    - [必須]最新バージョンで追加されたファイルをインストールする 
    - [必須]アプリケーションの基底クラスを使うように変更する 
    - [必須] アプリケーションマネージャのアクセス方法を変更 
    - [必須] Ethna\_Renderer導入への対応 
    - [任意] Ethna\_Pluginで導入されたものを使う 
    - [使っていれば必須] Ethna\_Pluginで廃止されたものを 
    - [任意] Ethna\_UrlHandlerを使う 

| 書いた人 | いちい | | |
| 書いた人 | halt | 2006-11-22 20 | 勝手に編集 |

**この内容はまだ途中です!!**

### タグの説明 [](ethna-document-dev_guide-misc-migrate_project210to230.html#u2d47dda "u2d47dda")

- [必須]は、やっておかないとダメだよね。[任意]を実現するには[必須]が必要
- [任意]は、やる事で上位バージョンの恩恵を受ける事ができるけどやらなくても動くよ。
- [下位互換]は、これをやる事で最新のEthnaを使っていても前と下位と同じ(か似たような)挙動になるよ。

#### [必須]最新バージョンで追加されたファイルをインストールする [](ethna-document-dev_guide-misc-migrate_project210to230.html#k1d6e939 "k1d6e939")

古いプロジェクトを上書きするようにadd-projectしてください。これにより、新しいEthnaのプロジェクトファイルに必要だが存在しないファイルのみ新規に追加されます。

    $ ls
    sampleapp
    $ ethna add-project sampleapp

#### [必須]アプリケーションの基底クラスを使うように変更する [](ethna-document-dev_guide-misc-migrate_project210to230.html#q6404f3c "q6404f3c")

アクションやビューに基底となるクラスを追加する事でアプリケーション全体で利用されるアクションやビューのふるまいを制御する事ができるようになります。

- すべてのActionFormの継承先変更

    -class Sampleapp_Form_Index extends Ethna_ActionForm
    +class Sampleapp_Form_Index extends Sampleapp_ActionForm

- すべてのActionの継承先変更

    -class Sampleapp_Action_Index extends Ethna_ActionClass
    +class Sampleapp_Action_Index extends Sampleapp_ActionClass

- すべてのViewの継承先変更

    -class Sampleapp_View_Index extends Ethna_ViewClass
    +class Sampleapp_View_Index extends Sampleapp_ViewClass

全てのアクション、ビューのファイルを変更しないといけないので、 "extends Ethna\_" などで検索するとかして変更忘れがないように気をつけてください(変更忘れは発見しにくいバグのもとになりやすいです)。

- アプリケーションの基底クラスをコントローラに追加する

- include\_onceの追加

    include_once('Ethna/Ethna.php');
     include_once('Sampleapp_Error.php');
    +include_once('Sampleapp_ActionClass.php');
    +include_once('Sampleapp_ActionForm.php');
    +include_once('Sampleapp_ViewClass.php');
    
    /**
     *

- クラスの追加

    'config' => 'Ethna_Config',
            'db' => 'Ethna_DB_PEAR',
            'error' => 'Ethna_ActionError',
    - 'form' => 'Ethna_ActionForm',
    + 'form' => 'Sampleapp_ActionForm',
            'i18n' => 'Ethna_I18N',
            'logger' => 'Ethna_Logger',
    + 'plugin' => 'Ethna_Plugin',
            'session' => 'Ethna_Session',
            'sql' => 'Ethna_AppSQL',
    - 'view' => 'Ethna_ViewClass',
    + 'view' => 'Sampleapp_ViewClass',
    + 'renderer' => 'Ethna_Renderer_Smarty',
    + 'url_handler' => 'Sampleapp_UrlHandler',

#### [必須] アプリケーションマネージャのアクセス方法を変更 [](ethna-document-dev_guide-misc-migrate_project210to230.html#se5d596a "se5d596a")

class factory(Ethna\_ClassFactory)の汎用化により、Ethnaで登場する多くのクラスがEthna\_ClassFactory経由で取得されるようになりました。これにより、クラスのソースファイが統一された基準で自動的に検索され、統一されたインタフェースでオブジェクトを取得できるようになりました(くわしくは [クラスファクトリ](ethna-document-dev_guide-classfactory.html "ethna-document-dev\_guide-classfactory (1240d)")を参照)。

これに伴い、いままでアクション(Ethna\_ActionClassの継承クラス)、ビュー(Ethna\_ViewClass)、アプリケーションオブジェクト(Ethna\_AppObject)では自動的にオブジェクトのプロパティに設定されていましたが、これが廃止されました。

コントローラの

    var $manager = array(
        'un' => 'User',
    );

といった記述をして、アクションなどで

    $this->um->doSomething();

などとしている場合、次のように書き換えてください。

    $um =& $this->backend->getManager('User');
    $um->doSomething();

なお、アプリケーションマネージャはオブジェクト作成時にデータベースに(設定されていれば)接続しますが、これによって必要時に初めて接続するように変更されたことになります。

#### [必須] Ethna\_Renderer導入への対応 [](ethna-document-dev_guide-misc-migrate_project210to230.html#d53f2e0f "d53f2e0f")

これまでEthnaはSmartyに依存した作りになっていましたが、Ethna\_Rendererの導入により、レンダラというレイヤを挟んで1段抽象化されました。まだSmartyに依存した部分がコントローラなどにいくつか残っていますが、今後改良される予定です。

大きな違いとして、Ethna\_ViewClassがSmartyオブジェクトを直接持つのを止めて、RendererオブジェクトがSmartyを持つようにし、さらにRendererオブジェクトはEthna\_ClassFactoryが管理するように変更されました。アプリのビュークラスの中で直接Smartyオブジェクトを操作していた場合、

    $this->smarty->assign('foo', $bar);

次のように修正してください。

    $renderer =& $this->_getRenderer();
    $smarty =& $renderer->getEngine();
    $smarty->assign('foo', $bar);

一度$rendererを取得するのが手間ですが、assignのような、多くのレンダラに共通であろうものについてはEthna\_Rendererクラスでメソッドが用意されています。

    $renderer =& $this->_getRenderer();
    $renderer->setProp('foo', $bar);

ここで、setProp()は各テンプレートエンジンごとの「レンダラに値を設定」するプロキシメソッドです。詳細は [Ethna\_Rendererの使いかた](ethna-document-dev_guide-renderer.html "ethna-document-dev\_guide-renderer (1240d)")を参照してください。

#### [任意] Ethna\_Pluginで導入されたものを使う [](ethna-document-dev_guide-misc-migrate_project210to230.html#s32c8cb9 "s32c8cb9")

新たに追加された機能で、Ethna\_Pluginを利用したものについてまとめておきます。おもに、似たような枠組でさまざまな機能を用意したいもの、アプリケーション側で手軽に拡張を追加したくなるようなものがプラグイン化されています。詳しくは各説明ページと [Ethna\_Pluginのつかいかた](ethna-document-dev_guide-plugin.html "ethna-document-dev\_guide-plugin (737d)")を参照してください。

- Cachemanager
  - キャッシュ機構です。(ドキュメント未整備)
- Csrf
  - CSRF対策のためのプラグイン。 [クロスサイトリクエストフォージェリの対策コードについて](ethna-document-dev_guide-csrf.html "ethna-document-dev\_guide-csrf (1240d)")を参照。
- Filter
  - Ethna\_Filterがプラグインになったものです。 [フィルタチェインを使用する](ethna-document-dev_guide-app-filterchain.html "ethna-document-dev\_guide-app-filterchain (1240d)")を参照(内容が古いまま)
- Validator
  - フォーム値の検証をするプラグインです。 [フォーム値の自動検証を行う(プラグイン編)](ethna-document-dev_guide-form-validate_with_plugin.html "ethna-document-dev\_guide-form-validate\_with\_plugin (513d)")を参照。
- Logwriter
  - ログ出力のプラグインです。 [ログ](ethna-document-dev_guide-log.html "ethna-document-dev\_guide-log (874d)")を参照。

#### [使っていれば必須] Ethna\_Pluginで廃止されたものを [](ethna-document-dev_guide-misc-migrate_project210to230.html#h1f67d2b "h1f67d2b")

Ethna\_Plugin導入に伴い、フィルタ、ethnaコマンドのハンドラなど、多くのものがプラグイン化されました。アプリ側で対象となるクラスを直接使っていた場合に修正が必要になりますが、そのような場面は非常に少ないと思いますので[任意]としました。

- Ethna\_Filter (実行時フィルタ、ExecutionTimeなどのこと)
  - Plugin/Ethna\_Plugin\_Filter.php に移行しました。後方互換性のため Ethna\_Filter.php はそのまま残っていますが、将来的に廃止される予定なのでプラグインへ移行しておくことをお薦めします。

- Ethna\_LogWriter
  - 廃止され、全面的に Plugin/Ethna\_Plugin\_Logwriter.php に移行しました。 $ETHNA\_HOME/class/LogWriter/ 以下に自作の Logwriter を作っていた場合は、プラグインへの移行作業が必要になります。

- Ethna\_CacheManager
  - 実装の大部分がEthna\_Plugin\_Cachemanagerに移動しました。Ethna\_CacheManager.php は残っていますが、プラグインを呼び出すだけになりました。

- Ethna\_SkeltonGenerator
  - 廃止され、Ethna\_Generator.php と Plugin/Ethna\_Plugin\_Generator.php に移行しました。

- Ethna\_Handle
  - Plugin/Ethna\_Plugin\_Handle.php へのプラグイン化とともにハンドラ自体も改良されたため、かなり内容が変わっています。

#### [任意] Ethna\_UrlHandlerを使う [](ethna-document-dev_guide-misc-migrate_project210to230.html#y9d64262 "y9d64262")

Ethna-2.3.0の新機能の目玉の一つはEthna\_UrlHandlerの導入です。

エントリポイントに実行したいアクションを指示するために、これまでは

    http://example.jp/index.php?action_foo=true&param=bar

のように "action\_アクション名" という名前のリクエスト変数を設定する必要がありました。この挙動はコントローラの \_getActionName\_Form() というメソッドをオーバーライドすることで変更できましたが、必ずしもわかりやすいものではありませんでした。

Ethna\_UrlHandlerクラスはエントリポイント、path infoと、アクション名、リクエストパラメータとの対応を定義することで、相互の変換を可能にするものです。たとえば

    http://example.jp/index.php/action/foo/param/bar

というURIと

- アクション: foo
- パラメータ: param=bar という情報とを相互に変換することができます。

詳細については、 [PATH\_INFOを使ったRequest-URIからのパラメータの取得](ethna-document-dev_guide-urlhandler.html "ethna-document-dev\_guide-urlhandler (926d)")を参照してください。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
