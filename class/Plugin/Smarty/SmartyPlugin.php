<?php
/**
 *  Ethna_SmartyPlugin.php
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */


// {{{ smarty_modifier_unique
/**
 *  smarty modifier:unique()
 *
 *  unique()関数のwrapper
 *
 *  sample:
 *  <code>
 *  $smarty->assign("array1", array("a", "a", "b", "a", "b", "c"));
 *  $smarty->assign("array2", array(
 *      array("foo" => 1, "bar" => 4),
 *      array("foo" => 1, "bar" => 4),
 *      array("foo" => 1, "bar" => 4),
 *      array("foo" => 2, "bar" => 5),
 *      array("foo" => 3, "bar" => 6),
 *      array("foo" => 2, "bar" => 5),
 *  ));
 *
 *  {$array1|@unique}
 *  {$array2|@unique:"foo"}
 *  </code>
 *  <code>
 *  abc
 *  123
 *  </code>
 *  
 *  @param  array   $array  処理対象となる配列
 *  @param  key     $key    処理対象となるキー(nullなら配列要素)
 *  @return array   再構成された配列
 */
function smarty_modifier_unique($array, $key = null)
{
    if (is_array($array) == false) {
        return $array;
    }
    if ($key != null) {
        $tmp = array();
        foreach ($array as $v) {
            if (isset($v[$key]) == false) {
                continue;
            }
            $tmp[$v[$key]] = $v;
        }
        return $tmp;
    } else {
        return array_unique($array);
    }
}
// }}}

// {{{ smarty_modifier_wordwrap_i18n
/**
 *  smarty modifier:文字列のwordwrap処理
 *
 *  [現在EUC-JP対応はEUC-JPのみ対応]
 *
 *  sample:
 *  <code>
 *  {"あいうaえaおaかきaaaくけこ"|wordrap_i18n:8}
 *  </code>
 *  <code>
 *  あいうa
 *  えaおaか
 *  きaaaく
 *  けこ
 *  </code>
 *
 *  @param  string  $string wordwrapする文字列
 *  @param  string  $break  改行文字
 *  @param  int     $width  wordwrap幅(半角$width文字でwordwrapする)
 *  @param  int     $indent インデント幅(半角$indent文字)
 *  @return string  wordwrap処理された文字列
 */
function smarty_modifier_wordwrap_i18n($string, $width, $break = "\n", $indent = 0)
{
    $r = "";
    $i = "$break" . str_repeat(" ", $indent);
    $tmp = $string;
    do {
        $n = strpos($tmp, $break);
        if ($n !== false && $n < $width) {
            $s = substr($tmp, 0, $n);
            $r .= $s . $i;
            $tmp = substr($tmp, strlen($s) + strlen($break));
            continue;
        }

        $s = mb_strimwidth($tmp, 0, $width, "", "EUC-JP");

        // EUC-JPのみ対応
        $n = strlen($s);
        if ($n >= $width && $tmp{$n} != "" && $tmp{$n} != " ") {
            while ((ord($s{$n-1}) & 0x80) == 0) {
                if ($s{$n-1} == " " || $n == 0) {
                    break;
                }
                $n--;
            }
        }
        $s = substr($s, 0, $n);

        $r .= $s . $i;
        $tmp = substr($tmp, strlen($s));
    } while (strlen($s) > 0);

    $r = preg_replace('/\s+$/', '', $r);

    return $r;
}
// }}}

// {{{ smarty_modifier_truncate_i18n
/**
 *  smarty modifier:文字列切り詰め処理(i18n対応)
 *
 *  sample:
 *  <code>
 *  {"日本語です"|truncate_i18n:5:"..."}
 *  </code>
 *  <code>
 *  日本...
 *  </code>
 *
 *  @param  int     $len        最大文字幅
 *  @param  string  $postfix    末尾に付加する文字列
 */
function smarty_modifier_truncate_i18n($string, $len = 80, $postfix = "...")
{
    return mb_strimwidth($string, 0, $len, $postfix);
}
// }}}


// {{{ smarty_modifier_checkbox
/**
 *  smarty modifier:チェックボックス用フィルタ
 *
 *  sample:
 *  <code>
 *  <input type="checkbox" name="test" {""|checkbox}>
 *  <input type="checkbox" name="test" {"1"|checkbox}>
 *  </code>
 *  <code>
 *  <input type="checkbox" name="test">
 *  <input type="checkbox" name="test" checkbox>
 *  </code>
 *
 *  @param  string  $string チェックボックスに渡されたフォーム値
 *  @return string  $stringが空文字列あるいは0以外の場合は"checked"
 */
function smarty_modifier_checkbox($string)
{
    if ($string != "" && $string != 0) {
        return "checked";
    }
}
// }}}


// {{{ smarty_function_form_input
/**
 *  smarty function:フォームタグ生成
 *
 *  @param  string  $name   フォーム項目名
 */
function smarty_function_form_input($params, &$smarty)
{
    // name
    if (isset($params['name'])) {
        $name = $params['name'];
        unset($params['name']);
    } else {
        return null;
    }

    // view object
    $c = Ethna_Controller::getInstance();
    $view = $c->getView();
    if ($view === null) {
        return null;
    }

    // 現在の{form_input}を囲むform blockがあればパラメータを取得しておく
    $block_params = null;
    for ($i = count($smarty->_tag_stack); $i >= 0; --$i) {
        if ($smarty->_tag_stack[$i][0] === 'form') {
            $block_params = $smarty->_tag_stack[$i][1];
            break;
        }
    }

    // action
    $action = null;
    if (isset($params['action'])) {
        $action = $params['action'];
        unset($params['action']);
    } else if (isset($block_params['ethna_action'])) {
        $action = $block_params['ethna_action'];
    }
    if ($action !== null) {
        $view->addActionFormHelper($action, true);
    }

    // default
    if (isset($params['default'])) {
        // {form_input default=...}が指定されていればそのまま

    } else if (isset($block_params['default'])) {
        // 外側の {form default=...} ブロック
        if (isset($block_params['default'][$name])) {
            $params['default'] = $block_params['default'][$name];
        }
    }

    // 現在のアクションで受け取ったフォーム値
    $af = $c->getActionForm();
    $val = $af->get($name);
    if ($val !== null) {
        $params['default'] = $val;
    }

    return $view->getFormInput($name, $action, $params);
}
// }}}

// {{{ smarty_block_form
/**
 *  smarty block:フォームタグ出力プラグイン
 */
function smarty_block_form($params, $content, &$smarty, &$repeat)
{
    if ($repeat) {
        // {form}: ブロック内部に進む前の処理

        // default
        if (isset($params['default']) === false) {
            // 指定なしのときは $form を使う
            $c = Ethna_Controller::getInstance();
            $af = $c->getActionForm();

            // c.f. http://smarty.php.net/manual/en/plugins.block.functions.php
            $smarty->_tag_stack[count($smarty->_tag_stack)-1][1]['default']
                = $af->getArray(false);
        }

        // 動的フォームヘルパを呼ぶ
        if (isset($params['ethna_action'])) {
            $ethna_action = $params['ethna_action'];
            $c = Ethna_Controller::getInstance();
            $view = $c->getView();
            $view->addActionFormHelper($ethna_action, true);
        }

        // ここで返す値は出力されない
        return '';

    } else {
        // {/form}: ブロック全体を出力

        $c = Ethna_Controller::getInstance();
        $view = $c->getView();
        if ($view === null) {
            return null;
        }

        // ethna_action
        if (isset($params['ethna_action'])) {
            $ethna_action = $params['ethna_action'];
            unset($params['ethna_action']);

            $view->addActionFormHelper($ethna_action);
            $hidden = $c->getActionRequest($ethna_action, 'hidden');
            $content = $hidden . $content;
            //for debug (by kashiwagi)
            if ($c->getConfig()->get('showFormActionName')) {
                echo "[" . $ethna_action. "]";
            }
        }

        // enctype の略称対応
        if (isset($params['enctype'])) {
            if ($params['enctype'] == 'file'
                || $params['enctype'] == 'multipart') {
                $params['enctype'] = 'multipart/form-data';
            } else if ($params['enctype'] == 'url') {
                $params['enctype'] = 'application/x-www-form-urlencoded';
            }
        }

        // defaultはもう不要
        if (isset($params['default'])) {
            unset($params['default']);
        }

        // $contentを囲む<form>ブロック全体を出力
        return $view->getFormBlock($content, $params);
    }
}
// }}}
