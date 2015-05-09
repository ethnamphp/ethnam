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
