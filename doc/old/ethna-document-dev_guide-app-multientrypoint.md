<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
複数のエントリポイントを作成する - Ethna - PHPウェブアプリケーションフレームワーク</title>
 <link rel="stylesheet" href="skin/ethna/ethna.css" title="ethna" type="text/css" charset="utf-8">

 <link rel="alternate" type="application/rss+xml" title="RSS" href="cmd=rss.html">

 <script type="text/javascript" src="skin/trackback.js"></script>

</head>
ここは以前の ethna.jp サイトを表示したものです。ここにあるドキュメントはバージョン2.6以降更新されません。  
最新のドキュメントは [現在のethna.jp](http://ethna.jp/) を閲覧してください。現ドキュメントが整備されるまでは、ここを閲覧してください。

<!-- ??BEGIN id:wrapper --><!-- ?? Navigator ?? ======================================================= -->

[![Ethna](image/navlogo.gif)](/)

[トップ](ethna.html "ethna (11d)") [二ュース](ethna-news.html "ethna-news (11d)") [概要](ethna-about.html "ethna-about (11d)") [ダウンロード](ethna-download.html "ethna-download (25d)") [ドキュメント](ethna-document.html "ethna-document (884d)") [コミュニティ](ethna-community.html "ethna-community (619d)") [FAQ](ethna-document-faq.html "ethna-document-faq (1240d)")

<!-- ?? Header ?? ========================================================== -->

# 複数のエントリポイントを作成する 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [ethna-document-dev\_guide-app](ethna-document-dev_guide-app.html) > 複数のエントリポイントを作成する 

- 複数のエントリポイントを作成する 
  - [参考] Ethna\_Controller::main()メソッド 

## 複数のエントリポイントを作成する [](ethna-document-dev_guide-app-multientrypoint.html#ff3257c1 "ff3257c1")

[アプリケーション構築手順(1)](ethna-document-tutorial-practice1.html "ethna-document-tutorial-practice1 (23d)")での例では、エントリポイントは常に1つでしたが、実際のアプリケーションでは様々な事情で、複数のエントリポイントを利用したい場合も出てくるかと思います。

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

_see also:_ [エントリポイント毎に実行可能なアクションを制限する](ethna-document-dev_guide-app-limitentrypoint.html "ethna-document-dev\_guide-app-limitentrypoint (706d)")

### [参考] Ethna\_Controller::main()メソッド [](ethna-document-dev_guide-app-multientrypoint.html#z5610e12 "z5610e12")

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
<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1なんだかちょっとエレガントではない  

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

## Powered by GREE

 [![GREE Labs](http://labs.gree.jp/image/greelabs_logo.gif)](http://labs.gree.jp/)

<!-- END id:search_form -->
 [![SourceForge.jp](http://sourceforge.jp/sflogo.php?group_id=1343)](http://sourceforge.jp/)

<!-- ??END id:sidebar -->
<!-- ??END id:wrap_sidebar -->
<!-- ??END id:main --><!-- ?? Footer ?? ========================================================== -->
<!-- ??BEGIN id:footer -->
<!-- ??BEGIN id:copyright --> **PukiWiki 1.4.6** Copyright © 2001-2005 [PukiWiki Developers Team](http://pukiwiki.sourceforge.jp/). License is [GPL](http://www.gnu.org/licenses/gpl.html).  
 Based on "PukiWiki" 1.3 by [yu-ji](http://factage.com/yu-ji/).
<!-- ??END id:copyright -->
<!-- ??END id:footer --><!-- ?? END ?? ============================================================= -->
<!-- ??END id:wrapper -->
