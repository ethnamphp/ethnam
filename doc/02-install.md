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

# ここから下は未検証
# Smartyを取得
tar xvfz vendor/dqneo/ethnam/misc/optional_package/Smarty/src/Smarty-2.6.26.tar.gz
mv Smarty-2.6.26 Smarty

app/Sample_Controller.phpのrequire_once 'Smarty/libs/Smarty.class.php'を有効にする

# サーバ起動
php -S 0:8080 -t www
```

