# Ethna用 PEARパッケージの作成と配布

## Ethna用 PEARパッケージの作成と配布 [](ethna-document-dev_guide-pearpackage.html#e4f71cd6 "e4f71cd6")

- Ethna用 PEARパッケージの作成と配布 
  - Ethna 2.5.0 以降のやり方 
    - パッケージの作成方法 
    - パッケージの配布 
    - インストール 
  - Ethna 2.3.7 以前のやり方 
    - パッケージを作る 
    - PEAR パッケージについての簡単な説明 
    - master と local 
    - localについての注意 
    - いろいろ 

| 書いた人 | いちい | ---------- | 新規作成 |
| 書いた人 | mumumu | 2009-06-21 | 最新版に合わせて修正 |

### Ethna 2.5.0 以降のやり方 [](ethna-document-dev_guide-pearpackage.html#l4e0ce78 "l4e0ce78")

... 執筆中

#### パッケージの作成方法 [](ethna-document-dev_guide-pearpackage.html#j9d8ca60 "j9d8ca60")

... 執筆中

#### パッケージの配布 [](ethna-document-dev_guide-pearpackage.html#g5201ecb "g5201ecb")

... 執筆中

#### インストール [](ethna-document-dev_guide-pearpackage.html#f1d55e95 "f1d55e95")

上記で説明したやり方で作成した PEAR パッケージは、pear-local コマンドでインストールすることができます。

    ethna pear-local install [Ethna_Plugin_Package_URL]

### Ethna 2.3.7 以前のやり方 [](ethna-document-dev_guide-pearpackage.html#n2e7fa30 "n2e7fa30")

#### パッケージを作る [](ethna-document-dev_guide-pearpackage.html#nb16f924 "nb16f924")

現状プラグインしかパッケージがないです。

現状、プラグインのパッケージは1パッケージに1プラグインファイルを前提としてます。これを土台にもうちょっと一般的な(プラグイン以外の)パッケージとパッケージャを作る予定です。

ethnaのリリースファイルにプラグインのパッケージャが含まれるようになりました。パッケージを作るときのサンプルがmiscディレクトリに用意されています。

    % mkdir /tmp/ethna_package
    % cp $ETHNA_HOME/misc/sample_package.ini $ETHNA_HOME/misc/sample_plugin.php /tmp/ethna_package
    % cd /tmp/ethna_package
    % ethna make-plugin-package --inifile=sample_package.ini --skelfile=sample_plugin.php

とすると、/tmp/ethna\_packageディレクトリに

- Ethna\_Plugin\_Sample\_Phpinfo-1.0.0.tgz
- App\_Plugin\_Sample\_Phpinfo-1.0.0.tgz の2つのパッケージが作られます。

プラグインのサンプルが設定ファイルはてきとうに編集すれば分かると思います。スケルトンは、プラグインファイル中のクラス名のprefix(masterとlocalでインストール時に変わる部分)を {$application\_id} としていることに注意してください。

#### PEAR パッケージについての簡単な説明 [](ethna-document-dev_guide-pearpackage.html#qf3df12b "qf3df12b")

pear.ethna.jp という pear のチャンネルがあって，そこで公開されているプラグインなどのパッケージがインストールできるようになりました。

たとえばプラグインだったら，

    % ethna install-plugin --master Hoge Fuga

とやると，プラグイン Ethna\_Plugin\_Hoge\_Fuga をネットワークからダウンロードしてEthna本体のディレクトリにインストールしてくれます。

#### master と local [](ethna-document-dev_guide-pearpackage.html#ya0e8a97 "ya0e8a97")

- master
  - Ethna本体と同じところにパッケージをインストールします
  - pear install するのとの違いは，パッケージ名の命名規則を ethna コマンドが理解してくれる。
  - パーミッションでこけやすいので注意

- local
  - アプリケーション(プロジェクト)のディレクトリにパッケージを入れます
  - いわゆる php\_dir は skel/ です。 skel/.pearrc があるので

    % pear -c skel/.pearrc config-show

でいろいろ表示されます。

#### localについての注意 [](ethna-document-dev_guide-pearpackage.html#h80740a1 "h80740a1")

- プラグインの場合，いったん skel にインストールした上で， skelton generator を経由してプラグインを入れます。
  - ややこしいですが，ディレクトリ配置が変えられるとか，クラス名の prefix がインストール時に決まるとかの都合でこうなっちゃいました。
- プラグイン以外にも， action pack みたいなのを skel にインストールして add-hoge みたくやれるようにしたいです。

#### いろいろ [](ethna-document-dev_guide-pearpackage.html#na69dccd "na69dccd")

- (CLIの) php.ini で memory\_limit = 8M だと足りないかもしれません。
  - 16M とか 24M くらいにすれば OK なはず
- ハンドラ関連はflockしてないので同時に実行しないでください

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

## Powered by GREE

 [![GREE Labs](http://labs.gree.jp/image/greelabs_logo.gif)](http://labs.gree.jp/)

<!-- END id:search_form -->
 [![SourceForge.jp](http://sourceforge.jp/sflogo.php?group_id=1343)](http://sourceforge.jp/)

<!-- ??END id:sidebar -->
<!-- ??END id:wrap_sidebar -->
<!-- ??END id:main --><!-- ?? Footer ?? ========================================================== -->
<!-- ??BEGIN id:footer -->
<!-- ??BEGIN id:copyright --> **PukiWiki 1.4.6** Copyright © 2001-2005 [PukiWiki Developers Team](http://pukiwiki.sourceforge.jp/). License is [GPL](http://www.gnu.org/licenses/gpl.html).  
 Based on "PukiWiki" 1.3 by [yu-ji](http://factage.com/yu-ji/).
<!-- ??END id:copyright -->
<!-- ??END id:footer --><!-- ?? END ?? ============================================================= -->
<!-- ??END id:wrapper -->
