# アクション名の決定方法を変更する

## アクション名の決定方法を変更する

デフォルトでは、アクション名はフォーム値を利用して以下のように決定されます。

1. フォーム名のうち、名前が"action_"で始まり、且つフォーム値が空ではないものを探します
2. 1.に該当するフォーム名が見つかった場合、そこから先頭の"action_"を除いた部分をアクション名とします

アクション名の決定方法は、アプリケーションによっては"index.php?act=foo"等さまざまな方法があると思いますので、Ethnaではこの方法をアプリケーションで自由に決定することが出来るようになっています\*1。

具体的には、Ethna_Controller::_getActionName_Form()を適当にオーバーライドすればOKです。例えばアクション名をindex.php?act=fooというようなリクエストで"foo"の部分をアクション名としたい場合は次のように記述します。

Sample_Controller.php:

    /**
     * フォームにより要求されたアクション名を返す
     *
     * @access protected
     * @return string フォームにより要求されたアクション名
     */
    function _getActionName_Form()
    {
        if (array_key_exists('act', $_REQUEST) == false) {
            return null;
        }
        return $_REQUEST['act'];
    }

ちなみに、デフォルトでの処理は [こちら](doc/ __filesource/fsource_Ethna__ classEthna_Controller.php.html#a1137)を御覧下さい。


* * *
\*1なお、なぜわざわざ(フォーム値ではなく)わざわざフォーム名を利用しているかと言うと、複数のsubmitボタンでアクションを振り分けることが出来るようにするためなのです(場合によっては必要かな、と  

