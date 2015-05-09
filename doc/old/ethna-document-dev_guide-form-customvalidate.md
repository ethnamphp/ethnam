<title>
フォーム値の自動検証を行う(カスタムチェック編) - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# フォーム値の自動検証を行う(カスタムチェック編) 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [フォーム定義](ethna-document-dev_guide-form.html) > フォーム値の自動検証を行う(カスタムチェック編) 

- フォーム値の自動検証を行う(カスタムチェック編) 
  - カスタムチェックの利用方法 
    - カスタムチェックメソッドの引数 
    - カスタムチェックメソッドのエラー処理 

## フォーム値の自動検証を行う(カスタムチェック編) [](ethna-document-dev_guide-form-customvalidate.html#qc9efb3e "qc9efb3e")

当然ですが、値の最小値や最大値、正規表現だけで全ての入力をチェックできるケースばかりとは限りません。アプリケーションによって、数々のパターンの入力チェックが必要になることと思います。

### カスタムチェックの利用方法 [](ethna-document-dev_guide-form-customvalidate.html#b8925b7b "b8925b7b")

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

#### カスタムチェックメソッドの引数 [](ethna-document-dev_guide-form-customvalidate.html#kfc8fca5 "kfc8fca5")

カスタムチェックメソッドは1つの引数$nameを取ります。ここにはチェックすべきフォーム名が指定されます。ですので、チェックすべきフォーム値には

    $this->form_vars[$name]

でアクセスできるということになります。

#### カスタムチェックメソッドのエラー処理 [](ethna-document-dev_guide-form-customvalidate.html#zc762831 "zc762831")

フォーム値を検証して、エラーが発生した場合にはアクションエラーオブジェクトを利用してエラーを追加します。具体的には、上記の例の通り

    $this->ae->add([フォーム名], [エラーメッセージ], [エラーコード]);

となります。フォーム名には迷わず$nameを指定して問題ありません。また、エラーコードは以下のいずれか、あるいはアプリケーション定義の任意のエラーコードを指定することが出来ますが、通常はE\_FORM\_INVALIDVALUEあるいはE\_FORM\_INVALIDCHARで問題ありません。

- E\_FORM\_WRONGTYPE\_SCALAR(フォーム値型エラー(スカラー引数に配列指定))
- E\_FORM\_WRONGTYPE\_ARRAY(フォーム値型エラー(配列引数にスカラー指定))
- E\_FORM\_WRONGTYPE\_INT(フォーム値型エラー(整数型))
- E\_FORM\_WRONGTYPE\_FLOAT(フォーム値型エラー(浮動小数点数型))
- E\_FORM\_WRONGTYPE\_DATETIME(フォーム値型エラー(日付型))
- E\_FORM\_WRONGTYPE\_BOOLEAN(フォーム値型エラー(BOOL型))
- E\_FORM\_WRONGTYPE\_FILE(フォーム値型エラー(FILE型))
- E\_FORM\_REQUIRED(フォーム値必須エラー)
- E\_FORM\_MIN\_INT(フォーム値最小値エラー(整数型))
- E\_FORM\_MIN\_FLOAT(フォーム値最小値エラー(浮動小数点数型))
- E\_FORM\_MIN\_STRING(フォーム値最小値エラー(文字列型))
- E\_FORM\_MIN\_DATETIME(フォーム値最小値エラー(日付型))
- E\_FORM\_MIN\_FILE(フォーム値最小値エラー(ファイル型))
- E\_FORM\_MAX\_INT(フォーム値最大値エラー(整数型))
- E\_FORM\_MAX\_FLOAT(フォーム値最大値エラー(浮動小数点数型))
- E\_FORM\_MAX\_STRING(フォーム値最大値エラー(文字列型))
- E\_FORM\_MAX\_DATETIME(フォーム値最大値エラー(日付型))
- E\_FORM\_MAX\_FILE(フォーム値最大値エラー(ファイル型))
- E\_FORM\_REGEXP(フォーム値文字種(正規表現)エラー)
- E\_FORM\_INVALIDVALUE(フォーム値数値(カスタムチェック)エラー)
- E\_FORM\_INVALIDCHAR(フォーム値文字種(カスタムチェック)エラー)
- E\_FORM\_CONFIRM(確認用エントリ入力エラー)

最後に、エラーメッセージにはユーザ向けに表示したいエラーメッセージを指定します。なお、ここで「{form}」と記述するとフォーム表示名に置換されます。

なお、Ethna\_ActionFormには予め以下のようなカスタムメソッドが定義されています。

- checkVendorChar: 機種依存文字
- checkBoolean: bool値
- checkMailaddress: メールアドレス
- checkURL: URL

例えばメールアドレスのチェックを行うには

    'custom' => 'checkMailaddress',

と指定します。

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
