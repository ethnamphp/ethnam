# フォーム値の自動検証を行う(カスタムチェック編)
  - カスタムチェックの利用方法 
    - カスタムチェックメソッドの引数 
    - カスタムチェックメソッドのエラー処理 

## フォーム値の自動検証を行う(カスタムチェック編)

当然ですが、値の最小値や最大値、正規表現だけで全ての入力をチェックできるケースばかりとは限りません。アプリケーションによって、数々のパターンの入力チェックが必要になることと思います。

### カスタムチェックの利用方法

この場合、アプリケーション固有のメソッドでチェックを行うことも可能で、具体的な手順は以下のようになります。

1. フォーム値の'custom'属性にメソッド名を記述する
2. 1.で指定したメソッドをアクションフォームクラスに定義する

1.については簡単で:

    /**
     * @access private
     * @var array フォーム値定義
     */
    var $form = array(
        'sample' => array(
            'name' => 'サンプル',
            'required' => true,
            'custom' => 'checkSample',
            'type' => VAR_TYPE_STRING,
        ),
    );

のように'custom' => 'メソッド名'とするだけです。次に、同じくアクションフォームにcheckSampleという名前でメソッドを定義します。

    /**
     * チェックメソッド: サンプル
     *
     * @access public
     * @param string $name フォーム項目名
     */
    function checkSample($name)
    {
        if (strtotime($this->form_vars[$name]) > time()) {
            $this->ae->add($name, "{form}には未来の時間を入力してください", E_FORM_INVALIDVALUE);
        }
    }

以下に、チェックメソッドについて順に解説していきます。

#### カスタムチェックメソッドの引数

カスタムチェックメソッドは1つの引数$nameを取ります。ここにはチェックすべきフォーム名が指定されます。ですので、チェックすべきフォーム値には

    $this->form_vars[$name]

でアクセスできるということになります。

#### カスタムチェックメソッドのエラー処理

フォーム値を検証して、エラーが発生した場合にはアクションエラーオブジェクトを利用してエラーを追加します。具体的には、上記の例の通り

    $this->ae->add([フォーム名], [エラーメッセージ], [エラーコード]);

となります。フォーム名には迷わず$nameを指定して問題ありません。また、エラーコードは以下のいずれか、あるいはアプリケーション定義の任意のエラーコードを指定することが出来ますが、通常はE_FORM_INVALIDVALUEあるいはE_FORM_INVALIDCHARで問題ありません。

- E_FORM_WRONGTYPE_SCALAR(フォーム値型エラー(スカラー引数に配列指定))
- E_FORM_WRONGTYPE_ARRAY(フォーム値型エラー(配列引数にスカラー指定))
- E_FORM_WRONGTYPE_INT(フォーム値型エラー(整数型))
- E_FORM_WRONGTYPE_FLOAT(フォーム値型エラー(浮動小数点数型))
- E_FORM_WRONGTYPE_DATETIME(フォーム値型エラー(日付型))
- E_FORM_WRONGTYPE_BOOLEAN(フォーム値型エラー(BOOL型))
- E_FORM_WRONGTYPE_FILE(フォーム値型エラー(FILE型))
- E_FORM_REQUIRED(フォーム値必須エラー)
- E_FORM_MIN_INT(フォーム値最小値エラー(整数型))
- E_FORM_MIN_FLOAT(フォーム値最小値エラー(浮動小数点数型))
- E_FORM_MIN_STRING(フォーム値最小値エラー(文字列型))
- E_FORM_MIN_DATETIME(フォーム値最小値エラー(日付型))
- E_FORM_MIN_FILE(フォーム値最小値エラー(ファイル型))
- E_FORM_MAX_INT(フォーム値最大値エラー(整数型))
- E_FORM_MAX_FLOAT(フォーム値最大値エラー(浮動小数点数型))
- E_FORM_MAX_STRING(フォーム値最大値エラー(文字列型))
- E_FORM_MAX_DATETIME(フォーム値最大値エラー(日付型))
- E_FORM_MAX_FILE(フォーム値最大値エラー(ファイル型))
- E_FORM_REGEXP(フォーム値文字種(正規表現)エラー)
- E_FORM_INVALIDVALUE(フォーム値数値(カスタムチェック)エラー)
- E_FORM_INVALIDCHAR(フォーム値文字種(カスタムチェック)エラー)
- E_FORM_CONFIRM(確認用エントリ入力エラー)

最後に、エラーメッセージにはユーザ向けに表示したいエラーメッセージを指定します。なお、ここで「{form}」と記述するとフォーム表示名に置換されます。

なお、Ethna_ActionFormには予め以下のようなカスタムメソッドが定義されています。

- checkVendorChar: 機種依存文字
- checkBoolean: bool値
- checkMailaddress: メールアドレス
- checkURL: URL

例えばメールアドレスのチェックを行うには

    'custom' => 'checkMailaddress',

と指定します。

