# Ethnaを使ってメールを送信する - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# Ethnaを使ってメールを送信する 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [ethna-document-dev\_guide-app](ethna-document-dev_guide-app.html) > Ethnaを使ってメールを送信する 

- Ethnaを使ってメールを送信する 
  - テンプレートファイルの作成 
  - MailSenderの実行 
- Ethna\_MailSenderを拡張する 
  - (1) Ethna\_MailSenderをextendsしたクラスの作成 
  - (2) メールテンプレートの設置 
  - (3) 送信処理 
- 添付ファイル 
- メール送信のトラブルシューティング 
  - 文字化けの対応 
  - 送信できない、メール本体が空になる場合(2.5.0以降) 

| halt | 2006-11-06 17:53 | メールを送信する最短のサンプルを追加 |
| psuke | 2006-12-07 09:53 | 最短のサンプルを修正してみました。 |
| ichii386 | 2007-01-18 | Ethna\_MailSender.php,vの1.9にあわせて修正 |
| mumumu | 2009-10-18 | 「メール送信がうまくいかない場合」のセクションを追加 |

## Ethnaを使ってメールを送信する [](ethna-document-dev_guide-app-mail.html#r38fafcc "r38fafcc")

### テンプレートファイルの作成 [](ethna-document-dev_guide-app-mail.html#ze673136 "ze673136")

project\_dirの/template/jaにmailフォルダを作成、そこにテンプレートを配置します。

テンプレートはこんな感じで書きます。

welcome.tpl

    From: webmaster@example.com
    Subject: 入会に成功しました。
    
    ようこそ{$username}さん。
    うんたらかんたらほげほげ。

### MailSenderの実行 [](ethna-document-dev_guide-app-mail.html#c89e6311 "c89e6311")

テンプレートを書いたら送信したい時に

    $ethna_mail =& new Ethna_MailSender($this->backend);
    $ethna_mail->send('send_to_mail@example.com',
        'welcome.tpl',
        array('username' => $regist_user));

とすれば送信できます。

## Ethna\_MailSenderを拡張する [](ethna-document-dev_guide-app-mail.html#y3f60a66 "y3f60a66")

### (1) Ethna\_MailSenderをextendsしたクラスの作成 [](ethna-document-dev_guide-app-mail.html#x3148712 "x3148712")

PATH\_TO\_PROJECT\_ROOT/lib/Sample\_MailSender.php   
テンプレートの指定は、$defメンバに定義します。（0は使われてるので1から）

    <?php
    // {{{ Sample_MailSender
    class Sample_MailSender extends Ethna_MailSender
    {
          /** @var array メールテンプレート定義 */
          var $def = array(
                  '1' => 'user_resign' ,
                  '2' => 'user_register'
          );
    
          /**
           * アプリケーション固有のマクロを設定する（なにか共通で使うのがあれば）
           */
          function _setDefaultMacro($macro)
          {
                  return $macro;
          }
    }
    ?>

app/Sample\_Controller.php で include します。

    + include_once('Sample_MailSender.php');

### (2) メールテンプレートの設置 [](ethna-document-dev_guide-app-mail.html#b0fda188 "b0fda188")

テンプレートのディレクトリはデフォルトでは PATH\_TO\_PROJECT\_ROOT/template/ja/mail になります。このディレクトリに user\_resign と user\_register というファイルを設置します。

メールのテンプレートもHTMLのテンプレートと同じ要領でアサインされた変数を使えます。（使える Smarty 変数は \_setDefaultMacro とか後で Ethna\_MailSender::send で引数で与えられます）普通のメールと同じように **最初の空行でメールヘッダとメール本文を区別します** ので、入れたいヘッダがあれば以下のように記述します。

    From: webmaster@example.com
    Subject: ユーザが退会しました
    Bcc: resign@example.com
    X-Mailer: Ethna-{$smarty.const.ETHNA_VERSION}/Ethna_MailSender
    
    {$username}さんが退会しました。
    処理してください
    
    -- example.com

### (3) 送信処理 [](ethna-document-dev_guide-app-mail.html#ze947824 "ze947824")

ActionClassとかで

    $ethna_mail =& new Sample_MailSender($this->backend);
    $ethna_mail->send('send_to_mail@example.com',
        '1',
        array('username'=>$resign_user));

とすれば、Smarty変数usernameに$resign\_userがアサインされてメールが [send\_to\_mail@example.com](mailto:send_to_mail@example.com) 宛に送信されます。

## 添付ファイル [](ethna-document-dev_guide-app-mail.html#y42d177e "y42d177e")

send()の4つめの引数に添付ファイル(multipart)を指定することができます。

- アプリのtmpディレクトリにあるファイルを添付

    $dir = $this->ctl->getDirectory('tmp');
    $mail = &new Ethna_MailSender($this->backend);
    $mail->send(
        array('foo@example.jp', 'bar@example.jp'), // 配列でも指定できます
        'himitu.tpl',
        null,
        array(
            'filename' => $dir.'/himitu.xls',
            'content-type' => 'vnd/ms-excel',
        )
    );

- 文字列を複数のパートに添付

    $mail = &new Ethna_MailSender($this->backend);
    $mail->send(
        'boss@example.jp',
        'report/daily.tpl',
        array(
            'date' => date('Y/m/d'),
        ),
        array(
            array(
                'name' => 'one.txt',
                'content' => $report[0],
                'content-type' => 'text/plain; charset=euc-jp',
            ),
            array(
                'name' => 'two.txt',
                'content' => $report[1],
                'content-type' => 'text/plain; charset=euc-jp',
            ),
            array(
                'name' => 'three.txt',
                'content' => $report[2],
                'content-type' => 'text/plain; charset=euc-jp',
            ),
        )
    );

## メール送信のトラブルシューティング [](ethna-document-dev_guide-app-mail.html#f53e71f8 "f53e71f8")

### 文字化けの対応 [](ethna-document-dev_guide-app-mail.html#s975d12d "s975d12d")

Ethna\_MailSender は php の [mail()](http://jp.php.net/manual/ja/function.mail.php)関数を使っています。ほかのライブラリに依存しないメリットがあるものの、 Ethna のデフォルトである euc-jp 以外で運用すると文字化けしやすいかもしれません。

届いたメールの subject などが文字化けする場合、次のことを確認してください。

- mb\_language()
  - 'Japanese' にすると直るかもしれません。
- mb\_internal\_encoding()
  - 'euc-jp' にすると直るかもしれません。
- 添付ファイルの 'content-type'
  - 本文をテンプレートから読み込むときは、内部エンコーディングから iso-2022-jp に自動で変換します。添付ファイルについては適切なエンコーディングを自分で指定しなければなりません。
  - 上の例のように、添付を指定する配列で

    'content-type' => 'text/html; charset=utf-8'

のようなかんじでうまいこと指定してあげてください。

### 送信できない、メール本体が空になる場合(2.5.0以降) [](ethna-document-dev_guide-app-mail.html#df569d17 "df569d17")

Ethna ではメール送信の処理に、内部で [mail() 関数](http://www.php.net/manual/ja/function.mail.php)を使っています。ですので、使用するMTA(特にqmail等) によっては、メールに対する改行コードの扱いによって以下のような挙動をすることがあります。

- メール本体が空で送信される
- Ethna\_MailSender自体はエラーを吐かないのに、メールが送信されない

こういった場合、[appid]-ini.php に以下の設定を行って再度メール送信を行ってみてください。この設定を行うと、mail() 関数で発生する問題の大半の原因となる 「改行コード CRLF を一律にメールに付加する動き」を回避するようになります。

ただし、これは最後の手段にしてください。というのも、この設定はRFCに違反する動きを強制するものだからです。

    $config = array(
        // mail 
        'mail_func_workaround' => true,
    );

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
