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

