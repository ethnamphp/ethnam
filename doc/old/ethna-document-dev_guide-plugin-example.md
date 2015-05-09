# プラグイン導入の例
- プラグイン導入の例 
  - おおまかな仕様を決める 
  - 親クラスを作る 
  - プラグインを作る 
  - action formに入力フィルタを追加する 
  - view classに出力フィルタを追加する 
  - 絵文字用の文字数カウント 
  - アクション定義の例 
  - まとめ 

このドキュメントでは、新しい種類のプラグインを導入するための全体的な流れの説明をします。具体例として、絵文字を扱うライブラリをプラグインとして用意することを考えます。(重要な注意: この内容はあくまで **プラグイン導入のための概要的な例** で、細かい実装や絵文字の話はかなりてきとうです!)

### おおまかな仕様を決める [](ethna-document-dev_guide-plugin-example.html#x50a7064 "x50a7064")

携帯電話とPCから見られるサイトで絵文字を導入したくなったとします。

- 内部では絵文字の統一した符号体系を用意しておく (絵文字タグを作るとか)
- キャリア/PCごとに分けずに同じアクションで入力、出力をする
  - action formでキャリアを判定して、filterで適切なencodingをする
  - view classでキャリアに応じたsmarty modfierをassignし、tplでdecodeをする

そこで $type = 'emoji' なるプラグインを導入することにします。emojiプラグインは $name = 'au', 'docomo', 'pc', 'softbank' \*1 の 4 種類を用意します。

また、このプラグインは他のアプリケーションでも使いそうなので、プラグインとしてはアプリではなくEthna本体に付属させる形にします。もしアプリに付属させる場合は、以下のプラグインを作る場面で

- クラス名のprefixを 'Ethna\_' ではなく 'Sample\_' のようにアプリ名にする
- ファイルを置く場所を $ETHNA\_HOME/class/Plugin 以下ではなく、 app/plugin 以下に置く(親クラス含む) のようにしてください。

### 親クラスを作る [](ethna-document-dev_guide-plugin-example.html#kfbf80b1 "kfbf80b1")

プラグインの親クラスを作ります。$nameに共通したメソッドをここで定義しておきます。

- クラス名
  - Ethna\_Plugin\_Emoji
- ファイル
  - $ETHNA\_HOME/class/Plugin/Ethna\_Plugin\_Emoji.php

    class Ethna_Plugin_Emoji
    {
       function encode($text)
       {
           // abstract
       }
    
       function decode($text)
       {
           // abstract
       }
    
       function strlen($text)
       {
           // impl
           ...
       }
    }

- abstractなメソッド
  - encode()
    - 各キャリアの絵文字をそのまま含むテキストから、絵文字タグを含むテキストに変換します
  - decode()
    - encode()の逆で、絵文字タグを含むテキストをキャリアごとの絵文字もしくはPCならば絵文字アイコンを表示する<img>タグに変換します。

- すべてのプラグインに共通なメソッド
  - strlen()
    - 絵文字タグを含むテキストを、絵文字を1文字とみなして文字数をカウントします。これは$nameに依存しないので、ここに実装を書いてしまいます。

### プラグインを作る [](ethna-document-dev_guide-plugin-example.html#v1fd2c26 "v1fd2c26")

$name = 'pc' ならば次のような感じになります。親クラスのabstractなメソッドの実装をします。

- クラス名
  - Ethna\_Plugin\_Emoji\_Pc
- ファイル名
  - $ETHNA\_HOME/class/Plugin/Emoji/Ethna\_Plugin\_Emoji\_Pc.php

    class Ethna_Plugin_Emoji_Pc extends Ethna_Plugin_Emoji
    {
       function encode($text)
       {
           // impl
       }
    
       function decode($text)
       {
           // impl
       }
    }

### action formに入力フィルタを追加する [](ethna-document-dev_guide-plugin-example.html#od8da328 "od8da328")

action formではフィルタとしてこのプラグインを使いたいので、アプリケーションのaction formの基底クラス app/Sample\_ActionForm.php に次の内容を追加してフィルタ 'emoji\_encode' を用意します。($this->ctl->getCareer()でキャリアが区別できるものとします)

    function _filter_emoji_encode($value)
    {
        $emoji =& $this->plugin->getPlugin('Emoji', $this->ctl->getCareer());
        return $emoji->encode($value);
    }

### view classに出力フィルタを追加する [](ethna-document-dev_guide-plugin-example.html#c7e6fd81 "c7e6fd81")

まるまる出力フィルタにしてしまってもいいですが、必要なところだけ絵文字のdecodeをするほうが効率がいいので、smartyのmodifierとして登録することにします。

アプリケーションのviewの基底クラス app/Sample\_ViewClass.php に次の内容を追加して、{$text|emoji} というかんじのsmarty modifierを用意します。

    function _setDefault(&$renderer)
    {
        $smarty =& $renderer->getEngine();
    
        $emoji =& $this->plugin->getPlugin('Emoji', $this->ctl->getCareer());
        $smarty->register_modifier('emoji', array(&$emoji, 'decode'));
    }

### 絵文字用の文字数カウント [](ethna-document-dev_guide-plugin-example.html#zbb51b90 "zbb51b90")

action formのバリデータで、max, minは絵文字の場合に意味が違ってしまうので、絵文字用のバリデータプラグインを用意しておきます。(これは Emoji プラグインではなく Validator プラグインであることに注意してください。詳しくは [バリデータプラグインを作る](ethna-document-dev_guide-form-validate_with_plugin.html#eebb5029 "ethna-document-dev\_guide-form-validate\_with\_plugin (513d)")を参照)

- プラグイン名
  - $type = 'Validator', $name = 'Emojistrlen'
- クラス名
  - Ethna\_Plugin\_Validator\_Emojistrlen
- ファイル名
  - $ETHNA\_HOME/class/Plugin/Validator/Ethna\_Plugin\_Validator\_Emojistrlen.php

    class Ethna_Plugin_Validator_Emojistrlen extends Ethna_Plugin_Validator
    {
       function &validate($name, $var, $params)
       {
           $max = $params['max'];
           $min = $params['min'];
    
           $plugin =& $this->backend->getObject('plugin');
           $emoji =& $plugin->getPlugin('Emoji', $this->ctl->getCareer());
           $length = $emoji->strlen($var);
           if ($min <= $length && $length <= $max) {
               return $this->ok();
           } else {
               return $this->error('エラーだよ', E_APP_FORM_INVALIDVALUE);
           }
        }
    }

### アクション定義の例 [](ethna-document-dev_guide-plugin-example.html#u54f76c0 "u54f76c0")

実際のアクションでは以下のように設定します。

- アクション定義の編集

    class Sample_Form_Foo_Bar extends Sample_ActionForm
    {
        var $form = array(
            'text' => array(
                'type' => VAR_TYPE_STRING,
                'form_type' => FORM_TYPE_TEXT,
                'name' => 'テキスト',
                'filter' => 'emoji_encode',
                'required' => true,
                'emojistrlen' => array('max' => 100, 'min' => 1),
            ),
        );
    
        ...
    }

- smartyのテンプレート

    入力テキスト: {$app.text|emoji}

### まとめ [](ethna-document-dev_guide-plugin-example.html#k772d889 "k772d889")

プラグイン自体は非常に役割は小さいので、新たに自分でプラグインを作ろうとすると、プラグインの中身よりもプラグインを使う側のほうに手間取るかもしれません。この例はストーリーの割りに中身が少ないので、もうすこし盛りこんで欲しい内容などありましたら下のコメント欄にご記入ください。

- onRCMHmIjpbKChfbul -- xvzimsfvswg [?](cmd=edit&page=xvzimsfvswg&refer=ethna-document-dev_guide-plugin-example.html) 2009-07-30 (木) 17:22:19
  
<form action="http://ethna.jp/index.php" method="post"> 
<div><input type="hidden" name="encode_hint" value="ぷ"></div>
 <div>
  <input type="hidden" name="plugin" value="comment">
  <input type="hidden" name="refer" value="ethna-document-dev_guide-plugin-example">
  <input type="hidden" name="comment_no" value="0">
  <input type="hidden" name="nodate" value="0">
  <input type="hidden" name="above" value="1">
  <input type="hidden" name="digest" value="c789e4c7138ee171cfba4c619edc8ed9">
  <label for="_p_comment_name_0">お名前: </label><input type="text" name="name" id="_p_comment_name_0" size="15">

  <input type="text" name="msg" id="_p_comment_comment_0" size="70">
  <input type="submit" name="comment" value="コメントの挿入">
 </div>
</form>

* * *
\*1あくまで例です!!  

