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

