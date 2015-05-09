# フォームヘルパ タグリファレンス
[フォームヘルパのページ](ethna-document-dev_guide-view-form_helper.html "ethna-document-dev\_guide-view-form\_helper (998d)") で説明した通り、フォームヘルパはアクションフォームのフォーム定義を読み取り、入力フォームを自動生成してくれる優れた機能です。ここでは、フォームヘルパで使えるタグのすべてをリファレンスとして示します。

- フォームヘルパ タグリファレンス 
  - {form}{/form} ブロックタグ 
  - {form\_input} 
    - パラメータの渡し方 
    - もう少し細かく 
    - 一般的なフォーム 
    - 配列で指定されたフォーム 
    - 選択肢が必要なフォーム 
  - {form\_name} 
  - {form\_submit} 
  - 注意事項 

| 書いた人 | mumumu | 2009-01-23 | 新規作成 |

### {form}{/form} ブロックタグ [](ethna-document-dev_guide-view-form_helper-ref.html#rbb7b355 "rbb7b355")

{form}ブロックタグの一番の役割は、ブロックの中身を <form>...</form> タグで囲み、アクションフォームの定義を読み取ることです。

{form}ブロックが受け取れるパラメータは以下の通りです。

- name
  - フォーム名を指定します。ひとつのテンプレート内に複数 {form} ブロックタグを指定する場合、この指定は必須です。それぞれの名前は重複しないようにしてください。
- ethna\_action
  - フォーム定義を読み取る対象のアクション名を指定します。{form}ブロック内で{form\_input name="foo"}と指定されていたとき、"foo"というフォームがどのアクションで定義されているかを指定します。省略時は現在のアクションになります(フォーム値が不正で戻ってくるときなど)
  - ethna\_actionで指定したアクション名で、

    <input type="hidden" name="action_XXX" value="true">

と出力されます。
- enctype
  - フォームのenctypeを指定します。'file' のみが現在指定できます。この場合、enctype="multipart/form-data" が <form> タグに出力できます。
- default
  - {form}ブロック内でのdefaultをまとめて指定するときに使います。フォーム名をkeyとする連想配列を与えます。省略時は現在のフォーム値になります。
  - **注意** : ここで指定する値は出力時にエスケープ処理が入ります。たとえばテンプレートで {form default=$form} のように指定すると、2重にエスケープされてしまうことに注意してください。省略時の値は$formではなくActionFormから直接取得しています。
- method
  - get/postを指定します。省略時はpostになります。

参考までに、パラメータ action は{form}ブロックは理解しないので、

    {form action="index.php"}

とすると<form>タグのパラメータとしてそのままわたされて、

    <form action="index.php">

と出力されます。

### {form\_input} [](ethna-document-dev_guide-view-form_helper-ref.html#i3d40688 "i3d40688")

#### パラメータの渡し方 [](ethna-document-dev_guide-view-form_helper-ref.html#q5b0f000 "q5b0f000")

{form\_input}タグは以下の二つでパラメータを受けとることができます。

- ActionForm での定義
- Smarty テンプレートでの指定

このうち、いわゆるMVC的なビューに属するものはテンプレートで、そうでないものはActionForm で指定するようにしているつもりですが、実用上の簡便さから両者が混ざっている部分もあります。基 本的には以下の考え方で作られています。

- アプリケーションのコンテキストによって決まるものはActionForm
  - <select>タグの選択肢をデータベースから取得するような場合
- 表示の問題でしかないもの、htmlのタグ生成に直接渡されるパラメータはテンプレート
  - style指定などはヘルパーは理解せずそのままhtmlのタグにパラメータとして渡されます。

#### もう少し細かく [](ethna-document-dev_guide-view-form_helper-ref.html#y3e3abac "y3e3abac")

正確には、タグを生成するときに

- ActionFormでの定義のうち、タグごとに決められたパラメータを解釈する
- テンプレートで渡されたパラメータのうち、タグごとに決められたパラメータを解釈し、 のこりのパラメータについてはhtmlのパラメータにそのまま渡す

という流れになります。どちらでも指定できるものについては、次の順に評価され、後ろにあるものほど優先されます。

- ActionFormでの指定
- {form\_input}を囲む{form}ブロックでの指定
- {form}での指定

#### 一般的なフォーム [](ethna-document-dev_guide-view-form_helper-ref.html#l9325637 "l9325637")

ほとんどの場合、フォームの種類(FORM\_TYPE)に従い対応するhtmlタグを出力するだけです。

パラメータとして指定できるdefault, valueは、どちらもフォームの値を指定するものですが、次のような違いがあります。

- valueはその値が編集されることを期待しない場合に指定します。hiddenやbuttonなどです。
- defaultは、編集されるフォームに初期値を与える場合に指定します。valueが指定されている場合はdefaultよりも優先されます。

#### 配列で指定されたフォーム [](ethna-document-dev_guide-view-form_helper-ref.html#ha685255 "ha685255")

選択肢が必要なフォーム以外で、たとえばふつうのテキスト入力フォームが配列で指定されている場合

    $form = array(
        "foo" => array(
             'type' => VAR_TYPE_STRING,
             'form_type' => FORM_TYPE_TEXT,
             'name' => '3つ入力してね',
        ),
    );

のように定義して、

    {form_input name="foo"}
    {form_input name="foo"}
    {form_input name="foo"}

と3つ{form\_input}を並べると<input>タグが3つ生成されます。defaultが配列で指定されている場合、上から順にdefaultの値を埋めていきます。

#### 選択肢が必要なフォーム [](ethna-document-dev_guide-view-form_helper-ref.html#g96861c2 "g96861c2")

選択肢が必要なフォームはFORM\_TYPE\_SELECT, FORM\_TYPE\_CHECKBOX, FORM\_TYPE\_RADIOの3つがあります。

選択肢はActionForm (またはテンプレート) で'option'パラメータによって指定します。ActionForm で、以下の option の \*\*\* の部分に以下の3通りが指定できます。

    $form = array(
        "foo" => array(
             'type' => VAR_TYPE_INT,
             'form_type' => FORM_TYPE_SELECT,
             'name' => '次から選んでください:',
             'option' => ***,
        ),
    );

- array (連想配列)
  - keyが選択肢の実際の値、valueが表示される値
- ',' を含まない string
  - そのActionFormのプロパティもしくは関数の返す値(配列)を選択肢にします。
- ',' で区切られた2つの string ('address,prefecture'など)
  - 'address'マネージャの'prefecture'プロパティの値一覧を選択肢にします。アプリケーションマネージャ(AppManager)のgetAttrList()関数を利用しています。

またselectタグについてはパラメータemptyoptionが指定できます。これは、選択肢のどれも選択されていないときに表示する値を指定できます(value=""となります)。

    {form_input emptyoption="選択してね"}

### {form\_name} [](ethna-document-dev_guide-view-form_helper-ref.html#n9fa50cd "n9fa50cd")

フォーム定義の 'name' 属性の値をそのまま出力します。

    $form = array(
        "foo" => array(
             'type' => VAR_TYPE_STRING,
             'form_type' => FORM_TYPE_TEXT,
             'name' => '3つ入力してね',
        ),
    );

たとえば上記のようなフォーム定義があったとして、

    {form_name name="foo"}

とテンプレートに書くと、以下のように出力されます。

    3つ入力してね

### {form\_submit} [](ethna-document-dev_guide-view-form_helper-ref.html#k0e2bffb "k0e2bffb")

submitボタンだけを作りたい場合、(テンプレートにそのままhtmlタグを書いてもいいですが)送信先のActionFormにボタンの定義をするのは面倒なので、{form\_submit}を使って定義によらずに送信ボタンを出力することができます。

    {form_submit value="送信するよ!"}

### 注意事項 [](ethna-document-dev_guide-view-form_helper-ref.html#b1c6abef "b1c6abef")

[{form}ブロックタグ](ethna-document-dev_guide-view-form_helper-ref.html#rbb7b355 "ethna-document-dev\_guide-view-form\_helper-ref (999d)")の項にも書きましたが、タグを出力するときにまと めてエスケープ処理が入るので、パラメータとして指定する値はエスケープしないように気をつけてください。

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
