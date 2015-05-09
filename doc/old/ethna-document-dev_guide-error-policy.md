# エラー処理ポリシー
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

# エラー処理ポリシー 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [ドキュメント](ethna-document.html) > [開発マニュアル](ethna-document-dev_guide.html) > [エラー処理](ethna-document-dev_guide-error.html) > エラー処理ポリシー 

- エラー処理ポリシー 
  - Ethna\_Error 
  - ActionError 

## エラー処理ポリシー [](ethna-document-dev_guide-error-policy.html#m27b8582 "m27b8582")

アプリケーションの実行中に生じるエラーは、次の２つにわけられます。

- System error
  - システムが原因で起きるエラー。DBエラーなど。
- User error
  - ユーザがフォームに入力した値が不正である場合のエラー。

Ethnaフレームワークでは、これらのエラーは全てEthna\_Error（またはPEAR\_Error）によって処理されます。

[![Ethna_Error1.png](http://ethna.jp/index.php?plugin=ref&page=ethna-document-dev_guide-error-policy&src=Ethna_Error1.png "Ethna\_Error1.png")](plugin=attach&refer=ethna-document-dev_guide-error-policy&openfile=Ethna_Error1.png.html "Ethna\_Error1.png")

### Ethna\_Error [](ethna-document-dev_guide-error-policy.html#dfe142c9 "dfe142c9")

Ethna\_Errorには、エラーコードとエラーメッセージが格納されています。 Ethna\_Errorはシステムとしてエラーハンドリングを行うので，実際のアプリケーションでは，Ethna\_Errorをアクションクラスで処理し，ユーザに必要な情報のみを提示します．

    function perform()
        {
            $sm =& new {アプリケーションID}_SampleManager();
             $result = $sm->test();
            if (Ethna::isError($result)) {
    
                 //エラーの場合の処理
                 .....
             }
    
             ....
         }

EthnaクラスのisError()メソッドで、エラーの有無を確認できます。 ここではtest()メソッドからエラーオブジェクトが返ってきた場合に，エラー処理を行うようにしています。

アプリケーションのManagerでエラーオブジェクトを返すには、次のようにします。

    class {アプリケーションID}_SampleManager
    {
        function test($data)
        {
            // 実際には，まともなエラー処理を行う．
            if (! $data) {
                return Ethna::raiseNotice('データがありません', E_SAMPLE_TEST);
            }
            return 0;
        }
    }

エラーオブジェクトには、Notice,Warning,Errorの3つがあります。 エラーの内容に応じて，これらを使い分けます． アプリケーション固有のエラーメッセージを渡したい場合は、EthnaクラスのraiseNotice,raiseWarning,raiseErrorメソッドを使って，Ethna\_Errorオブジェクトを生成します． この例では，raiseNoticeを用いてエラーオブジェクトを返しています． 引数には，メッセージとエラーコードを与えます．

**[アプリケーションエラーコードの定義](ethna-document-dev_guide-error-definecode.html "ethna-document-dev\_guide-error-definecode (1240d)")**

### ActionError [](ethna-document-dev_guide-error-policy.html#ded53322 "ded53322")

[![Ethna_ActionError.png](http://ethna.jp/index.php?plugin=ref&page=ethna-document-dev_guide-error-policy&src=Ethna_ActionError.png "Ethna\_ActionError.png")](plugin=attach&refer=ethna-document-dev_guide-error-policy&openfile=Ethna_ActionError.png.html "Ethna\_ActionError.png")

エラーの内容をユーザに提示した場合，アクションクラスで受け取ったエラーオブジェクトをActionErrorに格納します。 具体的には、下記のようにae(actionError)のaddObjectメソッドを使います。

    if (Ethna::isError($result)) {
                 $this->ae->addObject('testError', $result);
           }

また、エラーメッセージとエラーコードから、エラーオブジェクトを生成して、ActionErrorに追加するaddメソッドもあります。

ActionErrorの内容を表示するには，ビューで次のように書きます．

    <tr>
         <td>エラーメッセージ</td> 
         <td>{message name="testError"}</td>
      </tr>

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
<!-- ??BEGIN id:trackback -->
<!-- ?? END id:trackback --><!-- ?? BEGIN id:attach -->

* * *
添付ファイル: [![file](image/file.png)Ethna\_ActionError.png](plugin=attach&pcmd=open&file=Ethna_ActionError.png&refer=ethna-document-dev_guide-error-policy.html "2008/06/02 16:35:58 13.5KB") 1569件[[詳細](plugin=attach&pcmd=info&file=Ethna_ActionError.png&refer=ethna-document-dev_guide-error-policy.html "添付ファイルの情報")] [![file](image/file.png)Ethna\_Error1.png](plugin=attach&pcmd=open&file=Ethna_Error1.png&refer=ethna-document-dev_guide-error-policy.html "2008/06/02 16:35:58 17.4KB") 1467件[[詳細](plugin=attach&pcmd=info&file=Ethna_Error1.png&refer=ethna-document-dev_guide-error-policy.html "添付ファイルの情報")]
<!-- ?? END id:attach -->
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
