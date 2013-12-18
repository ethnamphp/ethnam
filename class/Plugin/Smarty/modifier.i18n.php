<?php
/**
 *  smarty modifier:i18nフィルタ
 *
 *  sample:
 *  <code>
 *  {"you have %d apples"|i18n:$n}
 *  </code>
 *  <code>
 *  あなたはリンゴを3つ持っています。
 *  </code>
 *
 *  @param  string  $string i18n処理対象の文字列
 *  @param  mixed   $val    任意のパラメータ
 *  @return string  ロケールに対応したメッセージ
 */
function smarty_modifier_i18n($string, $arg1 = null)
{
    $c = Ethna_Controller::getInstance();

    $i18n = $c->getI18N();

    $msg = $i18n->get($string);
    return sprintf($msg, $arg1);
}

