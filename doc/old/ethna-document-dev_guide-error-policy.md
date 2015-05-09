# エラー処理ポリシー
  - Ethna\_Error 
  - ActionError 

## エラー処理ポリシー [](ethna-document-dev_guide-error-policy.html#m27b8582 "m27b8582")

アプリケーションの実行中に生じるエラーは、次の２つにわけられます。

- System error
  - システムが原因で起きるエラー。DBエラーなど。
- User error
  - ユーザがフォームに入力した値が不正である場合のエラー。

Ethnaフレームワークでは、これらのエラーは全てEthna\_Error（またはPEAR\_Error）によって処理されます。

[![Ethna_Error1.png](http://ethna.jp/index.php?plugin=ref&page=ethna-document-dev_guide-error-policy&src=Ethna_Error1.png "Ethna\_Error1.png")](plugin=attach&refer=ethna-document-dev_guide-error-policy&openfile=Ethna_Error1.png.html "Ethna\_Error1.png")

### Ethna\_Error [](ethna-document-dev_guide-error-policy.html#dfe142c9 "dfe142c9")

Ethna\_Errorには、エラーコードとエラーメッセージが格納されています。 Ethna\_Errorはシステムとしてエラーハンドリングを行うので，実際のアプリケーションでは，Ethna\_Errorをアクションクラスで処理し，ユーザに必要な情報のみを提示します．

    function perform()
        {
            $sm =& new {アプリケーションID}_SampleManager();
             $result = $sm->test();
            if (Ethna::isError($result)) {
    
                 //エラーの場合の処理
                 .....
             }
    
             ....
         }

EthnaクラスのisError()メソッドで、エラーの有無を確認できます。 ここではtest()メソッドからエラーオブジェクトが返ってきた場合に，エラー処理を行うようにしています。

アプリケーションのManagerでエラーオブジェクトを返すには、次のようにします。

    class {アプリケーションID}_SampleManager
    {
        function test($data)
        {
            // 実際には，まともなエラー処理を行う．
            if (! $data) {
                return Ethna::raiseNotice('データがありません', E_SAMPLE_TEST);
            }
            return 0;
        }
    }

エラーオブジェクトには、Notice,Warning,Errorの3つがあります。 エラーの内容に応じて，これらを使い分けます． アプリケーション固有のエラーメッセージを渡したい場合は、EthnaクラスのraiseNotice,raiseWarning,raiseErrorメソッドを使って，Ethna\_Errorオブジェクトを生成します． この例では，raiseNoticeを用いてエラーオブジェクトを返しています． 引数には，メッセージとエラーコードを与えます．

**[アプリケーションエラーコードの定義](ethna-document-dev_guide-error-definecode.html "ethna-document-dev\_guide-error-definecode (1240d)")**

### ActionError [](ethna-document-dev_guide-error-policy.html#ded53322 "ded53322")

[![Ethna_ActionError.png](http://ethna.jp/index.php?plugin=ref&page=ethna-document-dev_guide-error-policy&src=Ethna_ActionError.png "Ethna\_ActionError.png")](plugin=attach&refer=ethna-document-dev_guide-error-policy&openfile=Ethna_ActionError.png.html "Ethna\_ActionError.png")

エラーの内容をユーザに提示した場合，アクションクラスで受け取ったエラーオブジェクトをActionErrorに格納します。 具体的には、下記のようにae(actionError)のaddObjectメソッドを使います。

    if (Ethna::isError($result)) {
                 $this->ae->addObject('testError', $result);
           }

また、エラーメッセージとエラーコードから、エラーオブジェクトを生成して、ActionErrorに追加するaddメソッドもあります。

ActionErrorの内容を表示するには，ビューで次のように書きます．

    <tr>
         <td>エラーメッセージ</td> 
         <td>{message name="testError"}</td>
      </tr>

