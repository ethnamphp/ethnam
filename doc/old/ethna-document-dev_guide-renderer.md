# Ethna_Rendererの使い方
  - はじめに 
  - Ethna\_Rendererについて 
  - Ethna\_Renderer\_Smartyについて 
  - 他のテンプレートエンジンの実装の仕方 
  - テンプレートエンジンのデフォルト設定 
    - Ethna-2.1.2 まで 

## Ethna\_Rendererの使い方 [](ethna-document-dev_guide-renderer.html#t3298f04 "t3298f04")

### はじめに [](ethna-document-dev_guide-renderer.html#w7e09d2b "w7e09d2b")

- Ethnaでは，レンダラが指定されたテンプレートを読み込み，処理されたデータを埋め込んでページを生成しています．
- ページ生成の処理を行うレンダラは，開発者の好みに合わせて変更することが可能です．
- デフォルトでは，レンダラとしてSmartyが使われています．

### Ethna\_Rendererについて [](ethna-document-dev_guide-renderer.html#p3fb012f "p3fb012f")

- Ethna\_Rendererはバージョン2.3.0から実装されています．
- 事実上開発途上で、smartyを使った例しかありません。今後Ethna\_Renderer\_Flexyなどが用意される予定です。

### Ethna\_Renderer\_Smartyについて [](ethna-document-dev_guide-renderer.html#g3f828f9 "g3f828f9")

Ethna\_Renderer\_SmartyはSmartyをEthna\_Rendererの仕様に合わせてラッピングしたものです． 基本的にはSmartyと同じ機能が使えます．（まだ未実装のものもあります．近々実装の予定です．）

### 他のテンプレートエンジンの実装の仕方 [](ethna-document-dev_guide-renderer.html#ed9b6402 "ed9b6402")

Smarty以外のテンプレートエンジンを使いたい場合，Ethna\_Rendererを継承して，新しいレンダラクラスをつくります． 基本的な流れは，以下のとおりです．

1. Ethna\_Rendererを継承して，独自のレンダラクラスをつくる.
2. ($App)\_Controllerで1で作成したレンダラクラスをインクルードする．
3. ($App)\_Controllerのクラスファクトリ($class)の'renderer'に1で作成したレンダラクラスを指定する．

### テンプレートエンジンのデフォルト設定 [](ethna-document-dev_guide-renderer.html#m13ce6ec "m13ce6ec")

テンプレートエンジンの共通変数などを設定する場合は、アプリケーションのビューの基底クラス Appid\_ViewClass にある \_setDefault() メソッドを実装してください。

    function _setDefault(&$renderer)
    {
        //Rendererからテンプレートエンジンを取得
        $smarty =& $renderer->getEngine();
    
        // セッション情報をセット
        $smarty->assign_by_ref('session_name', session_name());
        $smarty->assign_by_ref('session_id', session_id());
    
        // smartyテンプレートのデリミタを変更
        $smarty->left_delimiter = '<!--{';
        $smarty->right_delimiter = '}-->';
    }

$renderer は Ethna\_Renderer の継承クラスのインスタンスで、デフォルトでは Ethna\_Renderer\_Smarty です。 getEngine() メソッドで smarty のインスタンスを取得することができます。

#### Ethna-2.1.2 まで [](ethna-document-dev_guide-renderer.html#laabf886 "laabf886")

上の設定は Ethna-2.3.0 以降で Renderer が導入された場合の話ですが、 2.1.2 以前の場合は、アプリケーションのコントローラ Appid\_Controller の \_setDefaultTemplateEngine() メソッドで以下のように設定してください。 ($smartyはそのままsmartyオブジェクトです)

    function _setDefaultTemplateEngine(&$smarty)
       {
           $smarty->assign_by_ref('session_name', session_name());
           $smarty->assign_by_ref('session_id', session_id());
       }

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
