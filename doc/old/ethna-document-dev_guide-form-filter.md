# フォーム値の自動検証を行う(フィルタ編)
  - サンプル 
  - フィルタの利用方法 

## フォーム値の自動検証を行う(フィルタ編) [](ethna-document-dev_guide-form-filter.html#mc7f24c8 "mc7f24c8")

フォーム値の自動検証フレームワークには、値の検証だけではなく変換処理も組み込まれています。この機能を利用することで、フォーム値に含まれる半角カナを自動的に全角に変換したり、受け取りたくない文字列を削除することが出来ます。

### サンプル [](ethna-document-dev_guide-form-filter.html#ncfc34c3 "ncfc34c3")

機能としてはとっても分かりやすいものなので、まずは例を挙げてみます。アクションフォームクラスの$formメンバに、'filter'属性を追加します(その他の属性については [フォーム値の自動検証を行う(基本編)](ethna-document-dev_guide-form-validate.html "ethna-document-dev\_guide-form-validate (737d)")を御覧下さい)。

    /**
      * @access private
      * @var array フォーム値定義
      */
     var $form = array(
         'sample' => array(
             'name' => 'サンプル',
             'required' => true,
             'filter' => 'sample',
             'type' => VAR_TYPE_STRING,
         ),
     );

次に、同じくアクションフォームクラスに'\_filter\_sample'というメソッドを定義します。

    /**
      * フォーム値変換フィルタ: サンプル
      *
      * @access protected
      * @param mixed $value フォーム値
      * @return mixed 変換結果
      */
     function _filter_sample($value)
     {
         return strtoupper($value);
     }

以上で準備は完了です。あとは対応するアクションクラスでvalidate()メソッドを呼び出します。

    /**
      * indexアクションの前処理
      *
      * @access public
      * @return string Forward先(正常終了ならnull)
      */
     function prepare()
     {
         if ($this->af->validate() > 0) {
             return 'error';
         }
     
         return null;
     }

ここでperform()メソッドでフォーム値「sample」にアクセスすると、値が大文字に変換されていると思います。なお、 **validate()メソッドを呼び出さないとfilter処理は実行されません** のでご注意下さい。というか、validate()しないでフォーム値にアクセスしないで下さい。

    /**
      * indexアクションの実装
      *
      * @access public
      * @return string 遷移名
      */
     function perform()
     {
         var_dump($this->af->get('sample'));
     
         return 'index';
     }

    /index.php?sample=stringにアクセス:
    
    string(6) "STRING"

### フィルタの利用方法 [](ethna-document-dev_guide-form-filter.html#p2b7fbd1 "p2b7fbd1")

以上の通り、フィルタの利用方法は簡単で:

1. フォーム値のfilter属性に、フィルタ名をカンマで区切って列挙する
2. フィルタメソッドをアクションフォームクラスに"\_filter\_[フィルタ名]"という名前で定義する
3. validate()を実行する

という形になります。なお、Ethna\_ActionFormには予め以下のようなフィルタメソッドが定義されていますので、基本的な変換についてはフィルタメソッドの定義は必要ありません。

- numeric\_zentohan: 全角数字→半角数字
- alphabet\_zentohan: 全角英字→半角英字
- ltrim: 左空白削除
- rtrim: 右空白削除
- ntrim: NULLバイト削除
- kana\_hantozen: 半角カナ→全角カナ

ですので、例えば常に半角で値を受け取りたい場合は

    'filter' => 'numeric_zentohan,alphabet_zentohan,ltrim,rtrim,ntrim',

とします。また、全角で値を受け取りたい場合は

    'filter' => 'kana_hantozen,ntrim',

として半角カナを変換します。なお、上記2つについてはそれぞれFILTER\_HW(Half Width)とFILTER\_FW(Full Width)という定数が定義されているので、

    'filter' => FILTER_HW,

と

    'filter' => FILTER_FW,

と記述することが出来ます。

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
