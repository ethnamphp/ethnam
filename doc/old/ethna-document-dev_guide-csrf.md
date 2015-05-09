# クロスサイトリクエストフォージェリの対策コードについて
  - 概要 
  - 準備 
  - (1) POSTの正当性を保証するためのIDを生成する 
    - (余談) 
  - (2)テンプレートで{csrfid}でHidden値を生成する 
  - (3) Ehna\_Util::isCsrfSafe()で、正当性を確認する。 
    - (余談） 

| 書いた人 | 日付 | 備考 |
| cocoiti | 2006-011-01 | 初版 |
| halt | 2006-011-01 | 具体的な例を提示 |

## クロスサイトリクエストフォージェリの対策コードについて

### 概要

EthnaはPOSTとGETを区別しないため、クロスサイトリクエストフォージェリ（以下CSRF）については一般的なリンクによる攻撃でもCSRFが成立します。

例として、 認証が必要なDeleteアクションを外部の人間がCSRFを利用して実行する場合を考えてみます。 DeleteアクションはidをPOSTされるとそのidを持つカラムを削除する機能をもっていたとします。だいたい以下のような実装です。

DeleteActionForm

    -- 中略 --
    'id' => array(
        'name' => 'id',
        'type' => VAR_TYPE_INT,
        'form_type' => FORM_TYPE_TEXT,
        'required' => true,
    ),
    'submit' => array(
        'name' => 'submit',
        'type' => VAR_TYPE_STRING,
        'form_type' => FORM_TYPE_SUBMIT,
        'required' => true,
    ),
    -- 中略 --

DeleteAction

    -- 中略 --
    function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'error';
        } else {
            return null;
        }
    }
    
    function perform()
    {
        -- データを削除する処理 --
    }
    -- 中略 --

このアクションには認証がかかっているため、悪意のある人間がアクセスしても、認証をクリアするためのid,passwordなどを知っていないとアクセスできませんが、すでにログインし、認証済みのユーザに、

    http://example.com/?action_delete=true&id=100&submit=aaa

というURLをメールで送りつけるなどして認証済みのユーザにアクセスさせた場合、アクセスさせた相手の認証情報を使ってこちらが意図したidの記事を削除させることができます。

一般的には、それぞれ、なんらかの対策コードを追加していたと思いますが、Ethnaで次のようなヘルパを作成しました。

### 準備

etc/APPID.ini.phpに、Ethna\_Plugin\_Csrfのどの実装を利用するかを指定します。 デフォルトでは、Sessionが呼び出されます。(現状では、Sessionしか用意されていません）

### (1) POSTの正当性を保証するためのIDを生成する

まず、入力画面もしくは、APPID\_ActionClassのデフォルトの動作のどちらかで、IDを生成します。 難しく聞こえますが、要するにロジックのどこかで

    Ethna_Util::setCsrfID();

を実行するだけです。

ここでは仮に、Inputアクションのperform()に記述します。

    class Csrf_Action_Input extends Csrf_ActionClass
    {
       function perform()
       {
           Ethna_Util::setCsrfID();
           return 'Input';
       }
    }

生成されるIDの実装などは特にプログラマが意識することはありません。

#### (余談)

また、一度実行されれば（実装によりますが、たとえばSessionの場合は）その、Sessionが削除されるまでは同一のIDが保証されます。 Ethna\_Util::setCsrfID();を二回実行しても動作に影響はありません。 また、Sessionの実装の場合は、これを実行するとSessionが開始されることも注意してください。

### (2)テンプレートで{csrfid}でHidden値を生成する

Inputアクションから呼び出されるテンプレートInput.tplのFormの入力画面に{csrfid}を追加します。

例:

    {form ethna_action="input_do" method="post"}
    {csrfid}
    名前: {form_input name="name"}
    {form_input name="submit"}
    {/form}

### (3) Ehna\_Util::isCsrfSafe()で、正当性を確認する。

formのデータ送信先であるinput\_doアクションで、Postの正当性を確認します。

    class Csrf_Action_Input_Do extends Csrf_ActionClass
    {
        function prepare()
        {    
            if(! Ethna_Util::isCsrfSafe()) {
                return 'error';
            } 
    
            if(! $this->af->validate()) {
               return 'input';
            }
    
            return null;
        }
    }

これでCSRFの対策コードの完了です。エラー処理などは、サイトのポリシーによって適切に行ってください。

#### (余談）

上記コードをどのタイミングで行うのかということですが、基本的に

- DBに書き込む
- メールを送る

など、具体的なアクションを行う所で行うべきだと思います。

- 入力確認画面

などは、無くても問題ない場合が多いと思います。

