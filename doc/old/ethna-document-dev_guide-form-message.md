# エラーメッセージをカスタマイズする

## エラーメッセージをカスタマイズする [](ethna-document-dev_guide-form-message.html#r1985191 "r1985191")

mixi:Ethnaコミュニティ:雑談:74(いちいさん)より

エラーメッセージの変更は、各フォームのActionFormのform値に 以下のように設定すると、変更が可能となっている。

    'required' => true,
    	'type' => VAR_TYPE_INT,
    	'required_error' => '入力してね',
    	'type_error' => '整数にしてね',

上記の例の場合、'required'に対してのエラーが'required\_error'に対応していて、エラーが起きると「入力してね」が、'type'に対してのエラーが'type\_error'に対応していて「整数にしてね」とエラーメッセージが設定される。

エラーのタイプとしては、Ethna\_ActionFormのhandleErrorでマッピングされているとおり、

    'required_error'	E_FORM_REQUIRED
    	'type_error' E_FORM_WRONGTYPE_SCALAR
    				E_FORM_WRONGTYPE_ARRAY
    				E_FORM_WRONGTYPE_INT	
    				E_FORM_WRONGTYPE_FLOAT
    				E_FORM_WRONGTYPE_DATETIME
    				E_FORM_WRONGTYPE_BOOLEAN
    	'min_error' E_FORM_MIN_INT
    				E_FORM_MIN_FLOAT
    				E_FORM_MIN_DATETIME
    				E_FORM_MIN_FILE
    				E_FORM_MIN_STRING
    	'max_error' E_FORM_MAX_INT
    				E_FORM_MAX_FLOAT
    				E_FORM_MAX_DATETIME
    				E_FORM_MAX_FILE
    				E_FORM_MAX_STRING
    	'regexp_error' E_FORM_REGEXP

　5種類が用意されている。

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

