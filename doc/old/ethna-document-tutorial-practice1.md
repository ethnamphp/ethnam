<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
アプリケーション構築手順(1) - Ethna - PHPウェブアプリケーションフレームワーク</title>
 <link rel="stylesheet" href="skin/ethna/ethna.css" title="ethna" type="text/css" charset="utf-8">

 <link rel="alternate" type="application/rss+xml" title="RSS" href="cmd=rss.html">

 <script type="text/javascript" src="skin/trackback.js"></script>

</head>
ここは以前の ethna.jp サイトを表示したものです。ここにあるドキュメントはバージョン2.6以降更新されません。  
最新のドキュメントは [現在のethna.jp](http://ethna.jp/) を閲覧してください。現ドキュメントが整備されるまでは、ここを閲覧してください。

<!-- ??BEGIN id:wrapper --><!-- ?? Navigator ?? ======================================================= -->

[![Ethna](image/navlogo.gif)](/)

[トップ](ethna.html "ethna (11d)") [二ュース](ethna-news.html "ethna-news (11d)") [概要](ethna-about.html "ethna-about (11d)") [ダウンロード](ethna-download.html "ethna-download (25d)") [ドキュメント](ethna-document.html "ethna-document (884d)") [コミュニティ](ethna-community.html "ethna-community (619d)") [FAQ](ethna-document-faq.html "ethna-document-faq (1240d)")

<!-- ?? Header ?? ========================================================== -->

# アプリケーション構築手順(1) 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [チュートリアル](ethna-document-tutorial.html) > アプリケーション構築手順(1) 
## アプリケーション構築手順(1) [](ethna-document-tutorial-practice1.html#hbd53ffa "hbd53ffa")

- アプリケーション構築手順(1) 
  - (0) アプリケーション情報の決定 
  - (1) アプリケーションの自動生成 
    - ethnaコマンドが実行できるか確認する 
    - ethnaコマンドが実行できない場合 
    - アプリケーションを作成する 
  - (2) エントリポイントの設定 
  - (3) ディレクトリ構成の確認 

| 書いた人 | DQNEO | 2010-04-10 | 古い記述を修正 |
| 書いた人 | DQNEO | 2010-04-28 | 初心者向けにわかりやすくした |

Ethnaを利用したアプリケーションの構築手順についてご説明します。

### (0) アプリケーション情報の決定 [](ethna-document-tutorial-practice1.html#ud75ed71 "ud75ed71")

アプリケーションを構築する前に、少なくとも以下の2点を決定しておく必要があります。

1. アプリケーションID(英字のみ)  

    例: Sample

2. アプリケーション配置ディレクトリ(どこでも構いません)  

    例: /home/example/codes/とかC:\codes\php\とか適当に

### (1) アプリケーションの自動生成 [](ethna-document-tutorial-practice1.html#v5252856 "v5252856")

ethnaコマンドを利用してアプリケーションを使って生成します。

#### ethnaコマンドが実行できるか確認する [](ethna-document-tutorial-practice1.html#oe2592c1 "oe2592c1")

    $ ethna add-project
    error occured w/ command [add-project]
     -> Application id isn't set.
    
    usage:
    ethna add-project [-b|--basedir=dir] [-s|--skeldir] [-l|--locale] [-e|--encoding] [Application id]

#### ethnaコマンドが実行できない場合 [](ethna-document-tutorial-practice1.html#rb977745 "rb977745")

Ethnaをまだダウンロードしてない場合は [ダウンロード](ethna-download.html "ethna-download (25d)")してください。

ethnaコマンドの実体は、アーカイブのbinディレクトリに含まれるバッチ(シェル)スクリプトです。 ethnaコマンドをインストールしていない場合は、下記のようにバッチ(シェル)スクリプトを直接実行することでethnaコマンドを実行できます。

Windowsの場合

    > c:\foo\bar\Ethna\bin\ethna.bat

Unix系の場合

    $ /foo/bar/Ethna/bin/ethna.sh

#### アプリケーションを作成する [](ethna-document-tutorial-practice1.html#z7d5f0d3 "z7d5f0d3")

例として、アプリケーションIDが「sample」、アプリケーション配置ディレクトリが/tmpだとすると以下のようになります(CGI版もしくはCLI版のphpが必要です)。

    $ ethna add-project -b /tmp/sample sample
    creating directory (/tmp/sample) [y/n]:project sub directory created [/tmp/sample/app]
    
    creating directory (/tmp/sample) [y/n]: y
    project sub directory created [/tmp/sample/app]
    project sub directory created [/tmp/sample/app/action]
    
    [中略]
    
    file generated [./Ethna/skel/skel.template.tpl -> /tmp/sample/skel/skel.template.tpl]
    file generated [./Ethna/skel/skel.view_test.php -> /tmp/sample/skel/skel.view_test.php]
    
    project skelton for [sample] is successfully generated at [/tmp/sample]

以上で、最小構成のアプリケーションが生成されます。

### (2) エントリポイントの設定 [](ethna-document-tutorial-practice1.html#v357dcce "v357dcce")

(1)で生成したアプリケーションにアクセスするには、wwwディレクトリに生成されているindex.phpをウェブサーバを通じてアクセス可能な適当なディレクトリにコピー、あるいはシンボリックリンクを作成します。 また、wwwディレクトリ以下のcssディレクトリもディレクトリごと当該ディレクトリにコピーします。

ここでは最も簡単な例として、~/public\_htmlにindex.phpとcssディレクトリを配置します。

    $ cd ~/public_html/
    $ ln -s /tmp/sample/www/index.php .
    $ cp -r /tmp/sample/www/css ./css

以上で設定は完了です。ブラウザから

    http://some.host/~foo/

というようにアクセスしてみてください。正しくプロジェクトが生成されていると、以下のような画面が表示されるかと思います。

 [![ethna-helloworld-thumb-426x262.jpg](http://dqn.sakusakutto.jp/ethna/ethna-helloworld-thumb-426x262.jpg "ethna-helloworld-thumb-426x262.jpg")](http://dqn.sakusakutto.jp/ethna/ethna-helloworld-thumb-426x262.jpg "ethna-helloworld-thumb-426x262.jpg")

### (3) ディレクトリ構成の確認 [](ethna-document-tutorial-practice1.html#yfa7881f "yfa7881f")

Ethnaを利用したアプリケーションの標準的なディレクトリ構成は以下のようになります。

    |-- app (アプリケーションのスクリプト)
    | |-- action (アクションスクリプト)
    | |-- action_cli (CLI用アクションスクリプト)
    | |-- action_xmlrpc (XMLRPC用アクションスクリプト)
    | |-- plugin (フィルタスクリプト)
    | |-- test (テストスクリプト)
    | `-- view (ビュースクリプト)
    |-- bin (コマンドラインスクリプト)
    |-- etc (設定ファイル等)
    |-- lib (アプリケーションのライブラリ)
    |-- locale
    | `-- ja_JP
    |-- log (ログファイル)
    |-- schema (DBスキーマ等)
    |-- skel (アプリケーション用スケルトンファイル)
    |-- template
    | `-- ja_JP (テンプレートファイル)
    |-- tmp (一時ファイル)
    `-- www (ウェブ公開用ファイル)
        |-- css (CSSファイル)
        |-- js (JavaScriptファイル)

たくさんありますが、必ずしもこれら全てを使う必要はありません。

よく使うのは下記のディレクトリです。

- app
- app/action
- app/view
- template/ja\_JP

具体的なアプリケーションの作成については [アプリケーション構築手順(2)](ethna-document-tutorial-practice2.html "ethna-document-tutorial-practice2 (888d)")を御覧下さい。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
<!-- ??BEGIN id:trackback -->
<!-- ?? END id:trackback --><!-- ?? BEGIN id:attach -->

* * *
添付ファイル: [![file](image/file.png)sample.png](plugin=attach&pcmd=open&file=sample.png&refer=ethna-document-tutorial-practice1.html "2011/10/02 03:03:56 19.7KB") 21件[[詳細](plugin=attach&pcmd=info&file=sample.png&refer=ethna-document-tutorial-practice1.html "添付ファイルの情報")]
<!-- ?? END id:attach -->
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
