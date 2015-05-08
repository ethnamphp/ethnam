<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
ファイルや配列にアクセスする - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# ファイルや配列にアクセスする 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [フォーム定義](ethna-document-dev_guide-form.html) > ファイルや配列にアクセスする 

- ファイルや配列にアクセスする 
  - ファイルへのアクセス 
  - 配列へのアクセス 
    - ファイルの配列の場合 
  - 多次元配列 

## ファイルや配列にアクセスする [](ethna-document-dev_guide-form-type.html#f820d5c3 "f820d5c3")

### ファイルへのアクセス [](ethna-document-dev_guide-form-type.html#aa20c2e4 "aa20c2e4")

アップロードされたファイルへのアクセスは、その処理の大部分をPHPが行ってくれるので至って簡単です。

まず、 [フォーム値にアクセスする](ethna-document-dev_guide-form-overview.html "ethna-document-dev\_guide-form-overview (1240d)")で記述した場合と同様に、フォーム値を定義します。

    'sample_file' => array(
        'type' => VAR_TYPE_FILE,
    ),

ここで大事なのは、'type'属性にVAR\_TYPE\_FILEを指定していることで、ここをVAR\_TYPE\_STRING等にしているとアップロードされたファイルにアクセスできませんのでご注意下さい。

次にファイルをアップロードするためのテンプレートを記述します。ここでは特別な点はなにもありません。

    ...
    <form method="post" enctype="multipart/form-data">
     <input type="file" name="sample_file">
     <input type="submit">
    </form>
    ...

後はprepare()あるいはperform()メソッドでアクションフォームを通じてフォーム値にアクセスするだけです。アップロードされたファイルは、PHPの$\_FILES変数と同様にアクセスが可能です。従って:

    perform()
    {
        var_dump($this->af->get('sample_file'));
    }

とすると

    array(5) {
      ["name"]=>
      string(10) "sample.gif"
      ["type"]=>
      string(9) "image/gif"
      ["tmp_name"]=>
      string(14) "/tmp/php3PxT99"
      ["error"]=>
      int(0)
      ["size"]=>
      int(220)
    }

というような結果となります。各要素の詳細については [PHPマニュアルのファイルアップロードに関するセクション](http://jp2.php.net/manual/ja/features.file-upload.php)を御覧下さい。

また、フォーム値自体が送信されていない場合、

    null

となります。また、ファイルが何もアップロードされなかった場合は以下のようにerror要素に4\*1が返されます。

    array(5) {
      ["name"]=>
      string(0) ""
      ["type"]=>
      string(0) ""
      ["tmp_name"]=>
      string(0) ""
      ["error"]=>
      int(4)
      ["size"]=>
      int(0)
    }

なお、ファイルに関してもフォーム値の自動検証を利用して、必須チェック、ファイルの最大、最小サイズ等のチェックが可能です。

### 配列へのアクセス [](ethna-document-dev_guide-form-type.html#dfb5b67e "dfb5b67e")

配列を使用する場合も、特別に手間は掛かりません。まずフォーム値を以下のように定義します。

    'sample_array' => array(
        'type' => array(VAR_TYPE_STRING),
    ),

見ての通り、'type'属性に定数1つを要素にもつ配列を指定します。これにより、このフォーム値は配列であることを明示します。

テンプレートに関しても特別な点はなく、通常のPHPでのフォーム配列と同様です。

    <form method="post">
     <input type="checkbox" name="sample_array[]" value="1">
     <input type="checkbox" name="sample_array[]" value="2">
     <input type="checkbox" name="sample_array[]" value="3">
     <input type="checkbox" name="sample_array[]" value="4">
     <input type="submit">
    </form>

続いてファイル等と同様にprepare()あるいはperform()メソッドでアクションフォームを通じてフォーム値にアクセスするだけです。例えば以下のように

    perform()
    {
        var_dump($this->af->get('sample_array'));
    }

とすると

    array(2) {
      [0]=>
      string(1) "3"
      [1]=>
      string(1) "4"
    }

のように配列を取得することが出来ます。なお、フォーム値に何も入力されない、あるいはフォーム値自体が送信されなかった場合は

    null

となります。ただし、末尾のブラケット削除してフォーム値が送信された場合、その値をスカラー値として扱われます。つまり、上記の例で、

    /?sample_array=string

というアクセスがあると

    string(6) "string"

という結果になるということです。これについてはフォーム値の自動検証で抑止することが出来ます(配列指定のフォーム値にスカラー値が渡された場合に自動的にエラーとすることが出来ます)。

#### ファイルの配列の場合 [](ethna-document-dev_guide-form-type.html#h1f84665 "h1f84665")

$\_FILESの配列とは構造が変わっています。基本的には、単一のファイルをアップロードした内容が複数並ぶだけです。たとえばふたつアップロードした場合は以下のようになります。

    array(2) {
      [0]=> array(5) {
        ["name"]=> string(11) "Sunset.jpeg"
        ["type"]=> string(10) "image/jpeg"
        ["size"]=> int(71189) 
        ["tmp_name"]=> string(14) "/tmp/php9bU0Wm"
        ["error"]=> int(0)
      }
      [1]=> array(5) {
        ["name"]=> string(11) "Sunset.jpeg"
        ["type"]=> string(10) "image/jpeg"
        ["size"]=> int(71189) 
        ["tmp_name"]=> string(14) "/tmp/php7aF1Ll"
        ["error"]=> int(0)
      }
    }

そして、複数アップロードする場合、アップロードされなかったものについては、NULLではなく、該当するフィールドのerror要素に4が設定されます。これは単一のアップロードの場合と同様です。

以下に「ひとつめのフィールド」だけアップロードし、「ふたつめのフィールド」をアップロード「しなかった」場合の例を示します。

    array(2) {
      [0]=> array(5) {
        ["name"]=> string(11) "Sunset.jpeg"
        ["type"]=> string(10) "image/jpeg"
        ["size"]=> int(71189) 
        ["tmp_name"]=> string(14) "/tmp/php9bU0Wm"
        ["error"]=> int(0)
      }
      [1]=> array(5) {
        ["name"]=> string(0) ""
        ["type"]=> string(0) ""
        ["size"]=> int(0)
        ["tmp_name"]=> string(0) ""
        ["error"]=> int(4)
      }
    }

### 多次元配列 [](ethna-document-dev_guide-form-type.html#a46554c9 "a46554c9")

フォーム定義を以下のように [] を使ってグループ化することで、グループ化した値を簡単に受け取ることができます。詳しくは [多次元配列にアクセスする](ethna-document-dev_guide-form-multiarray.html "ethna-document-dev\_guide-form-multiarray (737d)") のページを参照してください。

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
       );

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1PHP 4.3.0以降ではUPLOAD\_ERR\_NO\_FILEという定数が割り当てられています  

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
