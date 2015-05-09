# ドキュメントの再整備
  - 内容の案．ドラフト． 
  - 具体的な章立て 
    - チュートリアル 
  - コメント 

## ドキュメントの再整備 [](ethna-document-ideas-document.html#nc18cde6 "nc18cde6")

Ethna のドキュメントを全面的に改良する． 章立てや内容などを考え中ですので，アイデアをお願いします．

### 内容の案．ドラフト． [](ethna-document-ideas-document.html#g336bbf8 "g336bbf8")

- 「チュートリアル」
  - 章立てがあって１つの小さなアプリケーションを作成する．よくあるフレームワークのドキュメントのような．
- 「マニュアル（仕様）」
  - ActionForm
    - Form 定義
    - validator
    - filter
    - custom
  - ActionClass
    - prepare
    - perform
  - ViewClass
    - preforward
    - forward
    - 汎用 View
  - Template
    - Smarty
  - I18N
  - etc
  - AppObject/AppManager
  - ActionError
  - Plugin
    - Filter
    - CacheManager
  - Ethnaコマンドリファレンス
- 「プラグインの作り方」
  - 作り方．ルールなど．

### 具体的な章立て [](ethna-document-ideas-document.html#nc77a4c0 "nc77a4c0")

#### チュートリアル [](ethna-document-ideas-document.html#p2eb73e2 "p2eb73e2")

テーマはなにがいいんでしょう．やっぱりブログですかね．最近だと，ミニブログとかもありですね．

- インストール
  - PEAR からインストール
- これから作るアプリケーションについて
- アプリケーションの初期化 (add-project)
- 設定 (etc)
- Action/View/Template を作る
- POST してみる

### コメント [](ethna-document-ideas-document.html#ofeae1e5 "ofeae1e5")

このページにコメントのこす．

  
<form action="http://ethna.jp/index.php" method="post"> 
<div><input type="hidden" name="encode_hint" value="ぷ"></div>
 <div>
  <input type="hidden" name="plugin" value="comment">
  <input type="hidden" name="refer" value="ethna-document-ideas-document">
  <input type="hidden" name="comment_no" value="0">
  <input type="hidden" name="nodate" value="0">
  <input type="hidden" name="above" value="1">
  <input type="hidden" name="digest" value="7d68d9e909c1d4e31eca1f9e0de2d494">
  <label for="_p_comment_name_0">お名前: </label><input type="text" name="name" id="_p_comment_name_0" size="15">

  <input type="text" name="msg" id="_p_comment_comment_0" size="70">
  <input type="submit" name="comment" value="コメントの挿入">
 </div>
</form>
<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
