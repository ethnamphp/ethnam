[[目次](README.md)]
# 実用的なアプリケーション開発 5 ビジネスロジック(実装)

前ページで考えた設計を元に、ロジック部分を実装していきます。
ロジック部分を記述したクラスを別に作成し、それをアクションクラスから呼び出します)。

まず、マネジャークラスを作成します。ここでは簡単に以下のようなスクリプトを作成してみます。

app/Sample_UserManager.php:

```php
<?php
class Sample_UserManager
{
    public function auth($mailaddress, $password)
    {
        // このロジックはダミーです。
        // 実際にはまともに認証処理を行う
        if ($mailaddress != $password) {
            return Ethna::raiseNotice('メールアドレスまたはパスワードが正しくありません', E_SAMPLE_AUTH);
        }

        //成功時にはnullを返す
        return null;
    }
}
```

ついでにエラーコードを追加します。

app/Sample_Error.php:

```diff
+ /** エラーコード: ユーザ認証エラー */
+ define('E_SAMPLE_AUTH', -128);
```

先ほど作成したSample_UserManager.phpをControllerでインクルードします。

app/Sample_Controller.php:

```diff
  include_once 'Sample_Error.php';
+ include_once 'Sample_UserManager.php';
```

最後に、アクションクラスのperform()メソッドを記述します。ここでは、ユーザマネージャで認証処理を行うだけです。

app/actoin/Login/Do.php

```php
    public function perform()
    {
        $um =  new Sample_UserManager();
        $result = $um->auth($this->af->get('mailaddress'), $this->af->get('password'));
        if (Ethna::isError($result)) {
            $this->ae->addObject(null, $result);
            return 'login';
        }

        return 'index';
    }
```

ここではauth()メソッドからエラーオブジェクトが返ってきた場合は再度ログイン画面を表示させ、認証が成功した場合はトップページを表示しています。

エラー処理詳細につきましては下記をご覧下さい。

ses also: エラー処理ポリシー

以上が基本的なアプリケーションの構築手順となります。なんとなくご理解いただけたでしょうか。

なお、実際のアプリケーション開発ではその他いろいろ、例えば下記のようなパターンも必要となってくるかと思います。
開発中に「あれ？これってどうやるんだろう？」あるいは「この処理、かったるくてやってらんない」と思った場合は、issuesで質問するか、Twitterでご相談ください。

* セレクトボックスを作成する
* チェックボックスを作成する
* セッションを利用する
* ログを出力する
* DBを利用する
* アラートメールを送信する
