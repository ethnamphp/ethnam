# フォーム値の自動検証を行う(フィルタ編)
  - サンプル 
  - フィルタの利用方法 

## フォーム値の自動検証を行う(フィルタ編)

フォーム値の自動検証フレームワークには、値の検証だけではなく変換処理も組み込まれています。この機能を利用することで、フォーム値に含まれる半角カナを自動的に全角に変換したり、受け取りたくない文字列を削除することが出来ます。

### サンプル

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

### フィルタの利用方法

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

