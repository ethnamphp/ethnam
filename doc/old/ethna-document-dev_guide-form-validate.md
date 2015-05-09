<title>
フォーム値の自動検証を行う(基本編) - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# フォーム値の自動検証を行う(基本編) 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [フォーム定義](ethna-document-dev_guide-form.html) > フォーム値の自動検証を行う(基本編) 

- フォーム値の自動検証を行う(基本編) 
  - (1) 属性を設定する 
    - type属性 
    - 制限属性 
    - VAR\_TYPE\_DATETIME に関する注意事項 
    - VAR\_TYPE\_STRING の max, min属性に関する注意事項 
    - 制限属性(配列使用時) 
    - 補足属性 
    - 属性設定例 
  - (2) validate()メソッドを実行する 
  - (3) エラーメッセージを表示する 
    - エラーメッセージ一覧 
    - 特定のフォームに対するエラーメッセージ 
  - 補足 

## フォーム値の自動検証を行う(基本編) [](ethna-document-dev_guide-form-validate.html#z3a90a1a "z3a90a1a")

クライアントから送信されたフォーム値の検証は、ウェブアプリケーションにおいて重要な、そして面倒な処理の1つです。Ethnaではこの処理を出来る限り手間をかけずに行えるような自動検証機能を提供しています。

フォーム値の自動検証を行う手順は簡単で、以下のようになります。

1. アクションフォームの$formメンバにフォーム値の属性(受け取りたい値の型や最大値等)を設定します
2. アクションフォームオブジェクトのvalidate()メソッドを実行します
3. エラーメッセージを表示します

アクションフォームのvalidate()メソッドは、1.で設定した属性に基づいて、入力されたフォーム値を検証し、エラーが発生すると(つまり、属性で指定した制限を超えた値が入力されると)エラーをアクションエラーオブジェクトに登録します\*1。

validate()メソッドは戻り値として発生したエラーの数を返すので、1以上の値が返された場合は入力値でエラーが発生したと判断して、エラー用画面を表示します\*2。

具体的な手順については以下を御覧下さい。

### (1) 属性を設定する [](ethna-document-dev_guide-form-validate.html#u8511fc4 "u8511fc4")

自動検証を行うには、まず属性としてフォーム値の型を指定します。

1. type(フォーム値の型)

そして、自動検証で設定可能な属性は以下の4通りとなります(不要な属性は当然省略可能です)。

1. required(必須チェック)
2. min(最小文字数(バイト数)チェック)
3. max(最大文字数(バイト数)チェック)
4. regexp(正規表現によるチェック)
5. mbregexp(マルチバイト対応正規表現によるチェック(2.3.2 以降))

また、補助的な値として以下の2つを設定することが出来ます。

1. name(エラーメッセージ表示時等のための、表示用フォーム名)
2. form\_type(エラーメッセージ表示等のためのフォーム種別\*3)

上記に加えて、任意のメソッドによるチェックも可能です(メールアドレス、URL、アプリケーション固有ID等)。詳細は [フォーム値の自動検証を行う(カスタムチェック編)](ethna-document-dev_guide-form-customvalidate.html "ethna-document-dev\_guide-form-customvalidate (1120d)")を御覧下さい。

#### type属性 [](ethna-document-dev_guide-form-validate.html#oc46874f "oc46874f")

type属性に設定可能な値は以下の通りとなりますので、受け取りたい値に応じて設定します。型として特に制限を設けない場合にはVAR\_TYPE\_STRINGを設定します。

| VAR\_TYPE\_INT | 整数(+/-) |
| VAR\_TYPE\_FLOAT | 小数(+/-) |
| VAR\_TYPE\_STRING | 文字列 |
| VAR\_TYPE\_DATETIME | 日付(YYYY/MM/DD HH:MM:SS等) |
| VAR\_TYPE\_BOOLEAN | 真偽値(1 or 0) |
| VAR\_TYPE\_FILE | ファイル |

#### 制限属性 [](ethna-document-dev_guide-form-validate.html#p64c2b4d "p64c2b4d")

required/min/max/regexpの各属性はtype属性に設定された値によって意味合いが変化します。詳細は以下の通りです。

| type属性 | required属性 | min属性 | max属性 | (mb)regexp属性 |
| VAR\_TYPE\_INT | 必須チェック | 数値としての最小値 | 数値としての最大値 | 正規表現 |
| VAR\_TYPE\_FLOAT | 必須チェック | 数値としての最小値 | 数値としての最大値 | 正規表現 |
| VAR\_TYPE\_STRING | 必須チェック | 最小文字(バイト)数 | 最大文字(バイト)数 | 正規表現 |
| VAR\_TYPE\_DATETIME | 必須チェック | 入力可能な最も古い日付 | 入力可能な最も新しい日付 | 正規表現 |
| VAR\_TYPE\_BOOLEAN | 必須チェック | - | - | - |
| VAR\_TYPE\_FILE | 必須チェック | ファイルの最小サイズ(KB) | ファイルの最大サイズ(KB) | - |

#### VAR\_TYPE\_DATETIME に関する注意事項 [](ethna-document-dev_guide-form-validate.html#l4567ccd "l4567ccd")

type 属性に VAR\_TYPE\_DATETIME を指定する場合は、PHP の [strtotime関数](http://jp.php.net/strtotime) が動作する英文形式の入力があることを期待することに注意して下さい。そのため、日本語等のマルチバイト文字が含まれた日付等では max, min 属性は動作しません\*4。また、負のUnixタイムスタンプに対応しているかどうか、そしてサポートするタイムスタンプの範囲もプラットフォーム依存です。

よって、こうした制限事項にひっかかるような日付の入力値の検証を行いたい場合は、VAR\_TYPE\_DATETIME は使わないで下さい。その場合は、年・月・日 などのフィールドをそれぞれフォーム定義で指定するなどして、カスタムバリデータを書いたほうが無難です。

#### VAR\_TYPE\_STRING の max, min属性に関する注意事項 [](ethna-document-dev_guide-form-validate.html#laa76e75 "laa76e75")

Ethna 2.5.0 以降では、VAR\_TYPE\_STRING のフォーム定義に対して maxとmin の属性を設定するとデフォルトで最大（最小）文字数のチェックが行われるようになりました。これに対して 2.3.x より前のバージョンでは、最大（最小）バイト数でチェックを行います。

2.5.0 以降でバイト数によるチェックを行いたい場合は、 [VAR\_TYPE\_STRING の max, min 属性に関する詳細](ethna-document-dev_guide-form-validate-vartypestring.html "ethna-document-dev\_guide-form-validate-vartypestring (581d)") を参照して下さい。

#### 制限属性(配列使用時) [](ethna-document-dev_guide-form-validate.html#b184714a "b184714a")

type属性に **配列が指定されている場合** は、以下のルールに従って自動検証が行われます。

- required属性の場合  
  
required 属性を true にすると、配列の場合はデフォルトで **Submitされた配列の全ての要素** が入力されていなければなりません。  
  
「特定の数以上の要素」が入力されなければならない場合は、'required' => true の指定に加え、以下のように _required\_num_ 属性を指定します。  
  

    $form = array(
        'sample' => array(
            'type' => array(VAR_TYPE_INT),
            'form_type' => FORM_TYPE_TEXT,
            'required' => true,
            'required_num' => 2, // sampleには2個以上の入力が必須
        ),
    );

  
また、特定の要素（例：2番目の要素と3番目の要素）のみ入力を必須にしたい場合もあると思います。その場合は、'required' => true の指定に加え、以下の通り _required\_key_ 要素を指定します。この場合は 最初の要素を「0」として、その後順番に必要な要素の位置を指定します。  
  

    $form = array(
        'sample' => array(
            'type' => array(VAR_TYPE_INT),
            'form_type' => FORM_TYPE_TEXT,
            'required' => true,
            'required_key' => array(0,2,4), // 1番目, 3番目, 5番目の要素入力が必須。
        ),
    );

- required 属性以外の要素は、入力された各要素に対して、指定された属性を満たすかどうかのチェックが行われます。

#### 補足属性 [](ethna-document-dev_guide-form-validate.html#k28ea116 "k28ea116")

name属性にはフォームの表示名(フォーム名が'mailaddress'なら'メールアドレス'のようになる)を、form\_type属性にはフォームの種別を設定します。form\_typeに設定可能な値は以下の通りです。この属性は、フォームヘルパで特に重要です。

[フォームヘルパのページ](ethna-document-dev_guide-view-form_helper.html "ethna-document-dev\_guide-view-form\_helper (998d)") も参照してください。

| FORM\_TYPE\_TEXT | テキストボックス |
| FORM\_TYPE\_PASSWORD | パスワード |
| FORM\_TYPE\_TEXTAREA | テキストエリア |
| FORM\_TYPE\_SELECT | セレクトボックス |
| FORM\_TYPE\_RADIO | ラジオボタン |
| FORM\_TYPE\_CHECKBOX | チェックボックス |
| FORM\_TYPE\_BUTTON | ボタン |
| FORM\_TYPE\_FILE | ファイル |
| FORM\_TYPE\_HIDDEN | 隠れコントロール |

#### 属性設定例 [](ethna-document-dev_guide-form-validate.html#n9f7986e "n9f7986e")

以下に、幾つかの設定例を挙げますので、ご参考にして下さい。

sampleというテキストボックス(表示名「サンプル」)に16〜32文字の英字のみ許可(必須):

    $form = array(
        'sample' => array(
            'name' => 'サンプル',
            'required' => true,
            'min' => 16,
            'max' => 32,
            'regexp' => '/^[a-zA-Z]+$/',
            'form_type' => FORM_TYPE_TEXT,
            'type' => VAR_TYPE_STRING,
        ),
    );

foobar というテキストボックスに、全角ひらがなのみを入力することを許可する場合（必須）  
**regexp 属性と異なり、正規表現にスラッシュを付ける必要がないことに注意して下さい。** \*5

    $form = array(
        'foobar' => array(
            'name' => 'ひらがなのみを許可するテキストボックス',
            'required' => true,
            'mbregexp' => '^[ぁ-んー]+$', // 正規表現 前後にスラッシュは不要！
            'mbregexp_encoding' => 'UTF-8', // マッチさせる文字列のエンコーディング
            'form_type' => FORM_TYPE_TEXT,
            'type' => VAR_TYPE_STRING,
        ),
    );

question[]というチェックボックス(表示名「質問」):

    $form = array(
        'question' => array(
            'name' => '質問',
            'form_type' => FORM_TYPE_CHECKBOX,
            'type' => array(VAR_TYPE_BOOLEAN),
        ),
    );

### (2) validate()メソッドを実行する [](ethna-document-dev_guide-form-validate.html#q3252e93 "q3252e93")

上記のようにフォーム値を定義したら、あとはvalidate()メソッドを実行するだけです。validate()メソッドは、各アクションのprepare()メソッドで実行します。具体的には以下のようになります。

    class Sample_Action_LoginDo extends Ethna_ActionClass
    {
    ...
        function prepare()
        {
            if ($this->af->validate() > 0) {
                // フォーム値の自動検証でエラーが発生している
                // -> 再度ログイン画面を表示
                return 'login';
            }
    
            // エラーが無ければnullを返す(引き続いてperform()メソッドが実行される
            return null;
        }
    ...
    }

要するに、アクションフォーム(アクションクラスのメンバ変数$action\_formあるいは$afとして予め設定されています)のvalidate()メソッドを実行して、1以上の値が返されたら再度入力画面へ遷移すればよいだけです。

### (3) エラーメッセージを表示する [](ethna-document-dev_guide-form-validate.html#n3bdf1a4 "n3bdf1a4")

入力画面でエラーが発生したら、当然ですがエラーメッセージを表示させなければなりません。ここではその方法をご説明します。とはいっても、全てのエラーメッセージはSmartyの変数としてアサインされているので、単純にそれの値にアクセスすればよいだけです。

なお、ここで表示するエラーメッセージは勿論カスタマイズすることが出来ます。詳細は [エラーメッセージをカスタマイズする](ethna-document-dev_guide-form-message.html "ethna-document-dev\_guide-form-message (619d)")を御覧下さい。

#### エラーメッセージ一覧 [](ethna-document-dev_guide-form-validate.html#s5490770 "s5490770")

何は無くとも全てのエラーメッセージを表示させる場合は、$errors変数を利用します。以下はその典型的な例となります。

    {if count($errors)}
     <ul>
      {foreach from=$errors item=error}
       <li>{$error}</li>
      {/foreach}
     </ul>
    {/if}

#### 特定のフォームに対するエラーメッセージ [](ethna-document-dev_guide-form-validate.html#d6b7dac9 "d6b7dac9")

特定のフォームに対応するエラーメッセージを表示させるにはEthna組み込みのSmarty関数{message}を利用します。

引数$nameにフォーム名を指定することでフォーム名に対応するエラーメッセージ(無ければ空文字列)が表示されます。以下はその例です:

    <input type="text" name="mailaddress" value="{$form.mailaddress}">
    {message name="mailaddress"}

また、特定のフォームでエラーが発生しているかどうかを知るには同じくEthna組み込みのSmarty関数{is\_error}を利用します。

    {if is_error('mailaddress')}
    エラー
    {/if}

### 補足 [](ethna-document-dev_guide-form-validate.html#rc31d153 "rc31d153")

- 最近はフォーム属性をちまちま書くのすら面倒になってきました。もうちょっと楽できないものか考え中です
- アプリケーションでSmartyプラグインを追加することで以下のようにもうちょっと楽できます
  - エラーだったら<span class="error"></span>で自動で囲ったり、required属性が設定されていたら自動で「(\*)」を表示させたりするプラグインを書くことで、より楽をすることも出来ます(僕はしています)
  - ついでに<input>タグもある程度自動で出力するプラグインを書くとさらに楽です(こちらはEthna組み込みで提供したいなー、と思っています。JavaScriptコードも自動生成する機能とかもつけて)

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1エラー処理の詳細については [エラー処理ポリシー](ethna-document-dev_guide-error-policy.html "ethna-document-dev\_guide-error-policy (1240d)")等を参照してください  
\*2 [アプリケーション構築手順(3)](ethna-document-tutorial-practice3.html#content_1_4 "ethna-document-tutorial-practice3 (1240d)")も参照してください  
\*3例えば、入力値が必須で合った場合のエラーメッセージはテキストボックスなら「入力してください」、セレクトボックスなら「選択してください」というように振り分ける  
\*4この件は、代替案がPHP 5.2.6の時点では見つかっていないことから、「仕様」としてプロジェクトとしてはWONTFIX(修正しない) 方針です。代替案の提案がある方は、 [IRCやメーリングリスト](ethna-community.html) でお願いします。  
\*5UTF-8 な文字列であれば、mbregexp を使わずに、/^ほげ$/u としてもマルチバイト対応の正規表現チェックが利用できます。  

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
