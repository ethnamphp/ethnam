# Ethnamの動作概要

http://ethna.jp/old/ethna-document-tutorial-overview.html

Ethnaは当初JavaのStrutsの構造を模倣して作られました。そのため、基本的な動作はStrutsに似ています。(また,2004年ごろに流行ったPHPフレームワークの一つであるMojaviにも似ています。)


## 大雑把な動作イメージ

* クライアントからのリクエストがエントリポイントにきます。
* エントリポイントは、Controllerクラスを呼び出します。
* Controllerクラスが、クライアントのリクエストに対応するAction Classのオブジェクトを生成し、実行します
* Action Classオブジェクトは処理(例えば、ログインやデータベースの更新等)を実行し、結果をControllerオブジェクトに返します
* ControllerオブジェクトはAction Classが返した結果に対応するビューオブジェクトを生成します
* ビューオブジェクトはHTMLをクライアントに対して表示します

つまり、Ethnaを使ってアプリケーションを作る場合は

Controllerがどんなリクエスト(例えば「ログインする」とか「日記を表示する」とか)を受け付けるか(= 「アクション」)を定義して
1.で定義したアクションが実際に何をするか、というコードを書いて
その結果どんな画面が表示されるか、を書く


## もう少し詳しい内部動作

クライアントはアプリケーションのエントリポイントとなるスクリプト(index.php)にアクセスします
index.phpは以下のようなスクリプトで、Controllerを生成、実行します

```php
<?php
include_once('/path/to/project/app/sample_controller.php');
Sample_Controller::main('Sample_Controller', 'index');
?>
```

ControllerはAction Formというオブジェクトを生成します。このオブジェクトにはクライアントから送信されたフォーム値等のコンテナです
Controllerはクライアントから送信されたフォーム値に基づいて実行するアクションを決定し、対応するAction Classを生成、実行します。なお、デフォルトでは"action_"で始まるフォーム値がある場合に、それ以降の文字列がアクション名となります。つまり
index.php?action_login=true
なら
login
というアクションになります
Action ClassはAction Formを利用して、クライアントから送信されたフォーム値や、ビューに表示する変数値を設定します
Action Classは処理が終了すると、遷移先の名前をコントローラに返します
ControllerはAction Classからの戻り値(遷移先)に応じてビューオブジェクトを生成します
ビューオブジェクトは、Action Formからテンプレートファイルで利用する変数値を取得します
ビューオブジェクトがHTMLを表示します
以上で、何となくはイメージを掴めていただけたと思います。



