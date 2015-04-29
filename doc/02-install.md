# インストール

Ethhamのインストール方法について説明します。

composerを使ってインストールします。あらかじめcomposerをインストールしておいてください。

```sh
cd /tmp/
# プロジェクト用ディレクトリを作成
mkdir sample
cd sample
# ethnamをインストール
composer require dqneo/ethnam
# プロジェクトのスケルトンを作成
vendor/bin/ethna.sh add-project -b . Sample

# Smartyを取得
tar xvfz vendor/dqneo/ethnam/misc/optional_package/Smarty/src/Smarty-2.6.26.tar.gz
mv Smarty-2.6.26 lib/Smarty

app/Sample_Controller.phpの冒頭でrequire_onceが連ねてあるところに、下記を追記する

```php
require_once BASE . '/lib/Smarty/libs/Smarty.class.php';
```


# サーバ起動
php -S 0:8080 -t www
```

