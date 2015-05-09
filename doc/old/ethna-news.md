# ニュース
  - 2011/09/29 Githubに移行しました。 
  - 2011/01/04 Ethna 2.6.0 beta2 リリース 
  - 2010/12/27 Ethna 2.6.0 beta1 リリース 
  - 2009/10/18 Ethna 2.5.0 リリース 
  - 2009/06/22 Ethna 2.5.0 preview5 リリース 
  - 2009/06/16 Ethna 2.5.0 preview4, 2.3.7 リリース 
  - 2009/05/18 pear.ethna.jp の Smarty 2.6.23, 2.6.24 を削除 
  - 2009/04/11 Ethna オフラインミーティング @Cake開発合宿 開催 
  - 2009/02/23 Ethna チケットシステムへの移行 
  - 2009/02/06 Ethna 2.3.6 リリース 
  - 2009/01/29 Ethna 2.5.0 preview3 リリース 
  - 2009/01/25 Ethna 焼肉会議開催 
  - 2008/10/11 Ethna 2.5.0 preview2 リリース 
  - 2008/07/05 Ethna 2.5.0 preview1 リリース 
  - 2008/06/02 ethna.jp のコンテンツに 不正な iframe タグが埋め込まれた件 , sourceforge.jp への移行について
    - 不正な iframe タグが埋め込まれた件について 
    - sourceforge.jp への移行について 
  - 2008/05/08 Ethna 2.3.5 リリース 
  - 2007/07/16 Ethna 2.3.2 リリース 
  - 2007/01/05 Ethna 2.3.1 リリース 
  - 2006/11/29 Ethna 2.3.0 リリース!! 
  - 2006/11/21 Ethna 2.3.0 Preview3リリース 
  - 2006/07/20 Ethna 2.3.0 Preview2リリース 
  - 2006/07/10 Ethna 2.3.0 Preview1リリース 
  - 2006/06/07 Ethna 2.1.2リリース 
  - 2006/06/07 Ethna 2.1.1リリース 
  - 2006/06/06 Ethna 2.1.0リリース 
  - 2006/04/20 Ethna 2.1.0-preview1リリース 
  - 2006/01/29 Ethna 0.2.0リリース 
  - 2006/01/03 ロゴ載せてみました（thx！＞moriyoshi） 
  - 2005/12/28 Developers Summit 2006 (デブサミ2006) 講演のお知らせ 
  - 2005/07/30 PHPカンファレンス2005のおしらせ 
  - 2005/06/06 メーリングリストのご案内 
  - 2005/06/06 再開のおしらせ 
  - 2005/03/26 オープンソースカンファレンス2005(OSC2005)終了のお礼 
  - 2005/03/08 オープンソースカンファレンス2005(OSC2005) 
  - 2005/03/06 サンプル(サインアップ)追加 
  - 2005/03/02-3 ちょこっとお詫び 
  - 2005/03/02-2 メーリングリストのご案内 
  - 2005/03/02-1 バージョン0.1.5リリース 
  - 2005/02/01 開発マニュアル(フォーム値検証)追加 
  - 2005/01/14 バージョン0.1.4リリース 
  - 2005/01/13 バージョン0.1.3 
  - 2005/01/05 新年のご挨拶 
  - 2004/12/27 開発マニュアル(フォーム値検証)を追加 
  - 2004/12/23-2 開発マニュアル(Ethna\_Info)追加 
  - 2004/12/23-1 バージョン0.1.2リリース 
  - 2004/12/21 開発マニュアル(フォーム値アクセス(配列/ファイル)) 
  - 2004/12/18 開発マニュアル(フォーム値アクセス)追加 
  - 2004/12/17 開発マニュアル(スクリプト統合)追加 
  - 2004/12/16 開発マニュアル(フィルタチェイン)追加 
  - 2004/12/14 開発マニュアル(スケルトン生成等)追加 
  - 2004/12/13 開発マニュアル(命名規則変更)追加 
  - 2004/12/12 N/A 
  - 2004/12/10 バージョン0.1.1リリース 
  - 2004/12/09 バージョン0.1.0リリース 

## ニュース

変更点の詳細は、 [変更点一覧](ethna-document-changes.md "ethna-document-changes (294d)")をご覧ください。

### 2011/09/29 Githubに移行しました。

ソースコードのホスティングをsourceforgeからgithubに移行しました

[https://github.com/ethna/ethna](https://github.com/ethna/ethna)

### 2011/01/04 Ethna 2.6.0 beta2 リリース

beta1 に引き続き、開発版のリリースです。 beta1 のバグフィックスと、Smarty 3 用のRendererの追加をしました。また、2.5.0 preview5 と 2.6.0 beta の CHANGES を整理し、まとめ直しましたので、既存のプロジェクトを移行する際にはご参照ください。

- 変更点一覧 [http://ethna.jp/index.php?ethna-document-changes#f019cfd1](ethna-document-changes.md#f019cfd1)

### 2010/12/27 Ethna 2.6.0 beta1 リリース

Ethna 2.5.0 から PHP 5.3 でエラーとなる機能を修正し、2.5.0 preview 5以降に変更を予定されていた機能を盛り込んだ 2.6.0 の開発バージョンをリリースします。(このため、PHP 4 に対しては後方互換性を失います)

PHP 5.3 に関しては、3.0 を開発するという予定でしたが、ゼロベースでコミットメントできるコミッターがいない、PHP 5.3 化の波がきており避けられない物になっている、Ethna 2.5.0 をリリースするにあたって取り込まなかった preview 版の機能が多数ある、といった理由から、Ethna 2.5.0 ベースに PHP 5.3 上で動作するバージョンのリリースを行いたかったためです。

詳細は CHANGES をご覧ください。

- [http://ethna.jp/index.php?ethna-document-changes#c2bb8363](ethna-document-changes.md#c2bb8363)

### 2009/10/18 Ethna 2.5.0 リリース

Ethna 2.5.0 をリリースしました。このリリースでは Ethna 2.5.0 preview4 から変更を加え、それ以後で発見されたバグの修正や、小規模な機能追加を行い、安定版としました。

2.5.0 では、2.3系と比較して、utf-8 ではなく UTF-8 をデフォルトとしたこと、国際化、多次元配列等の新機能をメインとして、多くの変更が加えられています。新機能については、以下のURLを参照してください。

「言語とエンコーディングの設定」  
 [http://ethna.jp/ethna-document-dev\_guide-app-setlanguage.html](ethna-document-dev_guide-app-setlanguage.md)  
「プロジェクトの国際化」  
 [http://ethna.jp/ethna-document-dev\_guide-i18n.html](ethna-document-dev_guide-i18n.md)  
「多次元配列」  
 [http://ethna.jp/ethna-document-dev\_guide-form-multiarray.html](ethna-document-dev_guide-form-multiarray.md)  
「フォームテンプレートへの変更」  
 [http://ethna.jp/ethna-document-dev\_guide-form\_template.html](ethna-document-dev_guide-form_template.md)  
「動的フォームAPI」  
 [http://ethna.jp/ethna-document-dev\_guide-app-dynamicform.html](ethna-document-dev_guide-app-dynamicform.md)  
「VAR\_TYPE\_STRING の max, min 属性に関する詳細」  
 [http://ethna.jp/ethna-document-dev\_guide-form-validate-vartypestring.html](ethna-document-dev_guide-form-validate-vartypestring.md)

詳細な変更点は 以下のURLを参照してください

[http://ethna.jp/ethna-document-changes.html#b00186c9](ethna-document-changes.md#b00186c9)

このリリースに伴い、2.5.0 が新たに安定版としてメンテナンスされます。よって、2.3.7 以前のバージョンのサポートは打ち切られます。新たに Ethna でプロジェクトを作成される方は、このバージョンを使用してください。また、2.3.x から移行を行いたい方は、以下のドキュメントを参照してください。

[http://ethna.jp/ethna-document-dev\_guide-misc-migrate\_project230to250.html](ethna-document-dev_guide-misc-migrate_project230to250.md)

### 2009/06/22 Ethna 2.5.0 preview5 リリース

開発版 Ethna 2.5.0 preview5 をリリースしました。このリリースでは、ビューに関する改善を加え、汎用ビュー、さらにレイアウトビューの機能を追加しました。また、プラグイン周りの、今後のインストール方法を踏まえ、命名規則が変更になっています。

詳細な変更点は 以下のURLを参照してください

[http://ethna.jp/ethna-document-changes.html#x29fc02d](ethna-document-changes.md#x29fc02d)

このリリースは、2.3.x からのメジャーバージョンアップと位置付けられています。よって 2.3.xとの互換性は \*ありません\*。そして、バージョンナンバーにもある通り、このリリースは安定版に移行する前に様々な機能をテストするプレビュー版(不安定版)です。追加された機能やAPIは、変更される可能性があります。そのリスクを頭に置いた上で、テスト及びフィードバックを行って下さる方々を求めています。

### 2009/06/16 Ethna 2.5.0 preview4, 2.3.7 リリース

開発版 Ethna 2.5.0 preview4 と 安定版 2.3.7 をリリースしました。これらのリリースには、以前のバージョンで見つかった Ethna\_ActionForm#getHiddenVars のクロスサイトスクリプティングの脆弱性を修正したものが含まれています。

具体的には、以下の条件を全て満たした場合にセキュリティ上の問題が再現します。

1. 配列のフォーム定義を行っている
2. 上記のフォームを、Ethna\_Actionform#getHiddenVars でHTMLの出力として取得し、 (setAppNEする等して)テンプレートにそのまま出力している。

セキュリティに関わるリリースであるため、すべてのユーザーにアップデートを推奨します。

### 2009/05/18 pear.ethna.jp の Smarty 2.6.23, 2.6.24 を削除

**[2009年5月24日 20:25 更新]**

    バグが修正された Smarty 2.6.25 がリリースされたため、
    pear.ethna.jp もそれに追随しました。

5月13日、17日の両日に Smarty 2.6.23, 2.6.24 がリリースされ、pear.ethna.jp もそれに追随しました。

これらのバージョンには、スーパーグローバル変数をテンプレートから読み取り専用にする、という変更が含まれていますが、まだバグが残っている状態です。(session\_start しないと E\_NOTICE が出ます)

よって新バージョンが出るまで、 pear.ethna.jp の Smartyは 2.6.22 のままにすることにします。これに伴い 2.6.23, 2.6.24 は削除しました。2009年5月13日から17日の間に、pear.ethna.jp を利用して Smarty をアップグレードした方は、以下の手順でダウングレードされることをお勧めします。

    $ pear clear-cache
    $ pear uninstall ethna/Smarty
    $ pear install ethna/Smarty

### 2009/04/11 Ethna オフラインミーティング @Cake開発合宿 開催

箱根で行われた CakePHP 開発合宿にて、Ethnaのコミッタが集う機会がありました。

議事録は以下をご覧下さい。 2.5.0 preview4 以降に取り込まれる各機能についての具体的な方向性が決まりました。 意見などありましたら、 [メーリングリスト、IRC、フォーラム、sourceforge.jp](ethna-community.html "ethna-community (619d)")などでお寄せください。

[http://ethna.jp/ethna-yakiniku-cakephp-onsen-20090411.html](ethna-yakiniku-cakephp-onsen-20090411.html)

### 2009/02/23 Ethna チケットシステムへの移行

2009/02/23 に Ethna のバグトラッキングシステムが sourceforge.jp 組み込みのチケットシステムに移行しました。バグの報告と機能追加リクエストが行えるようになっていますので、どうぞ御利用下さい。

URLは以下の通りです。

[http://sourceforge.jp/projects/ethna/ticket/](http://sourceforge.jp/projects/ethna/ticket/)

### 2009/02/06 Ethna 2.3.6 リリース

Ethna 2.3.6 をリリースしました。

このリリースは、安定版である 2.3.x 系のメンテナンスリリースです。本 バージョンでは、現在開発中の Ethna 2.5 系で発見されたバグ修正をバッ クポートしたものが主に含まれています。

この中には、ファイルアップロード時のバリデータに関する修正も含まれて いるため、安定版のユーザは可能であればアップデートを推奨します。

おそらく、このリリースが 安定版 2.3.x 系の最後のリリースになると考 えています。安定版に対して致命的なバグが報告されない限り、Ethna 開発 チームは 2.5.x 系の開発に集中する予定です。

安定版、プレビュー版ともども、バグ報告をお待ちしております。

詳細な変更点については、以下のページを御覧下さい。

[http://ethna.jp/ethna-document-changes.html#w8dda865](ethna-document-changes.md#w8dda865)

### 2009/01/29 Ethna 2.5.0 preview3 リリース

Ethna 2.5.0 preview 3 をリリースしました。このリリースでは、フォーム定義 を多次元配列に対応させ、動的にフォーム定義を行う際のAPIを改善しました。 それに加えて、フォームヘルパ、フォームテンプレートの改善等、フォーム定 義への変更が多く行われています。

また、Smarty のプラグインを分割し、ユーザがより独自のプラグインを作りやす くしました。勿論、2.5.0 preview2 以降で発見された複数のバグも修正されてい ます。

詳細な変更点は 以下のURLを参照してください  
 [http://ethna.jp/ethna-document-changes.html#y2250027](ethna-document-changes.md#y2250027)

このリリースは、2.3.x からのメジャーバージョンアップと位置付けられています。 よって 2.3.5との互換性は \*ありません\*。そして、バージョンナンバーにもある通 り、このリリースは安定版に移行する前に様々な機能をテストするプレビュー版(不 安定版)です。追加された機能やAPIは、変更される可能性があります。そのリスクを 頭に置いた上で、テスト及びフィードバックを行って下さる方々を求めています。

テストをして頂ける方は、「必ず」以下のドキュメントを参照頂き、フィードバック をして頂くようお願い致します。

- [2.3.x から 2.5.0への移行ガイド](ethna-document-dev_guide-misc-migrate_project230to250.md)
- [多次元配列](ethna-document-dev_guide-form-multiarray.md)
- [フォームテンプレートへの変更](ethna-document-dev_guide-form_template.md)
- [動的フォームAPI](ethna-document-dev_guide-app-dynamicform.md)
- [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.md)
- [VAR\_TYPE\_STRING の max, min 属性に関する詳細](ethna-document-dev_guide-form-validate-vartypestring.md)
- [プロジェクトの国際化](ethna-document-dev_guide-i18n.md)

### 2009/01/25 Ethna 焼肉会議開催

Ethna について焼肉をつついて話す会が行われました。Ethna のことばかり話す飲み会はとても濃く、有意義なものでした。

議事録は以下をご覧下さい。また、2.5.0 preview3 も2009年1月中にリリースされる予定です！

[http://ethna.jp/ethna-yakiniku-meeting-20090125.html](ethna-yakiniku-meeting-20090125.html)

### 2008/10/11 Ethna 2.5.0 preview2 リリース

Ethna 2.5.0 preview 2をリリースしました。このリリースでは、PEAR依存を排除するための基礎的な変更及び、プロジェクトのi18n化を楽にするためのコマンド実装が盛り込まれています。また、2.5.0 preview1 以降で発見された複数のバグが修正され、APIの微調整が行われています。

今回はユーザから見ると目立った変更は国際化の実装くらいしかないように見えますが、PEAR 依存を外すための布石として、Ethnaクラスが PEAR クラスを継承していたのを外しているため、その関連で割と変更が加わっています。ethna コマンドの Console\_Getopt も独自実装に置き換わっているため、ethna コマンドにもバグが残っている可能性があります。よって、目立つ変更点が少ないからといって侮らず、テストに御協力頂ければ幸いです。

詳細な変更点は以下のドキュメントをご覧下さい。  
 [http://ethna.jp/ethna-document-changes.html#d0c37223](ethna-document-changes.md#d0c37223)

このリリースは、2.3.x からのメジャーバージョンアップと位置付けられています。よって 2.3.5 との互換性は \*ありません\*。そして、バージョンナンバーにもある通り、このリリースは安定版に移行する前に様々な機能をテストするプレビュー版(不安定版)です。追加された機能やAPIは、変更される可能性があります。そのリスクを頭に置いた上で、テスト及びフィードバックを行って下さる方々を求めています。

テストをして頂ける方は、「必ず」以下のドキュメントを参照頂き、フィードバックをして頂くようお願い致します。

- [2.3.x から 2.5.0への移行ガイド](ethna-document-dev_guide-misc-migrate_project230to250.md)
- [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.md)
- [VAR\_TYPE\_STRING の max, min 属性に関する詳細](ethna-document-dev_guide-form-validate-vartypestring.md)
- [プロジェクトの国際化](ethna-document-dev_guide-i18n.md)

### 2008/07/05 Ethna 2.5.0 preview1 リリース

Ethna 2.5.0 preview 1をリリースしました。このリリースでは、ユーザからの要望が特に高かったUTF-8への移行及びエンコーディング依存への解消、および国際化(i18n)の基礎となる変更が盛り込まれ、かつ 2.3.5 以降の複数のバグが修正されています。

詳細な変更点は以下のドキュメントをご覧下さい。  
 [http://ethna.jp/ethna-document-changes.html#f9c85729](ethna-document-changes.md#f9c85729)

このリリースは、2.3.x からのメジャーバージョンアップと位置付けられています。よって 2.3.5との互換性は \*ありません\*。そして、バージョンナンバーにもある通り、このリリースは安定版に移行する前に様々な機能をテストするプレビュー版(不安定版)です。追加された機能やAPIは、変更される可能性があります。そのリスクを頭に置いた上で、テスト及びフィードバックを行って下さる方々を求めています。

テストをして頂ける方は、「必ず」以下のドキュメントを参照頂き、フィードバックをして頂くようお願い致します。

- [2.3.x から 2.5.0への移行ガイド](ethna-document-dev_guide-misc-migrate_project230to250.md)
- [言語とエンコーディングの設定](ethna-document-dev_guide-app-setlanguage.md)
- [VAR\_TYPE\_STRING の max, min 属性に関する詳細](ethna-document-dev_guide-form-validate-vartypestring.md)

主な変更点は以下の通りです。

- ソースコード全体をUTF-8化し、それに伴うコード修正
  - utf-8 への依存を外し、ユーザがエンコーディングを自由に選べるようにした
- i18n（国際化）への基礎的な対応
  - ロケールの追加
  - メッセージカタログ追加(gettext の支援機能はpreview2以降)
  - ethna コマンドの必要な部分にエンコーディングとロケール指定オプション追加
  - スケルトン全体をASCIIに変更
  - VAR\_TYPE\_STRING のプラグインを再編
- 2.3.5 以降報告された諸々のバグ修正。  
  
- [ダウンロード](pear/Ethna-2.5.2008070519.tgz)

### 2008/06/02 ethna.jp のコンテンツに 不正な iframe タグが埋め込まれた件 , sourceforge.jp への移行について

#### 不正な iframe タグが埋め込まれた件について

2008/06/02 の午前中に、 [ethna.jp のコンテンツに不正なiframeタグが埋め込まれているのではないかとメーリングリストに報告](http://ml.ethna.jp/pipermail/users/2008-June/000968.html)がありました。これは [複数の脆弱性を突くマルウェアへと誘導するものでした](http://namidame.2ch.net/test/read.cgi/news/1212288872/918-919)。

2008/06/02 21:30 JST +0900 現在、復旧致しました。2008/06/02 未明から、2008/06/02 21:30 JST +0900 あたりの時間帯までに、ethna.jp のコンテンツにアクセスされた方は、ウイルス、マルウェアまわりのセキュリティチェックを行うことを強く推奨致します。以下、原因の調査結果と行った対処について御説明させて頂きます。

[原因を調査した結果](http://ml.ethna.jp/pipermail/users/2008-June/000972.html)、以下の点が判明しました。

- ethna.jp のコンテンツ、アーカイブは改竄されていない
- Apache が吐き出すレスポンスには、iframe タグは埋め込まれていない。つまり、ユーザランドまでのサーバの挙動は正常
- ethna.jp のサーバの周辺帯域のIPのポート80にwgetしても同様に iframeが埋め込まれていた
- ethna.jp サーバのローカルからwgetしてもiframeは埋め込まれなかった
- ethna.jp がホストされていた sakura.ad.jp から [「不安定になっていた」という報告](http://support.sakura.ad.jp/page/news/20080602-001.news) があがってきた。

上記から、ethna.jpのサーバの上位におかれているルータに問題があったことが原因と判断しました。コンテンツへの改竄はございませんので、御安心下さい。

この調査時に、ethna.jp のサーバを停止させて頂きました。停止期間中にアクセスされた方には、御迷惑をお掛けした事をお詫びいたします。2008/06/02 21:30 JST +0900 現在、sourceforge.jp にサーバを移行させた上で、復旧済みとなっております。

#### sourceforge.jp への移行について

ethna.jp のコンテンツに不正なiframeタグが埋め込まれた件の調査と平行して、コンテンツに改竄がないことを確認した上で、ethna.jpのサーバをsourceforge.jp に移行させて頂きました。

ethna.jp はもともとEthnaの作者である藤本さんの個人用サーバにてホストされていましたが、何かあったときに藤本さんひとりに管理作業が集中することと、藤本さんが忙しい時にリリース作業がロックしてしまう点が問題になっていました。今回の移行は、それらを軽減するためのものです。

移行の対象となったサーバは以下の通りです。メーリングリストサーバにつきましては、ml.ethna.jp という藤本さんのサーバにホストしてあります。

- ethna.jp
- pear.ethna.jp

PEAR経由のダウンロード、wikiサービスの利用、MLの利用等の動作に変更はないはずですが、仮におかしな動作を発見した場合は、 [メーリングリスト、IRC、フォーラム、sourceforge.jp](ethna-community.html "ethna-community (619d)") のいずれかに御報告をお願い致します。

### 2008/05/08 Ethna 2.3.5 リリース

メンテナンスリリースとして 2.3.5 をリリースします。本バージョンでは、主に テストまわりの改善とプラグイン追加が行われ、Ethnaと本質的に依存関係にある Smarty, Simpletest を ethna.jp からPEARパッケージとして配布するよう にしました。また、2.3.2以降で報告されたバグも修正されています。

Smarty, Simpletestは、以下のコマンドでインストールできるようになりました。 依存するものをすべてインストールするには、以下のようにします。

    pear channel-discover pear.ethna.jp
    pear update-channels
    pear install -a ethna/ethna

個別にインストールするには、以下のようにします。

    pear channel-discover pear.ethna.jp
    pear update-channels
    pear install ethna/ethna
    pear install ethna/Smarty
    pear install ethna/simpletest

- [ダウンロード](pear/Ethna-2.3.5.tgz)

### 2007/07/16 Ethna 2.3.2 リリース

お待たせしました。半年ぶりに新バージョン 2.3.2 をリリースします。本バージョンでは、2.3.1 以降報告されていた複数のバグが修正されている他、Ethna\_MailSenderの改善、プラグインの追加、改善等が行われています。

- [ダウンロード](pear/Ethna-2.3.2.tgz)

### 2007/01/05 Ethna 2.3.1 リリース

あけましておめでとうございます。2.3.0はMac/Windowsでpear経由のインストールができないという深刻なバグがあったため、それを修正した2.3.1をリリースします。その他先月報告されたバグなどがいくつか修正されています。

- [ダウンロード](pear/Ethna-2.3.1.tgz)

### 2006/11/29 Ethna 2.3.0 リリース!!

[ロードマップ](ethna-document-roadmap.md "ethna-document-roadmap (1240d)")から遅れに遅れ、師走はもう目前となりましたが、とうとう Ethna-2.3.0 がリリースされました。ご要望、バグ報告などぜひともお待ちしております!!

- [ダウンロード](pear/Ethna-2.3.0.tgz)

2.3.0-preview3 から機能的な変更点はありません。2.1.2 からの変更、移行方法については、古いプロジェクトのアップデート [?](cmd=edit&page=ethna-document-dev_guide-misc-migrate_project&refer=ethna-news.md)を参照してください。

### 2006/11/21 Ethna 2.3.0 Preview3リリース

[ロードマップ](ethna-document-roadmap.md "ethna-document-roadmap (1240d)")からは相当に遅れてしまいましたが、Ethna 2.3.0 Preview3をリリースしました。ご要望、バグ報告等お待ちしております。

- [ダウンロード](pear/Ethna-2.3.0-preview3.tgz)

主な変更点は下記の通りです。ずいぶん時間が経ってしまい、かなりの変更点があるので、詳細は [変更点一覧](ethna-document-changes.md "ethna-document-changes (294d)")をご覧いただくようお願いします。

- Preview2で発見されたたくさんのバグフィックス(みなさまありがとうございます)
- ethnaコマンドの再編, getopt化, スケルトンファイル指定オプション追加
- Ethna\_AppObject, Ethna\_DB\_PEARをmysql, postgresql, spliteに簡易対応
- Smartyの{form\_input}ヘルパーの整備
- Ethna\_UrlHandlerクラス追加

バグフィックス、ドキュメント整備などを経て、月末くらいには2.3.0がリリースされる予定です。

### 2006/07/20 Ethna 2.3.0 Preview2リリース

[ロードマップ](ethna-document-roadmap.md "ethna-document-roadmap (1240d)")からは遅れること4日、Ethna 2.3.0 Preview2をリリースしました。ご要望、バグ報告等お待ちしております。

- [ダウンロード](pear/Ethna-2.3.0-preview2.tgz)

主な変更点は下記の通りです。

- Preview1で発見された幾つかのバグフィックス(みなさまありがとうございます)
- [breaking B.C.] Ethna\_ClassFactoryのリファクタリング
  - Ethna\_Backend::getObject()メソッドを追加しました
  - これにより、Ethna\_Controllerの$classメンバに

    $class = array(
      // ...
      'user' => 'Some_Foo_Bar',
    ),

と記述することで

    $user =& $this->backend->getObject('user');

としてSome\_Foo\_Barクラスのオブジェクトを取得することが出来ます
  - クラス定義が見つからない場合は下記の順でファイルを探しに行きます(include\_path)
    1. Some\_Foo\_Bar.php
    2. Some/Foo/Bar.php
    3. Some/Foo/Some\_Foo\_Bar.php
  - アプリケーションマネージャの生成もEthna\_ClassFactoryで行われます(Ethna\_ClassFactory::getManager()が追加されています)
  - これに伴い、〜2.1.xではコントローラクラスに

    $manager = array(
      'um' => 'User',
    );

のように記述されていると、Ethna\_ActionClass、Ethna\_ViewClass、Ethna\_AppObject、Ethna\_\*Managerで

    $this->um

としてマネージャオブジェクトにアクセスできていたのですが、この機能が廃止されています(不評なら戻します@preview2)
- Ethna\_Plugin\_Logwriter\_File::begin()でログファイルのパーミッションを設定するように変更
- ハードタブ -> ソフトタブ
- test runnerの追加

### 2006/07/10 Ethna 2.3.0 Preview1リリース

[ロードマップ](ethna-document-roadmap.md "ethna-document-roadmap (1240d)")からは1日遅れてしまいましたが、Ethna 2.3.0 Preview1をリリースしました(思わずPreview2の予定だったEthna\_Loggerまで手を出してしまいました)。ご要望、バグ報告等お待ちしております。

- [ダウンロード](pear/Ethna-2.3.0-preview1.tgz)

主な変更点は下記の通りです。

1. Ethna\_Renderer追加
  - 激しく実験中@preview1
2. プラグインシステム追加(w/ Ethna\_Pluginクラス)
  - Ethna\_Handle, Ethna\_CacheManager, Ethna\_LogWriterをプラグインシステムに移行
  - Ethna\_ActionFormのバリデータをプラグインシステムに移行(Ethna\_ActionForm::use\_validator\_pluginがtrueのときのみ)
  - see also
    - [http://ethna.jp/ethna-document-dev\_guide-plugin.html](ethna-document-dev_guide-plugin.md)
    - [http://ethna.jp/ethna-document-dev\_guide-form-validate\_with\_plugin.html](ethna-document-dev_guide-form-validate_with_plugin.md)
3. - [breaking B.C.] Ethna\_Loggerリファクタリング
  - Ethna\_LogWriterのプラグイン化
  - カンマ区切りでの複数ファシリティサポート
  - \_getLogWriter()クラスをオーバーライドしている方に影響があります(2.3.0以降はPlugin/Logwriter以下にLogwriterクラスを置いて、ファシリティでその名前を指定すれば任意のLogwriterを追加可能です)

### 2006/06/07 Ethna 2.1.2リリース

ほんとにたびたびすみません、全く致命的ではないのですが1つだけどうしても直したいバグを見つけてしまったので2.1.2としてリリースをさせて頂きました。よろしければこちらをご利用ください。

なお、修正点は1箇所で、2.1.0で新規に導入された{form}というSmartyプラグインのethna\_action引数を指定した場合の振舞いに関するものです。

- [ダウンロード](ethna-download.html "ethna-download (25d)")
- [変更点一覧](ethna-document-changes.md "ethna-document-changes (294d)")
- [ロードマップ](ethna-document-roadmap.md "ethna-document-roadmap (1240d)")(今後のToDo)

### 2006/06/07 Ethna 2.1.1リリース

いきなりですが、Windows版ethna.batのパスを修正して、2.1.1としてリリースしました。（特にWindowsユーザの方は）こちらのバージョンをご利用ください。

- [ダウンロード](ethna-download.html "ethna-download (25d)")
- [変更点一覧](ethna-document-changes.md "ethna-document-changes (294d)")
- [ロードマップ](ethna-document-roadmap.md "ethna-document-roadmap (1240d)")(今後のToDo)

### 2006/06/06 Ethna 2.1.0リリース

初のメジャーバージョンアップとなる [Ethna 2.1.0](ethna-download.html "ethna-download (25d)")をリリースしました。

Ethna 0.xをご利用の皆様からのフィードバック、 [GREE](http://gree.jp/)からのソースコードのフィードバックなどを合わせて、ほぼ全ての後方互換性を保ちつつ、多くの改善が行われています。

- ethnaコマンドの導入(多くの基本処理の簡略化)
- gatewayシステムの導入(XMLRPCゲートウェイサポート)
- SimpleTest連携
- Ethna\_AppObjectクラスのテーブル定義自動取得
- その他15以上のバグ修正

- [ダウンロード](ethna-download.html "ethna-download (25d)")
- [変更点一覧](ethna-document-changes.md "ethna-document-changes (294d)")
- [ロードマップ](ethna-document-roadmap.md "ethna-document-roadmap (1240d)")(今後のToDo)

後方互換性が失われた点につきましては、上記 [変更点一覧](ethna-document-changes.md "ethna-document-changes (294d)")にて「breaking B.C.」という形で記述されています。ほぼ全ては問題ないものですが、唯一の大きな変更点は

- [breaking B.C.] main\_CLIのアクション定義ディレクトリをaction\_cliに変更

です(お手数おかけいたしますです)。2.1.0以降、main\_CLIで起動された場合、アクションをaction\_cliディレクトリに探しに行きますので、アクションを記述したファイルの移動が必要となります。

ということで、新しいEthnaが皆様のお役に立てれば幸いです。

### 2006/04/20 Ethna 2.1.0-preview1リリース

[http://beta.ethna.jp/](http://beta.ethna.jp/)を開設して、2.0.xとして開発されている現時点のバージョンを2.1.0-preview1としてリリースしました。

- [ダウンロード](ethna-download.html "ethna-download (25d)")
- [変更点一覧](ethna-document-changes.md "ethna-document-changes (294d)")
- [ロードマップ](ethna-document-roadmap.md "ethna-document-roadmap (1240d)")(正式リリースまでのToDo)

### 2006/01/29 Ethna 0.2.0リリース

最新版のEthna 0.2.0のリリースを肉の日に開始しました。

PHP 4.4.xなどの仕様変更にともなう、Noticeエラーの修正などバグ修正の他、いくつかの幸せになれる機能追加があります。

### 2006/01/03 ロゴ載せてみました（thx！＞ [moriyoshi](http://gree.jp/moriyoshi/)）

[moriyoshi](http://gree.jp/moriyoshi/)に（なぜか）ロゴを作っていただいたので早速載せてみました。ありがとー！

なお、もりよしとお友達になるともっといいものもあります（なぞ

### 2005/12/28 Developers Summit 2006 (デブサミ2006) 講演のお知らせ

とある縁で [デブサミ2006](http://www.seshop.com/event/dev/2006/)で講演させていただくことになりました。よろしければ [ご参加](http://www.seshop.com/event/dev/2006/touroku/index.html)ください。

僕は、オープンソースソフトウェアでのシステム構築ってどうよ？という話を（たぶん）します。

→ [オープンソース、使ってみたらこうだった――GREEに見るオープンソースソフトウェア活用の実際](http://www.seshop.com/event/dev/2006/timetable/Default.asp?mode=detail&eid=61&sid=282&tr=05%5F%8AJ%94%AD%83e%83N%83m%83%8D%83W%81%5B#282)

あー資料つくらなきゃ...。

### 2005/07/30 PHPカンファレンス2005のおしらせ

まず何よりも、MLやリクエストページに反応できなくてものすごく申し訳なく感じています。予想を超えてあれこれ関わり出してしまってちょっと忙しい日々が続いています...。

で、さて。

いい感じに当日になってしまいましたが、今日はPHPカンファレンス2005です。またEthnaについて30分弱おはなしさせて頂くことになっています。よろしければお越し下さい（飛び入りでも多分絶対入れます）。

っていうか0.2.0はいつ出るんでしょう...（8月中には）。

### 2005/06/06 [メーリングリストのご案内](http://ml.ethna.jp/mailman/listinfo/mojavi-users)

PHP-UsersメーリングリストでもちらほらMojaviに関する投稿を見かけるようになってきましたので、試しにMojavi Usersメーリングリストを開設してみました。

意外に(日本語で)Mojaviに関する情報交換をする場がないようなので、Mojaviをご利用の方はぜひぜひご参加下さい。

→ [MLに参加](http://ml.ethna.jp/mailman/listinfo/mojavi-users)

### 2005/06/06 再開のおしらせ

いろいろ立てこんでしまってすっかりEthnaの開発が遅れていましたが、ちょっと落ち着いてきたのでそろそろ再開できそうです。というわけで、6月中に0.2.0が出せるかなーと思っています。0.2.0では

- リクエストや、頂いたパッチの反映
- 冴えないクラス構造(DBまわりとかLOGまわりとか)の修正(already in cvs)
- obsoleteなメソッドの廃止(already in cvs)
- フォーム値定義のcustom属性の複数定義対応(already in cvs)
- アクションクラスのリクエストメソッド限定機能
- フォーム値検証のエラーメッセージを書きやすく
- フォーム値定義のデフォルト値や動的変更対応
- CSRF簡易対応機能
- SOAPサーバ機能―アクションをSOAPのサービスとしてエクスポートする機能(experimental)

といった変更や修正が予定されています。その他リクエストがありましたらお知らせください。

### 2005/03/26 オープンソースカンファレンス2005(OSC2005)終了のお礼

おかげさまで、OSC2005のEthnaトラックを無事終えることが出来ました。本当にありがとうございました＞お越しいただいた皆様

また、いろいろとがんばっていきますっ。

### 2005/03/08 オープンソースカンファレンス2005(OSC2005)

03/26に開催されるオープンソースカンファレンス2005のHands-OnトラックでEthna(というか多分フレームワーク全般)についてお話しすることになりました（なってしまいました）。興味のある方もない方もぜひぜひお越し下さい。

時間は03/26(土曜日！)の14:00〜（すばらしい！）で、場所は大久保の日本電子専門学校7号館、というところです。詳細については下記を御覧下さい。

- [OSC2005](http://www.ospn.jp/osc2005/)
- [タイムテーブル](http://www.ospn.jp/osc2005/modules/xfsection/article.php?articleid=3)
- [トラック詳細](http://www.ospn.jp/osc2005/modules/eguide/event.php?eid=37)
- [会場案内](http://www.ospn.jp/osc2005/modules/xfsection/article.php?articleid=1)

### 2005/03/06 サンプル(サインアップ)追加

開発マニュアルを書くよりも楽かな？と思ってサンプルを(とりあえず)1つ作ってみました。動作確認とソースコードのダウンロード、クラスドキュメントのブラウズが出来ますので是非ご参考にして下さい。

- [動作確認](sample/)
- [ソースコード](download/Ethna-Sample.tar.gz)
- [クラスドキュメント](doc-sample/)

### 2005/03/02-3 ちょこっとお詫び

さっそく(2005/03/02 20:00くらいまでに)MLに登録してくださった皆様、mailmanのプロセスが寝ていたためconfirmメールの配送が止まってました。すみませんでしたm(\_ \_)m (てへ）

### 2005/03/02-2 [メーリングリストのご案内](http://ml.ethna.jp/mailman/listinfo/users)

Ethna Usersメーリングリストを開設してみました。開発マニュアルやサンプルがなかなか追いつかないので、その代替という意味もあります:)

- 「これって出来るの？どうやってやるの？」
- 「この面倒な処理をもっと簡単に出来る方法ありますか？」
- 「ここがこうなってたらいいのに...？」

といったEthnaやPHPフレームワークに関する何でもを想定しています（いちおう）。疑問等にはぼく（作者）も出来るだけお返事したいと思いますので、ぜひぜひご参加下さい。

→ [MLに参加](http://ml.ethna.jp/mailman/listinfo/users)

### 2005/03/02-1 バージョン0.1.5リリース

[バージョン0.1.5](http://sourceforge.jp/projects/ethna/files/)をリリースしました。主な変更点は以下の通りです。

- Ethna\_Controller::getCLI()(CLIで実行中かどうかを返すメソッド)を追加
- ethna\_error\_handlerがphp.iniの設定に応じてPHPログも出力するように変更
- Smartyプラグイン(truncate\_i18n)を追加
- MIMEエンコード用ユーティリティメソッドを追加
- include\_pathのセパレータのwin32対応

詳細は [変更点一覧](ethna-changes.html#rel-0-1-5 "ethna-changes (1240d)")を御覧下さい。

- [ダウンロード](http://sourceforge.jp/projects/ethna/files/)
- [アップデート方法](ethna-document-tutorial-install_guide.md#content_1_7 "ethna-document-tutorial-install\_guide (16d)")

### 2005/02/01 開発マニュアル(フォーム値検証)追加

[開発マニュアル](ethna-document-dev_guide.md "ethna-document-dev\_guide (302d)")を追加しました。

- [フォーム値の自動検証を行う(フィルタ編)](ethna-document-dev_guide-form-filter.md "ethna-document-dev\_guide-form-filter (619d)")
- [フォーム値の自動検証を行う(カスタムチェック編)](ethna-document-dev_guide-form-customvalidate.md "ethna-document-dev\_guide-form-customvalidate (1120d)")

### 2005/01/14 バージョン0.1.4リリース

[バージョン0.1.4](http://sourceforge.jp/projects/ethna/files/)をリリースしました。0.1.3でEthna\_InfoManagerが動作しない問題が解決されていますm(\_ \_)m

詳細は [変更点一覧](ethna-changes.html#rel-0-1-4 "ethna-changes (1240d)")を御覧下さい。

- [ダウンロード](http://sourceforge.jp/projects/ethna/files/)
- [アップデート方法](ethna-document-tutorial-install_guide.md#content_1_7 "ethna-document-tutorial-install\_guide (16d)")

### 2005/01/13 バージョン0.1.3

[バージョン0.1.3](http://sourceforge.jp/projects/ethna/files/)をリリースしました。主な変更点は以下の通りです。

- Ethna\_ActionClassにauthenticateメソッドを追加
- Ethna\_ClassFactoryクラスを追加
- 配列型のフォームを使用する際の検証処理を修正
- \_\_ethna\_info\_\_がサブディレクトリに定義されたアクションを正しく取得できない問題を修正

また、このリリースでは2つの後方互換性が失われていますのでご注意下さい。

1. Ethna\_ActionForm::\_handleError() -> Ethna\_ActionForm::handleError()
2. コントローラクスのclassメンバに定義すべきエントリが増えました。お手数ですが、_コントローラクラスのclassメンバを以下のように変更してください_  

    var $class = array(
        'class' => 'Ethna_ClassFactory',
        'backend' => 'Ethna_Backend',
        'config' => 'Ethna_Config',
        'db' => 'Ethna_DB',
        'error' => 'Ethna_ActionError',
        'form' => 'Ethna_ActionForm',
        'i18n' => 'Ethna_I18N',
        'logger' => 'Ethna_Logger',
        'session' => 'Ethna_Session',
        'sql' => 'Ethna_AppSQL',
        'view' => 'Ethna_ViewClass',
    );

詳細は [変更点一覧](ethna-changes.html#rel-0-1-3 "ethna-changes (1240d)")を御覧下さい。

- [ダウンロード](http://sourceforge.jp/projects/ethna/files/)
- [アップデート方法](ethna-document-tutorial-install_guide.md#content_1_7 "ethna-document-tutorial-install\_guide (16d)")

### 2005/01/05 新年のご挨拶

あけましておめでとうございます。

現在、Ethnaを使ったプロジェクトを3つほど走らせていて、バグ修正や不便なところ等を洗い出しています。ので、ちょっとこちらの更新が遅くなるかも知れませんが2週間ほどはご容赦ください。

### 2004/12/27 開発マニュアル(フォーム値検証)を追加

[開発マニュアル](ethna-document-dev_guide.md "ethna-document-dev\_guide (302d)")を追加しました。

- [フォーム値の自動検証を行う(基本編)](ethna-document-dev_guide-form-validate.md "ethna-document-dev\_guide-form-validate (737d)")

### 2004/12/23-2 開発マニュアル(Ethna\_Info)追加

[開発マニュアル](ethna-document-dev_guide.md "ethna-document-dev\_guide (302d)")を追加しました。

- [設定情報や定義済みアクション等を一覧する](ethna-document-dev_guide-misc-info.md "ethna-document-dev\_guide-misc-info (1240d)")

### 2004/12/23-1 バージョン0.1.2リリース

[バージョン0.1.2](http://sourceforge.jp/projects/ethna/files/)をリリースしました。このバージョンで失われた後方互換性はありません。主な変更点は以下の通りです。

- 設定情報や定義済みアクションやビューを一覧表示する\_\_ethna\_info\_\_アクションの追加
- プロジェクトスケルトン生成コマンドへの予約語チェック追加

詳細は [変更点一覧](ethna-changes.html#rel-0-1-2 "ethna-changes (1240d)")を御覧下さい。

- [ダウンロード](http://sourceforge.jp/projects/ethna/files/)
- [アップデート方法](ethna-document-tutorial-install_guide.md#content_1_7 "ethna-document-tutorial-install\_guide (16d)")

### 2004/12/21 開発マニュアル(フォーム値アクセス(配列/ファイル))

[開発マニュアル](ethna-document-dev_guide.md "ethna-document-dev\_guide (302d)")を追加しました。

- [ファイルや配列にアクセスする](ethna-document-dev_guide-form-type.md "ethna-document-dev\_guide-form-type (1006d)")

### 2004/12/18 開発マニュアル(フォーム値アクセス)追加

[開発マニュアル](ethna-document-dev_guide.md "ethna-document-dev\_guide (302d)")を追加しました。

- [フォーム値にアクセスする](ethna-document-dev_guide-form-overview.md "ethna-document-dev\_guide-form-overview (1240d)")

### 2004/12/17 開発マニュアル(スクリプト統合)追加

[開発マニュアル](ethna-document-dev_guide.md "ethna-document-dev\_guide (302d)")を追加しました。

- [スクリプトを1ファイルに統合する](ethna-document-dev_guide-misc-unify.md "ethna-document-dev\_guide-misc-unify (1240d)")

### 2004/12/16 開発マニュアル(フィルタチェイン)追加

[開発マニュアル](ethna-document-dev_guide.md "ethna-document-dev\_guide (302d)")を追加しました。

- [フィルタチェインを使用する](ethna-document-dev_guide-app-filterchain.md "ethna-document-dev\_guide-app-filterchain (1240d)")

### 2004/12/14 開発マニュアル(スケルトン生成等)追加

[開発マニュアル](ethna-document-dev_guide.md "ethna-document-dev\_guide (302d)")を追加しました。

- [アクションスクリプトのスケルトンを生成する](ethna-document-dev_guide-action-skelton.md "ethna-document-dev\_guide-action-skelton (1240d)")
- [複数のエントリポイントを作成する](ethna-document-dev_guide-app-multientrypoint.md "ethna-document-dev\_guide-app-multientrypoint (1181d)")
- [エントリポイント毎に実行可能なアクションを制限する](ethna-document-dev_guide-app-limitentrypoint.md "ethna-document-dev\_guide-app-limitentrypoint (706d)")
- [未定義のアクションが指定された場合に特定のアクションを実行する](ethna-document-dev_guide-app-fallbackentrypoint.md "ethna-document-dev\_guide-app-fallbackentrypoint (1240d)")
- [アクション名のリクエスト方法を変更する](ethna-document-dev_guide-action-formname.md "ethna-document-dev\_guide-action-formname (1026d)")
- [アクションスクリプトの配置ディレクトリを変更する](ethna-document-dev_guide-action-dir.md "ethna-document-dev\_guide-action-dir (1240d)")

### 2004/12/13 開発マニュアル(命名規則変更)追加

[開発マニュアル](ethna-document-dev_guide.md "ethna-document-dev\_guide (302d)")を追加しました。

- [アクション定義省略時の命名規則を変更する](ethna-document-dev_guide-action-namingconvention.md "ethna-document-dev\_guide-action-namingconvention (1240d)")

### 2004/12/12 N/A

日々ちまちまと開発マニュアルを書いています...。

### 2004/12/10 バージョン0.1.1リリース

いきなりお茶目なバグがあったので、バージョン0.1.1をリリースしました。ダウンロードは [こちら](http://sourceforge.jp/projects/ethna/files/)です。

### 2004/12/09 バージョン0.1.0リリース

バージョン0.1.0をリリースしました。ダウンロードは [こちら](http://sourceforge.jp/projects/ethna/files/)です。

