# Ethnam [![Build Status](https://travis-ci.org/DQNEO/ethnam.svg?branch=master)](https://travis-ci.org/DQNEO/ethnam)

Ethnam(えすなえむ)は、PHPのウェブアプリケーションフレームワークです。
Ethnaから派生してできたプロジェクトです。

## 動作環境

* PHP 5.4以上
* OS:Linux/Unix (Windowsでは動きません)


## branch運用ルール

* `master` 最新の安定版です。
* `cheese` 開発中のブランチです。

## インストール

composerでインストールできます。(Packagist経由でインストールできます)

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
## Packagist

Packagistにて公開中です。

https://packagist.org/packages/dqneo/ethnam

## Pull Request

バグ修正などの Pull Request など大歓迎です。

request を送ってください。

## UnitTest

PHPUnitでテストします。

実行方法

```shell
$ composer install
$ ./vendor/bin/phpunit
```

* `src/Tests` : 新しいテスト
* `src/oldtest`    : 古いテスト(SimpleTestベース)

## Ethna本家との関係

Ethnaの2.6.0beta4の途中からforkして、PHP5.4に正式対応し、一部古いコード(ver2.5.0やver2.3.5)を取り込んだのがEthnamです。

タグ`ethna_junction`(`e22c8016ece9cb3daa3d7f2df45fc98423839523`) がEthnaとEthnamの枝分かれポイントです。

* https://github.com/DQNEO/ethna/commit/ethna_junction
* https://github.com/ethna/ethna/commit/e22c8016ece9cb3daa3d7f2df45fc98423839523

## Contact

ご意見・ご要望・バグ報告はTwitter(@DQNEO)でお願いします。

https://twitter.com/DQNEO

ハッシュタグは #Ethnam です。
