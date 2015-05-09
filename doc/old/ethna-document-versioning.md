# バージョンルール
ちょっと考えながら進めたら思いのほか混乱してしまったのでここで明記させていただきます(2.x以降)。

なんか変なような気もしますが、バージョン番号なんて所詮記号です。わがまま言わせてください（てへ）。

### 正式リリース版 [](ethna-document-versioning.html#t1855a0d "t1855a0d")

正式リリース版は常に

    x.y.0

(yは奇数)という番号になります（例:Ethna-2.1.0)。

### 開発版 [](ethna-document-versioning.html#maae6366 "maae6366")

開発版は常に

    x.(y-1).d

になります。dはYYYYMMDDHHにしちゃっているので結構大きな数字になります(例:Ethna-2.0.2006050112)。

### スナップショット版 [](ethna-document-versioning.html#r45dfc89 "r45dfc89")

開発版は、CVS以外にも下記の通りスナップショットを随時取得することが出来ます。

### プレビュー版 [](ethna-document-versioning.html#dc53b7c5 "dc53b7c5")

正式リリースが近づいてきた段階で、スナップショット版を適当なタイミングでプレビュー版としてリリースします。

### 図 [](ethna-document-versioning.html#vec7aa42 "vec7aa42")

図にするとこんな感じです。

    開発版 ----------------------------------------------------->|
                           | | |
    スナップショット版 +(Ethna-2.0.2006042218) +(Ethna-2.0.2006050112) |
                                                   | |
    プレビュー版 +(Ethna-2.1.0-preview1) |
                                                                             |
    正式版 +(Ethna-2.1.0)

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
