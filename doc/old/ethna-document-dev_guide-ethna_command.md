<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
ethnaコマンドリファレンス - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# ethnaコマンドリファレンス 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > ethnaコマンドリファレンス 
## ethnaコマンドリファレンス [](ethna-document-dev_guide-ethna_command.html#m52a16d1 "m52a16d1")

[アプリケーション構築手順(1)](ethna-document-tutorial-practice1.html "ethna-document-tutorial-practice1 (23d)") のページにあるように、Ethna では、プロジェクトの作成から、作成されたプロジェクトに関わる様々な操作を ethna コマンドと呼ばれるコマンドラインから行えるようになっています。

ethna コマンドには様々なサブコマンドが用意されており、プロジェクトに対する様々な操作が行えます。このページでは、ethnaコマンドで出来ることをリファレンスとして紹介します。

- ethnaコマンドリファレンス 
  - プロジェクトの作成 
    - add-project コマンド 
  - アクション, ビューの追加など 
    - add-action コマンド 
    - add-view コマンド 
    - add-template コマンド 
    - add-entry-point コマンド 
  - アプリケーションオブジェクト、マネージャの追加 
    - add-app-manager コマンド 
    - add-app-object コマンド 
  - 国際化(i18n) 
    - i18n コマンド 
  - テストケースの追加 
    - テストケース追加に当たっての注意 
    - add-action-test コマンド 
    - add-view-test コマンド 
    - add-test コマンド 
  - PEAR パッケージ管理 
    - pear-local コマンド 
  - プラグイン関連 
    - list-plugin コマンド 
    - install-plugin, upgrade-plugin コマンド 
    - uninstall-plugin コマンド 
    - info-plugin コマンド 
    - channel-update コマンド 
    - make-plugin-package コマンド 
  - その他 
    - clear-cache コマンド 
- ethna コマンドを拡張する 
  - Ethna\_Handle について 

| いちい | - | 新規作成 |
| mumumu | 2008-07-30 | 最新の状態を反映 |
| DQNEO | 2010-05-23 | アクション名指定の際の大文字小文字の違いを解説 |

### プロジェクトの作成 [](ethna-document-dev_guide-ethna_command.html#mc36ad4e "mc36ad4e")

#### add-project コマンド [](ethna-document-dev_guide-ethna_command.html#d32de849 "d32de849")

    (使い方)
    $ ethna add-project [-b|--basedir=dir] [-s|--skeldir]
                        [-l|--locale] [-e|--encoding] [Application id]

プロジェクトと、それに付随する必須ファイルを自動生成します。作成しようとした先に、既に同名のプロジェクトが存在する場合は、不足しているファイルのみ作成されます。[Application id]（アプリケーションID) の指定が最低限必要です。

オプションは以下の通りです。

- [-b|--basedir]  

  - プロジェクトを作成するディレクトリを指定します。
  - ここで指定されたディレクトリ下に、[Application id] で指定されたディレクトリが作成されます。
  - デフォルトはカレントディレクトリです。
- [-s|--skeldir]  

  - Ethnaは自動生成されるファイルのスケルトンを持っており、それに基づきプロジェクトを生成します。このオプションでディレクトリを指定すると、そこにあるスケルトンファイルが優先されます。
  - ファイル名は Ethna本体の skelディレクトリ にあるものと同じでなければなりません。
  - このオプションはスケルトンを改造していた場合に有用です。
- [-l|--locale] (2.5.0 preview1以降)  

  - ロケール（言語や文化の規則)を指定します。
  - デフォルトはja\_JPです。
  - [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.html "ethna-document-dev\_guide-app-setlanguage (737d)") も参照して下さい
- [-e|--encoding] (2.5.0 preview1以降)  

  - プロジェクトで使用するエンコーディングを指定します。
  - デフォルトはUTF-8です。
  - [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.html "ethna-document-dev\_guide-app-setlanguage (737d)") も参照して下さい
- [Application ID]  

  - アプリケーションIDです。最低限これだけは指定して下さい。
  - 大文字小文字は区別されません。
  - 自動生成されるファイルの都合上、先頭に数値を指定してはいけません。

### アクション, ビューの追加など [](ethna-document-dev_guide-ethna_command.html#sf73f4c9 "sf73f4c9")

#### add-action コマンド [](ethna-document-dev_guide-ethna_command.html#if0ed86e "if0ed86e")

    (使い方)
    $ ethna add-action [-b|--basedir=dir] [-s|--skelfile=file] 
                       [-g|--gateway=www|cli|xmlrpc] [-w|--with-unittest]    
                       [-u|--unittestskel=file] [action]

アクションをプロジェクトに追加します。オプションは以下の通りです。

- [-b|--basedir]  

  - アクションを追加したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-s|--skelfile=file]  

  - アクションファイルを生成する元となるスケルトンファイルを指定します。相対／絶対パスが指定できます。
  - 指定されたファイルが見つからないときはアプリケーションのskelディレクトリ、Ethna本体のskelディレクトリを順に探します。
  - 省略時は、gatewayの指定に従い、プロジェクトのskel/skel.{action,actio\_cli,action\_xmlrpc}.phpが使われます。
  - このオプションはスケルトンを改造していた場合に有用です。
- [-g|--gateway=www|cli|xmlrpc]  

  - アクションのゲートウェイを指定します。
  - それぞれaction, action\_cli,action\_xmlrpcディレクトリの下にアクションが追加されます。
  - 省略時は www が指定されたものとみなされます。
- [-w|--with-unittest] (2.3.5 以降)  

  - ユニットテストファイルを同時に生成します。
  - add-action-test を同時に実行したことと同じです。
- [-u|--unittestskel=file] (2.3.5 以降)  

  - ユニットテストファイルを作るときのスケルトンを指定します。
  - -w オプションが指定されない場合は、このオプションは無視されます。
- [action]  

  - アクション名を指定します。最低限これだけは指定して下さい。

- 【補足１】"add-action Foo\_Bar"と "add-action foo\_bar"の違い
  - 生成されるファイル名・クラス名は同じです。
  - performのreturn値は異なります。( 'Foo\_Bar' と 'foo\_bar' )
  - どちらの形式でも可能ですが、add-view, add-templateする際は、同じ形式で入力する必要があります。

- 【補足２】"add-action Foo\_Bar"と "add-action FooBar"の違い
  - 生成されるファイル名は異なります。( 'Foo/Bar.php' と 'FooBar.php' )
  - 生成されるクラス名は同じです。
  - performのreturn値は異なります。( 'Foo\_Bar' と 'FooBar' )

#### add-view コマンド [](ethna-document-dev_guide-ethna_command.html#db9ba91d "db9ba91d")

    (使い方)
    $ ethna add-view [-b|--basedir=dir] [-s|--skelfile=file]
                     [-w|--with-unittest] [-u|--unittestskel=file]
                     [-t|--template] [-l|--locale] [-e|--encoding] [view]

ビューをプロジェクトに追加します。オプションは以下の通りです。

- [-b|--basedir]  

  - ビューを追加したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-s|--skelfile=file]  

  - ビューファイルを生成する元となるスケルトンファイルを指定します。相対／絶対パスが指定できます。
  - 指定されたファイルが見つからないときはアプリケーションのskelディレクトリ、Ethna本体のskelディレクトリを順に探します。
  - このオプションはスケルトンを改造していた場合に有用です。
- [-t|--template]  

  - ビューと同じ名前のテンプレートを追加します。add-templateを同時に実行したのと同じです。
- [-w|--with-unittest] (2.3.5 以降)  

  - ユニットテストファイルを同時に生成します。add-view-test を同時に実行したことと同じです。
  - -t オプション を指定した場合は、この指定は無視されます。
- [-u|--unittestskel=file] (2.3.5 以降)  

  - ユニットテストファイルを作るときのスケルトンファイルを指定します。
  - -t オプション を指定した場合は、この指定は無視されます。
- [-l|--locale] (2.5.0 preview1以降)  

  - ロケール（言語や文化の規則)を指定します。
  - デフォルトはja\_JPです。
  - これにより、プロジェクトのテンプレートディレクトリ以下に、指定したロケール名のディ  
レクトリが作られます。
  - -t オプションを指定したときのみ意味を持ちます。
  - [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.html "ethna-document-dev\_guide-app-setlanguage (737d)") も参照して下さい
- [-e|--encoding] (2.5.0 preview1以降)  

  - プロジェクトで使用するエンコーディングを指定します。
  - デフォルトはUTF-8です。
  - meta タグで指定するエンコーディングを指定する意味しかありません。
  - -t オプションを指定したときのみ意味を持ちます。
- [view]
  - 追加したいビュー名を指定します。最低これだけは指定して下さい。

- 【補足１】"add-view Foo\_Bar"と "add-view foo\_bar"の違い
  - 挙動は全く同じです。ただし、-tオプションをつけると、tplファイル名が異なります。（後述)

- 【補足２】"add-view Foo\_Bar"と "add-view FooBar"の違い
  - 生成されるファイル名は異なります。( 'Foo/Bar.php' と 'FooBar.php' )
  - 生成されるクラス名は同じです。

#### add-template コマンド [](ethna-document-dev_guide-ethna_command.html#j8da82ec "j8da82ec")

    (使い方)
    $ ethna add-template [-b|--basedir=dir] [-s|--skelfile=file]
                         [-l|--locale] [-e|--encoding] [template]

テンプレートファイルを追加します。オプションは以下の通りです。

- [-b|--basedir]  

  - テンプレートファイルを追加したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-s|--skelfile=file]  
テンプレートファイルを生成する元となるスケルトンファイルを指定します。相対／絶対パスが指定できます。
  - 指定されたファイルが見つからないときはアプリケーションのskelディレクトリ、Ethna本体のskelディレクトリを順に探します。
  - このオプションはスケルトンを改造していた場合に有用です。
- [-l|--locale] (2.5.0 preview1以降)  
ロケール（言語や文化の規則)を指定します。
  - デフォルトはja\_JPです。
  - これにより、プロジェクトのテンプレートディレクトリ以下に、指定したロケール名のディ  
レクトリが作られます。
  - [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.html "ethna-document-dev\_guide-app-setlanguage (737d)") も参照して下さい
- [-e|--encoding] (2.5.0 preview1以降)  
プロジェクトで使用するエンコーディングを指定します。
  - デフォルトはUTF-8です。
  - meta タグで指定するエンコーディングを指定する意味しかありません。
- [template]
  - 追加したいテンプレート名を指定します。最低これだけは指定して下さい。

- 【補足】"add-template Foo\_Bar"と "add-template foo\_bar"の違い
  - 生成されるファイル名は異なります。( 'Foo\_Bar' と 'foo\_bar' )
  - アクションクラスのprepare/performが返す文字列と完全一致している必要があります。

#### add-entry-point コマンド [](ethna-document-dev_guide-ethna_command.html#z12d56c0 "z12d56c0")

    (使い方)
    $ ethna add-entry-point [-b|--basedir=dir] [-s|--skelfile=file]
                            [-g|--gateway=www|cli] [action]

エントリポイントと対応するアクションを追加します。エントリポイントは、wwwディレクトリに置かれ、コントローラーを呼び出す役割を果たします。

オプションは以下の通りです。

- [-b|--basedir]  

  - エントリポイントを追加したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-s|--skelfile=file]  

  - エントリポイントを生成する元となるスケルトンファイルを指定します。相対／絶対パスが指定できます。
  - 指定されたファイルが見つからないときはアプリケーションのskelディレクトリ、Ethna本体のskelディレクトリを順に探します。
  - このオプションはスケルトンを改造していた場合に有用です。
- [-g|--gateway=www|cli]  
アクションのゲートウェイを指定します。
  - それぞれaction, action\_cli ディレクトリの下にアクションが追加されます。
  - 省略時は www が指定されたものとみなされます。
- [action]  
追加したいエントリポイントで起動するアクション名を指定します。
  - 例えばgatewayにwww を指定した状態で "admin" を指定すると、エントリポイントとしてadmin.phpが作られ、続けてadminアクションが追加されます。

### アプリケーションオブジェクト、マネージャの追加 [](ethna-document-dev_guide-ethna_command.html#g5817598 "g5817598")

#### add-app-manager コマンド [](ethna-document-dev_guide-ethna_command.html#b9587b84 "b9587b84")

    (使い方)
    $ ethna add-app-manager [-b|--basedir=dir] [app-manager name]

アプリケーションマネージャを追加します。オプションは以下の通りです。

- [-b|--basedir]  

  - アプリケーションマネージャを追加したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- (現在のところskelfileを指定することはできません。)
- [app-manager name]  

  - アプリケーションマネージャ−名。最低これだけは指定して下さい。

#### add-app-object コマンド [](ethna-document-dev_guide-ethna_command.html#vfc12644 "vfc12644")

    (使い方)
    $ ethna add-app-object [-b|--basedir=dir] [table name]

アプリケーションオブジェクトを追加します。データベースのテーブル名を指定することで、スキーマ定義などを自動的に取得することができます

- [-b|--basedir]
  - アプリケーションオブジェクトを追加したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- (現在のところskelfileを指定することはできません。)
- [table name]
  - 最低限これだけは指定して下さい
  - データベースのテーブル名を指定することで、スキーマ定義などを自動的に取得することができます
  - 必ずしもテーブル名である必要はありません。

### 国際化(i18n) [](ethna-document-dev_guide-ethna_command.html#vd9b3c8f "vd9b3c8f")

#### i18n コマンド [](ethna-document-dev_guide-ethna_command.html#x5983a2e "x5983a2e")

    この機能を使うには、Ethna 2.5.0 preview2 以降が必要です

    (使い方)
    $ ethna i18n [-b|--basedir=dir] [-l|--locale=locale] [-g|--gettext] [extdir1] ...

プロジェクト内部のPHPスクリプト(テストスクリプトは除く)、テンプレートファイルを全て調べ、翻訳の対象となるメッセージを全て抜きだし、メッセージカタログの雛形を自動生成します。 実際に調べられ、抜き出されるメッセージは、以下の部分が対象になります\*1

    1. app ディレクトリ内のPHPスクリプトの、_et 関数の呼び出し箇所全て
    2. app ディレクトリ内の ActionForm のフォーム定義のうち、以下の部分
      a) name
      b) required_error
      c) type_error
      d) min_error
      e) max_error
      f) regexp_error
    3. template ディレクトリ内の、i18n修正子の呼び出し箇所全て

既に[ini|po]ファイルが存在していた場合、iniファイル(デフォルト) の場合は 自動的に既にある翻訳をマージしてファイルを上書きします。gettext([-g|--gettext] を指定)の場合は、別に新しいファイルを作成し、古いファイルはそのままにします。

コマンドのオプションは以下の通りです。

- [-b|--basedir=dir]
  - プロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-l|--locale=locale]
  - 生成したいカタログのロケールを指定します。
  - デフォルトは ja\_JP です。
  - 実際のカタログは [appid]/locale/[指定したロケール名]/LC\_MESSAGES/[指定したロケール名].[ini|po] に作られます。デフォルトでは ini ファイルが生成されます。
- [-g|--gettext]
  - gettext を使う場合、このオプションを指定します。
  - このオプションを指定すると、デフォルトの iniファイルではなく、po ファイルが自動生成されます。
  - 生成された po ファイルに対して、xgettext や msgmerge コマンドを使用して mo ファイルを生成するのはユーザの責任です。
- [extdir1] [extdir2] ...
  - デフォルトでは プロジェクト内の app ディレクトリ内と、templateディレクトリしか調べられませんが、任意のディレクトリをコマンドの最後に追加できます。
  - ここで指定したディレクトリ内のファイルは、PHPスクリプトの \_et 関数の呼び出ししか解釈されません

### テストケースの追加 [](ethna-document-dev_guide-ethna_command.html#b74a7844 "b74a7844")

#### テストケース追加に当たっての注意 [](ethna-document-dev_guide-ethna_command.html#eabd1343 "eabd1343")

Ethna 2.3.5 以降では、作成したテストはデフォルトで失敗するようになっています。要するに「作った以上、テストを書いて下さいネ」ということです。

#### add-action-test コマンド [](ethna-document-dev_guide-ethna_command.html#bfd9c83f "bfd9c83f")

    (使い方)
    $ ethna add-action-test [-b|--basedir=dir] [-s|--skelfile=file] [action]

指定されたアクションのテストスクリプトを追加します。  
対応するアクションがまだ作成されていない場合には警告が生成されるので注意して下さい。

オプションは以下の通りです。

- [-b|--basedir]
  - アクションのテストを追加したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-s|--skelfile=file]
  - アクションのテストを生成する元となるスケルトンファイルを指定します。相対／絶対パスが指定できます。
  - 指定されたファイルが見つからないときはアプリケーションのskelディレクトリ、Ethna本体のskelディレクトリを順に探します。
  - このオプションはスケルトンを改造していた場合に有用です。
- [action]
  - 作成するテストのアクション名を指定します。最低これだけは指定して下さい。

#### add-view-test コマンド [](ethna-document-dev_guide-ethna_command.html#wf6361bb "wf6361bb")

    (使い方)
    $ ethna add-view-test [-b|--basedir=dir] [-s|--skelfile=file] [view]

指定されたビューのテストスクリプトを追加します。  
対応するビューがまだ作成されていない場合には警告が生成されるので注意して下さい。

オプションは以下の通りです。

- [-b|--basedir]
  - ビューのテストを追加したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-s|--skelfile=file]
  - ビューのテストを生成する元となるスケルトンファイルを指定します。相対／絶対パスが指定できます。
  - 指定されたファイルが見つからないときはアプリケーションのskelディレクトリ、Ethna本体のskelディレクトリを順に探します。
  - このオプションはスケルトンを改造していた場合に有用です。
- [view]
  - 作成するテストのビュー名を指定します。最低これだけは指定して下さい。

#### add-test コマンド [](ethna-document-dev_guide-ethna_command.html#jef6edfc "jef6edfc")

    (使い方)
    $ ethna add-test [-b|--basedir=dir] [-s|--skelfile=file] [name]

一般的なテストスクリプトを追加します。アプリケーションマネージャー等、アクションやビュー以外のテストケース作成に使います。

オプションは以下の通りです。

- [-b|--basedir]
  - テストを追加したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-s|--skelfile=file]
  - テストを生成する元となるスケルトンファイルを指定します。相対／絶対パスが指定できます。
  - 指定されたファイルが見つからないときはアプリケーションのskelディレクトリ、Ethna本体のskelディレクトリを順に探します。
  - このオプションはスケルトンを改造していた場合に有用です。
- [name]
  - 作成するテスト名を指定します。最低これだけは指定して下さい。

### PEAR パッケージ管理 [](ethna-document-dev_guide-ethna_command.html#b32e4f9a "b32e4f9a")

#### pear-local コマンド [](ethna-document-dev_guide-ethna_command.html#p0e29fbe "p0e29fbe")

    (使い方)
    $ ethna pear-local [-c|--channel=channel] [-b|--basedir=dir] [pear command ...]

pearコマンド と全く同じ操作で、プロジェクト内でPEARパッケージを楽に管理できます。  
詳細は、 [Ethnaプロジェクト内で PEAR パッケージを管理する](ethna-document-dev_guide-pearlocal.html "ethna-document-dev\_guide-pearlocal (858d)") を参照して下さい。

オプションは以下の通りです。

- [-c|--channel=channel]
  - PEARチャンネル名を指定します。ここで指定したチャンネルのパッケージが操作対象になります。
  - デフォルトは pear.php.net です。
- [-b|--basedir]
  - PEARパッケージを追加、管理したいプロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [pear command ...]
  - pearコマンド と同様のオプションやパッケージ名を指定します
  - [Ethnaプロジェクト内で PEAR パッケージを管理する](ethna-document-dev_guide-pearlocal.html "ethna-document-dev\_guide-pearlocal (858d)") も参照して下さい。

### プラグイン関連 [](ethna-document-dev_guide-ethna_command.html#a5b6aa6b "a5b6aa6b")

おもにプラグインのパッケージを扱うハンドラです。

    警告！：--channel=channelの指定はまだ不完全です!!

#### list-plugin コマンド [](ethna-document-dev_guide-ethna_command.html#ce163f85 "ce163f85")

    (使用例)
    $ ethna list-plugin [-c|--channel=channel] [-b|--basedir=dir] 　　　 
                        [-l|--local] [-m|--master]
                        [-t|--type=type] [-v|--verbose]

プラグインの一覧を表示します。パッケージでインストールされたものはpackageの列にパッケージ名が表示されます。

- [-l|--local], [-m|--master]
  - local, masterどちらのプラグインを表示するかを切替えます。  
local/master の違いは [プラグインの説明](ethna-document-dev_guide-plugin.html "ethna-document-dev\_guide-plugin (737d)")を参照してください。
  - 省略時はlocalが指定されたとみなされます。
- [-b|--basedir]
  - プロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-t|--type]
  - 表示するプラグインの$typeを指定できます。
- [-v|--verbose]
  - バージョン情報などが表示されます。かなり横に長いです。

#### install-plugin, upgrade-plugin コマンド [](ethna-document-dev_guide-ethna_command.html#b1531846 "b1531846")

    (使い方)
    $ ethna install-plugin [-c|--channel=channel] [-b|--basedir=dir]
                           [-l|--local] [-m|--master]
                           [type name|packagefile|packageurl]
    $ ethna upgrade-plugin [-c|--channel=channel] [-b|--basedir=dir]
                           [-l|--local] [-m|--master]
                           [type name|packagefile|packageurl]

    (使用例その1)
    pear.ethna.jpからHoge_Fugaプラグインのパッケージをインストールする
    $ ethna install-plugin -l Hoge Fuga
    (使用例その2)
    指定されたtgzファイルからEthna本体のプラグインをアップグレードする
    $ ethna upgrade-plugin -m http://pear.ethna.jp/get/Ethna_Plugin_Hoge_Fuga-0.0.1.tgz

プラグインをパッケージからインストール、アップグレードします。pearコマンドのinstall、upgradeと似たような動作をします。

- [-l|--local], [-m|--master]
  - list-pluginと同様です。
- [-b|--basedir]
  - プロジェクトのあるディレクトリを指定します。
  - 省略時は、現在のディレクトリから親ディレクトリをたどってプロジェクトを自動的に探索します。
- [-s|--state]
  - パッケージの状態(stable, alpha, beta)を指定できます。

#### uninstall-plugin コマンド [](ethna-document-dev_guide-ethna_command.html#gb320c18 "gb320c18")

    (使い方)
    $ ethna uninstall-plugin [-c|--channel=channel] [-b|--basedir=dir]
                             [-l|--local] [-m|--master] [type name]

パッケージでインストールされたプラグインをアンインストールします。

インストールしたファイルをローカルで編集していても問答無用で消しますので注意してください。

#### info-plugin コマンド [](ethna-document-dev_guide-ethna_command.html#k2f32fc9 "k2f32fc9")

    $ ethna info-plugin [-c|--channel=channel] [-b|--basedir=dir]
                        [-l|--local] [-m|--master] [type name]

パッケージでインストールされたプラグインのパッケージ情報を表示します。 pear info [パッケージ名] と同様です。

#### channel-update コマンド [](ethna-document-dev_guide-ethna_command.html#y9141b9a "y9141b9a")

    $ ethna channel-update [-c|--channel=channel] [-b|--basedir=dir]
                           [-l|--local] [-m|--master]

Ethnaのパッケージをダウンロードするpear channelの情報をアップデートします。 pear channel-update pear.ethna.jp とほぼ同様です。

#### make-plugin-package コマンド [](ethna-document-dev_guide-ethna_command.html#q2220b86 "q2220b86")

    (使い方)
    $ ethna make-plugin-package [-i|--inifile=file] [-s|--skelfile=file]
                                [-w|--workdir=dir]

プラグインのパッケージを作ります。詳しくは [プラグインのパッケージを作る](ethna-document-dev_guide-pearpackage.html#k085db20 "ethna-document-dev\_guide-pearpackage (856d)")を参照してください。 このコマンドを使うには、 [PEAR\_PackageFileManager](http://pear.php.net/manual/ja/package.pear.pear-packagefilemanager.php) がインストールされている必要があります。

- [-i|--inifile]
  - パッケージの情報ファイル(ini形式)を指定します。
- [-s|--skelfile]
  - プラグインのスケルトンファイルを指定します。
- [-w|--workdir]
  - 作業ディレクトリを指定します。省略時はカレントディレクトリです。

### その他 [](ethna-document-dev_guide-ethna_command.html#ua07194f "ua07194f")

#### clear-cache コマンド [](ethna-document-dev_guide-ethna_command.html#bf398ab9 "bf398ab9")

    (使い方)
    $ ethna clear-cache [-b|--basedir=dir] [-a|--any-tmp-files]
                        [-s|--smarty] [-p|--pear] [-c|--cachemanager]

アプリケーションのキャッシュファイルを削除します。

- [-s|--smarty]
  - smartyのキャッシュ、コンパイル済みファイルを削除
- [-c|--cachemanager]
  - Cachemanager\_Localfileが作るキャッシュファイルを削除します。デフォルトではアプリケーションの tmp/.cache/ 以下のファイルです。
- [-p|--pear]
  - ethnaコマンドで使っているpearチャンネル関連のキャッシュを削除します。
- [-a|--any-tmp-files]
  - アプリケーションの tmp/ 以下のファイルをすべて削除します。

## ethna コマンドを拡張する [](ethna-document-dev_guide-ethna_command.html#c18670c0 "c18670c0")

ethna で指定できる各コマンドは Ethna\_Plugin\_Handle\_\* プラグインで作られています。プラグインはアプリケーション固有のものもありますが、現在のところ ethna コマンド用 のプラグインはEthna本体のものしか使えません。

### Ethna\_Handle について [](ethna-document-dev_guide-ethna_command.html#qd450599 "qd450599")

Ethna\_Handleはコントローラから独立したクラスです。ethnaコマンドが実行されてまずインスタンスが作られます。Ethna\_Handleのコンストラクタ内でようやくEthna\_Controllerのインスタンスが作られます。

Ethna本体のディレクトリやアプリケーションのディレクトリに何か指示をするときは、いったん以下のメソッドで各コントローラを取得し、$ctl->getDirectory('tmp')とかするといいと思います。

- getEthnaController()
  - Ethna\_Controllerのインスタンスを取得します。これはEthna本体のEthna\_Controller.phpで定義されたEthna\_Controllerそのものです。
- getAppController($app\_dir)
  - 指定されたディレクトリからアプリケーションのコントローラをさがし、そのインスタンスを返します。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1フォーム定義を調べるのは、フォーム定義はメンバ変数であり、その初期化は定数でなければならないことから、これを関数定義の戻り値で初期化するとFATAL ERRORになるためです  

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
