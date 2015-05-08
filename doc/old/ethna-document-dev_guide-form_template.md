<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
フォームテンプレート - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# フォームテンプレート 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > フォームテンプレート 
## フォームテンプレート [](ethna-document-dev_guide-form_template.html#d69b6135 "d69b6135")

アクションフォームの定義を毎回配列の形で書いていくのは、数が多くなってくると非常に面倒です。フォームテンプレートは、そんな要求があった場合に、親クラスに共通の雛形を定義することで、子クラスでその定義を省略させることができる機能です。

複数の画面で共通するフォームがあったような場合に、この機能は特に有用です。

- フォームテンプレート 
  - 基本的な使い方 
  - サンプルコード 
  - 使い方のコツ 

| 書いた人 | ------ | ---------- | 新規作成 |
| 書いた人 | mumumu | 2009-01-29 | 最新版に追随する形で全面的に修正 |

### 基本的な使い方 [](ethna-document-dev_guide-form_template.html#c3e3b3d3 "c3e3b3d3")

アクションフォームの親クラスに以下のように書くだけで、子クラスのActionFormでフォーム名を書くだけでその定義が使えるようになります。また、その定義のオーバライドも可能です。

    class Sample_ActionForm extends Ethna_ActionForm
    {
        var $form_template = array(
            'mailaddress' => array(
                'name' => 'メールアドレス',
                'required' => true,
                'max' => 255,
                'filter' => FILTER_HW,
                'custom' => 'checkMailaddress',
                'form_type' => FORM_TYPE_TEXT,
                'type' => VAR_TYPE_STRING,
            ),
        );
    }

### サンプルコード [](ethna-document-dev_guide-form_template.html#qb99e009 "qb99e009")

以下に例を示します。上記の親クラスを継承し、'mailaddress' の定義をそのまま使うようにしています。また、オーバライドする例も示しています。

    class Hoge_ActionForm extends Sample_ActionForm
    {
        var $form = array(
    
            // Ethna 2.5.0 以降では、名前だけ書けば良い
            // もちろん、定義の一部も変更可能
            'mailaddress',
    
            // Ethna 2.3.5 以前では、名前に加えて array(), も必要
            'mailaddress' => array(),
    
            // 以下のようにすれば、定義を変更可能
            // 親クラスでは required が true だったが
            // ここでは false に変更している。
            // 他の filter や name 等の定義は親クラスのまま。
            'mailaddress' => array(
                'required' => false,  
            ),        
        );
    }

### 使い方のコツ [](ethna-document-dev_guide-form_template.html#h6439d83 "h6439d83")

Ethna 2.3.0 からは、プロジェクトごとの親クラスとして次のファイルがありますので、 それに$form\_template を定義しましょう。

    {APPID}/app/{APPID}_ActionForm.php

また、共通のカテゴリ毎に、アクションフォームクラスを分割し、子クラスに継承させるのもひとつの手です。

    {APPID}/app/{APPID}_ActionForm.php
    {APPID}/app/{APPID}_ActionForm_Hoge.php
    {APPID}/app/{APPID}_ActionForm_Fuga.php

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
