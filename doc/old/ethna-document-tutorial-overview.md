# 動作概要
Ethnaは(当初) [Struts](http://struts.apache.org/)の構造を模倣して作られました。そのため、基本的な動作はStrutsに類似しています。また代表的なPHPフレームワークの一つである、Mojaviにも良く似ています。

### (1) 非常に大雑把な動作イメージ [](ethna-document-tutorial-overview.html#f85106f4 "f85106f4")

とても大雑把には、Ethnaの動作イメージは以下の図のようになっています。

 ![ethna-fig1.png](http://ethna.jp/image/ethna-fig1.png "ethna-fig1.png")

1. クライアントはControllerクラスにアクセスします
2. Controllerクラスは、クライアントのリクエストに対応する処理が定義されているAction Class(という名前の)オブジェクトを生成し、実行します  
Action Classオブジェクトは処理(例えば、ログインやデータベースの更新等)を実行し、結果をControllerオブジェクトに返します
3. ControllerオブジェクトはAction Classが返した結果に対応するビューオブジェクトを生成します
4. ビューオブジェクトはHTMLをクライアントに対して表示します

つまり、Ethnaを使ってアプリケーションを作る場合は

1. Controllerがどんなリクエスト(例えば「ログインする」とか「日記を表示する」とか)を受け付けるか(= 「アクション」)を定義して
2. 1.で定義したアクションが実際に何をするか、というコードを書いて
3. その結果どんな画面が表示されるか、を書く

という流れになります。よくあるMVC的フレームワークと同様の動きです。

### (2) 多少大雑把な動作イメージ [](ethna-document-tutorial-overview.html#o8973652 "o8973652")

(1)の図はあまりに抽象的ですので、次にもう少しだけ具体的な動作イメージを以下に記述します。

 ![ethna-fig2.png](http://ethna.jp/image/ethna-fig2.png "ethna-fig2.png")

1. クライアントはアプリケーションのエントリポイントとなるスクリプト(index.php)にアクセスします  
2. index.phpは以下のようなスクリプトで、Controllerを生成、実行します

    <?php
    include_once('/path/to/project/app/sample_controller.php');
    Sample_Controller::main('Sample_Controller', 'index');
    ?>

3. ControllerはAction Formというオブジェクトを生成します。このオブジェクトにはクライアントから送信されたフォーム値等のコンテナです
4. Controllerはクライアントから送信されたフォーム値に基づいて実行するアクションを決定し、対応するAction Classを生成、実行します。なお、デフォルトでは"action\_"で始まるフォーム値がある場合に、それ以降の文字列がアクション名となります。つまり  

    index.php?action_login=true

なら  

    login

というアクションになります
5. Action ClassはAction Formを利用して、クライアントから送信されたフォーム値や、ビューに表示する変数値を設定します
6. Action Classは処理が終了すると、遷移先の名前をコントローラに返します
7. ControllerはAction Classからの戻り値(遷移先)に応じてビューオブジェクトを生成します
8. ビューオブジェクトは、Action Formからテンプレートファイルで利用する変数値を取得します
9. ビューオブジェクトがHTMLを表示します

以上で、何となくはイメージを掴めていただけたと思います。その他の細かい点については、実際にアプリケーションを構築しながら把握するほうが早いと思うので、次節 [アプリケーション構築手順(1)](ethna-document-tutorial-practice1.html "ethna-document-tutorial-practice1 (23d)")をご覧下さい。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
