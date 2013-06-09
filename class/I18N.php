<?php
// vim: foldmethod=marker
/**
 *  I18N.php
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

// {{{  mbstring enabled check
function mb_enabled()
{
    return (extension_loaded('mbstring')) ? true : false;
}
// }}}

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
 
// {{{ Ethna_I18N
/**
 *  i18n関連の処理を行うクラス
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @access     public
 *  @package    Ethna
 */
class Ethna_I18N
{
    /**#@+
     *  @access private
     */

    /** @var    Ethna_Controller  コントローラーオブジェクト  */
    var $ctl;

    /** @var    bool    gettextフラグ */
    var $use_gettext;

    /** @var    string  ロケール */
    var $locale;

    /** @var    string  プロジェクトのロケールディレクトリ */
    var $locale_dir;

    /** @var    string  アプリケーションID */
    var $appid;

    /** @var    string  システム側エンコーディング */
    var $systemencoding;

    /** @var    string  クライアント側エンコーディング */
    var $clientencoding;

    /** @var    mixed   Ethna独自のメッセージカタログ */
    var $messages;

    /** @var    mixed   ロガーオブジェクト */
    var $logger;

    /**#@-*/

    /**
     *  Ethna_I18Nクラスのコンストラクタ
     *
     *  @access public
     *  @param  string  $locale_dir プロジェクトのロケールディレクトリ
     *  @param  string  $appid      アプリケーションID
     */
    public function __construct($locale_dir, $appid)
    {
        $this->locale_dir = $locale_dir;
        $this->appid = $appid;

        $this->ctl = Ethna_Controller::getInstance();
        $config = $this->ctl->getConfig();
        $this->logger = $this->ctl->getLogger();
        $this->use_gettext = $config->get('use_gettext') ? true : false;

        //    gettext load check. 
        if ($this->use_gettext === true
         && !extension_loaded("gettext")) {
            $this->logger->log(LOG_WARNING,
                "You specify to use gettext in ${appid}/etc/${appid}-ini.php, "
              . "but gettext extension was not installed !!!"
            );
        }

        $this->messages = false;  //  not initialized yet.

        $this->appid = strtoupper($appid); // 'SEN'
        $this->have_gettext = extension_loaded("gettext") ? true : false;

        /** クライアント言語定義: 英語 */
        define('LANG_EN', 'en');
        
        /** クライアント言語定義: 日本語 */
        define('LANG_JA', 'ja');
        $this->setLanguage(LANG_JA);
    }

    /**
     *  ロケールを設定する
     *
     *  @access public
     *  @param  string  $language       言語定義
     *  @param  string  $systemencoding システムエンコーディング名
     *  @param  string  $clientencoding クライアントエンコーディング名
     *  @return string  言語に対応して設定されたロケール名
     */
    function setLanguage($language, $systemencoding = null, $clientencoding = null)
    {
        switch ($language) {
        case LANG_EN:
            $locale = "en_US";
            break;
        case LANG_JA:
            $locale = "ja_JP";
            break;
        default:
            $locale = "ja_JP";
            break;
        }
        setlocale(LC_ALL, $locale);
        if ($this->have_gettext) {
            bindtextdomain($this->appid, $this->locale_dir);
            textdomain($this->appid);
        }

        $this->systemencoding = $systemencoding;
        $this->clientencoding = $clientencoding;

        return $locale;
    }

    /**
     *  メッセージカタログからロケールに適合するメッセージを取得する
     *
     *  @access public
     *  @param  string  $message    メッセージ
     *  @return string  ロケールに適合するメッセージ
     */
    function get($message)
    {
        if ($this->have_gettext) {
            if (Ethna::isError($message)) {
                //trigger_error($message->getMessage(), E_USER_NOTICE);
                return $message->getMessage();
            }
            return gettext($message);
        } else {
            return $message;
        }
    }

    /** @var    bool    gettextフラグ */
    var $have_gettext;


}
// }}}

