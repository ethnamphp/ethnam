# Ethna 第1回開発ミーティング
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

# Ethna 第1回開発ミーティング 

<!-- ?? Content ?? ========================================================= -->
<!-- ??BEGIN id:main -->
<!-- ??BEGIN id:wrap_content -->
<!-- ??BEGIN id:content -->
<!-- ??BEGIN id:page_navigator -->
<!-- ??END id:PageNavigator -->
<!-- ??BEGIN id:body --> [Ethna](index.html) > [コミュニティ](ethna-community.html) > [トピック](ethna-community-topic.html) > Ethna 第1回開発ミーティング 
## Ethna 第1回開発ミーティング [](ethna-community-topic-meeting_20060304.html#o2815992 "o2815992")
<dl class="list1" style="padding-left:16px;margin-left:16px">
<dt>とき</dt>
<dd>2006/03/04 17:00〜</dd>
<dt>ところ</dt>
<dd>GREEオフィス ミーティングルーム</dd>
</dl>
### 1. Ethnaの方向性について [](ethna-community-topic-meeting_20060304.html#y4a11573 "y4a11573")

- Ethnaらしさを維持する
  - 柔軟であり続ける(フレームワーク特有の「これをやるには便利だけど、制約があって〜出来ない」を徹底排除)
- symfony/railsに負けない:) (中身も外見も)

### 2. Ethna ToDoリスト [](ethna-community-topic-meeting_20060304.html#z397e59c "z397e59c")

#### 新コンセプト [](ethna-community-topic-meeting_20060304.html#if18a50e "if18a50e")

リポジトリはほしいね！

1. アプリケーションテンプレート

    ethna add-app-template http://ethna.jp/atl/wiki.atlとかしちゃったりして！
    ethna add-app-template http://ethna.jp/atl/blog.atl
    ethna add-app-template http://ethna.jp/atl/blog-trackback.atl

2. AppManager(/AppObject)テンプレート

    ethna add-app-manager http://ethna.jp/atl/YahooSearch.atl

3. プラグイン
  - フィルタとかめんどくさい
  - auto\_discoveryオプション
  - managerの名前(プロジェクト依存になっちゃう)
  - validationもプラグインっぽく

- 独自?/PEARのフレームワークに乗っかる?

#### 新機能 [](ethna-community-topic-meeting_20060304.html#ua0686f6 "ua0686f6")

1. ゲートウェイサポート(XMLRPC/SOAPサポート)
2. AJAXサポート
  - Ethna\_ActionFormの値をJSONとかで返せるようにしてみたり
  - innerHTML+α(エラーコードとか)みたいなのを簡単に返せるようにしたいなー
  - Ethna\_ActionForm+ヘルパークラスでJS生成したいなー
3. 楽をしたい系
  - Ethna\_ActionFormでビュー(というかフォーム)のレンダリングサポート1
    - Ethna\_Viewクラスにヘルパークラスみたいな感じでEthna\_ActionFormを指定できればいいかな？
  - Ethna\_AppObjectをもうちょっとまともに
    - MySQL依存(すいません)
    - よく分からない、ちゃんと設計されてない機能をまともにする(JOINとかのサポート、AppManagerとの連携-search系)
    - JOINサポート(active gatewayを参考にしてみよう)
    - 直でSQLサポート(SQL Parserをつかってみよう)
    - ビューを使えよ、という
  - Ethna\_ViewComponent(?)→要る

#### バグフィックスなど細かいところ [](ethna-community-topic-meeting_20060304.html#x014d6db "x014d6db")

1. Ethna\_ActionForm(全角対応、配列でファイルアップロードした場合のバグ修正、required=false時の振る舞い)

レビューをしてリファクタしたい：

1. **Ethna\_AppObjectねぇ...** + **Ethna\_DBねぇ...**
2. Ethna\_Logger(ドキュメント等、実は僕もちゃんと使っていないです)
3. Ethna\_Info改善
4. Ethna\_View\_Listってなんだ？
5. Ethna\_ClassFactoryを汎用的にしましょうか？
6. Ethna\_MailSender...
7. Ethna\_Session

Haste/Aeroマージ

1. ADOdb
2. Creole
3. テスティング
4. Util系

#### その他 [](ethna-community-topic-meeting_20060304.html#ja242618 "ja242618")

1. 脱smarty
2. PHP 5対応？
3. コーディング規約-PEAR対応(expand-tabはいいとして&newどうよ？)
  - ディレクトリ構成もなー(まぁいいか？)
4. チャンネルほしいですね

    pear channel-discover pear.ethna.jpとかしちゃったりして！

あとなにかありますでしょうか？

1. nightly build
2. デフォルトのテンプレートデザイン

#### 3. サイトリニューアル〜 [](ethna-community-topic-meeting_20060304.html#x3340482 "x3340482")

来週くらいにー

#### 4. 今後のコミュニケーションとか、あわよくば分担とか [](ethna-community-topic-meeting_20060304.html#ae69b940 "ae69b940")

- %Ethnaへようこそ
  - ログをML？web?

- MLのみか？

- TRAC/svnにしよう

- wikiにこのページを見たらパッチを送れ、ページを作る
  - ライセンスに関して

- ウェブサーババンドル(?)−悩む
  - 後から作戦

- モジュール

- アクションforward?

- セキュリティフィックス($script)

- 29の日リリース

- サーバほしいよ

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
