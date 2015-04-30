# インストール

Ethhamのインストール方法について説明します。

composerを使ってインストールすることができます。

プロジェクト名を仮に`Sample`として、Ethnamをインストールして
プロジェクトを作成するところまでを説明します。

## composerをインストール

composerをまだインストールしてない場合はインストールしておいてください。

https://getcomposer.org/doc/00-intro.md#globally

## プロジェクト用ディレクトリを作成


```sh
cd /tmp/
# プロジェクト用ディレクトリを作成
mkdir sample
cd sample
```

## composer.jsonを作成

```json
{
  "require": {
    "dqneo/ethnam": "2.23.7",
    "smarty/smarty": "2.6.*"
  }
}
```

## パッケージをインストール

```
composer install
```

## プロジェクトのスケルトンを作成

```
vendor/bin/ethna add-project -b . Sample
```

## 簡易サーバを起動

```
php -t www -S 0:8080
```

ブラウザで`http://localhost:8080/` にアクセスして "Welcome to Ethnam!"の画面が表示されたらOKです。

