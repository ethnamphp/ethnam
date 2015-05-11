# 複数のエントリポイントを作成する
  - [参考] Ethna\_Controller::main()メソッド 

## 複数のエントリポイントを作成する

[アプリケーション構築手順(1)](tutorial-practice1.md)での例では、エントリポイントは常に1つでしたが、実際のアプリケーションでは様々な事情で、複数のエントリポイントを利用したい場合も出てくるかと思います。

ここでは/index.phpと/admin/index.phpの2つのエントリポイントを作成する例を挙げます。

方法は単純で、単純にエントリポイントを2つ置くだけです。具体的にはまず/index.phpとして以下のようなスクリプトを作成します。

    <?php
    include_once('/tmp/sample/app/Sample_Controller.php');
    Sample_Controller::main('Sample_Controller', 'index');
    ?>

次に/admin/index.phpに以下のようなスクリプトを作成します。

    <?php
    include_once('/tmp/sample/app/Sample_Controller.php');
    Sample_Controller::main('Sample_Controller', 'admin_index');
    ?>

以上で完了です。この上なく簡単です。

ただし、この状態では各エントリポイントは実行するアクションを制限していません。ですので、どちらのエントリポイントでも同じアクションを実行することが出来てしまいます。つまり

    /index.php?action_login=true

も

    /admin/index.php?action_login=true

も同じアクションと見なされる、ということです。これはあまりカッコよくない上にセキュリティ上問題となる可能性もあります。

ですのでEthnaでは各エントリポイント毎に実行可能なアクションを制限することも可能です。詳細は以下をご参照ください。

_see also:_ [エントリポイント毎に実行可能なアクションを制限する](dev_guide-app-limitentrypoint.md)

### [参考] Ethna\_Controller::main()メソッド

なお、Ethna\_Controller::main($class\_name, $action\_name = "", $fallback\_action\_name = "")メソッドは最低1つ、最大で3つの引数をとります。

<dl class="list1" style="padding-left:16px;margin-left:16px">
<dt>$class_name</dt>
<dd>実行するコントローラのクラス名を指定します<a id="notetext_1" href="#notefoot_1" class="note_super" title="なんだかちょっとエレガントではない">*1</a>
</dd>
<dt>$action_name(省略可)</dt>
<dd>クライアントからアクション名の指定がなかった場合に実行するアクション名を指定します(デフォルトアクション)<br>
また、ここにアクション名の配列を指定すると、そこに指定されたアクション名以外は未定義として扱われます(実行するアクションを制限することが出来ます)</dd>
<dt>$fallback_action_name(省略可)</dt>
<dd>クライアントから指定されたアクション名が未定義であった場合に実行されるアクション名を指定します。</dd>
</dl>

* * *
\*1なんだかちょっとエレガントではない  

