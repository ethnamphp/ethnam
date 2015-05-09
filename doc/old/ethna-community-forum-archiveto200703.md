# ethna-community-forum-archiveto200703- Ethna - PHPウェブアプリケーションフレームワーク</title>
### Ethna\_DBのqueryが動かない。
> （び） [?](cmd=edit&page=%A1%CA%A4%D3%A1%CB&refer=ethna-community-forum-archiveto200703.html) (2007-03-14 (水) 20:40:03)  
>   
> 以下のように、ソースを書いたのですが、queryのところで何も表示されません。  
> 使い方が誤っているのでしょうか？   
>   
> 要するに、複数のDBの読み書きがしたいのです。  
>   
> $db =& new Ethna\_DB($this, $tooldb\_dsn, FALSE);  
> echo "Ethna\_DB<br>";  
> $ret = $db->begin();  
> echo "eeeeeeeeeeeee<br>";  
> $ret = $db->connect();  
> echo "eeeeeeeeeeeee<br>";  
> $tooldb\_mainte\_inup\_data =& $db->query(" SELECT \* FROM tbl\_sample ");  
> echo "eeeeeeeeeeeee<br>";  
> $db->commit();  
> echo "eeeeeeeeeeeee<br>";  
> $db->disconnect();  
> echo "eeeeeeeeeeeee<br>";
- なんかいろいろと根本的に勉強したほうがいいきがする。 -- 2007-03-15 (木) 10:32:36
- こちらを参考にするとよいかも  
 [http://ethna.jp/ethna-document-dev\_guide-db.html#zc5316fe](ethna-document-dev_guide-db.html#zc5316fe) -- psuke [?](cmd=edit&page=psuke&refer=ethna-community-forum-archiveto200703.md) 2007-03-15 (木) 13:48:29
- 参考にしました。でも、Ethna以外の方法では、難しいのですね？（というか、ルール違反か？） -- （び） [?](cmd=edit&page=%A1%CA%A4%D3%A1%CB&refer=ethna-community-forum-archiveto200703.html) 2007-03-16 (金) 14:03:57

### シフトJISに変換して出力する方法。
> （び） [?](cmd=edit&page=%A1%CA%A4%D3%A1%CB&refer=ethna-community-forum-archiveto200703.html) (2007-03-08 (木) 22:50:51)  
>   
> 運用環境が、OS：euc-jp html出力が、SJISで困っています。  
>   
> Ethnaに組み込まれているFilter機能と、ob\_start()関数で、入出力時に各エンコードに変換して(Filterを使って)回避できるようなのですが、やり方がわかりません。  
>   
> どなたか解決方法ご存知の方いらっしゃいませんか？
- Smartyフィルタって何？（＾＾；） -- （び） [?](cmd=edit&page=%A1%CA%A4%D3%A1%CB&refer=ethna-community-forum-archiveto200703.html) 2007-03-09 (金) 12:36:50
- こんな感じでやってます -- ここいち [?](cmd=edit&page=%A4%B3%A4%B3%A4%A4%A4%C1&refer=ethna-community-forum-archiveto200703.html) 2007-03-12 (月) 01:12:02

    class Aero_Plugin_Filter_OutputFilter extends Ethna_Plugin_Filter
    {
        /**
         * 実行前フィルタ
         *
         * @access public
         */
        function preFilter()
        {
           ob_start();
        }
    
        /**
         * 実行後フィルタ
         *
         * @access public
         */
        function postFilter()
        {
            $str = mb_convert_encoding(ob_get_contents(), 'sjis-win','eucjp-win');
            ob_clean();
            echo $str;
            ob_end_flush();
        }
    }

- ありがとございあした。 -- （び） [?](cmd=edit&page=%A1%CA%A4%D3%A1%CB&refer=ethna-community-forum-archiveto200703.html) 2007-03-14 (水) 20:38:27

### DBでセッションを行うには
> jitto [?](cmd=edit&page=jitto&refer=ethna-community-forum-archiveto200703.html) (2007-02-13 (火) 12:33:33)  
>   
> [http://www.itt-web.net/modules/bwiki/index.php?Ethna%A4%C7Session%A4%F2DB%A4%CB%BB%FD%A4%C3%A4%C6%A4%DF%A4%EB](http://www.itt-web.net/modules/bwiki/index.php?Ethna%A4%C7Session%A4%F2DB%A4%CB%BB%FD%A4%C3%A4%C6%A4%DF%A4%EB)  
> こちらの記事によるとethna自体へハックしないとDBセッションが出来ない様ですが（２００６/５の記事）  
> それは未だに変わってませんか？
- Sessionクラスの \_read,\_writeあたりをオーバーライドして Controller でそのクラスを指定すれば動きます。\_read,\_writeメソッド内でAppObjectも使えました。 -- iyoda [?](cmd=edit&page=iyoda&refer=ethna-community-forum-archiveto200703.html) 2007-02-15 (木) 15:58:00

### トラックバックの受信について
> sohta [?](cmd=edit&page=sohta&refer=ethna-community-forum-archiveto200703.html) (2007-02-11 (日) 19:43:51)  
>   
> Ethnaを用いてトラックバックを受信したいと思っているのですが、  
> [http://url/?action\_trackback=true&key=4](http://url/?action_trackback=true&key=4)  
> をトラックバック送信先URLとして指定しているのですが、  
> POST(トラックバック)とGET(キー情報やアクション情報)の両方が取得されないために、ethna側で対応するアクションがわからず、indexへと飛ばされてしまうようです。  
> 何か解決策などありますでしょうか？
- Ethna\_ActionFormのsetFormVarsをオーバーライドして、GETとPOSTの両方を取得するようにするだけです。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2007-02-12 (月) 15:47:54
- ありがとうございます。さっそくやってみます。それにしてもスパムがうざいですね^^ -- sohta [?](cmd=edit&page=sohta&refer=ethna-community-forum-archiveto200703.html) 2007-02-12 (月) 18:37:03
- Trackback.phpのActionFormクラスで、setFormVarsの冒頭を if(isset($\_SERVER['REQUEST\_METHOD']) == false) {return;} else {$http\_vars =& array\_merge($\_POST, $\_GET);} としてみたのですが、うまくいきません。どこが間違っているのでしょうか。-- sohta [?](cmd=edit&page=sohta&refer=ethna-community-forum-archiveto200703.html) 2007-02-12 (月) 18:54:00

### PDOが、使えないと聞きましたが？
> （び） [?](cmd=edit&page=%A1%CA%A4%D3%A1%CB&refer=ethna-community-forum-archiveto200703.html) (2007-01-24 (水) 19:38:20)  
>   
> ある人が、Ethnaを使って開発テストをしたのですが、PDOが使えないと言っていました。  
> PDOは、Ethnaで使えているのですか？
- 手元にPDO環境が無いのでなんともいえないのですが、　 [http://www.google.co.jp/search?q=ethna%20pdo](http://www.google.co.jp/search?q=ethna%20pdo)　検索とかしたことありますか？ -- riaf [?](cmd=edit&page=riaf&refer=ethna-community-forum-archiveto200703.html) 2007-01-26 (金) 18:37:44
- はい、知ってます。 -- （び） [?](cmd=edit&page=%A1%CA%A4%D3%A1%CB&refer=ethna-community-forum-archiveto200703.html) 2007-01-30 (火) 16:57:33
- はい、これは知ってます。でも、公式にEthnaがサポートしているようではないようで・・・。どうなのでしょう？ -- （び） [?](cmd=edit&page=%A1%CA%A4%D3%A1%CB&refer=ethna-community-forum-archiveto200703.html) 2007-01-30 (火) 16:58:35
- 普通に使えていますが？ その「ある人」がPDOを使えないだけでは。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2007-02-12 (月) 15:54:57

### validete()の初期化について
> ちむちむ [?](cmd=edit&page=%A4%C1%A4%E0%A4%C1%A4%E0&refer=ethna-community-forum-archiveto200703.html) (2007-01-22 (月) 12:24:56)  
>   
> 現在、Ethna 2.3.0 を使用してSimpleTestを行っています  
> validate()のエラー数を取得し、下記の様な比較を実行しております。  
>   
>   
> function test\_formSample1()  
> {  
> 　　//フォームの設定  
> 　　$this->af->set('name', "1");
> 
> $this->af->set('pass', "1");
> 
> 　　// loginアクションフォーム値検証
> 
> $this->assertEqual($this->af->validate(), 0);
> 
> }  
>   
> function test\_formSample2()  
> {  
> 　　//フォームの設定  
> 　　$this->af->set('name', "a");
> 
> $this->af->set('pass', "a");
> 
> 　　// loginアクションフォーム値検証
> 
> $this->assertEqual($this->af->validate(), 0);
> 
> }  
>   
> function test\_formSample3()  
> {  
> 　　//フォームの設定  
> 　　$this->af->set('name', "b");
> 
> $this->af->set('pass', "b");
> 
> 　　// loginアクションフォーム値検証
> 
> $this->assertEqual($this->af->validate(), 0);
> 
> }  
>   
> test\_formSample1のファンクションでセットした値が正です。  
>   
> 上記の通りvalidate()で値を比較しますと、test\_formSample2内のvalidateが「2」、  
> test\_formSample3内のvalidateが「4」といった感じでvalidate内の結果がプラスされてしまいます。  
>   
> どなたか、validateの初期化の方法を知っている方教えて頂けないでしょうか？
- validate()の性格から言えば、一度しかやらないのが本来の使い方だと思います。が、どうしてもやりたければ、$this->af->ae->clear(); でクリアできるみたいです。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-30 (火) 10:43:26
- >fmさん　ありがとうございます。非常に助かりました。 -- ちむちむ [?](cmd=edit&page=%A4%C1%A4%E0%A4%C1%A4%E0&refer=ethna-community-forum-archiveto200703.html) 2007-01-30 (火) 11:20:01

### 配列フォームのエラー取得について
> kent [?](cmd=edit&page=kent&refer=ethna-community-forum-archiveto200703.html) (2007-01-18 (木) 18:25:35)  
>   
> 2度目の質問となります。  
>   
> たとえば、

input type="text" name="hoge[]">

> input type="text" name="hoge[]">  
> ・・・  
> みたいな、配列でポストされるフォームがあったとします。  
>   
> この場合、3番目の要素で入力値にエラーがあったとして、  
> 「hogeの3番目の入力がおかしいです」  
> みたいにメッセージを出すにはどのようにすればいいのでしょうか。  
>   
> ご教示をよろしくお願いいたします。
- うーんと、いまのethnaは配列で個々の要素のエラーをうまく扱えません。この問題はずいぶん前から意識はしてたんですが$,1s&。優先度高めで対応したいと思います。(B -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-21 (日) 22:44:09
- なるほど、そうでしたか。宜しくお願いいたします。 -- kent [?](cmd=edit&page=kent&refer=ethna-community-forum-archiveto200703.html) 2007-01-25 (木) 19:20:30

### 自前のスケルトンを複数使いたい
> まえやま [?](cmd=edit&page=%A4%DE%A4%A8%A4%E4%A4%DE&refer=ethna-community-forum-archiveto200703.html) (2007-01-16 (火) 01:47:42)  
>   
> skel.action.php とは別に、「あるタイプのアクション」を作りたいときに使えるスケルトンを追加したいのですが、何かやり方はありますか？  
> ハックするしかないのでしょうか？  
> 勝手に skel.action\_dashboard.php を作って  
> ethna add-action-dashboard  
> してみたのですが動作してくれなかったもので。
- アクションクラスを複数作って用途に応じて継承するタイプを変えるってのはだめですか？ -- maical [?](cmd=edit&page=maical&refer=ethna-community-forum-archiveto200703.html) 2007-01-16 (火) 10:01:15

- preview3あたりから、「--skelfile」を指定することで、任意のスケルトンファイルを使用することができるようになっているはずです。(ごめんなさい。自分は使ってないので詳細はわかりません) -- riaf [?](cmd=edit&page=riaf&refer=ethna-community-forum-archiveto200703.html) 2007-01-16 (火) 20:54:36
- riafさんのおっしゃるとおり、"ethna add-action -s skel.action\_dashboard.php foo" みたいにやれます。Ethna本体かアプリのskelディレクトリに置けば勝手に探します。けど、"ethna add-action-dashboard" が自動で使えるようになるのもなかなかいい感じですね。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-18 (木) 04:48:12
- ありがとうございます。＞maicalさん：はい、そうしようと思ってるのですが毎回継承を書き直すのが面倒なので、はじめから特定のアクションを継承したものが生成されればうれしいな、と。＞riafさん、いちいさん：ありがとうございますー。やってみます。 -- まえやま [?](cmd=edit&page=%A4%DE%A4%A8%A4%E4%A4%DE&refer=ethna-community-forum-archiveto200703.html) 2007-01-24 (水) 17:28:03

### リスト表示しました
> maical [?](cmd=edit&page=maical&refer=ethna-community-forum-archiveto200703.html) (2007-01-15 (月) 14:05:27)  
>   
> 記事が多くなって見づらいと思ったので  
> 勝手ながらリスト表示したんですが、  
> 余計に見づらいよ！ってことなら戻します。。
- ページングして欲しいような気もします。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-15 (月) 15:12:44

### メールが送れない
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2007-01-13 (土) 15:09:29)  
>   
> なんか私ばかりですみません。  
>   
> Ethna\_MailSenderを使ってメールを送るスクリプトを書きましたが、  
> サーバを移した途端動作しなくなりました（画面真っ白）。  
> サーバの sendmail のせいかと思いましたが、  
> シンプルに mail() を使って送るテストスクリプトは動作しました。  
> Ehtna\_MailSender も mail() を使って送っているようですが、  
> 原因は何が考えられますか？
- PHPのバージョンがあると嬉しいのですが、、、　とりあえず、mail()でエラーが発生するのはPHP4の場合が多いです。setOption(null) とかしてあげると、とりあえずPHP4でも動くようになります(この辺はリファレンスのmail項を確認してみてください) -- riaf [?](cmd=edit&page=riaf&refer=ethna-community-forum-archiveto200703.html) 2007-01-13 (土) 15:23:07
- お返事ありがとうございます。setOption(null)してみましたがダメですね。バージョンは移転前は4.4.4、移転後は4.3.9です。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-13 (土) 16:33:53
- Ethnaのバージョンも違ってました。移行前は2.3.0、後は2.3.1です。で、色んな箇所にecho exit入れてチェックしましたが、どうやらEthna\_MailSenderの120行目、\_parse()でこけている感じです。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-13 (土) 18:58:59
- こけてる箇所を特定しました。Ethna\_MailSender::\_parse()内のpreg\_replaceでEthna\_Util::encode\_MIMEしてる部分です。この直前までは echo で文字が出ますが、この行の直後から出なくなります。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-13 (土) 19:05:41
- 解消しました。PHPがutf、コードがeucのために起こる不具合だったようです。お騒がせしました$,1s&。(B -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-16 (火) 13:03:34

### 日付の妥当性チェック
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2007-01-07 (日) 18:41:57)  
>   
> VAR\_TYPE\_DATETIME型のフォームに 2007-02-31 のような  
> あり得ない日付を指定しても OK になってしまいます。  
> strtotime()でチェックしているようですが、  
> 2007-02-31は1172847600(2007-03-03)に変換するだけみたいです。  
>   
> 日付の妥当性までチェックまでする予定はありますか$,1s&？(B
- あ、PHP4 です。5ではどうか知りません。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-07 (日) 18:42:31
- 組み込みの日付チェックは「strtotime()に任せる」ポリシーになってます。バリデータプラグインを作ればokですが、予定としては、もうすこしいろんなチェックができるプラグインを標準添付するかもです。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-08 (月) 19:31:48
- ですか。プラグイン書いた方がよさそうですね。ありがとうございました。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-11 (木) 10:45:18

### 多次元配列の定義
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2007-01-05 (金) 10:29:17)  
>   
> ActionFormの $form['foo']['type'] に多次元の配列を定義したいんですが、  
> できますか？　できるのなら、どのようにすればいいですか？
- あ、すいません。validate()したいという意味です。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-05 (金) 13:41:17
- 専用のvalidatorプラグインを作れば対応できますが、テンプレートのフォームヘルパ({form\_input}とか)まで考えると、あまりおすすめしません。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-05 (金) 14:48:53
- やっぱり1次までですか$,1s&再起的に定義できるようにするとしても、フォームヘルパでどう処理して良いか解りませんよね。ありがとうございました。(B -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-05 (金) 15:32:28

### Ethna-2.3.0の挙動について
> takuya.o [?](cmd=edit&page=takuya.o&refer=ethna-community-forum-archiveto200703.html) (2007-01-04 (木) 12:17:04)  
>   
> あけましておめでとうございます。  
> この前、いきなり挨拶もなくて申し訳ありませんでした。  
>   
>   
> PEARコマンドではインストールできないのですが、アーカイブで落として設置してみたところ上手く出来ました。  
> しかし、$ ethna add-project [id] [dir]とやったとき、  
> Ethnaからインストール先を聞かれますよね。  
>   
> creating directory (c:\php\[id]) [y/n]:  
> と[dir]を指定しているのに勝手にC:\ドライブをベースにしてしまいます。。  
> また、Ethna-2.1.2でインストールし直したところちゃんと指定してくれたディレクトリにスケルトンを作ってくれるみたいです。  
>   
> それにしてもEthnaは凄いですねーｗ  
> ちょっとバグフィックスに協力したいと思いますー
- add-projectの引数の指定方法が変わりました。[dir]の部分は

    $ ethna add-project -b [dir] [id]

のように指定してください。(アナウンス不足でした、すいませんです...) -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-04 (木) 23:36:04
- 「Ethna-2.3.0のインストールに失敗する」に関連して、解決することができました。Ethnaでなにか作ってみたり挑戦します。今後とも宜しくお願い致します。 -- takuya.o [?](cmd=edit&page=takuya.o&refer=ethna-community-forum-archiveto200703.html) 2007-01-10 (水) 21:29:42

### Ethna-2.3.0のインストールに失敗する
> ethnanasi [?](cmd=edit&page=ethnanasi&refer=ethna-community-forum-archiveto200703.html) (2006-12-31 (日) 17:01:22)  
>   
> Mac OS X 10.4付属のphp環境でpearを利用してethnaをインストールしようとしたのですが、出来ませんでした。よろしければ、ご教授の程お願いします。
> 
> % sudo pear install http://ethna.jp/pear/Ethna-2.3.0.tgz
> downloading Ethna-2.3.0.tgz ...
> Starting to download Ethna-2.3.0.tgz (159,193 bytes)
> ..................................done: 159,193 bytes
> Could not delete /usr/bin/ethna, cannot rename /usr/bin/.tmpethna
> ERROR: commit failed
- 私もPEARコマンドでインストールを試みたのですが、どうしてもERROR: commit failedで止まってしまいPHPディレクトリ・PEARディレクトリに空のフォルダができてしまいます。おそらくエラーを見るとCould not delete /usr/bin/ethna, cannot rename /usr/bin/.tmpethnaにある.tmpethnaが怪しい気がするんですが...私の環境はWindows XP SP2/Apache1.3系/PHP4.4.4です。よろしくお願い致します。 -- t.okada [?](cmd=edit&page=t.okada&refer=ethna-community-forum-archiveto200703.html) 2007-01-01 (月) 15:13:44
- この問題、原因はわかったんですが、いい解決策がまだ見つかってません(ファイル名の大文字小文字の区別っぽい)。2.1.2とかはふつうにインストールできていたんでしょうか? -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-05 (金) 10:59:56
- パッケージ側を修正することで対応しました。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-05 (金) 17:22:13
- インストールはできました！ですが、ethnaコマンド打ったら「Fatal error: Cannot redeclare class pear in C:\php\pear\PEAR.php on line 103」となり、出来ませんでした.. -- takuya.o [?](cmd=edit&page=takuya.o&refer=ethna-community-forum-archiveto200703.html) 2007-01-06 (土) 11:08:11
- Ethna本体をいじったりしてないですか? 「require 'PEAR.php';」を追加してるとか。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-06 (土) 18:59:16
- 何度もすみません..Ethnaアーカイブを落として解凍したままを入れています。それでも解決できなく、PHP及びPEARの再インストールしEthna2.3.1.tgzにトライしました。結果が変わりませんでした..とほほ..Ethna-2.1.2でやってみたところ問題なくethnaコマンドを走らせることができます。 -- takuya.o [?](cmd=edit&page=takuya.o&refer=ethna-community-forum-archiveto200703.html) 2007-01-07 (日) 12:20:57
- うーん、エラーメッセージの内容的にEthnaではなくて、どこかで不要なrequireをしているからだと思うんですが...。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-08 (月) 20:21:51
- いつも速い対応ありがとうございます。やはりエラーの内容に従っているのですが．．．ＰＨＰもＰＥＡＲも再インストールするなりできることは全てやったんです^^;修正する前は使えたんですけどね．．．ＰＥＡＲのレジストリが壊れているということでしょうか．．．。 -- takuya.o [?](cmd=edit&page=takuya.o&refer=ethna-community-forum-archiveto200703.html) 2007-01-10 (水) 16:56:05
- 全く追っていないのですが、windows環境で「Fatal error: Cannot redeclare class pear in C:\PHP\PEAR\PEAR.php on line 86」が出ていて、bin\ethna\_handle.phpの30行目の変更を元に戻すと動きます。30c30< ini\_set('include\_path', "$base" . PATH\_SEPARATOR . ini\_get('include\_path'));---> ini\_set('include\_path', ini\_get('include\_path') . PATH\_SEPARATOR . "$base");　ご参考まで。。 -- itsuki [?](cmd=edit&page=itsuki&refer=ethna-community-forum-archiveto200703.html) 2007-01-10 (水) 18:18:02
- itsukiさん、ありがとうございます！おかげで解決しました。やはり、消してしまった前のアーカイブ(2.3.0)とソースを比較する方が早かったのかもしれませんね..たくさんレスを伸ばしてしまい、すみません... -- takuya.o [?](cmd=edit&page=takuya.o&refer=ethna-community-forum-archiveto200703.html) 2007-01-10 (水) 21:28:05

### SQLインジェクションの防止について
> とび [?](cmd=edit&page=%A4%C8%A4%D3&refer=ethna-community-forum-archiveto200703.html) (2006-12-27 (水) 14:43:12)  
>   
> Ethna\_DB\_PEARではquoteSmart()が利用できないようですが、  
> どのように処理すればよいですか？  
> ご教授いただけると助かります。
- $db->db->quoteSmartみたいな感じ呼べるけど、、、という話でしょうか？ 個人的にはprepareを使う事をオススメします -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-12-27 (水) 18:49:17

### テンプレートで使用する共通変数の格納場所について
> kent [?](cmd=edit&page=kent&refer=ethna-community-forum-archiveto200703.html) (2006-12-09 (土) 16:30:01)  
>   
> テンプレートに共通で使う変数（サイト名とかURLとか）は皆さんどこにセットしてるでしょうか。  
>   
> ＊-ini.phpに書いて$this->configで出せばいいとは思うんですが、DSNなどのシステム的なものとは分離して変数を格納する場所が欲しいと思っています。また、その度にsetAppするのは面倒なので、その場所で指定した変数は常に$app.\*にセットされていて、テンプレートで使える状態にしたいと思ってるのですが。ActionClass::performをいじればいいのかな、と思ったのですがどうもスマートではない気がして。~  
> まだ使い始めて日が浅く全体的な見通しが出来ていないため、変な事を聞いてるかもしれませんが、  
> ご教示のほど宜しくお願いいたします。
- ViewClassの\_setDefault()辺りがいいんじゃないでしょうか。 [http://ethna.jp/index.php?cmd=read&page=ethna-document-dev\_guide-renderer](cmd=read&page=ethna-document-dev_guide-renderer.html) -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.md) 2006-12-09 (土) 17:24:01
- おお、やはりこういった関数がちゃんと用意されているのですね。ありがとうございます。これでやってみます。 -- kent [?](cmd=edit&page=kent&refer=ethna-community-forum-archiveto200703.html) 2006-12-09 (土) 18:17:39
- fmさんのおっしゃるようにViewのsetDefaultが正しいです。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-12-11 (月) 13:30:43

### 空文字列の取り込みについて
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2006-12-08 (金) 12:17:15)  
>   
> 立て続けにすみません。  
> テーブル上では double 型、VAR\_TYPE\_FLOATでFORM\_TYPE\_TEXTの  
> フォームがあります。このフィールドはDB上では Null でも OK なんですが、  
> フォームで空文字列を送ると "0" が設定されてしまいます。  
> 作成中のシステムでは "0" は有効値なので、  
> 空文字列には Null を設定してもらいたいのですが$,1s&仕様なんでしょうか。(B
- nullをsetすればできたような -- 2006-12-08 (金) 18:12:38
- 空文字列を0に変換しているのは、たぶんmysqlとかだと思います。ということで仕様ということになってしまうんですが、ちょっと扱いにくい感じはするので、いい方法があったら改善したいと思います。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-04 (木) 23:42:25
- 空文字列を0にしてるのは確かにMySQLですね。今はimportForm()内で、フォーム値がstrlen() == 0ならnullという風に改造して使ってます。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2007-01-05 (金) 10:32:02

### フォームヘルパをつかってマネージャからデータを渡したときの処理について
> やまざき [?](cmd=edit&page=%A4%E4%A4%DE%A4%B6%A4%AD&refer=ethna-community-forum-archiveto200703.html) (2006-12-06 (水) 21:29:22)  
>   
> フォームヘルパにてアプリケーションマネージャのプロパティの配列からデータを取得して<select>にしようとしてますが、配列のkeyは取り出せるのですが、valueがうまく取り出せません。  
>   
> Foo\_BarManager.php:  
> $xxx\_list = array('1'=>'a', '2'=>'20', '3'=>'日本語');  
>   
> 上記配列は以下のように変換されます。

option value="1">a</option>

> option value="2">2</option>
> 
> option value="3">?</option>  
>   
> Foo\_BarManagerに書いた書式でアクションフォーム内に  
> 'option' => array(...と書いた場合は正しく変換されます。  
>   
> いろいろとソース探索したところ疑問に思う点がありましたので書いてみます。  
> Ethna\_ViewClass.php:  
> \_getSelectorOptions(){  
> ...
> 
> // マネージャから取得
> $mgr =& $this->backend->getManager($split[0]);
> $attr_list = $mgr->getAttrList($split[1]);
> if (is_array($attr_list)) {
> foreach ($attr_list as $key => $val) {
> $options[$key] = $val['name'];
> }
> }
> 
> ...  
> }  
> この最後の処理ですが、  
> $options[$key] = $val['name'];  
> ではなく  
> $options[$key] = $val;  
> ではないでしょうか？  
>   
> サイト内  
> Ethna > ドキュメント > 開発マニュアル > ビュー定義 > フォームへルパ  
> ページにも特にnameをつけるという記載がないので、前段の文脈から$,1r}(Bkeyが選択肢の実際の値、valueが表示される値$,1r}と私は理解したのですが仕様的にはどうなのでしょうか？(B  
>   
> なにぶん日が浅いもので右も左もわからずに質問いたしますが、識者の方々、どうぞよろしくお願いします。
- app managerに書く$xxx\_list に、 array('実際の値' => array('name' => '表示名', 'long\_name' => '長い説明'), ... ) のように書く、というルールになってます。ってどこにも説明書いてないですね...。Ethna\_AppManagerのgetAttrName()とかがそのへんのヒントになってました。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-05 (金) 00:41:22

### getAttrList()
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2006-12-04 (月) 19:46:43)  
>   
> フォームヘルパにてDBから都道府県を自動取得して<select>にしようとしてますが、  
> 'option' => 'Prefs,pref\_name'  
> ではダメなんでしょうか。getAttrList()を見てみましたが、  
> この場合あらかじめ $pref\_name\_list なる変数を定義しておかないと  
> いけないようですが$,1s&自動では取得してくれないんですか？(B
- 追記。テーブル prefs には、pid と pref\_name というフィールドがあります。PrefsManagerは<select name="pid"><option value="01">北海道</option>...</select>というフォームが返してくれることを期待してます。ついでですが、AppObjectとAppManagerの使い分けの仕方が今ひとつ解らないんですよね$,1s&。(B -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-12-07 (木) 10:40:45
- PrefsManagerは、じゃないですね。フォームヘルパは、です。なんか荒らしてしまってすみません。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-12-07 (木) 10:42:54
- 完全スルーなんでしょうか$,1s&淋しいs&。上のやまざきさんの質問からすると、コンストラクタを書き換えて、自分で(BDBから取得するコードを書くしかなさそうですね。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-12-13 (水) 11:56:52
- うーんと、これは対応しようと思ってるけどまだやってない、という状況だったような気がします。遅くなってしまってすいません...。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-05 (金) 00:43:15

### custom
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2006-12-03 (日) 17:04:40)  
>   
> AcformForm->validate()で custom が実行されないです。  
> ソースを見ると、
> 
> if ($def['custom'] != null && is\_array($def['type'])) {  
> となってますけど、$def['type'] が配列じゃないとダメなんですか？
- つけやきば対応なので、ちと不安・・・でも、とりあえず添付は分割できたぁ。 -- やないっち [?](cmd=edit&page=%A4%E4%A4%CA%A4%A4%A4%C3%A4%C1&refer=ethna-community-forum-archiveto200703.html) 2006-12-03 (日) 17:27:19
- ごめんなさい、変な投稿してしまいました・・・無視してください。 -- やないっち [?](cmd=edit&page=%A4%E4%A4%CA%A4%A4%A4%C3%A4%C1&refer=ethna-community-forum-archiveto200703.html) 2006-12-03 (日) 17:28:24
- （無視して）すんません自分の勘違いでした。ActionFormにメソッドを追加したらあっさり動作しました。一生懸命ActionClassに定義してました。すみません。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-12-03 (日) 17:49:21

### Ethna\_MailSender拡張
> やないっち [?](cmd=edit&page=%A4%E4%A4%CA%A4%A4%A4%C3%A4%C1&refer=ethna-community-forum-archiveto200703.html) (2006-12-03 (日) 16:43:49)  
>   
> お世話になってます。  
> Ethna\_MailSenderに関して、添付を複数できなかったので、少し手を付け加えさせてもらいました。  
> 以下の通りです。  
> もし、変なところがあったら教えてください。
* * *

Ethna\_MailSender.php  
line:122行目〜

    // multipart対応
               if ($attach != null) {
                   $boundary = Ethna_Util::getRandom();

    $body = "This is a multi-part message in MIME format.\n\n" .
                       "--$boundary\n" .
                       "Content-Type: text/plain; charset=ISO-2022-JP\n\n" .
                       "$body\n";
               	foreach($attach as $attach_line){
                   $body .= "--$boundary\n" .
                       "Content-Type: " . $attach_line['content-type'] . "; name=\"" . $attach_line['name'] . "\"\n" .
                       "Content-Transfer-Encoding: base64\n" . 
                       "Content-Disposition: attachment; filename=\"" . $attach_line['name'] . "\"\n\n";
                   $body .= chunk_split(base64_encode($attach_line['content']));
               	}
                   $body .= "--$boundary--";
               }

- つけやきば対応なので、ちと不安・・・でも、とりあえず添付は分割できたぁ。 -- やないっち [?](cmd=edit&page=%A4%E4%A4%CA%A4%A4%A4%C3%A4%C1&refer=ethna-community-forum-archiveto200703.html) 2006-12-03 (日) 16:45:06
- 簡単ですが複数の添付に対応するようにしました。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-18 (木) 03:39:09

### フォームヘルパ
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2006-12-01 (金) 19:08:11)  
>   
> フォームヘルパなる文書を見つけましたよ（ふっふっふ）。  
> form\_typeがFORM\_TYPE\_TEXTの場合は簡単に出ましたが、  
> FORM\_TYPE\_RADIOやその他の場合はどうやって出すんでしょうか？
- 週末までまってくださいーm(\_\_)m -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-12-01 (金) 20:20:15
- 昨日はここがアクセス不能になって焦りましたが、自力でソースを追ってみました。$formに'option'を$v=>$label形式で定義するんですね。ただ、できあがるHTMLの<label>の使い方おかしいような気がします。<label for="">じゃないでしたっけ。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-12-03 (日) 14:13:55
- 遅くなっちゃいましたがドキュメント追加していちおう開発マニュアルからリンクを張っておきました。このへんの構成はすこしづつ修正していきます。あと、labelのほうはまったく気づいてませんでした、修正しました! -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-12-04 (月) 14:15:40
- ありがとうございました。テンプレートをいじらずともActionClassだけで設定できそうなのがいいです。でも使い分けのポリシーをしっかりしないと混乱しそう$,1s&。(B -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-12-04 (月) 15:49:43

### 質問
> toku [?](cmd=edit&page=toku&refer=ethna-community-forum-archiveto200703.html) (2006-12-01 (金) 00:58:00)  
>   
> はじめまして。  
> 最近Ethnaをいじりはじめました。  
> そこで2点ほど質問とご報告をさせていただきます。  
>   
> まず一点、コマンドでプロジェクトを作成したときに[project\_id]\_Controllerに$managerプロパティが抜けています。  
> skelファイルにも当然抜けているんですが、preview3では存在します。  
>   
> もう一点。  
> Ethna\_AppObjectで  
> 　- $key = in\_array('key', $field\_def['flags']);  
> 　+ $key = in\_array('unique\_key', $field\_def['flags']);  
> としないとスキーマの自動取得でうまくとれませんでした。  
> Ethna\_DB\_PEARのgetMetaData()メソッドの返り値がkeyでなくunique\_keyになってました。  
> フレームワーク自体はじめてなんですが、動きを追いきれない部分がありましたので質問させていただきました。  
> DBはMySQL5.0.27です。
- ご報告ありがとうございます! $managerはpreview2からpreview3の変更で廃止されたので、skelについても2.3.0のリリースで追従した形です。$backend->getManager()を使うようにしてください(infomanagerのほうの話ならば、まだ追従できていません)。unique\_keyについては完全にバグでした。今月中に2.3.1は出すつもりですので、申し訳ありませんがそれまでお待ちください。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-12-01 (金) 05:46:19
- 早速の回答ありがとうございます。managerプロパティは廃止だったんですね。自分は逆に2.3系から追加されたものだとばかり思っていました・・・。セットしてgetManagerで取得、というように勘違いしてました。修正版おまちしています。 -- toku [?](cmd=edit&page=toku&refer=ethna-community-forum-archiveto200703.html) 2006-12-01 (金) 09:58:20

### 認証のスマートな方法
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2006-11-30 (木) 09:48:54)  
>   
> 昨日、はじめてActionClassの中にauthenticate()というメソッドを見つけました（笑）。  
> これで認証を行おうと思うのですが、ひとつ問題があります。  
> エントリポイントが表と裏（管理）があり、裏でのみ認証を行いたいんです。  
> 裏のアクション名はすべて admin\_\* なので、その場合のみ認証を行いたいんですが、  
> どういった処理が考えられますか？
- アクション名から判別して処理するようにすればいいんじゃないでしょうか？ -- maical [?](cmd=edit&page=maical&refer=ethna-community-forum-archiveto200703.html) 2006-11-30 (木) 11:07:52
  - authenicateを実装しないクラスを作るとか。（裏用の基底クラス作成） -- maical [?](cmd=edit&page=maical&refer=ethna-community-forum-archiveto200703.html) 2006-11-30 (木) 11:09:45
- そうなんですけどね、どっかにそのアクション名やらクラス名やらを拾ってる関数があるかと思いまして探してるんですが$,1s&。クラスを別に作るのは避けたいですね。(B -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-11-30 (木) 11:36:27
  - Controllerのメンバにいませんでしたっけ？ -- maical [?](cmd=edit&page=maical&refer=ethna-community-forum-archiveto200703.html) 2006-11-30 (木) 13:06:09
    - 実行中のアクション名なら [http://ethna.jp/doc/Ethna/Ethna\_Controller.html#getCurrentActionName](doc/Ethna/Ethna_Controller.html#getCurrentActionName) でとれますね。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-11-30 (木) 18:53:27
    - あーそのまんまですね$,1s&すみませんありがとうございました。(B -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-11-30 (木) 19:57:29

### af->get(),getArray()
> シワクマル [?](cmd=edit&page=%A5%B7%A5%EF%A5%AF%A5%DE%A5%EB&refer=ethna-community-forum-archiveto200703.html) (2006-11-27 (月) 18:21:06)  
>   
> 配列Formの値を取得する方法です。
> 
> <TEXTAREA name=gdDescription[] cols=30>A</TEXTAREA>
> 
> <TEXTAREA name=gdDescription[] cols=30>B</TEXTAREA>
> 
> <TEXTAREA name=gdDescription[] cols=30>C</TEXTAREA>  
>   
> でPOSTで取得するとき、$\_REQUEST["gdDescription"]は配列で値が取得します。  
> ethnaの場合、af->get()やgetArray()で上記の方法できないんでしょうか？。  
> $\_REQUEST["gdDescription"]か$\_POST["gdDescription"]を使用するしかないでしょうか？  
>   
> 宜しくお願いいたします。  
>   
>   
> 宜しくお願いいたします。
- $af->get()で取れないですか? -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-11-27 (月) 20:17:29
- 有難うございます。DHTMLで「TEXTAREA 」を使用してます、$af->get()で出来なかった。何も表示されなかったです。$\_REQUEST["gdDescription"]使用すると値が入ってます。 -- シワクマル [?](cmd=edit&page=%A5%B7%A5%EF%A5%AF%A5%DE%A5%EB&refer=ethna-community-forum-archiveto200703.html) 2006-11-27 (月) 20:35:19
- エラーメッセージがなにも出てないなら、"gdDescription"というフォームが正しく定義されていないのかもしれません。( [ethna-document-dev\_guide-form-type#dfb5b67e](ethna-document-dev_guide-form-type.html#dfb5b67e "ethna-document-dev\_guide-form-type (1006d)")とかを参考にしてください) -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.md) 2006-11-28 (火) 00:15:54
- これで解決出来ました。有難うございます。 -- シワクマル [?](cmd=edit&page=%A5%B7%A5%EF%A5%AF%A5%DE%A5%EB&refer=ethna-community-forum-archiveto200703.html) 2006-11-28 (火) 07:40:21

### デリミタ変えたい
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2006-11-23 (木) 10:43:59)  
>   
> テンプレートに直接CSSやJavaScriptを書きたいんですが、  
> 当然ながらエラーが出ます。デリミタをXOOPS仕様に変更したいんですが、  
> どうすればいいですか？
- ethnaのバージョンによりますが、2.1.2だったらアプリのコントローラの\_setDefaultTemplateEngine()の中でsmartyオブジェクトの初期設定ができます。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-11-23 (木) 12:23:07
- あ、ありました。ありがとうございます。あとあまり関係ないですが、\_setDefault....を検索して「Ethna\_Rendererの使い方」というページを見つけましたが、「開発マニュアル」からリンクが貼られてないようです。ワザとでしょうか？ -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-11-23 (木) 15:30:27
- まだ書いてる途中なかんじです。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-11-23 (木) 20:59:52
- そうですか。すみませんが、2.3の場合だとどうなりますか？　もう正式版リリース間近のようですので、こっちで開発しようと思います。まだ本格的に進める前で良かった$,1s&。(B -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-11-24 (金) 14:37:20
- [http://ethna.jp/ethna-document-dev\_guide-renderer.html](ethna-document-dev_guide-renderer.html) を書き直したので参照してください。(ドキュメント不備ですいません) -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.md) 2006-11-24 (金) 16:29:57
- 具体例までありがとうございました。ドキュメントがこれからなのもあって、古い方でやろうかなーと思ってましたが、でもすぐ新しいのが出るのにそれも悔しいなと思い直して挑戦することにしました（笑）。ほぼリアルタイムで追従しますのでよろしくお願いします。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-11-24 (金) 18:05:04

### Ethna\_Backend.php で発生するNoticeメッセージ
> ff [?](cmd=edit&page=ff&refer=ethna-community-forum-archiveto200703.html) (2006-11-15 (水) 16:56:40)  
>   
> MacOSX 10.4.8 の php 4.4.1 で Ethna-2.1.2 を使用してWebアプリを作成していますが、  
> この時、Ethna\_Backend.php で以下のような通知がでます。
> 
> Notice: Only variable references should be returned by reference 
> in /..../Ethna/class/Ethna_Backend.php on line 377
> Notice: Only variable references should be returned by reference 
> in /..../Ethna/class/Ethna_Backend.php on line 377
> Warning: session_start(): Cannot send session cache limiter - headers already sent
> (output started at /..../Ethna/class/Ethna_Logger.php:89)
> in /..../Ethna/class/Ethna_Session.php on line 86
> 
> これは、以下のような修正を加えたところ、出なくなりました。  
> 一応、このような対処でいいんでしょうかというか、報告です(^\_^;)。  
> PHP5ならでないのかな?
> 
> % diff -u Ethna_Backend.php.orig Ethna_Backend.php | expand -t 4
> --- Ethna_Backend.php.orig 2006-11-15 16:20:45.000000000 +0900
> +++ Ethna_Backend.php 2006-11-15 16:32:43.000000000 +0900
> @@ -363,6 +363,7 @@
> */
> function &getDB($db_key = "")
> {
> + $null = null;
> $db_varname =& $this->_getDBVarname($db_key);
> if (Ethna::isError($db_varname)) {
> return $db_varname;
> @@ -374,7 +375,7 @@
> $dsn = $this->controller->getDSN($db_key);
> if ($dsn == "") {
> // DB接続不要
> - return null;
> + return $null;
> }
> $dsn_persistent = $this->controller->getDSN_persistent($db_key);
- これでだいじょうぶです(CVSでは修正済みです)。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-11-16 (木) 18:18:48
- ありがとうございます。CVSでは、修正されているのを確認しました。次の正式版に期待してます。 -- ff [?](cmd=edit&page=ff&refer=ethna-community-forum-archiveto200703.html) 2006-11-18 (土) 00:57:52

### DBのCRUD機能
> シワクマル [?](cmd=edit&page=%A5%B7%A5%EF%A5%AF%A5%DE%A5%EB&refer=ethna-community-forum-archiveto200703.html) (2006-11-13 (月) 11:07:24)  
>   
> 有難うございます。  
>   
> DBのCRUD機能を書くクラス名はどちらになりますでしょうか？。  
> Action ClassでDBのINSERT、DELETE、UPDATE Programを書いて、SELECT部分を  
> View Classで書いてSetApp()を使用するのは正しいでしょうか？、もしくは  
> View ClassでSELECTも書くのは何か可笑しいでしょうか？  
>   
> 宜しくお願いいたします。
- Ethna流のアプリの作り方として正しいか、という意味では、(かなり場面によりますが)action classとview classの使いわけとして、そのようなやりかたはおかしくないと思います。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-11-16 (木) 18:26:54

### Action Class
> シワクマル [?](cmd=edit&page=%A5%B7%A5%EF%A5%AF%A5%DE%A5%EB&refer=ethna-community-forum-archiveto200703.html) (2006-11-10 (金) 19:57:21)  
>   
> 以下のようにPerform() methodのActionとParameterを渡すことは可能でしょうか。return 'description\_add=true?productId='.$productId;  
>   
> 試して見ましたが、エラー発生します。  
>   
> 例：  
>   
> function perform()
> 
> {
> /**
> * form value acquisition
> */
> $productId =$this->af->get("descriptionTypeId");
> $descType =$this->af->get("description");
> $description	=$this->af->get("productId");
>     		
> /**
> * product Object
> */
>     		
> echo $description;
>     		
> return 'description_add=true?productId='.$productId;
> }
> 
> 宜しくお願いいたします。
- returnのところに書くのは遷移先のview名(多くの場合smartyの\*\*\*.tplの部分)の意味なので、このような書き方はできないです。別のアクションを実行したい、ということでしょうか? header('Location: /index.php?productId='.$productId); とかのイメージでしょうか。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-11-12 (日) 23:43:01
- 有難うございます -- 2006-11-14 (火) 13:09:33

### Ethna\_MailSender メールを送信する最短のサンプル について
> ff [?](cmd=edit&page=ff&refer=ethna-community-forum-archiveto200703.html) (2006-11-09 (木) 13:21:36)  
>   
> Ethna-2.1.2 の Ethna\_MailSender ですが、  
> [http://ethna.jp/ethna-document-dev\_guide-app-mail.html](ethna-document-dev_guide-app-mail.md) にある  
> メールを送信する最短のサンプルがうまくうごきません。
> 
> ethna_mail =& new Ethna_MailSender($this->backend);
> $ethna_mail->send('send_to_mail@example.com',
> 'welcome.tpl',
> array('username'=> $resign_user));
> 
> これ、継承されてないEthna\_MailSender のインスタンスを作って、  
> send()メソッドに 'welcome.tpl' って渡すと、var $def[] が空なので、  
> エラーになります。  
> Ethna\_MailSenderクラスは継承して使えってことでしょうか(たぶん、  
> そうだと思う)?  
> この$def[]って、つまり、フレームワーク内でのローカルなメールテンプレート名を  
> 実際の物理的なテンプレートファイルにマッピングする為のものと考えてよろしいでしょうか?
- ごめんなさい。自前のMailSenderでのサンプルを書いてしまいました。そうでした。$defを定義しないと動かないんでした。CVSだと105行目ですよね。で、 $defは、ffさんのおっしゃる通りマッピングの為に用意されているものだと思われます。forwardとかのマッピングがなしでもできるんだから、こっちもなしでできるようにすれば楽なのに。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-11-09 (木) 15:04:56
- 了解しました。直値をコードの中にばらまかないのがいいのと同様、抽象的なテンプレート名と、物理的なファイル名と分けたほうがいいと思います。というわけで、Ethna\_MailSender は継承させて使うことにします。個人的には、継承を使いすぎると、規模がでかくなってくるとだんだん見通しが悪くなってくるという気がしてます。継承ではなく、論理テンプレート名と物理ファイル名のマッピングを外部から与えられるようにした方が使いまわしのしやすいクラスになるかも。 -- ff [?](cmd=edit&page=ff&refer=ethna-community-forum-archiveto200703.html) 2006-11-09 (木) 19:36:35
- $,1vq対応しました。(B -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2007-01-18 (木) 03:42:12

### フォーム値をReset
> シワクマル [?](cmd=edit&page=%A5%B7%A5%EF%A5%AF%A5%DE%A5%EB&refer=ethna-community-forum-archiveto200703.html) (2006-11-09 (木) 11:02:21)  
>   
> 登録済みで「登録完了しました」メッセージを表示した後、フォーム値をResetしたいんですが、現在以下のように「$this->af->form\_vars=array();」を使用してます。これが正しいやり方でしょうか？  
> if(Ethna::isError($res)){
> 
> $this->ae->add(null, "内部エラーです", E_SAMPLE_INTERNAL);
> }else{
> $this->ae->add(null, "製品情報を登録しました", E_SAMPLE_INTERNAL);
> $this->af->form_vars=array();
> }
> 
> 宜しくお願いいたします
- CVSでは$this->af->clearFormVars()というのが用意されました(array()を代入しているだけですが)。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-11-10 (金) 09:51:48

### 誤字。
> m [?](cmd=edit&page=m&refer=ethna-community-forum-archiveto200703.html) (2006-11-08 (水) 17:52:58)  
>   
> 全然重要ではありませんが、Ethna\_Error.php 69 行目のところが
> 
> $message = 'unkown error';
> 
> となっています。  
> 綴りは unknown ですね。
- すみませんでした！CVS版のほうに修正かけたので次回のリリース時にはなおってます。報告ありがとうございます。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-11-09 (木) 10:07:21

### Ethna\_MailSender の$smarty->display() について
> ff [?](cmd=edit&page=ff&refer=ethna-community-forum-archiveto200703.html) (2006-11-08 (水) 17:31:59)  
>   
> Ethna-2.1.2 の Ethna\_MailSender::send()の
> 
> 106 ob_start();
> 107 $smarty->display(sprintf('%s/%s', $this->mail_dir, $template));
> 108 $mail = ob_get_contents();
> 109 ob_end_clean();
> 
> の部分ですが、これは、
> 
> $smarty->fetch(sprintf('%s/%s', $this->mail_dir, $template));
> 
> でよさそうに思いますが、何か理由があるのでしょうか?
- fetchで問題ないです。たぶんfetchをしらないときにかいたのだと。直したとおもったらCVS版にも残ってますね、、 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-11-08 (水) 17:46:52

### Ethnaのバージョンアップについて
> confu [?](cmd=edit&page=confu&refer=ethna-community-forum-archiveto200703.html) (2006-11-03 (金) 19:43:08)  
>   
> こんにちは。  
> Ethnaを導入してから開発効率が上がり、大変助かっております。  
>   
> preview2まで公開されている2.3.0ですが、正式リリースの予定はあるのでしょうか？  
> 現在、2.1.2を使用していますが仕様変更や機能追加、バグ修正などもあるので、できれば  
> 2.3.0へ移行したいと思っています。ただ、preview2とCVS版の間にも様々な変更が加わって  
> いるようですので、これからpreview2を使用するのも躊躇しています。  
>   
> メジャーバージョンアップへの作業がなされないままCVS版に新しい機能ばかりが追加されて  
> いるので、バージョンアップ作業自体を阻害する要因にもなっているようにも思えます。  
> 利用者としての視点では、既にコードの古い(?)preview2と頻繁に追加/修正の行われるCVS版の  
> どちらを使っていけばいいのか大変悩みどころなのですが、できればこのあたりで一度、現時点での  
> バージョンを(どのような形式でも結構ですので)リリースしていただけませんでしょうか？  
>   
> 皆様本業の傍ら開発に携わっているのでお忙しいこととは思いますが、ご検討いただけましたら  
> と思います。
- たしかにその通りだと思います。2.1.2と今の最新のCVS版ではあまりにも差ができてしまっています。ちょっと自分なりに考えてみます。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-11-05 (日) 16:54:56
- [http://ethna.jp/index.php?ethna-tmp-release2.3](ethna-tmp-release2.3.html) のページを作りました。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-11-10 (金) 10:34:15

### setApp('name',arrayOfObject)
> シワクマル [?](cmd=edit&page=%A5%B7%A5%EF%A5%AF%A5%DE%A5%EB&refer=ethna-community-forum-archiveto200703.html) (2006-10-24 (火) 15:57:25)  
>   
> $this->af->setApp('name',$arrayOfObject);  
>   
> $arrayOfObjectをParameterとして使用するとエラーになりますが、実際にObjectをArrayに変換しないといけないのでしょうか  
> ？  
> よろしく
- エスケープ処理が入るからじゃないでしょうか。$af->setAppNE()でやってみては。 -- Konet [?](cmd=edit&page=Konet&refer=ethna-community-forum-archiveto200703.html) 2006-10-24 (火) 19:13:51
- ありがとうございます。実際に$this->af->setAppNE('list',$arrayOfProductObj);でＯｂｊｅｃｔからＭｅｔｈｏｄを呼ぶときＭｅｔｈｏｄが見つかれませんとＭｅｓｓａｇｅが表示されます。実はSmartyの場合、Ｏｂｊｅｃｔを登録するのは可能です、「$smarty->register\_object」。えすなの場合、これが出来ますか？宜しくお願いいたします -- シワクマル [?](cmd=edit&page=%A5%B7%A5%EF%A5%AF%A5%DE%A5%EB&refer=ethna-community-forum-archiveto200703.html) 2006-10-25 (水) 17:37:33
- setAppNE()はregister\_objectをやってるわけではないんですが、テンプレートで {$app\_ne.list->func("arg")} みたいにやるとうまくいきませんか? -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-10-26 (木) 01:54:12
- マニュアルには、基本はメソッドのみ。関数にアクセスしたいならセキュリティをオフにせよ、って書いてありますよ。セキュリティってなんぞや？笑 -- Konet [?](cmd=edit&page=Konet&refer=ethna-community-forum-archiveto200703.html) 2006-11-06 (月) 23:34:46
- なんか関係ないみたいです。デフォ -- Konet [?](cmd=edit&page=Konet&refer=ethna-community-forum-archiveto200703.html) 2006-11-06 (月) 23:41:07
- $smarty->securityみたい(笑)なんか関係ないみたいです。デフォでオフらしいです。すみません；； -- Konet [?](cmd=edit&page=Konet&refer=ethna-community-forum-archiveto200703.html) 2006-11-06 (月) 23:41:48
- register objもあるといいのかもしれませんね。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-11-10 (金) 10:35:34

### エスケープ処理について
> sohta [?](cmd=edit&page=sohta&refer=ethna-community-forum-archiveto200703.html) (2006-10-20 (金) 01:32:53)  
>   
> たびたびお世話になっています。  
> ActionFormなどについてエスケープ処理されるタイミングについて教えてください。データベースに格納したりするときにエスケープするタイミングについて混乱してしまったので。  
>   
> GET/POST$,1vrフォーム値定義に従って(Bafにセットする・・・HTMLエスケープ処理されてセットされる  
> $this->af->set('xxx', 'content')・・・HTMLエスケープ処理されてセットされる  
> $this->af->setApp('xxx', 'content')・・・HTMLエスケープ処理されてセットされる  
> $this->af->setAppNE('xxx', 'content')・・・HTMLエスケープ処理されずにセットされる  
> $this->af->get('xxx')・・・そのまま出てくる(ここで処理されるわけではない)  
> $this->af->getApp('xxx')・・・そのまま出てくる  
> afにセットされた値$,1vr(B{$form.xxx},{$app.xxx}・・・そのまま出てくる  
>   
> これで正しいでしょうか？  
> また、関連するドキュメントなどありますでしょうか。
- コードも見ないで記憶を頼りに回答しますが、エスケープされるのはsetAppだけだと思います。getArrayは引数を指定することでエスケープするかどうか選択できます。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-10-21 (土) 00:11:48
- おっと、そうでしたか。なんというか二重エスケープされたり、エスケープに失敗したりで苦闘しています。それでは、session->set()もエスケープされないのですね。 -- sohta [?](cmd=edit&page=sohta&refer=ethna-community-forum-archiveto200703.html) 2006-10-21 (土) 03:30:41
- どの値もsetしただけではエスケープされない。PHP中で、ActionFormのget/getApp/getAppNE/getAppNEArrayはエスケープされず、getArray/getAppArrayはエスケープされる。Sessionのgetもエスケープされない。Smarty中で、form/app/errors/sessionはエスケープ有り、app\_ne/script/request\_uriはエスケープ無し。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-10-23 (月) 10:29:55
- どのバージョンからなのかは把握していませんが、最新のCVSの場合、scriptやrequest\_uriはエスケープ有りになっています。ViewClassの870行目あたりです。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-11-07 (火) 02:06:22

### サーバメンテナンスします
> ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) (2006-10-19 (木) 12:58:43)  
>   
> すいません、急なお知らせになってしまいますが本日夕方から数時間、サーバメンテナンスのためちょっとこのサイトとまっちゃいます。ご容赦ください。  
>   
> ＃あと簡単なフィルタいれてみました
### INSERT後の一意制約違反を検知したい
> Clumsy [?](cmd=edit&page=Clumsy&refer=ethna-community-forum-archiveto200703.html) (2006-10-19 (木) 11:34:54)  
>   
> PHP4.1.3+Ethna2.1.2+PostgreSQL7環境で開発をしています。  
>   
> $db =& $this->backend->getDB() でDBを取得後、query()メソッドでINSERT文を流します。  
> 一意制約違反が発生した場合にEthna::isError($r)やDB::isError($r)でエラーが発生したか検知出来ないのですが、皆さんどうされてますか？  
> 一意制約違反が発生した場合にはユーザに再入力を促したいのですが$,1s&s&。(B
### sessionやsetAppを一括で指定
> sohta [?](cmd=edit&page=sohta&refer=ethna-community-forum-archiveto200703.html) (2006-10-15 (日) 00:06:29)  
>   
> 皆様こんばんは  
> Ethnaで楽しく悪戦苦闘を続けているsohtaです。  
>   
> フォームから得た複数の値を一括でセッションに格納したり、セッションから得た複数の値を一括でアクションフォームに楽して格納したいなぁと考えています。  
>   
> $this->session->set('xxx', $this->af->get('xxx'));  
> とか  
> $this->af->setApp('yyy', $this->session->get('yyy'));  
>   
> を何行にも渡って現在記述しているのですが、こういうとき皆さんはどうしていらっしゃるのでしょうか。  
> $this->session->arrayset( array('xxx', 'xyz', 'orz') , $this->af->arrayget( array('xxx', 'xyz', 'orz' ))  
> のような方法とか存在するのかな、と思って質問させてもらいました。
- $this->sesssion->set('form', $this->af->getArray(false));とか、$this->af->setAppArray(...)とか。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-10-15 (日) 00:25:13
- ありがとうございます。なるほど、こんなメソッドがあったのですね。 -- sohta [?](cmd=edit&page=sohta&refer=ethna-community-forum-archiveto200703.html) 2006-10-15 (日) 01:30:25

### フォームの入力値チェック
> Clumsy [?](cmd=edit&page=Clumsy&refer=ethna-community-forum-archiveto200703.html) (2006-10-13 (金) 20:46:52)  
>   
> PHP4.1.3とEthna2.1.2を使用しています。  
>   
> Actionクラスのprepare()で入力チェックをしているのですが、どうも上手く動きません。  
>   
> あるテキストボックスを下記の通り定義しました。  
>   
> 'type' => 'VAR\_TYPE\_DATETIME',  
>   
> 日付以外は入力エラーとさせようと思っています。  
> ところが、例えば「あ」と入力した場合にそのまま素通りしてしまいます。  
>   
> ちょっと調べてみると、Ethna\_ActionForm.php の \_validateメソッドでチェックを行なっているようなので、VAR\_TYPE\_DATETIMEを引っ掛けてるelse if の後で適当な文字列をechoさせてみましたが、出力されませんでした。  
>   
> そこで、このメソッドで$typeを取った直後に下記1行を追加してみました。  
>   
> if($type == 'VAR\_TYPE\_DATETIME'){echo "1";}  
>   
> 1が出力されました。  
>   
> そこで質問なのですが（前置きが長くて済みません）、チェックが上手く動かないのは、  
>   
> 1. 私の環境に何か問題がある  
> 2. \_validateメソッドのif文条件を全て''で囲う必要がある  
>   
> のどちらなのでしょうか？
- 現象からすると、VAR\_TYPE\_DATETIMEが定義されていないってことになるんですが、おかしいですね。むぅ -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-10-13 (金) 20:54:28
- ちなみに、\_varidateの$typeをechoさせたところ、ちゃんとVAR\_TYPE\_DATETIMEが出ます。minに'2000/01/01'、maxに'2005/01/01'を設定してみたところ「全角1000文字以上(半角2000文字以上)入力して下さい」と言われました。んん？ -- Clumsy [?](cmd=edit&page=Clumsy&refer=ethna-community-forum-archiveto200703.html) 2006-10-13 (金) 21:07:12
- っや、VAR\_TYPE\_DATETIMEがでるのはおかしいので（文字列じゃなく数値が出るべき）定義されてないと、PHP4だと文字列になるので、おかしいのです。ちょっと確認してみます・・。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-10-13 (金) 22:56:55
- VAR\_TYPE\_DATETIME は定数なので、'type' => 'VAR\_TYPE\_DATETIME', ではなく 'type' => VAR\_TYPE\_DATETIME, （クォーティングなし）としないと動きませんよ。 -- shigeta [?](cmd=edit&page=shigeta&refer=ethna-community-forum-archiveto200703.html) 2006-10-13 (金) 23:15:13
- お恥ずかしい。月曜に職場で試してみます ＞ shigetaさま -- Clumsy [?](cmd=edit&page=Clumsy&refer=ethna-community-forum-archiveto200703.html) 2006-10-13 (金) 23:39:21
- 報告遅くなりました。勿論VAR\_TYPE\_DATETIMEでいけましたm(\_\_)m -- Clumsy [?](cmd=edit&page=Clumsy&refer=ethna-community-forum-archiveto200703.html) 2006-10-19 (木) 11:29:28

### テンプレートの切り替えとCSV
> いつき [?](cmd=edit&page=%A4%A4%A4%C4%A4%AD&refer=ethna-community-forum-archiveto200703.html) (2006-10-13 (金) 14:02:38)  
>   
> はじめまして、Ethnaを利用させていただいております。  
> Ethnaを使ってアプリケーションを作成していたのですが、疑問？があったので質問させていただきたいと思います。  
>   
> 一つ目は、たとえばWEBアプリケーションを作成している時に、管理画面用テンプレートと顧客用画面テンプレートのように数種類のテンプレートを使い分けしたい時、skelの中にあるskel.template.tplを手で切り替えてから  
> ethna add-template hoge fuga  
> などとやっているのですが、これを  
> ethna add-template hoge fuga skel.template名  
> みたいにethnaコマンド上で切り替えたりできないのでしょうか？  
>   
> ２つ目の質問ですが、例えばユーザーがCSVでデータをダウンロードするような場合、Ethna\_ActionClassで  
> header('Content-Type: application/octed-stream')なんかを書いて、echoでデータを書き出してexitで抜けたりしてるのですが、もちょっとスマートな方法ってないのでしょうか？
- 1つめだけですが、現状できないので対応したいと思います。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-10-13 (金) 18:32:47
- 2つ目ですが。Viewのforward()を継承するのが美しいと思います。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-10-13 (金) 18:46:27
- ご返答ありがとうございます。さっそく試してみたいと思います。 -- いつき [?](cmd=edit&page=%A4%A4%A4%C4%A4%AD&refer=ethna-community-forum-archiveto200703.html) 2006-10-14 (土) 15:14:29

### ドキュメント破損？
> Clumsy [?](cmd=edit&page=Clumsy&refer=ethna-community-forum-archiveto200703.html) (2006-10-12 (木) 21:31:33)  
>   
> Ethna > ドキュメント > 開発マニュアル > エラー処理 > エラーレベルに応じて共通の画面を表示させる  
>   
> のページですが、  
>   
> 例として，エラーレベルが'Error'の場合に「ただ今混雑しています」と表示させるには，app/{アプリケーションID}\_Controller.phpに下記を追加します。  
>   
> と書かれているのに続きがありません。  
> 是非続きを読みたいのですが$,1s&s&。(B
- 自分もちょうど同じ気持ちです。 -- ひであ [?](cmd=edit&page=%A4%D2%A4%C7%A4%A2&refer=ethna-community-forum-archiveto200703.html) 2007-04-01 (日) 21:23:40

### ライセンスについて
> yone [?](cmd=edit&page=yone&refer=ethna-community-forum-archiveto200703.html) (2006-10-11 (水) 17:39:26)  
>   
> ライセンスについて2点質問があります。  
>   
> 1.ライセンスのページでは「BSDライセンス」とありましたが、  
> 「修正済みBSDライセンス」でしょうか？  
>   
> 2.著作権の表示をしなければならないとのことですが、  
> どこに表示すればよいでしょうか？(作成したサイトの各ページ等)
- そこらへん、あんまり詳しくない＆作者の意向によるんで明言できないですが、修正済みかつ、著作権表示は、すでにEthna自体のソースに書いてあるのでいらないと思います。HTMLに出力する必要はないと思います。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-10-12 (木) 04:33:13
- [http://ethna.jp/ethna-document-faq-license.html](ethna-document-faq-license.md)にはしっかりと宣伝条項があるため修正前のBSDライセンスですね．> Neither the name of the author nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.

- BSDライセンスの宣伝条項問題はGNUの [BSD ライセンスが抱える問題](http://www.gnu.org/philosophy/bsd.ja.html)が詳しいです． -- Anonymous Coward 2007-06-07 (木) 22:34:02

### telnet出来ないサーバに
> fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) (2006-10-02 (月) 18:19:08)  
>   
> レンタルサーバの仕様によりtelnetできないんですが、  
> インストールおよび使用はムリですか？
- できます。tgzを展開してでてきたEthnaフォルダをレンタルサーバにアップロードするだけです。ethnaコマンドについてはWeb用のインターフェイスがないのでなんとかする必要がありますが、、 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-10-03 (火) 13:50:55
- シェルにコマンド引数を渡すようなスクリプトを書かなくてはならないですね。Web用のインターフェイスを用意する予定はないんでしょうか。 -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-10-03 (火) 19:01:56
- 予定はないですが、あると便利そうですね。私はレンタルサーバ上で動作するのは重要だと考えているので(さほど実装も面倒ではないでしょうから)時間があればがんばってみるかもしれません。(曖昧な返事しかできませんが) -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-10-03 (火) 20:17:01
- まぁ使用するのはプログラマなんですから、それぐらい自分で何とかしろという話ではあるんですが$,1s&期待してます(B(^^ -- fm [?](cmd=edit&page=fm&refer=ethna-community-forum-archiveto200703.html) 2006-10-04 (水) 09:29:56
- 開発用のサーバを用意して(VMWareでもいいかも)開発中はそこでethnaコマンドを走らせ、最後にレンタルサーバには完成品をアップ、というのはどうでしょう。レンタルサーバでethnaが実行できたとしても、結局は開発機で開発＆テストしてから本番サーバにアップ、という形になるでしょうし・・。 -- gogo [?](cmd=edit&page=gogo&refer=ethna-community-forum-archiveto200703.html) 2006-10-05 (木) 10:01:37

### フォーム値の取得について
> 竹本 [?](cmd=edit&page=%C3%DD%CB%DC&refer=ethna-community-forum-archiveto200703.html) (2006-09-30 (土) 14:27:17)  
>   
> ドキュメントの「フォーム値にアクセスする」によると  
> 1. ブラウザからGETあるいはPOSTにより渡された値がPHPによって$\_REQUEST変数に格納されます\*1  
> 2. アクションフォームオブジェクトは、フォーム値として定義されている値のみ$\_REQUESTから取得して、オブジェクト内のコンテナ\*2に格納します  
> $,1s&とあり、またその注釈に(B  
> Ethnaでは基本的にクライアントから送信されるフォーム値をGET/POST(REQUEST\_METHOD)で区別しません。  
> $,1s&とありますが、(BEthna\_ActionformのsetFormVars()ではREQUEST\_METHODを判別して$\_GETまたは$\_POSTから値を格納しているように見られます。  
>   
> これはドキュメントとコードのどちらが正しい動作(?)なのでしょうか。  
> 個人的には、セキュリティを考慮すると現在のコードの動作が望ましい(REQUEST\_METHODを判別してフォーム値を取得すべき)と思ってはいます。
- ドキュメントがちょっとわかりにくいようなので直してみました。「区別しません」というのは、ActionFormに格納されたあとのフォーム値がどのREQUEST\_METHODで渡されたものかを区別しない、ということだと思います。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-10-01 (日) 00:17:54
- 遅くなりまして、すみません。納得いきました。ドキュメントも変更していただいて、ありがとうございます。 -- 竹本 [?](cmd=edit&page=%C3%DD%CB%DC&refer=ethna-community-forum-archiveto200703.html) 2006-10-03 (火) 21:59:40

### Ethna\_Plugin\_Logwriter\_Echo.php
> castor [?](cmd=edit&page=castor&refer=ethna-community-forum-archiveto200703.html) (2006-09-27 (水) 22:27:38)  
>   
> はじめまして。  
> 2.3.0-dev(CVS版)ですが、Ethna\_Plugin\_Logwriter\_Echo.phpの61行目は  
> printf()ではなくsprintf()ではないでしょうか。  
> ご確認いただければ幸いです。
- Logwriter\_Echoはログを出力するのでprintfで良いと思います。Logwriter\_Fileと比較した感じでは問題ないようにみえます。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-09-28 (木) 18:41:25
- すみません、私の勘違いでしたようで失礼いたしました。log\_facilityがechoの場合、このタイミングで出力されてしまうと他の場面でheader()を呼び出す以前に出力が開始されてしまうのですが、何か解決策はないものでしょうか。output\_bufferingを有効にする以外に、ログ出力のタイミングを変えられれば良いのですが$,1s&。(B -- castor [?](cmd=edit&page=castor&refer=ethna-community-forum-archiveto200703.html) 2006-09-28 (木) 21:15:51
- 現状はechoじゃなくてfileをつかうしかなさそうです。header()を使うときのいいやりかたはあまりはっきりしてないような気がしています。 -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-10-01 (日) 01:54:32

### EthnaのDBはPEARを継承しているのでしょうか？
> sohta [?](cmd=edit&page=sohta&refer=ethna-community-forum-archiveto200703.html) (2006-09-26 (火) 23:56:50)  
>   
> はじめまして PHP5.1でEthna2.1.2を利用中です。PHP自身が初級者ということもあって、Ethnaと楽しく悪戦苦闘しています。  
>   
> [http://ethna.jp/ethna-document-dev\_guide-db.html](ethna-document-dev_guide-db.md) には、『EthnaのDBはPEAR::DBを継承しているので・・・』と書いてあるのですが、これは『PEAR::DBに処理を委譲しているので・・・』の誤りでは無いでしょうか。  
> PEAR\_DBのいろいろ便利なメソッドが使えないなーと思ってソースを見たら、継承ではなく委譲のようだったので。  
> 正しいかどうか自信が無く、とりあえずフォーラムで質問してみます。
- その通りです。現在のバージョンのethnaは継承しているわけではありません。Ethna\_DB\_PEARからPEAR::DBのメソッドを呼び出すには$ethna\_db\_pear->db->autoExecute();のような感じでEthna\_DB\_PEARが持っているPEAR\_DBのオブジェクトを呼ぶことで使うことができます。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-09-28 (木) 18:35:17
- ありがとうございます。そうか、$xxx->db->method(); と直接アクセスしてしまえばいいんですね。 -- sohta [?](cmd=edit&page=sohta&refer=ethna-community-forum-archiveto200703.html) 2006-09-28 (木) 23:06:49

### ログ出力のend()のコールタイミング
> ff [?](cmd=edit&page=ff&refer=ethna-community-forum-archiveto200703.html) (2006-09-22 (金) 18:25:35)  
>   
> はじめまして PHP4.4.1 で Ethna 2.1.2 を使用しはじめています。  
> ファイルへのログ出力をしようとしていますが、Ethna\_LogWriter\_File::begin()はコールされますが、Ethna\_LogWriter\_File::end()はコールされないようです。Ethnaのクラス全部をgrepしてみましたが、end()をコールしている部分を見つけることができませんでした。  
> この為、バッファにたまっている物が出力されず、捨てられてしまうということはないのでしょうか?
- んー。fcloseしてないだけなので、多分大丈夫だと思います。・・・が、fcloseしてないのはきもいよねっていうのもありますねたしかに。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-09-23 (土) 22:49:37
- まあ、PHPがおそらく終了処理をキッチリやってくれているだろうから?大丈夫だとは思うんですけど...、というところです;-)。あと、ログ出力の後、fflush()してなさそうなので、(PECLなモジュールに不具合があったりして)途中でWebサーバーがクラッシュしたりすると、最後付近のログが記録されていなくって、原因究明に手間取るというのも考えられなくもないです。出力毎にfflush()するというのも、パフォーマンスが悪くなるので、オプション(or 初期化の引数等)で変えられるといいかもしれません。考えすぎかな...。 -- ff [?](cmd=edit&page=ff&refer=ethna-community-forum-archiveto200703.html) 2006-09-25 (月) 00:34:37

### アクション名の決定方法のページ更新しました
> Dora-kou [?](cmd=edit&page=Dora-kou&refer=ethna-community-forum-archiveto200703.html) (2006-09-13 (水) 16:33:58)  
>   
> はじめましてです。本格的なMVC系のフレームワークは初挑戦です。  
> [http://ethna.jp/index.php?ethna-document-dev\_guide-action-formname](ethna-document-dev_guide-action-formname.md)  
> で規定動作としてのEthna\_Controller::\_getActionName\_Form()のリンク  
> が最後の方にあったのですが、その行数がずれていたようなので直しておきました。  
>   
> ソースファイルへの行リンクなんで、またリンクは変わってしまうと思いますが$,1s&。(B  
> どうぞよろしくお願いします。
- おおぉぉーありがとうございます。すげーたすかります -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-09-17 (日) 12:26:00

### スケルトン生成はaddオプションに統一？
> 佑 [?](cmd=edit&page=%CD%A4&refer=ethna-community-forum-archiveto200703.html) (2006-09-12 (火) 14:08:52)  
>   
> はじめまして。ここ数日使わせていただいています。  
>   
> まだチュートリアルの段階なのですが、  
> generate\_xxxx\_skelton.phpはadd-xxxxオプションに置き換わったと考えていいのでしょうか。  
> 開発マニュアルからとぶスケルトンの生成がgenerateのままでチュートリアル  
> との整合際がなさそうに見えたのでWikiですしadd-xxxxオプションに統一しました。  
>   
> 問題があるようならお手数ですが巻き戻しお願いします。
- ありがとうございます。私が書いた部分について修正を確認しました。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-09-15 (金) 13:14:36
- ちなみにCVS版だと1654行目ですね。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-09-15 (金) 13:24:48

### Ethna\_Controller の getTemplateEngine メソッド
> みず [?](cmd=edit&page=%A4%DF%A4%BA&refer=ethna-community-forum-archiveto200703.html) (2006-08-31 (木) 12:56:06)  
>   
> Ethna\_Controller の getTemplateEngine メソッドですが、  
> user defined outputfilters にある  
> if (!is\_array($postfilter)) { の部分ですが、  
> $postfilter ではなく $outputfilter ではないでしょうか？
- 本当ですね。コピペしたまま変更し忘れた感じでしょうか。テスト書いたらコミットします。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-09-15 (金) 13:22:23
- こちらの修正していただけると助かります。CVS版こまめに入れ替えてるのですが、毎回書き直してまして$,1s&(B -- 2006-11-10 (金) 19:46:34

### デモページでFatal errorが
> (2006-08-30 (水) 01:48:03)  
>   
> [http://ethna.jp/sample/?action\_signup=true](sample/?action_signup=true)  
> でちゃってますヨ
- 修正しました(すごいとりあえずですが)。ありがとうございました! -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-09-19 (火) 21:58:40
- はじめまして。サンプルページが無くなっているようですね。気がつきましたので念の為。 -- mr [?](cmd=edit&page=mr&refer=ethna-community-forum-archiveto200703.html) 2007-01-16 (火) 17:32:47
- あいかわらず、アクセスできないようですね。修正いただければ。 -- ひだか [?](cmd=edit&page=%A4%D2%A4%C0%A4%AB&refer=ethna-community-forum-archiveto200703.html) 2007-01-24 (水) 18:26:17

### Ethna 2.3.0 Preview2 正規表現によるバリデータプラグインのregexp
> NICOLE [?](cmd=edit&page=NICOLE&refer=ethna-community-forum-archiveto200703.html) (2006-08-24 (木) 16:10:36)  
>   
> こんにちは。  
>   
> Ethna 2.3.0 Preview2(PHP5.1.5-Windowsで)を使っています。  
> 正規表現によるバリデータプラグインのregexpがうまく動かなかったので  
> Ethna\_Plugin\_Validator\_Regexp.phpファイルを見たら"regexp"となるところを"regex"と"p"が抜けているタイプミスがあるようです。  
>   
> 誤）37行目: if (isset($params['regex']) == false  
> 正）37行目: if (isset($params['regexp']) == false  
>   
> 修正いただければと思います。  
> $,1s;勘違いならすいません。(B
- ありがとうございますー！CVS版ではなおっておりますので、近い将来リリースされるであろうpreview 3をお待ちくださいm(\_ \_)m -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-08-24 (木) 18:41:42
- どうもお手数かけます。Preview3を楽しみにまっています。 -- NICOLE [?](cmd=edit&page=NICOLE&refer=ethna-community-forum-archiveto200703.html) 2006-08-25 (金) 21:04:34

### Ethna用エディタ
> azm [?](cmd=edit&page=azm&refer=ethna-community-forum-archiveto200703.html) (2006-08-22 (火) 23:59:44)  
>   
> こんばんは、個人的な宣伝で恐縮なのですが、  
> 4,5ヶ月ほど前に某PHP勉強会で発表させていただいた  
> Ethna用のエディタを以下のURLで簡易的に公開してみました。  
>   
> 正直まだまだちらほらとバグが存在しますが、  
> もしも宜しければお使いいただければ嬉しいです  
> （$,1s;(BWindows専用です）  
>   
> [http://techno.s59.xrea.com/EE.zip](http://techno.s59.xrea.com/EE.zip)
- おぉ、ステキですー。さくさく使ってみてしまいました:) -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-08-23 (水) 09:55:41
- リリースお疲れ様です。時間見つけて試しますねー -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-08-23 (水) 20:07:48
- サポートページとフォーラムを作ってみました。 今後はこちらのほうをチェックお願いしますー [http://techno.s59.xrea.com/ethnaplorer/](http://techno.s59.xrea.com/ethnaplorer/) -- azm [?](cmd=edit&page=azm&refer=ethna-community-forum-archiveto200703.html) 2006-09-02 (土) 02:30:57

### smartyの呼び出し
> kokoroman [?](cmd=edit&page=kokoroman&refer=ethna-community-forum-archiveto200703.html) (2006-08-22 (火) 17:34:53)  
>   
> まだインストール途上ですが、気づいたことがあるので報告します。  
> OSはGentoo Linuxを利用しているのですが、パッケージでsmartyをインストールすると、  
> /usr/share/php/smarty ([s]martyのように先頭が小文字）  
> にインストールされます。include\_pathが通っているのを確認して  
> $ ethna add-project  
> とすると、smartyが呼べずにエラーが出ます。メッセージを見ると、どうも[S]marty/Smarty.class.phpと、ディレクトリ名が大文字で呼ぼうとしているためであるようです（ディレクトリ名を変更すれば解決）。  
> まあ、これで問題は無いのですが、どうもGentooのパッケージ側で、ある時期からディレクトリ名を小文字に変更したようなのでその原因を調べると、どうも大文字では何かトラブルがあるようです(以下引用を参照してください）。もしも何らかの問題が発生する可能性を含むのであれば、Ethna側でも対応していただければ良いかと思い投稿します。  
> 　よろしくお願いします。  
>   
> == 以下Bugzillaより引用 ==  
> [http://bugs.gentoo.org/show\_bug.cgi?id=121952](http://bugs.gentoo.org/show_bug.cgi?id=121952)  
> ==  
>   
> Currently, dev-php/smarty installs into /usr/lib/php/Smarty while  
> /usr/lib/php/smarty would suit a lot better. Reason for this is Smarty's own  
> path auto-detection.  
>   
> Suppose I /don't/ define SMARTY\_DIR and just "require\_once  
> 'Smarty/Smarty.class.php' (the default installation directory). This will fail,  
> because Smarty can't guess it's own plugin path.  
>   
> Now, I rename /usr/lib/php/Smarty to /usr/lib/php/smarty and "require\_once  
> 'smarty/Smarty.class.php'. Result: success.  
>   
> Actually, the ports system on FreeBSD just does this.
- smartyのパスを決め打ちしてるのはどちらにせよちょっといけてないので、ここは修正しますー（でもどう直すかちょっとむずかしい...） -- ふじおと [?](cmd=edit&page=%A4%D5%A4%B8%A4%AA%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-08-23 (水) 09:55:04
- よろしくお願いします。昨日1日チュートリアルで、基本の使い方なんとか習得しました。。 -- kokoroman [?](cmd=edit&page=kokoroman&refer=ethna-community-forum-archiveto200703.html) 2006-08-24 (木) 00:33:36
- Debian GNU/Linuxの安定版だとsmarty/libs/Smarty.class.phpになりました。 -- 通りすがりのものですが [?](cmd=edit&page=%C4%CC%A4%EA%A4%B9%A4%AC%A4%EA%A4%CE%A4%E2%A4%CE%A4%C7%A4%B9%A4%AC&refer=ethna-community-forum-archiveto200703.html) 2006-08-31 (木) 13:35:15

### Xzavier
> Jayson [?](cmd=edit&page=Jayson&refer=ethna-community-forum-archiveto200703.html) (2006-08-22 (火) 05:35:22)
- たまたま見たら遭遇したのでスパムを消しときました。スパム対策必要なんでしょうけどフィルタリング考えるのが面倒ってのがあるでしょうね。「http://」付きの投稿だけでも弾けば大分ちがうかな -- sora [?](cmd=edit&page=sora&refer=ethna-community-forum-archiveto200703.html) 2006-08-22 (火) 09:55:47
- と思ったけど、直接編集でやればBBSモジュール介さず意味無し・・対策考えるのはやはり時間要りますね -- sora [?](cmd=edit&page=sora&refer=ethna-community-forum-archiveto200703.html) 2006-08-22 (火) 10:00:02

### スパム
> sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) (2006-08-18 (金) 10:35:50)  
>   
> このフォーラムに対するスパムが鬱陶しいので、  
> [http://pukiwiki.sourceforge.jp/?%E6%AC%B2%E3%81%97%E3%81%84%E3%83%97%E3%83%A9%E3%82%B0%E3%82%A4%E3%83%B3%2F209](http://pukiwiki.sourceforge.jp/?%E6%AC%B2%E3%81%97%E3%81%84%E3%83%97%E3%83%A9%E3%82%B0%E3%82%A4%E3%83%B3%2F209)  
> を参考にして対策してみてはいかがでしょうか。
- ですねー、一応一度きたIPはbanしてるのですが、captchaなりキーワードフィルタなり、入れてみます -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-08-23 (水) 09:54:16

### Ethna\_Controller.php の 1697 行目
> m [?](cmd=edit&page=m&refer=ethna-community-forum-archiveto200703.html) (2006-08-04 (金) 11:17:10)  
>   
> Ethna\_Controller.php の 1697 行目は
> 
> - $tmp_path = $action_obj['class_path'];
> + $tmp_path = $action_obj['form_path'];
> 
> こうじゃないですかね？  
>   
> 1702 行目の
> 
> if ($tmp_path == $class_path) {
> return;
> }
> 
> で同じものを比較しているので、例えば IndexAction.php, IndexForm.php  
> とアクションクラスとアクションフォームを分けても 1703 行目で終って  
> しまって include してもらえません。
- ありがとうございます！修正しましたー。 -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-08-23 (水) 09:53:02

### action-test
> sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) (2006-08-01 (火) 11:03:04)  
>   
> ethna action-testでテストのスケルトンを作ると、  
> action-cliにファイルができるのは正しいのでしょうか。
- ありがとうございますー。多分cvs版では直ってると思います（一応確認しました） -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-08-23 (水) 09:50:06

### Ethna 2.3.0 Preview2のEthna\_Backend
> dele [?](cmd=edit&page=dele&refer=ethna-community-forum-archiveto200703.html) (2006-07-28 (金) 14:48:32)  
>   
> PHP4だとgetManagerとgetObjectでインスタンスのコピーが返ります。  
> しかし、ここは参照を返すのが正しいのではないでしょうか？  
>   
> 具体的にはgetManagerを
> 
> - $_ret_object = $this->class_factory->getManager($type, $weak);
> + $_ret_object =& $this->class_factory->getManager($type, $weak);
> 
> getObjectを
> 
> - $_ret_object = $this->class_factory->getObject($key, $weak);
> + $_ret_object =& $this->class_factory->getObject($key, $weak);
> 
> にすべきかと。  
> 自分の勘違いでしたらすみません。
- 遅くなって申し訳ありません、ご指摘のとおりでございますm(\_ \_)m 修正させていただきました@cvs -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-08-23 (水) 09:49:30

### アプリケーション独自のプラグイン
> ama [?](cmd=edit&page=ama&refer=ethna-community-forum-archiveto200703.html) (2006-07-26 (水) 23:34:12)  
>   
> 自前でアプリケーションプラグインを作成しようとしています。  
>   
> {$appid}/plugin/Widget/{$appid}\_Plugin\_Widget\_Calendar.php  
>   
> で独自のプラグインクラスを作成し、getPlugin('Widget', 'Calendar', $appid)としたのですが、親クラスであるEthna\_Plugin\_Widget.phpが無いと怒られました。ValidatorやFilterではこのエラーもわかるのですが、アプリケーション独自のプラグインを作成する事はできないのでしょうか？（そもそもこういう使い方ではない？）  
>   
> 気になったのが、Ethna\_Pluginの110行目〜112行目で、
> 
> 110 // プラグインの親クラスを(存在すれば)読み込み
> 111 list($class, $dir, $file) = $this->_getPluginNaming($type, null, 'Ethna');
> 112 $this->_includePluginSrc($class, $dir, $file);
> 
> となっていますが、\_includePluginSrc()メソッドの中では、file\_exists()がfalseの時に強制的にraiseWarning()になっています。
- すいません、近いうちに直します！ -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-07-27 (木) 07:54:02
- なおしたはずです、確認おねがいしますー -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-07-27 (木) 11:00:32
- はやいっ！ありがとうございます！改善しました。 -- ama(shigeta) [?](cmd=edit&page=ama%28shigeta%29&refer=ethna-community-forum-archiveto200703.html) 2006-07-27 (木) 13:19:33
- 親クラスがないとinfo.php(Ethna\_InfoManaer)の一覧にでないのはとりあえず許してください... -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-07-27 (木) 15:19:28

### ログ出力の基本
> asari [?](cmd=edit&page=asari&refer=ethna-community-forum-archiveto200703.html) (2006-07-26 (水) 12:43:38)  
>   
> Ethna 2.3.0 (CVS版) を使ってみています。  
>   
> ActionForm クラスのたとえば perform() メソッド内で  
> ログを出力したいときには  
>   
> $this->backend->getLogger()->log(LOG\_WARNING, '警告');  
>   
> のように記述すればいいのでしょうか。これで動きましたが、  
> 実際の呼び出しがドキュメントに見つからなかったので、妙に不安に（汗  
>   
> begin()とかend()も本当は自分で呼ばなければいけないのか、とか。など。
- 私もActionForm クラスでの実際の呼び出し方法が見つかりませんでした。これ、ドキュメントに書いて欲しいですね。 -- ff [?](cmd=edit&page=ff&refer=ethna-community-forum-archiveto200703.html) 2006-09-22 (金) 16:34:59

### action-xmlrpc
> sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) (2006-07-26 (水) 10:24:58)  
>   
> Ethna 2.3.0 Preview2で、
> 
> ethna add-action-xmlrpc
> 
> と打ち込んだら、
> 
> Fatal error: Call to undefined method Ethna_Plugin_Handle_AddActionXmlrpc::_validateArgList() in Ethna\class\Plugin\Handle\Ethna_Plugin_Handle_AddActionXmlrpc.php on line 40
> 
> でした。未実装？
- Notice: Undefined index: HTTP\_RAW\_POST\_DATA in Ethna\class\Ethna\_Controller.php on line 883 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-26 (水) 10:38:19
- \_trigger\_XMLRPCで$method = null;になってるんですが、これで動くんでしょうか？ -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-26 (水) 10:52:12
  - $,1vq失礼。(Bxmlrpc\_decode\_requestでmethodが入るん達?GC Warning: Repeated allocation of very large block (appr. size 114688):

    May lead to memory leak and poor performance.

則すね。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-26 (水) 11:01:22
- Ethna\_Errorの$messageに日本語を入れて返却すると、「Invalid return payload: enable debugging to examine incoming payload」が帰ってきちゃいますが、日本語禁止でしょうか。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-08-18 (金) 14:49:55
  - $,1vq(B\_Ethna\_XmlrpcGatewayを'faultString' => mb\_convert\_encoding($r->getMessage(), "UTF-8"),として解決しました。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-08-18 (金) 18:35:20

### 無題
> エイク [?](cmd=edit&page=%A5%A8%A5%A4%A5%AF&refer=ethna-community-forum-archiveto200703.html) (2006-07-25 (火) 00:48:43)  
>   
> はじめまして。  
> 最近Ethnaを使い始めた新参者ですが、ちょっと報告を。  
>   
> Ethna2.1.2 + php5.1.1 + SQLServer2000(ODBC経由) で開発していて見つけたんですが、Ethna\_DB\_PEARをそのままの状態で経由するとトランザクションの処理がうまくいかないようです。  
>   
> 次のようなテストコードで、  
>   
>   
> $db =& $this->backend->getDB();  
> $db->begin();  
> $db->query('INSERT INTO 〜〜〜〜〜');  
> $db->rollback(); またはcommit  
>   
>   
> とやると、「[SQL Server]ストアド プロシージャ 'BEGIN' が見つかりませんでした。」とエラーが出ました。
> 
> # このままbeginだけを抜くと、エラーはでませんが、トランザクションとして認識されないようで、ROLLBACKが無視されました。  
>   
> おそらくEthna\_DB\_PEAR::beginの中で、直接"BEGIN;"というクエリを投げているのが原因だろうと思われたので、メンバ変数$dbにダイレクトにアクセスして、  
>   
>   
> $db =& $this->backend->getDB();  
> $db->db->query('INSERT INTO 〜〜〜〜〜');  
> $db->db->rollback(); またはcommit  
>   
>   
> というようにEthna\_DB\_PEARのトランザクション処理を使用しなければ問題なくできました。  
> ただ、メンバ変数にアクセスするのがどうも気持ち悪いですが。。。  
>   
> と、ここまでが報告なんですが、  
> Ethna\_DB\_PEARのトランザクション処理がPEARのトランザクション処理を利用していないのは、何か理由があるのでしょうか？  
> ふと気になったもので。
- すみません、、、無題の上に本文の書き方間違えました。 -- エイク [?](cmd=edit&page=%A5%A8%A5%A4%A5%AF&refer=ethna-community-forum-archiveto200703.html) 2006-07-25 (火) 00:50:15
- ODBCのトランザクションは特殊なので、最初に$db->db->autoCommit(false);でトランザクション開始です。上記だと1行ごとにautoCommitされてしまうと思うのですが。またODBCってトランザクションのネストができなかったはずなので、どちらにしろEthna\_DB\_PEARのトランザクション処理は使用しない方がいいですね。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-25 (火) 10:39:54
- autoCommitについては実施していました、ソース抜き出すときに消してしまったみたいです、すみません。ネストは特に考えていなかったんですが、それでもEthna\_DB\_PEARをそのまま使わないほうがいいみたいですね。 -- エイク [?](cmd=edit&page=%A5%A8%A5%A4%A5%AF&refer=ethna-community-forum-archiveto200703.html) 2006-07-25 (火) 13:36:01
- MySQLでも同様の問題がありました。次の書き方で正常に動いたので逃げています(汗;　　　　 $db =& $this->backend->getDB(); $db->db->autocommit(false);　　 $db->begin(); -- key [?](cmd=edit&page=key&refer=ethna-community-forum-archiveto200703.html) 2006-11-22 (水) 22:31:10

### Ethna 2.3.0 Preview版のEthna\_Logger
> みかぽん [?](cmd=edit&page=%A4%DF%A4%AB%A4%DD%A4%F3&refer=ethna-community-forum-archiveto200703.html) (2006-07-22 (土) 00:51:47)  
>   
> はじめまして。  
>   
> 自分のテスト環境のEthnaをPreview1・Preview2とアップデートして使ったのですが、log\_facilityをfileにしてもログが書き出されませんでした。  
>   
> ちょっとEthnaのソースを追いかけてみたら、Ethna\_Logger.phpのbegin()の
> 
> foreach ($this->writer as $writer) {
> $writer->begin();
> }
> 
> がおかしいのではと思い
> 
> foreach ($this->writer as $key => $writer) {
> $this->writer[$key]->begin();
> }
> 
> とした所動きました。  
> 正しい修正かわかりませんが、一応ご報告しておきます。
- この修正で直りました? ログファイルのパーミッションを確認して、もし変なパーミッションになってたらclass/Ethna/Plugin/Logwriter/Ethna\_Plugin\_Logwriter\_File.php の 26 行目のコメントが閉じてないのを閉じて、ファイルのパーミッションを直してあげてください。(CVSでは直ってます) -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-07-23 (日) 15:47:35
- あ、PHP 4だとイマイチな動きをしちゃうかもでした。CVSでなおしましたー。 -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-07-23 (日) 20:08:43
- はい、そっちも修正していました（CVSで直っていたのを確認してました）＞いちいさん -- みかぽん [?](cmd=edit&page=%A4%DF%A4%AB%A4%DD%A4%F3&refer=ethna-community-forum-archiveto200703.html) 2006-07-23 (日) 20:30:44

### Ethna 2.3.0 Preview2
> sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) (2006-07-21 (金) 18:07:19)  
>   
> app.controller.phpの\_setDefaultTemplateEngine()の引数が相変わらず$smartyなので、勘違いしてしまいそうです。
- Ethna\_ClassFactory.php on line 120にて「Notice: Only variable references should be returned by reference」 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-21 (金) 18:13:30
- Ethna\_MailSender::getTemplateEngine()がEthna\_Renderer返すのでエラーになる。(preview1の時書いた問題ですね) -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-21 (金) 18:42:42
- はげしくありがとうございます！修正しましたー -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-07-22 (土) 17:08:48

### configのlog\_levelの動作
> akiyama [?](cmd=edit&page=akiyama&refer=ethna-community-forum-archiveto200703.html) (2006-07-13 (木) 16:43:05)  
>   
> etc/プロジェクト名-ini.phpで
> 
> 'debug' => false,
> 'log_level' => 'notice',
> 
> 以上の設定でdebugモードと同じようにログを出力するのですが、これは正しい動作でしょうか？
- debugモードとログは関係ないですよ。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-14 (金) 22:49:03

### Ethna 2.3.0 Preview1
> sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) (2006-07-12 (水) 18:03:52)  
>   
> WarningやNoticeがいっぱい出ました。
> 
> Warning: Call-time pass-by-reference has been deprecated - argument passed by value
> 
> Ethna\_Controller.php on line 1540  
> Ethna\_Controller.php on line 1600  
> Renderer/Ethna\_Renderer\_Smarty.php on line 33
> 
> Notice: Use of undefined constant BASE - assumed 'BASE'
> 
> Ethna\_Controller.php on line 182
> 
> Notice: Undefined offset: 1
> 
> Ethna\_Logger.php on line 242  
>   
> あとは、Ethna\_Controller::\_setDefaultTemplateEngine()が  
> Ethna\_Rendererになったので互換性なくなっていますね。  
> コメントとスケルトンの引数も修正しないと。
- BASE以外は、原因がわかったので対応しました。BASEについてはちょっと調査中です。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-07-12 (水) 19:26:26
- なんとなく原因がわかったので、とりあえず、直しておきましたー。ありがとうございますー。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-07-13 (木) 01:20:04
  - 直されたモノはまだ公開されていないですよね？次のリリース時でしょうか？待ってます！ -- たくあん [?](cmd=edit&page=%A4%BF%A4%AF%A4%A2%A4%F3&refer=ethna-community-forum-archiveto200703.html) 2006-07-13 (木) 21:38:42
  - [http://cvs.sourceforge.jp/cgi-bin/viewcvs.cgi/ethna/ethna.tar.gz?tarball=1](http://cvs.sourceforge.jp/cgi-bin/viewcvs.cgi/ethna/ethna.tar.gz?tarball=1)　cvs上は、常に最新があります。パッケージになっているのもは、タイミングによっては、pear ethna/ethna-betaでダウンロードできます。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-07-13 (木) 22:33:08
  - 基本的なこと聞いてしまってすみません、ご回答ありがとうございます。 -- たくあん [?](cmd=edit&page=%A4%BF%A4%AF%A4%A2%A4%F3&refer=ethna-community-forum-archiveto200703.html) 2006-07-14 (金) 00:24:15
  - いえいえ、 [http://ethna.jp/pear/](pear/)からもダウンロードできるらしいです。（教えてもらった）これからもよろしくお願いしますー。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-07-14 (金) 22:23:22
- Ethna\_Logger.php on line 79にて「Notice: Use of undefined constant GATEAY\_WWW - assumed 'GATEAY\_WWW'」 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-13 (木) 12:14:44
  - ありがとうございますー。対応しましたー。 -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-07-13 (木) 22:35:00
- Ethna\_ActionForm.php on line 743にて「Notice: Only variable references should be returned by reference」 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-18 (火) 17:51:20
  - なおしました！ -- いちい [?](cmd=edit&page=%A4%A4%A4%C1%A4%A4&refer=ethna-community-forum-archiveto200703.html) 2006-07-20 (木) 00:10:27
- Ethna\_Rendererの影響でEthna\_MailSenderが動かないです -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-19 (水) 19:33:52
  - CVS最新版では元通りで動くようになってました。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-20 (木) 11:45:48
  - $,1vq嘘。(Bstableのethnaを見ちゃってました。PR2のCHANGELOG見たらB.Cってことで。 -- sfio [?](cmd=edit&page=sfio&refer=ethna-community-forum-archiveto200703.html) 2006-07-21 (金) 17:57:41

### solarisでのEthna\_Logger.php
> nemo [?](cmd=edit&page=nemo&refer=ethna-community-forum-archiveto200703.html) (2006-07-04 (火) 17:28:08)  
>   
> はじめまして。  
>   
> PHPのフレームワークを試してみようとEthnaをテスト中です。  
> 一先ずインストール完了後、動作させてみたところ  
>   
> Notice: Use of undefined constant LOG\_AUTHPRIV - assumed 'LOG\_AUTHPRIV' in /var/php/lib/php/Ethna/class/Ethna\_Logger.php on line 478  
>   
> のメッセージがでました。  
> solarisでは、LOG\_AUTHPRIVが有効にならない（syslogの絡み？）ようで、Ethna\_Logger.phpを直接LOG\_AUTHに書き換えることで、noticeは出なくなりました。  
>   
> 別段問題ないように思いますが、念のため投稿しておきます。  
> 他の解決法などあればまたご教授ください。  
> 以上、宜しくお願いします。
- おぉ、ありがとうございますー。多分ほとんど使われて無いでしょうし、2.3.xからautpriv消しちゃおうかと思います -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-07-10 (月) 16:38:43

### ふたつ以上のバージョンのEthnaを同時に使う
> asari [?](cmd=edit&page=asari&refer=ethna-community-forum-archiveto200703.html) (2006-07-01 (土) 00:20:42)  
>   
> はじめまして。  
>   
> すでに /usr/local/lib/php 以下に Ethna 0.2.0-dev がインストールされている環境で、自分のホームディレクトリに新しい Ethna をインストールして使ってみようとしています。  
>   
> Apache の httpd.conf で自分の持つディレクトリに関して AllowOverride All としてもらった上で、 .htaccess に "php\_value include\_path ".:/home/asari/local/lib/php:/usr/local/lib/php" などとして使うことを考えています。  
>   
> このとき、チュートリアルにしたがって ethna.sh を実行したところ、次のようなエラーメッセージが出ました。  
>   
> Fatal error: Class 'Ethna\_Handle\_Manager' not found in /home/asari/local/lib/php/Ethna/bin/ethna\_handle.php on line 59  
>   
> ethna\_handle.php を調べてみると、 php.ini に記述してある include\_path が優先されているため、古いバージョンの Ethna が使われてしまっているようでした。問題の行はここです：  
>   
> ini\_set('include\_path', ini\_get('include\_path') . PATH\_SEPARATOR . "$base");  
>   
> これを次のように変更すると、どうやら使えるようになったようです。  
>   
> ini\_set('include\_path', "$base" . PATH\_SEPARATOR . ini\_get('include\_path'));  
>   
> 今はまだ始めたばかりです。その他にも何か起こるかもしれませんが、とりあえず、ご報告まで。
- CLI版のPHPは.htaccessの値を拾わないので、設定が有効にならないので。ethna.shで、$PHP\_COMMANDを見るようにしているようなので。環境変数で、PHP\_COMMANDに、「php -c (専用の設定をしたPHP.iniファイル名）」を指定してはいかがでしょうか -- 個々一番 [?](cmd=edit&page=%B8%C4%A1%B9%B0%EC%C8%D6&refer=ethna-community-forum-archiveto200703.html) 2006-07-03 (月) 13:44:00
- ああ、ありがとうございます。 -- asari [?](cmd=edit&page=asari&refer=ethna-community-forum-archiveto200703.html) 2006-07-26 (水) 12:43:58

### Ethna\_DB\_PEAR.sqlquery()の使い方
> ふじなか [?](cmd=edit&page=%A4%D5%A4%B8%A4%CA%A4%AB&refer=ethna-community-forum-archiveto200703.html) (2006-06-16 (金) 12:11:28)  
>   
> Ethna-2.1.2で実装されているEthna\_DB\_PEAR.sqlquery()って  
> どんな使い方が想定されているのでしょう？
### ".ethna"ファイルについて
> (2006-06-15 (木) 12:04:55)  
>   
> [http://ethna.jp/index.php?ethna-document-dev\_resourcefile](ethna-document-dev_resourcefile.md)  
> こちらですが、Windowsの場合ホームディレクトリの環境変数が「HOME」ではないため利用できません。  
> 環境変数にHOMEを「%HOMEDRIVE%%HOMEPATH%」を追加したらうまくいきました。
- CVS上ですが、USERPROFILEを見るように修正が入っています。 -- halt [?](cmd=edit&page=halt&refer=ethna-community-forum-archiveto200703.html) 2006-06-19 (月) 18:58:11

### Cache関連のエラーコード
> BoBpp [?](cmd=edit&page=BoBpp&refer=ethna-community-forum-archiveto200703.html) (2006-06-13 (火) 09:10:12)  
>   
> Cache関連のエラーコードが、 Ethna.php に E\_CACHE\_INVALID\_TYPE => 256 〜 E\_CACHE\_GENERAL => 259 と設定されていますが、  
> /app/{projectid}\_Error.phpには、(現行のスケルトンを含む)
> 
> TODO: ここにアプリケーションのエラー定義を記述してください。
> なお、255までのエラーコードはフレームワークで予約されていますので
> エラーコードには256以上の整数を使用してください。
> 
> との記述があります。プロジェクトのエラーコード適用規則によってはエラーコードが被ってしまう気がします。  
> 自分の書いたものとはかぶってしまいましたｗ  
>   
> エラーコードのいい使い方が全く浮かばないヘタれではありますがｗ  
> たぶん、256以内に修正したらいいのかな？ と思うので修正されるといいなぁと思います。
- おぉ！はげしくすみませんm(\_ \_)m はげしくなおします！ -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-06-13 (火) 10:56:30
- すばやい修正ありがとうございます〜。 -- BoBpp [?](cmd=edit&page=BoBpp&refer=ethna-community-forum-archiveto200703.html) 2006-06-14 (水) 10:05:13

### 記事出ましたね
> ましゅりく [?](cmd=edit&page=%A4%DE%A4%B7%A4%E5%A4%EA%A4%AF&refer=ethna-community-forum-archiveto200703.html) (2006-06-13 (火) 01:30:59)  
>   
> 【PHPウォッチ】第27回 国産有力フレームワークEthnaの新版2.1.2リリース：ITpro  
> [http://itpro.nikkeibp.co.jp/article/COLUMN/20060612/240709/](http://itpro.nikkeibp.co.jp/article/COLUMN/20060612/240709/)
### インサート文について
> えすなかすき [?](cmd=edit&page=%A4%A8%A4%B9%A4%CA%A4%AB%A4%B9%A4%AD&refer=ethna-community-forum-archiveto200703.html) (2006-06-07 (水) 03:49:16)  
>   
> Ethna\_AppObjectの以下の記述ってありなんすか？
> 
> 837: $sql = "INSERT INTO $tables SET $set_list";
- いやー、基本的にナシだとは思います(MySQL only?)。次バージョンで、Ethna\_AppObjectのDB依存解消をしようと思ってますんでその際には必ず。 [http://ml.ethna.jp/pipermail/users/2006-June/000301.html](http://ml.ethna.jp/pipermail/users/2006-June/000301.html)もご覧いただければと思います。 -- ふじもと [?](cmd=edit&page=%A4%D5%A4%B8%A4%E2%A4%C8&refer=ethna-community-forum-archiveto200703.html) 2006-06-07 (水) 09:38:12

