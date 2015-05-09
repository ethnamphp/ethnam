# ethna-flexy- Ethna - PHPウェブアプリケーションフレームワーク</title>
  
協力会社であるサイトを作ってもらっているのですが、 そこがethnaを使用して作っています。  
サイトのトップページからいきなりethnaで動くのですが、 PHPロジックで作られる以上、サイトの訪問者が増えると あっという間にサーバ負荷が上がってしまうのではないかと 思います。  
動的にする必要がないところは静的ページにすべきと思いますが 現状そうなっていません。  
今回のようにいきなりトップページから全体的に使うのは 使い方としてどうなのでしょう?  
  
それなりにアクセス数が多いサイトになりそうなので心配です。  
  
以上よろしくお願いします。

- それなりに〜をどれくらい想定しているかわかりませんし、ネットワーク構成もわかりませんが、  
うちは全体的にＥｔｈｎａを利用しています。それなりのアクセスもあります。（14request/sec） -- 2007-11-30 (金) 14:17:54
  
<form action="http://ethna.jp/index.php" method="post"> 
<div><input type="hidden" name="encode_hint" value="ぷ"></div>
 <div>
  <input type="hidden" name="plugin" value="comment">
  <input type="hidden" name="refer" value="ethna-flexy">
  <input type="hidden" name="comment_no" value="0">
  <input type="hidden" name="nodate" value="0">
  <input type="hidden" name="above" value="1">
  <input type="hidden" name="digest" value="713abf91904e007fed69f8c39e426b61">
  <label for="_p_comment_name_0">お名前: </label><input type="text" name="name" id="_p_comment_name_0" size="15">

  <input type="text" name="msg" id="_p_comment_comment_0" size="70">
  <input type="submit" name="comment" value="コメントの挿入">
 </div>
</form>
<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
