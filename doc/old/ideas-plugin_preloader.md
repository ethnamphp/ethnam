# プラグインの先読み機能
  - 概要 
  - 新しいプラグインの読み込ませ方・使い方 
  - 別名の付け方 
  - 読み込まれるタイミング 
  - その他 
  - その他2（ViewClassで使いたい場合） 
  - その他3 （PHP 5ベースになると） 
  - コード 

書いた人：sotarok

## プラグインの先読み機能

### 概要

Ethna のプラグインは，これまで getPlugin を2回呼ばないとインスタンスがとれないだとか \*1，決して使いやすいものではありませんでした．

そもそも，「プラグイン」といいつつも，Validator や Filter など，Ethna の中で，「呼ばれるタイミングの決まっているプラグイン」が主であり，任意の機能追加をして再利用しやすいものを作ったり配布したり，があまりされてきませんでした．実際，getPlugin して利用するものは，現状の Ethna の組み込みですと， Cachemanager くらいでしょう．

しかし，2.5.0 以降では，他人の作成したプラグインを取り込みやすい仕組み，自分の作ったプラグインを配布しやすい仕組みが導入される予定です．それに伴い，利用のしやすさ，も重要な要素になってきます．

### 新しいプラグインの読み込ませ方・使い方

ActionClass に $plugins というプロパティを作成し，配列で読み込みたいプラグインを記述すると，その名前でプラグインのオブジェクトをあらかじめ取得しておいてくれるようになります．

Example: app/action/Index.php

    <?php
    ...
    class App_Action_Index extends App_ActionClass
    {
        // type_name のように，アンダースコア区切りで指定する
        var $plugins = array(
            'Cachemanager_Localfile',
            'Cachemanager_Memcache',
        );
    
        function prepare()
        {
            ...
            return null;
        }
    
        function perform()
        {
            ...
            // $plugins で指定したプラグインが，その名前で使える
            $this->plugin->Cachemanager_Localfile->get('hoge');
            $this->plugin->Cachemanager_Memcache->get('hoge');
            ...
    
            return 'index';
        }
    }

このように，あらかじめ $plugins プロパティ変数に配列で定義することで，そのプラグインのインスタンスを $this->plugin に読み込んでおいてくれるようになります．

### 別名の付け方

これで，キャッシュプラグインなどが幾分使いやすくなりました．とはいえ，Cachemanager\_Localfile と毎回打つのもなかなか骨が折れます\*2

ですので，別名でアクセスする方法も提供しています． 連想配列のキーに別名を指定すると，その名前で使えるようになります．

Example: app/action/Index.php

    <?php
    ...
    class App_Action_Index extends App_ActionClass
    {
        // type_name のように，アンダースコア区切りで指定する
        var $plugins = array(
            'cm' => 'Cachemanager_Localfile',
        );
    
        function prepare()
        {
            ...
            return null;
        }
    
        function perform()
        {
            ...
            // $plugins の連想配列のキーで別名を指定
            $this->plugin->cm->get('hoge');
            ...
    
            return 'index';
        }
    }

### 読み込まれるタイミング

- ActionClass のコンストラクタで読み込まれます．従って，prepare でも preform でも使えます．

### その他

- 別名づけと，プラグインファイル名でアクセスする方法は混同して利用できます．\*3

Example: app/action/Index.php

    <?php
    ...
    class App_Action_Index extends App_ActionClass
    {
        // 混同してもOK
        var $plugins = array(
            'Cachemanager_Localfile',
            'cm' => 'Cachemanager_Localfile',
        );
    
        ...
        function perform()
        {
            ...
            // どっちも同じオブジェクト
            $this->plugin->cm->get('hoge');
            $this->plugin->Cachemanager_Localfile->get('hoge');
            ...
        }
    }

### その他2（ViewClassで使いたい場合）

- こうして読み込ませた Plugin は，Plugin オブジェクトに読み込まれるので，このActionClassからforwardしたViewClassでも当然利用できます．
- 逆にいうと，ViewClass で使いたいプラグインは，そのViewClassにフローのながれるActionClassにpluginの記述をしておくといいでしょう．

### その他3 （PHP 5ベースになると）

- PHP 5 ベースのコードになると，別名をつけない場合は，$plugins の記述すら必要なくなる予定です

### コード

この変更は git の plugin\_preloader ブランチで適用されています．

- [http://git.sourceforge.jp/view?p=ethna/ethna.git;a=shortlog;h=refs/heads/plugin\_preload](http://git.sourceforge.jp/view?p=ethna/ethna.git;a=shortlog;h=refs/heads/plugin_preload)

チェックアウト例：

    % git clone git://git.sourceforge.jp/gitroot/ethna/ethna.git
    % cd ethna
    % git checkout -b plugin_preloader origin/plugin_preloader


* * *
\*1 [http://ethna.jp/ethna-document-dev\_guide-plugin.html#j3c3ba62](dev_guide-plugin.md#j3c3ba62)  
\*2当然みなさんは補完機能付きのエディタを使っているとは思いますが，それでも面倒っちゃ面倒です  
\*3が，実際にコードを書くときはどちらかのポリシーに統一したほうがチーム開発の面ではよろしいでしょう  

