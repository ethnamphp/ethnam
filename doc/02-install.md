# インストール

Ethhamのインストール方法について説明します。

composerを使ってインストールします。あらかじめcomposerをインストールしておいてください。

```sh
cd /tmp/
# プロジェクト用ディレクトリを作成
mkdir sample
cd sample
```

composer.jsonを作成

```json
{
  "require": {
    "dqneo/ethnam": "2.23.7",
    "smarty/smarty": "2.6.26"
  }
}
```

パッケージをインストール
```
composer install
```

# プロジェクトのスケルトンを作成
vendor/bin/ethna.sh add-project -b . Sample

# サーバ起動

```
php -t www -S 0:8080
```

ブラウザで`http://localhost:8080/` にアクセスして Hello Wolrdの画面が表示されたらOKです。


