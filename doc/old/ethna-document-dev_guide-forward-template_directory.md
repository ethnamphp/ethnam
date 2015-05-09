# テンプレートディレクトリを変更する

## テンプレートディレクトリを変更する [](ethna-document-dev_guide-forward-template_directory.html#z6cf629d "z6cf629d")

デフォルトでは、テンプレートは template ディレクトリに置かれます。このディレクトリはコントローラの$directoryメンバ変数を変更することで任意のディレクトリに設定することが出来るので好み応じて変更してください。

例えば、テンプレートのディレクトリをデフォルトのtemplateからtplに変更する場合は以下のように記述します。

    var $directory = array(
         'action' => 'app/action',
         'etc' => 'etc',
         'filter' => 'app/filter',
         'locale' => 'locale',
         'log' => 'log',
         'plugins' => array(),
    - 'template' => 'template',
    + 'template' => 'tpl',
         'template_c' => 'tmp',
         'tmp' => 'tmp',
         'view' => 'app/view',
     );

なお、このメンバ変数を相対パスで記述した場合は「アプリケーションベースディレクトリからの相対パス」として扱われます。もちろん絶対パス('/'で始まるパス)で記述することも可能です。

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

