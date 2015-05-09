# Ethna_Pluginのつかいかた(簡易)
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

## Ethna\_Pluginのつかいかた(簡易)

プラグインは$type(種類)と$name(名前)で区別されます。プラグインのマネージャ(Ethna\_Pluginクラス)は，命名規則にしたがってファイルを探索し，インクルードとインスタンス作成を代行します。

現時点では，

- Cachemanager (キャッシュマネージャ)
- Filter (実行時フィルタ)
- Handle (ethnaコマンドのハンドル)
- Logwriter (ログ)
- Validator (フォーム値の検証)

の5種類の$typeのプラグインが使えるようになっています。

### プラグインオブジェクトの取得，実行

Ethna\_Pluginがプラグインを管理しています。$type(=Hoge)と$name(=Fuga)を指定して，

    $plugin =& $controller->getPlugin();
    $hoge_plugin =& $plugin->getPlugin('Hoge', 'Fuga');
    $hoge_plugin->doSomething();

のようにしてプラグインを使うことができます。

アプリケーションごとのプラグインの一覧は [InfoManager](ethna-document-dev_guide-misc-info.md "ethna-document-dev\_guide-misc-info (1240d)")で見ることができます。

### プラグインを用いた例

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

バリデータプラグインの詳細については、 [フォーム値の自動検証を行う(プラグイン編)](ethna-document-dev_guide-form-validate_with_plugin.md "ethna-document-dev\_guide-form-validate\_with\_plugin (513d)")を参照してください。

また、新規にプラグインを導入するときの具体例については、 [プラグイン導入の例](ethna-document-dev_guide-plugin-example.md "ethna-document-dev\_guide-plugin-example (817d)")を参照してください。

## Ethna\_Pluginのつかいかた(詳細)

Ethna-2.3.0からEthna\_Pluginクラスが追加されました。Smartyのプラグインのように，Ethnaでもプラグイン方式の機能追加ができるようになります。

### 概要

現状，プラグイン自体は「ある命名規則に従ったファイル名とクラス名をもったオブジェクト」でしかありません。Ethna\_Plugin\_Validatorのように，そのプラグインの種類に応じた親クラスを用意して，その継承クラスとして定義されることを期待しています。そして，Ethna\_ActionFormのように，そのプラグインを呼び出す側もプラグインを使うことを意識しておかなければなりません。

プラグインのマネージャとして，Ethna\_Pluginクラス(class/Ethna\_Plugin.php)があります。Ethna\_Pluginは，種類($type)と名前($name)から，ある命名規則にしたがってプラグインのソースファイルを探索し，includeし，インスタンスを作ってアプリケーションに受け渡しをします。なお，Ethna\_Pluginのインスタンス自体はEthna\_ClassFactoryによって管理されます。

プラグインは，Ethna本体に付属する形のものと，アプリケーション固有のものとがあります。たとえばすべてのアプリケーションに共通するプラグインをEthna本体のディレクトリに配置したり，特定のアプリケーションでのみ必要なプラグインを作ったりすることができます。また，Ethna本体のプラグインを，命名規則に従うことでアプリケーションのプラグインによって上書きすることができます。

### Ethna\_Plugin

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

### 命名規則

$type, $nameは大文字／小文字を区別しています。新たにプラグインを作る場合は、 **Ucfirst** のように，先頭を英大文字，以降を英小文字にすることを強くお勧めします。

#### Ethna本体に付属するプラグイン

- ディレクトリ

    $ETHNA_HOME/class/Plugin/{$type}/

  - ex. /usr/share/php/Ethna/class/Plugin/Validator/

- ファイル名

    Ethna_Plugin_{$type}_{$name}.php

  - ex. Ethna\_Plugin\_Validator\_Regexp.php

- クラス名

    Ethna_Plugin_{$type}_{$name}

  - ex. class Ethna\_Plugin\_Validator\_Regexp

#### アプリケーション固有のプラグイン

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

#### $type ごとの親クラス

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

### 自動でincludeされるファイルについて

上で述べたように，同じ$type(種類)と$name(名前)をもつプラグインは，Ethna本体に付属するものとアプリケーション固有のものがあり，アプリケーション固有のものが優先されます。

一方，クラス名においては， Ethna\_Plugin\_Validator\_Regexp と Sample\_Plugin\_Validator\_Regexp のように異なる名前を持つため，両方を共存させることができます。このことは特に，Ethna本体に付属するプラグインのクラスを継承してアプリケーション固有のプラグインを作りたい場合に重要です。

Ethna\_Plugin::getPlugin()は，指定された$typeと$nameから自動でソースファイルを探索しincludeしますが，インスタンスを作るべきクラスのソースファイルしかincludeしないことに注意してください。すなわち，アプリケーション固有のプラグインが存在する場合に，おなじ$typeと$nameを持つEthna本体付属のプラグインファイルは無視されます。

### Ethna\_Plugin::includePlugin()

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

### アプリケーション固有のプラグインについて

#### 特定のprefixをもつプラグインを使う

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

### より細かい注意事項

#### $typeと$nameについて

Ethna\_Plugin::getPlugin($type, $name) は与えられた $type と $name を上の命名規則にそのまま代入します。ディレクトリ名やファイル名にそのまま使われるので、 **信用できない文字列を$type, $nameにそのまま代入しない** よう気を付けてください。

また、大文字／小文字の違いでプラグインファイルが見付からないこともありますので、プラグインが認識されないときなどはこの点にも注意してください。なお、アプリケーションのログレベルをdebugに設定すると、プラグインを探す過程が詳細に記録されます。

$type, $name ともに、自作するときは **Ucfirst** (先頭が大文字、以降は小文字のアルファベット文字列) のような名前にすることを強くお薦めします。

#### 親クラスについて

親クラスは必ずしも必要ではありません。

親クラスのファイルは(命名規則に従えば) Ethna 本体のディレクトリ内に置かれ、自動で include されます。そのため、たとえば root 権限がない環境で新しい $type のプラグインを定義できないかもしれません。

このような場合は、単純に親クラスのことを忘れて、命名規則にしたがったクラスとファイルをアプリケーション側に用意してプラグインを使うことができます。

## 3.0.0 以降で取り込まれる予定の変更について

取り込まれてから実際に詳細な使い方・プラグインの作り方は記述する予定ですが，ひとまず主な変更予定について記述します．

なお，この変更により **プラグイン機能は 3.0.0 preview1 以降では後方互換性がなくなります** ．

### プラグインprefixの廃止

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

### プラグイン検索ディレクトリの変更

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

### ファイル名の命名規則

上記の変更で，特定のprefixというルールが存在しないので，ファイル名の命名規則が変更になりました．これまで冗長だったファイル名が簡潔になります（PEAR形式になります）

変更前：

    Plugin/Hoge/Ethna_Plugin_Hoge_Fuga.php
    (クラス名は「Ethna_Plugin_Hoge_Fuga」)

変更後

    Plugin/Hoge/Fuga.php
    (クラス名は「Ethna_Plugin_Hoge_Fuga」（変更なし）)


* * *
\*1Ethna 2.3.6 以降  

