# Ethna で コマンドラインから利用するスクリプトを書く。
Webアプリケーション を書いていると、コマンドラインから利用するスクリプトを書きたくなるときがあるかもしれません。たとえばバッチ処理や、データベースのテストデータ生成等、Webアプリケーションのメインの処理からは外れた、細々とした処理が考えられます。

たとえば、「データベースのデータを集計して集計用のテーブルに書き込む」という一定時間毎に実行する単純なバッチ処理を考えてみましょう。新たに接続処理やクエリを流す処理を **独自に書きたくない** なぁと思いませんか？ こうした場合は、既にあるフレームワークの枠組みを使い回せると便利な場合があります。

Ethna は、こうした場合もきちんと考慮して設計されています。  
以下では、Ethnaの枠組みを利用しつつ、コマンドラインスクリプトを書く方法を説明します。

- Ethna で コマンドラインから利用するスクリプトを書く。 
  - コマンドライン用のアクションスクリプトを生成する 
  - コマンドラインで実行する処理を書く 
  - コマンドライン用のエントリポイントを作成する 
  - 実行してみる 

| 書いた人 | 日付 | 備考 |
| mumumu | 2007-02-15 | 初版 |
| DQNEO | 2010-05-31 | 一部言い回しを修正 |

### コマンドライン用のアクションスクリプトを生成する [](ethna-document-dev_guide-cli.html#r9d16a6e "r9d16a6e")

まずは、通常のアクションスクリプト生成と似た方法で、コマンドライン用のアクションスクリプトを生成します。  
今回は上で集計バッチを例に出したので、batch\_sum\_daily というアクションを考えてみましょう。いつもの通り、ethna コマンドを使います。

    $ ethna add-action -g cli batch_sum_daily
    file generated [/tmp/sample/skel/skel.action_cli.php -> 
    [/tmp/sample/app/action_cli/Batch/Sum/Daily.php]
    action script(s) successfully created
    [/tmp/sample/app/action_cli/Batch/Sum/Daily.php]

「add-action」に加えて、「-g cli」というオプションを付けると、コマンドライン用のアクションスクリプトが action\_cli ディレクトリ以下に生成されます。

### コマンドラインで実行する処理を書く [](ethna-document-dev_guide-cli.html#c9327a01 "c9327a01")

あとは、上記で生成されたスクリプトのアクションクラスに、処理\*1 を書きましょう。\*2 ここでは、DB接続等、既存の Ethna の 枠組みをそのまま使うことが出来ます。\*3

今回は説明のため、「Hello World!!」と表示させるだけにしてみます。  
コマンドライン引数を読むには、通常のPHPでCLIで用いる場合と同様、グローバル変数 $argc, $argv を利用して下さい。

    /**
     * batch_sum_dailyアクションの実装
     *
     * @author {$author}
     * @access public
     * @package Sample
     */
    class Sample_Cli_Action_BatchSumDaily extends Sample_ActionClass
    {
        /**
         * batch_sum_dailyアクションの前処理
         *
         * @access public
         * @return string 遷移名(正常終了ならnull, 処理終了ならfalse)
         */
        function prepare()
        {
            //
            // あなたの好きな前処理を書いて下さい！
            //
            // 但し、コマンドライン引数をEthnaはパースしないこと
            // に注意して下さい。渡されたコマンドライン引数を
            // ActionFormに入れてくれるわけではありません！！
            //
            // コマンドライン引数を読むには、通常のPHPでCLIを用
            // いる場合と同様、グローバル変数 $argc, $argv を利
            // 用して下さい。
            //
            // @see http://ml.ethna.jp/pipermail/users/2008-January/000872.html
            //
        }
    
        /**
         * batch_sum_dailyアクションの実装
         *
         * @access public
         * @return string 遷移名
         */
        function perform()
        {
            //
            // あなたの好きなメイン処理を書いて下さい！
            // 以下のように、Ethna 内で使ってきたやり方が
            // そのまま使えます！
            //    
            // ただし実際に開発するときはメインの処理は
            // appマネジャーなどに記述し、
            // アクションクラスはそれらを単純に呼び出す
            // のみにするのがオススメです。
            //
            //$db = $this->backend->getDB();
            //$rs = $db->query('SELECT * FROM test');
            //var_dump($rs);
    
            echo "Hello World!!\n";
        }
    }
    ?>

### コマンドライン用のエントリポイントを作成する [](ethna-document-dev_guide-cli.html#l1cc601b "l1cc601b")

アクションクラスを書いたら、あとはそれを呼び出す部分を作るだけです。以下のように、上で生成した batch\_sum\_daily アクションを 呼び出すスクリプトを任意の場所に作ります。

    <?php
    require_once '/tmp/sample/app/Sample_Controller.php';
    
    Sample_Controller::main_CLI('Sample_Controller', 'batch_sum_daily');
    ?>

2行目でrequire\_once している、コントローラークラスのスクリプトへの絶対パスは絶対に間違わないように注意して下さい。\*4  
4行目が、実際のアクションを呼び出す部分です。[APP\_ID]\_Controller クラスの main\_CLI メソッドは、第一引数に コントローラークラスの名前、第二引数に呼び出すアクション名を指定します。

今回はこれを、/tmp/batch\_sum\_daily.php という名前で保存することにします。

### 実行してみる [](ethna-document-dev_guide-cli.html#dc77f28a "dc77f28a")

上で保存したエントリポイントのスクリプトを実行してみましょう。うまくいけば「Hello World!!」と表示されるはずです。

    php -f /tmp/batch_sum_daily.php

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1ただし、アクションクラスにロジックを長々と書くのはおすすめしません。 [http://ethna.jp/ethna-document-tutorial-practice3.html#x9a32944](ethna-document-tutorial-practice3.html#x9a32944)   
\*2アクションフォームクラスも生成されますが、コマンドラインを解釈してEthnaがフォーム定義に突っ込んでくれるわけではないので、役に立ちません  
\*3後で述べるエントリポイントさえ間違わなければ、ですが。  
\*4これが プロジェクト の app ディレクトリと lib ディレクトリに include\_path を通してくれているので、間違うとEthna の機構が全て使えなくなって終了、、です。  

<!-- ??END id:note -->
