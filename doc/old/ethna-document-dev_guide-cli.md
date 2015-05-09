# Ethna で コマンドラインから利用するスクリプトを書く。
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

# Ethna で コマンドラインから利用するスクリプトを書く。 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > Ethna で コマンドラインから利用するスクリプトを書く。 
## Ethna で コマンドラインから利用するスクリプトを書く。 [](ethna-document-dev_guide-cli.html#a21d661c "a21d661c")

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
