# アプリケーションマネージャの使い方
アクションクラスに多くのロジックを書いていくと、それなりの規模のWebアプリケーションでは必ず共通の業務ロジックというのが出てきます。そうした共通のロジックをアクションクラスから分離するにはどうしたらいいでしょうか？

ここではその答えとして、アプリケーションマネージャーを紹介します。

- アプリケーションマネージャの使い方 
  - はじめに 
  - アプリケーションマネージャ の作成 
  - 共通のロジックを記述する 
  - 作成したメソッドを呼び出す 
    - Ethna 2.3.0 preview2 以降の場合 
    - Ethna 2.3.0 preview1 以前の場合 
    - アプリケーションマネージャの登録、呼び出し方法を変更した理由 
  - アプリケーションマネージャの命名規約を変更する 
  - アプリケーションオブジェクトとの連携 

| 書いた人 | 日付 | 備考 |
| halt | 2006-01-06 | 新規作成 |
| cocoiti | 2006-01-06 | ちょろっとつけたし |
| halt | 2006-06-14 | ethnaコマンドでの自動生成に変更 |
| halt | 2006-11-01 | Ethna 2.3.0 Preview2以降の挙動の変更について追記 |
| mumumu | 2009-03-04 | 中身を詳細にして書き直し |

### はじめに

ここでは、以下のコマンドで sample プロジェクトと sample アクションを作ったものとして説明します。

    $ ethna add-project sample
    $ ethna add-action sample

### アプリケーションマネージャ の作成

まず最初にAppManagerを作成します。例として、アプリケーションマネージャー名を 「hoge」としてみましょう。以下のように実行することで、app/Sample_HogeManager.php が自動生成されます。 中身は以下のようになるでしょう。

    $ ethna add-app-manager hoge

と実行することで

    <?php
    /**
     * Sample_HogeManager.php
     *
     * @author {$author}
     * @package Sample
     * @version $Id$
     */
    
    /**
     * Sample_HogeManager
     *
     * @author {$author}
     * @access public
     * @package Sample
     */
    class Sample_HogeManager extends Ethna_AppManager
    {
    }
    ?>

### 共通のロジックを記述する

上記で生成されたアプリケーションマネージャーは、Ethna_AppManagerクラスを継承しています。よって、Ethna_AppManagerで定義されている以下のプロパティをそのまま使うことが出来ます。見てわかるとおり、Ethnaで使う基本的なオブジェクトが全て網羅されているので、アクションフォームから値を取得するコードや、データベースにアクセスするコードなど、どのようなロジックでも記述することができます。

    /** @var object Ethna_Backend backendオブジェクト */
        var $backend;
     
        /** @var object Ethna_Config 設定オブジェクト */
        var $config;
     
        /** @var object Ethna_DB DBオブジェクト */
        var $db;
     
        /** @var object Ethna_I18N i18nオブジェクト */
        var $i18n;
     
        /** @var object Ethna_ActionForm アクションフォームオブジェクト */
        var $action_form;
     
        /** @var object Ethna_ActionForm アクションフォームオブジェクト(省略形) */
        var $af;
     
        /** @var object Ethna_Session セッションオブジェクト */
        var $session;

ここでは、invoke というメソッドを引数無しで定義してみましょう。以下のようになります。

    class Sample_HogeManager extends Ethna_AppManager
    {
         function invoke()
         {
             echo "Hello Sample_HogeManager!";
             
             //
             // 親クラスに定義されたプロパティを使って、
             // どのようなロジックでも記述可能です。
             // 戻り値も勿論自由
             //
             //$this->af->get('hoge');
             //$this->session->get('hoge');
             //$this->af->setApp('hoge', 'fuga');
             //$db = $this->backend->getDB();
    
             return;
         }
    }

### 作成したメソッドを呼び出す

では、これをアクションクラスから呼び出してみましょう。やり方はバージョンによって異なります。

#### Ethna 2.3.0 preview2 以降の場合

Ethna_Backend クラスのgetManagerメソッドに、作成したマネージャー名を指定することで、アプリケーションマネージャのインスタンスを取得することができます。

取得したインスタンスから、メソッドを呼び出してやるだけです。 以下のように sampleアクションクラスに 追記してみましょう。「Hello Sample_HogeManager!」が表示されるはずです。

    class Sample_Action_Sample extends Sample_ActionClass
    {
        function perform()
        {
            $hoge = $this->backend->getManager('hoge');
            $hoge->invoke();
            return 'index';
        }
    }

#### Ethna 2.3.0 preview1 以前の場合

まず、作成したアプリケーションマネージャをコントローラーが呼び出せるように登録する必要があります。

    app/Sample_Controller.php

で、上で作ったクラス(この場合はSample_HogeManager.php)をrequireし、コントローラーのファイルの中にある、

    var $manager

の配列の中に以下を追加します。

    'Test' => 'hoge',

配列のキーとして指定している Test は、各アクションクラス内で呼び出す時の名称。配列の値として指定している hoge は ethna add-app-managerコマンドで指定したアプリケーションマネージャーの名前です。

このように指定することで、アクションクラスの $this->Test に、Sample_HogeManager のインスタンスが自動的にロードされます。

早速試してみましょう。sampleアクションクラスのperformメソッドに以下を追記して、実行してみてください。「Hello Sample_HogeManager!」が表示されるはずです。

    class Sample_Action_Sample extends Sample_ActionClass
    {
        function perform()
        {
            $this->Test->invoke();
            return 'index';
        }
    }

#### アプリケーションマネージャの登録、呼び出し方法を変更した理由

既に述べた通り Ethna 2.3.0 preview1 以前では、コントローラーにマネージャーを登録し、自動ロードさせるやり方でした。しかし、数が多くなったときに登録が大変なことと、ロードのコストがかかるという理由から、Ethna 2.3.0 preview2 以降では、明示的に必要なもののみを取得するやり方に変更されています。

各Action毎に毎回手動で呼び出すのが面倒な場合、 app/[APPID]_ActionClass.php などのベースの関数のコンストラクタの中などで呼び出すようにすると良いでしょう。

### アプリケーションマネージャの命名規約を変更する

    このセクションの記述は、Ethna 2.5.0 preview3以降に当てはまります

アプリケーションマネージャーのクラス名は、デフォルトでは以下のようになります。

    [アプリケーションID]_[マネージャー名のはじめを大文字にしたもの]Manager

この名前は、Ethna_Controller#getManagerClassName をオーバライドすることで変更することが出来ます。命名規約が変わったとしても、既に述べた呼び出し方は変化ありません。

    /**
        * マネージャクラス名を取得する
        *
        * @access public
        * @param string $name マネージャキー
        * @return string マネージャクラス名
        */
       function getManagerClassName($name)
       {
           // アプリケーションIDと、渡された名前のはじめを大文字にして、
           // 組み合わせたものが返される
           return sprintf('%s_%sManager', $this->getAppId(), ucfirst($name));
       }

