# Ethna_Pluginのつかいかた(簡易) - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# Ethna\_Pluginのつかいかた(簡易) 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > Ethna\_Pluginのつかいかた(簡易) 

- Ethna\_Pluginのつかいかた(簡易) 
  - プラグインオブジェクトの取得，実行 
  - プラグインを用いた例 
- Ethna\_Pluginのつかいかた(詳細) 
  - 概要 
  - Ethna\_Plugin 
  - 命名規則 
    - Ethna本体に付属するプラグイン 
    - アプリケーション固有のプラグイン 
    - $type ごとの親クラス 
  - 自動でincludeされるファイルについて 
  - Ethna\_Plugin::includePlugin() 
  - アプリケーション固有のプラグインについて 
    - 特定のprefixをもつプラグインを使う 
  - より細かい注意事項 
    - $typeと$nameについて 
    - 親クラスについて 
- 3.0.0 以降で取り込まれる予定の変更について 
  - プラグインprefixの廃止 
  - プラグイン検索ディレクトリの変更 
  - ファイル名の命名規則 

| 書いた人 | いちい | 新規 |
| 編集した人 | sotarok | 2.5.0p4以降に関して |

## Ethna\_Pluginのつかいかた(簡易) [](ethna-document-dev_guide-plugin.html#t6802db7 "t6802db7")

プラグインは$type(種類)と$name(名前)で区別されます。プラグインのマネージャ(Ethna\_Pluginクラス)は，命名規則にしたがってファイルを探索し，インクルードとインスタンス作成を代行します。

現時点では，

- Cachemanager (キャッシュマネージャ)
- Filter (実行時フィルタ)
- Handle (ethnaコマンドのハンドル)
- Logwriter (ログ)
- Validator (フォーム値の検証)

の5種類の$typeのプラグインが使えるようになっています。

### プラグインオブジェクトの取得，実行 [](ethna-document-dev_guide-plugin.html#j3c3ba62 "j3c3ba62")

Ethna\_Pluginがプラグインを管理しています。$type(=Hoge)と$name(=Fuga)を指定して，

    $plugin =& $controller->getPlugin();
    $hoge_plugin =& $plugin->getPlugin('Hoge', 'Fuga');
    $hoge_plugin->doSomething();

のようにしてプラグインを使うことができます。

アプリケーションごとのプラグインの一覧は [InfoManager](ethna-document-dev_guide-misc-info.html "ethna-document-dev\_guide-misc-info (1240d)")で見ることができます。

### プラグインを用いた例 [](ethna-document-dev_guide-plugin.html#fbd43c78 "fbd43c78")

プラグインを用いた例として，アクションフォームでプラグインを使ってフォーム値の検証を行う方法を簡単に説明します。

Regexpバリデータプラグインは，パラメータとしてフォームの値と，バリデートするための正規表現を受け取り，フォームの値が正規表現にマッチするかを検証します。

- クラス名: Ethna\_Plugin\_Validator\_Regexp
- ファイル名: $ETHNA\_HOME/Plugin/Validator/Ethna\_Plugin\_Validator\_Regexp.php

バリデータプラグインの親クラスで，どのようなパラメータを受け取るのかなどが規定されています。

- クラス名: Ethna\_Plugin\_Validator
- ファイル名: $ETHNA\_HOME/Plugin/Ethna\_Plugin\_Validator.php

アプリケーションのフォーム定義において，

    var $use_validator_plugin = true;
    
    /**
     * @access private
     * @var array フォーム値定義
     */
    var $form = array(
            'sample' => array(
                'form_type' => FORM_TYPE_TEXT,
                'type' => VAR_TYPE_STRING,
                'name' => 'サンプル',
                'regexp' => '/[0-9]+/',
                'regexp_error' => '正規表現にマッチしません',
            ),
        );

のように指定すると， $this->af->validate() の中でアクションフォームがRegexpバリデータプラグインのインスタンスを取得し，

    'regexp' => '/[0-9]+/',
                'regexp_error' => '正規表現にマッチしません',

の部分をパラメータとしてフォーム値の検証を行います。

バリデータプラグインの詳細については、 [フォーム値の自動検証を行う(プラグイン編)](ethna-document-dev_guide-form-validate_with_plugin.html "ethna-document-dev\_guide-form-validate\_with\_plugin (513d)")を参照してください。

また、新規にプラグインを導入するときの具体例については、 [プラグイン導入の例](ethna-document-dev_guide-plugin-example.html "ethna-document-dev\_guide-plugin-example (817d)")を参照してください。

## Ethna\_Pluginのつかいかた(詳細) [](ethna-document-dev_guide-plugin.html#y889e9ad "y889e9ad")

Ethna-2.3.0からEthna\_Pluginクラスが追加されました。Smartyのプラグインのように，Ethnaでもプラグイン方式の機能追加ができるようになります。

### 概要 [](ethna-document-dev_guide-plugin.html#h396963e "h396963e")

現状，プラグイン自体は「ある命名規則に従ったファイル名とクラス名をもったオブジェクト」でしかありません。Ethna\_Plugin\_Validatorのように，そのプラグインの種類に応じた親クラスを用意して，その継承クラスとして定義されることを期待しています。そして，Ethna\_ActionFormのように，そのプラグインを呼び出す側もプラグインを使うことを意識しておかなければなりません。

プラグインのマネージャとして，Ethna\_Pluginクラス(class/Ethna\_Plugin.php)があります。Ethna\_Pluginは，種類($type)と名前($name)から，ある命名規則にしたがってプラグインのソースファイルを探索し，includeし，インスタンスを作ってアプリケーションに受け渡しをします。なお，Ethna\_Pluginのインスタンス自体はEthna\_ClassFactoryによって管理されます。

プラグインは，Ethna本体に付属する形のものと，アプリケーション固有のものとがあります。たとえばすべてのアプリケーションに共通するプラグインをEthna本体のディレクトリに配置したり，特定のアプリケーションでのみ必要なプラグインを作ったりすることができます。また，Ethna本体のプラグインを，命名規則に従うことでアプリケーションのプラグインによって上書きすることができます。

### Ethna\_Plugin [](ethna-document-dev_guide-plugin.html#x1abd3f5 "x1abd3f5")

Ethna\_PluginクラスはEthnaにおけるプラグインの管理機構を提供します。

- getPlugin()
  - Ethna\_Plugin::getPlugin($type, $name) によって，プラグインのインスタンスを取得できます。
  - 各プラグインは，$type(種類)と$name(名前)のペアで識別されます。
  - 初めてgetPluginを呼び出すときに，プラグインのソースファイルを自動的に探索し，インスタンス化します。
  - プラグインが見つからないときなどはエラーオブジェクトが返されます。(レジストリにはnullがセットされます。)

- レジストリ
  - Ethna\_Pluginは内部に，ソースファイルやクラス名のレジストリと，プラグインのインスタンスのレジストリを持っています。
  - getPlugin()が呼び出されると，レジストリからインスタンス(の参照)を返します。
  - 毎回インスタンスを作り直しているわけでは **ない** ことに注意してください。(レジストリからunloadすることも一応できます。)

- ファイルの探索
  - 後に説明する命名規則によってファイルを探索し，ファイルの存在確認，インクルード，クラスの存在確認，インスタンス化が行われます。
  - プラグインはEthna本体に付属するものと，アプリケーション固有のものとがあります。同じ$typeと$nameを持つプラグインが両方に存在する場合，アプリケーション固有のものが優先されます。

Ethna\_Plugin自体のインスタンスはEthna\_Controller::getPlugin()から取得することができます。

    $plugin =& $controller->getPlugin();
    $hoge_plugin =& $plugin->getPlugin('Hoge', 'Fuga');
    $hoge_plugin->doSomething();

### 命名規則 [](ethna-document-dev_guide-plugin.html#u6ec7c88 "u6ec7c88")

$type, $nameは大文字／小文字を区別しています。新たにプラグインを作る場合は、 **Ucfirst** のように，先頭を英大文字，以降を英小文字にすることを強くお勧めします。

#### Ethna本体に付属するプラグイン [](ethna-document-dev_guide-plugin.html#na6dc7e3 "na6dc7e3")

- ディレクトリ

    $ETHNA_HOME/class/Plugin/{$type}/

  - ex. /usr/share/php/Ethna/class/Plugin/Validator/

- ファイル名

    Ethna_Plugin_{$type}_{$name}.php

  - ex. Ethna\_Plugin\_Validator\_Regexp.php

- クラス名

    Ethna_Plugin_{$type}_{$name}

  - ex. class Ethna\_Plugin\_Validator\_Regexp

#### アプリケーション固有のプラグイン [](ethna-document-dev_guide-plugin.html#q34b0664 "q34b0664")

アプリケーション名をSampleとします。

- ディレクトリ

    sample/app/plugin/{$type}/

  - ex. /var/www/sample/app/plugin/Filter/

- ファイル名

    Sample_Plugin_{$type}_{$name}.php

  - ex. Sample\_Plugin\_Filter\_ExecutionTime.php

- クラス名

    Sample_Plugin_{$type}_{$name}

  - ex. class Sample\_Plugin\_Filter\_ExecutionTime

#### $type ごとの親クラス [](ethna-document-dev_guide-plugin.html#k291692c "k291692c")

その $type の各 $name で共通したプロパティやインタフェースを定義します。

- ディレクトリ

    $ETHNA_HOME/class/Plugin/

  - ex. /usr/share/php/Ethna/class/Plugin/

- ファイル名

    Ethna_Plugin_{$type}.php

  - ex. Ethna\_Plugin\_Validator.php

- クラス名

    Ethna_Plugin_{$type}

- ex. class Ethna\_Plugin\_Validator

### 自動でincludeされるファイルについて [](ethna-document-dev_guide-plugin.html#f25562db "f25562db")

上で述べたように，同じ$type(種類)と$name(名前)をもつプラグインは，Ethna本体に付属するものとアプリケーション固有のものがあり，アプリケーション固有のものが優先されます。

一方，クラス名においては， Ethna\_Plugin\_Validator\_Regexp と Sample\_Plugin\_Validator\_Regexp のように異なる名前を持つため，両方を共存させることができます。このことは特に，Ethna本体に付属するプラグインのクラスを継承してアプリケーション固有のプラグインを作りたい場合に重要です。

Ethna\_Plugin::getPlugin()は，指定された$typeと$nameから自動でソースファイルを探索しincludeしますが，インスタンスを作るべきクラスのソースファイルしかincludeしないことに注意してください。すなわち，アプリケーション固有のプラグインが存在する場合に，おなじ$typeと$nameを持つEthna本体付属のプラグインファイルは無視されます。

### Ethna\_Plugin::includePlugin() [](ethna-document-dev_guide-plugin.html#j5664bd1 "j5664bd1")

Ethna\_Pluginには，内部で管理しているレジストリとは別に，命名規則にしたがってincludeのみを行うstaticメソッド

- Ethna\_Plugin::includePlugin()
- Ethna\_Plugin::includeEthnaPlugin()

が用意されました。Ethna\_Pluginのインスタンスが手元にない，class定義の前に include しておきたいときなどに便利です。

Ethna\_Plugin\_Validator\_Regexp を継承して Sample\_Plugin\_Validator\_Regexp を作る例:

    <?php
    Ethna_Plugin::includeEthnaPlugin('Validator', 'Regexp');
    class Hoge_Plugin_Validator_Fuga extends Ethna_Plugin_Validator_Regexp
    {
        var $accept_array = true;
        function &validate($name, $var, $params)
        {
            $result = true;
            foreach (to_array($var) as $v) {
                $result = $result
                          && Ethna::isError(parent::validate($name, $v, $params));
            }
            return $result;
        }
    }
    ?>

この例では，配列の個別要素に対して実行される正規表現バリデータを，配列をそのまま受け取るように変更した意味不明なバリデータになっているかもしれません(適当に書いただけなのでいつか直します)。

### アプリケーション固有のプラグインについて [](ethna-document-dev_guide-plugin.html#e2023a8a "e2023a8a")

#### 特定のprefixをもつプラグインを使う [](ethna-document-dev_guide-plugin.html#f6e3f133 "f6e3f133")

sample という名前のアプリケーションに固有なプラグインは、基本的には Sample\_Plugin\_Hoge\_Fuga という命名規則をに従うことになります。

Sample\_Controller.phpの以下の設定を変更すれば、sampleに加えて特定のprefixを使うよう指示することもできます。

    var $plugin_search_appids = array(
           /*
            * プラグイン検索時に検索対象となるアプリケーションIDのリストを記述します。
            *
            * 記述例：
            * Common_Plugin_Foo_Bar のような命名のプラグインがアプリケーションの
            * プラグインディレクトリに存在する場合、以下のように指定すると
            * Common_Plugin_Foo_Bar, {$project_id}_Plugin_Foo_Bar, Ethna_Plugin_Foo_Bar
            * の順にプラグインが検索されます。 
            *
            * 'Common', 'Sample', 'Ethna',
            */
           'Sample', 'Ethna',
       );

ちなみに 'Ethna' は Ethna 本体に付属するプラグインのprefixとして予約されています。これを削ると、Ethna本体のプラグインはこのアプリケーションでは使わない、ということになります(どうなるか分からないので残しておいてください)。

### より細かい注意事項 [](ethna-document-dev_guide-plugin.html#ofa431a2 "ofa431a2")

#### $typeと$nameについて [](ethna-document-dev_guide-plugin.html#ode269a7 "ode269a7")

Ethna\_Plugin::getPlugin($type, $name) は与えられた $type と $name を上の命名規則にそのまま代入します。ディレクトリ名やファイル名にそのまま使われるので、 **信用できない文字列を$type, $nameにそのまま代入しない** よう気を付けてください。

また、大文字／小文字の違いでプラグインファイルが見付からないこともありますので、プラグインが認識されないときなどはこの点にも注意してください。なお、アプリケーションのログレベルをdebugに設定すると、プラグインを探す過程が詳細に記録されます。

$type, $name ともに、自作するときは **Ucfirst** (先頭が大文字、以降は小文字のアルファベット文字列) のような名前にすることを強くお薦めします。

#### 親クラスについて [](ethna-document-dev_guide-plugin.html#jd2471b0 "jd2471b0")

親クラスは必ずしも必要ではありません。

親クラスのファイルは(命名規則に従えば) Ethna 本体のディレクトリ内に置かれ、自動で include されます。そのため、たとえば root 権限がない環境で新しい $type のプラグインを定義できないかもしれません。

このような場合は、単純に親クラスのことを忘れて、命名規則にしたがったクラスとファイルをアプリケーション側に用意してプラグインを使うことができます。

## 3.0.0 以降で取り込まれる予定の変更について [](ethna-document-dev_guide-plugin.html#p1474b8b "p1474b8b")

取り込まれてから実際に詳細な使い方・プラグインの作り方は記述する予定ですが，ひとまず主な変更予定について記述します．

なお，この変更により **プラグイン機能は 3.0.0 preview1 以降では後方互換性がなくなります** ．

### プラグインprefixの廃止 [](ethna-document-dev_guide-plugin.html#f38855b0 "f38855b0")

これまでは，'Ethna', 'APPID' などのprefixを，APPID\_Controllerに

    /**
         * @var array list of application id where Ethna searches plugin.
         */
        var $plugin_search_appids = array(
            'APPID', 'Ethna',
        );

などと定義し，これらのprefixをもったプラグインのクラス名を前から順に検索していくという形でした．

しかし，これのせいで，複数プロジェクトにまたがって利用したいプラグインや，ほかの人が作成したプラグインなどを自分のアプリケーションに取り込みたい場合の導入が面倒だった問題などがありました．

3.0.0 preview1 以降では， **この prefix は Ethna のみに固定されます** ．

したがって，2.5.0 以前のような，「Ethna prefix のプラグインクラスを継承してAPPID prefixのプラグインを実装」のような使い方ができなくなります．（ref . 自動でincludeされるファイルについて）．

### プラグイン検索ディレクトリの変更 [](ethna-document-dev_guide-plugin.html#mca8ae70 "mca8ae70")

プラグイン検索ディレクトリは，以下の順序で行われます．

- app/plugin/
- include\_path 順に
  - Ethna/exlib/Plugin
  - Ethna/class/Plugin

つまり，提供されるプラグインは大きく分けて，3種類ある，という扱いとなります．

1. アプリケーション固有のプラグイン (app/plugin)
  - これは，app以下に定義されるプラグインです．これまでも，これが最優先で読み込まれていました．（ただし，これまでと違うところは，APPIDがprefixにつくのではなく，すべてEthnaとなります）．
2. コミュニティ提供のプラグイン (Ethna/extlib/Plugin)
  - 今回の変更の主な目的はこれで，さまざまな人がつくったプラグインを，Ethna本体のディレクトリ直下にあるextlibに設置することにより，これを読み込めるようになります．
  - このような場所のディレクトリに設置した理由は，pear-local コマンドによるプラグイン提供をしやすくするためです．extlib以下にインストールされるようにビルド設定したPEAR形式でEthnaのプラグインを作成し，これをpear-localコマンドや（app/lib 以下にインストール），pearコマンド（サーバにインストールされます）で管理できます．
3. Ethna本体にバンドルされたプラグイン (Ethna/class/Plugin)
  - これまでどおり，Ethna本体に同梱されて配布されるプラグインです．

アプリケーション固有のプラグイン以外は， **include\_pathを考慮した相対パスで読み込まれます** ．たとえば 「Ethna\_Plugin\_Hoge\_Fuga」を読み込みたいとします．

    /home/user/hogeproject

にプロジェクトが作成されているとして，

- /home/user/hogeproject/lib/Ethna
- /usr/share/pear/Ethna の2箇所にEthnaの本体が置いてあるとします．（プロジェクトのlib以下にEthna本体を設置することはわりとよくあることです） この場合，初期設定\*1では，app/lib以下のinclude\_pathが優先されるため，次の順序で検索されます．

1. /home/user/hogeproject/app/plugin/Hoge/Fuga.php
2. /home/user/hogeproject/lib/Ethna/class/Plugin/Hoge/Fuga.php
3. /home/user/hogeproject/lib/Ethna/extlib/Plugin/Hoge/Fuga.php
4. /usr/share/pear/Ethna/class/Plugin/Hoge/Fuga.php
5. /usr/share/pear/Ethna/extlib/Plugin/Hoge/Fuga.php

### ファイル名の命名規則 [](ethna-document-dev_guide-plugin.html#cfd12354 "cfd12354")

上記の変更で，特定のprefixというルールが存在しないので，ファイル名の命名規則が変更になりました．これまで冗長だったファイル名が簡潔になります（PEAR形式になります）

変更前：

    Plugin/Hoge/Ethna_Plugin_Hoge_Fuga.php
    (クラス名は「Ethna_Plugin_Hoge_Fuga」)

変更後

    Plugin/Hoge/Fuga.php
    (クラス名は「Ethna_Plugin_Hoge_Fuga」（変更なし）)

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1Ethna 2.3.6 以降  

<!-- ??END id:note -->
<!-- ??BEGIN id:trackback -->
<!-- ?? END id:trackback --><!-- ?? BEGIN id:attach -->

* * *
添付ファイル: [![file](image/file.png)Tree.jpg](plugin=attach&pcmd=open&file=Tree.jpg&refer=ethna-document-dev_guide-plugin.html "2008/06/02 16:35:58 752.0KB") 775件[[詳細](plugin=attach&pcmd=info&file=Tree.jpg&refer=ethna-document-dev_guide-plugin.html "添付ファイルの情報")]
<!-- ?? END id:attach -->
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
