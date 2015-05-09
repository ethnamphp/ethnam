# ページャを作成する
- 概要 
  - Pagerを作成する例 
  - ページャを表示するテンプレートの例 
  - できあがり 
  - 
- comment 

## ページャを作成する

* * *

書いた人:shoma

* * *

## 概要

検索結果やリストの一覧などのページにGoogle風のページリンクを作成します。

Ethna\_Util::getDirectLinkList()を使用してページャを作成します。 Ethna\_Util::getDirectLinkList(全データ数, 表示オフセット, 1ページあたりに表示する件数)となっています。以下の例ではstartが指定されるオフセットになっています。

### Pagerを作成する例

    function perform()
    {
        $this->total = 100;
        $this->offset = $this->af->get('start') == null ? 0 : $this->af->get('start');
        $this->count = 10;
    
        $this->getPager();
        return 'index';
    }
    
    /**
    *
    * ページャの作成
    *
    * @access public
    * @return void
    */
    function getPager(){
        $pager = Ethna_Util::getDirectLinkList($this->total, $this->offset, $this->count);
        $next = $this->offset + $this->count;
        if($next < $this->total){
            $last = ceil($this->total / $this->count);
            $this->af->setApp('hasnext', true);
            $this->af->setApp('next', $next);
            $this->af->setApp('last', ($last * $this->count) - $this->count);
        }
        $prev = $this->offset - $this->count;
        if($this->offset - $this->count >= 0){
            $this->af->setApp('hasprev', true);
            $this->af->setApp('prev', $prev);
        }
        $this->af->setApp('current', $this->offset);
        $this->af->setApp('link', 'localhost');
        $this->af->setApp('pager', $pager);
    }

### ページャを表示するテンプレートの例

テンプレート側では

    {if $app.hasprev}
    <a href="{$app.link}?start=0">最初</a>&nbsp;<a href="{$app.link}?start={$app.prev}">&lt;&lt;</a>
    {else}
    最初&nbsp;&lt;&lt;
    {/if}
    {foreach from=$app.pager item=page}
    {if $page.offset == $app.current}
    <strong>{$page.index}</strong>
    {else}
    <a href="{$app.link}?start={$page.offset}">{$page.index}</a>
    {/if}
    &nbsp;
    {/foreach}
    {if $app.hasnext}
    <a href="{$app.link}?start={$app.next}">&gt;&gt;</a>
    &nbsp;<a href="{$app.link}?start={$app.last}">最後</a>
    {else}
    &gt;&gt;&nbsp;最後
    {/if}

### できあがり

###

[![pager.png](http://ethna.jp/index.php?plugin=ref&page=ethna-document-dev_guide-misc-pager&src=pager.png "pager.png")](plugin=attach&refer=ethna-document-dev_guide-misc-pager&openfile=pager.png.html "pager.png")

## comment

- 最後の一行って「最後&nbsp;&gt;&gt;」ではなくて、「&gt;&gt;&nbsp;最後」では？ -- yanai
  - 修正しておきました。 -- halt

- $this->af->get('start')→'start'はアクションフォームで定義してないため、リンク機能うまく動けないようです。 ActionFormにstartの定義を追加します。

    var $form = array(
            'start' => array(
                'type' => VAR_TYPE_STRING,            
                'form_type' => FORM_TYPE_HIDDEN, 
            ),
    　　);

- スパムから復旧．たぶんこれでいいと思うんですけど．(2009/10/17) --sotarok

