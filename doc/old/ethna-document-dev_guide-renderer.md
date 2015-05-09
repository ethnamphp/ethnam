# Ethna_Rendererの使い方
  - はじめに 
  - Ethna\_Rendererについて 
  - Ethna\_Renderer\_Smartyについて 
  - 他のテンプレートエンジンの実装の仕方 
  - テンプレートエンジンのデフォルト設定 
    - Ethna-2.1.2 まで 

## Ethna\_Rendererの使い方

### はじめに

- Ethnaでは，レンダラが指定されたテンプレートを読み込み，処理されたデータを埋め込んでページを生成しています．
- ページ生成の処理を行うレンダラは，開発者の好みに合わせて変更することが可能です．
- デフォルトでは，レンダラとしてSmartyが使われています．

### Ethna\_Rendererについて

- Ethna\_Rendererはバージョン2.3.0から実装されています．
- 事実上開発途上で、smartyを使った例しかありません。今後Ethna\_Renderer\_Flexyなどが用意される予定です。

### Ethna\_Renderer\_Smartyについて

Ethna\_Renderer\_SmartyはSmartyをEthna\_Rendererの仕様に合わせてラッピングしたものです． 基本的にはSmartyと同じ機能が使えます．（まだ未実装のものもあります．近々実装の予定です．）

### 他のテンプレートエンジンの実装の仕方

Smarty以外のテンプレートエンジンを使いたい場合，Ethna\_Rendererを継承して，新しいレンダラクラスをつくります． 基本的な流れは，以下のとおりです．

1. Ethna\_Rendererを継承して，独自のレンダラクラスをつくる.
2. ($App)\_Controllerで1で作成したレンダラクラスをインクルードする．
3. ($App)\_Controllerのクラスファクトリ($class)の'renderer'に1で作成したレンダラクラスを指定する．

### テンプレートエンジンのデフォルト設定

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

#### Ethna-2.1.2 まで

上の設定は Ethna-2.3.0 以降で Renderer が導入された場合の話ですが、 2.1.2 以前の場合は、アプリケーションのコントローラ Appid\_Controller の \_setDefaultTemplateEngine() メソッドで以下のように設定してください。 ($smartyはそのままsmartyオブジェクトです)

    function _setDefaultTemplateEngine(&$smarty)
       {
           $smarty->assign_by_ref('session_name', session_name());
           $smarty->assign_by_ref('session_id', session_id());
       }

