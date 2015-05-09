# 遷移先定義を省略する - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# 遷移先定義を省略する 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [遷移先定義、テンプレートの扱い方](ethna-document-dev_guide-forward.html) > 遷移先定義を省略する 

- 遷移先定義を省略する 
  - 遷移先定義の省略方法 
  - 補足 

## 遷移先定義を省略する [](ethna-document-dev_guide-forward-omit.html#qeb3a766 "qeb3a766")

遷移先を定義する場合、厳密にはコントローラの$forwardメンバ変数に以下のようなエントリを追加する必要があります。

    'some_action' => array(
           'view_name' =>'Sample_View_Login',
           'forward_path' => 'login.tpl',
        ),

しかし，アクションを1つ作るたびにこのような定義を記述するのは煩雑なので、アクション定義と同様に遷移先定義も省略することが可能です。

実際には以下のように遷移先定義を省略することが出来ます。

    'some_view' => array(),

さらに、これさえも面倒な場合はコントローラへの遷移先定義そのものを省略することも可能です。

    // 何もなし

### 遷移先定義の省略方法 [](ethna-document-dev_guide-forward-omit.html#j78d3095 "j78d3095")

1. 遷移名に対応するビュースクリプトを作成する
2. 遷移名に対応するテンプレートを作成する
3. 1.で作成したファイルにビュー名に対応するビュークラスを定義する

とう3つの手順だけでOKです。

遷移名が"some\_action\_name"だとすると、ビュー定義省略時にインクルードされるビュースクリプト，テンプレートはそれぞれ

    view/Some/Action/Name.php
    template/ja/some/action/name.tpl

となります("\_" -> "/"+先頭1文字を大文字)。

また、ビュークラス名は

    {$アプリケーションID}_View_SomeActionName

となりますので、この命名規則に従ってファイルを作成し、クラスを定義しておけば遷移先定義を記述しなくても所定のビューが実行されます。

### 補足 [](ethna-document-dev_guide-forward-omit.html#j51cc6b2 "j51cc6b2")

なお、これらの命名規則はアプリケーションによって好みの形に変更することが出来ます。詳細は下記をご覧下さい。

_see also:_ [ビュークラスの命名規則を変更する](ethna-document-dev_guide-forward-view_namingconvention.html "ethna-document-dev\_guide-forward-view\_namingconvention (1240d)")

また、定義した命名規則に従っていちいちファイルを作成するのが面倒な場合は、binディレクトリに生成されるgenerate\_view\_script.phpを利用することで、ビュースクリプトのスケルトンを生成することが出来ます。

_see also:_ [ビュースクリプトのスケルトンを生成する](ethna-document-dev_guide-forward-skelton.html "ethna-document-dev\_guide-forward-skelton (1240d)")

※ ビュークラスが不要な場合(単純にテンプレートを表示したい場合等)は、ビュークラスの記述を省略することも可能です。

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
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
