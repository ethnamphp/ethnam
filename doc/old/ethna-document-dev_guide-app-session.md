<title>
Sessionを利用する - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# Sessionを利用する 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [ethna-document-dev\_guide-app](ethna-document-dev_guide-app.html) > Sessionを利用する 

- Sessionを利用する 
- ActionClassからセッションを呼び出す 
- 簡単な認証の仕組みを作ってみる。 
  - actionを作る 
  - Configファイルにパスワードを書き込む 
  - authenticateメソッドの追加 
  - loginアクションの作成 
- 複雑な認証の仕組みを実現する。 
- 毎回authenticateメソッドにお約束を書くのが面倒 

## Sessionを利用する [](ethna-document-dev_guide-app-session.html#w089f756 "w089f756")

会員制サイトや管理画面を作成する場合、認証の仕組みが必要になります。 Ethna\_Sessionを利用することでSessionを利用した認証を簡単に作ることができます。

## ActionClassからセッションを呼び出す [](ethna-document-dev_guide-app-session.html#kc7bf552 "kc7bf552")

ActionClassはメンバ変数にセッションオブジェクトを保持しているので簡単に参照できます。 例えば、セッションの値を取得する場合

    function perform()
    {
        var_dump($this->session->get('hoge'));
    }

とすることでセッションhogeを取得できます。

## 簡単な認証の仕組みを作ってみる。 [](ethna-document-dev_guide-app-session.html#acd15fd2 "acd15fd2")

よくある掲示板スクリプトの管理画面を作ってみます。 Formにパスワードを入力するとConfigファイルに書き込まれた値と てらしあわあせて、同じであればSessionを開始。 管理画面ではSessionがstartしているかを確認する。というものです。

### actionを作る [](ethna-document-dev_guide-app-session.html#xebd0da9 "xebd0da9")

認証する画面(login)と認証先の画面(index)を作ります。

    ethna add-action login
    ethna add-action index

### Configファイルにパスワードを書き込む [](ethna-document-dev_guide-app-session.html#n89b6fe7 "n89b6fe7")

/etc/[app-id]-ini.phpの配列に以下の値を追加

    'password' => 'hogehoge',

### authenticateメソッドの追加 [](ethna-document-dev_guide-app-session.html#sb4b0815 "sb4b0815")

indexのActionClassにauthenticateメソッドを追加します

    function authenticate()
    {
       if ( !$this->session->isStart() ) {
           return 'login';
       }
    }

これで、indexにアクセスしてもセッションが始まってない場合、ログイン画面に飛ぶようになります。

### loginアクションの作成 [](ethna-document-dev_guide-app-session.html#f18df5f4 "f18df5f4")

普通にフォームを作ってperformで確認。OKならセッションスタート。

    function perform()
    {
        $password = $this->config->get('password');
    
        if ( $password == $this->af->get('password')) {
             $this->session->start();
        }
    }

でできた気がする。（要修正。アクションとかも全部ちゃんと書く）

## 複雑な認証の仕組みを実現する。 [](ethna-document-dev_guide-app-session.html#j380a7f0 "j380a7f0")

roleの概念を付加した認証の仕組みも簡単に作れます。 ユーザ名と、パスワードでログインして、各ユーザのグループ権限ごとに 行う処理を変えるとか。認証情報を管理するクラスを作っておいて、 それをauthenticateの中で呼び出してやるだけです。

## 毎回authenticateメソッドにお約束を書くのが面倒 [](ethna-document-dev_guide-app-session.html#a5286a52 "a5286a52")

上記の方法だと認証が必要になるページはすべてauthenticateメソッドを書くハメになります。 それは面倒なのでauthenticateメソッドを書いたActionクラスを継承してしまいましょう。

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
