# ethna-document-ideas-plugin_refactor- Ethna - PHPウェブアプリケーションフレームワーク</title>

リファクタメモ．

このページはアイデアというか，リファクタ用のメモです．(by sotarok)

### 用語の統一 [](ethna-document-ideas-plugin_refactor.html#h9b5f537 "h9b5f537")
<dl class="list1" style="padding-left:16px;margin-left:16px">
<dt>include</dt>
<dd>ソースコードをincludeする</dd>
<dt>load</dt>
<dd>-</dd>
<dt>get</dt>
<dd>オブジェクトを取得する</dd>
</dl>
### 2.5.0 p5に実装されているメソッド [](ethna-document-ideas-plugin_refactor.html#s4b02d7d "s4b02d7d")

- Ethna\_Plugin
- setLogger
- getPlugin
- getPluginList
- \_getPlugin
- \_loadPlugin
- \_unloadPlugin
- \_loadPluginDirList
- \_getPluginSrc
- getPluginNaming
- \_includePluginSrc
- \_searchPluginSrcDir
- \_searchPluginSrc
- searchAllPluginType
- searchAllPluginSrc
- includeEthnaPlugin
- includePlugin
- import

### searchAllPluginType [](ethna-document-ideas-plugin_refactor.html#h38dbb78 "h38dbb78")

- タイプすべての検索
- のはずだが，サブディレクトリの存在しているプラグインタイプしか検索しない
  - （つまり，Filter.php のみの場合 Filter は検出されない）
- この挙動は searchAllPluginType の挙動として正しいか
- どこで利用されるか？

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
