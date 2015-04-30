# アプリケーションの構築

http://ethna.jp/old/ethna-document-tutorial-practice2.html

実際のアプリケーション構築は、「アクション、(ビュー、)  テンプレート」を追加していく作業の繰り返しとなります。

## CRUD = アクション

"CRUD"というのを聞いたことがあるでしょうか？

Create, Read, Update, Delete の略です。
ウェブアプリケーションの仕事のほとんどは、この"CRUD"処理を行うことです。

ツイッターで例えると、

* つぶやく,ふぁぼる(Create)
* タイムラインを表示する、ツイートを表示する(Reade)
* 自己紹介プロフィールを変更する(Update)
* ツイートを削除する(Delete)

となります。

(ふぁぼるが"Create"なのに違和感があるかもしれませんが、「"Favorites"というリソースを新規作成する」と考えてください 。)

上記CRUDの各処理を、Ethnamでは「アクション」という言葉で表現します。
「作成アクション」「表示アクション」「更新アクション」「削除アクション」のような感じです。


## 例：「Hello画面の表示」というアクションを追加してみる

さっそく画面を追加してみましょう。

画面を作るには、まずアクション名を決める必要があります。
ここではアクション名を`hello`としましょう。

そうすると、URLは`/?action_hello=true`となります。

次に、アクションクラスファイル名は、`app/action`に以下のような命名規則で作成します('_'をディレクトリで区切り、ファイル名は大文字で開始します)。

* アクション名の先頭を大文字にします
* '_'を'/'に置き換え(= ディレクトリで区切り)続く文字を大文字にします

ですので`app/action/Hello.php`となります。

すると、

* URLは`/?action_hello=true`
* アクションクラスファイルは
* アクションクラス名は`Sample_Action_Hello`

###  アクションクラスファイルの中身を書く

さて、ではクラスファイル`app/action/Hello.php`を作成してみましょう。

クラス名は`Sample_Action_Hello`です。


* Ethna_ActionClassを継承したクラスを定義します
* Ethna_ActionClassのperform()メソッドをオーバーライドして、サーバ側で行いたい処理を記述します
* perform()メソッドの戻り値として画面名(後述)を返します

```php
<?php
class Sample_Action_Hello extends Ethna_ActionClass
{
    public function perform()
    {
        return 'hello';
    }
}
```

このクラスでは、サーバ側では何も処理を行わずに'hello'という遷移名を返しています。つまり

「なにもしないで'hello'という画面名を表示する」

という処理になります。

実際には、毎回アクションクラスファイルを1から記述するのは煩雑なので、ethnaコマンドのadd-actionオプションを利用して、スケルトンファイルを生成することも出来ます。

例:

$ vendor/bin/ethna add-action hello

```text
see also: アクションスクリプトのスケルトンを生成する

なお、アクションスクリプトを配置するディレクトリは適宜変更することが可能です。

see also: アクションスクリプトの配置ディレクトリを変更する

また、前述したアクションクラスやアクションスクリプトのファイル命名規則等も変更することが可能です。

see also: アクション定義省略時の命名規則を変更する
```

## ビュークラスファイルの追加(省略可)

Ethnaのビューは、以下のように動作します。

* Action Classは、実行中に取得したダイナミックな表示データをAction Formオブジェクトに格納します(Action Formオブジェクトはコンテナとして振舞います)
* アクションクラスは、コントローラに遷移先を返します
* コントローラは、アクションクラスから返された遷移先に基づいて、ビューオブジェクトを生成します
* ビューオブジェクトは、ダイナミックな表示データをアクションフォームから取得します
* ビューオブジェクトはSmartyオブジェクトを生成し、必要な変数をSmartyオブジェクトに設定します
* テンプレートを出力します

次に、アクションクラスが返す遷移先(この場合'hello'という遷移先)を定義します。

'hello'という遷移名に対応するビュークラス`Sample_View_Hello`を作成します。
ビュークラスファイルは、アクションクラスと同様にapp/viewに以下のような命名規則で作成します

* '_'をディレクトリで区切り
* ファイル名は大文字で開始し

hello => app/view/Hello.php

app/view/Hello.phpというファイルを以下のように作成します。

```php
<?php
class Sample_View_Hello extends Ethna_ViewClass
{
    public function preforward()
    {
        $this->af->setApp('now', strftime('%Y/%m/%d'));
    }
}
```

preforward()メソッドはテンプレート表示前に呼び出され、テンプレートに関連した各種データ(セレクトボックスの表示項目等)を設定することが可能です。ここでは、コンテナに'now'という名前で現在時刻を格納しています。

実際には、毎回ビュースクリプトを1から記述するのは煩雑なので、ethnaコマンドのadd-viewオプションを利用して、スケルトンファイルを生成することも出来ます。

例:

```
$ vendor/bin/ethna add-view hello
```

この時に-tオプションをつける事によって、同時にテンプレートのスケルトンファイルが生成されます。

例:

```
$ vendor/bin/ethna add-view -t hello
```

また、ビュークラスが不要な場合(単純にテンプレートを表示したい場合等)は、ビュークラスの記述を省略することも可能です。

## テンプレートファイルの作成

次に、テンプレートファイルを作成します。

テンプレートディレクトリは`template/ja_JP`ディレクトリなので、`template/ja_JP/hello.tpl`を作成します。


```html
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf8">
  <title>Please Hello</title>
</head>
<body>
Hello Ethnam<br />
current time: {$app.now}
</body>
</html>
```

実際には、毎回アクションスクリプトを1から記述するのは煩雑なので、ethnaコマンドのadd-template オプションを利用して、スケルトンファイルを生成することも出来ます。

```
$ vendor/bin/ethna add-template hello
```

上記のとおり、テンプレートに{$app.foo}と記述すると、アクションクラス、あるいはビュークラスで

$this->af->setApp('foo', 'bar');
として設定した値にアクセスすることが出来ます。

以上でアクション、ビュー、テンプレートの追加は完了ですので、実際にアクセスして動作を確認します。

http://example.com/?action_hello=true

Hello画面が表示されれば成功です。


もう少し複雑なアクションについては、次節アプリケーション構築手順(3)をご覧下さい。
