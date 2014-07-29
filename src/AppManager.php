<?php
// vim: foldmethod=marker
/**
 *  AppManager.php
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

// {{{ Ethna_AppManager
/**
 *  アプリケーションマネージャのベースクラス
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @access     public
 *  @package    Ethna
 */
class Ethna_AppManager
{
    /**     object  Ethna_Backend       backendオブジェクト */
    public $backend;

    /**     object  Ethna_Config        設定オブジェクト */
    public $config;

    /**      object  Ethna_DB      DBオブジェクト */
    public $db;

    /**     object  Ethna_I18N          i18nオブジェクト */
    public $i18n;

    /**     object  Ethna_ActionForm    アクションフォームオブジェクト */
    public $action_form;

    /**     object  Ethna_ActionForm    アクションフォームオブジェクト(省略形) */
    public $af;

    /**     object  Ethna_Session       セッションオブジェクト */
    public $session;

    /**#@-*/

    /**
     *  Ethna_AppManagerのコンストラクタ
     *
     *  @access public
     *  @param  object  Ethna_Backend   $backend   backendオブジェクト
     */
    public function __construct($backend)
    {
        // 基本オブジェクトの設定
        $this->backend = $backend;
        $this->config = $backend->getConfig();
        $this->i18n = $backend->getI18N();
        $this->action_form = $backend->getActionForm();
        $this->af = $this->action_form;
        $this->session = $backend->getSession();

        $db_list = $backend->getDBList();
        if (Ethna::isError($db_list) == false) {
            foreach ($db_list as $elt) {
                $varname = $elt['varname'];
                $this->$varname = $elt['db'];
            }
        }
    }

    /**
     *  属性の一覧を返す
     *
     *  @access public
     *  @param  string  $attr_name  属性の名前(変数名)
     *  @return array   属性値一覧
     */
    function getAttrList($attr_name)
    {
        $varname = $attr_name . "_list";
        return $this->$varname;
    }

}
// }}}
