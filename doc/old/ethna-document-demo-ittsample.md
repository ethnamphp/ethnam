<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
Ethnaでアプリを作ってみましょう。 - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# Ethnaでアプリを作ってみましょう。 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body -->
## Ethnaでアプリを作ってみましょう。 [](ethna-document-demo-ittsample.html#a05423aa "a05423aa")

* * *

書いた人：itoh@ [http://www.itt-web.net/bwiki/index.html](http://www.itt-web.net/bwiki/index.html) [サンプルダウンロード](http://www.itt-web.net/modules/bwiki/index.php?plugin=attach&pcmd=open&file=ittsample.tar.gz&refer=B-wiki%20Top)

* * *

私がEthnaで実際にアプリを作る時にこうやるなーって現時点での感じです。サンプルもダウンロードで来ます。表示はWindows風味になっていますがもちろんUnix系でも問題ないです。

今回は、ニュース更新スクリプトを書きます。要件は

- 表画面から新着順にニュースが表示される
- 管理画面からニュースの編集が出来る
- 公開日時と掲載終了日時を設定できて、その期間のみ表示

- Ethnaでアプリを作ってみましょう。 
  - プロジェクトを作る 
  - ライブラリを整える 
  - DB設計をして、DB設定をして、AppObjectを作成してマネージャに登録 
  - アクションの追加 
    - アクションフォームの追加 
  - テンプレートの作成 
  - とりあえず、チェック 
  - 次のアクションに繋げる 
  - Doのアクションは前のアクションを引き継ぐ 
  - Doのアクションの具体的処理 
  - exportFormを使う 
  - 表で一覧を出す 
  - Managerの仕事 
  - authenticateメソッドで権限管理 
  - エントリポイントの変更 

### プロジェクトを作る [](ethna-document-demo-ittsample.html#sa188223 "sa188223")

適当なところに作ります。

    C:\...\Ethna\bin>php generate_project_skelton.php ittsample sample1

最初、適当なところに作ってしまっても移動させる際には、あとでエントリポイント(index.php)をの2行目のincludeのパスをちゃんと設定すれば問題ありません。

### ライブラリを整える [](ethna-document-demo-ittsample.html#e8304b4e "e8304b4e")

Ethnaアプリがが必要とするライブラリを整えます。include\_pathに置けばいいのですが、私はEthnaアプリのlibに入れています。つまり今回の場合だと、sample1/libになります。入れるのは

- Ethna本体
- Smarty
- PEAR::DB

です。

### DB設計をして、DB設定をして、AppObjectを作成してマネージャに登録 [](ethna-document-demo-ittsample.html#g4821d12 "g4821d12")

AppObject生成スクリプトがあるので、DBテーブルを先に作っておきます。使ったSQLはschema/に入れておきます。今回は、ethna\_sampleというDBにsample1\_newsというテーブルを作りました。

DB設定は、DSNをsample1/etc/sample1-ini.phpに記述します。

    'dsn' => 'mysql://mysqluserid:mysqluserpassword@mysqlhostname/mysqldbname' ,

という感じです。

で、AppObjectを作ります。sample1/bin/にディレクトリ移動して

    C:\...\sample1\bin>php generate_app_object.php sample1_news

でオッケーです。この時、AppManagerとAppObjectを記述したファイルはsample1/libにできるのですが、私はlibには「PEARなど汎用的なもの」を入れることにしているんので、sample1/appに移動させています。

できたSample1\_Sample1Newsクラスには、auto\_incrementな要素に

    seq => true ,

を入れておきます。また、今後のアクションの追加でActionClassで簡単に使えるようにするために、Sample1\_ControllerにManagerを登録しておきます。また、また、Sample\_Controller.phpにこのマネージャクラスのファイルをincludeさせる必要があります。sample1/app/Sample1\_Controller.phpに

    include_once 'Sample1_Sample1News.php' ;
    class Sample1_Controller extends Ethna_Controller
    {
    ........
    	 *	@var	array	マネージャ一覧
    	 */
    	var $manager = array(
    						 'news' => 'Sample1News' )}

としておきます。

### アクションの追加 [](ethna-document-demo-ittsample.html#i42bdd2d "i42bdd2d")

私はデータを入れたいので管理画面から作ります。で、ActionClassを作ります。sample1/bin/にディレクトリ移動して

    C:\...\sample1\bin>php generate_action_script.php admin_news

とすると、sample1/app/action/Admin/News.phpが出来ています。

#### アクションフォームの追加 [](ethna-document-demo-ittsample.html#z459d3a4 "z459d3a4")

このファイルのアクションフォームクラスのSample1\_Form\_AdminNewsに、表画面で作りたいフォーム要素のプロパティを登録します。詳しくは、ダウンロードサンプルをご覧下さい。

### テンプレートの作成 [](ethna-document-demo-ittsample.html#zd8fe531 "zd8fe531")

ここまで追加したら、デフォルトでは、sample1/tempates/ja/admin/news.tplが必要になります。ここに、先ほどActionFormに追加したフォーム要素を具体的にデザイン配置していきます。 この時、一つ一つ

    <input type="text" name="n_title" value="{$form.n_title}" size="20" id="n_title">

とか書いてもいいのですが、typeとかnameとかvalueの属性はActionFormで定義されているものです。そこで、Smartyプレースホルダを使います。Smarty関数を登録するだけです。藤本さんのサンプルを拡張したものがあるので、それをsample1/appディレクトリに置き、Sample1\_Controllerクラスでincludeさせます。また、このSmarty関数をSample1\_Controllerクラス内の所定の場所で登録します。

    include_once('Sample1_SmartyPlugin.php');
    ....
    	/**
    	 *	@var	array	smarty function定義
    	 */
    	var $smarty_function_plugin = array(
       		'smarty_function_form_name',
       		'smarty_function_form_input',
    			);

これを登録することで、テンプレート中で、

    {form_input name="n_title" attr=" size='20' id='n_title' "}

とすることで、先ほどのタグと同じ効果が得られます。

テキストフォームではあまり効果がありませんが、一番強力なのはセレクトタブの選択タブを自動作成する時に便利です。ActionClassのコンストラクタでセレクトタブのオプションを動的に定義したりするときには必須です。

### とりあえず、チェック [](ethna-document-demo-ittsample.html#zb854a9f "zb854a9f")

ココまできたら、とりあえずチェックします。sample1/www/index.phpをコピーして、自分の好きなDocumentRootのところにもって行ってください。ダウンロードサンプルではpublic\_html/sample1/index.phpとしました。それがSample1\_Controller.phpを適切にincludeできるようにパスを調整する必要があります。ダウンロードサンプルの場合は、

    include_once('../../include/sample1/app/Sample1_Controller.php');
    Sample1_Controller::main('Sample1_Controller', 'index');

となっています。このindex.phpにアクセスして表示されるかどうかチェックします。

    http://localhost/ittsample/public_html/sample1/

ではEthnaデフォルトのIndexページなので、先ほど作ったActionClassを呼ぶには

    http://localhost/ittsample/public_html/sample1/?action_admin_news=1

とします。

### 次のアクションに繋げる [](ethna-document-demo-ittsample.html#ca194f70 "ca194f70")

テンプレートに

    <form action="" method="POST">
    <input type="hidden" name="action_admin_news_do" value="1">

と書くことで、次のアクションを決めます。\*1

そこで、

    C:\...\sample1\bin>php generate_action_script.php admin_news_do

として、ActionClass/ActionFormのスクリプトを追加します。

### Doのアクションは前のアクションを引き継ぐ [](ethna-document-demo-ittsample.html#h8e0f956 "h8e0f956")

Doのアクションを定義する際には、前のアクションがあっての事なので、前のアクションを継承するように作った方が何かと便利なことが多いです。 コード的にはActionFormを

    require_once dirname( __FILE__ ).'.php'
    class Sample1_Form_AdminNewsDo extends Sample1_Form_AdminNews
    {
    }

として、前のアクションの完全なコピーに。ActionClassも

    class Sample1_Action_AdminNewsDo extends Sample1_Action_AdminNews
    {
    	function Sample1_Action_AdminNewsDo(&$ctl){
    		parent::Sample1_Action_AdminNews(&$ctl);
    	}
    ....
    }

としてやることで、ActionFormの定義を二度書きせずに済みます。

### Doのアクションの具体的処理 [](ethna-document-demo-ittsample.html#qe87437f "qe87437f")

[Ethnaのチュートリアルにもあるように](ethna-tutorial-startup-practice3.html)、prepareメソッドでフォーム値のチェックを行い、performで実働処理をします。

performでの処理は、AppObjectを使うことで極めて簡単に処理できます。 具体的処理は、ソースを見てもらうとして、ポイントは、

- データのプライマリIDがあればUPDATE処理、無ければADD処理
- importFormを継承してそのオブジェクトに適した形にする かなと思います。後者は、Sample1\_Sample1Newsクラスを見てみてください。Formから投稿された時点では「公開日」「掲載終了日」は文字列ですからunixtimestampに直してからimportFormしてやる必要があります。

### exportFormを使う [](ethna-document-demo-ittsample.html#obb26ec0 "obb26ec0")

逆に、投稿した記事を編集したい場合は、

    http://localhost/ittsample/public_html/sample1/?action_admin_news=1&nid=3

とかにアクセスします。それだけだと、フォームの中身は空のままなので、ActionFormにnid=3の時の値を入れてやります。そのメソッドがexportFormです。

Sample1\_Sample1AdminNews::prepare()で、AppObjectを取得して行います。\*2

    if($this->af->get('nid')){
       $news =& new Sample1_Sample1News(&$this->backend, array('nid'), array($this->af->get('nid')));
       $news->exportForm();
    }

だけです。スゴくお手軽ですね。 ただし、この時「公開日」「掲載終了日」はunixtimestampから文字列に直してからexportFormしてやる必要があります。

### 表で一覧を出す [](ethna-document-demo-ittsample.html#aed9f51f "aed9f51f")

これでデータが投稿できるようになったので、表面で一覧を出します。

    C:\...\sample1\bin>php generate_action_script.php news

で、sample1/app/action/News.phpを編集します。表面では、フォームは必要ないので特に定義しません。その代わり、投稿されたニュースを複数持ってくるという作業が必要になります。これは、Sample1\_Sample1News::perform()メソッドで行います

ただし、ActionClassではあくまでActionだけを書きたいので、実際の処理はManagerに任せます。そのため、performには

    $news = $this->news->getValidNews();
    $this->af->setApp('news', $news);

とだけ書いて、テンプレート側に値を渡してやるだけになります。\*3

### Managerの仕事 [](ethna-document-demo-ittsample.html#xc1660db "xc1660db")

ActionClassは「状態の遷移を決めるだけ」ということにしたいので、面倒な処理はManagerクラスに任せます。実は、Manager\*4に任せると、データキャッシュを行っているので、ActionClassで状態の遷移を決めるために取得した値は、ViewClassでテンプレートに渡したい値だった場合にはDBに再問い合わせをせずに済みます。ただし、もちろん「同じQUERYになる場合」です。

### authenticateメソッドで権限管理 [](ethna-document-demo-ittsample.html#wa067f45 "wa067f45")

普通、管理者でないと投稿や投稿記事の編集はできません。EthnaではActionClassのauthenticateメソッドを使うことで楽に権限管理ができます。今回は、権限管理として簡単にBasic認証を使ったと仮定します。./adminディレクトリには、Basic認証がかかってるとします。

### エントリポイントの変更 [](ethna-document-demo-ittsample.html#e5251175 "e5251175")

./admin/index.phpにエントリポイントを変更します。もともと2行だけのエントリポイントなので特に苦労することはありませんが、

    Sample1_Controller::main('Sample1_Controller', 'admin_news');

としておくと、ここにアクセスした時に、デフォルトのアクションがadmin\_newsとなり便利です。

そして、Sample1\_Action\_AdminNewsクラスのauthenticateメソッドを

    function authenticate(){
    		if(!preg_match('/admin/', $_SERVER['SCRIPT_NAME'])){
    			exit();
    		}
    	}

としてやります。こうすることで、さきほどのエントリポイントからはアクセスが出来なくなります。なお、admin\_news\_doアクションにも自動的にこのauthenticateが引き継がれます。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1最初は私も違和感を感じたのですが、慣れるとこの方法がとてもコントローラブルなものであることに気が付きました。  
\*2別にperformでも良いですけど。  
\*3実は、この「テンプレートに値を渡す」というのはViewクラスの仕事になります。ActionClassはあくまでどのテンプレートに辿り着くか(つまりどのViewに辿り着くか)の遷移を把握しておくだけの存在だからです。複雑なActionを考える時には便利な思考パターンになると思います。しかし、こんな簡単な処理にまでViewを使うと面倒なのでここではActionClassでテンプレートに値を渡しています。  
\*4厳密にはEthna\_AppManager::getObjectPropListとEthna\_AppManager::getObjectList  

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
