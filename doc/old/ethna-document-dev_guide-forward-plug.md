# アクションクラスからの戻り値に応じてコントローラで遷移先を決定する

## アクションクラスからの戻り値に応じてコントローラで遷移先を決定する [](ethna-document-dev_guide-forward-plug.html#p3275748 "p3275748")

Controllerに遷移先定義を追加します。app/{$アプリケーションID}\_Controller.phpを以下のように編集してください。

    /**
     * @var array forward定義
     */
    var $forward = array(
         /*
          * TODO: ここにforward先を記述してください
          *
          * 記述例：
          *
          * 'index' => array(
          * 'view_name' => 'Sample_View_Index',
          * ),
          */
    + 'login' => array(
    + 'view_name' => 'Sample_View_Login',
    + 'forward_path' => 'login.tpl',
    + ),
    );

これで、'login'という遷移先にSample\_View\_Loginというビュークラスと、login.tplというテンプレートファイルが関連付けられます。

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

