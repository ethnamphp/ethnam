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

/** アプリケーションオブジェクト状態: 使用可能 */
define('OBJECT_STATE_ACTIVE', 0);
/** アプリケーションオブジェクト状態: 使用不可 */
define('OBJECT_STATE_INACTIVE', 100);


/** アプリケーションオブジェクトソートフラグ: 昇順 */
define('OBJECT_SORT_ASC', 0);
/** アプリケーションオブジェクトソートフラグ: 降順 */
define('OBJECT_SORT_DESC', 1);


/** アプリケーションオブジェクトインポートオプション: NULLプロパティ無変換 */
define('OBJECT_IMPORT_IGNORE_NULL', 1);

/** アプリケーションオブジェクトインポートオプション: NULLプロパティ→空文字列変換 */
define('OBJECT_IMPORT_CONVERT_NULL', 2);


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

    /**
     *  属性の表示名を返す
     *
     *  @access public
     *  @param  string  $attr_name  属性の名前(変数名)
     *  @param  mixed   $id         属性ID
     *  @return string  属性の表示名
     */
    function getAttrName($attr_name, $id)
    {
        $varname = $attr_name . "_list";
        if (is_array($this->$varname) == false) {
            return null;
        }
        $list = $this->$varname;
        if (isset($list[$id]) == false) {
            return null;
        }
        return $list[$id]['name'];
    }

    /**
     *  属性の表示名(詳細)を返す
     *
     *  @access public
     *  @param  string  $attr_name  属性の名前(変数名)
     *  @param  mixed   $id         属性ID
     *  @return string  属性の詳細表示名
     */
    function getAttrLongName($attr_name, $id)
    {
        $varname = $attr_name . "_list";
        if (is_array($this->$varname) == false) {
            return null;
        }
        $list = $this->$varname;
        if (isset($list[$id]['long_name']) == false) {
            return null;
        }

        return $list[$id]['long_name'];
    }


}
// }}}
