[[目次](README.md)]
# Hello画面を作成する(アクション、ビュー、テンプレートを追加する)

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

(ふぁぼるが"Create"なのに違和感があるかもしれませんが、"Favoritesというリソースを追加成する"と考えてください 。)

上記CRUDの各処理を、Ethnamでは「アクション」という言葉で表現します。
「作成アクション」「表示アクション」「更新アクション」「削除アクション」のような感じです。


## Hello画面を追加してみる。

さっそく画面を追加してみましょう。

画面を作るには、まずアクション名を決める必要があります。
ここではアクション名を`hello`としましょう。

そうすると、URLは`/?action_hello=true`となります。

次に、アクションクラスファイル名は、`app/action`に以下のような命名規則で作成します。

* アクション名の先頭を大文字にします
* '_'を'/'に置き換え(= ディレクトリで区切り)続く文字を大文字にします

従ってファイル名は`app/action/Hello.php`となります。


###  アクションクラスファイルの中身を書く

さて、ではクラスファイル`app/action/Hello.php`を作成してみましょう。

クラス名は`Sample_Action_Hello`です。


* Ethna_ActionClassを継承したクラスを定義します
* Ethna_ActionClassのperform()メソッドをオーバーライドして、行いたい処理を記述します
* perform()メソッドの戻り値として遷移名(画面を表す名前)を返します

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

アクションクラスファイルを毎回1から手で書くのは面倒なので、ethnam-generatorコマンドのadd-actionオプションを利用して、ひながたを生成することも出来ます。

```
$ vendor/bin/ethnam-generator add-action hello
```

## ビュークラスファイルの追加(省略可)

画面に何らかのパラメータを渡したい場合は、ビュークラスを作成することで実現できます。

'hello'という遷移名に対応するビュークラスファイルは、アクションクラスと同様にapp/viewに以下のような命名規則で作成し

* '_'をディレクトリで区切り
* ファイル名は大文字で開始し

つまりhello画面に対応するビュークラスファイルは`app/view/Hello.php`となります。

クラス名は`Sample_View_Hello`となります。

`app/view/Hello.php`の中身を以下のように書きます。
ここでは、現在時刻をパラメータとして渡します。(setAppというのが画面にパラメータを渡すメソッドです。)

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

preforward()メソッドはテンプレートのレンダリング前に呼び出され、テンプレートに任意のパラメータを渡すことが可能です。ここでは'now'という名前で現在時刻を渡しています。

ビュースクラスファイルを毎回1から記述するのは面倒なので、ethnam-generatorコマンドのadd-viewオプションを利用して、スケルトンファイルを生成することも出来ます。


```
$ vendor/bin/ethnam-generator add-view hello
```

この時に-tオプションをつける事によって、同時にテンプレートのスケルトンファイルが生成されます。

例:

```
$ vendor/bin/ethnam-generator add-view -t hello
```

また、ビュークラスが不要な場合(単純にテンプレートを表示したい場合等)は、ビュークラスの記述を省略することも可能です。

## テンプレートファイルの作成

次に、テンプレートファイルを作成します。

テンプレートディレクトリは `template/ja_JP` なので、`template/ja_JP/hello.tpl`を作成します。


```html
Hello Ethnam<br />
current time: {$app.now}
```

実際には、毎回テンプレートを1から記述するのは面倒なので、ethnam-generatorコマンドのadd-template オプションを利用して、スケルトンファイルを生成することも出来ます。

```
$ vendor/bin/ethna add-template hello
```

以上でアクション、ビュー、テンプレートの追加は完了ですので、実際にアクセスして動作を確認します。

http://localhost:8000/?action_hello=true

Hello画面が表示されれば成功です。


## (参考)テンプレートにパラメータを渡す

上記のとおり、アクションクラス、あるいはビュークラスで

```php
$this->af->setApp('foo', 'bar');
```

として値を設定すると、テンプレート側で`{$app.foo}`として値を取得することができます。

Smartyの使い方については[Smartyのドキュメント](http://www.smarty.net/docsv2/ja/index.tpl)を見てください。
(なお、Ethnamがサポートしているのは今のところSmarty 2のみです。v3はサポートしていません。)


## (参考)アクションとビューの内部的な動作

Ethnamのコントローラ、アクション、ビューは、以下のように動作します。

* Action Classは、実行中に取得したダイナミックな表示データをAction Formオブジェクトに格納します
* アクションクラスは、コントローラに遷移名を返します
* コントローラは、アクションクラスから返された遷移名に基づいて、ビューオブジェクトを生成します
* ビューオブジェクトは、ダイナミックな表示データをアクションフォームから取得します
* ビューオブジェクトはSmartyオブジェクトを生成し、必要な変数をSmartyオブジェクトに設定します
* テンプレートを出力します


