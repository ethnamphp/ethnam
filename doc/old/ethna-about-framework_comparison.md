# フレームワーク比較
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

# フレームワーク比較 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [概要](ethna-about.html) > フレームワーク比較 
## フレームワーク比較 [](ethna-about-framework_comparison.html#s2d223e7 "s2d223e7")

**[フレームワーク一覧](ethna-about-framework_comparison-list.html "ethna-about-framework\_comparison-list (1240d)")**

ちょっとずづ違うフレームワークが、それこそ星の数ほどあります。それぞれ特徴があり、どれがいいのか、どれを選んだらよいのか、なかなか難しいと思います。

ここでは、Ethnaを含め、次の5つのフレームワークについて、簡単な比較をしたいと思います(2006年4月現在)。これを読んで、Ethnaっていけてるじゃん!って思っていただければ幸いです。。。

- Ethna
- [PRADO](http://www.xisc.com/)
- [Ruby on Rails](http://www.rubyonrails.org/) (RoR)
- [symfony](http://www.symfony-project.com/)
- [Zend Framework](http://framework.zend.com/) (ZF)

## まとめの表 [](ethna-about-framework_comparison.html#kac47d09 "kac47d09")

| | Ethna | PRADO | RoR | symfony | ZF |
| 言語 | php4/5 | php5 | Ruby | php5 | php5 |
| ドキュメント | ○ | ○ | ◎ | ◎ | ○ |
| インストール | ○ | ○ | ○ | ○ | ○ |
| 必要な文法 | ◎ | △ | ◎ | △ | ◎ |
| ソースの読みやすさ | ◎ | △ | △ | △ | ○ |
| 使いやすさ | ○ | ○ | ◎ | ◎ | ○ |
| MVC | モデル | ○ | △ | ◎ | ◎ | ○ |
| ビュー | ○ | ○ | ○ | ○ | △ |
| コントローラ | ○ | △ | ○ | ○ | ○ |
| Webアプリ特有 | ajax | △ | ◎ | ◎ | ◎ | ○ |
| フォーム | ◎ | ○ | ○ | ○ | △ |
| セッション | ○ | ○ | ◎ | ◎ | △ |

## くわしい比較内容 [](ethna-about-framework_comparison.html#t54a060a "t54a060a")

### 言語 [](ethna-about-framework_comparison.html#language "language")

フレームワークで使用している言語は、実際にアプリケーション開発に用いる言語と同じものになることでしょう。

- RoR
  - その名のとおりRubyで作られたフレームワークであり、アプリケーションはRubyで書くことになります。

- Ethna
  - php4、php5の両方に対応しています。

- PRADO、symfony、ZF
  - php5のみに対応し、アクセス修飾や例外を利用したコードになっています。

### ドキュメント [](ethna-about-framework_comparison.html#document "document")

ドキュメント(サンプル、チュートリアル、APIリファレンスなど)の豊富さは、そのフレームワークのわかりやすさを決める重要なポイントとなります。

- symfony
  - 本家サイトのオンラインドキュメントで比較すると、symfonyがいちばんわかりやすいのではないでしょうか。サンプルごとにチュートリアルがあり、またマニュアルはキーワードから該当個所を見つけやすいと感じました。

- RoR
  - RoRも豊富なドキュメントがありますが、チュートリアルや分厚い本、HowToが多く、とりあえずこれだけ一通り読めば済む、というようなマニュアルが見当たりませんでした。

- ZF
  - 現時点ではプレビューの段階ですが、すでに日本語のドキュメントが整備されています。サンプルはまだほとんど用意されていないようです。

- PRADO
  - PRADOの重要な要素であるコンポーネントの説明が未完成だったり、日本語のページもあるものの未記入なページが多いようでした。

- Ethna
  - Ethnaについては、APIマニュアルはあるもののドキュメントの整備はこれから、というところです。もっとも、すべて日本語で書かれているので、日本のユーザにとっては読みやすいと思います。

### インストール [](ethna-about-framework_comparison.html#install "install")

フレームワークを使うにあたって同時に必要となるライブラリと、それも含めてインストールの簡単さを比較します。

- Ethna
  - PEARが必要になります。また、mysqlとsmartyの利用を前提としている部分がいくつかあります。Ethna本体はinclude\_pathに入っていればいいので、root権限の無い環境でもインストールしやすいと思います。

- ZF
  - 現時点ではデータベースの利用にPDOが必要なようですが、それ以外に必要なものは一切ないようです。

- RoR
  - rakeなど必要なものは多いですが、RubyGemsがインストールできればgemによって簡単にインストールできます。ユーザも多いため、インストールで困ることはあまり無いかもしれません。

- symfony
  - 依存するライブラリはcreole、pake、phing、propelと少し多めですが、PEARのコマンドでsymfonyといっしょにインストールすることができます。

- PRADO
  - データベースを利用するにあたって、ADODBが必要になります。

### 必要な文法 [](ethna-about-framework_comparison.html#syntax "syntax")

フレームワークの言語に従ってプログラムを書いていくほかに、テンプレートを書いたりデータベースの設定を書いたり、その言語以外に必要な文法について比較します。

- ZF
  - 現状php以外のものを書くことはないようです。

- Ethna
  - テンプレートを書くときにSmartyの知識が必要です。

- RoR
  - データベースの設定にyamlを使いますが、とても簡単です。'Convention over Configuration'と言われるとおり、設定ファイルを書くことはほとんどありません。

- symfony
  - propelの利用に際してyamlやxmlでの設定が必要な場合があります。アプリケーションの設定をするファイルが多く、迷いやすいと感じました。

- PRADO
  - アプリケーションの定義をapplication.specという名のxmlファイルで行う必要があります。あまり書きやすいとは言えないと思います。また、当然ながらコンポーネントをテンプレートに配置するために、コンポーネントをあらわすPRADO特有のタグを用いる必要があります。

### ソースコードの量と読みやすさ [](ethna-about-framework_comparison.html#sources "sources")

問題が発生したときにドキュメントを見ても解決しなければ、ソースコードを見たほうが早いことも多いでしょう。ここでは、フレームワーク自体のソースコードの量と読みやすさを比較します。

- Ethna
  - コードの量は少なく、全体を眺めるのもそれほど苦ではありません。もっとも、その分だけ始めからできることも少なくなりますが、すでにphpで(PEARのライブラリなどを用いて)開発を行っている方には、自分のやり方をそのまま適用できる、というメリットがあります。

- ZF
  - コードの量は少し多めですが、他のライブラリに依存することはほとんどありません。コード自体も「標準」と言ってよい記法になっており、読みやすいと思います。

- RoR
  - コードの量は多く、なにか問題があったときにソースを読むことで解決するにはかなりの慣れが必要だと思います。特に、このプロパティやメソッドはどこで定義されているのだろう？と迷ってしまうことがよくあります。

- symfony
  - symfony自体のコードの量はそれほど多くありません。コードも読みやすいと思います。ただし、インストールの項で触れたように、symfony本体でない部分のコードの量は相当な量があります。

- PRADO
  - コードの量は少し多めだと思います。明確なコーディング規約が適用されておらず、ちょっと読みにくい部分がありました。

### 使いやすさ [](ethna-about-framework_comparison.html#usability "usability")

ある程度の理解はできた上で、実際に使ってみるにあたり、拡張性やコードジェネレータについて比較します。

- Ethna
  - アプリケーション側にいったん基底クラスを作り、それを継承したクラスのインスタンスとしてほとんどのオブジェクトが使われるため、アプリケーションごとの拡張がとてもやりやすくなっています。
  - ある程度のコードジェネレータがありますが、基底クラスを継承して必要なメソッドを追加する程度は自分で書かなければならない場面があります。

- RoR
  - コードジェネレータが整備されており、新たに自分でファイルを作る場面はないといってもいいほどです。
  - ジェネレータはgemから多数取得することができます。
  - 一方、ジェネレータが用意されていないものに関しては、慣れないとどう作っていいのかなかなかわからないと思いました。

- symfony
  - RoR同様、コードジェネレータが整備されています。
  - yamlによる設定がたくさんあり、ちょっとした動作の変更は設定ファイルを修正するだけで済むことも多いですが、そのぶん設定ファイルの量はかなり多くなっています。

- ZF
  - コードジェネレータは現在のところ用意されていません。まだプレビューの段階ですが、アプリケーションのディレクトリ構造から自分で作らなければなりません。

- PRADO
  - コードジェネレータは用意されていません。PRADO本体に添付される豊富なサンプルを参考に、自分で書いていくことになるようです。

### MVC [](ethna-about-framework_comparison.html#mvc "mvc")

フレームワークにはそれぞれ期待する開発の方針があり、基本的にはそれに従うことでアプリケーションの開発を手助けしてくれるものです。特に、現在主流となっているMVC(Model-View-Controller)の考え方に沿っているかどうかで大きく区別できると考えられます。

この中で、PRADOを除く4つのフレームワークはMVCフレームワークと言ってよいでしょう。一方、PRADOはサイトのいちばん最初に

    PRADO is a component-based and event-driven framework for rapid Web programming in PHP 5.

と紹介されています。ページにコンポーネントを配置し、イベントを登録してゆく方針は、他のフレームワークとは大きく異なる特徴です。

#### モデル [](ethna-about-framework_comparison.html#model "model")

主に、データベースに由来するデータの取り扱いのしやすさについて比較します。

- RoR、symfony
  - ActiveRecord、propelにより、CRUDのscaffoldまで自動的に生成でき、取り扱いはとても簡単です。

- Ethna
  - AppObjectというActiveRecordのようなものがありますが、複数のテーブルを扱うことはまだ発展途上です。

- ZF
  - 現時点ではまだ未実装な部分がいくつかあり、なんとも言えませんでした。

- PRADO
  - そもそもMVCフレームワークではないので比較はできませんが、データベースを用いたサンプルでは、SQL文を直接書いたものしかありませんでした。

#### ビュー [](ethna-about-framework_comparison.html#view "view")

ビュー部分(テンプレート)の書きやすさについて比較します。

- Ethna
  - ビュークラスとSmartyによるテンプレートによってビューを構成します。表示にのみ必要な処理をアクションから分離しやすい構成になっています。
  - ヘルパーはまだありません。Smartyプラグインを使うための土台が用意されています。

- RoR、symfony
  - phpもしくはerubyで書いたテンプレートをアクションで暗黙もしくは明示的に指定します。
  - ヘルパーが多数用意されています。

- PRADO
  - コンポーネントを配置するための、独自のタグを用いたテンプレートを書きます。

- ZF
  - 基本的にはphpでテンプレートを書いてゆきます。フォームについてはヘルパーが用意されているようです。
  - 現時点では '<?php echo $this->escape($this->text); ?>' と書かなければならず、少し面倒なように思いました。

#### コントローラ [](ethna-about-framework_comparison.html#controller "controller")

あまり表に出ない部分ですが、気づいた点についていくつか挙げてゆきます。

- Ethna
  - CLIやxmlrpcといった複数のゲートウェイに対応しています。
  - ルーティングは、少しわかりにくいですが変更することができます。

- symfony
  - yamlの設定ファイルでルーティングが簡単に指定できます。
  - producion/development/test 環境の切り替えに対応しています。

- RoR
  - ルーティング機構やコンソールが用意されています。
  - producion/development/test 環境の切り替えに対応しています。

- ZF
  - ルーティング機構が用意されているようです。

- PRADO
  - application.specがコントローラに相当するのでしょうか...?

### ウェブアプリ特有の話 [](ethna-about-framework_comparison.html#webproper "webproper")

ウェブアプリ特有の話として

- ajaxのサポート
- フォームから得られたデータの扱い(validationやfilter)
- アクションをまたぐデータの受け渡し(セッション)の扱い について比較します。

#### ajax [](ethna-about-framework_comparison.html#ajax "ajax")

- PRADO
  - コンポーネントにイベントを登録してゆく、というPRADOの方針はajaxをやりたいならもっとも相性がいいと思います。

- RoR, symfony
  - prototype.jsのヘルパーと豊富なサンプルのおかげで非常に簡単にajaxを実現することができます。

- ZF
  - 現状はフレームワークとしてのサポートがまだ用意されていませんが、incubatorにそれらしいものが見られました。

- Ethna
  - 現在のところヘルパーがまだないため、実質的にテンプレートから自分で実装しなければならない状況です。

#### フォーム値 [](ethna-about-framework_comparison.html#formdata "formdata")

- Ethna
  - フォーム値を保持するActionFormクラスがあり、フォーム値のvalidation、filter処理を担当します。

- symfony
  - フォーム値はアクションからパラメータとして取得します。validatorとfilterは設定ファイル中で指定します。

- RoR
  - フォーム値はアクションからパラメータとして取得しますが、標準ではActiveRecordを利用したvalidation処理しか用意されていません。

- ZF
  - validatorとfilterをあわせたようなZend\_Filterクラスがあります。値の取得については、現時点では$\_POSTなどを直接参照するようなサンプルしかありませんが、incubatorにフォームエレメントのためのクラスが用意されているようです。

- PRADO
  - 他とは大きく異なり、フォーム値は直接コンポーネントが持つ値としてセットされます。validatorはコンポーネントに登録します。フィルタは手動でやらなければならないようです。

#### セッション [](ethna-about-framework_comparison.html#session "session")

- RoR, symfony
  - セッションの取り扱いは簡単であり、セッションを用いた"flash"という機構を使ってデータを次のアクションに渡すことができます。

- Ethna, PRADO
  - セッションを維持するクラスがあり、アクションから呼び出すことができます。

- ZF
  - 現状はフレームワークとしてのサポートはまだ用意されていないようです。

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
