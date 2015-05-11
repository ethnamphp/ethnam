# フォームヘルパ サンプル集
[フォームヘルパのページ](view-form_helper.md) で説明した通り、フォームヘルパはアクションフォームのフォーム定義を読み取り、入力フォームを自動生成してくれる優れた機能です。

非常に強力な分、機能も複雑なため、ここではその使い方をサンプルという形で示しています。

- フォームヘルパ サンプル集 
  - サンプルコード 
    - GET メソッドで submit できないの？ 
    - ファイルをアップロードする処理をフォームヘルパで 
    - 複数選択が必要な SELECT ボックス 
    - テキストボックスのサイズを指定して、非表示にする 
    - いちいちタグに value="hoge" とか書きたくないよ！ 
    - 編集画面に初期値を指定する 
    - 日付の選択フォームを簡単に 
    - 入力ウィザードを作る 

| 書いた人 | mumumu | 2009-01-29 | 新規作成 |

### サンプルコード

#### GET メソッドで submit できないの？

{form}{/form} ブロックタグは、デフォルトでPOST メソッドを指定しますが、もちろん それ以外の方法も指定できます。

    {* テンプレート側 *}
    {form method="GET" ethna_action="formhelper"}
      (... 省略)
    {/form}

出力は以下のようになります。

    <form method="GET">
      <input type="hidden" name="action_formhelper" value="true">
      (... 省略)
    </form>

#### ファイルをアップロードする処理をフォームヘルパで

ファイルをアップロードする際には、<form enctype="multipart/form-data"> と指定する必要があります。こんなtypoしやすい文字列をいちいち書いてられないので、フォームヘルパを使いましょう。

    // フォーム定義
    var $form = array(
        'sample' => array(
             'type' => VAR_TYPE_FILE, // ファイル型
             'form_type' => FORM_TYPE_FILE, // form_typeにもファイル型を指定
             'name' => 'ファイルを選んでね',
        ),
    );

{form}{/form} ブロックタグの enctype属性に "file" と指定してあげれば、typoしやすい multipart/form-data も生成してくれます。

    {* テンプレート側 *}
    {form enctype="file" ethna_action="formhelper"}
      {form_input name="sample"}
    {/form}

出力は以下のようになります。

    <form enctype="multipart/form-data" method="post">
      <input type="hidden" name="action_formhelper" value="true">
      <input type="file" name="sample" value="" />
    </form>

#### 複数選択が必要な SELECT ボックス

いわゆる multiple な SELECT ボックスを作りたい場合は、以下のようにします。一度に複数選択できるようにするので、フォーム定義の type 属性に 配列型を指定し、テンプレートでも multiple 属性を指定しているのがミソです。

    // フォーム定義
    var $form = array(
        'sample' => array(
             'type' => array(VAR_TYPE_INT), // 配列指定のフォーム定義
             'form_type' => FORM_TYPE_SELECT,
             'name' => '複数選んでね',
             'option' => array(1 => '1番目', 2 => '2番目'),
        ),
    );

    // テンプレート側
    {form_input name="sample" multiple="multiple"}

出力は以下のようになります。これにより、複数の整数型の値を選択し、submitできるようになります。

    <select multiple="multiple" name="sample[]">
      <option value="1">1番目</option>
      <option value="2">2番目</option>
    </select>

#### テキストボックスのサイズを指定して、非表示にする

フォームヘルパのタグによって予約されている属性以外を埋め込めることから、HTMLのサイズやスタイルも指定できます。テキストボックスの場合、以下のようにします。

    // フォーム定義
    // 通常の指定と変わらない
    var $form = array(
        'sample' => array(
             'type' => VAR_TYPE_STRING,
             'form_type' => FORM_TYPE_TEXT,
             'name' => 'テキストボックスのサンプル',
        ),
    );

    {* テンプレート側 *}
    {* サイズを50にし、非表示にする *}
    {form_input name="sample" size="50" style="display:none"}

出力は以下のようになります。

    <input size="50" style="display:none" type="text" name="sample" value="" />

#### いちいちタグに value="hoge" とか書きたくないよ！

... 執筆中

#### 編集画面に初期値を指定する

... 執筆中

#### 日付の選択フォームを簡単に

... 執筆中

#### 入力ウィザードを作る

... 執筆中

