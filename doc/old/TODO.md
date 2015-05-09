# TODO(ロードマップ)
ユーザーの方々からの要望や、開発者が思い描いているTODOを纏めています。終わったものについては、削除 マークをつけることで、進捗度を示しています。

また、ここに記載している事柄については、IRC やメーリングリストで話し合われています。詳しくは [コミュニティ](ethna-community.html "ethna-community (619d)") のページをご覧下さい。

- TODO(ロードマップ) 
  - 2.6.x〜 
    - 概要 
    - 変更点詳細 
  - 2.5.x〜 
    - 2.5.0 preview3: NOW WORKING 
    - 2.5.0 preview2: DONE 2008/10/11 release. 
    - 2.5.0 preview1: DONE 2008/07/16 release 
  - 2.3.x〜: DONE 
    - 2.3.0-preview1: DONE 2006/07/09 release 
    - 2.3.0-preview2: DONE 2006/07/16 release 
    - 2.3.0-preview3: DONE 2006/07/23 release
  - 2.5.0 以降 (重要！) 

| 書いた人 | sotarok | 2011-01-07 | 3.0.x 削除、 2.6.x 作成 |
| 書いた人 | sotarok | 2010-02-22 | 3.0.x 作成 |
| 書いた人 | mumumu | 2008-11-13 | 新規作成 |

### 2.6.x〜 [](TODO.html#dae01731 "dae01731")

- 基本方針
  - 2.5.x + preview 5 + α を PHP 5.3.x で動かせるようにした版

#### 概要 [](TODO.html#tcc312f0 "tcc312f0")

- PHP 5.3 対応
- プラグイン機構の修正
- View機能の拡充

#### 変更点詳細 [](TODO.html#v5bb3ab3 "v5bb3ab3")

- Core
  - [Breaking B.C.] PHP 5.3 Compatible
    - アクセス修飾子の調整（private|protected|public, static) とそれに伴う skel, test等の調整
    - 不要な参照渡しの除去
    - コンストラクタのメソッド名変更
  - [Breaking B.C.] ファイル名の命名規則の変更
- Renderer
  - Smartry3 対応
    - レンダラー対応
- View
  - デフォルトのレイアウト化
  - Viewメソッド追加(header(), redirect() 等)
- プラグイン
  - [Breaking B.C.] プラグインの命名規則変更
  - extlibプラグインの読み込み機構
  - SmartyプラグインのSmarty 3対応
- Debugging
  - extlib の Debugtoolbar の同梱

### 2.5.x〜 [](TODO.html#ab963ae6 "ab963ae6")

#### 2.5.0 preview3: NOW WORKING [](TODO.html#v1991c32 "v1991c32")

- DBまわり
  - 既存ドライバを Ethna\_DBインターフェイスにあわせる
    - インターフェイス及び、その子クラスの実装がバラバラで腐ってるのを再実装
    - インターフェイスは汎用的なDBアクセスレイヤを選ぶ方向。PDOや、JDBC等。
    - 各DBドライバ（PEAR::DB, adodb, CreOle 等) の独自機能については、PHP5 であれば \_\_call を呼べばよいが、PHP4 も一応扱うからにはwrapperを書くしかない
    - [http://www.mumumu.org/~mumumu/tmp/Ethna\_DB.phps](http://www.mumumu.org/~mumumu/tmp/Ethna_DB.phps)
    - [http://www.mumumu.org/~mumumu/tmp/Ethna\_DB\_Statement.phps](http://www.mumumu.org/~mumumu/tmp/Ethna_DB_Statement.phps)
    - AppObject をその上でSelectableにする
  - ロギング周りを可能なら見直し検討
  - Ethna\_DB\_PDO の追加
  - テストを書いて確認しながら作業

- 動的フォームを ActionForm とうまく連携できるように
  - Ethna\_ActionFormのコンストラクタから呼ばれるフックを追加 -> 追加済
  - フォームヘルパ用の動的フォームAPIも追加する
  - validate() する前に、どう値の正当性を確保させるかが課題
    - View との連携なので、基本的にはvalidate済みなのが前提だが、validateone あたりが欲しいところか
- ひとつのViewに複数Formが存在した場合に、値を設定させる標準的な方法を実装する
  - 現在の Ethna の実装は ひとつのViewにひとつのFormが基本
  - {form name= .... の部分を使う
  - これは既に {form default=...} でできることだった。
  - 複数フォームがあった場合の動作を改善させた
    - 値の補正をsubmitされたformに限るようにした
    - submitしたフォームを区別するようにした

- Session
  - Ethna\_DB\_Session (assigned to maru\_cc)
  - Ethna\_Session\_MobileJP(assigned to maru\_cc)
  - セッション格納ディレクトリ等の設定を [appid]-config.php で可変に出来るように

- フォームテンプレートのシンタックスシュガー -> 実装済み
  - 'def' => array(), としなくても、'def', と定義するだけで親のフォームテンプレートの定義を補うようにする

- URLHandler
  - プラグイン化して取り込み

- Ethna\_SmartyPlugin -> 分割済み
  - ファイル毎に分割してプラグイン化する

- 多次元配列 -> 取り込み済
  - id:syachiさんのパッチ取り込み
  - test を書くこと
  - [http://d.hatena.ne.jp/syachi5150/20081022/1224676038](http://d.hatena.ne.jp/syachi5150/20081022/1224676038)

- set\_exception\_handler
  - 未実装なので実装すること

- Testing -> DONE
  - Ethna\_ActionForm#validate 配列関連テスト
  - 新規に実装した部分のリグレッションテスト

- Bug Fix
  - 複数ファイルアップロード時にrequiredが効かない件の調査 -> 修正済 DONE
    - [http://www.mumumu.org/~mumumu/sample/www/index.php?action\_upload=true](http://www.mumumu.org/~mumumu/sample/www/index.php?action_upload=true)
  - Ethna\_ActionForm::getHiddenVars で定義が配列で、値が非配列の場合にエラーになる件 -> 修正済
    - patch あり。テスト中
    - [http://maru.cc/~maru/ethna/tmp/ethna\_actionform\_gethiddenvars.patch](http://maru.cc/~maru/ethna/tmp/ethna_actionform_gethiddenvars.patch)
  - ethna pearlocal コマンドがなぜか list -a オプションだけ効かなくなっている件 -> 影響が大きいので 2.5.0 preview4 で取り込むことに
    - 原因判明 patchあり。テスト中
    - [http://www.mumumu.org/~mumumu/tmp/ethna\_getopt\_new\_nontest.patch](http://www.mumumu.org/~mumumu/tmp/ethna_getopt_new_nontest.patch)
  - UnitTest が動作しないソースが存在する -> 修正済
    - [http://sourceforge.jp/tracker/index.php?func=detail&aid=10006&group\_id=1343&atid=5092](http://sourceforge.jp/tracker/index.php?func=detail&aid=10006&group_id=1343&atid=5092)
    - [http://maru.cc/~maru/ethna/ethna\_infomanager/Ethna\_InfoManager\_analyzeActionScript.patch](http://maru.cc/~maru/ethna/ethna_infomanager/Ethna_InfoManager_analyzeActionScript.patch)
  - loggerのendメソッドが呼ばれる箇所がないため、Logwriterプラグインのendメソッドの実装がすべて、呼ばれる場所がない件 -> 修正済
    - [http://d.hatena.ne.jp/sotarok/20081204/1228394337](http://d.hatena.ne.jp/sotarok/20081204/1228394337)

- Documentation
  - 少なくとも現状に沿うように再整備
    - ロギング
    - config
    - DBまわり
    - セッション

#### 2.5.0 preview2: DONE 2008/10/11 release. [](TODO.html#sdaf2dd1 "sdaf2dd1")

- Programming
  - "ethna i18n" コマンドの実装 -> DONE
  - PEAR 依存の排除 -> DONE
  - B.C コードのうち、可能な部分の排除 -> DONE
  - メッセージカタログのパーサが Line Parser でしかない点を修正し、複数行にも対処できるようにする -> DONE
  - sekido さんによるパッチ取り込み [ethna-users:1053] -> DONE
  - smarty\_modifier\_checkbox の修正(実装が仕様に反している) -> DONE
  - Ethna\_ActionClass に $logger を付け足す -> DONE
  - Ethna\_ViewClass に $ctl を付け足す -> DONE
  - フォームのテストでNOTICEが出て Exception としてカウントされる問題の対処 -> DONE
    - raiseError してもEthnaはログを吐いてコールバックを呼ぶのみ。trigger\_error はしないので、E\_NOTICE を吐くのはEthna内部の問題
    - 調べてみると、Ethna\_ActionError#\_getActionForm が E\_NOTICE を吐いていたので対処したところ、exception はカウントされなくなったとのこと。

- Testing
  - "ethna i18n" コマンド リグレッションテスト -> DONE

- Documentation
  - strtotime の件(厳密に言うとバグではない。どこまで救うのかを決める)
  - WONTFIX. ドキュメントにその旨明記する -> DONE
  - 移行ドキュメントに追記 -> DONE
  - i18n まわりのドキュメント
    - i18n コマンドについて -> DONE
    - プロジェクトの i18n 化について -> DONE

- Release -> DONE
  - PEAR パッケージは チャンネルサーバには入れず、2.5.0 preview1のそれも削除>する。
  - stable しかチャンネルサーバには入れないポリシーにする
  - beta 版は [http://pear.ethna.jp/get/Ethna-x.x.x-YYYYMMDDMM.tgz](http://pear.ethna.jp/get/Ethna-x.x.x-YYYYMMDDMM.tgz) にしか置か>ない
  - pear config-set preferred\_state [beta|alpha] とかにしている人がアップグレードでハマるため。

#### 2.5.0 preview1: DONE 2008/07/16 release [](TODO.html#od670302 "od670302")

- UTF-8化
  - エンコーディング依存の関数または動作洗い出し -> OK
    - Ethna\_Plugin\_Validator\_[Min|Max] -> OK
    - Ethna\_UnitTestReporter#\_\_construct -> OK
    - Ethna\_Plugin\_Validator\_Mbregexp -> OK
    - smarty\_modifier\_wordwrap\_i18n -> OK
    - 全角半角のvalidateメッセージ -> OK

- バグ(?) 修正
  - Ethna\_ClassFactory#get[Manager|Object] -> OK

### 2.3.x〜: DONE [](TODO.html#y4640d3b "y4640d3b")

#### 2.3.0-preview1: DONE 2006/07/09 release [](TODO.html#qba96067 "qba96067")

- Ethna\_Plugin追加
- Ethna\_Renderer追加

- Ethna\_Handleのプラグイン対応
- Ethna\_CacheManagerのプラグイン対応

- Ethna\_LogWriterのプラグイン対応

#### 2.3.0-preview2: DONE 2006/07/16 release [](TODO.html#ib2ef94a "ib2ef94a")

- (Ethna自体の)UnitTestサポート

- ハードタブをソフトタブに

- Ethna\_ClassFactoryの汎用化
- Ethna\_AppManagerの汎用化(やっぱりやめました→近い将来プラグインのネットワークインストール対応→アプリケーションマネージャ、アプリケーションオブジェクトのネットワークインストール対応、という形で進めていきます)

#### 2.3.0-preview3: DONE 2006/07/23 release [](TODO.html#b1e7dab8 "b1e7dab8")

- Ethna\_ActionForm改善-- フォームレンダリングサポート

- Ethna\_AppObject改善-- テーブル定義->フォーム定義自動生成

- プラグインリポジトリ構築/ネットワークインストール対応

### 2.5.0 以降 (重要！) [](TODO.html#u26460b0 "u26460b0")

- プラグイン機構の改善
  - グローバルなプラグインディレクトリを設ける
  - キャッシュ機構の検討
- 複数プロジェクト間のリソースの共有方法を考える
- AppObjectの扱いとORMの扱いを再検討
  - 捨てる？ 生かす？ 車輪の再発明する？ もしくは既存の実装を利用する？
  - 同じ BSD-revised な rhaco のORMとかおもしろいかも
- Ethna\_Controller のリファクタリング
  - XMLRPC, SOAP などを別コントローラに
  - simpletest 依存コードを Ethna\_UnitTestManger に追い出す
- ビューコンポーネントサポート
  - 汎用Viewを加えていく (redirect, 404, JSON 等)
- Ethna\_Util#getDirectLinkList の改善
- PHP5 専用にする(Ethna 3.0 以降)
- 更なるドキュメントの整備
- ethnaコマンド改善
  - crudアクション一括生成
- Ajaxサポート(+ prototype.js (+ script.aculo.us連携))
  - JSONビュー対応
  - innerHTML対応
  - prototype.js連携(?)
  - (?)script.aculo.us連携
- REST対応
  - 真の意味での Restful なアクション生成を

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
