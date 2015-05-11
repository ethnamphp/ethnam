# ユニットテストを行う
- 概要 
- テスト実行環境の作成 
  - SimpleTestのインストール 
    - PEARコマンドを使ってインストールする 
    - 直接ダウンロードしてインストールする 
  - debugフラグの設定(必須！） 
- テストケースの作成 
  - テストケースのスケルトンを生成する。 
  - テストケースの記述 
  - Ethna 2.3.5以前の、アクション・ビュー以外のテストケースの書き方 
  - Ethna_UnitTestCase特有のメソッド 
- テスト結果表示 

## ユニットテストを行う

* * *

| 書いた人 | sfio | | |
| 書いた人 | cockok | 2007-07-06 | テストケースの書き方追記 |
| 書いた人 | mumumu | 2008-05-07 | 2.3.x系の情報に追随 |

* * *

## 概要

[SimpleTest](http://simpletest.org) を使った Ethna でのユニットテストの方法です。  
Simpletest は、様々なユニットテストの実行、レポートの出力形式に対応したPHP向けのテスティングフレームワークです。

## テスト実行環境の作成

### SimpleTestのインストール

まずはSimpletestをインストールする必要があります。インストールには以下の二つの方法があります。

#### PEARコマンドを使ってインストールする

    # pear channel-discover pear.ethna.jp
    # pear update-channels
    # pear install ethna/simpletest

#### 直接ダウンロードしてインストールする

- [http://sourceforge.net/projects/simpletest](http://sourceforge.net/projects/simpletest)

### debugフラグの設定(必須！）

設定ファイル（etc/{app_id}-ini.php)のdebugフラグをtrueに設定します。

    $config = array(
    
        // debug
        // (to enable ethna_info and ethna_unittest, turn this true)
    - 'debug' => false,
    + 'debug' => true,
    
    );

仮に trueに設定していないと、以下のようなメッセージが出てテストケースの実行に失敗します。(Ethna 2.3.5 以上\*1)

    Ethna cannot run Unit Test under your application setting.
    HINT: You must set {appid}/etc/{appid}-ini.php debug setting 'true'.
    
    In {appid}-ini.php, please set as follows :
    
    $config = array ( 'debug' => true, );

## テストケースの作成

### テストケースのスケルトンを生成する。

ethnaコマンドを実行し、テストケースのスケルトンを生成します。 生成されたクラスにテストを記述していきます。

- アクション&フォーム用のテストケースのスケルトン作成\*2

    $ ethna add-action-test [アクション名]

- 以下のアクションテストスケルトンが生成されます。
  - app/action/[アクション名]Test.php
  - （クラス名は {appid}_Action_[アクション名]_TestCase)

- ビュー用のテストケースのスケルトン作成

    $ ethna add-view-test [ビュー名]

- 以下のビューテストスケルトンが生成されます。  

  - app/view/[ビュー名]Test.php
  - （クラス名は {appid}_View_[ビュー名]_TestCase)

- アクション・ビュー「以外」の一般的なテストケースのスケルトン作成(2.3.5以降)  
AppObjectやAppManager、その他のテスト用途に使います。

    $ ethna add-test [テストケース名]

- 以下のテストスケルトンが生成されます。  

  - app/test/[テストケースー名]Test.php
  - （クラス名は {appid}_[テストケース名]_TestCase)
  - {appid}_UnitTestManagerへのテストケースの追加をする必要はありません。

### テストケースの記述

上記で生成されたテストケースのクラス中に、「test」から始まるメソッドとテストを追加していきます。ethnaコマンドで生成されるクラスは [UnitTestCase](http://simpletest.org/api/SimpleTest/UnitTester/UnitTestCase.html) を継承した Ethna_UnitTestCase を継承していますので、 [UnitTestCase](http://simpletest.org/api/SimpleTest/UnitTester/UnitTestCase.html)のメソッドを $this 経由で呼び出すことが出来ます。

    function test_actionSample()
    {
        $this->assertTrue(true);
    }

simpletest でのテストケースの書き方の詳細は、以下を参照して下さい。

- WEB+DB PRESS Vol.29
- [http://bobchin.ddo.jp/simpletest](http://bobchin.ddo.jp/simpletest)
- [http://simpletest.org/en/first_test_tutorial.html](http://simpletest.org/en/first_test_tutorial.html)
- [http://simpletest.org/api/](http://simpletest.org/api/)

### Ethna 2.3.5以前の、アクション・ビュー以外のテストケースの書き方

2.3.5 以前で、AppObjectやAppManagerのテストケースを作成する場合は、以下のようにします。

- app/ 以下に適当なテストスクリプトを作成します。  
テストは Ethna_UnitTestCase を継承したクラス内に記述します。

例：app/{appid}_UserManagerTest.php

    class {appid}_UserManager_TestCase extends Ethna_UnitTestCase
    {
         ....
    }

- UnitTestManagerへのテストケースの追加  
{appid}_UnitTestManager.php に追加したテストケースの定義を追加します\*3

    var $testcase = array(
            '{appid}_UserManager' => 'app/{appid}_UserManagerTest.php',
        );

### Ethna_UnitTestCase特有のメソッド

テストケースの中で、アクションフォームやアクション、ビューのインスタンスを独自に必要とすることがあります。以下のメソッドはそうした用途に使います。

- createActionClass() アクションの作成

- createActionForm() アクションフォームの作成

- createPlainActionForm() 単純なアクションフォームの作成

- createViewClass() ビューの作成

## テスト結果表示

www/unittest.phpをブラウザで表示。ローカルファイルを直接表示してもだめですよ。


* * *
\*1Ethna 2.3.2以前では、このフラグがtrueになっていないと、 Ethna_UnitTestCase が 見つからない等と文句を言われます。www/unittest.php をブラウザから見た場合に画面が真っ白になった場合にも、この点を疑ったほうが良いです。  
\*2Ethna-2.1.2以前でadd-action-testすると、app/action_cli以下にテストケースが出来てしまいます（バグです）。お手数ですがapp/action以下にファイルを移動してくださいm(_ _)m  
\*3アクションとビューのテストはethnaコマンドで生成した場合、{appid}_UnitTestManagerへのテストケースの追加をする必要はありません。  

