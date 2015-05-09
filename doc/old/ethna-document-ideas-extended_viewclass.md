# 汎用View
### 概要 [](ethna-document-ideas-extended_viewclass.html#m19384a2 "m19384a2")

- Ticket
  - [https://sourceforge.jp/ticket/browse.php?group\_id=1343&tid=15799](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15799)
- Branch URL
  - [http://svn.sourceforge.jp/view/ethna/branches/IDEAS/Idea\_Extended\_ViewClass/?root=ethna](http://svn.sourceforge.jp/view/ethna/branches/IDEAS/Idea_Extended_ViewClass/?root=ethna)

Ethna 2.5.0 preview3 の時点では、Webアプリケーションで良く使われる出力処理をどこに書けばよいのか 全く分からない状態になっている。たとえば以下のような処理である

1. 404や503 など、特定のステータスコードを吐き出す処理
2. JSONを吐き出す処理
3. リダイレクト(302) の処理

こうした処理は汎用のViewクラスとして実装する方が良いと考えられる [http://ethna.jp/ethna-yakiniku-meeting-20090125.html#mb0a884d](ethna-yakiniku-meeting-20090125.html#mb0a884d)

### 実装したいこと [](ethna-document-ideas-extended_viewclass.html#w20c481c "w20c481c")

- 任意のheaderを吐けるようにする
- エラー画面、Flush、リダイレクトなどの処理の汎用的なものを用意する
- 多分レイアウトテンプレートの実装にも影響すると思われる
- HTMLヘッダの出力なども担当したい（Smartyヘルパ？）
- kQoZjVxfe -- oxsotqykfwu [?](cmd=edit&page=oxsotqykfwu&refer=ethna-document-ideas-extended_viewclass.html) 2010-09-29 (水) 06:50:30
  
<form action="http://ethna.jp/index.php" method="post"> 
<div><input type="hidden" name="encode_hint" value="ぷ"></div>
 <div>
  <input type="hidden" name="plugin" value="comment">
  <input type="hidden" name="refer" value="ethna-document-ideas-extended_viewclass">
  <input type="hidden" name="comment_no" value="0">
  <input type="hidden" name="nodate" value="0">
  <input type="hidden" name="above" value="1">
  <input type="hidden" name="digest" value="b8d4fb68fff3a1d5b6df508abe3c3b52">
  <label for="_p_comment_name_0">お名前: </label><input type="text" name="name" id="_p_comment_name_0" size="15">

  <input type="text" name="msg" id="_p_comment_comment_0" size="70">
  <input type="submit" name="comment" value="コメントの挿入">
 </div>
</form>
<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
