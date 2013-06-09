<?php
// vim: foldmethod=marker
/**
 *  Plugin.php
 *
 *  @author     ICHII Takashi <ichii386@schweetheart.jp>
 *  @author     Kazuhiro Hosoi <hosoi@gree.co.jp>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

// {{{ Ethna_Plugin
/**
 *  プラグインクラス
 *  
 *  @author     ICHII Takashi <ichii386@schweetheart.jp>
 *  @author     Kazuhiro Hosoi <hosoi@gree.co.jp>
 *  @access     public
 *  @package    Ethna
 */
class Ethna_Plugin
{
    /**#@+
     *  @access private
     */

    /** @var    object  Ethna_Controller    コントローラオブジェクト */
    var $controller;

    /** @var    object  Ethna_Controller    コントローラオブジェクト($controllerの省略形) */
    var $ctl;

    /** @var    object  Ethna_Logger        ログオブジェクト */
    var $logger;

    /** @var    array   プラグインのオブジェクト(インスタンス)を保存する配列 */
    var $obj_registry = array();

    /** @var    array   プラグインのクラス名、ソースファイル名を保存する配列 */
    var $src_registry = array();

    /** @var    array   検索対象ディレクトリを，プラグインの優先順に保存する配列 */
    var $_dirlist = array();

    /**#@-*/

    // {{{ コンストラクタ
    /**
     *  Ethna_Pluginのコンストラクタ
     *
     *  @access public
     *  @param  object  Ethna_Controller    $controller コントローラオブジェクト
     */
    public function __construct(&$controller)
    {
        $this->controller = $controller;
        $this->ctl = $this->controller;
        $this->logger = null;

        // load dir_registry
        $this->_loadPluginDirList();

    }

    /**
     *  loggerをsetする。
     *
     *  LogWriterはpluginなので、pluginインスタンス作成時点では
     *  loggerに依存しないようにする。
     *
     *  @access public
     *  @param  object  Ethna_Logger    $logger ログオブジェクト
     */
    function setLogger(&$logger)
    {
        if ($this->logger === null && is_object($logger)) {
            $this->logger = $logger;
        }
    }
    // }}}

    // {{{ プラグイン呼び出しインタフェース
    /**
     *  プラグインのインスタンスを取得
     *
     *  @access public
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前
     *  @return object  プラグインのインスタンス
     */
    public function getPlugin($type, $name)
    {
        return $this->_getPlugin($type, $name);
    }

    /**
     *  ある種類 ($type) のプラグイン ($name) の全リストを取得
     *
     *  @access public
     *  @param  string  $type   プラグインの種類
     *  @return array   プラグインオブジェクトの配列
     */
    function getPluginList($type)
    {
        $plugin_list = array();

        $this->searchAllPluginSrc($type);
        if (isset($this->src_registry[$type]) == false) {
            return $plugin_list;
        }
        foreach ($this->src_registry[$type] as $name => $value) {
            if (is_null($value)) {
                continue;
            }
            $plugin_list[$name] = $this->getPlugin($type, $name);
        }
        return $plugin_list;
    }
    // }}}

    // {{{ obj_registry のアクセサ
    /**
     *  プラグインのインスタンスをレジストリから取得
     *
     *  @access private
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前
     *  @return object  プラグインのインスタンス
     */
    function _getPlugin($type, $name)
    {
        if (isset($this->obj_registry[$type]) == false) {
            $this->obj_registry[$type] = array();

            // プラグインの親クラスを(存在すれば)読み込み
            list($class, $dir, $file) = $this->getPluginNaming($type, null, 'Ethna');
            if (!Ethna::isError($dir)) {
                $this->_includePluginSrc($class, $dir, $file, true);
            }
        }

        // key がないときはプラグインをロードする
        if (array_key_exists($name, $this->obj_registry[$type]) == false) {
            $this->_loadPlugin($type, $name);
        }

        // null のときはロードに失敗している
        if (is_null($this->obj_registry[$type][$name])) {
            return Ethna::raiseWarning('plugin [type=%s, name=%s] is not found',
                E_PLUGIN_NOTFOUND, $type, $name);
        }

        // プラグインのインスタンスを返す
        return $this->obj_registry[$type][$name];
    }

    /**
     *  get plugin obejct and set to property
     *
     *  @access public
     *  @param  string  $plugin_alias_name  property name to set
     *  @param  array   $plugin             array(type, name)
     */
    function setPlugin($plugin_alias_name, $plugin)
    {
        if (isset($this->{$plugin_alias_name})) {
            return Ethna::raiseWarning('preload plugin alias name is conflicted [alias=%s], It doesn\'t loaded.',
                E_PLUGIN_GENERAL, $plugin_alias_name);
        }

        $this->{$plugin_alias_name} = $this->getPlugin($plugin[0], $plugin[1]);
    }

    /**
     *  プラグインをincludeしてnewし，レジストリに登録
     *
     *  @access private
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前
     */
    function _loadPlugin($type, $name)
    {
        // プラグインのファイル名を取得
        $plugin_src_registry = $this->_getPluginSrc($type, $name);
        if (is_null($plugin_src_registry)) {
            $this->obj_registry[$type][$name] = null;
            return;
        }
        list($plugin_class, $plugin_dir, $plugin_file) = $plugin_src_registry;

        // プラグインのファイルを読み込み
        $r = $this->_includePluginSrc($plugin_class, $plugin_dir, $plugin_file);
        if (Ethna::isError($r)) {
            $this->obj_registry[$type][$name] = null;
            return;
        }

        // プラグイン作成
        $instance = new $plugin_class($this->controller, $type, $name);
        if (is_object($instance) == false
            || strcasecmp(get_class($instance), $plugin_class) != 0) {

            if ($this->logger !== null) {
                $this->logger->log(LOG_WARNING, 'plugin [%s::%s] instantiation failed', $type, $name);
            }

            $this->obj_registry[$type][$name] = null;
            return;
        }
        $this->obj_registry[$type][$name] = $instance;
    }

    /**
     *  プラグインのインスタンスをレジストリから消す
     *
     *  @access private
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前
     */
    function _unloadPlugin($type, $name)
    {
        unset($this->obj_registry[$type][$name]);
    }
    // }}}

    /**
     *  プラグインのインスタンスをレジストリから消す
     *
     *  @access private
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前
     */
    function _loadPluginDirList()
    {
        $this->_dirlist[] = $this->controller->getDirectory('plugin');

        // include_path から検索
        $include_path_list = explode(PATH_SEPARATOR, get_include_path());

        // Communiy based libraries
        //$extlib_dir = implode(DIRECTORY_SEPARATOR, array('Ethna', 'extlib', 'Plugin'));
        // Ethna bandle
        $class_dir = implode(DIRECTORY_SEPARATOR, array('Ethna', 'class', 'Plugin'));
        foreach ($include_path_list as $include_path) {
            /*
            if (is_dir($include_path . DIRECTORY_SEPARATOR . $extlib_dir)) {
                $this->_dirlist[] = $include_path . DIRECTORY_SEPARATOR . $extlib_dir;
            }
            */
            if (is_dir($include_path . DIRECTORY_SEPARATOR . $class_dir)) {
                $this->_dirlist[] = $include_path . DIRECTORY_SEPARATOR . $class_dir;
            }
        }
    }

    // {{{ src_registry のアクセサ
    /**
     *  プラグインのソースファイル名とクラス名をレジストリから取得
     *
     *  @access private
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前
     *  @return array   ソースファイル名とクラス名からなる配列
     */
    function _getPluginSrc($type, $name)
    {
        if (isset($this->src_registry[$type]) == false) {
            $this->src_registry[$type] = array();
        }

        // key がないときはプラグインの検索をする
        if (array_key_exists($name, $this->src_registry[$type]) == false) {
            $this->_searchPluginSrc($type, $name);
        }

        // プラグインのソースを返す
        return $this->src_registry[$type][$name];
    }
    // }}}

    // {{{ プラグインファイル検索部分
    /**
     *  プラグインのクラス名、ディレクトリ、ファイル名を決定
     *
     *  @access public
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前 (nullのときは親クラス)
     *  @param  string  $appid  アプリケーションID (廃止予定)
     *  @return array   プラグインのクラス名、ディレクトリ、ファイル名の配列
     */
    function getPluginNaming($type, $name, $appid = 'Ethna')
    {
        $ext = $this->ctl->getExt('php');

        $plugin_class_name = array(
            $appid,
            'Plugin',
            $type,
        );

        if ($appid == 'Ethna') {
            //ver2.6では全てこうなる。

            if ($name !== null) {
                $plugin_class_name[] = $name;
                $dir = ETHNA_BASE . "/class/Plugin/{$type}";
            }
            else {
                //親クラス
                $name = $type;
                $dir = ETHNA_BASE . "/class/Plugin";
            }

            $class = implode('_', $plugin_class_name);
            $file  = "{$name}.{$ext}";

            return array($class, $dir, $file);

        } else {
            //ver2.6ではここはなくなる。

            if ($name === null) {
                //親クラス
                $dir = $this->controller->getDirectory('plugin');
                $class = "{$appid}_Plugin_{$type}";
            } else {
                $dir = $this->controller->getDirectory('plugin') . "/{$type}";
                $class = "{$appid}_Plugin_{$type}_{$name}";
            }

            $file  = "{$class}.{$ext}";

            return array($class, $dir, $file);
        }

    }

    /**
     *  プラグインのソースを include する
     *
     *  @access private
     *  @param  string  $class  クラス名
     *  @param  string  $dir    ディレクトリ名
     *  @param  string  $file   ファイル名
     *  @param  bool    $parent 親クラスかどうかのフラグ
     *  @return true|Ethna_Error
     */
    function &_includePluginSrc($class, $dir, $file, $parent = false)
    {
        $true = true;
        if (class_exists($class)) {
            return $true;
        }

        $file = $dir . '/' . $file;
        if (file_exists_ex($file) === false) {
            if ($parent === false) {
                return Ethna::raiseWarning('plugin file is not found: [%s]',
                                           E_PLUGIN_NOTFOUND, $file);
            } else {
                return $true;
            }
        }

        include_once $file;

        if (class_exists($class) === false) {
            if ($parent === false) {
                return Ethna::raiseWarning('plugin class [%s] is not defined',
                    E_PLUGIN_NOTFOUND, $class);
            } else {
                return $true;
            }
        }

        if ($parent === false) {
            if ($this->logger !== null) {
                $this->logger->log(LOG_DEBUG, 'plugin class [%s] is defined', $class);
            }
        }
        return $true;
    }

    /**
     *  アプリケーション, Ethna の順でプラグインのソースを検索する
     *
     *  @access private
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前
     */
    function _searchPluginSrc($type, $name)
    {
        // コントローラで指定されたアプリケーションIDの順に検索
        foreach ($this->appid_list as $appid) {
            list($class, $dir, $file) = $this->getPluginNaming($type, $name, $appid);
            if (class_exists($class)) {
                // すでにクラスが存在する場合は特別にスキップ
                if (isset($this->src_registry[$type]) == false) {
                    $this->src_registry[$type] = array();
                }
                $this->src_registry[$type][$name] = array($class, null, null);
                return;
            }
            if (file_exists("{$dir}/{$file}")) {
                $this->logger->log(LOG_DEBUG, 'plugin file is found in search: [%s]',
                                   "{$dir}/{$file}");
                if (isset($this->src_registry[$type]) == false) {
                    $this->src_registry[$type] = array();
                }
                $this->src_registry[$type][$name] = array($class, $dir, $file);
                return;
            }
        }

        // 見つからなかった場合 (nullで記憶しておく)
        $this->logger->log(LOG_WARNING, 'plugin file for [type=%s, name=%s] is not found in search', $type, $name);
        $this->src_registry[$type][$name] = null;
    }

    /**
     *  プラグインの種類 ($type) をすべて検索する
     *
     *  @access public
     *  @return array
     */
    function searchAllPluginType()
    {
        $type_list = array();
        foreach (array_reverse($this->appid_list) as $appid) {
            list(, $dir, ) = $this->getPluginNaming('', null, $appid);
            if (is_dir($dir) == false) {
                continue;
            }
            $dh = opendir($dir);
            if (is_resource($dh) == false) {
                continue;
            }
            while (($type_dir = readdir($dh)) !== false) {
                if ($type_dir{0} != '.' && is_dir("{$dir}/{$type_dir}")) {
                    $type_list[$type_dir] = 0;
                }
            }
            closedir($dh);
        }
        return array_keys($type_list);
    }

    /**
     *  指定された $type のプラグイン (のソース) をすべて検索する
     *
     *  @access public
     *  @param  string  $type   プラグインの種類
     */
    function searchAllPluginSrc($type)
    {
        // 後で見付かったもので上書きするので $this->appid_list の逆順とする
        $name_list = array();
        foreach (array_reverse($this->appid_list) as $appid) {
            list($class_regexp, $dir, $file_regexp) = $this->getPluginNaming($type, '([^_]+)', $appid);

            //ディレクトリの存在のチェック
            if (is_dir($dir) == false) {
                // アプリ側で見付からないのは正常
                continue;
            }

            // ディレクトリを開く
            $dh = opendir($dir);
            if (is_resource($dh) == false) {
                $this->logger->log(LOG_DEBUG, 'cannot open plugin directory: [%s]', $dir);
                continue;
            }
            $this->logger->log(LOG_DEBUG, 'plugin directory opened: [%s]', $dir);

            // 条件にあう $name をリストに追加
            while (($file = readdir($dh)) !== false) {
                if (preg_match('#^'.$file_regexp.'$#', $file, $matches)
                    && file_exists("{$dir}/{$file}")) {
                    $name_list[$matches[1]] = true;
                }
            }

            closedir($dh);
        }

        foreach (array_keys($name_list) as $name) {
            // 冗長だがもう一度探しなおす
            $this->_searchPluginSrc($type, $name);
        }
    }
    // }}}

    // {{{ static な include メソッド
    /**
     *  Ethna 本体付属のプラグインのソースを include する
     *
     *  @access public
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前
     *  @static
     */
    function includeEthnaPlugin($type, $name)
    {
        Ethna_Plugin::includePlugin($type, $name, 'Ethna');
    }

    /**
     *  プラグインのソースを include する
     *
     *  @access public
     *  @param  string  $type   プラグインの種類
     *  @param  string  $name   プラグインの名前
     *  @param  string  $appid  アプリケーションID
     *  @static
     */
    function includePlugin($type, $name = null, $appid = null)
    {
        // for B.C.
        if ($type === 'Abstract') {
            return;
        }
        $ctl = Ethna_Controller::getInstance();
        $plugin = $ctl->getPlugin();

        if ($appid === null) {
            $appid = $ctl->getAppId();
        }
        list($class, $dir, $file) = $plugin->getPluginNaming($type, $name, $appid);
        $plugin->_includePluginSrc($class, $dir, $file);
    }


    var $appid_list =  array('Sen', 'Ethna');


    // }}}
}
// }}}

require_once ETHNA_BASE . '/class/Plugin/Abstract.php';
