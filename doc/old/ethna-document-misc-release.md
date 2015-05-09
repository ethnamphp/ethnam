# release

- 環境の前提 
- リリース手順 

| 書いた人 | いちい | 2007-07-15 | 初版 |
| 書いた人 | mumumu | 2007-07-15 | 手順の詳細化、解説追加 |

### 環境の前提 [](ethna-document-misc-release.html#y65f85b0 "y65f85b0")

Linux での作業を前提にしています。PHP, PEAR, subversion, ssh, zip のインストールが最低限必要です。

### リリース手順 [](ethna-document-misc-release.html#ma579b65 "ma579b65")

1. code freeze
2. バージョン番号を更新
  - Ethna.php, CHANGES, bin/ethna\_make\_packages.php の $major\_version $minor\_version
3. 必要ならタグ打ち。（TAGNAME は ETHNA\_2\_3\_0 の形で）

    svn copy svn+ssh://USERNAME@svn.sourceforge.jp/svnroot/ethna/ethna/trunk svn+ssh://USERNAME@svn.sourceforge.jp/svnroot/ethna/ethna/tags/TAGNAME

4. svn export(VERSION\_NUMBERは必要なバージョンに置き換え）

    svn export svn+ssh://USERNAME@svn.sourceforge.jp/svnroot/ethna/ethna/trunk /tmp/VERSION_NUMBER-release

5. cd /tmp/VERSION\_NUMBER-release/bin; sh ethna\_make\_package.sh [-b]
  - ベータ版をリリースする場合は、ethna\_make\_package.sh に -b オプションをつける。安定版の場合はつけない。
  - この操作を行う前に、PEAR\_PackageFileManager2 をインストールしておくこと。
  - /tmp/ethna ディレクトリに -dev がついたものとそうでないものができる。
    - devつきのものは、package.xml 1.0(older) のもの。
    - devつきでないものは、package.xml 2.0 のもの。我々はこちらを使う。

1. sf.jp でリリース
  - まずは sourceforge.jp にログイン
  - [http://sourceforge.jp/projects/ethna/](http://sourceforge.jp/projects/ethna/) に移動
  - ニュースの作成
    - 「ニュース」タブをクリックし、題名と本文を入力
    - ニュースはMLでのアナウンスがあるまでは投稿しない。
    - ニュースのアナウンスの書き方については、このページの一番下を参照すること
  - リリースの作成
    - 「リリース」タブをクリックし、「リリース」の「新規作成」をクリックして必要事項を入力。パッケージファイルをアップロード。
    - ML でのアナウンスがあるまでは、リリースのステータスは [Hidden] にしておくとよい。アップロードするパッケージは devつきでないパッケージを使う。

1. ethna.jp でリリース
  - pear.ethna.jp にアップロード
  - shell.sourceforge.jp にtgzパッケージを scp し、/home/groups/e/et/ethna/htdocs/pear/ にパッケージを配置
    - これによって、 [http://ethna.jp/pear/Ethna-X.Y.Z](pear/Ethna-X.Y.Z){,-oldpkg}.tgz に配置したことになる
  - 以下の作業で、ユーザが pearコマンドからダウンロードできるようにする
    - この作業はベータ版では不要
    - [http://pear.ethna.jp/chiara.php](http://pear.ethna.jp/chiara.php) にログイン
    - 左の Upload Release のリンクをクリックし、tgz パッケージをアップロードする

1. ethna.jp wikiの書き換え。
  - 以下のページを頑張って書き換えよう！
    - [http://ethna.jp/ethna.html](ethna.html)
    - [http://ethna.jp/ethna-document-changes.html](ethna-document-changes.html)
    - [http://ethna.jp/ethna-news.html](ethna-news.html)
    - [http://ethna.jp/ethna-download.html](ethna-download.html)
  - ethna.jp の pukiwiki の skin/pukiwiki.skin.php の line 144 に直書きされてるバージョン番号を更新
    - /home/groups/e/et/ethna/htdocs/skin/pukiwiki.skin.php を更新する。必ずバックアップをとって作業すること
2. phpdoc更新(ベータ版では不要)
  - いったんtar zxvfしてphpdoc

    % phpdoc -s on -i `echo Ethna-X.Y.Z/test/*(:t) Ethna.X.Y.Z/skel/*(:t)|tr ' ' ','` -t doc -d Ethna-X.Y.Z -o HTML:frames:earthli.eucjp -ti Ethna

  - [http://ethna.jp/doc](doc) に配置
  - earthli.eucjp ってのは、encoding=iso-8859-1をeuc-jpに強引に書き換えたもの
3. [users@ethna.jp](mailto:users@ethna.jp) とかでアナウンス

- アナウンスの書き方
  - sourceforge.jp 向けテンプレート
    - (参考) [http://sourceforge.jp/forum/forum.php?forum\_id=17377](http://sourceforge.jp/forum/forum.php?forum_id=17377)

    Ethna [version number] をリリースしました。
    
    このリリースは、((安定版の場合)安定版である x.x 系のメンテナンスリリ
    ースです) ....本バージョンでは、[どんな変更があったのか
    の要約を続いて書く)
    
    詳細な変更点については、以下のページを御覧下さい。
    
    [http://ethna.jp/ethna-document-changes.html の該当バージョンのURLを貼る]

- [users@ethna.jp](mailto:users@ethna.jp) 向けテンプレート
  - (参考 ベータ版) [http://ml.ethna.jp/pipermail/users/2009-January/001096.html](http://ml.ethna.jp/pipermail/users/2009-January/001096.html)
  - (参考 安定版) [http://ml.ethna.jp/pipermail/users/2009-June/001130.html](http://ml.ethna.jp/pipermail/users/2009-June/001130.html)

    XXです。Ethna [version number] をリリースしました。
    
    このリリースは、((安定版の場合)安定版である x.x 系のメンテナンスリリ
    ースです) ....本バージョンでは、[どんな変更があったのか
    の要約を続いて書く)
    
    詳細な変更点については、以下のページを御覧下さい。
    
    [http://ethna.jp/ethna-document-changes.html の該当バージョンのURLを貼る]
    
    ----
    
    (必要があれば、新機能へのリンクを貼り、説明を書く)
    
    ----
    
    ダウンロード、インストールは、sourceforge.jp 及び PEAR チャン
    ネルを通じて行うことが出来ます。
    
    pear channel-discover pear.ethna.jp
    (安定版の場合)pear install -a ethna/ethna 
    (ベータ版の場合) pear install http://pear.ethna.jp/get/Ethna-XXXXXXXXX.tgz
    
    詳細は以下を御覧下さい。
    
    http://ethna.jp/ethna-download.html (安定版)
    http://ethna.jp/ethna-download.html#v3abe89a (ベータ版)
    
    ----
    
    バグ報告は、このML、IRC、または、sourceforge.jpのチケットシステムより
    お願い致します。
    
    http://ethna.jp/ethna-community.html
    http://sourceforge.jp/projects/ethna/ticket/
    
    ----
    
    (まあここらへんは適当に)
    最後に、利用して頂いているユーザの皆様、フィードバックを頂いた
    皆様、開発者の皆様等、Ethna に関わっている全ての皆様に深く感謝
    致します。これからも宜しくお願い致します。
    
    それでは、Enjoy, Ethna！

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
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

