# 開発FAQ
  - Q. Ethnaって使えるの? 
  - Q. Ethna は何故 Ethna\_ViewClass っていう層を設けているの？ Cakeとかのフレームワークにはこんなのないよ！ 
  - Q.テンプレートエンジンはSmartyしか使えないの? 
  - Q.?action\_login=trueでアクションを選ぶのが嫌 
  - Q.デバッグはどうするの？ 
  - Q.複数のフォーム値をまたぐチェックはどうやってやるの？ 
  - Q.locationさせるメソッドはないの？ 
  - Q. DocumentRoot配下にEthnaとEthnaアプリケーションを置きたいけど・・・ 
  - Q.　ビュークラスは省略できるの？ 
  - Q.　アクションクラスは省略できるの？ 
  - Q.　アクションフォームクラスは省略できるの？ 
- Comment 

## 開発FAQ

Ethnaを使い始めてとりあえずでてくる悩みとその解決方法について列挙

### Q. Ethnaって使えるの?

[導入事例](ethna-about-cases.html "ethna-about-cases (194d)")をごらんください。 「理想の追及」よりも「実際のアプリケーション開発」に重点をおいたフレームワークだと思ってます。

### Q. Ethna は何故 Ethna\_ViewClass っていう層を設けているの？ Cakeとかのフレームワークにはこんなのないよ！

Ethna は View（テンプレート）に書かれるコンテキストに依存した(if分岐等の)処理や、定型的(JSON, リダイレクト、定型ヘッダ等) な出力処理を View に書くのが流儀です。

### Q.テンプレートエンジンはSmartyしか使えないの?

現状は、デフォルトの状態ではSmartyしか使えません。 Ethna\_Rendererを継承したクラスを作成すればSmarty以外でも可能です。

Flexyを使った例 [http://ethna.jp/ethna-flexy.html](ethna-flexy.html)

PHPを使った例 [http://eringi.com/weblog/archives/2007/02/ethna\_renderer.html](http://eringi.com/weblog/archives/2007/02/ethna_renderer.html)

**[Ethna\_Rendererの使い方](ethna-document-dev_guide-renderer.html)**

### Q.?action\_login=trueでアクションを選ぶのが嫌

アクションを呼び出す方法は自由にカスタマイズできます。

**[アクション名の決定方法を変更する](ethna-document-dev_guide-action-formname.html "ethna-document-dev\_guide-action-formname (1026d)")**

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

**[ログ](ethna-document-dev_guide-log.html "ethna-document-dev\_guide-log (874d)")**

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

今のところ、locationをさせるメソッドはありません。 Ethna\_ActionClass::performあたりで

    header('location: http://exsample.com/');
    exit;

とでもしましょう。 そのうち、どこかにメソッドとして実装されかなぁ・・？\*3

### Q. DocumentRoot配下にEthnaとEthnaアプリケーションを置きたいけど・・・

一部の(lolipopとか)サーバではDocumentRoot配下にしかファイルを置けません。その場合、project-IDが分かってしまうと、logやテンプレートソースが見えてしまいます。 .htaccessが使える場合は、

    deny from all

と書いてEthnaとEthnaアプリケーションの一番上においておくと良いと思います。

### Q.　ビュークラスは省略できるの？

できます。 ビュークラスの処理内容が空の場合は、ファイルそのものを作らないことができます。

ビュークラスファイルを作らなかった場合は、{App}\_ViewClassが代わりに呼ばれます。

### Q.　アクションクラスは省略できるの？

場合によってはできます。

[Action\_A]が[View\_AまたはView\_B]に遷移するケースで、[View\_B]が必ず[Action\_A]からのみ呼ばれるのなら、[Action\_B]は必要ありません。

### Q.　アクションフォームクラスは省略できるの？

できます。

フォーム値を何も受け取らない画面では、フォームクラス作成しなくてもＯＫです。(その場合は{App}\_ActionFormが代わりに呼ばれます)

## Comment

- Locationとか、Viewからのアクションの指定はEthna\_Utilやsmarty\_functionでできるといいですね。 -- halt [?](cmd=edit&page=halt&refer=ethna-document-faq-dev_guide_faq.html) 2005-12-20 (火) 14:43:23
- [http://comimi.net/ethna/Aero\_Util.phps](http://comimi.net/ethna/Aero_Util.phps)　こんな感じでどーでしょ。本体につっこむなら、もっとイケテルな方法ありそうですが。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-document-faq-dev_guide_faq.html) 2005-12-20 (火) 21:26:17
- さくら(SAKURA)のレンタルサーバも DocumentRoot 配下でないとファイルを置けません。シンボリックリンクは使用できず 500 エラーになります。これに気づかず時間を無駄にしました。 -- p2 [?](cmd=edit&page=p2&refer=ethna-document-faq-dev_guide_faq.html) 2007-04-12 (木) 00:05:54
- [http://ethna.jp/ethna-document-dev\_guide-db.html](ethna-document-dev_guide-db.html) のページがクラックされたのか書き換わってます。本ページ管理者さんへメールなどしようと思いましたが連絡先が見当たらない為、このComment欄にて失礼します。後でこのコメントを削除していただければと思います。 -- ume [?](cmd=edit&page=ume&refer=ethna-document-faq-dev_guide_faq.html) 2007-11-14 (水) 15:25:58
- Ethna\_Plugin\_Cachemanager\_Memcacheでの文字列をmemcachedサーバの台数で割っていますが、文字列を数値でわると「0」になると思うのですがどうでしょうか。 -- hoge [?](cmd=edit&page=hoge&refer=ethna-document-faq-dev_guide_faq.html) 2008-11-14 (金) 20:37:16
- good -- niba [?](cmd=edit&page=niba&refer=ethna-document-faq-dev_guide_faq.html) 2009-10-29 (木) 14:37:24
- いいな -- えすな [?](cmd=edit&page=%A4%A8%A4%B9%A4%CA&refer=ethna-document-faq-dev_guide_faq.html) 2009-11-25 (水) 18:40:22
- Cachemanager\_Memcacheのindex計算は確かにバグっていた気がします。 -- DQNEO [?](cmd=edit&page=DQNEO&refer=ethna-document-faq-dev_guide_faq.html) 2010-04-10 (土) 03:37:22
- fdf -- fdf [?](cmd=edit&page=fdf&refer=ethna-document-faq-dev_guide_faq.html) 2011-05-18 (水) 10:49:57
- ff -- af [?](cmd=edit&page=af&refer=ethna-document-faq-dev_guide_faq.html) 2011-05-23 (月) 16:26:16
  
<form action="http://ethna.jp/index.php" method="post"> 
<div><input type="hidden" name="encode_hint" value="ぷ"></div>
 <div>
  <input type="hidden" name="plugin" value="comment">
  <input type="hidden" name="refer" value="ethna-document-faq-dev_guide_faq">
  <input type="hidden" name="comment_no" value="0">
  <input type="hidden" name="nodate" value="0">
  <input type="hidden" name="above" value="1">
  <input type="hidden" name="digest" value="a251531a610be6805025f9f16875ecb2">
  <label for="_p_comment_name_0">お名前: </label><input type="text" name="name" id="_p_comment_name_0" size="15">

  <input type="text" name="msg" id="_p_comment_comment_0" size="70">
  <input type="submit" name="comment" value="コメントの挿入">
 </div>
</form>

* * *
\*1ふじもとさん自身も [[Ethna-users:00012] ](http://ml.ethna.jp/pipermail/users/2005-March/000012.html)で似たような事をおっしゃってますね。\*2  
\*2というか、そっちが先:-)   
\*3Mojaviのmoveメソッドみたいな感じ？あくまで希望  

