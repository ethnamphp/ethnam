[[目次](README.md)]
# Ethnamの内部動作の概要

Ethnaは当初JavaのStrutsの構造を模倣して作られました。そのため、基本的な動作はStrutsに似ています。
(また,2004年ごろに流行ったPHPフレームワークの一つであるMojaviにも似ています。)


## 大雑把な動作イメージ

* クライアントからのリクエストをエントリポイントが受け取ります。
* エントリポイントはControllerクラスを呼び出します。
* Controllerは、リクエストに対応するActionClassを探索し、インスタンスを生成し、実行(perform)します
* ActionClassは処理(例えば、ログイン,データベースとのやりとり等)を実行し、結果をControllerに返します
* ControllerはActionClassの戻り値から、ビューオブジェクトを決定し生成します
* ビューオブジェクトはHTML生成してクライアントに対して出力します。

つまり、Ethnaを使ってアプリケーションを作る場合は

* Controllerがどんなリクエスト(例えば「ログインする」とか「日記を表示する」とか)を受け付けるか(= 「アクション」)を定義して
* 定義したアクションが実際に何をするか、というコードを書いて
* その結果どんな画面が表示されるかを書く

という流れになります。


## もう少し詳しい内部動作

クライアントはアプリケーションのエントリポイントとなるスクリプト(www/index.php など)にアクセスします
index.phpは以下のようなスクリプトで、Controllerを呼び出します。

```php
<?php
require_once dirname(__FILE__) . '/../app/Sample_Controller.php';
Sample_Controller::main('Sample_Controller', 'index');
```

ControllerはAction Formというオブジェクトを生成します。このオブジェクトにはクライアントから送信されたフォーム値等のコンテナです。

Controllerはクライアントから送信されたパラメータに基づいて実行するアクションを決定し、対応するActioClassを生成、実行します。
なお、デフォルトでは"action_*=true"というパラメータが含まれる場合、その*の部分の文字列がアクション名となります。

つまり`index.php?action_login=true` なら `login` というアクションになります

Action ClassはAction Formを利用して、クライアントから送信されたフォーム値や、ビューに表示する変数値を設定します

Action Classは処理が終了すると、遷移先の名前をコントローラに返します

ControllerはAction Classからの戻り値(遷移先)に応じてビューオブジェクトを生成します

ビューオブジェクトは、Action Formからテンプレートファイルで利用する変数値を取得します

ビューオブジェクトがHTMLを表示します

以上で、何となくはイメージを掴めていただけたと思います。

詳しくはEthna_Controllerのコードを読んで見るとよいでしょう。
triger_WWWメソッドがEthnamの核となる部分ですので、そこを中心に読んでみるとよいと思います。



