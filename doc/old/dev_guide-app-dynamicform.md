# フォーム定義を動的に変更する
Ethna でのアクションフォームの定義は、以下のように固定の配列として定義します。つまり、クラスのメンバとして宣言するため、PHP では関数コールや変数の形でフォーム定義を動的に定義することはできません。これは PHP の言語仕様上の制限です\*1

ここでは、そうした制限を越えて、フォーム定義をsubmit後に変更する方法を示します。

    $form = array(
           'sample' => array( // 正しいフォーム定義
               'type' => VAR_TYPE_INT,
               'name' => 'sample',
               // ...
           ),
           'invalid' => array( // 間違ったフォーム定義
               'type' => $dynamic_type, // 変数は駄目
               'name' => _('invalid'), // gettext 等、動的な呼び出しは×
               // ...
           ),

- フォーム定義を動的に変更する 
  - フォーム定義を動的にしなければならない理由 
  - Ethna 2.5.0 以降でのやり方 
    - フォーム定義変更専用のヘルパメソッド 
    - フォームヘルパが絡んだ場合 
  - Ethna 2.3.5 以前のやり方 
    - どこに書くか？ 
    - フォーム定義の設定 
    - submitされた値を設定しなおす 
    - 全体のサンプルコード 
    - (参考)ActionFormのform定義を直接変更する方法 

| 書いた人 | key | ---------- | 新規作成 |
| 書いた人 | mumumu | 2009-01-28 | 最新版に追随する形で全面的に修正 |
| 書いた人 | mumumu | 2009-06-03 | フォームヘルパが絡んだ場合の記述を追加 |
| 書いた人 | DQNEO | 2010-11-11 | ActionFormのform定義を直接変更する方法を追加 |

### フォーム定義を動的にしなければならない理由

動的にフォーム定義を Ajax 等で動的にブラウザ側のインターフェイスを変更するようになった今にあっては、submitされた値、または データベースやセッションの値に応じて、フォーム定義を変更したいとの要求は自然に出てくるでしょう。

ひとつの例として、SELECT ボックスを複数段展開させなければいけない場合をあげてみます。都道府県を選んだ後に、市町村のSELECTボックスの値を変えなければならなくなったら、固定のフォーム定義ではうまくいかないでしょう

    都道府県: <select name="prefecture">
                <option value="1">北海道</option>
                ...
              </select>
    市町村: <select name="city">
                <option value="1">北海道なら札幌</option>
                <option value="2">神奈川なら横浜</option>
                ...
              </select>

### Ethna 2.5.0 以降でのやり方

Ethna 2.5.0 以降では、フォーム定義を動的に変更するための場所を統一するためのAPIが整備されました。フォーム定義はアクションフォームに関することなので、Ethna\_ActionForm クラスのメソッドで統一するのがスマートです。

よって、以下のようなAPI が定義されています。

#### フォーム定義変更専用のヘルパメソッド

Ethna 2.5.0 以降では、Ethna\_ActionForm#setFormDef\_PreHelper を使います。このメソッドを呼び出す前に、Ethna\_Session, Ethna\_Backend などがすべて初期化されるため、データベースやセッションの値に基づいてフォーム定義を設定することが可能です。

また、このメソッドが呼び出されたあと、Ethna\_ActionForm#setFormVars が呼び出されるため、上記で設定したフォーム定義に基づいて submit した値が自動設定されます。

    /**
      * フォーム定義変更用、ユーザ定義ヘルパメソッド
      *
      * Ethna_ActionForm#prepare() が実行される前に
      * ユーザが動的にフォーム定義を変更したい場合に
      * このメソッドをオーバーライドします。
      *
      * $this->backend も初期化済みのため、DBやセッション
      * の値に基づいてフォーム定義を変更することができます。
      *
      * @access public
      */
    function setFormDef_PreHelper()
    {
        // セッションや DBのオブジェクトを以下のようにして利用可能   
        $session = $this->backend->getSession();
        $db = $this->backend->getDB();
    
        // フォーム名とフォーム定義の設定
        $name = "question_1";
        $def = array (
                  'name' => $name . "の答え", // 動的なフォーム定義
                  'required' => true,
                  'form_type' => FORM_TYPE_TEXT,
                  'type' => VAR_TYPE_STRING,
                  'filter' => null,
              );
        $this->setDef($name, $def);
        
        // このメソッド呼び出しのあと、Ethna_ActionForm#setFormVars
        // が呼び出され、上記で追加した question_1 の値も
        // 自動で設定される。
    }

#### フォームヘルパが絡んだ場合

フォームヘルパについては、 [フォームヘルパ](dev_guide-view-form_helper.md) の説明も参照してください。

少し高度な話題ですが、フォームヘルパは、Ethna\_ViewClass で現在のフォームとは別に、以下のように ethna\_action で指定されたアクションフォームを初期化します。それは、Submit されたときに初期化されたアクションフォームとは別のため、動的に値を設定したい場合は別のAPI が必要になります。

    {form ethna_action="formhelper"}
      {* [appid]Form_Formhelper というアクションフォームが初期化される *} 
    {/form}

フォームヘルパで利用するフォーム定義を動的に変更したい場合は、以下の特別なメソッドを使います。使い方は [フォーム定義変更専用のヘルパメソッド](dev_guide-app-dynamicform.md#j5cff07b) で説明した setFormDef\_PreHelper() と全く同じです。

    /**
      * フォーム定義変更用、ユーザ定義ヘルパメソッド
      *
      * フォームヘルパを使うときに、フォーム定義を動的に
      * 変更したい場合に、このメソッドをオーバライドします。
      *  
      * このメソッドは、以下の定義をテンプレートで行った場
      * 合に呼び出されます。
      *
      * {form ethna_action=...} (ethna_action がない場合は呼び出されません)
      * {form_input action=...} (action がない場合は呼び出されません)
      *
      * @access public
      */
    function setFormDef_ViewHelper()
    {
        // TODO: デフォルト実装は Ethna_ActionClass#prepare の直前
        // に呼び出されるものと同じ。異なる場合にオーバライドする
        $this->setFormDef_PreHelper();
    }

### Ethna 2.3.5 以前のやり方

#### どこに書くか？

動的な定義も含めてActionFormの中で完結させたいところですが、ActionForm 内にはロジックが書けないため、データベースのインスタンスを拾うなどしてフォーム定義を動的に変更することができません。

Ethna\_ActionClass#prepare もしくは Ethna\_ActionClass#perform に処理を記述すればよいですが、フォーム値の自動検証を Ethna\_ActionClass#prepare で行うのが一般的であることを考えると、前処理を行う prepareに処理を書いたほうがスマートです。

#### フォーム定義の設定

まず、フォーム名とその定義がどのようなものになるかを決めます。以下の例では、フォーム定義 $def に "$name の答え" という動的な値を定義しています。

    // フォーム名とフォーム定義の設定
        $name = "question_1";
        $def = array (
                  'name' => $name . "の答え", // 動的なフォーム定義
                  'required' => true,
                  'form_type' => FORM_TYPE_TEXT,
                  'type' => VAR_TYPE_STRING
                  'filter' => null,
              );

しかしActionFormのインスタンスにこの定義を設定しない限り、このフォーム定義は使用できません。

よって以下のようにして、Ethna\_ActionForm#setDef メソッドを呼び出してフォーム定義を設定します。  
複数のフォーム定義を処理するには、この処理をループさせればよいでしょう。

    // フォーム定義をセットする
        $this->af->setDef($name, $def);

#### submitされた値を設定しなおす

Ethna\_ActionForm#setDef を呼び出しただけでは、アクションフォーム内のフォーム定義が変更されただけで、submit された値がアクションフォームに設定されたわけではありません。

よって、以下のようにして $\_POST や $\_GET 等の値をアクションフォームのインスタンスに再設定してやります。

    // submit された $_POST 等の値をアクションフォーム
        // に設定しなおす
        $this->af->setFormVars();

こうすれば、新しいフォーム定義に基づいて検証を行うことができます。

    // 新しいフォーム定義に基づいてフォーム値を検証
        if ($this->af->validate() > 0) {
            return 'index';
        }

#### 全体のサンプルコード

上記の説明で使ったサンプルコードの全容をまとめると、以下のようになります (左側は行番号です)

    1: function prepare() {
    2:
    3: // フォーム名とフォーム定義の設定
    4: $name = "question_1";
    5: $def = array (
    6: 'name' => $name . "の答え", // 動的なフォーム定義
    7: 'required' => true,
    8: 'form_type' => FORM_TYPE_TEXT,
    9: 'type' => VAR_TYPE_STRING
    10: 'filter' => null,
    11: );
    12:
    13: // フォーム定義をセットする
    14: $this->af->setDef($name, $def);
    15:
    16: // submit された $_POST 等の値をアクションフォーム
    17: // に設定しなおす
    18: $this->af->setFormVars();
    19:    
    20: // 新しいフォーム定義に基づいてフォーム値を検証
    21: if ($this->af->validate() > 0) {
    22: return 'index';
    23: }
    24:}

#### (参考)ActionFormのform定義を直接変更する方法

別のやり方として、prepare内で、$this->af->formを直接変更するやり方もあります。

[http://ethna.jp/ethna-document-faq-dev\_guide\_faq.html#jee57430](faq-dev_guide_faq.md#jee57430)


* * *
\*1(クラスのメンバ変数が固定でなければならない根拠としては、PHP4では、 [http://jp.php.net/manual/ja/keyword.class.php](http://jp.php.net/manual/ja/keyword.class.php) が、PHP5 では、 [http://jp.php.net/manual/ja/language.oop5.basic.php](http://jp.php.net/manual/ja/language.oop5.basic.php) があります。  

