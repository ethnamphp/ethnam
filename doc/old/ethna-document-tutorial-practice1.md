# アプリケーション構築手順(1)
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
