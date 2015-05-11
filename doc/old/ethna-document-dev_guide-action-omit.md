# アクション定義を省略する
  - アクション名の決定方法 
  - アクション定義の省略方法 
  - 補足 

## アクション定義を省略する

アクションを定義する場合、_厳密には_コントローラの$actionメンバ変数に以下のようなエントリを追加する必要があります。

    'some_action' => array(
      'form_name' => 'Sample_Form_SomeAction',
      'form_path' => 'Some/Action.php',
      'class_name' => 'Sample_Action_SomeAction',
      'class_path' => 'Some/Action.php',
    ),

しかし、1アクション毎にこれらのエントリを定義するのはあまりに煩雑なので、実際には以下のようにアクション定義を省略することが出来ます。

    'some_action' => array(),

さらに、これさえも面倒な場合はコントローラへのアクション定義そのものを省略することも可能です(Mojavi方式\*1)。

    // 何もなし

ここでは、コントローラのアクション名決定方法と、アクション定義が省略された場合のアクションスクリプト名、アクションクラス名等の決め方について記述します。

### アクション名の決定方法

Ethnaフレームワークのアクションは以下の手順で決定されます。実は結構複雑ですが、割とどうでも良いことなので読み飛ばして頂いても構いません。

1. クライアントから送信されたフォーム値を解析してアクション名を決定する\*2
2. アクション名に対応するアクション定義(コントローラの$actionメンバのエントリ)を取得する
3. アクションスクリプトを読み込む
  1. アクション定義に'class\_path'属性が存在すればそのファイルをインクルード
  2. アクション名から決定されるデフォルトのアクションスクリプト\*3が存在すればそのファイルをインクルード
  3. どちらも存在しなければactionディレクトリ以下の全てのファイルをインクルード
  4. (アクションフォームについても同様)
4. アクション定義に'class\_name'属性が存在しない場合、デフォルトのアクションクラス名を設定\*4
5. 4.で決定されたアクションクラスが定義されていれば正しいアクション名とみなす  
アクションクラスが定義されていない場合、$fallback\_action\_nameをアクション名とみなしてアクションを実行する(($fallback\_action\_nameについては [未定義のアクションが指定された場合に特定のアクションを実行する](dev_guide-app-fallbackentrypoint.md "ethna-document-dev\_guide-app-fallbackentrypoint (1240d)")を参照してください))

### アクション定義の省略方法

アクション名の決定方法はなかなか複雑ですが、アクション定義の省略方法は簡単です。要するに

1. アクション名に対応するアクションスクリプトを作成する
2. 1.で作成したファイルにアクション名に対応するアクションクラスを定義する

とう2つの手順だけでOKです。

アクション名が"some\_action\_name"だとすると、アクション定義省略時にインクルードされるアクションスクリプトは

    Some/Action/Name.php

となります("\_" -> "/"+先頭1文字を大文字)。

また、アクションクラス名は

    {$アプリケーションID}_Action_SomeActionName

そしてアクションフォーム名は

    {$アプリケーションID}_Form_SomeActionName

となりますので、これらの命名規則に従ってファイルを作成し、クラスを定義しておけばアクション定義を記述しなくても所定のアクションが実行されます。

### 補足

なお、これらの命名規則はアプリケーションによって好みの形に変更することが出来ます。詳細は下記をご覧下さい。

_see also:_ [アクションクラスの命名規則を変更する](dev_guide-action-namingconvention.md "ethna-document-dev\_guide-action-namingconvention (1240d)")

また、定義した命名規則に従っていちいちファイルを作成するのが面倒な場合は、binディレクトリに生成されるgenerate\_action\_script.phpを利用することで、アクションスクリプトのスケルトンを生成することが出来ます。

_see also:_ [アクションスクリプトのスケルトンを生成する](dev_guide-action-skelton.md "ethna-document-dev\_guide-action-skelton (1240d)")


* * *
\*1勝手に命名  
\*2アクション名の決定方法については [アクション名の決定方法を変更する](dev_guide-action-formname.md "ethna-document-dev\_guide-action-formname (1026d)")を参照してください  
\*3デフォルトのアクションスクリプトの決定方法については [アクションクラスの命名規則を変更する](dev_guide-action-namingconvention.md "ethna-document-dev\_guide-action-namingconvention (1240d)")を参照してください  
\*4デフォルトのアクションスクリプトの決定方法については [アクションクラスの命名規則を変更する](dev_guide-action-namingconvention.md "ethna-document-dev\_guide-action-namingconvention (1240d)")を参照してください  

