# 多次元配列へのアクセス
配列をグループ化するために、多次元配列を使うこともできます。グループ化することで、 フォーム項目の名前が重複したり、ひとつのフォーム内に複数のテーブルへの項目が存在 していた場合に有利になる局面があります。

多次元でフォーム定義を行うことで、通常のアクションフォームの使い方と同様のやり方で、グループ化して値を取得することができるようになります。

    この機能を使うためには、Ethna 2.5.0 以降が必要です

- 多次元配列へのアクセス 
  - 基本的なやり方 
  - 配列型を指定した場合 
  - ファイルを指定した場合 
  - テンプレート上での値の参照の仕方はどうなるの？ 
  - フォーム値の自動検証やフォームヘルパはどうなるの？ 
  - 多次元配列を指定する場合の制限事項 
    - 指定できる配列の階層の深さはデフォルト10階層まで 
    - 矛盾したフォーム指定をした場合 

| 書いた人 | mumumu | 2009-01-22 | 新規作成 |

### 基本的なやり方

フォーム定義を以下のように [] 付きのキーで分類して定義するだけです。例を以下に示します。

[phone][home]や、[phone][mobile] のように、複数の階層を使って定義することも可能です。

    var $form = array(
           'User[name]' => array(
               'name' => '名前',
               'type' => VAR_TYPE_STRING,
               'form_type' => FORM_TYPE_TEXT,
           ),
           'User[phone][home]' => array(
               'name' => '自宅電話番号',
               'type' => VAR_TYPE_STRING,
               'form_type' => FORM_TYPE_TEXT,
           ),
           'User[phone][mobile]' => array(
               'name' => '携帯電話番号',
               'type' => VAR_TYPE_STRING,
               'form_type' => FORM_TYPE_TEXT,
           ),

テンプレートに関しても特別な点はなく、通常のPHPでのフォーム多次元配列と同様です。

    <form method="post">
      <input type="text" name="User[name]" value="宮崎あおい" />
      <input type="text" name="User[phone][home]" value="01-2345-6789" />
      <input type="text" name="User[phone][mobile]" value="090-1234-5678" />
      <input type="submit">
    </form>

続いて、通常のフォームの配列と同様に、アクションクラスの prepare()あるいはperform()メソッドでアクションフォームを通じてフォーム値にアクセスするだけです。例えば以下のように

    perform()
    {
        var_dump($this->af->get('User'));
    }

とすると

    array(2) {
      ["name"]=>
      string(15) "宮崎あおい"
      ["phone"]=> array(2) {
        ["home"]=>
        string(12) "01-2345-6789"
        ["mobile"]=>
        string(13) "090-1234-5678"
      }
    }

のように指定した階層以下の配列を全て取得することが出来ます。また、User[name] User[phone] のような、途中の階層を指定して以下のようにフォーム値を取得することもできます。

    perform()
    {
        // string(15) "宮崎あおい" を取得
        var_dump($this->af->get('User[name]'));
    
        // 階層の途中の場合も、以下のように途中から
        // 配列を取得可能
        //
        // array(2) {
        // ["home"]=>
        // string(12) "01-2345-6789"
        // ["mobile"]=>
        // string(13) "090-1234-5678"
        // }
        var_dump($this->af->get('User[phone]'));
    }

当然、以下のように最下層の値も取得可能です

    perform()
    {
        // 最下層の配列を指定した場合 
        // string(15) "01-2345-6789" を取得
        var_dump($this->af->get('User[phone][home]'));
    
        // string(13) "090-1234-5678"
        var_dump($this->af->get('User[phone][mobile]'));
    }

なお、フォーム値に何も入力されない、あるいはフォーム値自体が送信されなかった場合は 配列の場合と同様に値は null となりますが、それぞれの項目自体は残ることに注意してください。たとえば、上記の例ですべての項目を入力せずに Submitした場合は、以下のようになります。

    array(2) {
      ["name"]=>
      NULL
      ["phone"]=> array(2) {
        ["home"]=>
        NULL
        ["mobile"]=>
        NULL
      }
    }

### 配列型を指定した場合

[ファイルや配列にアクセスする](ethna-document-dev_guide-form-type.html "ethna-document-dev\_guide-form-type (1006d)") のページも参照してください。

上記のページが理解できていれば、配列の階層が増えるだけで、あとは通常のEthnaと変わりありません。

たとえば、以下のようなフォームを定義したとします。typeにarray(VAR\_TYPE\_STRING)を指定しています。

    var $form = array(
           'Artist[name]' => array(
               'name' => '好きなキャラクター',
               'type' => array(VAR_TYPE_STRING),
               'form_type' => FORM_TYPE_TEXT,
           ),
       );

テンプレートは以下のように書いたとします。

    <form method="post">
      <input type="text" name="Artist[name][]" value="ほげ" />
      <input type="text" name="Artist[name][]" value="ふが" />
      <input type="text" name="Artist[name][]" value="むう" />
      <input type="submit">
    </form>

この場合、以下の方法でフォームに入力された情報を取得出来ます。

    //
     // array(1) {
     // ["name"]=>
     // array(3) {
     // [0]=>
     // string(6) "ほげ"
     // [1]=>
     // string(6) "ふが"
     // [2]=>
     // string(6) "むう"
     // }
     // }
     $var1 = $this->af->get('Artist');
    
     // array(3) {
     // [0]=>
     // string(6) "ほげ"
     // [1]=>
     // string(6) "ふが"
     // [2]=>
     // string(6) "むう"
     // }
     $var2 = $this->af->get('Artist[name]');
    
     // string(6) "ふが"
     $var3 = $this->af->get('Artist[name][0]'); // 一つ目のフォームの値
     
     // string(6) "むう"
     $var4 = $this->af->get('Artist[name][1]'); // 二つ目のフォームの値

### ファイルを指定した場合

[ファイルや配列にアクセスする](ethna-document-dev_guide-form-type.html "ethna-document-dev\_guide-form-type (1006d)") のページも参照してください。

上記のページが理解できていれば、他の型を使用した場合と特に変化ありません。つまり、階層構造を指定すれば、それに従った階層構造で値が取得できるようになります。

例えば、以下のような定義をしたとします。

    var $form = array(
           'File[foo]' => array(
               'name' => 'ファイルfoo',
               'type' => VAR_TYPE_FILE,
               'form_type' => FORM_TYPE_FILE,
           ),
           'File[bar]' => array(
               'name' => 'ファイルbar',
               'type' => VAR_TYPE_FILE,
               'form_type' => FORM_TYPE_FILE,
           ),
       );

テンプレートは以下のように書いたとします。

    <form method="post" enctype="multipart/form-data">
      <input type="file" name="File[foo]" />
      <input type="file" name="File[bar]" />
      <input type="submit">
    </form>

そして、下記の取得でフォームの値を出力したとします。

    $var = $this->af->get('File');
       print_r($var);

この場合の出力は以下となります。

    array (
      'foo' => 
      array (
        'name' => 'favicon.ico',
        'type' => 'image/x-icon',
        'size' => 318,
        'tmp_name' => '/tmp/phps2O45r',
        'error' => 0,
      ),
      'bar' => 
      array (
        'name' => 'authorized_keys.txt',
        'type' => 'text/plain',
        'size' => 611,
        'tmp_name' => '/tmp/phpn3njWB',
        'error' => 0,
      ),
    )

### テンプレート上での値の参照の仕方はどうなるの？

これまで見てきた通り、アクションで多次元配列として定義したフォーム値は、連想配列としてSubmitされてきます。

    var $form = array(
           'Artist[name]' => array(
               'name' => '好きなキャラクター',
               'type' => array(VAR_TYPE_STRING),
               'form_type' => FORM_TYPE_TEXT,
           ),
       );

よって、上記のような多次元配列のフォーム定義があるとすると、$Artist[name] の値は

    $form.Artist.name

としてテンプレート上で参照できます。$form.Artist[name] ではないので注意して下さい。これは Smarty での連想配列の参照の仕方と同じです。

### フォーム値の自動検証やフォームヘルパはどうなるの？

多次元配列の機能はフォーム値の自動検証、及びフォームヘルパに影響しません。

グループ化してフォームを定義した場合でも、 [矛盾したフォーム定義をしない限り](ethna-document-dev_guide-form-multiarray.html#ce69c0d9)自動検証の機能がそれぞれの項目について有効になります。

フォームヘルパの場合でも、以下のように普通に定義できます。

    {form_input name="User[phone][name]"}

フォーム値の自動検証については、 [フォーム定義のページ](ethna-document-dev_guide-form.html "ethna-document-dev\_guide-form (1006d)")を参照してください。  
フォームヘルパについては、 [フォームヘルパ](ethna-document-dev_guide-form-multiarray.html "ethna-document-dev\_guide-form-multiarray (737d)") を参照してください。

### 多次元配列を指定する場合の制限事項

多次元配列を指定できるということは、重複したキーや、深すぎる階層など、PHPの実装上都合の悪い指定もまた、指定できてしまうということを意味しています。ここでは、Ethna の多次元配列の実装上「できないこと」を説明します。

#### 指定できる配列の階層の深さはデフォルト10階層まで

Ethna では、以下のような深い階層も指定できます。但し、その階層の深さはデフォルト10階層までです。

Ethna では、多次元配列の処理に再帰処理を使用しています。よって、PHPの仕様により、処理できる階層は100までに制限されますが、Ethnaの内部ではこれより深い階層の値を指定しても「NULL」しか取得できません。

    // 10階層(1番上の "a" も含む)
    'a[b][c][d][e][f][g][h][i][j]' => array(
        'name' => '10階層の多次元配列',
        'type' => VAR_TYPE_STRING,
        'form_type' => FORM_TYPE_TEXT,
    ),
    
    // 11階層(1番上の "a" も含む)
    // この値は、最下層の値を取得しようとしてもNULLとなる
    'a[b][c][d][e][f][g][h][i][j][k]' => array(
        'name' => '11階層の多次元配列',
        'type' => VAR_TYPE_STRING,
        'form_type' => FORM_TYPE_TEXT,
    ),

#### 矛盾したフォーム指定をした場合

同じ項目名で、多次元配列とそうでない項目を指定したり等の矛盾した定義はできません。

片方で多次元配列でない普通のスカラーを指定し、他方で同じ名前の多次元配列のフォーム定義を複数行った場合、正確に全ての値が取得できません。（正確には、いずれかの値が取得できることもあるし、全て取得できないこともあります） 他の矛盾したフォーム定義の場合も同様です。

たとえば以下の場合、多次元配列である"sample[str]"に対して、フォーム配列の"sample"で指定した値の検証が有効になりますし、値が正確に取得できないため、いずれの値の検証機能もうまく動かないことがあります。

    'sample' => array(
         'name' => '数値のみ指定可能な配列。取得できる値はスカラー',
         'required' => true,
         'type' => array(VAR_TYPE_INT),
         'form_type' => FORM_TYPE_TEXT,
     ),
     'sample[str]' => array(
         'name' => '文字列が指定可能な多次元フォーム',
         'required' => true,
         'type' => VAR_TYPE_STRING,
         'form_type' => FORM_TYPE_TEXT,
     ),

