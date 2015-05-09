# フォーム値にアクセスする
  - アクションフォームとは何か 
  - フォーム値を定義する 
  - フォーム値にアクセスする 
  - アクションフォームへのアクセスに関するポリシー 

## フォーム値にアクセスする [](ethna-document-dev_guide-form-overview.html#bffe9cbc "bffe9cbc")

アクションクラスからフォーム値へのアクセスするイメージは以下のようになっています。

[![http://ethna.jp/image/ethna-fig14.jpg](http://ethna.jp/image/ethna-fig14.jpg)](image/ethna-fig14.jpg)

1. ブラウザからGETあるいはPOSTにより渡された値が、PHPによって$\_GETあるいは$\_POST変数に格納されます
2. アクションフォームオブジェクトは、_フォーム値として定義されている値のみ_$\_GETあるいは$\_POSTから取得して、オブジェクト内のコンテナに格納します\*1
3. アクションクラスオブジェクトは、アクションフォームのget()/set()メソッドを通じてフォーム値にアクセスし、処理を行います
4. ビューオブジェクトは、アクションフォームから必要な値を取得して出力に反映して、
5. HTMLを出力します

### アクションフォームとは何か [](ethna-document-dev_guide-form-overview.html#z5ff1147 "z5ff1147")

次にアクションフォームとは何か、について簡単にご説明します。

アクションフォームは、Ethnaでは

- フォーム値と
- アクションクラスがビューに渡したい値(強制エスケープ)と
- アクションクラスがビューに渡したい値(エスケープなし)

という3種類の値のコンテナだと考えて下さい。以下のようなイメージです。

[![http://ethna.jp/image/ethna-fig15.jpg](http://ethna.jp/image/ethna-fig15.jpg)](image/ethna-fig15.jpg)

1. フォーム値にはget()/set()メソッドでアクセスします
2. アプリケーション設定値(フォーム値以外で、ビューに表示させたいダイナミックな値)はsetApp()メソッドでアクションフォームに格納します
3. アプリケーション設定値(HTMLエスケープさせたくない値)はsetAppNE()メソッドでアクションフォームに格納します
4. フォーム値はテンプレートで  

    {$form.フォーム名}

としてアクセスします。値は常にHTMLエスケープされます。
5. アプリケーション設定値(setApp()で格納されたもの)はテンプレートで  

    {$app.変数名}

としてアクセスします。値は常にHTMLエスケープされます。
6. アプリケーション設定値(setAppNE()で格納されたもの)はテンプレートで  

    {$app_ne.変数名}

としてアクセスします。この値はHTMLエスケープされません(基本的には使用しません)。

なお、アクションフォームはアクションクラスと対になって必ず生成され、アクションクラスのprepare()あるいはperform()メソッド、また、ビューオブジェクトのpreforward()では必ず

    $this->action_form // 面倒なら$this->afでも可

でアクセスできることが保証されています。アクションクラスに対応するアクションフォームが未定義の場合は、フォーム値定義の無いデフォルトのアクションフォームが生成されます。

### フォーム値を定義する [](ethna-document-dev_guide-form-overview.html#bce90062 "bce90062")

というわけで、アクションクラスからアクションフォームオブジェクトを利用してフォーム値にアクセスするには、アクションフォームにどのようなフォーム値を受け取るかを定義する必要があります\*2。

具体的には、アクションフォームのメンバ変数$formに

    'フォーム名' => array(...(属性定義)...),

という形で利用するフォーム値を列挙していきます。例えば'id'と'name'というフォーム値を利用する場合は以下のようになります。

    class Sample_Form_Index extends Ethna_ActionForm
    {
        /**
         * @access private
         * @var array フォーム値定義
         */
        var $form = array(
            'id' => array(
                'type' => VAR_TYPE_INT,
            ),
    
            'name' => array(
                'type' => VAR_TYPE_STRING,
            ),
        );
    }

フォーム名をキーとして、値にはフォーム値の属性を定義した配列を記述します。単純にフォーム値を受け取る場合は必要ありませんが、フォーム値の属性として最大値、使用可能文字を記述しておくことで入力された値を自動で検証することが可能となります\*3。ここでは、最低限の属性としてフォーム値の型を指定しています\*4。フォーム値の型には

- VAR\_TYPE\_INT
- VAR\_TYPE\_FLOAT
- VAR\_TYPE\_STRING
- VAR\_TYPE\_DATETIME
- VAR\_TYPE\_BOOLEAN
- VAR\_TYPE\_FILE

のどれかを指定します。特に無ければVAR\_TYPE\_STRINGとしておけば問題ないと思います。

### フォーム値にアクセスする [](ethna-document-dev_guide-form-overview.html#kf7760b4 "kf7760b4")

定義が完了したら、あとはアクションクラスのprepare()あるいはperform()メソッド、または、ビュークラスのpreforward()メソッドで以下のようにしてフォーム値を取得/設定するだけです。

    function perform()
    {
        // フォーム値の取得
        $id = $this->af->get('id');
    
        // フォーム値の設定
        $this->af->set('id', $id+1);
    }

### アクションフォームへのアクセスに関するポリシー [](ethna-document-dev_guide-form-overview.html#ef378569 "ef378569")

余計なお世話かもしれませんが、アプリケーションを構築していく上でのアクションフォームへのアクセスに関するポリシーについて少しだけ...。

まず、 [アプリケーション構築手順(3)](ethna-document-tutorial-practice3.html#content_1_7 "ethna-document-tutorial-practice3 (1240d)")に書きましたが、アクションクラス(prepare()perform()メソッド)には最低限必要な処理のみ(必要なオブジェクトを生成してメソッドを実行+エラー処理程度)を記述し、実際のロジックは別途クラスを作成してそこに記述することを推奨します。

それと同様に、アクションフォームへのアクセスもアクションクラス(+ビュー)にでのみ行うことを推奨します。手続き上はアクションフォームオブジェクトはあちこちから参照可能ではありますが、例えばアクションクラス以外のどこかでアクションフォームがあれこれ弄られていると、アプリケーションの規模が大きくなってきたときに、個々のアクションでの独立性が低くなって来てメンテナンス性が低下してしまいます。

例えば、ユーザ情報を更新する以下のようなアクションクラスを考えてみます。

    // アクション'user_update'
    function perform()
    {
        // ユーザオブジェクトを生成して情報を更新
        $user =& new Sample_User(...);
        $user->set('name', $this->af->get('name'));
        $user->update();
    
        // 更新された名前をアプリケーション値として設定
        $this->af->setApp('new_name', $user->get('name'));
    
        return 'user_update-done';
    }

ここで、「どうせだから$user->update()の中で$this->af->setApp()もしちゃえ」ということをすると、$user->update()をあちこち他のアクションクラスで呼び出している(あるいは呼び出すように拡張されてきた)場合に、思わぬバグの原因になったり、前述のように個々のアクションの独立性が落ちてメンテナンス性の低下を引き起こしたりします。

というわけで、アクションフォームへのアクセス(特に更新)はアクションクラス(+ビュー)のみに限定することを結構強く推奨します。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1Ethnaでは基本的に、クライアントから送信されアクションフォームに格納されたフォーム値がGET/POST(REQUEST\_METHOD)のどちらに由来するかを区別しません。理由は、GET/POSTで振舞いを変えていると思わぬところでダサダサな振舞いをしたり、場合によっては(ここはGETしかこないと思い込んでコードを書いていたりすると)セキュリティホールになる可能性もなくもなくも無いためです  
\*2アクションに対応するアクションフォームのファイル名やクラス名については [アクション定義を省略する](ethna-document-dev_guide-action-omit.html "ethna-document-dev\_guide-action-omit (1240d)")、または [アクション定義省略時の命名規則を変更する](ethna-document-dev_guide-action-namingconvention.html "ethna-document-dev\_guide-action-namingconvention (1240d)")を参照してください  
\*3詳細は [フォーム値の自動検証を行う(基本編)](ethna-document-dev_guide-form-validate.html "ethna-document-dev\_guide-form-validate (737d)")を御覧下さい  
\*4もちろん省略も可能ですが  

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

