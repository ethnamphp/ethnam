[[目次](README.md)]
# 実用的なアプリケーション開発 1 (ログイン画面)

(旧: http://ethna.jp/old/ethna-document-tutorial-practice3.html )
## ログイン機能を作ってみる

もうちょっと実用的な例として、ログイン機能を例にとって

* フォーム値の取得方法
* 基本的なエラー処理方法
* ビューへのデータ設定方法

といった点をご説明したいと思います。

## ログイン画面の作成

前回の記事のやり方でログイン画面を作ります。

```
vendor/bin/ethna add-action login
vendor/bin/ethna add-view -t login
```

## ログイン画面の変更

作成したテンプレートファイル(`template/ja_JP/login.tpl`)をもうちょっとログイン画面っぽいものに作り変えましょう。

具体的には以下のようにしてみます。

template/ja_JP/login.tpl

```html
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ログイン画面</title>
  </head>
  <body>
    <form action="." method="post">
      <table border="0">
        <tr>
          <td>メールアドレス</td>
          <td><input type="text" name="mailaddress" value=""></td>
        </tr>
        <tr>
          <td>パスワード</td>
          <td><input type="password" name="password" value=""></td>
        </tr>
      </table>
      <p>
      <input type="submit" name="action_login_do" value="ログイン">
      </p>
    </form>
  </body>
</html>
```


通常のHTMLファイル(=Smartyのテンプレートファイル)ですが、1点Ethnam独自の点があります。

submitボタンの"name=action_login_do"は、このフォームをsubmitした際に、「login_do」というアクションを実行することを意味します。
「login_do」というはStrutsの慣習をそのまま使っているだけなので、「login」と重ならなければ「login_exec」でも「login_submit」でも何でも構いません。


以上で準備は完了です。

http://localhost/?action_login=true

にアクセスしてログイン画面が表示されることを確認してください。


