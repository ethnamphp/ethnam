# Ethna 焼肉会議 議事録
2009年1月25日に、焼肉をつつきながらEthna について話す会が開かれました。非常に中身が濃く、有意義なものでした。

その議事録を以下にアップします。こうした議論を元に、これからのEthnaの進化にご期待下さい。

- Ethna 焼肉会議 議事録 
  - DBレイヤの抽象化 
  - プラグインどうする？ 
  - View の扱い方と連携に関する考え方 
  - Ethna\_Session 
  - 認証(Auth) の機構はなんとかしたい 
  - URLHandler 
  - サンプルを増やす努力 
  - ドキュメント 
  - マーケティング 
  - チケットシステムどうする? 
  - 新しいコミッタ。新しい流れを 
  - 番外編 

| 書いた人 | mumumu | 2009-01-26 | 新規作成 |

### DBレイヤの抽象化 [](ethna-yakiniku-meeting-20090125.html#j636dd2a "j636dd2a")

- 何がなくとも最優先。2.5.0 preview4 に。
  - これを実現し、様々なライブラリやインターフェイスをプラガブルにする -> 最優先
- AppObject 捨てでいいと思う
  - 捨てるとして、既存のORMを取り込むか、ライブラリを使うかを決める
  - ActionForm との連携をとりやすくするのが何よりも重要
    - ActionForm は、複数の項目を連携するための仕組みがない。カスタムチェックもありだけど、'required\_if' => 'hoge > 5 AND fuga < 0' のように、項目を連携するValidate の仕組みもありではないか

### プラグインどうする？ [](ethna-yakiniku-meeting-20090125.html#ya10b2b3 "ya10b2b3")

- DB の次に優先度が高い
- 名前空間が複数（master, local) があり、ユーザがどう扱ってよいか分からない
  - アプリケーションローカルなプラグインを、グローバルなプラグインより優先させ、オーバライドしたいとの思いで作った仕組み(いちい)
    - [http://d.hatena.ne.jp/ichii386/20090126/1232911256](http://d.hatena.ne.jp/ichii386/20090126/1232911256)
    - 名前空間は最小限（ひとつ）にするべきだと思う。上記のオーバライドは、優先度をコントロールすれば実現できることではないか
    - ロードする順番を再検討すること
    - アプリケーションID, lib(extlib?) 以下、Ethna本体くらいか
    - extlib加える？
- ユーザがインストールしやすい仕組みに
  - 置いてちょっと設定すれば動くくらいでないと
- ロードする機構は考え直さないとダメだろ
  - getPlugin('hoge') は若気の至りだったとの某氏の告白
  - 少なくともrequireはダメだろ
  - Cake のコンポーネント風？ 書けばロードされる感じ
  - Ethnaのプラグイン機構が確立したらbakeryのようなサイトも欲しいよね

### View の扱い方と連携に関する考え方 [](ethna-yakiniku-meeting-20090125.html#mb0a884d "mb0a884d")

- Ethna\_ViewClass はコンテキストに依存した値を処理することで、If 文を action や テンプレートに書くのを極力防ぐための仕組みです。
  - その意味で、Viewは不要とは思えないが、Actionや ActionForm(フォームヘルパ）等との連携を改良する必要がある
    - View と ActionForm の連携にはフォームヘルパを使うべき。サンプルを増やす努力を。
    - [http://ml.ethna.jp/pipermail/users/2009-January/001092.html](http://ml.ethna.jp/pipermail/users/2009-January/001092.html)
    - アクションからViewに値をどうしても渡したい場合、call\_user\_func\_array を使う案はどうか(sotarok)
    - [http://d.hatena.ne.jp/sotarok/20090125/1232900121](http://d.hatena.ne.jp/sotarok/20090125/1232900121)
- 複数テンプレートを組み合わせられるように改良したい
  - Ethna\_Renderer#perform(true) を使えば、テンプレートの出力を取り出せるので、それを再度 assign する形で。
- 汎用Viewの実現
  - 汎用のものは取り込む方向で
  - JSON
  - ステータスコードを吐くView
  - リダイレクトビュー
    - [http://d.hatena.ne.jp/sotarok/20090125/1232900121](http://d.hatena.ne.jp/sotarok/20090125/1232900121)
    - [http://d.hatena.ne.jp/okonomi/20090125/1232876245](http://d.hatena.ne.jp/okonomi/20090125/1232876245)
- View のテストには、prefoward より、forward で exit させたほうがしっくりくるかも

### Ethna\_Session [](ethna-yakiniku-meeting-20090125.html#m0f24ac9 "m0f24ac9")

- 実装がボロいとの批判が多い
  - セッションを保存するディレクトリが固定な件
  - セッションが auto start 固定でないほうがよい場合もある
  - isValid メソッドのIPチェックがstrictすぎて携帯で使えない件
  - session ID の実装が独自で、うまく使えない場合がある件
  - DBをセッションに保存する機構を実装すべき
    - これは、DBレイヤが抽象化されることが前提

### 認証(Auth) の機構はなんとかしたい [](ethna-yakiniku-meeting-20090125.html#n6dcddfc "n6dcddfc")

- Ethna\_ActionClass を継承する方法は間違いが多い
  - 継承を忘れればセキュリティ上の致命的なミスとなる。これはどうすれば防げる？
    - authenticate インターフェイスを除いて全部ユーザの責任にする？
- プラグイン化しようよ
  - 画一的な処理なのだから、そういう形にしてもいいはず
  - プラグイン機構の確定が前提、かつ必須

### URLHandler [](ethna-yakiniku-meeting-20090125.html#ccb4dcf8 "ccb4dcf8")

- 現状はアクション名ありきで path\_info をアクション名にマッピングしている
  - アクション名ありきで path\_info の解釈が後付けなこの実装には確固たる根拠が あるわけではない（いちい）
  - mod\_rewrite や Net\_URL\_Mapper を使わざるを得ない

- 上記のような仕組みではなくて、path\_info をもとに、デフォルトでアクション名 を推定する仕組みが欲しい(重要)
  - この仕組みを実現するのに、URLHandler の仕組みをごそっと置き換えても構わな いと思う

### サンプルを増やす努力 [](ethna-yakiniku-meeting-20090125.html#pe25f208 "pe25f208")

- これこそが Ethna だ！ という流儀を示すためにも、サンプルの充実は必須
- 当然ドキュメントともリンクしている
- [http://planet.php.gr.jp](http://planet.php.gr.jp) は Ethna で出来ているので、これを最新にあわせて書き直そうよ

### ドキュメント [](ethna-yakiniku-meeting-20090125.html#i8a46eea "i8a46eea")

- 流儀を確立し、再整理は必須
  - サンプルコードを増やす努力を。[ethna-users:1093]
    - [http://ml.ethna.jp/pipermail/users/2009-January/001092.html](http://ml.ethna.jp/pipermail/users/2009-January/001092.html)
- 簡単なテキスト整形ツールが必要
  - DocBook(?) -> 学習コストが高い
  - Structured\_Text (python)
  - halt たんと simpledoc について話をしたのだけれども、あれはJavaコードにヘッダとか直に書いているのでカスタマイズが不能で彼とはうまく折り合えなかったと記憶している
  - Ethna でドキュメント管理ツールを再実装する案もあり
    - サンプルコードをコメントとかみたいな形で管理できないですかね

### マーケティング [](ethna-yakiniku-meeting-20090125.html#r834c67c "r834c67c")

- 要するに「XXといえばEthna」と言わせたい
- 目玉機能をつけることでマーケティング力を
  - 携帯とか
  - 国産とか
  - ローカルなネタを生かせるように
  - 初心者や中級者の人を増やすには、確固たるドキュメントと流儀の確立が必須

### チケットシステムどうする? [](ethna-yakiniku-meeting-20090125.html#ga7b8804 "ga7b8804")

    以下の点は結局 sourceforge.jp のチケットシステムを使うということで落ち着きました。
    (2009/02/23)

- sf.jp をご破算にしてチケットシステムを使うのもあり
- trac を新たに立てる？
- 結論としては、新たに ethna.jp のドメインでバグトラッキングシステムを立てる 方向で
  - ethna.jp のドメインなので sf.jp に入れられるものでないとダメ。希望するソフトウェアを各々出して見てください
    - kagemai
    - redmine
    - trac
    - mantis
    - ethnaで作る?

### 新しいコミッタ。新しい流れを [](ethna-yakiniku-meeting-20090125.html#c21af290 "c21af290")

- １年半近く mumumu がひとりで Ethna をいじってきたのだけど、一人の発想だと必ず進化が止まるので、新たに sotarok と maru\_cc というコミッタを迎えた(mumumu)
  - [http://d.hatena.ne.jp/sotarok](http://d.hatena.ne.jp/sotarok)
  - [http://d.hatena.ne.jp/maru\_cc](http://d.hatena.ne.jp/maru_cc)
- 新しい発想、フィードバックの流れを作れればいいなと思う(mumumu)
  - その意味で、新しいコミッタには「新しい血」を期待している
  - 気負わずに自分ができることを。
- 業務でやってることをうまくフィードバックする流れを作れたらいいなと思う(maru\_cc)

### 番外編 [](ethna-yakiniku-meeting-20090125.html#mc7e2195 "mc7e2195")

- Ethnaのメインキャラクター候補
  - 宮崎あおい
    - [http://www.aoimiyazaki.jp/](http://www.aoimiyazaki.jp/)
    - 人妻なんてそんなの関係ねぇ！！！！！
  - ポッキーのCMキャラクター(忽那汐里)
    - [http://pocky.jp/cm/pocky/index.html](http://pocky.jp/cm/pocky/index.html)
  - ポニョ(???)
    - 誰の好みだこれは
  - いちいさんをキャラクター担当に任命する
- ふじもとさんどうしてる？
- Smarty にDBコードを埋め込む変態コード。
  - [http://d.hatena.ne.jp/maru\_cc/20080625/ethna\_template\_db](http://d.hatena.ne.jp/maru_cc/20080625/ethna_template_db)
  - [http://d.hatena.ne.jp/maru\_cc/20080325/1206453551](http://d.hatena.ne.jp/maru_cc/20080325/1206453551) ＜たぶん話してたのはこっち

