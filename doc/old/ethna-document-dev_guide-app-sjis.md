<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
EthnaでShift_JISなサイトを作る - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# EthnaでShift\_JISなサイトを作る 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [ethna-document-dev\_guide-app](ethna-document-dev_guide-app.html) > EthnaでShift\_JISなサイトを作る 
## EthnaでShift\_JISなサイトを作る [](ethna-document-dev_guide-app-sjis.html#a4bcb9a0 "a4bcb9a0")

* * *

書いた人:cocoiti

* * *

### 概要 [](ethna-document-dev_guide-app-sjis.html#h7e429fc "h7e429fc")

Ethnaは、内部コードがutf-8でできています。(変換かければ、どうにでもなりますが)。  
基本的に問題はないのですが、携帯サイトなどを作る時に、やむえず、出力をShift\_JISにしたくなるときがあります。

その方法について記述していきます。

なお、以下のポリシーで記述しています。

- 内部コードはutf-8
- 入力コードはShift\_JIS(自動判別のフィルタを書く方法は別途記述）
- 出力コードはShift\_JIS(sjis-win)

### 内部コードはutf-8で書く [](ethna-document-dev_guide-app-sjis.html#r1470ae9 "r1470ae9")

各種テンプレート（HTML、メール）も含め通常通り、utf-8で記述します。

### 入力のShift\_JISを内部コードに変換 [](ethna-document-dev_guide-app-sjis.html#m4997005 "m4997005")

まずは、Ethnaのフィルタで入力コードを変換してしまいます。

    function preFilter()
    {
        $_POST = InputEncoding($_POST);
        $_GET = InputEncoding($_GET);
    }
    (省略)
    
    function InputEncoding($data)
    {
        static $encoding = null;
        static $internal_encoding = null;
        if (is_null($encoding)) {
            $encoding = 'sjis-win';
        }
    
        if (is_null($internal_encoding)) {
            $internal_encoding = 'eucjp-win';
        }
    
        if (is_array($data)) {
            return array_map('InputEncoding', $data);
        }else{
            return mb_convert_encoding($data, $internal_encoding, $encoding);
        }
     }

こんな感じで、sjis-win => euc-winに変換します。

### 出力コードを変換する [](ethna-document-dev_guide-app-sjis.html#eac25063 "eac25063")

Smartyフィルタで、出力コードをShift\_JISにしてしまいます。

    function smarty_outputfilter_encode($output, &$smarty){
        return mb_convert_encoding($output, "SJIS-win", "eucJP-win");
    }

これでWeb上の文字コードはShift\_JISになります。

- これの代わりにprefilter()でmb\_http\_output("SJIS");mb\_internal\_encoding("utf-8");をするのはありでしょうか？ (n071316)

### コントローラに追加する [](ethna-document-dev_guide-app-sjis.html#s176e6e2 "s176e6e2")

変換コードを書いたら、それをappやlibに保存して、プロジェクトのコントローラの先頭部分でrequireしましょう。

### MailSenderのSmartyでフィルタが有効になっている問題 [](ethna-document-dev_guide-app-sjis.html#v17b7aef "v17b7aef")

通常なら、上記までで十分なのですが、Ethna 0.2.0までの全てのバージョンは、Ethna\_MailSenderにおいて、Smartyを使用しています。

これはこれでかまわないのですが、先ほどのSmartyフィルタが有効になっているため、utf-8 => sjis-winと変換されメール送信アルゴリズムが動作します。\*1

さらにここまでもまぁ問題ないのですが、運がわるいことに、Ethna\_MailSernder::\_parse()がShift\_JISだとうまくパースできない場合があるので\*2、これをutf-8に戻してやります。

幸いにもEthna\_MailSenderは継承して使用するのが基本なので、継承したついでに継承後のクラスに以下を追記します。

    function _parse($mail)
    {
        $mail = mb_convert_encoding($mail, "eucjp-win", "sjis-win");
        return parent::_parse($mail);
    }

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1これはこれで、まずいと思う。  
\*2無限ループっぽくなる。詳しくは追ってない。  

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
