# 開発FAQ
  - Q. Ethna は何故 Ethna_ViewClass っていう層を設けているの？ Cakeとかのフレームワークにはこんなのないよ！ 
  - Q.テンプレートエンジンはSmartyしか使えないの? 
  - Q.?action_login=trueでアクションを選ぶのが嫌 
  - Q.デバッグはどうするの？ 
  - Q.複数のフォーム値をまたぐチェックはどうやってやるの？ 
  - Q.locationさせるメソッドはないの？ 
  - Q. DocumentRoot配下にEthnaとEthnaアプリケーションを置きたいけど・・・ 
  - Q.　ビュークラスは省略できるの？ 
  - Q.　アクションクラスは省略できるの？ 
  - Q.　アクションフォームクラスは省略できるの？ 
- Comment 


### Q. Ethna は何故 Ethna_ViewClass っていう層を設けているの？ Cakeとかのフレームワークにはこんなのないよ！

Ethna は View（テンプレート）に書かれるコンテキストに依存した(if分岐等の)処理や、定型的(JSON, リダイレクト、定型ヘッダ等) な出力処理を View に書くのが流儀です。

### Q.テンプレートエンジンはSmartyしか使えないの?

現状は、デフォルトの状態ではSmartyしか使えません。 Ethna_Rendererを継承したクラスを作成すればSmarty以外でも可能です。

PHPを使った例 [http://eringi.com/weblog/archives/2007/02/ethna_renderer.html](http://eringi.com/weblog/archives/2007/02/ethna_renderer.html)

**[Ethna_Rendererの使い方](dev_guide-renderer.md)**

### Q.?action_login=trueでアクションを選ぶのが嫌

アクションを呼び出す方法は自由にカスタマイズできます。

**[アクション名の決定方法を変更する](dev_guide-action-formname.md)**

### Q.デバッグはどうするの？

ethnaが作ったプロジェクトの中のetcディレクトリに設定項目ファイルがあります。(ProjectName-ini.phpみたいな)

デフォルトであれば、$configという配列を指定することになってるので、

    $config = array(
    	// *****
    	'debug'	=> true,
    	'log_facility' => 'file',
    	'log_level' => 'debug',
    	// *****
    );

としてやれば、logディレクトリに発行したSQLや実行したActionなどの詳細なログが溜まります。 ログレベルは

- debug
- info
- notice
- warning
- err
- crit
- alert
- emerg

があります。

ログ関連の情報については下記が参考になります。

**[ログ](dev_guide-log.md)**

### Q.複数のフォーム値をまたぐチェックはどうやってやるの？

例：ラジオボタンAをチェックすると、テキストボックスBの入力が必須になる場合など

74 ：72：2005/12/17(土) 02:51:25 ID:???

    たとえば、「Aのフォームでhogeを選択した場合にBが必須になる」くらいだったら
       簡単だよね。
       validateメソッドでチェックする前に、ActionFormの定義値を変えてやればいい。
       HOGE_ActionClass::prepareの中で
       if ($this->af->get('a') == 'hoge') {
           $this->af->form['b']['required'] = true;
       } 
       if ($this->validate() > 0) {
           return 'post';
       } 
       とかかな。これがEthnaの流儀かどうかはしらんが、ActionFormを使うならこうするかな。

validate前に動的にフォーム定義の内容を変更する技がある。\*1

### Q.locationさせるメソッドはないの？

今のところ、locationをさせるメソッドはありません。

Symfony HttpFoundation のRedirectResponseを使えるようにする予定です。

### Q. DocumentRoot配下にEthnaとEthnaアプリケーションを置きたいけど・・・

一部の(lolipopとか)サーバではDocumentRoot配下にしかファイルを置けません。その場合、project-IDが分かってしまうと、logやテンプレートソースが見えてしまいます。 .htaccessが使える場合は、

    deny from all

と書いてEthnaとEthnaアプリケーションの一番上においておくと良いと思います。

### Q.　ビュークラスは省略できるの？

できます。 ビュークラスの処理内容が空の場合は、ファイルそのものを作らないことができます。

ビュークラスファイルを作らなかった場合は、{App}_ViewClassが代わりに呼ばれます。

### Q.　アクションクラスは省略できるの？

FooアクションクラスなしでFooビュー(orテンプレート)を作ることはできます。
その場合は、他のアクションからFooビューを呼び出せばOKです。

### Q.　アクションフォームクラスは省略できるの？

できます。

フォーム値を何も受け取らない画面では、フォームクラス作成しなくてもＯＫです。(その場合は{App}_ActionFormが代わりに呼ばれます)

## Comment

- Locationとか、Viewからのアクションの指定はEthna_Utilやsmarty_functionでできるといいですね。 -- halt [?](cmd=edit&page=halt&refer=faq-dev_guide_faq.md) 2005-12-20 (火) 14:43:23
- [http://comimi.net/ethna/Aero_Util.phps](http://comimi.net/ethna/Aero_Util.phps)　こんな感じでどーでしょ。本体につっこむなら、もっとイケテルな方法ありそうですが。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=faq-dev_guide_faq.md) 2005-12-20 (火) 21:26:17
- さくら(SAKURA)のレンタルサーバも DocumentRoot 配下でないとファイルを置けません。シンボリックリンクは使用できず 500 エラーになります。これに気づかず時間を無駄にしました。 -- p2 [?](cmd=edit&page=p2&refer=faq-dev_guide_faq.md) 2007-04-12 (木) 00:05:54
- [http://ethna.jp/ethna-document-dev_guide-db.html](ethna-document-dev_guide-db.html) のページがクラックされたのか書き換わってます。本ページ管理者さんへメールなどしようと思いましたが連絡先が見当たらない為、このComment欄にて失礼します。後でこのコメントを削除していただければと思います。 -- ume [?](cmd=edit&page=ume&refer=faq-dev_guide_faq.md) 2007-11-14 (水) 15:25:58
- Ethna_Plugin_Cachemanager_Memcacheでの文字列をmemcachedサーバの台数で割っていますが、文字列を数値でわると「0」になると思うのですがどうでしょうか。 -- hoge [?](cmd=edit&page=hoge&refer=faq-dev_guide_faq.md) 2008-11-14 (金) 20:37:16
- Cachemanager_Memcacheのindex計算は確かにバグっていた気がします。 -- DQNEO [?](cmd=edit&page=DQNEO&refer=faq-dev_guide_faq.md) 2010-04-10 (土) 03:37:22

* * *
\*1ふじもとさん自身も [[Ethna-users:00012] ](http://ml.ethna.jp/pipermail/users/2005-March/000012.html)で似たような事をおっしゃってますね。\*2  
\*2というか、そっちが先:-)   
