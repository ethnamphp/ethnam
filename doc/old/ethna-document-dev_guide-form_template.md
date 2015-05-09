# フォームテンプレート
アクションフォームの定義を毎回配列の形で書いていくのは、数が多くなってくると非常に面倒です。フォームテンプレートは、そんな要求があった場合に、親クラスに共通の雛形を定義することで、子クラスでその定義を省略させることができる機能です。

複数の画面で共通するフォームがあったような場合に、この機能は特に有用です。

- フォームテンプレート 
  - 基本的な使い方 
  - サンプルコード 
  - 使い方のコツ 

| 書いた人 | ------ | ---------- | 新規作成 |
| 書いた人 | mumumu | 2009-01-29 | 最新版に追随する形で全面的に修正 |

### 基本的な使い方 [](ethna-document-dev_guide-form_template.html#c3e3b3d3 "c3e3b3d3")

アクションフォームの親クラスに以下のように書くだけで、子クラスのActionFormでフォーム名を書くだけでその定義が使えるようになります。また、その定義のオーバライドも可能です。

    class Sample_ActionForm extends Ethna_ActionForm
    {
        var $form_template = array(
            'mailaddress' => array(
                'name' => 'メールアドレス',
                'required' => true,
                'max' => 255,
                'filter' => FILTER_HW,
                'custom' => 'checkMailaddress',
                'form_type' => FORM_TYPE_TEXT,
                'type' => VAR_TYPE_STRING,
            ),
        );
    }

### サンプルコード [](ethna-document-dev_guide-form_template.html#qb99e009 "qb99e009")

以下に例を示します。上記の親クラスを継承し、'mailaddress' の定義をそのまま使うようにしています。また、オーバライドする例も示しています。

    class Hoge_ActionForm extends Sample_ActionForm
    {
        var $form = array(
    
            // Ethna 2.5.0 以降では、名前だけ書けば良い
            // もちろん、定義の一部も変更可能
            'mailaddress',
    
            // Ethna 2.3.5 以前では、名前に加えて array(), も必要
            'mailaddress' => array(),
    
            // 以下のようにすれば、定義を変更可能
            // 親クラスでは required が true だったが
            // ここでは false に変更している。
            // 他の filter や name 等の定義は親クラスのまま。
            'mailaddress' => array(
                'required' => false,  
            ),        
        );
    }

### 使い方のコツ [](ethna-document-dev_guide-form_template.html#h6439d83 "h6439d83")

Ethna 2.3.0 からは、プロジェクトごとの親クラスとして次のファイルがありますので、 それに$form\_template を定義しましょう。

    {APPID}/app/{APPID}_ActionForm.php

また、共通のカテゴリ毎に、アクションフォームクラスを分割し、子クラスに継承させるのもひとつの手です。

    {APPID}/app/{APPID}_ActionForm.php
    {APPID}/app/{APPID}_ActionForm_Hoge.php
    {APPID}/app/{APPID}_ActionForm_Fuga.php

