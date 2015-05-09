<title>
フォームへルパ - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# フォームへルパ 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [ビュー定義](ethna-document-dev_guide-view.html) > フォームへルパ 
## フォームへルパ [](ethna-document-dev_guide-view-form_helper.html#s40af263 "s40af263")

フォームヘルパとは、テンプレートでフォーム(<form>, <input>タグなど)を書くときに、 アクションフォームであらかじめ定義された情報から適切なタグを自動的に生成し、フォームを簡単に記述することができる機能です。

少し複雑な部分もありますが、アクションフォームと連携する部分を理解すれば、これほど強力な武器はありません。現状は Smartyの利用を前提としていますが、将来的には他のテンプレートエンジンや、素のPHPへの対応も考えています。

- フォームへルパ 
  - はじめに 
  - フォームヘルパの基本と機能 
    - (入力)フォームタグの自動生成 
    - フォーム値の補完 
  - 基本的な書き方 
    - 選択肢がないフォーム 
    - 選択肢があるフォーム 
  - フォーム定義が配列の場合 
  - 生成されるHTML に style 等のパラメータを指定したい場合 
    - パラメータを指定する場合の注意事項 
  - フォーム値の補完の詳細 
  - 複数 {form}{/form} を指定する場合の注意事項 
    - name 属性を必ず指定する 
    - default 属性を指定する 
  - サンプルコード 
  - フォームヘルパで使用できるすべてのタグ 
  - TODO 

| 書いた人 | ------ | ---------- | 新規作成 |
| 書いた人 | mumumu | 2009-01-22 | 最新版に追随する形で全面的に修正 |

### はじめに [](ethna-document-dev_guide-view-form_helper.html#i04f9055 "i04f9055")

このページの説明では、以下のようにプロジェクトとアクションクラス、テンプレートを作成し、フォーム定義を行ったとします。

    $ ethna add-project sample
    $ cd sample
    $ ethna add-action formhelper
    $ ethna add-view -t formhelper

    //
    // app/action/Formhelper.php
    //
    class Sample_Form_Formhelper extends Sample_ActionForm
    {
        var $form = array(
            'sample' => array(
                'type' => VAR_TYPE_STRING,
                'form_type' => FORM_TYPE_TEXT,
                'name' => 'サンプルテキストフォーム',
             ),
        );
    }

### フォームヘルパの基本と機能 [](ethna-document-dev_guide-view-form_helper.html#nb408803 "nb408803")

#### (入力)フォームタグの自動生成 [](ethna-document-dev_guide-view-form_helper.html#j4685151 "j4685151")

テンプレートに以下のように書くことで、自動的に上記のアクションフォームの定義を読み取って、外側の <form></form> タグ及び、入力テキストフォームとSubmitボタンを自動生成することができます。

    {* formhelper.tpl *}
    {form ethna_action="formhelper"}
      サンプル:{form_input name="sample"}<br>
      {form_submit value="Submit!"}
    {/form}

出力は以下のようなものです。

    <form method="post">
      <input type="hidden" name="action_formhelper" value="true">
      サンプル:<input type="text" name="sample" value="" /><br>
      <input value="Submit!" type="submit" />
    </form>

このように、{form} {/form} ブロックタグを外側に配置し、その内側で {form\_input} タグや {form\_submit} タグを使うのが基本になります。{form} ブロックタグには、 ethna\_action という属性に、フォーム定義を読み取らせるアクション名を指定します。 ethna\_action が指定されない場合は、現在のアクションにあるフォーム定義が使われます。

hidden タグも生成されていますが、それはこの後で説明します。

アクションフォームのフォーム定義で特に重要なのは以下の部分です。form\_type の値によって、生成される入力フォームが決まります。ここでは、FORM\_TYPE\_TEXT が指定されているため、テキスト入力フォームが生成されます。

    'form_type' => FORM_TYPE_TEXT,

#### フォーム値の補完 [](ethna-document-dev_guide-view-form_helper.html#y8a452a9 "y8a452a9")

ethna\_action と現在のアクションが同じ場合、フォームヘルパは自動的に Submit した値を入力フォームに補完してくれます。具体的には、Submitしたあとに同じ画面に戻 ってくるときが典型例です。

これは、Submit した値を検証した結果エラーになって入力をやり直させる場合に、ユーザ が同じことを入力させなくて良いようにとのフレームワークの配慮です。

先ほどの具体例で、hidden タグが以下のように出力されていました。これは、ethna\_action を指定した場合に、ethna\_action と submit 先のアクションが同じになるようにする ためです。

    <form method="post">
      <input type="hidden" name="action_formhelper" value="true">
      (... 以下略)
    </form>

### 基本的な書き方 [](ethna-document-dev_guide-view-form_helper.html#tfc9f5d8 "tfc9f5d8")

既に述べたように、フォームヘルパの基本的な使い方は、外側に {form} {/form} ブロッ クタグを外側に配置し、その内側で {form\_input} タグや {form\_submit} タグを使 うのが基本になります。

但し、フォーム定義によって、出力されるタグが異なってきます。ここでは、それについて具体例を交えて説明します。

#### 選択肢がないフォーム [](ethna-document-dev_guide-view-form_helper.html#cd6696e6 "cd6696e6")

選択肢がないフォームとは、以下を指します。

| form\_type に指定する定数 | 生成されるコントロール名 |
| FORM\_TYPE\_TEXT | テキストボックス |
| FORM\_TYPE\_PASSWORD | パスワード |
| FORM\_TYPE\_TEXTAREA | テキストエリア |
| FORM\_TYPE\_BUTTON | ボタン |
| FORM\_TYPE\_FILE | ファイル |
| FORM\_TYPE\_HIDDEN | 隠しコントロール |

選択肢がないフォームの場合は、フォーム定義の form\_type に、上記の該当する値を 指定して、テンプレート側で {form\_input} の name 属性に、フォーム定義の名前 を指定するだけです。

たとえばテキストエリアの場合は、以下のようになります。

    // フォーム定義
    var $form = array(
        'sample' => array( // ここの名前(sample) を form_input の name属性に指定する
            'type' => VAR_TYPE_STRING,
            'form_type' => FORM_TYPE_TEXTAREA,
            'name' => 'サンプルテキストエリア',
        ),
    );

テンプレートを以下のように指定します。

    {form_input name="sample"}

出力は以下のようになります。

    <textarea name="sample" value=""></textarea>

他の form\_type の場合も、対応したタグがそれぞれ出力されます。

#### 選択肢があるフォーム [](ethna-document-dev_guide-view-form_helper.html#p19c658d "p19c658d")

HTML で指定できるフォーム要素の中には、選択肢を作ることができるものがあります。 この場合、微妙に扱いが異なります。選択肢が指定できるフォームには以下があります。

| form\_type に指定する定数 | 生成されるコントロール名 |
| FORM\_TYPE\_SELECT | セレクトボックス |
| FORM\_TYPE\_RADIO | ラジオボタン |
| FORM\_TYPE\_CHECKBOX | チェックボックス |

選択肢を複数使って1つのフォーム(コントロール)をつくる SELECT タグの場合、選 択肢を次のように指定できます。form\_type の値と、選択肢に option で配列を 指定しているのに注目してください。

option には、input タグの value 値をキーにして、表示するラベルを値にした 配列を指定します。

    $form = array(
        'sample' => array(
             'type' => VAR_TYPE_INT,
             'form_type' => FORM_TYPE_SELECT,
             'name' => '選んでね',
             'option' => array(1 => '1番目', 2 => '2番目'),
        ),
    );

テンプレートでは テキストボックスの場合と同様に

    {form_input name="sample"}

とすれば、以下のように出力されます。

    <select name="sample">
      <option value="1">1番目</option>
      <option value="2">2番目</option>
    </select>

フォーム定義に FORM\_TYPE\_RADIO を指定した場合、以下のように出力されます。

    <label for="sample1_1">
      <input type="radio" name="sample" value="1" id="sample1_1" />1番目
    </label>
    <label for="sample1_2">
      <input type="radio" name="sample" value="2" id="sample1_2" />2番目
    </label>

フォーム定義に FORM\_TYPE\_CHECKBOX を指定した場合、以下のように出力されます。

    <label for="sample2_1">
      <input type="checkbox" name="sample" value="1" id="sample2_1" />1番目
    </label>
    <label for="sample2_2">
      <input type="checkbox" name="sample" value="2" id="sample2_2" />2番目
    </label>

### フォーム定義が配列の場合 [](ethna-document-dev_guide-view-form_helper.html#s3fa4fe5 "s3fa4fe5")

選択肢が必要なフォーム以外、たとえばテキスト入力フォームのフォーム定義が配列で指定されている場合、 たとえば以下のように定義したとします。

    $form = array(
        'sample' => array(
             'type' => array(VAR_TYPE_STRING), // 配列指定のフォーム定義
             'form_type' => FORM_TYPE_TEXT,
             'name' => '3つ入力してね',
        ),
    );

そして、テンプレートで以下のように指定すると、配列向けのフォームが自動生成されます。

    {form_input name="sample"}
    {form_input name="sample"}
    {form_input name="sample"}

つまり、出力は以下のようになります。{form\_input} を並べた数だけ、配列向けのフォームが自動 生成されるということです。

    <input type="text" name="sample[]" value="" />
     <input type="text" name="sample[]" value="" />
     <input type="text" name="sample[]" value="" />

### 生成されるHTML に style 等のパラメータを指定したい場合 [](ethna-document-dev_guide-view-form_helper.html#u4bb117e "u4bb117e")

これまで説明してきた、「自動生成されるHTML」に、css の style 属性や、フォームの size 属性等の HTMLな属性を付け加えたいという要求は自然なことです。フォームヘルパでは、 [フォームヘルパ タグリファレンス](ethna-document-dev_guide-view-form_helper-ref.html "ethna-document-dev\_guide-view-form\_helper-ref (999d)") にあるパラメータ以外のパラメータを渡すと、HTML の属性としてそのまま埋め込まれるようになっています。

これを利用すれば、任意のHTML の属性を埋め込むことが出来ます。

以下は、sample という名前の入力フォームにスタイルを指定する例です。

    {* 境界線のスタイルを青、2px、1本線に指定する *}
    {form_input name="sample" style="border: solid 2px #0000ff"}
    
    {* superstyle という CSSクラス名を指定する *}
    {form_input class="superstyle"}

「使用例」にも、この性質を利用したサンプルがあります。

#### パラメータを指定する場合の注意事項 [](ethna-document-dev_guide-view-form_helper.html#e3d7bd12 "e3d7bd12")

フォームヘルパでは、HTMLタグを出力するときにまとめてエスケープ処理が入ります。パラメータとして指定する値はエスケープしないように気をつけてください。

### フォーム値の補完の詳細 [](ethna-document-dev_guide-view-form_helper.html#z91e2db6 "z91e2db6")

入力フォームを自動生成するために使う {form\_input} は、設定する値(<input type="..." value="hoge" /> の hoge の部分) の属性として default と value 属性が用意されています。

    {form_input name="sample" default="1"}
    {form_input name="sample" value="1"}

- valueはその値が編集されることを期待しない場合に指定します。また、submitされて戻ってきた場合は、このvalue属性に値が補完されます。
- defaultは、編集されるフォームに初期値を与える場合に指定します。valueが指定されている場合はdefaultよりも優先されます。

{form\_input} タグの default 属性が配列で指定された場合、上から順に 同じ名前のdefaultの値を埋めていきます。これは、以下のようにフォーム定義が配列の場合に有用です。

    // Viewやアクション側で以下のように設定する
    $this->af->setApp('default', 
                       array('a', 'b', 'c')
    );

    {* テンプレート側では以下のように値が補完される
      {form_input name="sample[]" default="$app.default"} {* a が補完される *}
      {form_input name="sample[]" default="$app.default"} {* b が補完される *}
      {form_input name="sample[]" default="$app.default"} {* c が補完される *}

また、{form}{/form} ブロックタグの default 属性が以下のように指定されると、その値はこのブロックタグで囲まれた {form\_input} のdefault属性すべてに適用されます。例を以下に示します。

    // アクションや View で以下のように指定してみる
    $this->af->setApp('sample',
                      array(
                          'sample' => 'a',
                          'sample1' => 'b',
                      )
    );

    {* テンプレート側の例 *}
    {* value属性は default属性に優先するので、 *}
    {* エラーで戻ってきた場合は submit された値が補完される *}
    {form action="ethna_action" default=$app.sample}
        {form_input name='sample'} {* default 属性に a という値が補完される *}
        {form_input name='sample1'} {* default 属性に b という値が補完される *}
    {/form}

### 複数 {form}{/form} を指定する場合の注意事項 [](ethna-document-dev_guide-view-form_helper.html#y273cd97 "y273cd97")

    以下の記述は、Ethna 2.5.0 preview3 以降に当てはまります。

#### name 属性を必ず指定する [](ethna-document-dev_guide-view-form_helper.html#f23a56ee "f23a56ee")

1テンプレートに {form}{/form} ブロックタグを指定する場合は、少し注意が必要です。それは {form} タグに必ず name 属性を「重複しない」名前を指定することです。これは、エラー等で同じ画面に戻ってきた場合に、submit したフォーム値を補完フォームを区別するためです。

    {form name="hoge1"}{/form}
    {form name="hoge2"}{/form}

この場合は、以下のように ethna\_fid というフォームを識別するための隠しフィールドが出力されます。\*1

    <form name="hoge1">
      <input type="hidden" name="ethna_fid" value="hoge1" />
    </form>
    <form name="hoge2">
      <input type="hidden" name="ethna_fid" value="hoge2" />
    </form>

#### default 属性を指定する [](ethna-document-dev_guide-view-form_helper.html#f23a56ee "f23a56ee")

複数のフォームを並べていくと、{form\_input} タグの value や default 属性の指定が非常に大変になります。その場合こそ、{form}{/form} タグの default 属性の使用を検討すべきです。

### サンプルコード [](ethna-document-dev_guide-view-form_helper.html#i57e7b30 "i57e7b30")

[フォームヘルパ サンプル集](ethna-document-dev_guide-view-form_helper-samples.html "ethna-document-dev\_guide-view-form\_helper-samples (999d)") のページを参照してください。

### フォームヘルパで使用できるすべてのタグ [](ethna-document-dev_guide-view-form_helper.html#ud59cee5 "ud59cee5")

[フォームヘルパ タグリファレンス](ethna-document-dev_guide-view-form_helper-ref.html "ethna-document-dev\_guide-view-form\_helper-ref (999d)") のページを参照してください。

### TODO [](ethna-document-dev_guide-view-form_helper.html#n9218634 "n9218634")

実装の大部分はEthna\_Renderer\_SmartyではなくEthna\_ViewClassが持っているため、本当はSmartyに限らずさまざまなレンダラで利用可能なはずです。しかし、現時点ではSmartyしかレンダラが用意されていません。素のPHPや、flexy等、他のテンプレートエンジンもサポートすべきだと考えています。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1Ethna 2.3.5 以前は、1テンプレートに複数 {form}{/form} ブロックタグを指定した場合は、エラーで戻ってきた場合等に、すべてのフォームに submit した値を補完するバグがありました。2.5.0 preview3 以降、この問題は改善しています。  

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
