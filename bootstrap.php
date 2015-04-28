<?php
// vim: foldmethod=marker
/**
 *  Ethna.php
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

/** バージョン定義 */
define('ETHNA_VERSION', 'v2.22.3');

//  PHP 5.1.0 以降向けの変更
//  date.timezone が設定されていないと
//  E_STRICT|WARNING が発生する
if (!ini_get('date.timezone')) {
    ini_set('date.timezone', 'Asia/Tokyo');
}

if (!defined('PATH_SEPARATOR')) {
    define('PATH_SEPARATOR', ':');
}
if (!defined('DIRECTORY_SEPARATOR')) {
    define('DIRECTORY_SEPARATOR', '/');
}

/**
 * ダミーのエラーモード
 * PEAR非依存、かつ互換性を維持するためのもの
 */
define('ETHNA_ERROR_DUMMY', 'dummy');

/** Ethnaベースディレクトリ定義 */
define('ETHNA_BASE', __DIR__);


/** 定型フィルタ: 半角入力 */
define('FILTER_HW', 'numeric_zentohan,alphabet_zentohan,ltrim,rtrim,ntrim');

/** 定型フィルタ: 全角入力 */
define('FILTER_FW', 'kana_hantozen,ntrim');


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

// {{{ I18N shortcut
/**
 *  メッセージカタログからロケールに適合するメッセージを取得します。
 *  Ethna_I18N#get のショートカットです。
 *
 *  @access public
 *  @param  string  $message    メッセージ
 *  @return string  ロケールに適合するメッセージ
 *  @see    Ethna_I18N#get
 */
function _et($message)
{
    $ctl = Ethna_Controller::getInstance();
    $i18n = $ctl->getI18N();
    return $i18n->get($message);
}
// }}}

// {{{ ethna_error_handler
/**
 *  エラーコールバック関数
 *
 *  @param  int     $errno      エラーレベル
 *  @param  string  $errstr     エラーメッセージ
 *  @param  string  $errfile    エラー発生箇所のファイル名
 *  @param  string  $errline    エラー発生箇所の行番号
 */
function ethna_error_handler($errno, $errstr, $errfile, $errline)
{
    if (($errno & error_reporting()) === 0) {
        return;
    }

    list($level, $name) = Ethna_Logger::errorLevelToLogLevel($errno);
    switch ($errno) {
    case E_ERROR:
    case E_CORE_ERROR:
    case E_COMPILE_ERROR:
    case E_USER_ERROR:
        $php_errno = 'Fatal error'; break;
    case E_WARNING:
    case E_CORE_WARNING:
    case E_COMPILE_WARNING:
    case E_USER_WARNING:
        $php_errno = 'Warning'; break;
    case E_PARSE:
        $php_errno = 'Parse error'; break;
    case E_NOTICE:
    case E_USER_NOTICE:
    case E_STRICT:
        $php_errno = 'Notice'; break;
    case E_USER_DEPRECATED:
    case E_DEPRECATED:
        $php_errno = 'Deprecated'; break;
    case E_RECOVERABLE_ERROR:
        $php_errno = 'Recoverable error'; break;
    default:
        $php_errno = 'Unknown error'; break;
    }

    //ここで$level, $nameを使わないのはなぜ？
    $php_errstr = sprintf('PHP %s:%s, %s: %s in %s on line %d',
                          $level,$name, $php_errno, $errstr, $errfile, $errline);

    //echo $php_errstr . "<br />";

    // error_log()
    if (ini_get('log_errors')) {
        $locale = setlocale(LC_TIME, 0);
        setlocale(LC_TIME, 'C');
        error_log($php_errstr, 0);
        setlocale(LC_TIME, $locale);
    }

    // $logger->log()
    $c = Ethna_Controller::getInstance();
    if ($c !== null) {
        $logger = $c->getLogger();
        $logger->log($level, sprintf("[PHP] %s: %s in %s on line %d",
                                     $name, $errstr, $errfile, $errline));
    }

    // ignore these errors because so many errors occurs in external libraries (like PEAR)
    if ($errno === E_STRICT) {
        return false;
    }
    if ($errno === E_RECOVERABLE_ERROR) {
        return true;
    }

    // printf()
    if (ini_get('display_errors')) {
        $is_debug = true;
        $has_echo = false;
        if ($c !== null) {
            $config = $c->getConfig();
            $is_debug = $config->get('debug');
            $logger = $c->getLogger();
            $facility = $logger->getLogFacility();
            $has_echo = is_array($facility)
                        ? in_array('echo', $facility) : $facility === 'echo';
        }
        if ($is_debug == true && $has_echo === false
            && $errno !== E_DEPRECATED) {
            return false;
        }
    }
}
set_error_handler('ethna_error_handler');
// }}}

// {{{ ethna_exception_handler
    //  TODO: Implement ethna_exception_handler function.
// }}}

/**
 *  拡張ログプロパティ: ファイル出力
 */
define('LOG_FILE', 1 << 16);

/**
 *  拡張ログプロパティ: 標準出力
 */
define('LOG_ECHO', 1 << 17);

/** メールテンプレートタイプ: 直接送信 */
define('MAILSENDER_TYPE_DIRECT', 0);

// {{{ to_array
/**
 *  グローバルユーティリティ関数: スカラー値を要素数1の配列として返す
 *
 *  @param  mixed   $v  配列として扱う値
 *  @return array   配列に変換された値
 */
function to_array($v)
{
    if (is_array($v)) {
        return $v;
    } else {
        return array($v);
    }
}
// }}}

// {{{ is_error
/**
 *  グローバルユーティリティ関数: 指定されたフォーム項目にエラーがあるかどうかを返す
 *
 *  @param  string  $name   フォーム項目名
 *  @return bool    true:エラー有り false:エラー無し
 */
function is_error($name = null)
{
    $c = Ethna_Controller::getInstance();
    $action_error = $c->getActionError();
    if ($name !== null) {
        return $action_error->isError($name);
    } else {
        return $action_error->count() > 0;
    }
}
// }}}

// {{{ file_exists_ex
/**
 *  グローバルユーティリティ関数: include_pathを検索しつつfile_exists()する
 *
 *  @param  string  $path               ファイル名
 *  @param  bool    $use_include_path   include_pathをチェックするかどうか
 *  @return bool    true:有り false:無し
 */
function file_exists_ex($path, $use_include_path = true)
{
    if ($use_include_path == false) {
        return file_exists($path);
    }

    // check if absolute
    if (is_absolute_path($path)) {
        return file_exists($path);
    }

    $include_path_list = explode(PATH_SEPARATOR, get_include_path());
    if (is_array($include_path_list) == false) {
        return file_exists($path);
    }

    foreach ($include_path_list as $include_path) {
        if (file_exists($include_path . DIRECTORY_SEPARATOR . $path)) {
            return true;
        }
    }
    return false;
}
// }}}

// {{{ is_absolute_path
/**
 *  グローバルユーティリティ関数: 絶対パスかどうかを返す
 *
 *  @param  string  $path               ファイル名
 *  @return bool    true:絶対 false:相対
 */
function is_absolute_path($path)
{
    if ($path{0} == DIRECTORY_SEPARATOR) {
      return true;
    }

    return false;
}
// }}}

/** ゲートウェイ: WWW */
define('GATEWAY_WWW', 1);

/** ゲートウェイ: CLI */
define('GATEWAY_CLI', 2);

/** DB種別定義: R/W */
define('DB_TYPE_RW', 1);

/** DB種別定義: R/O */
define('DB_TYPE_RO', 2);

/** DB種別定義: Misc  */
define('DB_TYPE_MISC', 3);


/** 要素型: 整数 */
define('VAR_TYPE_INT', 1);

/** 要素型: 浮動小数点数 */
define('VAR_TYPE_FLOAT', 2);

/** 要素型: 文字列 */
define('VAR_TYPE_STRING', 3);

/** 要素型: 日付 */
define('VAR_TYPE_DATETIME', 4);

/** 要素型: 真偽値 */
define('VAR_TYPE_BOOLEAN', 5);

/** 要素型: ファイル */
define('VAR_TYPE_FILE', 6);


/** フォーム型: text */
define('FORM_TYPE_TEXT', 1);

/** フォーム型: password */
define('FORM_TYPE_PASSWORD', 2);

/** フォーム型: textarea */
define('FORM_TYPE_TEXTAREA', 3);

/** フォーム型: select */
define('FORM_TYPE_SELECT', 4);

/** フォーム型: radio */
define('FORM_TYPE_RADIO', 5);

/** フォーム型: checkbox */
define('FORM_TYPE_CHECKBOX', 6);

/** フォーム型: button */
define('FORM_TYPE_SUBMIT', 7);

/** フォーム型: file */
define('FORM_TYPE_FILE', 8);

/** フォーム型: button */
define('FORM_TYPE_BUTTON', 9);

/** フォーム型: hidden */
define('FORM_TYPE_HIDDEN', 10);

/** HTML 5 */
/** フォーム型: email */
define('FORM_TYPE_EMAIL', 101);

/** フォーム型: email */
define('FORM_TYPE_NUMBER', 102);

/** エラーコード: 一般エラー */
define('E_GENERAL', 1);

/** エラーコード: DB接続エラー */
define('E_DB_CONNECT', 2);

/** エラーコード: DB設定なし */
define('E_DB_NODSN', 3);

/** エラーコード: DBクエリエラー */
define('E_DB_QUERY', 4);

/** エラーコード: DBユニークキーエラー */
define('E_DB_DUPENT', 5);

/** エラーコード: DB種別エラー */
define('E_DB_INVALIDTYPE', 6);

/** エラーコード: セッションエラー(有効期限切れ) */
define('E_SESSION_EXPIRE', 16);

/** エラーコード: セッションエラー(IPアドレスチェックエラー) */
define('E_SESSION_IPCHECK', 17);

/** エラーコード: アクション未定義エラー */
define('E_APP_UNDEFINED_ACTION', 32);

/** エラーコード: アクションクラス未定義エラー */
define('E_APP_UNDEFINED_ACTIONCLASS', 33);

/** エラーコード: アプリケーションオブジェクトID重複エラー */
define('E_APP_DUPENT', 34);

/** エラーコード: アプリケーションメソッドが存在しない */
define('E_APP_NOMETHOD', 35);

/** エラーコード: ロックエラー */
define('E_APP_LOCK', 36);

/** エラーコード: 読み込みエラー */
define('E_APP_READ', 37);

/** エラーコード: 書き込みエラー */
define('E_APP_WRITE', 38);

/** エラーコード: CSV分割エラー(行継続) */
define('E_UTIL_CSV_CONTINUE', 64);

/** エラーコード: フォーム値型エラー(スカラー引数に配列指定) */
define('E_FORM_WRONGTYPE_SCALAR', 128);

/** エラーコード: フォーム値型エラー(配列引数にスカラー指定) */
define('E_FORM_WRONGTYPE_ARRAY', 129);

/** エラーコード: フォーム値型エラー(整数型) */
define('E_FORM_WRONGTYPE_INT', 130);

/** エラーコード: フォーム値型エラー(浮動小数点数型) */
define('E_FORM_WRONGTYPE_FLOAT', 131);

/** エラーコード: フォーム値型エラー(日付型) */
define('E_FORM_WRONGTYPE_DATETIME', 132);

/** エラーコード: フォーム値型エラー(BOOL型) */
define('E_FORM_WRONGTYPE_BOOLEAN', 133);

/** エラーコード: フォーム値型エラー(FILE型) */
define('E_FORM_WRONGTYPE_FILE', 134);

/** エラーコード: フォーム値必須エラー */
define('E_FORM_REQUIRED', 135);

/** エラーコード: フォーム値最小値エラー(整数型) */
define('E_FORM_MIN_INT', 136);

/** エラーコード: フォーム値最小値エラー(浮動小数点数型) */
define('E_FORM_MIN_FLOAT', 137);

/** エラーコード: フォーム値最小値エラー(文字列型) */
define('E_FORM_MIN_STRING', 138);

/** エラーコード: フォーム値最小値エラー(日付型) */
define('E_FORM_MIN_DATETIME', 139);

/** エラーコード: フォーム値最小値エラー(ファイル型) */
define('E_FORM_MIN_FILE', 140);

/** エラーコード: フォーム値最大値エラー(整数型) */
define('E_FORM_MAX_INT', 141);

/** エラーコード: フォーム値最大値エラー(浮動小数点数型) */
define('E_FORM_MAX_FLOAT', 142);

/** エラーコード: フォーム値最大値エラー(文字列型) */
define('E_FORM_MAX_STRING', 143);

/** エラーコード: フォーム値最大値エラー(日付型) */
define('E_FORM_MAX_DATETIME', 144);

/** エラーコード: フォーム値最大値エラー(ファイル型) */
define('E_FORM_MAX_FILE', 145);

/** エラーコード: フォーム値文字種(正規表現)エラー */
define('E_FORM_REGEXP', 146);

/** エラーコード: フォーム値数値(カスタムチェック)エラー */
define('E_FORM_INVALIDVALUE', 147);

/** エラーコード: フォーム値文字種(カスタムチェック)エラー */
define('E_FORM_INVALIDCHAR', 148);

/** エラーコード: 確認用エントリ入力エラー */
define('E_FORM_CONFIRM', 149);

/** エラーコード: キャッシュタイプ不正 */
define('E_CACHE_INVALID_TYPE', 192);

/** エラーコード: キャッシュ値なし */
define('E_CACHE_NO_VALUE', 193);

/** エラーコード: キャッシュ有効期限 */
define('E_CACHE_EXPIRED', 194);

/** エラーコード: キャッシュエラー(その他) */
define('E_CACHE_GENERAL', 195);

/** エラーコード: プラグインが見つからない */
define('E_PLUGIN_NOTFOUND', 196);

/** エラーコード: プラグインエラー(その他) */
define('E_PLUGIN_GENERAL', 197);

if (defined('E_DEPRECATED') == false) {
    define('E_DEPRECATED', 8192);
}

/** Ethnaグローバル変数: エラーコールバック関数 */
$GLOBALS['_Ethna_error_callback_list'] = array();

/** Ethnaグローバル変数: エラーメッセージ */
$GLOBALS['_Ethna_error_message_list'] = array();

require_once ETHNA_BASE . '/autoload.php';
