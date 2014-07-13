# Ethnam

Ethnam(えすなえむ)は、PHPのウェブアプリケーションフレームワークです。
Ethnaから派生してできたプロジェクトです。

## 動作環境

* PHP 5.4以上
* Windowsでは動きません。

## branch運用ルール

* `master` 最新の安定版です。
* `develop` 開発中のブランチです。

## インストール

composer でインストールできます。

```sh
cd /tmp/

# ethnamを取得
composer install

# プロジェクト作成
./vendor/dqneo/ethnam/bin/ethna.sh add-project foo

# Smartyを取得
tar xvfz ~/tmp/Ethna/misc/optional_package/Smarty/src/Smarty-2.6.26.tar.gz
mv Smarty-2.6.26 Smarty

app/Foo_Controller.phpのrequire_once 'Smarty/libs/Smarty.class.php'を有効にする

# サーバ起動
php -S 0.0.0.0:8080 -t /tmp/foo/www
```

## Pull Request

バグ修正などの Pull Request など大歓迎です。

最新の`develop`からbranchを作ってそこで改修を行い、develop ブランチに対して pull request を送ってください。

## UnitTest

現在、Ethnamに対するUnitTestは整備されていません。
今後PHP Unitであらたにテストを作成するつもりです。

## Contact

ご意見・ご要望・バグ報告はTwitter(@DQNEO)でお願いします。

https://twitter.com/DQNEO

ハッシュタグは #Ethnam です。


## tagについて

`ETHNA_2_x_x`となっているものは、本家Ethnaのバージョンを指します。

`バージョン番号`となっているものは、本家からforkした後のEthnam独自のバージョンです。


betaX
  betaリリース
