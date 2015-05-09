# Ethna 第1回開発ミーティング
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

