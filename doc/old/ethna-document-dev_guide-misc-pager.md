# ページャを作成する
- 概要 
  - Pagerを作成する例 
  - ページャを表示するテンプレートの例 
  - できあがり 
  - 
- comment 

## ページャを作成する [](ethna-document-dev_guide-misc-pager.html#m58c4a01 "m58c4a01")

* * *

書いた人:shoma

* * *

## 概要 [](ethna-document-dev_guide-misc-pager.html#s85902d6 "s85902d6")

検索結果やリストの一覧などのページにGoogle風のページリンクを作成します。

Ethna\_Util::getDirectLinkList()を使用してページャを作成します。 Ethna\_Util::getDirectLinkList(全データ数, 表示オフセット, 1ページあたりに表示する件数)となっています。以下の例ではstartが指定されるオフセットになっています。

### Pagerを作成する例 [](ethna-document-dev_guide-misc-pager.html#hdd4d65f "hdd4d65f")

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

### ページャを表示するテンプレートの例 [](ethna-document-dev_guide-misc-pager.html#fc30f3cd "fc30f3cd")

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

### できあがり [](ethna-document-dev_guide-misc-pager.html#z3d98a6b "z3d98a6b")

### [](ethna-document-dev_guide-misc-pager.html#n31eb237 "n31eb237")

[![pager.png](http://ethna.jp/index.php?plugin=ref&page=ethna-document-dev_guide-misc-pager&src=pager.png "pager.png")](plugin=attach&refer=ethna-document-dev_guide-misc-pager&openfile=pager.png.html "pager.png")

## comment [](ethna-document-dev_guide-misc-pager.html#r48d4b51 "r48d4b51")

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

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
<!-- ??BEGIN id:trackback -->
<!-- ?? END id:trackback --><!-- ?? BEGIN id:attach -->

* * *
添付ファイル: [![file](image/file.png)pager.png](plugin=attach&pcmd=open&file=pager.png&refer=ethna-document-dev_guide-misc-pager.html "2008/06/02 16:35:58 9.2KB") 3913件[[詳細](plugin=attach&pcmd=info&file=pager.png&refer=ethna-document-dev_guide-misc-pager.html "添付ファイルの情報")]
<!-- ?? END id:attach -->
<!-- ?? END id:summary -->
<!-- ??END id:content -->
<!-- ?? END id:wrap_content --><!-- ??sidebar?? ========================================================== -->
<!-- ??BEGIN id:wrap_sidebar -->

<!-- ??BEGIN id:search_form -->

## 検索

<form action="http://ethna.jp/index.php?cmd=search" method="post">
            <input type="hidden" name="encode_hint" value="??">
            <input type="text" name="word" value="" size="20">
            <input type="submit" value="検索"><br>
            <input type="radio" name="type" value="AND" checked id="and_search"><label for="and_search">AND検索</label>
            <input type="radio" name="type" value="OR" id="or_search"><label for="or_search">OR検索</label>
    </form>

<!-- END id:search_form -->
<!-- ??BEGIN id:download_link -->

## ダウンロード

[![](image/minilogo.gif)Ethna-2.6.0(beta2)](ethna-download.html)

[![](image/minilogo.gif)Ethna-2.5.0(stable)](ethna-download.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:download_link -->

## Quick Links

- [フォーラム(質問/要望等)](ethna-community-forum.html)
- [メーリングリスト](http://ml.ethna.jp/mailman/listinfo/users)

- [チュートリアル](ethna-document-tutorial.html)
- [開発マニュアル](ethna-document-dev_guide.html)
- [変更点一覧](ethna-document-changes.html)

- [TODO(ロードマップ)](TODO.html)
- [ロゴ](ethna-logo.html)

<!-- END id:download_link -->
<!-- ??BEGIN id:search_form -->

## Powered by GREE

 [![GREE Labs](http://labs.gree.jp/image/greelabs_logo.gif)](http://labs.gree.jp/)

<!-- END id:search_form -->
 [![SourceForge.jp](http://sourceforge.jp/sflogo.php?group_id=1343)](http://sourceforge.jp/)

<!-- ??END id:sidebar -->
<!-- ??END id:wrap_sidebar -->
<!-- ??END id:main --><!-- ?? Footer ?? ========================================================== -->
<!-- ??BEGIN id:footer -->
<!-- ??BEGIN id:copyright --> **PukiWiki 1.4.6** Copyright © 2001-2005 [PukiWiki Developers Team](http://pukiwiki.sourceforge.jp/). License is [GPL](http://www.gnu.org/licenses/gpl.html).  
 Based on "PukiWiki" 1.3 by [yu-ji](http://factage.com/yu-ji/).
<!-- ??END id:copyright -->
<!-- ??END id:footer --><!-- ?? END ?? ============================================================= -->
<!-- ??END id:wrapper -->
