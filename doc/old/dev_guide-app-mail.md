# Ethnaを使ってメールを送信する
  - テンプレートファイルの作成 
  - MailSenderの実行 
- Ethna_MailSenderを拡張する 
  - (1) Ethna_MailSenderをextendsしたクラスの作成 
  - (2) メールテンプレートの設置 
  - (3) 送信処理 
- 添付ファイル 
- メール送信のトラブルシューティング 
  - 文字化けの対応 
  - 送信できない、メール本体が空になる場合(2.5.0以降) 

| halt | 2006-11-06 17:53 | メールを送信する最短のサンプルを追加 |
| psuke | 2006-12-07 09:53 | 最短のサンプルを修正してみました。 |
| ichii386 | 2007-01-18 | Ethna_MailSender.php,vの1.9にあわせて修正 |
| mumumu | 2009-10-18 | 「メール送信がうまくいかない場合」のセクションを追加 |

## Ethnaを使ってメールを送信する

### テンプレートファイルの作成

project_dirの/template/jaにmailフォルダを作成、そこにテンプレートを配置します。

テンプレートはこんな感じで書きます。

welcome.tpl

    From: webmaster@example.com
    Subject: 入会に成功しました。
    
    ようこそ{$username}さん。
    うんたらかんたらほげほげ。

### MailSenderの実行

テンプレートを書いたら送信したい時に

    $ethna_mail =& new Ethna_MailSender($this->backend);
    $ethna_mail->send('send_to_mail@example.com',
        'welcome.tpl',
        array('username' => $regist_user));

とすれば送信できます。

## Ethna_MailSenderを拡張する

### (1) Ethna_MailSenderをextendsしたクラスの作成

PATH_TO_PROJECT_ROOT/lib/Sample_MailSender.php   
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

app/Sample_Controller.php で include します。

    + include_once('Sample_MailSender.php');

### (2) メールテンプレートの設置

テンプレートのディレクトリはデフォルトでは PATH_TO_PROJECT_ROOT/template/ja/mail になります。このディレクトリに user_resign と user_register というファイルを設置します。

メールのテンプレートもHTMLのテンプレートと同じ要領でアサインされた変数を使えます。（使える Smarty 変数は _setDefaultMacro とか後で Ethna_MailSender::send で引数で与えられます）普通のメールと同じように **最初の空行でメールヘッダとメール本文を区別します** ので、入れたいヘッダがあれば以下のように記述します。

    From: webmaster@example.com
    Subject: ユーザが退会しました
    Bcc: resign@example.com
    X-Mailer: Ethna-{$smarty.const.ETHNA_VERSION}/Ethna_MailSender
    
    {$username}さんが退会しました。
    処理してください
    
    -- example.com

### (3) 送信処理

ActionClassとかで

    $ethna_mail =& new Sample_MailSender($this->backend);
    $ethna_mail->send('send_to_mail@example.com',
        '1',
        array('username'=>$resign_user));

とすれば、Smarty変数usernameに$resign_userがアサインされてメールが [send_to_mail@example.com](mailto:send_to_mail@example.com) 宛に送信されます。

## 添付ファイル

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

## メール送信のトラブルシューティング

### 文字化けの対応

Ethna_MailSender は php の [mail()](http://jp.php.net/manual/ja/function.mail.php)関数を使っています。ほかのライブラリに依存しないメリットがあるものの、 Ethna のデフォルトである euc-jp 以外で運用すると文字化けしやすいかもしれません。

届いたメールの subject などが文字化けする場合、次のことを確認してください。

- mb_language()
  - 'Japanese' にすると直るかもしれません。
- mb_internal_encoding()
  - 'euc-jp' にすると直るかもしれません。
- 添付ファイルの 'content-type'
  - 本文をテンプレートから読み込むときは、内部エンコーディングから iso-2022-jp に自動で変換します。添付ファイルについては適切なエンコーディングを自分で指定しなければなりません。
  - 上の例のように、添付を指定する配列で

    'content-type' => 'text/html; charset=utf-8'

のようなかんじでうまいこと指定してあげてください。

### 送信できない、メール本体が空になる場合(2.5.0以降)

Ethna ではメール送信の処理に、内部で [mail() 関数](http://www.php.net/manual/ja/function.mail.php)を使っています。ですので、使用するMTA(特にqmail等) によっては、メールに対する改行コードの扱いによって以下のような挙動をすることがあります。

- メール本体が空で送信される
- Ethna_MailSender自体はエラーを吐かないのに、メールが送信されない

こういった場合、[appid]-ini.php に以下の設定を行って再度メール送信を行ってみてください。この設定を行うと、mail() 関数で発生する問題の大半の原因となる 「改行コード CRLF を一律にメールに付加する動き」を回避するようになります。

ただし、これは最後の手段にしてください。というのも、この設定はRFCに違反する動きを強制するものだからです。

    $config = array(
        // mail 
        'mail_func_workaround' => true,
    );

