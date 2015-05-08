<head>
 <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8">
 <meta http-equiv="content-style-type" content="text/css">
 <meta http-equiv="Content-Script-Type" content="text/javascript">

<title>
エラー処理 - Ethna - PHPウェブアプリケーションフレームワーク</title>
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

# エラー処理 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > エラー処理 
## エラー処理 [](ethna-document-dev_guide-error.html#e8a51840 "e8a51840")

- エラー処理 
  - 概要 
  - ethna\_error\_handler()の処理内容 
  - Ethna::raiseError() 
  - Ethna\_ActionErrorクラス 
  - 具体例 

**[エラー処理ポリシー](ethna-document-dev_guide-error-policy.html "ethna-document-dev\_guide-error-policy (1240d)")**

**[エラーコードの定義](ethna-document-dev_guide-error-definecode.html "ethna-document-dev\_guide-error-definecode (1240d)")**

**[エラーレベルに応じて共通画面を表示させる](ethna-document-dev_guide-error-fatal.html "ethna-document-dev\_guide-error-fatal (1240d)")**

書いた人: いちい

### 概要 [](ethna-document-dev_guide-error.html#p3a024e3 "p3a024e3")

Ethnaはフレームワークとしてエラーハンドリングの機能を用意しています。

Ethnaで登場するエラーを、大きく次の2つに分類することにします。アプリケーションの開発スタイルまで考えると明確な分類は難しいですが、発生したエラーの扱いが大きく異なっていることに注意してください。

- 開発段階のエラー
  - 文法エラーやtrigger\_error()で発生するphpのエラー\*1
  - Ethna\_Error.phpで定義されたグローバル関数 ethna\_error\_handler() が受け取る

- 運用段階のエラー
  - Ethna::raiseError()で発生するエラー
  - アプリケーションのコントローラクラス App\_Controller の handleError() が受け取る

両者の大きな違いは、エラーが発生したときの処理の実装がアプリケーション側にあるかどうかです。(デフォルトでは App\_Controller の handlerError() は実装されていないので、継承元の Ethna\_Controller の handleError() が実行されます。)

これを開発段階と運用段階と分類したのは、前者のエラーは処理を制御しにくいために運用段階で発生させるべきでないからです。もちろんset\_error\_handler()をアプリケーションで設定することも可能ですが、おすすめはしません。

### ethna\_error\_handler()の処理内容 [](ethna-document-dev_guide-error.html#v73e3d6b "v73e3d6b")

error\_reporting()の値を考慮しつつ、発生したエラーをアプリケーションのログに出力します。ログについては [ログ](ethna-document-dev_guide-log.html "ethna-document-dev\_guide-log (874d)")のページを参照してください。

また、アプリケーションの設定ファイル etc/app-ini.php 内で 'debug' => true と指定されてあり、さらにログに 'echo' が含まれない場合は、エラー内容を printf で出力します。

この挙動は、ethna\_error\_handler()が呼び出されるエラーを開発段階の時点で捕捉するためです。たとえば宣言していない変数にアクセスするなどのエラーは、開発段階で修正するようにしてください。

### Ethna::raiseError() [](ethna-document-dev_guide-error.html#mb1f5a40 "mb1f5a40")

Ethna クラスは PEAR クラスを継承しています。 Ethna::raiseError(), Ethna::raiseWarning(), Ethna::raiseNotice() は適切なエラーレベルとエラークラスとして Ethna\_Error を指定して PEAR::raiseError() を呼び出します。

PEAR::raiseError() 内で Ethna\_Error クラスのインスタンスが作られ、そのコンストラクタでアプリケーションのコントローラの handleError() が実行されます。デフォルトではログにエラーが出力されます。

複雑な仕組みですが、raiseError()を呼び出したときのみ handleError() が実行され、その後の文脈でもエラーを Ethna\_Error のオブジェクトとして取り回すことができます。例えば、呼び出した関数が Ethna\_Error を返してきた場合、そのエラーをそのまま呼出元に丸投げすれば、エラーが二重に出力されることなくエラーの発生を伝達できます。

### Ethna\_ActionErrorクラス [](ethna-document-dev_guide-error.html#ifac3c40 "ifac3c40")

運用段階のエラーについては、意図しないエラーの発生(ex, データベースへの接続に失敗したなど)を示すエラーと、アプリケーションの正常動作の中で表現したいエラー(ex, ユーザの入力文字数がオーバーしたなど)との2通りがあるとおもいます。

Ethnaでは、アクション実行中に発生したエラーをビューの遷移先で参照するために、ActionErrorというエラーのコンテナが用意されています。

現在のところフォーム(ActionForm)に強く依存した実装になっているので、今後より便利なものとしてゆく予定です。

### 具体例 [](ethna-document-dev_guide-error.html#j461fdeb "j461fdeb")

アクションクラス:

    function perform()
    {
        $obj =& $this->backend->getObject('someobj');
        if (Ethna::isError($obj)) { // Ethna::isError() でエラーかどうか判定
            $this->ae->add($obj) // ActionErrorに発生したエラーを登録
        }
    }

ビュークラス:

    function preforward()
    {
        if ($this->ae->count() > 0) { // 先ほど登録したエラーをここで参照できる
            ...
        }
    }

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??BEGIN id:note -->

* * *
\*1より正確にはzend\_error()でエラーハンドラに渡るもの  

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
