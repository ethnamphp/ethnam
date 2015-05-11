# Ethna オフラインミーティング @Cake開発合宿
箱根で行われた CakePHP 開発合宿にて、Ethnaのコミッタが集う機会がありました。その際に行われた議論を以下に残しておきます。

- Ethna オフラインミーティング @Cake開発合宿 
  - Ethna_ActionForm#validate + フィルタの実行タイミング 
  - JavaScript の連携 
  - フォームヘルパについて 
  - ドキュメント 
  - プラグイン読み込み順序の変更 
  - tarball 配布パッケージ化 
  - 複数定義にまたがる ActionForm 定義の記述法 
  - skel ファイルの命名規則 
  - 拡張子を判断した View の挙動変更 
  - ViewHelper の汎用化 
  - 各自の作業内容 
    - mumumu 
    - sotarok 
    - ichii386 
    - maru_cc 

| 書いた人 | mumumu | 2009-04-11 | 新規作成 |

### Ethna_ActionForm#validate + フィルタの実行タイミング

- 現在はActionFormのvalidateメソッド実行時に、filter定義を実行してから、validateを実行している。
  - このフィルタ実行のタイミングはもっとユーザが制御できてもいいのではないか
  - validateせずにfilter定義のみを実行したいというニーズもあるはず
  - フィルタ処理をメソッドとして独立させればよいのではないか

### JavaScript の連携

- JavaScriptの連携がもっとあってもいいはず
  - js ファイルが定義されていたら勝手にincludeしてくれるとか

### フォームヘルパについて

- {form} で生成されるタグにid属性つけてもよくね？
  - それは配列を使うフォームでおかしくなる場合がある（CHECKBOX, RADIO等）のでやらない
- booleanなcheckboxをuncheckedでpostしてもpostされない(?)ので、default値を設定するとそれで上書きされてしまう

### ドキュメント

- entrypoint, configのurl, mod_rewriteとかの設定のサンプル
- 環境差異の設定サンプル

### プラグイン読み込み順序の変更

これは，やる． extlibディレクトリの配置とか．(sotarok)

- [https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15930](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15930)

### tarball 配布パッケージ化

(sotarok) これも，やる

- [https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15931](https://sourceforge.jp/ticket/browse.php?group_id=1343&tid=15931)

### 複数定義にまたがる ActionForm 定義の記述法

- required_if とか(sotarok)
- DBが絡むものは手をつけない．とりあえずaf内でできることだけ

### skel ファイルの命名規則

決定したい．

- skel/action.foo.php
- skel/view.foo.php とかとか

### 拡張子を判断した View の挙動変更

たとえば， [http://example.com/hoge/fuga](http://example.com/hoge/fuga) などでは，デフォルトのヘッダとデフォルトのテンプレート (たとえば， fuga.tpl) で， [http://example.com/hoge/fuga.js](http://example.com/hoge/fuga.js) でアクセスすると， js用のヘッダ，fuga.js.tpl を探す，など．

URLハンドラーがかかってくるのでURLハンドラーの変更のがあってからかな？と． 案くらいはまとめたい

### ViewHelper の汎用化

ViewHelperが現状は Smartyプラグインとして実装されているため、他の Rendererに変更しづらい ViewHelperの機能は、ViewHelperとして個別のプラグインに分割する Smartyのプラグインとしての register 方法は要検討 ＞Smartyを継承して プラグインサーチの方法を拡張する？

### 各自の作業内容

#### mumumu

- Ethna Viewまわりの改善(4/11中に済ませる,required)
- 動的フォームAPIの追加(フォームヘルパ用, required)
- チケット潰し(required)
- ORMの改善（optional)

#### sotarok

- プラグイン読み込み順序の変更
- tarball 配布パッケージ化
- 複数定義にまたがる ActionForm 定義の記述法
- book.ethna.jp は仕様きめて作り出す

#### ichii386

- 現状にcatch up
- ドキュメント整備(catch upしつつ)
- <select>のoptgroup対応

#### maru_cc

- 新規プロジェクト時のエントリポイントのフルパスを相対パスに
  - [http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16089](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16089)
- add-entry-point の挙動も要変更ではないか？
  - あと、作成すると同盟の actionを作ろうとするのは変なのでは？
  - [http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16102](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16102)
- Ethna_Renderer_Php.php Ethna_Renderer_Flexy.php とか
  - Smartyプラグインにべったりな部分を ViewHelperとして切り出したい
  - プラグインの仕様変更の話が出たのでそれ次第
- ethnaコマンドが縦に長すぎる件をなんとかする
  - [http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16093](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16093)
- 存在しない action名を指定された場合に app/action 以下を全includeをなんとかしたい
  - テストがapp/action以下にあることも関係しているが、不正なアクセス時に全ファイル読み込みという状況が発生してしまっている
  - [http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16094](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16094)
- testを別ディレクトリ、appと並列なtestディレクトリに移動したい
- add-project 時に、APPIDのディレクトリを自動作成する挙動を無くしたい
  - APPIDを固定にしようかという話が議題に出ていまして、それにも関係するかと思ってます
  - [http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16103](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16103)
- APPID_Controller.php から var $smarty_xxx_plugin 関連の定義を消したい
  - [http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16107](http://sourceforge.jp/ticket/browse.php?group_id=1343&tid=16107)

