# アプリケーション構築手順(3)
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

# アプリケーション構築手順(3) 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [チュートリアル](ethna-document-tutorial.html) > アプリケーション構築手順(3) 
## アプリケーション構築手順(3) [](ethna-document-tutorial-practice3.html#ed639c24 "ed639c24")

- アプリケーション構築手順(3) 
  - (10) ログイン画面の変更 
  - (11) ログインアクションの追加 
  - (12) フォーム値の取得 
  - (13) フォーム値の検証 
  - (14) エラー処理(フォーム値の表示) 
  - (15) エラー処理(エラーメッセージの表示) 
  - (16) ロジックの記述(概念) 
  - (17) ロジックの記述(実際) 

次に、もう少し実際的な内容ということで、ログイン処理(画面の表示ではなく)を例にとって

- フォーム値の取得方法
- 基本的なエラー処理方法
- ビューへのデータ設定方法

といった点をご説明したいと思います。

なお、このページは [アプリケーション構築手順(1)](ethna-document-tutorial-practice1.html "ethna-document-tutorial-practice1 (23d)")〜 [アプリケーション構築手順(2)](ethna-document-tutorial-practice2.html "ethna-document-tutorial-practice2 (888d)")の続きとなっていますので、一応ご注意下さい。

### (10) ログイン画面の変更 [](ethna-document-tutorial-practice3.html#s3dcd04e "s3dcd04e")

まず、前節(8)で作成したテンプレートファイル(template/ja/login.tpl)をもうちょっとログイン画面っぽいものに作り変えておきます。具体的には以下のようにしてみます。

template/ja/login.tpl:

    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <html>
     <head></head>
     <body>
      <form action="{$script}" method="post">
      <input type="hidden" name="action_login_do" value="dummy">
      <table border="0">
       <tr>
        <td>メールアドレス</td>
        <td><input type="text" name="mailaddress" value=""></td>
       </tr>
       <tr>
        <td>パスワード</td>
        <td><input type="password" name="password" value=""></td>
       </tr>
      </table>
      <p>
      <input type="submit" name="action_login_do" value="ログイン">
      </p>
      </form>
     </body>
    </html>

通常のHTMLファイル(あるいはSmartyのテンプレートファイル)ですが、2点ほどEthna独自の点がありますのでここでご説明します。

- {$script}はテンプレート表示前にEthnaフレームワークが設定する変数で、現在実行中のPHPスクリプトを表します( [Ethna\_ViewClass::\_getTemplateEngine()](doc// __filesource/fsource_Ethna__ classEthna_ViewClass.php.html#a144)をご参照下さい)  
もちろん、/index.phpで全てを処理する場合は、action="/"と記述しても全く問題ありません
- hiddenタグの"action\_login\_do"は、このフォームをsubmitした際に、「login\_do」というアクションを実行することを表します  
「login\_do」というはStrutsの慣習をそのまま使っているだけなので、「login」と重ならなければ「login\_exec」でも「login\_submit」でも何でも構いません

Smartyテンプレートの詳細については

- [Smarty : Template Engine](http://smarty.php.net/) ( [和訳](http://sunset.freespace.jp/smarty/))

などを見てください。

以上で準備は完了です。

    http://some.host/~foo/?action_login=true

にアクセスしてログイン画面が表示されることを確認してください。

 ![ethna-fig7.jpg](http://ethna.jp/image/ethna-fig7.jpg "ethna-fig7.jpg")

### (11) ログインアクションの追加 [](ethna-document-tutorial-practice3.html#tbd93730 "tbd93730")

フォームがsubmitされた際に実行されるアクション「login\_do」を前節(5)の場合と同様に追加します。

    $ ethna add-action login_do
    generating action script for [login_do]...
    action script(s) successfully created [/tmp/sample/app/action/Login/Do.php]

この状態ではやはり'login\_do'という遷移名を返すだけのアクションになっています。実際には'login\_do'という遷移名は不要なので、以下のように変更しておきます。

app/action/Login/Do.php:

    66 function perform()
    67 {
    68 - return 'login_do';
    68 + return 'index';
    69 }

以上の状態で、ログインボタンを押すと

1. コントローラがlogin\_doアクションを実行します
2. Sample\_Action\_LoginDo::perform()メソッドが実行されます
3. 遷移名としてindexが返されます

という処理の流れで、トップページが表示されると思います。

実際にはトップページに遷移する前に、(あたりまえですが)フォーム値のチェックや認証処理を行い、エラーが発生した場合はエラーメッセージを表示させる必要があります。

### (12) フォーム値の取得 [](ethna-document-tutorial-practice3.html#r4602518 "r4602518")

認証を行うためには、フォームから送信された値を取得する必要があります。フォームから送信された値にアクセスするには、アクションクラスと1対1で生成されるアクションフォームというオブジェクトを利用します。アクションフォームのクラス定義は、ethna add-action を実行すると、アクションクラスと同時に生成されていますので、まずは何も考えず、app/action/Login/Do.phpに以下のようなコードを追加してみてください。

app/action/Login/Do.php:

    23 var $form = array(
    24 + 'mailaddress' => array(
    25 + 'type' => VAR_TYPE_STRING,
    26 + ),
    ...
    69 function perform()
    70 {
    71 + print $this->action_form->get('mailaddress');

以上の状態で、フォームの「メールアドレス」に適当な文字を入力してsubmitすると、その値が表示されるかと思います。これで何となくお分かりかと思いますが、フォーム値にアクセスするには(非常に大雑把に言うと)

1. アクションフォームに受け取るフォーム値を定義する
2. アクションクラスにメンバ変数として設定されている$action\_formオブジェクトのアクセサ(get()/set())を通じて値を取得/設定する

という手順になります。なお、フォーム値にアクセスする度に

    $this->action_form->get('foo');

と書くのは面倒なので、省略形として

    $this->af->get('foo');

と書くことも出来ます。

### (13) フォーム値の検証 [](ethna-document-tutorial-practice3.html#ma018c2e "ma018c2e")

たかがフォーム値にアクセスするのに何故こんな面倒な手順が必要なのか、にはいくつか理由がありますが(ほとんどはセキュリティ上の理由)、この方法の最大のメリットはフォーム値の自動検証です。

アクションスクリプトのスケルトンを生成すると、アクションフォームに以下のようなコメントも生成されているかと思います。

    27 /*
    28 'sample' => array(
    29 'name' => 'サンプル', // 表示名
    30 'required' => true, // 必須オプション(true/false)
    31 'min' => null, // 最小値
    32 'max' => null, // 最大値
    33 'regexp' => null, // 文字種指定(正規表現)
    34 'custom' => null, // メソッドによるチェック
    35 'filter' => null, // 入力値変換フィルタオプション
    36 'form_type' => FORM_TYPE_TEXT // フォーム型
    37 'type' => VAR_TYPE_INT, // 入力値型
    38 ),
    39 */

上記のように、各フォーム値には'name'〜'type'まで計9つの属性を設定することが出来ます(必須なのは'type'のみです)。Ethnaでは、ここで設定されら属性を利用したフォーム値の自動検証機能を提供しています。

ここで先ほどのフォーム値'mailaddress'を利用して実際に試してみます。まず、先ほどの'mailaddress'の属性を下記のように変更します。

    24 'mailaddress' => array(
    25 + 'name' => 'メールアドレス',
    26 + 'required' => true,
    27 'type' => VAR_TYPE_STRING,
    28 ),
    29 + 'password' => array(
    30 + 'name' => 'パスワード',
    31 + 'required' => true,
    32 + 'type' => VAR_TYPE_STRING,
    33 + ),

これは、フォーム値'mailaddress'の表示名が「メールアドレス」であり、また入力が必須であることを示しています。ついでにpasswordも必須としてしまいます。

次に、アクションクラスで自動入力処理を行います。具体的には、アクションクラスのprepare()メソッドに以下のような処理を追加します。

    65 function prepare()
    66 {
    67 + if ($this->af->validate() > 0) {
    68 + return 'login';
    69 + }

アクションフォームのvalidate()メソッドは、定義に従ってフォーム値を自動検証し、検出したエラーの数を戻り値として返します(発生したエラーの扱い等については後述します)。

この状態で、メールアドレスを空欄にしてsubmitすると以前と異なりトップページは表示されず、再度ログインページが表示されるのが分かるかと思います。

以上が、フォーム値の検証に関する基本的な説明でした。なお、アクションクラスのprepare()メソッドとperform()メソッドの関係は以下のようになっていて(なんちゃってシーケンス図-しかもスペルチェックエラー\*1)、まずはprepare()メソッドが呼ばれ、prepare()メソッドがnullを返した場合のみperform()メソッドが呼び出されます。

 ![ethna-fig8.gif](http://ethna.jp/image/ethna-fig8.gif "ethna-fig8.gif")

ようするに、prepare()メソッドでフォーム値の検証を行うこと、perform()メソッドでは全てのデータはサニタイズされているという前提で処理を行うことが出来る、安全且つ簡潔なコードが書けるというわけです(やっぱりStrutsの真似)。

なお、フォーム値の自動検証詳細については以下をご覧下さい。

_see also:_ [フォーム値の自動検証を行う](ethna-document-dev_guide-form-validate.html "ethna-document-dev\_guide-form-validate (737d)")

### (14) エラー処理(フォーム値の表示) [](ethna-document-tutorial-practice3.html#b237aaa1 "b237aaa1")

(自動にせよ手動にせよ)フォーム値の検証を行ってエラーが発生したら、それに伴って幾つかの処理を行う必要があります。

まずは最低限の処理その1ということで、入力されたフォーム値をvalue属性に設定してみます。

フォーム値はEthnaフレームワークによって自動的にSmarty変数として割り当てられるので、実際にはテンプレートで

{$form._フォーム項目名_}

と記述すればOKです。ですのでここではlogin.tplを以下のように変更します。

template/ja/login.tpl:

    8 <tr>
     9 <td>メールアドレス</td>
    10 - <td><input type="text" name="mailaddress" value=""></td>
    10 + <td><input type="text" name="mailaddress" value="{$form.mailaddress}"></td>
    11 </tr>

この状態で、メールアドレスのみを入力してsubmitすると、(パスワードが入力されていないのでエラーにはなりますが)メールアドレスのフォーム値が失われずに表示されていると思います。

なお、{$form.\*}で表示される値は_常に_エスケープされていますので、サニタイズ等は考慮する必要はありません。\*2

### (15) エラー処理(エラーメッセージの表示) [](ethna-document-tutorial-practice3.html#dfdf474a "dfdf474a")

次に最低限の処理その2である、エラーメッセージの表示を行います。発生したエラーは、やはりEthnaフレームワークによって自動的にテンプレート変数として割り当てられ、

- 全てのエラーメッセージ一覧
- 指定されたフォーム名に対応するエラーメッセージ

という形でアクセスすることが可能です。

まず全てのエラーメッセージを表示させてみます。エラーメッセージは配列として{$errors}というSmarty変数に割り当てられていますので:

template/ja/login.tpl:

    4 <body>
    5 + {if count($errors)}
    6 + <ul>
    7 + {foreach from=$errors item=error}
    8 + <li>{$error}</li>
    9 + {/foreach}
    10+ </ul>
    11+ {/if}

というように書くと、全てのエラーメッセージを表示させることが出来ます。

また、特定のフォーム名に対応するエラーメッセージを表示させるには、Ethnaフレームワークの提供するSmarty関数"message"を利用します。

template/ja/login.tpl:

    15 <tr>
    16 <td>メールアドレス</td>
    17 <td><input type="text" name="mailaddress" value="{$form.mailaddress}
       ">{message name="mailaddress"}</td>
    18 </tr>
    19 <tr>
    20 <td>パスワード</td>
    21 <td><input type="password" name="password" value="">{message name="p
       assword"}</td>
    22 </tr>

Ethnaフレームワークにおけるエラー処理ポリシーについては以下をご覧下さい。

_see also:_ [エラー処理ポリシー](ethna-document-dev_guide-error-policy.html "ethna-document-dev\_guide-error-policy (1240d)")

また、自動検証で設定されるエラーメッセージは(もちろん)任意にカスタマイズすることが出来ます。

_see also:_ [自動検証のエラーメッセージをカスタマイズする](ethna-document-dev_guide-form-message.html "ethna-document-dev\_guide-form-message (619d)")

### (16) ロジックの記述(概念) [](ethna-document-tutorial-practice3.html#x9a32944 "x9a32944")

フォーム値の検証が完了したら、いよいよロジック部分(実際のアプリケーションとしての動作)を記述します。

と、その前にアクションクラスとアプリケーションの関連を表した図を以下に示します。

 ![ethna-fig9.png](http://ethna.jp/image/ethna-fig9.png "ethna-fig9.png")

ちょっと分かりにくいかもしれませんが、上記のようにアクションクラス(perform()メソッド)にはアプリケーションの核となる処理を_記述してはいけません_。

基本的にはほぼ全ての処理はアプリケーションの核となるクラス(app/ディレクトリに置かれるスクリプト)に記述し、アクションクラスはそれらを単純に呼び出すのみ、というイメージです。例えば

    perform()
    {
      // メールアドレスをキーにしてユーザオブジェクトを生成
      $user =& new Sample_User($this->backend, $this->af->get('mailaddress'));
      // 認証処理
      $result = $user->auth($this->af->get('password');
      // 以降結果によってビューを変更、等...
    }

というようになります。これには、各アクションクラス間での処理の重複を防ぐ目的もありますが、主な目的は、アクションクラスはフロントエンドに徹することで、低コストで異なるクライアントに対応できる、と言うことです。具体的には以下のようなイメージです。

 ![ethna-fig10.png](http://ethna.jp/image/ethna-fig10.png "ethna-fig10.png")

このあたりは実験段階ですが、一応モバイル(仮にAU)とSOAPクライアントに関しては実績がありますので、ブラッシュアップすればなかなか使えるものになっていくと思います。

最後に改めてアクションクラスのperform()メソッドを記述する際の注意事項を挙げてさせて頂きます。

- アクションクラスにアプリケーションの核となる処理を記述しない
- アクションクラスはどんなに長くても100〜200行程度におさめる
- 他のアクションクラスと重複する処理を記述しない  
重複する処理がある場合は、そのアクションクラスを継承するか、アプリケーションのマネージャ的処理に移行する

### (17) ロジックの記述(実際) [](ethna-document-tutorial-practice3.html#q7acefe5 "q7acefe5")

(16)の概念を元に、アクションクラスにロジック部分の処理を記述していきます(正確には、ロジック部分を記述したクラスを別に作成し、それをアクションクラスから呼び出します)。

まず、アプリケーションのクラスを作成します。ここでは簡単に以下のようなスクリプトを作成してみます。

app/Sample\_UserManager.php:

    <?php
    class Sample_UserManager
    {
        function auth($mailaddress, $password)
        {
            // 実際にはまともに認証処理を行う
            if ($mailaddress != $password) {
                return Ethna::raiseNotice('メールアドレスまたはパスワードが正しくありません', E_SAMPLE_AUTH);
            }
            return 0;
        }
    }
    ?>

ついでにエラーコードを追加します。

app/Sample\_Error.php:

    18 */
    19 + /** エラーコード: ユーザ認証エラー */
    20 + define('E_SAMPLE_AUTH', -128);
    21 ?>

先ほど作成したSample\_UserManager.phpをControllerでインクルードします。appディレクトリとlibディレクトリは、プロジェクトスケルトンを生成した時点でinclude\_pathに追加されていますので、ファイル名を記述するだけでOKです。

app/Sample\_Controller.php:

    21 include_once('Sample_Error.php');
    22 + include_once('Sample_UserManager.php');
    23

最後に、アクションクラスのperform()メソッドを記述します。ここでは、ユーザマネージャで認証処理を行うだけです。

app/actoin/Login/Do.php

    80 function perform()
    81 {
    82 $um =& new Sample_UserManager();
    83 $result = $um->auth($this->af->get('mailaddress'), $this->af->ge
       t('password'));
    84 if (Ethna::isError($result)) {
    85 $this->ae->addObject(null, $result);
    86 return 'login';
    87 }
    88
    89 return 'index';
    90 }

ここではauth()メソッドからエラーオブジェクトが返ってきた場合は再度ログイン画面を表示させ、認証が成功した場合はトップページを表示しています。

エラー処理詳細につきましては下記をご覧下さい。

_ses also:_ [エラー処理ポリシー](ethna-document-dev_guide-error-policy.html "ethna-document-dev\_guide-error-policy (1240d)")

以上が、結構長くなってしまいましたが基本的なアプリケーションの構築手順となります。なんとなくご理解いただけると嬉しいです。

なお、実際のアプリケーション開発ではその他いろいろ、例えば下記のようなパターンも必要となってくるかと思いますので、それらについては順次howtoの方でご説明していきますので、開発中に「あれ？これってどうやるんだろう？」あるいは「この処理、かったるくてやってらんない」と思った場合は、howtoを御覧頂くか、あるいはエントリがない場合は [ご意見/ご要望](ethna-community.html#content_1_4 "ethna-community (619d)")ページでお知らせ下さい。

- セレクトボックスを作成する
- チェックボックスを作成する
- セッションを利用する
- ログを出力する
- DBを利用する
- アラートメールを送信する
- ...

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1消せよ...＞自分  
\*2とはいえ、テンプレート中の変数表示位置によっては、サニタイズは非常にナイーブな処理が必要になりますので過信は禁物です。特にタグ内の属性値に割り振られる変数には注意が必要です。  

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
