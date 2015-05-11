# エラーメッセージをカスタマイズする

## エラーメッセージをカスタマイズする

mixi:Ethnaコミュニティ:雑談:74(いちいさん)より

エラーメッセージの変更は、各フォームのActionFormのform値に 以下のように設定すると、変更が可能となっている。

    'required' => true,
    	'type' => VAR_TYPE_INT,
    	'required_error' => '入力してね',
    	'type_error' => '整数にしてね',

上記の例の場合、'required'に対してのエラーが'required_error'に対応していて、エラーが起きると「入力してね」が、'type'に対してのエラーが'type_error'に対応していて「整数にしてね」とエラーメッセージが設定される。

エラーのタイプとしては、Ethna_ActionFormのhandleErrorでマッピングされているとおり、

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

