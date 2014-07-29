<?php
/**
 *  smarty function:フォームのsubmitボタン生成
 *
 *  @param  string  $submit   フォーム項目名
 */
function smarty_function_form_submit($params, &$smarty)
{
    $c = Ethna_Controller::getInstance();
    $view = $c->getView();
    if ($view === null) {
        return null;
    }

    //ここでi18n変換をかます
    $params['value'] = _et($params['value']);

    return $view->getFormSubmit($params);
}

