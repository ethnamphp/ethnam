# インストール
  - 準備 
  - (1) リリースアーカイブの展開 
  - (2) ディレクトリの移動 
  - (3) ethnaコマンドのインストール 
    - この作業は必須ではありません。 
    - やり方 
  - (4) PHPのバージョン、依存ライブラリの確認 
  - (5) アップデート 
    - PEARチャンネルを利用してアップデートする 
    - PEARコマンドを利用してアーカイブでアップデートする 
    - アーカイブを利用してアップデートする 

## インストール [](ethna-document-tutorial-install_guide.html#h3c68913 "h3c68913")

そもそも、 [PEARコマンドを利用してダウンロードを行った場合](ethna-download.html "ethna-download (25d)")には、インストールの作業は必要ありません。PEARコマンドを利用した方が簡便で、Smartyやsimpletestなどのパスに悩まなくて済むので、PEARコマンドを利用することを推奨します。

以下はアーカイブをダウンロードした場合のインストール手順となります(とは言っても単純なものですが)。

### 準備 [](ethna-document-tutorial-install_guide.html#ad962616 "ad962616")

あらかじめ適当なフォルダにEthnaをダウンロードしてください．  
 **[Ethnaダウンロード](ethna-download.html "ethna-download (25d)")**

### (1) リリースアーカイブの展開 [](ethna-document-tutorial-install_guide.html#y0bb60d0 "y0bb60d0")

[ダウンロード](http://sourceforge.jp/projects/ethna/files/)したアーカイブを適当なディレクトリに展開します。

    $ cd /tmp
    $ tar zxvf Ethna-2.5.0.tar.gz

### (2) ディレクトリの移動 [](ethna-document-tutorial-install_guide.html#a32f6d12 "a32f6d12")

(1)で作成されたディレクトリ(Ethna-2.5.0等)を、include\_pathの通ったディレクトリにEthnaというディレクトリ名で移動します。通常は/usr/local/lib/php(または/usr/lib/php)となります。

    $ sudo mv Ethna-2.5.0 /usr/local/lib/php/Ethna

### (3) ethnaコマンドのインストール [](ethna-document-tutorial-install_guide.html#dbc5c1bd "dbc5c1bd")

#### この作業は必須ではありません。 [](ethna-document-tutorial-install_guide.html#re3c8842 "re3c8842")

コマンドのインストールをしない場合は、アーカイブのbinディレクトリに含まれるethna.shあるいはethna.batを直接実行することでethnaコマンドを実行できます。

Windowsの場合

    > c:\foo\bar\Ethna\bin\ethna.bat

Unix系の場合

    $ /usr/local/lib/php/Ethna/bin/ethna.sh

コマンドのインストールをすると、下記のようにと入力するだけでethnaコマンドを呼び出せるようになります。

    ethna

#### やり方 [](ethna-document-tutorial-install_guide.html#s0a2b46e "s0a2b46e")

binディレクトリに含まれるethna.shあるいはethna.batを、パスの通ったディレクトリにコピーします(Unix系OSでは、ethna.shをethnaにrenameすると素敵です)。

次に、対象ファイルの

    @PEAR-DIR@ @PHP-BIN@ @PHP-BINARY@

の部分をEthnaをインストールしたディレクトリ(/usr/local/bin/php/lib等)、PHPコマンドが置いてあるディレクトリ にそれぞれ書き換えます。

以上でインストールは完了です。

### (4) PHPのバージョン、依存ライブラリの確認 [](ethna-document-tutorial-install_guide.html#te5e9e27 "te5e9e27")

_Ethna は PHP 4.1.2以降、及び PHP 5をサポートしています。PHP 4では 4.3.x を推奨します(backtraceが取れるので)。_

Ethnaは以下の3つのクラスライブラリに依存していますので、これらのライブラリがインストールされているかどうかご確認ください。

- [PEAR](http://pear.php.net/package/PEAR/) (pear-local コマンドを使用しないならば不要)
- [PEAR::DB](http://pear.php.net/package/DB)
- [Smarty](http://smarty.php.net/)\*1

_いずれのライブラリに関しても(Ethna自体は)バージョンには依存しませんが、できる限り最新のライブラリを利用されることを推奨します。)_

### (5) アップデート [](ethna-document-tutorial-install_guide.html#udd85e5c "udd85e5c")

#### PEARチャンネルを利用してアップデートする [](ethna-document-tutorial-install_guide.html#qa124a0c "qa124a0c")

    $ pear upgrade ethna/ethna

とします。

#### PEARコマンドを利用してアーカイブでアップデートする [](ethna-document-tutorial-install_guide.html#b8b31b9f "b8b31b9f")

    $ pear upgrade http://ethna.jp/pear/Ethna-2.x.y.tgz

などとします。

#### アーカイブを利用してアップデートする [](ethna-document-tutorial-install_guide.html#b69503a9 "b69503a9")

Ethnaをバージョンアップする場合も、同様に新しいバージョンのアーカイブを展開し、既存のディレクトリと同じ箇所に移動するだけでアップデートは完了です。

なお、念のため [変更点一覧](ethna-news.html "ethna-news (11d)")にて後方互換性を確認してください。

    $ cd /tmp
    $ tar zxvf Ethna-2.5.0.tgz
    $ sudo mv /usr/local/lib/php/Ethna /usr/local/lib/php/Ethna-2.3.7 # 旧バージョンの退避
    $ sudo mv Ethna-2.5.0 /usr/local/lib/php/Ethna

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1pear install ethna/smarty としてSmartyをインストールしていない場合は、include\_once 'Smarty/Smarty.class.php' で読み込めるようにinclude\_pathを設定するか、ethna/class/Renderer/Ethna\_Renderer\_Smarty.phpの該当行をSmartyがインストールされている位置に書き換える必要があります。  

<!-- ??END id:note -->
<!-- ??BEGIN id:trackback -->
<!-- ?? END id:trackback --><!-- ?? END id:attach -->
<!-- ?? END id:summary -->
<!-- ??END id:content -->
<!-- ?? END id:wrap_content --><!-- ??sidebar?? ========================================================== -->
<!-- ??BEGIN id:wrap_sidebar -->

<!-- ??BEGIN id:search_form -->

## 検索

<form action="http://ethna.jp/index.php?cmd=search" method="post">
            <input type="hidden" name="encode_hint" value="??">
            <input type="text" name="word" value="" size="20">
            <input type="submit" value="検索"><br>
            <input type="radio" name="type" value="AND" checked id="and_search"><label for="and_search">AND検索</label>
            <input type="radio" name="type" value="OR" id="or_search"><label for="or_search">OR検索</label>
    </form>

<!-- END id:search_form -->
<!-- ??BEGIN id:download_link -->

## ダウンロード

[![](image/minilogo.gif)Ethna-2.6.0(beta2)](ethna-download.html)

[![](image/minilogo.gif)Ethna-2.5.0(stable)](ethna-download.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:download_link -->

## Quick Links

- [フォーラム(質問/要望等)](ethna-community-forum.html)
- [メーリングリスト](http://ml.ethna.jp/mailman/listinfo/users)

- [チュートリアル](ethna-document-tutorial.html)
- [開発マニュアル](ethna-document-dev_guide.html)
- [変更点一覧](ethna-document-changes.html)

- [TODO(ロードマップ)](TODO.html)
- [ロゴ](ethna-logo.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:search_form -->

