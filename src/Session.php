<?php
// vim: foldmethod=marker
/**
 *  Session.php
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

// {{{ Ethna_Session
/**
 *  セッションクラス
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @access     public
 *  @package    Ethna
 */
class Ethna_Session
{
    /**#@+
     *  @access private
     */

    /** @public    object  Ethna_Logger    loggerオブジェクト */
    public $logger;

    /** @public    string  セッション名 */
    public $session_name;

    /** @public    string  セッションデータ保存ディレクトリ */
    public $session_save_dir;

    /** @public    bool    セッション開始フラグ */
    public $session_start = false;

    /** @public    bool    匿名セッションフラグ */
    public $anonymous = false;

    /** @protected    array   Configuration for session */
    protected $config = array(
        'handler'           => 'files',
        'path'              => 'tmp',
        'cache_limiter'     => 'nocache',
        'cache_expire'      => '180',
        'suffix'            => 'SESSID',
    );

    /**#@-*/

    /**
     *  Ethna_Sessionクラスのコンストラクタ
     *
     *  @access public
     *  @param  string  $appid      アプリケーションID(セッション名として使用)
     */
    public function __construct($ctl, $appid)
    {
        $this->ctl = $ctl;
        $this->logger = $this->ctl->getLogger();

        $config = $this->ctl->getConfig()->get('session');
        if ($config) {
            $this->config = array_merge($this->config, $config);
        }

        $this->session_save_dir = $this->config['path'];
        if (($dir = $this->ctl->getDirectory($this->config['path'])) !== null) {
            $this->session_save_dir = $dir;
        }
        $this->session_name = $appid . $this->config['suffix'];

        // set session handler
        ini_set('session.save_handler', $this->config['handler']);
        session_save_path($this->session_save_dir);
        session_name($this->session_name);
        session_cache_limiter($this->config['cache_limiter']);
        session_cache_expire($this->config['cache_expire']);

        $this->session_start = false;
        if (isset($_SERVER['REQUEST_METHOD']) == false) {
            return;
        }

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0) {
            $http_vars = $_POST;
        } else {
            $http_vars = $_GET;
        }
    }


    /**
     *  セッションを復帰する
     *
     *  @access public
     */
    public function restore()
    {
        if (empty($_COOKIE[$this->session_name])) {
            return;
        }

        session_start();
        $this->session_start = true;

        // check anonymous
        if ($this->get('__anonymous__')) {
            $this->anonymous = true;
        }
    }

    /**
     *  セッションIDを取得する
     *
     *  @access public
     *  @return string  session id
     */
    public function getId()
    {
        return session_id();
    }

    /**
     *  セッションを開始する
     *
     *  @access public
     *  @param  int     $lifetime   セッション有効期間(秒単位, 0ならセッションクッキー)
     *  @return bool    true:正常終了 false:エラー
     */
    public function start($lifetime = 0, $anonymous = false)
    {
        if ($this->session_start) {
            // we need this?
            $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['__anonymous__'] = $anonymous;
            return true;
        }

        if (is_null($lifetime)) {
            ini_set('session.use_cookies', 0);
        } else {
            ini_set('session.use_cookies', 1);
        }

        session_set_cookie_params($lifetime);
        session_id(Ethna_Util::getRandom());
        session_start();

        $_SESSION['REMOTE_ADDR'] = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR']: false;
        $_SESSION['__anonymous__'] = $anonymous;
        $this->anonymous = $anonymous;
        $this->session_start = true;

        $this->logger->log(LOG_INFO, 'Session started.');

        return true;
    }

    /**
     *  セッションを破棄する
     *
     *  @access public
     *  @return bool    true:正常終了 false:エラー
     */
    public function destroy()
    {
        if (!$this->session_start) {
            return true;
        }

        session_destroy();
        $this->session_start = false;
        setcookie($this->session_name, "", 0, "/");

        return true;
    }

    /**
     *  セッションIDを再生成する
     *
     *  @access public
     *  @return bool    true:正常終了 false:エラー
     */
    public function regenerateId($lifetime = 0, $anonymous = false)
    {
        if (! $this->session_start) {
            return false;
        }

        $tmp = $_SESSION;

        $this->destroy();
        $this->start($lifetime, $anonymous);

        unset($tmp['REMOTE_ADDR']);
        unset($tmp['__anonymous__']);
        foreach ($tmp as $key => $value) {
            $_SESSION[$key] = $value;
        }

        return true;
    }

    /**
     *  セッション値へのアクセサ(R)
     *
     *  @access public
     *  @param  string  $name   キー
     *  @return mixed   取得した値(null:セッションが開始されていない)
     */
    public function get($name)
    {
        if (!$this->session_start) {
            return null;
        }

        if (!isset($_SESSION[$name])) {
            return null;
        }
        return $_SESSION[$name];
    }

    /**
     *  セッション値へのアクセサ(W)
     *
     *  @access public
     *  @param  string  $name   キー
     *  @param  string  $value  値
     *  @return bool    true:正常終了 false:エラー(セッションが開始されていない)
     */
    public function set($name, $value)
    {
        if (!$this->session_start) {
            // no way
            return false;
        }

        $_SESSION[$name] = $value;

        return true;
    }

    /**
     *  セッションの値を破棄する
     *
     *  @access public
     *  @param  string  $name   キー
     *  @return bool    true:正常終了 false:エラー(セッションが開始されていない)
     */
    public function remove($name)
    {
        if (!$this->session_start) {
            return false;
        }

        unset($_SESSION[$name]);

        return true;
    }

    /**
     *  セッションが開始されているかどうかを返す
     *
     *  @access public
     *  @param  string  $anonymous  匿名セッションを「開始」とみなすかどうか(default: false)
     *  @return bool    true:開始済み false:開始されていない
     */
    public function isStart($anonymous = false)
    {
        if ($anonymous) {
            return $this->session_start;
        } else {
            if ($this->session_start && $this->isAnonymous() != true) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     *  匿名セッションかどうかを返す
     *
     *  @access public
     *  @return bool    true:匿名セッション false:非匿名セッション/セッション開始されていない
     */
    public function isAnonymous()
    {
        return $this->anonymous;
    }

}
// }}}
