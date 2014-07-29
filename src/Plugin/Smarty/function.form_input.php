<?php
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

