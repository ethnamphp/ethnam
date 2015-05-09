# ダウンロード
  - PEARチャンネルを利用してインストールする(PHP 4.4.x, PHP 5, PEAR 1.4.0以降) 
    - 開発版をPEARコマンドでインストール 
  - tar/zipアーカイブをダウンロードする 
  - Gitで最新版を取得する 
  - インストール 

## ダウンロード [](ethna-download.html#aab8abfb "aab8abfb")

Ethnaのダウンロード/インストールには幾つかの方法がありますので、ご利用の環境に合わせて選択してください。

### PEARチャンネルを利用してインストールする(PHP 4.4.x, PHP 5, PEAR 1.4.0以降) [](ethna-download.html#ve6540a4 "ve6540a4")

EthnaはPEARのチャンネルサーバ(pear.ethna.jp)でのインストールをサポートしています。PEARチャンネルを利用すると下記手順で簡単にインストールが出来ます。  
  
pearコマンドに -a オプションを指定することで、Ethna が依存するSmarty, simpletest も同時にインストールできます。\*1

    $ pear channel-discover pear.ethna.jp
    $ pear update-channels
    $ pear install -a ethna/ethna

既にsimpletest や Smartyのいずれかが入っている場合は、-a をつけず、以下のように個別にインストールしてください。

    $ pear channel-discover pear.ethna.jp
    $ pear update-channels
    $ pear install ethna/ethna
    $ pear install ethna/smarty
    $ pear install ethna/simpletest

アーカイブを指定して直接インストールすることもできます

    $ pear install http://pear.ethna.jp/pear/Ethna-2.5.0.tgz

#### 開発版をPEARコマンドでインストール [](ethna-download.html#s350c79f "s350c79f")

    $ pear install ethna/ethna-beta

### tar/zipアーカイブをダウンロードする [](ethna-download.html#je664a6b "je664a6b")

[github](https://github.com/ethna/ethna)からダウンロードすることが出来ます。\*2

<dl class="list1" style="padding-left:16px;margin-left:16px">
<dt>2.5.0</dt>
<dd><a href="https://github.com/ethna/ethna/tree/ETHNA_2_5_0" rel="nofollow">https://github.com/ethna/ethna/tree/ETHNA_2_5_0</a></dd>
</dl><dl class="list1" style="padding-left:16px;margin-left:16px">
<dt>2.6.0 beta2</dt>
<dd><a href="https://github.com/ethna/ethna/tree/2.6.0beta2" rel="nofollow">https://github.com/ethna/ethna/tree/2.6.0beta2</a></dd>
</dl>
### Gitで最新版を取得する [](ethna-download.html#hf16b247 "hf16b247")

    git clone git://github.com/ethna/ethna.git

### インストール [](ethna-download.html#w7619ee9 "w7619ee9")

Ethnaのインストール、アップグレード詳細についてはこちらをご覧ください。

**[インストール](ethna-document-tutorial-install_guide.html "ethna-document-tutorial-install\_guide (16d)")**

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1既に simpletest や Smartyをインストールしていて、include\_path を通すために symlink を張っている場合は、pear intall [-a] ethna/[ethna|smarty|simpletest] とすると、そのsymlink先、つまり既にインストールされているものを PEAR が書き換えてしまうので十分に注意が必要です。その場合は、symlinkを外すか、既存のインストールを別の場所に退避した方が良いかもしれません。  
\*22011年9月29日にsourceforgeからgithubに移行しました  

<!-- ??END id:note -->
