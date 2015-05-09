#  Ethna - PHPウェブアプリケーションフレームワーク</title>
Ethna(えすな)は、PHPを利用したウェブアプリケーションフレームワークで **似たようなコードを書かなくてよい** ことを目標に作成しています。

### Quick Link [](ethna.html#g040e01c "g040e01c")

最新の安定版は [バージョン 2.5.0](ethna-download.html "ethna-download (25d)") です！ (PHP 5.3 非対応)   
開発版は [バージョン 2.6.0 beta2](ethna-download.html "ethna-download (25d)") (PHP 5.3 対応)   
  
**バグ報告/要望/質問等 は [メーリングリスト、IRC、Github](ethna-community.html "ethna-community (619d)") のいずれかにお願いします！**

- [ダウンロード](ethna-download.html "ethna-download (25d)")
- [インストール](ethna-document-tutorial-install_guide.html "ethna-document-tutorial-install\_guide (16d)")
- [ドキュメント](ethna-document.html "ethna-document (884d)")
- [チュートリアル](ethna-document-tutorial.html "ethna-document-tutorial (545d)")

### 最新ニュース [](ethna.html#yb7257a2 "yb7257a2")

#### Githubに移行しました。 [](ethna.html#he156524 "he156524")

[https://github.com/ethna/ethna](https://github.com/ethna/ethna)

Pull Requestをお待ちしております。

#### Ethna 2.6.0 beta 2 リリース (2011/1/4) [](ethna.html#m9d7d471 "m9d7d471")

beta1 に引き続き、開発版のリリースです。 beta1 のバグフィックスと、Smarty 3 用のRendererの追加をしました。

**[続きを読む](ethna-news.html#xd551db6)**

#### Ethna 2.6.0 beta 1 リリース (2010/12/27) [](ethna.html#p09ad386 "p09ad386")

Ethna 2.5.0 から PHP 5.3 でエラーとなる機能を修正し、2.5.0 preview 5以降に変更を予定されていた機能を盛り込んだ 2.6.0 の開発バージョンをリリースします。(このため、PHP 4 に対しては後方互換性を失います)

**[続きを読む](ethna-news.html#n9c6a2e9)**

#### Ethna 2.5.0 リリース [](ethna.html#p79e67af "p79e67af")

2009/10/18 に 安定版 Ethna 2.5.0 をリリースしました。このリリースでは Ethna 2.5.0 preview4 から変更を加え、それ以後で発見されたバグの修正や、小規模な機能追加を行い、安定版としました。2.5.0 preview5 以降で加えられた大規模な変更は含まれていません。

2.5.0 では、2.3系と比較して、utf-8 ではなく UTF-8 をデフォルトとしたこと、国際化、多次元配列等の新機能をメインとして、多くの変更が加えられています。

**[続きを読む](ethna-news.html#p79e67af)**

#### Ethna 2.5.0 preview5 リリース [](ethna.html#qebca270 "qebca270")

2009/06/22に 開発版 Ethna 2.5.0 preview5 をリリースしました。このリリースでは、ビューに関する改善を加え、汎用ビュー、さらにレイアウトビューの機能を追加しました。また、プラグイン周りの、今後のインストール方法を踏まえ、命名規則が変更になっています。

**[続きを読む](ethna-news.html#xb3f8aed)**

#### Ethna 2.5.0 preview4, 2.3.7 リリース [](ethna.html#u424a1df "u424a1df")

2009/06/16に 開発版 Ethna 2.5.0 preview4 と 安定版 2.3.7 をリリースしました。これらのリリースには、以前のバージョンで見つかった Ethna\_ActionForm#getHiddenVars のクロスサイトスクリプティングの脆弱性を修正したものが含まれています。

セキュリティに関わるリリースであるため、すべてのユーザーにアップデートを推奨します。

**[続きを読む](ethna-news.html#ta965441)**

#### pear.ethna.jp の Smarty 2.6.23, 2.6.24 を削除 [](ethna.html#r7643cb9 "r7643cb9")

5月13日、17日の両日に Smarty 2.6.23, 2.6.24 がリリースされ、pear.ethna.jp もそれに追随しましたが、これらのバージョンにはまだバグが残っていることが判明したため、削除しました。

上記の間に pear.ethna.jp を利用して Smarty をアップグレードされた方は、ダウングレードをお勧めします。

**[2009年5月24日 20:25 更新]**

バグが修正された Smarty 2.6.25 がリリースされたため、追随しました。

**[続きを読む](ethna-news.html#uc3af8e4)**

#### チケットシステムへの移行 [](ethna.html#b4782f09 "b4782f09")

2009/02/23 に Ethna のバグトラッキングシステムが sourceforge.jp 組み込みの [チケットシステムに移行しました](http://sourceforge.jp/projects/ethna/ticket/)。バグ報告や機能追加リクエストが出来るようになっていますので、どうぞ御利用下さい。

追記(2011/10/14)：チケットシステムはGithubへ移行予定です。

**[続きを読む](ethna-news.html#q291372e)**

#### Ethna 2.3.6 リリース [](ethna.html#k1bbe0c7 "k1bbe0c7")

2009/02/06 に Ethna 2.3.6 をリリースしました。このリリースは、安定版である 2.3.x 系のメンテナンスリリースです。本バージョンでは、現在開発中の Ethna 2.5 系で発見されたバグ修正をバックポートしたものが主に含まれています。

おそらく、このリリースが 安定版 2.3.x 系の最後のリリースになると考えています。安定版に対して致命的なバグが報告されない限り、Ethna 開発チームは 2.5.x 系の開発に集中する予定です。

**[続きを読む](ethna-news.html#o0a65514)**

#### Ethna 2.5.0 preview3 リリース [](ethna.html#f835daa5 "f835daa5")

2009/01/29 に Ethna 2.5.0 preview 3 をリリースしました。このリリースでは、フォーム定義を多次元配列に対応させ、動的にフォーム定義を行う際のAPIを改善しました。それに加えて、フォームヘルパ、フォームテンプレートの改善等、フォーム定義への変更が多く行われています。

また、Smarty のプラグインを分割し、ユーザがより独自のプラグインを作りやす くしました。勿論、2.5.0 preview2 以降で発見された複数のバグも修正されてい ます。

**[続きを読む](ethna-news.html#o0a65514)**

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
<!-- ??BEGIN id:latest_news -->

## ニュース

#### 2011/09/29

#### [Githubに移行しました。](ethna-news.html#h7acbdfb)

 [[続きを読む]](ethna-news.html#h7acbdfb)

#### 2011/01/04

#### [Ethna 2.6.0 beta2 リリース](ethna-news.html#xd551db6)

 [[続きを読む]](ethna-news.html#xd551db6)

<!-- END id:latest_news -->
<!-- ??BEGIN id:latest_news -->

## 最新の更新

##### 最新の10件

**2011-10-14**
- [ethna-community-topic](ethna-community-topic.html "ethna-community-topic (11d)")
- ethna
- [ethna-about](ethna-about.html "ethna-about (11d)")
- [ethna-news](ethna-news.html "ethna-news (11d)")
**2011-10-09**
- [ethna-document-tutorial-install\_guide](ethna-document-tutorial-install_guide.html "ethna-document-tutorial-install\_guide (16d)")
**2011-10-02**
- [ethna-document-tutorial-practice1](ethna-document-tutorial-practice1.html "ethna-document-tutorial-practice1 (23d)")
**2011-09-30**
- [ethna-download](ethna-download.html "ethna-download (25d)")
**2011-06-28**
- [ethna-logo](ethna-logo.html "ethna-logo (119d)")
**2011-05-23**
- [ethna-document-faq-dev\_guide\_faq](ethna-document-faq-dev_guide_faq.html "ethna-document-faq-dev\_guide\_faq (155d)")
**2011-05-21**
- [ethna-document-dev\_guide-misc-migrate\_project250to260](ethna-document-dev_guide-misc-migrate_project250to260.html "ethna-document-dev\_guide-misc-migrate\_project250to260 (157d)")

<!-- END id:latest_news -->
<!-- ??BEGIN id:search_form -->

