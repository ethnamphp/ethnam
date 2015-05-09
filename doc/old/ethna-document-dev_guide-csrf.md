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

## クロスサイトリクエストフォージェリの対策コードについて [](ethna-document-dev_guide-csrf.html#x5f69ec6 "x5f69ec6")

### 概要 [](ethna-document-dev_guide-csrf.html#r7e3918e "r7e3918e")

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

### 準備 [](ethna-document-dev_guide-csrf.html#b1963202 "b1963202")

etc/APPID.ini.phpに、Ethna\_Plugin\_Csrfのどの実装を利用するかを指定します。 デフォルトでは、Sessionが呼び出されます。(現状では、Sessionしか用意されていません）

### (1) POSTの正当性を保証するためのIDを生成する [](ethna-document-dev_guide-csrf.html#z0be07ec "z0be07ec")

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

#### (余談) [](ethna-document-dev_guide-csrf.html#e5bcfeb6 "e5bcfeb6")

また、一度実行されれば（実装によりますが、たとえばSessionの場合は）その、Sessionが削除されるまでは同一のIDが保証されます。 Ethna\_Util::setCsrfID();を二回実行しても動作に影響はありません。 また、Sessionの実装の場合は、これを実行するとSessionが開始されることも注意してください。

### (2)テンプレートで{csrfid}でHidden値を生成する [](ethna-document-dev_guide-csrf.html#g1abfbaa "g1abfbaa")

Inputアクションから呼び出されるテンプレートInput.tplのFormの入力画面に{csrfid}を追加します。

例:

    {form ethna_action="input_do" method="post"}
    {csrfid}
    名前: {form_input name="name"}
    {form_input name="submit"}
    {/form}

### (3) Ehna\_Util::isCsrfSafe()で、正当性を確認する。 [](ethna-document-dev_guide-csrf.html#cc4beb5e "cc4beb5e")

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

#### (余談） [](ethna-document-dev_guide-csrf.html#pa2784b8 "pa2784b8")

上記コードをどのタイミングで行うのかということですが、基本的に

- DBに書き込む
- メールを送る

など、具体的なアクションを行う所で行うべきだと思います。

- 入力確認画面

などは、無くても問題ない場合が多いと思います。

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

