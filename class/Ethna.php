<?php
/**
 *  Ethna.php
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

// {{{ Ethna
/**
 *  Ethnaフレームワーククラス
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @access     public
 *  @package    Ethna
 */
class Ethna
{
    /**
     *  渡されたオブジェクトが Ethna_Error オブジェクト
     *  またはそのサブクラスのオブジェクトかどうかチェックします。
     *
     *  @param mixed  $data    チェックする変数
     *  @param mixed  $msgcode チェックするエラーメッセージまたはエラーコード
     *  @return mixed 変数が、Ethna_Error の場合に TRUEを返します。
     *                第2引数が設定された場合は、さらに 所与された $msgcode
     *                を含む場合のみ TRUEを返します。
     *  @static
     */
    public static function isError($data, $msgcode = NULL)
    {
        if (!is_object($data)) {
            return false;
        }

        $class_name = get_class($data);
        if (strcasecmp($class_name, 'Ethna_Error') === 0
         || is_subclass_of($data, 'Ethna_Error')) {
            if ($msgcode == NULL) {
                return true;
            } elseif ($data->getCode() == $msgcode) {
                return true;
            }
        }

        return false;
    }

    /**
     *  Ethna_Errorオブジェクトを生成する(エラーレベル:E_USER_ERROR)
     *
     *  @access public
     *  @param  string  $message            エラーメッセージ
     *  @param  int     $code               エラーコード
     *  @static
     */
    public static function raiseError($message, $code = E_GENERAL)
    {
        $userinfo = null;
        if (func_num_args() > 2) {
            $userinfo = array_slice(func_get_args(), 2);
            if (count($userinfo) == 1 && is_array($userinfo[0])) {
                $userinfo = $userinfo[0];
            }
        }
        $error = new Ethna_Error($message, $code, ETHNA_ERROR_DUMMY, E_USER_ERROR, $userinfo, 'Ethna_Error');
        return $error;
    }

    /**
     *  Ethna_Errorオブジェクトを生成する(エラーレベル:E_USER_WARNING)
     *
     *  @access public
     *  @param  string  $message            エラーメッセージ
     *  @param  int     $code               エラーコード
     *  @static
     */
    public static function raiseWarning($message, $code = E_GENERAL)
    {
        $userinfo = null;
        if (func_num_args() > 2) {
            $userinfo = array_slice(func_get_args(), 2);
            if (count($userinfo) == 1 && is_array($userinfo[0])) {
                $userinfo = $userinfo[0];
            }
        }

        $error = new Ethna_Error($message, $code, ETHNA_ERROR_DUMMY, E_USER_WARNING, $userinfo, 'Ethna_Error');
        return $error;
    }

    /**
     *  Ethna_Errorオブジェクトを生成する(エラーレベル:E_USER_NOTICE)
     *
     *  @access public
     *  @param  string  $message            エラーメッセージ
     *  @param  int     $code               エラーコード
     *  @static
     */
    public static function raiseNotice($message, $code = E_GENERAL)
    {
        $userinfo = null;
        if (func_num_args() > 2) {
            $userinfo = array_slice(func_get_args(), 2);
            if (count($userinfo) == 1 && is_array($userinfo[0])) {
                $userinfo = $userinfo[0];
            }
        }

        $error = new Ethna_Error($message, $code, ETHNA_ERROR_DUMMY, E_USER_NOTICE, $userinfo, 'Ethna_Error');
        return $error;
    }

    /**
     *  エラー発生時の(フレームワークとしての)コールバック関数を設定する
     *
     *  @access public
     *  @param  mixed   string:コールバック関数名 array:コールバッククラス(名|オブジェクト)+メソッド名
     *  @static
     */
    public static function setErrorCallback($callback)
    {
        $GLOBALS['_Ethna_error_callback_list'][] = $callback;
    }

    /**
     *  エラー発生時の(フレームワークとしての)コールバック関数をクリアする
     *
     *  @access public
     *  @static
     */
    public static function clearErrorCallback()
    {
        $GLOBALS['_Ethna_error_callback_list'] = array();
    }

    /**
     *  エラー発生時の処理を行う(コールバック関数/メソッドを呼び出す)
     *
     *  @access public
     *  @param  object  Ethna_Error     Ethna_Errorオブジェクト
     *  @static
     */
    public static function handleError($error)
    {
        for ($i = 0; $i < count($GLOBALS['_Ethna_error_callback_list']); $i++) {
            $callback = $GLOBALS['_Ethna_error_callback_list'][$i];
            if (is_array($callback) == false) {
                call_user_func($callback, $error);
            } else if (is_object($callback[0])) {
                $object = $callback[0];
                $method = $callback[1];

                // perform some more checks?
                $object->$method($error);
            } else {
                //  call statically
                call_user_func($callback, $error);
            }
        }
    }
}
// }}}

