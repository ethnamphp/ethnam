<?php
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

            //デバグ用に、送信先のアクション名を表示する
            //超絶便利。これのおかげて開発効率だいぶあがった。
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

