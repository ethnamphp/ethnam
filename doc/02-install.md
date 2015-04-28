# インストール

Ethhamのインストール方法について説明します。

composerを使ってインストールします。

`composer.json` ファイル

```json
{
  "require": {
    "dqneo/ethnam": "2.22.*"
  }
}
```

```sh
composer install
```

上記の代わりに、`composer require dqneo/ethnam:2.22`とすることでも同じことができます。

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
