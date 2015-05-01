# 実用的なアプリケーション開発(ログイン機能)

もうちょっと実用的な例として、ログイン機能を作ってみましょう。

http://ethna.jp/old/ethna-document-tutorial-practice3.html


## Ethnamでアプリケーションを開発するとは

* アクションクラスファイルを作って
* アクションフォームを定義して
* アクションクラスからビジネスロジックを呼び出して
* 出力(画面表示や画面遷移)を行う

ことになります。

アクションクラスは、`app/action/` 以下に作ります。
ビジネスロジックは、マネジャークラス`app/manager`やモデルクラス`app/model/` として実装します。
出力は、ビュークラスとSmartyによって行うか、または`symfony/http-foundations`の`Response`クラスを使って行います。


## ログイン機能を作ってみる

次に、もう少し実際的な内容ということで、ログイン処理を例にとって

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


## ログインアクションの追加
フォームがsubmitされた際に実行されるアクション「login_do」を前節(5)の場合と同様に追加します。

```
$ vendor/bin/ethna add-action login_do
```

生成されたファイルの中を見ると、'login_do'という遷移名を返すだけのアクションになっています。
今回のケースでは'login_do'というビューは不要なので、以下のように変更しておきます。

app/action/Login/Do.php:

```diff
public function perform()
{
-     return 'login_do';
+     return 'index';
}
```

以上の状態でログインボタンを押すと、

* コントローラがlogin_doアクション呼び出す
* Sample_Action_LoginDo::perform()メソッドが実行される
* 遷移名としてindexが返される

という処理の流れで、ホーム画面が表示されると思います。

実際には画面遷移する前に、(あたりまえですが)フォーム値のチェックや認証処理を行い、エラーが発生した場合はエラーメッセージを表示させる必要があります。

## フォーム値の取得

認証を行うためには、フォームから送信された値を取得する必要があります。そのためには、アクションクラスと1対1で生成されるアクションフォームというオブジェクトを利用します。アクションフォームのクラス定義は、`ethna add-action`を実行すると、アクションクラスと同時に生成されていますので、まずは何も考えず、`app/action/Login/Do.php`に以下のようなコードを追加してみてください。

app/action/Login/Do.php

```diff
    public $form = array(
+       'mailaddress' => array(
+           'type'          => VAR_TYPE_STRING,
+       ),
...
    public function perform()
    {
+       echo $this->af->get('mailaddress');
```

以上の状態で、フォームの「メールアドレス」に適当な文字を入力してsubmitすると、その値が表示されるかと思います。

これで何となくお分かりかと思いますが、フォーム値にアクセスするには(非常に大雑把に言うと)

* アクションフォームでフォーム定義を記述する
* アクションクラスにメンバ変数として設定されている$afオブジェクト(ActionFormの略です)のアクセサ(get()/set())を通じて値を取得/設定する

という手順になります。

## バリデーション(フォーム値の検証)


たかがフォーム値にアクセスするのに何故こんな面倒な手順が必要なのか、にはいくつか理由がありますが(ほとんどはセキュリティ上の理由)、この方法の最大のメリットはフォーム値の自動検証です。

アクションスクリプトのスケルトンを生成すると、アクションフォームに以下のようなコメントも生成されているかと思います。

```php
         /*
         'sample' => array(
             'name'          => 'サンプル',      // 表示名
             'required'      => true,            // 必須オプション(true/false)
             'min'           => null,            // 最小値
             'max'           => null,            // 最大値
             'regexp'        => null,            // 文字種指定(正規表現)
             'custom'        => null,            // メソッドによるチェック
             'filter'        => null,            // 入力値変換フィルタオプション
             'form_type'     => FORM_TYPE_TEXT   // フォーム型
             'type'          => VAR_TYPE_INT,    // 入力値型
         ),
         */
```

上記のように、各フォーム値には'name'〜'type'まで計9つの属性を設定することが出来ます(必須なのは'type'のみです)。Ethnaでは、ここで設定されら属性を利用したフォーム値の自動検証機能を提供しています。

ここで先ほどのフォーム値'mailaddress'を利用して実際に試してみます。まず、先ほどの'mailaddress'の属性を下記のように変更します。

```diff
       'mailaddress' => array(
+          'name'          => 'メールアドレス',
+          'required'      => true,
           'type'          => VAR_TYPE_STRING,
       ),
+      'password' => array(
+          'name'          => 'パスワード',
+          'required'      => true,
+          'type'          => VAR_TYPE_STRING,
+      ),
```

これは、フォーム値'mailaddress'の表示名が「メールアドレス」であり、また入力が必須であることを示しています。ついでにpasswordも必須としてしまいます。


次に、アクションクラスで自動入力処理を行います。具体的には、アクションクラスのprepare()メソッドに以下のような処理を追加します。

```diff
   public function prepare()
   {
+      if ($this->af->validate() > 0) {
+          return 'login';
+      }
```

アクションフォームのvalidate()メソッドは、定義に従ってフォーム値を自動検証し、検出したエラーの数を戻り値として返します(発生したエラーの扱い等については後述します)。

この状態で、メールアドレスを空欄にしてsubmitすると以前と異なりトップページは表示されず、再度ログインページが表示されるのが分かるかと思います。

以上が、フォーム値の検証に関する基本的な説明でした。

なお、アクションクラスのprepare()メソッドとperform()メソッドの関係を知りたい場合は、Ethna_Controller::perform()のコードを見るのが手っ取り早いです。
まずアクションクラスのprepare()メソッドが呼ばれ、prepare()メソッドがnullを返した場合のみperform()メソッドが呼び出されます。

ようするに、prepare()メソッドでフォーム値の検証を行うこと、perform()メソッドでは全てのデータはサニタイズされているという前提で処理を行うことが出来る、安全且つ簡潔なコードが書けるというわけです(やっぱりStrutsの真似)。

なお、フォーム値のバリデーションについては別記事をご覧下さい。

see also: [フォーム値のバリデーションを行う]

## エラー処理(フォーム値の表示)

(自動にせよ手動にせよ)フォーム値の検証を行ってエラーが発生したら、それに伴って幾つかの処理を行う必要があります。

まずは最低限の処理その1ということで、入力されたフォーム値をvalue属性に設定してみます。

フォーム値はEthnaフレームワークによって自動的にSmarty変数として割り当てられるので、実際にはテンプレートで

`{$form.フォーム項目名}`

と記述すればOKです。ですのでここではlogin.tplを以下のように変更します。

template/ja_JP/login.tpl:

```diff
    <tr>
     <td>メールアドレス</td>
 -   <td><input type="text" name="mailaddress" value=""></td>
 +   <td><input type="text" name="mailaddress" value="{$form.mailaddress}"></td>
    </tr>
```

この状態で、メールアドレスのみを入力してsubmitすると、(パスワードが入力されていないのでエラーにはなりますが)メールアドレスのフォーム値が失われずに表示されていると思います。

なお、{$form.*}で表示される値は常にエスケープされていますので、サニタイズ等は考慮する必要はありません。*2

## エラー処理(エラーメッセージの表示)

次に最低限の処理その2である、エラーメッセージの表示を行います。発生したエラーは、やはりEthnaフレームワークによって自動的にテンプレート変数として割り当てられ、

全てのエラーメッセージ一覧
指定されたフォーム名に対応するエラーメッセージ
という形でアクセスすることが可能です。

まず全てのエラーメッセージを表示させてみます。エラーメッセージは配列として{$errors}というSmarty変数に割り当てられていますので:

template/ja_JP/login.tpl:

```diff
 <body>
+ {if count($errors)}
+  <ul>
+  {foreach from=$errors item=error}
+   <li>{$error}</li>
+  {/foreach}
+ </ul>
+{/if}
```

というように書くと、全てのエラーメッセージを表示させることが出来ます。

また、特定のフォーム名に対応するエラーメッセージを表示させるには、Ethnaフレームワークの提供するSmarty関数"message"を利用します。

template/ja_JP/login.tpl:

```html
    <tr>
     <td>メールアドレス</td>
     <td><input type="text" name="mailaddress" value="{$form.mailaddress}">{message name="mailaddress"}</td>
    </tr>
    <tr>
     <td>パスワード</td>
     <td><input type="password" name="password" value="">{message name="password"}</td>
     </tr>
```

Ethnaフレームワークにおけるエラー処理ポリシーについては以下をご覧下さい。

see also: エラー処理ポリシー

また、自動検証で設定されるエラーメッセージは(もちろん)任意にカスタマイズすることが出来ます。

see also: [自動検証のエラーメッセージをカスタマイズする]

## ビジネスロジックの記述

フォーム値の検証が完了したら、いよいよロジック部分(実際のアプリケーションとしての動作)を記述します。

注意点としては、アクションクラス(perform()メソッド)にはアプリケーションの核となる処理をベタベタと記述してはいけません。

基本的にはほぼ全ての処理はアプリケーションの核となるクラス(app/manager/, app/model/以下に置かれるクラス)に記述し、アクションクラスはそれらを単純に呼び出すのみ、というイメージです。例えば

```php
public function perform()
{
    // メールアドレスをキーにしてユーザオブジェクトを生成
    $user = new User($this->backend, $this->af->get('mailaddress'));
    // 認証処理
    $result = $user->auth($this->af->get('password');
    // 以降結果によってビューを変更、等...
}
```

というようになります。

このような設計にする主な目的は

* 各アクション/ビュークラス間でのコードの重複を防ぐ
* モデルクラスの再利用性を高める
* 単体テストを書きやすくする

です。
