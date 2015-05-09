# 設定情報や定義済みアクション等を一覧する - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# 設定情報や定義済みアクション等を一覧する 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [その他](ethna-document-dev_guide-misc.html) > 設定情報や定義済みアクション等を一覧する 

- 設定情報や定義済みアクション等を一覧する 
  - 設定方法 
    - (1) debugフラグの設定 
    - (2) エントリポイントの作成 
    - (3) 動作確認 

## 設定情報や定義済みアクション等を一覧する [](ethna-document-dev_guide-misc-info.html#b2830880 "b2830880")

バージョン0.1.2からEthna組み込みのアクション「\_\_ethna\_info\_\_」が追加されました。このアクションを実行すると、Ethnaの設定情報や、定義済みのアクションやビューの一覧を表示させることが出来ます。実行イメージは以下のようになります\*1。

[![http://ethna.jp/image/ethna-fig16.jpg](http://ethna.jp/image/ethna-fig16.jpg)](image/ethna-fig16.jpg)

このように定義されたアクションや遷移先、設定情報が表示されます。

[![http://ethna.jp/image/ethna-fig17.jpg](http://ethna.jp/image/ethna-fig17.jpg)](image/ethna-fig17.jpg)

### 設定方法 [](ethna-document-dev_guide-misc-info.html#b8f03ad9 "b8f03ad9")

この画面を表示させる手順は結構簡単で、以下のようになります。

#### (1) debugフラグの設定 [](ethna-document-dev_guide-misc-info.html#s1e9a10c "s1e9a10c")

言うまでも無く、\_\_ethna\_info\_\_アクションの結果が見知らぬ人に対して表示されると **phpinfo()とは比較にならないほど危険** です（危険な情報が表示されているphpinfo()な画面もしばしば見かけますが）。ですので、\_\_ethna\_info\_\_の実行には以下の2つの制限があります。

1. 設定ファイルのdebugフラグがtrueになっていること
2. エントリポイントで\_\_ethna\_info\_\_アクションが指定されていること（フォームからのリクエストで\_\_ethna\_info\_\_アクションが実行されることはありません）

というわけで、まずは設定ファイルのdebugフラグをtrueに設定します。generate\_project\_skelton.phpを使用した場合は

    etc/{$appid}-ini.php

というファイルが生成されていると思います。このファイルを以下のように修正します。

    $config = array(
    - 'debug' => false,
    + 'debug' => true,
     );

#### (2) エントリポイントの作成 [](ethna-document-dev_guide-misc-info.html#f6b841f2 "f6b841f2")

しつこいようですが、\_\_ethna\_info\_\_アクションの結果が見知らぬ人に対して表示されると **phpinfo()とは比較にならないほど危険** です。ですので、\_\_ethna\_info\_\_アクションはフォームからのリクエストでは実行されないようになっています。というわけで、\_\_ethna\_info\_\_アクションを実行するためにはwwwディレクトリに専用のエントリポイントを明示的を作成します。具体的には以下のようなファイルをwww/info.php（など）として作成します。

    <?php
    include_once('/tmp/sample/app/Sample_Controller.php');
    Sample_Controller::main('Sample_Controller', array(' __ethna_info__'));
    ?>

上記はアプリケーションIDが'Sample'でプロジェクトのベースディレクトリが/tmp/sampleの場合の例ですので、パス名やコントローラ名は適宜変更してください。

#### (3) 動作確認 [](ethna-document-dev_guide-misc-info.html#yb75280d "yb75280d")

以上が完了したら、(2)で作成したinfo.phpへアクセスして下さい。それらしき画面が表示されると思います。

なお、\_\_ethna\_info\_\_アクションは「とりあえず作ってみた」という実験的な段階にありますので、不具合やご要望等ありましたら [ご意見/ご要望/バグ報告](ethna-community.html#content_1_4 "ethna-community (619d)")ページからお知らせ下さい。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1どこかで見たようなデザインです  

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
