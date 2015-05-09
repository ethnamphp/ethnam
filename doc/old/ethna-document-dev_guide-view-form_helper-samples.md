# フォームヘルパ サンプル集 - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# フォームヘルパ サンプル集 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [ビュー定義](ethna-document-dev_guide-view.html) > [フォームへルパ](ethna-document-dev_guide-view-form_helper.html) > フォームヘルパ サンプル集 
## フォームヘルパ サンプル集 [](ethna-document-dev_guide-view-form_helper-samples.html#za7890ce "za7890ce")

[フォームヘルパのページ](ethna-document-dev_guide-view-form_helper.html "ethna-document-dev\_guide-view-form\_helper (998d)") で説明した通り、フォームヘルパはアクションフォームのフォーム定義を読み取り、入力フォームを自動生成してくれる優れた機能です。

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

### サンプルコード [](ethna-document-dev_guide-view-form_helper-samples.html#sample "sample")

#### GET メソッドで submit できないの？ [](ethna-document-dev_guide-view-form_helper-samples.html#e79e41fe "e79e41fe")

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

#### ファイルをアップロードする処理をフォームヘルパで [](ethna-document-dev_guide-view-form_helper-samples.html#b7f425f4 "b7f425f4")

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

#### 複数選択が必要な SELECT ボックス [](ethna-document-dev_guide-view-form_helper-samples.html#i661b532 "i661b532")

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

#### テキストボックスのサイズを指定して、非表示にする [](ethna-document-dev_guide-view-form_helper-samples.html#w7015017 "w7015017")

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

#### いちいちタグに value="hoge" とか書きたくないよ！ [](ethna-document-dev_guide-view-form_helper-samples.html#v362698b "v362698b")

... 執筆中

#### 編集画面に初期値を指定する [](ethna-document-dev_guide-view-form_helper-samples.html#v10af805 "v10af805")

... 執筆中

#### 日付の選択フォームを簡単に [](ethna-document-dev_guide-view-form_helper-samples.html#pb9afac4 "pb9afac4")

... 執筆中

#### 入力ウィザードを作る [](ethna-document-dev_guide-view-form_helper-samples.html#od6deeaa "od6deeaa")

... 執筆中

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
