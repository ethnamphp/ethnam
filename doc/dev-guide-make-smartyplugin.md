# Smartyプラグインの作成
ここでは、Ethna 向けの Smarty プラグインの作成方法を説明します。

- Smartyプラグインの作成 
  - Smartyプラグインの種別 
  - Ethna 2.5.0 以降のやり方 
    - プラグインの作成 
    - プラグインの登録と使い方 
  - Ethna 2.3.x 以前のやり方 
    - クラスのメソッドをSmartyFunctionとして登録する方法 
    - smartyの流儀でfunction, modifierなどを登録する 

| 書いた人 | mumumu | 2009-06-21 | 新規作成 |

### Smartyプラグインの種別

Smarty のプラグインには様々な種類がありますが、原理的にEthnaでは全ての種類のSmartyプラグインを使うことができます。

主に使われるのはブロックプラグイン、関数プラグイン、修正子プラグインの3種類でしょう。

### Ethna 2.5.0 以降のやり方

#### プラグインの作成

すべての種類の Smartyプラグインが Ethna で利用可能です。

Smartyプラグインの作成方法については、 [Smarty のマニュアル](http://www.smarty.net/manual/ja/plugins.php) をご覧下さい。

#### プラグインの登録と使い方

app/Plugin/Smarty 以下に作成したプラグインを置いておけば、自動で Smartyプラグインの探索パスを通してあるため、ここに置いたプラグインは自動でEthnaが探してくれるようになっています。

よって、hoge プラグインを例にすると、以下のようにしてすぐに使うことができます。

    {$app.test|hoge}
    {hoge}
    {hoge}{/hoge}

### Ethna 2.3.x 以前のやり方

#### クラスのメソッドをSmartyFunctionとして登録する方法

以下のように配列で指定することでクラスのメソッドをsmarty_functionとして登録することが可能です。

    179 /**
       180 * @var array smarty function定義
       181 */
       182 var $smarty_function_plugin = array(
       183 /*
       184 * TODO: ここにユーザ定義のsmarty function一覧を記述してください
       185 *
       186 * 記述例：
       187 *
       188 * 'smarty_function_foo_bar',
       189 */
       190 array('HasteSmartyPlugins', 'form_name'),
       191 array('HasteSmartyPlugins', 'form_input'),
       192 array('HasteSmartyPlugins', 'rss'),

従来はグローバルの関数名を書いた文字列を列挙するが、クラスのメソッドの場合、

    array('クラス名', 'メソッド')

とした配列を列挙する。\*1

#### smartyの流儀でfunction, modifierなどを登録する

smartyは特定のディレクトリにsmartyの流儀でファイルを作れば自動的にmodifierなどを見付けてくれます。上の方法は、smartyの流儀によらずにアプリで用意したクラス関数をsmarty functionに登録するための方法です。

smartyの流儀に従う場合は、App_Controllerの中でファイルを置くディレクトリを指定します。たとえばアプリのlibディレクトリにsmartyディレクトリを用意する場合は、以下のように指定してください。

- lib/smarty/function.sample.php (smarty functionを定義したファイル)

    function smarty_function_sample($params, &$smarty)
    {
        ...
    }

- app/App_Controller.php

    var $directory = array(
        ...
        'plugins' => array('lib/smarty'), // ファイルを置いてあるディレクトリ
        ...
    );

smartyテンプレート内で {sample foo=bar} のように書くと、smartyはlib/smartyディレクトリ内から自動的にsample関数の定義を見付けてくれます。(くわしくはSmarty自体のドキュメントを参照してください)

**注意** : この場合、$smarty_function_pluginのほうは指定 **しない** でください。指定すると、smartyはファイルを探さなくてもどこかに関数が定義されていると思い、「関数が見付からない」といったエラーを出すかもしれません。


* * *
\*1このあたりはsmartyのregister_functionメソッドのマニュアルを参照  

