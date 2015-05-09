<title>
フォーム値の自動検証を行う(プラグイン編) - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# フォーム値の自動検証を行う(プラグイン編) 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [フォーム定義](ethna-document-dev_guide-form.html) > フォーム値の自動検証を行う(プラグイン編) 

- フォーム値の自動検証を行う(プラグイン編) 
  - 概要 
  - 具体例 
  - プラグインを使うかどうかのフラグ 
  - フォーム定義の解釈 
  - フォーム定義のパラメータについて 
  - 後方互換性について 
  - 各バリデータプラグインの詳細 
    - Required 
    - Max, Min, Regexp 
    - Custom 
    - File 
  - バリデータプラグインを作る 

書いた人

| いちい | 新規作成 | - |
| DQNEO | プラグインの作り方を補足 | 2010-05-30 |

## フォーム値の自動検証を行う(プラグイン編) [](ethna-document-dev_guide-form-validate_with_plugin.html#dbe63c2f "dbe63c2f")

Ethna\_Plugin\_Validatorを使ったフォーム値の検証について説明します。主に，プラグインが導入される以前の方式に慣れている方のための説明です。

### 概要 [](ethna-document-dev_guide-form-validate_with_plugin.html#fed21c0f "fed21c0f")

Ethna\_ActionForm::validate()に，プラグインを使ったフォーム値の検証処理が追加されました。

できるかぎり後方互換性を維持しつつ，プラグインを使ってフォーム値の検証処理が簡単に拡張できるようになりました。これまでcustomメソッドを使っていた処理も，プラグイン化することで取り扱いが簡単になるでしょう。

### 具体例 [](ethna-document-dev_guide-form-validate_with_plugin.html#c330251d "c330251d")

Fileプラグインは，アップロードされたファイルの検証に特化した，新たに追加されたプラグインです。

アクションフォームで

    var $use_validator_plugin = true;
    var $form = array(
            'sample' => array(
                'type' => VAR_TYPE_FILE,
                'form_type' => FORM_TYPE_FILE,
                'name' => 'サンプル',
                'required' => true,
                'file_size_max' => '10KB',
                'file_type' => 'text/plain',
                'file_error' => 'ファイルが不正です',
            ),
        );

のようにフォームを定義し，アクションクラスで

    function prepare()
    {
        $this->af->validate();
        return null;
    }

とすると，「サンプル」フォームは

1. typeのチェック
2. requiredのチェック
3. fileプラグインのチェック
  - ファイルサイズは10KB以下
  - MIME型はtext/plain
  - エラーの場合は「ファイルが不正です」というメッセージ

の順にフォーム値が検証されます。

### プラグインを使うかどうかのフラグ [](ethna-document-dev_guide-form-validate_with_plugin.html#fd113da8 "fd113da8")

各アクションフォームごと，もしくはアクションフォームの各フォーム定義ごとにプラグインを使用するかどうかを選択することができます。新規にプロジェクトを作った場合は，デフォルトでプラグインを使ったフォーム値の検証を行うようになります。

- 各アクションフォームの$use\_validator\_pluginプロパティ
  - この値がtrueに指定されていた場合，validate()はプラグインを使った検証を行います。
  - Ethna\_ActionForm自体のデフォルトは(現状)falseです。

- 各フォーム定義の 'plugin' 要素

    var $form = array(
            'sample' => array(
                'plugin' => true,
            ),
        );

  - この値がtrueに指定されていた場合，validate()はプラグインを使った検証を行います。
  - この値は$use\_validator\_pluginの指定よりも優先されます。

プラグインを使うように指定した場合，プラグイン化以前のフォーム値検証処理は **実行されない** ことに注意してください。(後方互換性の項も参照してください。)

### フォーム定義の解釈 [](ethna-document-dev_guide-form-validate_with_plugin.html#s214f15e "s214f15e")

プラグインを使わない場合，アクションフォームのフォーム定義はEthna\_ActionFormの組み込み検証メソッドへの指示でした。プラグインを使う場合は，どのプラグインにどんなパラメータを与えて呼び出すかの指示になります。あらかじめ，組み込み検証メソッドで指定できたすべての要素に相当するプラグインが用意されています。

以前からあったフォーム定義要素は

    'name', 'required', 'max', 'min', 'regexp', 'custom', 'filter', 'form_type', 'type'

でした。このうち

    'type', 'form', 'name', 'plugin', 'filter', 'option'

については，非プラグイン要素として解釈されます\*1。

これ以外の要素については，プラグインを用いたフォーム値の検証を定義していると解釈されます。

    'required' => true,

であれば，Requiredプラグインにtrueをパラメータとして検証を指示していることになります。

また，フォーム値の検証は **その要素を書いた順に** 実行されます。

なお，実際に呼び出されるValidatorプラグインは，各要素の先頭の1文字目だけを大文字にした名前($name)のプラグインになります。Validatorプラグインの名前($name)には '\_' を含むことはできません。

### フォーム定義のパラメータについて [](ethna-document-dev_guide-form-validate_with_plugin.html#g28b16fc "g28b16fc")

プラグインに渡されるパラメータは，後方互換性を考慮して，すこし複雑な解釈をしています。詳細はEthna\_ActionForm::\_getPluginDef()を参照してください。

- 配列で定義する

    'file' => array(
                    'size_max' => '10KB',
                    'type' => 'text/plain',
                    'error' => 'エラー',
                   ),

この場合，この配列がそのままパラメータとして Ethna\_Plugin\_Validator\_File::validate() に渡されます。

- '\_' でつないで定義する (プラグインを使わない場合と互換性のある書き方)

    'required' => true,
    'required_error' => 'エラー',

この場合，次のような配列が定義されたとしてプラグインにパラメータとして渡されます。

    'required' => array(
                        'required' => true,
                        'error' => 'エラー',
                       ),

### 後方互換性について [](ethna-document-dev_guide-form-validate_with_plugin.html#x6efaddf "x6efaddf")

あらかじめ用意されたプラグインと，パラメータを 'plugin\_param' の形式で指定できることから，プラグインを使わない場合とまったく同様の記法によってプラグインを使ったフォーム定義をすることができます。

ただしフォーム値の検証順序については，プラグインを使う場合には「書いた順に」実行されるため，まったく同じ動作とはなりませんので注意してください。特にEthna\_ActionError::getMessage()は，いちばん最初に発生したエラーを返す仕様となっていたため，エラーが発生した場合のメッセージが変わることがあります。

### 各バリデータプラグインの詳細 [](ethna-document-dev_guide-form-validate_with_plugin.html#s1acd3cf "s1acd3cf")

#### Required [](ethna-document-dev_guide-form-validate_with_plugin.html#ibd203a0 "ibd203a0")

Requiredプラグインは，(なんでもいいので)値が入力されているかをチェックします。フォームを配列として定義した場合は，配列全体を見渡してチェックすることができます。

追加で指定できるパラメータは，次の通りです。

- error

    'required_error' => 'エラー',

  - エラーが起きたときのメッセージを上書きします。

- key

    'required_key' => 'foo',
    'required_key' => array(0, 1, 'bar'),

  - 配列フォームの場合に，指定されたkeyが入力されているかをチェックします。

- num

    'required_num' => 2,

  - 配列フォームの場合に，指定された数だけ入力されているかをチェックします。

#### Max, Min, Regexp [](ethna-document-dev_guide-form-validate_with_plugin.html#gaaa9f2b "gaaa9f2b")

それぞれ，最大値，最小値，正規表現マッチのチェックをします。

#### Custom [](ethna-document-dev_guide-form-validate_with_plugin.html#t14e4c97 "t14e4c97")

後方互換性のために用意されました。アクションフォームの指定されたメソッドを呼び出すだけです。

#### File [](ethna-document-dev_guide-form-validate_with_plugin.html#v2072cc9 "v2072cc9")

アップロードされたファイルのチェックに特化し，PHP4.2.0以降に追加された，アップロードファイルのエラーコードに対応したエラーメッセージを得ることができます。

- error

    'file_error' => 'エラー',

  - エラーが起きたときのメッセージを上書きします。

- size\_max, size\_min

    'file_size_max' => '1kbytes',
    'file_size_min' => '1KB',

  - ファイルサイズのチェックをします。Max, Minプラグインと同様です。

- type

    'file_type' => 'text/xml',
    'file_type' => array('text', 'application/octet-stream'),

  - ファイルのMIME型のチェックをします。(信頼できるとは限りません。)
  - 'text' は 'text/\*' と解釈します。

- name

    'file_name' => 'sample.txt',
    'file_name' => '/.*\.txt/',

  - 完全一致または正規表現でファイル名のチェックをします。(あまり使い道はないかもしれません。)

### バリデータプラグインを作る [](ethna-document-dev_guide-form-validate_with_plugin.html#eebb5029 "eebb5029")

アプリケーション固有のプラグインを作る場合の例を以下に示します。Ethna本体に付属させる形で作りたい場合も基本的に同様で，命名規則の部分がだけが異なります。便利なプラグインができたら、 [プラグインパッケージ](ethna-document-dev_guide-pearpackage.html "ethna-document-dev\_guide-pearpackage (856d)")をつくって公開しましょう。

1. 名前を決める。
  - アルファベット小文字のみからなる適当な名前
  - ex. auth
2. 命名規則に従い，ファイルとクラスを作る。
  - in sample/app/plugin/Validator/Sample\_Plugin\_Validator\_Auth.php:

    class Sample_Plugin_Validator_Auth extends Ethna_Plugin_Validator
     {
         var $accept_array = true;
         ...
     }

  - $accept\_array = true を指定して，配列として定義したフォーム値を配列のまま受け取ると宣言
3. validate()関数を書く。

    function &validate($name, $var, $params)
         {
             $user =& new Sample_User($this->backend);
             if ($user->getPassword($var['username']) != $var['password']) {
                 // パスワードが一致しなければ、エラーオブジェクトを返す
                 return Ethna::raiseNotice($params['error']);
             }
    
             return true;
         }

- $name: フォームの名前
- $var: 入力されたフォームの値
- $params: フォーム定義のパラメータ(連想配列)

1. 使い方

    var $form = array(
            'sample' => array(
                'name' => '認証フォーム',
                'type' => array(VAR_TYPE_STRING),
                'form_type' => FORM_TYPE_TEXT,
                'required' => true,
                'required_key' => array('username', 'password'),
                'required_error' => 'ユーザ名とパスワードを入力してください',
                'auth' => true,
                'auth_error' => 'パスワードが合いません',
                ),
            ...

    <input name="sample[username]" type="text" ...
        <input name="sample[password]" type="text" ...

- 最初にrequiredのチェックで配列authのusernameとpasswordの入力を確認
- 次にユーザ名からパスワードの確認
- 'auth' => true の部分は，他に 'auth\_\*' があれば省略可

その他，親クラス(Ethna\_Plugin\_Validator)で定義されたプロパティ・メソッドついて簡単に説明します。

- $this->backend
  - Ethna\_Backendオブジェクト

- $this->af
  - Ethna\_ActionFormオブジェクト

- $this->logger
  - Ethna\_Loggerオブジェクト

- $this->accept\_array (boolean)
  - この値が true のとき，Ethna\_ActionFormのバリデート処理は，配列で指定されたフォームを(各配列要素でなく)配列のままプラグインに渡します。

- $this->getFormType($name)
  - フォームの 'type' 要素(VAR\_TYPE\_INTなど)を取得します。配列指定の場合は値のみを取得します。

- $this->isEmpty($var, $type)
  - VAR\_TYPE\_\* に応じて，フォームの値が空と見なせるかどうかを判定します。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1厳密には，typeはTypeプラグインによって検証されています  

<!-- ??END id:note -->
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
