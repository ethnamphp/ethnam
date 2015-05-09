# ".ethna"ファイルについて
### 2種類の".ethna"ファイル [](ethna-document-dev_resourcefile.html#zb2f6891 "zb2f6891")

ethnaコマンドは、".ethna"ファイルを読み込むことによりその設定の変更を行うことができます。 .ethnaファイルには二種類ありそれぞれ2つの意味があります。

#### ユーザのホームディレクトリに置かれる".ethna"ファイル [](ethna-document-dev_resourcefile.html#t087bbee "t087bbee")

これは、いわゆる.bash\_rcなどと同じような意味合いのファイルで、ethnaコマンドの挙動を変更する項目があります。

/.ethnaの記述例\*1:

    [ethna]
    author = "username <username@exsample.com>"

現在は、以下の項目が設定可能です。

<dl class="list1" style="padding-left:16px;margin-left:16px">
<dt>author</dt>
<dd>作成者を設定します。この設定は、自動生成されるコード上のコメント作成者情報を上書きします。</dd>
</dl>
#### プロジェクトのディレクトリに置かれる".ethna"ファイル [](ethna-document-dev_resourcefile.html#b3ca1c56 "b3ca1c56")

これは、ethnaコマンドがプロジェクト固有のファイル((ActionとかView ))を作る時に参照するファイルです。基本的に弄る必要はありません。

{project\_name}/.ethna:

    [project]
    controller_file = "app/Sample_Controller.php"
    controller_class = "Sample_Controller"

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1[ethna]は適当  

<!-- ??END id:note -->
