# Ethnam [![Build Status](https://travis-ci.org/DQNEO/ethnam.svg?branch=master)](https://travis-ci.org/DQNEO/ethnam)

Ethnam(えすなえむ)は、PHPのウェブアプリケーションフレームワークです。
Ethnaから派生してできたプロジェクトです。

## 動作環境

* PHP 5.4以上
* OS:Linux/Unix (Windowsでは動きません)

## Installtion

composerを使えば下記コマンドひとつでインストールとサンプルプロジェクト作成までやってくれます。

```
composer create-project ethnam/project myproject
```

プロジェクト作成したらPHP組み込みサーバで動作確認できます。
```
cd myproject
php -t www -S localhost:8000
```

## Documentation

[/doc/README.md](/doc/README.md)

## Branch/Tag運用ルール

* `master` 開発中の先端ブランチです。(必ずしも安定しているとは限りませんのでご注意ください)
* `master` の任意のコミットに対してバージョン番号のタグを打つことをもってリリース作業とします。

## Packagist

https://packagist.org/packages/ethnam/ethnam

## Contact

ご意見・ご要望・バグ報告は  Twitterで [@DQNEO](https://twitter.com/DQNEO) までお願いします。

ハッシュタグは [#Ethnam](https://twitter.com/hashtag/ethnam?src=hash) です。
