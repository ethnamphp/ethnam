# Ethnam [![Build Status](https://travis-ci.org/DQNEO/ethnam.svg?branch=master)](https://travis-ci.org/DQNEO/ethnam)

Ethnam(えすなえむ)は、PHPのウェブアプリケーションフレームワークです。
Ethnaから派生してできたプロジェクトです。

## 動作環境

* PHP 5.4以上
* OS:Linux/Unix (Windowsでは動きません)


## branch運用ルール

* `master` 開発中の先端ブランチです。必ずしも安定しているとは限りませんのでご注意ください。
* 安定版を入手したい場合はtagを見てください。


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

## Contact

ご意見・ご要望・バグ報告は  Twtterで [@DQNEO](https://twitter.com/DQNEO) までお願いします。

ハッシュタグは [#Ethnam](https://twitter.com/hashtag/ethnam?src=hash) です。
