# フィルタチェインを使用する
 <link rel="stylesheet" href="skin/ethna/ethna.css" title="ethna" type="text/css" charset="utf-8">

 <link rel="alternate" type="application/rss+xml" title="RSS" href="cmd=rss.html">

 <script type="text/javascript" src="skin/trackback.js"></script>

</head>
ここは以前の ethna.jp サイトを表示したものです。ここにあるドキュメントはバージョン2.6以降更新されません。  
最新のドキュメントは [現在のethna.jp](http://ethna.jp/) を閲覧してください。現ドキュメントが整備されるまでは、ここを閲覧してください。

<!-- ??BEGIN id:wrapper --><!-- ?? Navigator ?? ======================================================= -->

[![Ethna](image/navlogo.gif)](/)

[トップ](ethna.html "ethna (11d)") [二ュース](ethna-news.html "ethna-news (11d)") [概要](ethna-about.html "ethna-about (11d)") [ダウンロード](ethna-download.html "ethna-download (25d)") [ドキュメント](ethna-document.html "ethna-document (884d)") [コミュニティ](ethna-community.html "ethna-community (619d)") [FAQ](ethna-document-faq.html "ethna-document-faq (1240d)")

<!-- ?? Header ?? ========================================================== -->

# フィルタチェインを使用する 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [ethna-document-dev\_guide-app](ethna-document-dev_guide-app.html) > フィルタチェインを使用する 

- フィルタチェインを使用する 

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
<!-- ??BEGIN id:trackback -->
<!-- ?? END id:trackback --><!-- ?? END id:attach -->
<!-- ?? END id:summary -->
<!-- ??END id:content -->
<!-- ?? END id:wrap_content --><!-- ??sidebar?? ========================================================== -->
<!-- ??BEGIN id:wrap_sidebar -->

<!-- ??BEGIN id:search_form -->

## 検索

<form action="http://ethna.jp/index.php?cmd=search" method="post">
            <input type="hidden" name="encode_hint" value="??">
            <input type="text" name="word" value="" size="20">
            <input type="submit" value="検索"><br>
            <input type="radio" name="type" value="AND" checked id="and_search"><label for="and_search">AND検索</label>
            <input type="radio" name="type" value="OR" id="or_search"><label for="or_search">OR検索</label>
    </form>

<!-- END id:search_form -->
<!-- ??BEGIN id:download_link -->

## ダウンロード

[![](image/minilogo.gif)Ethna-2.6.0(beta2)](ethna-download.html)

[![](image/minilogo.gif)Ethna-2.5.0(stable)](ethna-download.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:download_link -->

## Quick Links

- [フォーラム(質問/要望等)](ethna-community-forum.html)
- [メーリングリスト](http://ml.ethna.jp/mailman/listinfo/users)

- [チュートリアル](ethna-document-tutorial.html)
- [開発マニュアル](ethna-document-dev_guide.html)
- [変更点一覧](ethna-document-changes.html)

- [TODO(ロードマップ)](TODO.html)
- [ロゴ](ethna-logo.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:search_form -->

## Powered by GREE

 [![GREE Labs](http://labs.gree.jp/image/greelabs_logo.gif)](http://labs.gree.jp/)

<!-- END id:search_form -->
 [![SourceForge.jp](http://sourceforge.jp/sflogo.php?group_id=1343)](http://sourceforge.jp/)

<!-- ??END id:sidebar -->
<!-- ??END id:wrap_sidebar -->
<!-- ??END id:main --><!-- ?? Footer ?? ========================================================== -->
<!-- ??BEGIN id:footer -->
<!-- ??BEGIN id:copyright --> **PukiWiki 1.4.6** Copyright © 2001-2005 [PukiWiki Developers Team](http://pukiwiki.sourceforge.jp/). License is [GPL](http://www.gnu.org/licenses/gpl.html).  
 Based on "PukiWiki" 1.3 by [yu-ji](http://factage.com/yu-ji/).
<!-- ??END id:copyright -->
<!-- ??END id:footer --><!-- ?? END ?? ============================================================= -->
<!-- ??END id:wrapper -->
