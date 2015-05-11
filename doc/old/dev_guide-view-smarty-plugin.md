# Ethna組込みのSmartyプラグイン
- Ethna組込みのSmartyプラグイン 
  - 概要 
  - modifier 
    - {...|number_format} 
    - {...|strftime} 
    - {...|count} 
    - {...|join} 
    - {...|filter} 
    - {...|explode} 
    - {...|unique} 
    - {...|wordwrap_i18n} 
    - {...|truncate_i18n} 
    - {...|i18n} 
    - {...|checkbox}, {...|select}, {...|form_value} 
  - function 
    - {message} 
    - {url} 
    - {form_name} 
    - {form_submit} 
    - {form_input} 
    - {csrfid} 
    - {is_error}, {uniqid}, {select}, {checkbox_list} 
  - block 
    - {form}...{/form} 

書いた人: いちい

### 概要

EthnaでSmartyを使う場合に利用できる、組込みの便利なプラグイン(modfier, function, block)についての説明です。

基本的に Ethna_ViewClass で提供されているヘルパ関数や、 php の組込み関数、 Ethna_Util の関数などを呼び出すラッパーになっています。

### modifier

#### {...|number_format}

number_format()関数のラッパーです。

- 入力

    {"12345"|number_format}

- 出力

    12,345

#### {...|strftime}

strftime()関数のラッパーです。

- 入力

    {"2004/01/01 01:01:01"|strftime:"%Y年%m月%d日"}

- 出力

    2004年01月01日

#### {...|count}

(配列にたいする) count() 関数のラッパーです。

    {$array|count}

#### {...|join}

配列を連結して文字列にする join() 関数のラッパーです。

    {$str_array|join:","}

#### {...|filter}

連想配列のリストから、指定されたキーの値だけを取り出して配列を再構成します。

- 入力

    $smarty->assign("array", array(
        array("foo" => 1, "bar" => 4),
        array("foo" => 2, "bar" => 5),
        array("foo" => 3, "bar" => 6),
    ));

  

    {$array|filter:"foo"|join:","}

- 出力

    1,2,3

#### {...|explode}

文字列に対する explode() 関数のラッパーです。 第一引数の文字列を第二引数の文字列により分割し、配列にします。

- 入力

    $smarty->assign("1,2,3", ",");

  

    {$array|explode:","}

- 出力

    array(1, 2, 3)

#### {...|unique}

配列に対する unique() 関数のラッパーです。第2引数にキーをあたえることで、 filter を同時に行うことができます。

    {$array|unique:"foo"}

#### {...|wordwrap_i18n}

**utf-8のみ対応** 指定された文字数で文字列をワードラップします。

- 入力

    ----12345678----
    {"あいうaえaおaかきaaaくけこ"|wordrap_i18n:8:"\n":4}

- 出力

    ----12345678----
        あいうa
        えaおaか
        きaaaく
        けこ

- 引数
  - ワードラップする文字数 (必須)
  - 改行文字
  - 半角スペースでのインデント数

#### {...|truncate_i18n}

文字列を指定された文字数で切り詰めます。 mb_strimwidth() を用いています。

- 入力

    {"日本語です"|truncate_i18n:5:"..."}

- 出力

    日本...

- 引数
  - 切り詰める文字数
  - 切り詰めた後に付加する文字列

#### {...|i18n}

i18nメッセージを取得します。 Ethna_I18N クラスを利用します。

- 入力

    {"english"|i18n}

- 出力(例)

    英語

#### {...|checkbox}, {...|select}, {...|form_value}

詳しくはAPIドキュメントをご覧ください。多くの場合、もっと簡単な代替手段があります。

### function

#### {message}

指定されたフォームにエラーがある場合にメッセージを出力します。エラーがないときはなにも出力されません。

- 入力

    <input type="text" name="foo">{message name="foo"}

- 出力

    <input type="text" name="foo">fooを入力してください

- 引数
  - アクションフォームで定義したフォーム名を指定します。

#### {url}

Ethna_UrlHandler を使って、アクション名とパラメータからURLを生成します。UrlHandlerについての説明については [Ethna_UrlHandler](dev_guide-urlhandler.md)を参照してください。

以下では、アプリの設定ファイル (app-ini.php) で 'url' => ' [http://example.jp/index.php'](http://example.jp/index.php') が設定され、 /show/article/3/2 で show_article アクションにパラメータ chapter=3, sectio=2 を与えるものとします。

- 入力

    {url action="show_article" chapter="3" section="1" style="plain" scheme="https" anchor="subsection2"}

- 出力

    https://example.jp/index.php/show/article/3/2?style=plain#subsection2

- 引数
  - action: UrlHandlerに渡すアクション名を指定します。(必須)
  - scheme: 'url' に http:// などの scheme が指定されていた場合に、それを置き換えることができます。
  - anchor: '#anchor' 形式のアンカーを付加します。
  - 上にあげた以外のパラメータ: GETパラメータとしてURLに付加されます。

#### {form_name}

アクションフォームで定義された、フォームの表示名を取得します。Ethna_ViewClassのgetFormName()を用いています。

    var $form = array(
        'text' => array(
            'type' => VAR_TYPE_TEXT,
            'name' => 'テキスト',
            ...

- 入力

    {form_name name="text" action="foo"}

- 出力

    テキスト

- 引数
  - name: フォーム名(連想配列$formのキー)を指定します。(必須)
  - action: フォーム定義を取得するアクションを指定します。省略時の動作については [フォームヘルパ](dev_guide-view-form_helper.md)を参照してください。

#### {form_submit}

フォームのsubmitボタンを生成します。Ethna_ViewClassのgetFormSubmit()を用いています。詳しくは [Ethna_ViewClass](dev_guide-view.md)を参照してください。

- 入力

    {form_submit value="送信"}

- 出力

    [送信] (実際はブラウザのボタン)

- 引数
  - すべて getFormSubmit() にそのまま渡されます。

#### {form_input}

Ethna_ViewClassのgetFormInput() (および _getFormInput_\*()) を使い、アクションフォームのフォーム定義から、自動的にそのフォームを送信するためのHTMLタグを生成します。

詳細は [フォームヘルパ](dev_guide-view-form_helper.md)を参照してください。

#### {csrfid}

CSRF対策のためのIDをhiddenタグもしくはGETのリクエストパラメータとして出力します。

- 入力

    {csrfid}
    <a href="index.php?action_do_something=true&{csrfid type="get"}>

- 出力

    <input type="hidden" name="csrfid" value="a0f24f75e...e48864d3e">
    <a href="index.php?action_do_something=true&csrfid=a0f24f75e...e48864d3e">

#### {is_error}, {uniqid}, {select}, {checkbox_list}

詳しくはAPIドキュメントをご覧ください。多くの場合、もっと簡単な代替手段があります。

### block

#### {form}...{/form}

詳細は [フォームヘルパ](dev_guide-view-form_helper.md)を参照してください。

