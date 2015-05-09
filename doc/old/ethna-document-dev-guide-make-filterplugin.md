# フィルタプラグインの作成
ここでは、Ethna 向けの フィルタプラグインの作成方法を説明します。Ethna が持つフィルタチェイン機能については、こちらを参照して下さい。

- フィルタプラグインの作成 
  - フィルタプラグインの実体 
  - フィルタプラグインを作成する 
    - Ethna 2.5.0 以前 
  - 処理を記述する 
  - フィルタプラグインを登録する 

| 書いた人 | mumumu | 2009-06-21 | 新規作成 |

### フィルタプラグインの実体 [](ethna-document-dev-guide-make-filterplugin.html#g1de890c "g1de890c")

フィルタプラグインはEthnaのフィルタ機能を実行するものですので、中身は実際のフィルタと変わりません。但し、プラグインですので、クラス名とファイルの置き場所は、Ethnaのプラグインの規則に従う必要があります。

### フィルタプラグインを作成する [](ethna-document-dev-guide-make-filterplugin.html#wadb9212 "wadb9212")

#### Ethna 2.5.0 以前 [](ethna-document-dev-guide-make-filterplugin.html#u3fd4d37 "u3fd4d37")

Ethna 2.5.0 より以前のバージョンでは自動生成機能はありませんので、app/Plugin/Filter/ExecutionTime.php をコピーして手動で作成して下さい。

### 処理を記述する [](ethna-document-dev-guide-make-filterplugin.html#j26c7114 "j26c7114")

以下のように、４つのメソッドが定義されていますので、任意の処理を記述してください。

    <?php
    // vim: foldmethod=marker
    /**
     * [APPID]_Plugin_Filter_Hoge
     *
     * @author your name <yourname@example.com>
     * @license http://www.opensource.org/licenses/bsd-license.php The BSD License
     * @package Ethna_Plugin
     * @version $Id$
     */
    
    // {{{ [APPID]_Plugin_Filter_Hoge
    /**
     * Filter Plugin Class Hoge.
     *
     * @author yourname <yourname@example.com>
     * @access public
     * @package Ethna_Plugin 
     */
    class [APPID]_Plugin_Filter_Hoge extends Ethna_Plugin_Filter
    {
        function preFilter()
        {
        }
    
        function preActionFilter($action_name)
        {
        }
    
        function postActionFilter($action_name, $forward_name)
        {
        }
    
        function postFilter()
        {
        }
    }
    // }}}
    ?>

### フィルタプラグインを登録する [](ethna-document-dev-guide-make-filterplugin.html#k42fcd36 "k42fcd36")

フィルタプラグインを実際に使うには、作成して実装するだけでなく、コントローラーにフィルタチェインの一部として登録する必要があります。

フィルタプラグインを登録するには、[Appid]\_Controller の $filter メンバに登録すれば、そのプラグインがフィルタチェインのひとつとして登録されます。

    var $filter = array(
    + 'Ethna_Plugin_Filter_Hoge',
     );

<!-- ??END id:body -->
<!-- ??BEGIN id:summary --><!-- ??END id:note -->
<!-- ??BEGIN id:trackback -->
<!-- ?? END id:trackback --><!-- ?? END id:attach -->
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
