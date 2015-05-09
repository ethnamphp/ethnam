# Ethna組込みのSmartyプラグイン
- Ethna組込みのSmartyプラグイン 
  - 概要 
  - modifier 
    - {...|number\_format} 
    - {...|strftime} 
    - {...|count} 
    - {...|join} 
    - {...|filter} 
    - {...|explode} 
    - {...|unique} 
    - {...|wordwrap\_i18n} 
    - {...|truncate\_i18n} 
    - {...|i18n} 
    - {...|checkbox}, {...|select}, {...|form\_value} 
  - function 
    - {message} 
    - {url} 
    - {form\_name} 
    - {form\_submit} 
    - {form\_input} 
    - {csrfid} 
    - {is\_error}, {uniqid}, {select}, {checkbox\_list} 
  - block 
    - {form}...{/form} 

書いた人: いちい

### 概要 [](ethna-document-dev_guide-view-smarty-plugin.html#z37591c7 "z37591c7")

EthnaでSmartyを使う場合に利用できる、組込みの便利なプラグイン(modfier, function, block)についての説明です。

基本的に Ethna\_ViewClass で提供されているヘルパ関数や、 php の組込み関数、 Ethna\_Util の関数などを呼び出すラッパーになっています。

### modifier [](ethna-document-dev_guide-view-smarty-plugin.html#w1d1dc3e "w1d1dc3e")

#### {...|number\_format} [](ethna-document-dev_guide-view-smarty-plugin.html#sd39a0ad "sd39a0ad")

number\_format()関数のラッパーです。

- 入力

    {"12345"|number_format}

- 出力

    12,345

#### {...|strftime} [](ethna-document-dev_guide-view-smarty-plugin.html#s6e2099e "s6e2099e")

strftime()関数のラッパーです。

- 入力

    {"2004/01/01 01:01:01"|strftime:"%Y年%m月%d日"}

- 出力

    2004年01月01日

#### {...|count} [](ethna-document-dev_guide-view-smarty-plugin.html#a87881df "a87881df")

(配列にたいする) count() 関数のラッパーです。

    {$array|count}

#### {...|join} [](ethna-document-dev_guide-view-smarty-plugin.html#xea72868 "xea72868")

配列を連結して文字列にする join() 関数のラッパーです。

    {$str_array|join:","}

#### {...|filter} [](ethna-document-dev_guide-view-smarty-plugin.html#z9e2a437 "z9e2a437")

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

#### {...|explode} [](ethna-document-dev_guide-view-smarty-plugin.html#w56ea453 "w56ea453")

文字列に対する explode() 関数のラッパーです。 第一引数の文字列を第二引数の文字列により分割し、配列にします。

- 入力

    $smarty->assign("1,2,3", ",");

  

    {$array|explode:","}

- 出力

    array(1, 2, 3)

#### {...|unique} [](ethna-document-dev_guide-view-smarty-plugin.html#y34bb5d9 "y34bb5d9")

配列に対する unique() 関数のラッパーです。第2引数にキーをあたえることで、 filter を同時に行うことができます。

    {$array|unique:"foo"}

#### {...|wordwrap\_i18n} [](ethna-document-dev_guide-view-smarty-plugin.html#c39ad432 "c39ad432")

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

#### {...|truncate\_i18n} [](ethna-document-dev_guide-view-smarty-plugin.html#n15883e8 "n15883e8")

文字列を指定された文字数で切り詰めます。 mb\_strimwidth() を用いています。

- 入力

    {"日本語です"|truncate_i18n:5:"..."}

- 出力

    日本...

- 引数
  - 切り詰める文字数
  - 切り詰めた後に付加する文字列

#### {...|i18n} [](ethna-document-dev_guide-view-smarty-plugin.html#hb086473 "hb086473")

i18nメッセージを取得します。 Ethna\_I18N クラスを利用します。

- 入力

    {"english"|i18n}

- 出力(例)

    英語

#### {...|checkbox}, {...|select}, {...|form\_value} [](ethna-document-dev_guide-view-smarty-plugin.html#w5e2d67e "w5e2d67e")

詳しくはAPIドキュメントをご覧ください。多くの場合、もっと簡単な代替手段があります。

### function [](ethna-document-dev_guide-view-smarty-plugin.html#jb6c34d2 "jb6c34d2")

#### {message} [](ethna-document-dev_guide-view-smarty-plugin.html#ef634ae8 "ef634ae8")

指定されたフォームにエラーがある場合にメッセージを出力します。エラーがないときはなにも出力されません。

- 入力

    <input type="text" name="foo">{message name="foo"}

- 出力

    <input type="text" name="foo">fooを入力してください

- 引数
  - アクションフォームで定義したフォーム名を指定します。

#### {url} [](ethna-document-dev_guide-view-smarty-plugin.html#l7b00d3d "l7b00d3d")

Ethna\_UrlHandler を使って、アクション名とパラメータからURLを生成します。UrlHandlerについての説明については [Ethna\_UrlHandler](ethna-document-dev_guide-urlhandler.html "ethna-document-dev\_guide-urlhandler (926d)")を参照してください。

以下では、アプリの設定ファイル (app-ini.php) で 'url' => ' [http://example.jp/index.php'](http://example.jp/index.php') が設定され、 /show/article/3/2 で show\_article アクションにパラメータ chapter=3, sectio=2 を与えるものとします。

- 入力

    {url action="show_article" chapter="3" section="1" style="plain" scheme="https" anchor="subsection2"}

- 出力

    https://example.jp/index.php/show/article/3/2?style=plain#subsection2

- 引数
  - action: UrlHandlerに渡すアクション名を指定します。(必須)
  - scheme: 'url' に http:// などの scheme が指定されていた場合に、それを置き換えることができます。
  - anchor: '#anchor' 形式のアンカーを付加します。
  - 上にあげた以外のパラメータ: GETパラメータとしてURLに付加されます。

#### {form\_name} [](ethna-document-dev_guide-view-smarty-plugin.html#s97b2520 "s97b2520")

アクションフォームで定義された、フォームの表示名を取得します。Ethna\_ViewClassのgetFormName()を用いています。

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
  - action: フォーム定義を取得するアクションを指定します。省略時の動作については [フォームヘルパ](ethna-document-dev_guide-view-form_helper.html "ethna-document-dev\_guide-view-form\_helper (998d)")を参照してください。

#### {form\_submit} [](ethna-document-dev_guide-view-smarty-plugin.html#c1428cb7 "c1428cb7")

フォームのsubmitボタンを生成します。Ethna\_ViewClassのgetFormSubmit()を用いています。詳しくは [Ethna\_ViewClass](ethna-document-dev_guide-view.html "ethna-document-dev\_guide-view (1240d)")を参照してください。

- 入力

    {form_submit value="送信"}

- 出力

    [送信] (実際はブラウザのボタン)

- 引数
  - すべて getFormSubmit() にそのまま渡されます。

#### {form\_input} [](ethna-document-dev_guide-view-smarty-plugin.html#ub5cb6ab "ub5cb6ab")

Ethna\_ViewClassのgetFormInput() (および \_getFormInput\_\*()) を使い、アクションフォームのフォーム定義から、自動的にそのフォームを送信するためのHTMLタグを生成します。

詳細は [フォームヘルパ](ethna-document-dev_guide-view-form_helper.html "ethna-document-dev\_guide-view-form\_helper (998d)")を参照してください。

#### {csrfid} [](ethna-document-dev_guide-view-smarty-plugin.html#tf9b83f9 "tf9b83f9")

CSRF対策のためのIDをhiddenタグもしくはGETのリクエストパラメータとして出力します。

- 入力

    {csrfid}
    <a href="index.php?action_do_something=true&{csrfid type="get"}>

- 出力

    <input type="hidden" name="csrfid" value="a0f24f75e...e48864d3e">
    <a href="index.php?action_do_something=true&csrfid=a0f24f75e...e48864d3e">

#### {is\_error}, {uniqid}, {select}, {checkbox\_list} [](ethna-document-dev_guide-view-smarty-plugin.html#b81022e5 "b81022e5")

詳しくはAPIドキュメントをご覧ください。多くの場合、もっと簡単な代替手段があります。

### block [](ethna-document-dev_guide-view-smarty-plugin.html#g3dec9f6 "g3dec9f6")

#### {form}...{/form} [](ethna-document-dev_guide-view-smarty-plugin.html#wd0aba94 "wd0aba94")

詳細は [フォームヘルパ](ethna-document-dev_guide-view-form_helper.html "ethna-document-dev\_guide-view-form\_helper (998d)")を参照してください。

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
