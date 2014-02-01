<?php
// vim: foldmethod=marker
/**
 *  ActionClassCLI.php
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

// {{{ Ethna_ActionClassCLI
/**
 *  コマンドラインaction実行クラス
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @access     public
 *  @package    Ethna
 *  @obsolete
 */
class Ethna_ActionClassCLI extends Ethna_ActionClass
{
    /**
     *  action処理
     *
     *  @access public
     */
    public function perform()
    {
        parent::perform();
        $_SERVER['REMOTE_ADDR'] = "0.0.0.0";
        $_SERVER['HTTP_USER_AGENT'] = "";
    }
}
// }}}
