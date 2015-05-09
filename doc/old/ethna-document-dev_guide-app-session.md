# Sessionを利用する
- ActionClassからセッションを呼び出す 
- 簡単な認証の仕組みを作ってみる。 
  - actionを作る 
  - Configファイルにパスワードを書き込む 
  - authenticateメソッドの追加 
  - loginアクションの作成 
- 複雑な認証の仕組みを実現する。 
- 毎回authenticateメソッドにお約束を書くのが面倒 

## Sessionを利用する

会員制サイトや管理画面を作成する場合、認証の仕組みが必要になります。 Ethna\_Sessionを利用することでSessionを利用した認証を簡単に作ることができます。

## ActionClassからセッションを呼び出す

ActionClassはメンバ変数にセッションオブジェクトを保持しているので簡単に参照できます。 例えば、セッションの値を取得する場合

    function perform()
    {
        var_dump($this->session->get('hoge'));
    }

とすることでセッションhogeを取得できます。

## 簡単な認証の仕組みを作ってみる。

よくある掲示板スクリプトの管理画面を作ってみます。 Formにパスワードを入力するとConfigファイルに書き込まれた値と てらしあわあせて、同じであればSessionを開始。 管理画面ではSessionがstartしているかを確認する。というものです。

### actionを作る

認証する画面(login)と認証先の画面(index)を作ります。

    ethna add-action login
    ethna add-action index

### Configファイルにパスワードを書き込む

/etc/[app-id]-ini.phpの配列に以下の値を追加

    'password' => 'hogehoge',

### authenticateメソッドの追加

indexのActionClassにauthenticateメソッドを追加します

    function authenticate()
    {
       if ( !$this->session->isStart() ) {
           return 'login';
       }
    }

これで、indexにアクセスしてもセッションが始まってない場合、ログイン画面に飛ぶようになります。

### loginアクションの作成

普通にフォームを作ってperformで確認。OKならセッションスタート。

    function perform()
    {
        $password = $this->config->get('password');
    
        if ( $password == $this->af->get('password')) {
             $this->session->start();
        }
    }

でできた気がする。（要修正。アクションとかも全部ちゃんと書く）

## 複雑な認証の仕組みを実現する。

roleの概念を付加した認証の仕組みも簡単に作れます。 ユーザ名と、パスワードでログインして、各ユーザのグループ権限ごとに 行う処理を変えるとか。認証情報を管理するクラスを作っておいて、 それをauthenticateの中で呼び出してやるだけです。

## 毎回authenticateメソッドにお約束を書くのが面倒

上記の方法だと認証が必要になるページはすべてauthenticateメソッドを書くハメになります。 それは面倒なのでauthenticateメソッドを書いたActionクラスを継承してしまいましょう。

