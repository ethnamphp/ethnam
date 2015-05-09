# フィルタチェインを使用する

## フィルタチェインを使用する [](ethna-document-dev_guide-app-filterchain.html#w57b0072 "w57b0072")

まずフィルタチェインとは何か、からご説明させていただきます。なんだか大層な名前が付いていますが、「フィルタ」がやることは簡単で:

- アクションの処理の前と後に呼び出されて任意の処理(入力や出力変換等)を行う

というものです。そして、この「フィルタ」はN重にネストさせることができるので「フィルタチェイン」と呼ばれているわけです\*1。図にすると以下のような感じです。

[![http://ethna.jp/image/ethna-fig12.jpg](http://ethna.jp/image/ethna-fig12.jpg)](image/ethna-fig12.jpg)

概念も簡単なら実装も簡単で、以下のようになります。

1. コントローラの$filterメンバにフィルタクラス名を追加します
2. フィルタディレクトリ(デフォルトではapp/filter)に"1.で追加したクラス名" + ".php"というファイル名でEthna\_Filterを継承したクラスを記述します
3. prefilterメソッドとpostfilterメソッドを実装します

以上で終了です。

これだけでは分かりにくいので、実際に「アクションの処理時間を計測する」というフィルタを1つ作成してみます\*2。まずはコントローラの$filterメンバにフィルタクラス名を追加します。

Sample\_Controller.php:

    /**
      * @var array フィルタ設定
      */
     var $filter = array(
    + 'Sample_Filter_ExecutionTime',
     );

次に、フィルタディレクトリ(コントローラのメンバ変数$directory['filter']で指定されているディレクトリです)にフィルタクラス名と同じ名前で以下のようにスクリプトを生成します。ここではapp/filter/Sample\_Filter\_ExecutionTime.phpとなります。

Sample\_Filter\_ExecutionTime.php:

    class Sample_Filter_ExecutionTime extends Ethna_Filter
    {
        function prefilter()
        {
        }
    
        function postfilter()
        {
        }
    }

prefilter()メソッドがアクション実行前に、postfilter()メソッドがアクション実行後にコントローラによって呼び出されるので、あとはこの2つのメソッドに任意の処理を実装するだけです。

_なお、フィルタオブジェクトはprefilter()が呼ばれる前に生成され、postfilter()呼出し後に破棄されます。従って、prefilter()で設定したメンバ変数等はpostfilter()からも問題なくアクセスすることが出来ます。_

また、generate\_project\_skelton.phpを使ってプロジェクトスケルトンを生成していると、フィルタディレクトリに予めSample\_Filter\_ExecutionTimeクラスが定義されたファイルが生成されていると思います。こちらを参考に素晴らしいフィルタを実装してください。ここでは以下のようにしてみます。

Sample\_Filter\_ExecutionTime.php:

    class Sample_Filter_ExecutionTime extends Ethna_Filter
    {
        /**#@+
         * @access private
         */
    
        /**
         * @var int 開始時間
         */
        var $stime;
    
        /**#@-*/
    
        /**
         * 実行前フィルタ
         *
         * @access public
         */
        function prefilter()
        {
            $stime = explode(' ', microtime());
            $stime = $stime[1] + $stime[0];
            $this->stime = $stime;
        }
    
        /**
         * 実行後フィルタ
         *
         * @access public
         */
        function postfilter()
        {
            $etime = explode(' ', microtime());
            $etime = $etime[1] + $etime[0];
            $time = round(($etime - $this->stime), 4);
            print "\n<i>page was processed in $time seconds</i>\n";
        }
    }

以上が完了したら、任意のアクションを実行させてみます(というかindex.phpにアクセスしてみます)。以下のようにアクションの処理時間が表示されていると思います。

[![http://ethna.jp/image/ethna-fig13.jpg](http://ethna.jp/image/ethna-fig13.jpg)](image/ethna-fig13.jpg)

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1元はTomcatとかだと思います  
\*2よくあるヤツです  

<!-- ??END id:note -->
