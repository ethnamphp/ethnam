# 設定情報や定義済みアクション等を一覧する
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


* * *
\*1どこかで見たようなデザインです  

