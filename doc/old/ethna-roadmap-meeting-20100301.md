# ロードマップミーティング
- 2010年 3月 1日

### コア [](ethna-roadmap-meeting-20100301.html#gb1097c4 "gb1097c4")

- PHP 5化
- Autoload化
  - ファイル名の変更（now working)
  - Autoload クラスの作成
  - ClassFactoryの役割からinclude系処理の分離

### アクションフォーム [](ethna-roadmap-meeting-20100301.html#d5c93142 "d5c93142")

- Model(DB)との連携とかどうするか？
  - DBとは切り離してForm定義があるところがEthnaっぽさだとは思うが

### 例外（エラー） [](ethna-roadmap-meeting-20100301.html#p1f4df75 "p1f4df75")

- アプリケーションエラー（EthnaError）の例外化

### ORM (AppObject) [](ethna-roadmap-meeting-20100301.html#ved6c9eb "ved6c9eb")

- AppObjectの書き直し（mumumu? now working?)

### アプリケーションマネージャ [](ethna-roadmap-meeting-20100301.html#qba9ca0a "qba9ca0a")

- Autoloadの仕組みに乗せたい

### 国際化 [](ethna-roadmap-meeting-20100301.html#n1b68315 "n1b68315")

- デフォルト言語のテンプレート

### URL ルーティング（UrlHandler） [](ethna-roadmap-meeting-20100301.html#o3ef07ff "o3ef07ff")

### コマンド [](ethna-roadmap-meeting-20100301.html#waa8af3f "waa8af3f")

### プラグイン [](ethna-roadmap-meeting-20100301.html#na9c5c63 "na9c5c63")

- extlibの有効化
  - Pluginの名前解決の変更
  - extlibのパッケージ化
  - ActionClass, ViewClass, Templateのextlib化
- extlib配布サイト？

### テスト [](ethna-roadmap-meeting-20100301.html#fd46f22c "fd46f22c")

- コマンドラインからのテストの実行 (by @okonomi)
- 個別にテストの実行 (by @okonomi)
- テスト用ディレクトリ（オプション？） (by @okonomi)

### ドキュメント [](ethna-roadmap-meeting-20100301.html#e6787f97 "e6787f97")

- チュートリアルの書き直し
- ドキュメント整備

### メモ [](ethna-roadmap-meeting-20100301.html#t2e5e8eb "t2e5e8eb")

- 2.5 系をどうするか
- 3系での下位互換性
  - Ethnaは基本継承で機能拡張をしていると思うので下位互換性を保つと厳しい
  - 下位互換性すてるなら、そもそももう少し設計し直してもいいのでは
  - Ethnaらしさとは？
- Viewプラグイン周りEthna\_Viewから外出ししたい
  - Smartyプラグインべったりを排除したい
- 各機能をプラグインっぽくしたい

### 議事録 [](ethna-roadmap-meeting-20100301.html#q9fc59e1 "q9fc59e1")

- PHP 5.3
- 名前空間使っていく
- ほぼ書き直しでもOK
  - 下位互換などは考えない。全く新しいEthna
- 構想をきちんと練って，「Ethnaっぽさを生かす」「本当に必要なもの」「使い易い」フレームワークにする
- フレームワークによってコードの道標を示す

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
