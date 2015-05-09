<title>
プラグインの先読み機能 - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# プラグインの先読み機能 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [アイデア](ethna-document-ideas.html) > プラグインの先読み機能 

- プラグインの先読み機能 
  - 概要 
  - 新しいプラグインの読み込ませ方・使い方 
  - 別名の付け方 
  - 読み込まれるタイミング 
  - その他 
  - その他2（ViewClassで使いたい場合） 
  - その他3 （PHP 5ベースになると） 
  - コード 

書いた人：sotarok

## プラグインの先読み機能 [](ethna-document-ideas-plugin_preloader.html#j2e06530 "j2e06530")

### 概要 [](ethna-document-ideas-plugin_preloader.html#u1aa371e "u1aa371e")

Ethna のプラグインは，これまで getPlugin を2回呼ばないとインスタンスがとれないだとか \*1，決して使いやすいものではありませんでした．

そもそも，「プラグイン」といいつつも，Validator や Filter など，Ethna の中で，「呼ばれるタイミングの決まっているプラグイン」が主であり，任意の機能追加をして再利用しやすいものを作ったり配布したり，があまりされてきませんでした．実際，getPlugin して利用するものは，現状の Ethna の組み込みですと， Cachemanager くらいでしょう．

しかし，2.5.0 以降では，他人の作成したプラグインを取り込みやすい仕組み，自分の作ったプラグインを配布しやすい仕組みが導入される予定です．それに伴い，利用のしやすさ，も重要な要素になってきます．

### 新しいプラグインの読み込ませ方・使い方 [](ethna-document-ideas-plugin_preloader.html#g375bf3e "g375bf3e")

ActionClass に $plugins というプロパティを作成し，配列で読み込みたいプラグインを記述すると，その名前でプラグインのオブジェクトをあらかじめ取得しておいてくれるようになります．

Example: app/action/Index.php

    <?php
    ...
    class App_Action_Index extends App_ActionClass
    {
        // type_name のように，アンダースコア区切りで指定する
        var $plugins = array(
            'Cachemanager_Localfile',
            'Cachemanager_Memcache',
        );
    
        function prepare()
        {
            ...
            return null;
        }
    
        function perform()
        {
            ...
            // $plugins で指定したプラグインが，その名前で使える
            $this->plugin->Cachemanager_Localfile->get('hoge');
            $this->plugin->Cachemanager_Memcache->get('hoge');
            ...
    
            return 'index';
        }
    }

このように，あらかじめ $plugins プロパティ変数に配列で定義することで，そのプラグインのインスタンスを $this->plugin に読み込んでおいてくれるようになります．

### 別名の付け方 [](ethna-document-ideas-plugin_preloader.html#bf54d92e "bf54d92e")

これで，キャッシュプラグインなどが幾分使いやすくなりました．とはいえ，Cachemanager\_Localfile と毎回打つのもなかなか骨が折れます\*2

ですので，別名でアクセスする方法も提供しています． 連想配列のキーに別名を指定すると，その名前で使えるようになります．

Example: app/action/Index.php

    <?php
    ...
    class App_Action_Index extends App_ActionClass
    {
        // type_name のように，アンダースコア区切りで指定する
        var $plugins = array(
            'cm' => 'Cachemanager_Localfile',
        );
    
        function prepare()
        {
            ...
            return null;
        }
    
        function perform()
        {
            ...
            // $plugins の連想配列のキーで別名を指定
            $this->plugin->cm->get('hoge');
            ...
    
            return 'index';
        }
    }

### 読み込まれるタイミング [](ethna-document-ideas-plugin_preloader.html#uec99e81 "uec99e81")

- ActionClass のコンストラクタで読み込まれます．従って，prepare でも preform でも使えます．

### その他 [](ethna-document-ideas-plugin_preloader.html#w771d457 "w771d457")

- 別名づけと，プラグインファイル名でアクセスする方法は混同して利用できます．\*3

Example: app/action/Index.php

    <?php
    ...
    class App_Action_Index extends App_ActionClass
    {
        // 混同してもOK
        var $plugins = array(
            'Cachemanager_Localfile',
            'cm' => 'Cachemanager_Localfile',
        );
    
        ...
        function perform()
        {
            ...
            // どっちも同じオブジェクト
            $this->plugin->cm->get('hoge');
            $this->plugin->Cachemanager_Localfile->get('hoge');
            ...
        }
    }

### その他2（ViewClassで使いたい場合） [](ethna-document-ideas-plugin_preloader.html#zf4273b6 "zf4273b6")

- こうして読み込ませた Plugin は，Plugin オブジェクトに読み込まれるので，このActionClassからforwardしたViewClassでも当然利用できます．
- 逆にいうと，ViewClass で使いたいプラグインは，そのViewClassにフローのながれるActionClassにpluginの記述をしておくといいでしょう．

### その他3 （PHP 5ベースになると） [](ethna-document-ideas-plugin_preloader.html#p4cf7ebd "p4cf7ebd")

- PHP 5 ベースのコードになると，別名をつけない場合は，$plugins の記述すら必要なくなる予定です

### コード [](ethna-document-ideas-plugin_preloader.html#f5e51893 "f5e51893")

この変更は git の plugin\_preloader ブランチで適用されています．

- [http://git.sourceforge.jp/view?p=ethna/ethna.git;a=shortlog;h=refs/heads/plugin\_preload](http://git.sourceforge.jp/view?p=ethna/ethna.git;a=shortlog;h=refs/heads/plugin_preload)

チェックアウト例：

    % git clone git://git.sourceforge.jp/gitroot/ethna/ethna.git
    % cd ethna
    % git checkout -b plugin_preloader origin/plugin_preloader

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1 [http://ethna.jp/ethna-document-dev\_guide-plugin.html#j3c3ba62](ethna-document-dev_guide-plugin.html#j3c3ba62)  
\*2当然みなさんは補完機能付きのエディタを使っているとは思いますが，それでも面倒っちゃ面倒です  
\*3が，実際にコードを書くときはどちらかのポリシーに統一したほうがチーム開発の面ではよろしいでしょう  

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
