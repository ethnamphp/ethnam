<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
アプリケーション構築手順(2) - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# アプリケーション構築手順(2) 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [チュートリアル](ethna-document-tutorial.html) > アプリケーション構築手順(2) 
## アプリケーション構築手順(2) [](ethna-document-tutorial-practice2.html#b6f7acf5 "b6f7acf5")

- アプリケーション構築手順(2) 
  - (4) アクション定義の追加(省略可) 
  - (5) アクションクラスの記述 
  - (6) ビュー定義の追加(省略可) 
  - (7) ビュークラスの記述 
  - (8) テンプレートの記述 
  - (9) 確認 

実際のアプリケーション構築は、「アクション」を追加していく作業の繰り返しとなります。

「アクション」とは何ですか？というのを正確に定義するのはちょっと難しいですが、要するに

1. ユーザから何らかのリクエストを受け取って(例えばURLへのアクセスや、submitボタンのクリック)
2. サーバ側で何らかの処理をして
3. 結果をブラウザに出力する

という一連の処理単位だとお考え下さい。

ここでは単純な例として、まず「ログイン画面の表示」というアクションを追加してみます。このとき必要となる作業は、以下の図のようになります(半透明なブロックは、省略可能な作業であることを示しています)。

 ![ethna-fig4.png](http://ethna.jp/image/ethna-fig4.png "ethna-fig4.png")

### (4) アクション定義の追加(省略可) [](ethna-document-tutorial-practice2.html#d167a6af "d167a6af")

Controllerにアクション定義を追加します。具体的には、app/Sample\_Controller.phpを以下のように編集します。

    var $action = array(
           /*
            * TODO: ここにaction定義を記述してください
            *
            * 記述例：
            *
            * 'index' => array(),
            */
    + 'login' => array(
    + 'class_name' => 'Sample_Action_Login'
          ),
       );

これは「login」というアクションに、'Sample\_Action\_Login'というクラス名を関連付けることを意味します。

なお、慣れてくると毎回'class\_name'属性等を記述するのは面倒になってくるので、実際にはこれを省略することも可能です(コメント部分に記述されている'index'アクションは省略された形です)。さらには、アクション定義自体(このステップ)を省略することも可能です。

アクション定義と、インクルードされるスクリプトファイル名やアクションクラス名の関係、省略方法については、下記をご覧下さい。

_see also:_ [アクション定義を省略する](ethna-document-dev_guide-action-omit.html "ethna-document-dev\_guide-action-omit (1240d)")

### (5) アクションクラスの記述 [](ethna-document-tutorial-practice2.html#je4912be "je4912be")

(4)で定義したアクションに対応するクラスを作成します(このクラスを「アクションクラス」と呼んでいます)。アクションに対応するクラスは以下のように記述します。

1. Ethna\_ActionClassを継承したクラスを定義します
2. Ethna\_ActionClassのperform()メソッドをオーバーライドして、サーバ側で行いたい処理を記述します
3. perform()メソッドの戻り値として遷移先の名前(後述)を返します

さて、ここでは上記のとおり「Sample\_Action\_Login」を作成してみます。アクションクラスを定義したファイル(アクションスクリプトと呼んでいます\*1)は、app/actionに以下のような命名規則で作成します('\_'をディレクトリで区切り、ファイル名は大文字で開始します)。

1. アクション名の先頭を大文字にします
2. '\_'を'/'に置き換え(= ディレクトリで区切り)続く文字を大文字にします

ですので以下のようになります。

| アクション名 | スクリプトファイル |
| login | app/action/Login.php |
| user\_list\_add | app/action/User/List/Add.php |

ですので、ここでは'login'というアクションに対応するファイルを作成するので、app/action/Login.phpというファイルを以下のように作成すればよいことになります。

    <?php
    class Sample_Action_Login extends Ethna_ActionClass
    {
        function perform()
        {
            return 'login';
        }
    }
    ?>

このクラスでは、サーバ側では何も処理を行わずに'login'という遷移先を返しています。つまり

_なにもしないで'login'というビューを表示する_

という処理になります。

実際には、毎回アクションスクリプトを1から記述するのは煩雑なので、ethnaコマンドのadd-actionオプションを利用して、スケルトンファイルを生成することも出来ます。

例:

    $ ethna add-action login

_see also:_ [アクションスクリプトのスケルトンを生成する](ethna-document-dev_guide-action-skelton.html "ethna-document-dev\_guide-action-skelton (1240d)")

なお、アクションスクリプトを配置するディレクトリは適宜変更することが可能です。

_see also:_ [アクションスクリプトの配置ディレクトリを変更する](ethna-document-dev_guide-action-dir.html "ethna-document-dev\_guide-action-dir (1240d)")

また、前述したアクションクラスやアクションスクリプトのファイル命名規則等も変更することが可能です。

_see also:_ [アクション定義省略時の命名規則を変更する](ethna-document-dev_guide-action-namingconvention.html "ethna-document-dev\_guide-action-namingconvention (1240d)")

### (6) ビュー定義の追加(省略可) [](ethna-document-tutorial-practice2.html#qae768c0 "qae768c0")

次に、アクションクラスが返す遷移先(この場合'login'という遷移先)を定義します。

具体的には、Controllerに遷移先定義を追加します。app/Sample\_Controller.phpを以下のように編集してください。

    /**
      * @var array forward定義
      */
     var $forward = array(
          /*
           * TODO: ここにforward先を記述してください
           *
           * 記述例：
           *
           * 'index' => array(
           * 'view_name' => 'Sample_View_Index',
           * ),
           */
    + 'login' => array(
    + 'view_name' => 'Sample_View_Login',
    + 'forward_path' => 'login.tpl'
        ),
     );

これで、'login'という遷移先にSample\_View\_Loginというビュークラスと、login.tplというテンプレートファイルが関連付けられます。

なお、Ethnaのビューは、以下のように構成されています。

 ![ethna-fig5.png](http://ethna.jp/image/ethna-fig5.png "ethna-fig5.png")

1. Action Classは、実行中に取得したダイナミックな表示データをAction Formオブジェクトに格納します(Action Formオブジェクトはコンテナとして振舞います)
2. アクションクラスは、コントローラに遷移先を返します
3. コントローラは、アクションクラスから返された遷移先に基づいて、ビューオブジェクトを生成します
4. ビューオブジェクトは、ダイナミックな表示データをアクションフォームから取得します
5. ビューオブジェクトはSmartyオブジェクトを生成し、必要な変数をSmartyオブジェクトに設定します
6. テンプレートを出力します

なお、実際にビュー1つ作るたびにこのような定義を記述するのは煩雑なので、アクション定義と同様にビュー定義も省略することが可能です。

_see also:_ [遷移先定義を省略する](ethna-document-dev_guide-forward-omit.html "ethna-document-dev\_guide-forward-omit (1240d)")

さらに、アクションクラス等と同様に、省略時のビュークラスやテンプレートファイル名の命名規則を変更することも可能です。

_see also:_ [ビューの命名規則を変更する](ethna-document-dev_guide-forward-view_namingconvention.html "ethna-document-dev\_guide-forward-view\_namingconvention (1240d)")

_see also:_ [テンプレートの命名規則を変更する](ethna-document-dev_guide-forward-template_namingconvention.html "ethna-document-dev\_guide-forward-template\_namingconvention (1240d)")

### (7) ビュークラスの記述 [](ethna-document-tutorial-practice2.html#a54d13a1 "a54d13a1")

ここでは、(6)で定義したビュークラスSample\_View\_Loginを作成します。ビュークラスを定義したファイル(ビュースクリプト、とでも呼んでおきます)は、アクションクラスと同様にapp/viewに以下のような命名規則で作成します('\_'をディレクトリで区切り、ファイル名は大文字で開始します)。

| 遷移名 | スクリプトファイル |
| login | app/view/Login.php |
| user\_list\_add | app/view/User/List/Add.php |

ですので、ここでは'login'という遷移名に対応するファイルを作成するので、app/view/Login.phpというファイルを以下のように作成します。

    <?php
    class Sample_View_Login extends Ethna_ViewClass
    {
        function preforward()
        {
            $this->af->setApp('now', strftime('%Y/%m/%d'));
        }
    }
    ?>

preforward()メソッドはテンプレート表示前に呼び出され、テンプレートに関連した各種データ(セレクトボックスの表示項目等)を設定することが可能です。ここでは、コンテナに'now'という名前で現在時刻を格納しています。

実際には、毎回ビュースクリプトを1から記述するのは煩雑なので、ethnaコマンドのadd-viewオプションを利用して、スケルトンファイルを生成することも出来ます。

例:

    $ ethna add-view login

この時に-tオプションをつける事によって、同時にテンプレートのスケルトンファイルが生成されます。

例:

    $ ethna add-view -t login

また、ビュークラスが不要な場合(単純にテンプレートを表示したい場合等)は、ビュークラスの記述を省略することも可能です。

### (8) テンプレートの記述 [](ethna-document-tutorial-practice2.html#r41bbb2b "r41bbb2b")

次に、テンプレートファイルを作成します。テンプレートディレクトリはtemplate/jaディレクトリで、(6)で'login.tpl'をテンプレートファイルに指定しているので、template/ja/login.tplを作成します。

    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <html>
    <head></head>
    <body>
    Login View<br />
    current time: {$app.now}
    </body>
    </html>

実際には、毎回アクションスクリプトを1から記述するのは煩雑なので、ethnaコマンドのadd-template オプションを利用して、スケルトンファイルを生成することも出来ます。

    $ ethna add-template login

上記のとおり、テンプレートに{$app._foo_}と記述すると、アクションクラス、あるいはビュークラスで

    $this->af->setApp('foo', 'bar');

として設定した値にアクセスすることが出来ます。

なお、テンプレートディレクトリを変更することも可能です。

_see also:_ [テンプレートディレクトリを変更する](ethna-document-dev_guide-forward-template_dir.html "ethna-document-dev\_guide-forward-template\_dir (432d)")

### (9) 確認 [](ethna-document-tutorial-practice2.html#q78ef858 "q78ef858")

以上でアクションの追加は完了ですので、実際にアクセスして動作を確認します。

    http://some.host/~foo/?action_login=true

(4)〜(8)で定義した通りに、以下のような画面が表示されれば成功です。

 ![ethna-fig6.jpg](http://ethna.jp/image/ethna-fig6.jpg "ethna-fig6.jpg")

もう少し複雑なアクションについては、次節 [アプリケーション構築手順(3)](ethna-document-tutorial-practice3.html "ethna-document-tutorial-practice3 (1240d)")をご覧下さい。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1FLASHと紛らわしいですが  

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
