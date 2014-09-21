# Ethnam [![Build Status](https://travis-ci.org/DQNEO/ethnam.svg?branch=master)](https://travis-ci.org/DQNEO/ethnam)

Ethnam(えすなえむ)は、PHPのウェブアプリケーションフレームワークです。
Ethnaから派生してできたプロジェクトです。

## 動作環境

* PHP 5.4以上
* Windowsでは動きません。

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

最新の`cheese`からbranchを作ってそこで改修を行い、`cheese` ブランチに対して pull request を送ってください。

## UnitTest

実行方法

```shell
$ composer install
$ ./vendor/bin/phpunit
```

SimpleTestベースで作られた古いテストコードをPHPUnitベースに移行中です。

* `test`      : 古いテスト
* `src/Tests` : 新しいテスト

## Contact

ご意見・ご要望・バグ報告はTwitter(@DQNEO)でお願いします。

https://twitter.com/DQNEO

ハッシュタグは #Ethnam です。
