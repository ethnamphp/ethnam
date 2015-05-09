# 遷移時のデフォルトマクロを指定する。

- 更新履歴
  - rendererに対応させた内容に変更 (2006/11/20, いちい)

## 遷移時のデフォルトマクロを指定する。 [](ethna-document-dev_guide-forward-defaultmacro.html#web1c344 "web1c344")

アプリケーションにあるビューの基底クラス(app/{APPID}\_ViewClass.php)の\_setDefaultメソッドを利用することで、 Smartyにあらかじめ値をassignするなどの共通処理をすることができます。

なお、コントローラの \_setDefaultTemplateEngine() を利用した方法は現在は推奨されません。

以下は、etc/{APPID}-ini.phpに設定した、base\_urlとsite\_nameをアサインする処理です。

    function _setDefault(&$renderer)
       {
           $smarty =& $renderer->getEngine();
    
           $smarty->assign('BASE_URL', $this->config->get('base_url') );
           $smarty->assign('site_name', $this->config->get('site_name') );
    
       }

これを記述することで、すべてのアクションやビューでsite\_nameやbase\_urlを assignするというような手間をはぶくことができます。

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

