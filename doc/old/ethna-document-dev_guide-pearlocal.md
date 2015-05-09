# 個々のEthnaプロジェクト毎にPEARパッケージを管理する
複数の Ethna のプロジェクトを作ると、 それらでひとつの PHP のインス トールを共有する状況が往々にして起こります。こういう場合、PEAR のイン ストール設定は共有されてしまい、特定のパッケージを特定の Ethna プロジ ェクト用にアップグレード/削除/追加 したいといった要求に応えることが難 しくなります。

また、レンタルサーバに代表されるように、PEAR パッケージを簡単にインス トールするのに管理者権限(root)が必要とされる場合も少なくありません。 この場合は、パッケージを手動でダウンロードしてきて include\_path が通 った場所に展開(Ethna プロジェクトでは多くの場合 [APP\_DIR]/lib）するわ けですが、面倒な作業です。アップグレード等を行なうときも同様でしょう。

ここでは、個々の Ethna プロジェクト毎に 楽に PEAR パッケージを管理する方法 を紹介します。

- 個々のEthnaプロジェクト毎にPEARパッケージを管理する 
  - 何が出来るの？ 
  - PEAR コマンド使えばいいじゃん。何が嬉しいの？ 
  - 早速使ってみる 
  - PEAR コマンドと同じインターフェイス 
  - どんな仕組みで動いているの？ 
  - 設定ファイルを変更する 

| 書いた人 | 日付 | 備考 |
| mumumu | 2007-07-11 | 初版 |

    注意！ ： この機能を利用するためには、Ethna 2.3.2 以降が必要です。

### 何が出来るの？ [](ethna-document-dev_guide-pearlocal.html#m3912c93 "m3912c93")

ethna コマンドの pear-local コマンドによって、PEARパッケージをプロジェクト毎に楽に管理できます。  
具体的には、以下のコマンドで [APP\_DIR]/lib ディレクトリ以下に PEAR パッケージを直接インストールし、管理します。

    ethna pear-local [-c|--channel=channel] [-b|--basedir=dir] [pear command ...]

オプションは以下の通りです。  
[pear command]の部分は、pear コマンドに渡すオプションと全く同等です。

    -c PEARチャンネル名
    -b プロジェクトのベースディレクトリ

### PEAR コマンド使えばいいじゃん。何が嬉しいの？ [](ethna-document-dev_guide-pearlocal.html#lf627ca4 "lf627ca4")

[APP\_DIR]/lib ディレクトリは Ethna によって常に include\_path が通っているため、 コマンドを実行後に即座に Ethnaプロジェクト内で PEAR パッケージを利用することができます。

また、PEAR の設定はデフォルトで [APP\_DIR]/lib/pear.conf 以下に置かれます。このため、他のプロジェクトの PEAR の設定とコンフリクトすることが一切ありません。よって、プロジェクト毎にPEAR パッケージのインストール、削除、アップグレード、設定変更等を独立して行なうことが可能です。

そして、実行権限は当然ethnaコマンドを実行したユーザと同等（なはず）ですので、インストールの際に権限に左右される心配も小さくなります。

必要な PEAR パッケージをこの方式で全てインストールしてしまえば、deployする際に 細かいパッケージのインストールを気にしなくても良くなるでしょう。

### 早速使ってみる [](ethna-document-dev_guide-pearlocal.html#f2d5284b "f2d5284b")

まずは sample プロジェクトを作ってみましょう。いつもの通り、ethna コマンドを使います。

    $ cd /tmp
    $ ethna add-project sample

そしてプロジェクトディレクトリに移動し、以下のコマンドを実行します。

    $ cd sample
    $ ethna pear-local install Date
    WARNING: channel "pear.php.net" has updated its protocols, use 
    "channel-update pear.php.net" to update
    downloading Date-1.4.7.tgz ...
    Starting to download Date-1.4.7.tgz (55,754 bytes)
    .............done: 55,754 bytes
    install ok: channel://pear.php.net/Date-1.4.7

    $ cd lib
    $ ls
    Date Date.php pear.conf

[APP\_DIR]/lib 以下に PEAR パッケージがインストールされているのがわかると思います。PEARパッケージであれば何でもインストールできますので、勿論Ethnaですら特定のプロジェクトにインストールし、独自のプロジェクトで動作させることができます。\*1

### PEAR コマンドと同じインターフェイス [](ethna-document-dev_guide-pearlocal.html#j6b6e5ad "j6b6e5ad")

既に述べたように、この機能で実行できることは、pearコマンドと全く同等です。よって、以下のようなことも勿論可能です。

    $ cd /tmp/sample
    $ ethna pear-local channel-discover pearified.com
    Adding Channel "pearified.com" succeeded
    Discovery of channel "pearified.com" succeeded
    $ ethna pear-local install pearified/smarty
    downloading Smarty-2.6.8.tgz ...
    Starting to download Smarty-2.6.8.tgz (146,444 bytes)
    ................................done: 146,444 bytes
    install ok: channel://pearified.com/Smarty-2.6.8

ここでは、pearified.com の PEAR チャンネルをdiscoverし、Smartyパッケージをインストールしています。  
何度も述べているように、これは [APP\_DIR]/lib 以下にインストールされます。

今までインストールしたパッケージの履歴を閲覧することも勿論可能です。

    $ ethna pear-local list -a
    INSTALLED PACKAGES, CHANNEL __URI:
    ==================================
    (no packages installed)
    INSTALLED PACKAGES, CHANNEL PEAR.PHP.NET:
    =========================================
    PACKAGE VERSION STATE
    Date 1.4.7 stable
    INSTALLED PACKAGES, CHANNEL PEARIFIED.COM:
    ==========================================
    PACKAGE VERSION STATE
    Smarty 2.6.8 stable
    INSTALLED PACKAGES, CHANNEL PECL.PHP.NET:
    =========================================
    (no packages installed)

### どんな仕組みで動いているの？ [](ethna-document-dev_guide-pearlocal.html#c672ae2e "c672ae2e")

既におわかりの方もおられると思いますが、この機能は pear コマンドを単純にラップして、Ethna プロジェクト毎に固有の設定ファイルを適用させているだけのものです。よって、config-show や、upgrade 等、pear コマンドで実行できる機能は何でも実行させることが出来ます。しかし、影響が及ぶのは、特定の Ethna プロジェクトだけです。

これによって、プロジェクト毎に PEAR パッケージを独立して扱うことが出来るようになります。

### 設定ファイルを変更する [](ethna-document-dev_guide-pearlocal.html#n2be4449 "n2be4449")

Ethna プロジェクト毎に固有の PEAR 設定は、デフォルトで[APP\_DIR]/lib/pear.conf に格納されます。しかし、このファイルの位置を変更したいという方もおられるかもしれません。

その場合は [APP\_DIR]/etc/[APP\_ID]-ini.php に以下の一行を加えます。

    $config = array(
    
          // プロジェクトのPEAR設定を [APP_DIR]からの
          // 相対パスで設定する
    + 'app_pear_local_config' => 'etc/app-pear.conf',
    
    );

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1この機能は、どんなパッケージがPHP\_DIRにインストールされているかについてはチェックしません。よって、Ethna でさえ [APP\_DIR]/lib にインストールできてしまいます。但し、Ethnaを [APP\_DIR]/lib にインストールしても、2.3.2では ethnaコマンドが様々な問題で動作しないため、あまり役に立ちません。2.3.5以降では、この問題は解消されています。  

<!-- ??END id:note -->
