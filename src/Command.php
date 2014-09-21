<?php
/**
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

/**
 *  Manager class of Ethna (Command Line) Handlers
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @access     public
 *  @package    Ethna
 */
class Ethna_Command
{
    private $version = <<<EOD
Ethna %s (using PHP %s)

Copyright (c) 2004-%s,
  Masaki Fujimoto <fujimoto@php.net>
  halt feits <halt.feits@gmail.com>
  Takuya Ookubo <sfio@sakura.ai.to>
  nozzzzz <nozzzzz@gmail.com>
  cocoitiban <cocoiti@comio.info>
  Yoshinari Takaoka <takaoka@beatcraft.com>
  Sotaro Karasawa <sotaro.k@gmail.com>

http://ethna.jp/

EOD;

    /**#@+
     *  @access     private
     */

    /** @protected    object  Ethna_Controller    controllerオブジェクト */
    protected $controller;

    /** @protected    object  Ethna_Controller    controllerオブジェクト($controllerの省略形) */
    protected $ctl;

    /** @protected    object  Ethna_Pluguin       pluginオブジェクト */
    protected $plugin;

    /**#@-*/

    // {{{ constructor
    /**
     *  Ethna_Command constructor
     *
     *  @access public
     */
    public function __construct()
    {
        $this->controller = new Ethna_Controller(GATEWAY_CLI);
        Ethna::clearErrorCallback();

        $this->ctl = $this->controller;
        $this->plugin = $this->controller->getPlugin();
    }
    // }}}

    /**
     * コマンドを実行する
     */
    public function run()
    {

        // fetch arguments
        $opt = new Ethna_Getopt();
        $arg_list = $opt->readPHPArgv();
        if (Ethna::isError($arg_list)) {
            echo $arg_list->getMessage()."\n";
            exit(2);
        }
        array_shift($arg_list);  // remove "command.php"

        if ($dot_ethna = getenv('DOT_ETHNA')) {
            $app_controller = self::getAppController(dirname($dot_ethna));
        }

        $handle = $this;

        //  はじめの引数に - が含まれていればそれを分離する
        //  含まれていた場合、それは -v|--version でなければならない
        list($my_arg_list, $arg_list) = $handle->separateArgList($arg_list);
        $r = $opt->getopt($my_arg_list, "v", array("version"));
        if (Ethna::isError($r)) {
            $subCommand = 'help';
        } else {
            // ad-hoc:(
            foreach ($r[0] as $opt) {
                if ($opt[0] == "v" || $opt[0] == "--version") {
                    printf($this->version, ETHNA_VERSION, PHP_VERSION, date('Y'));
                    exit(2);
                }
            }
        }

        if (count($arg_list) == 0) {
            $subCommand = 'help';
        } else {
            $subCommand = array_shift($arg_list);
        }

        $handler = $handle->getHandler($subCommand);
        $handler->eh = $handle;
        if (Ethna::isError($handler)) {
            printf("no such command: %s\n\n", $subCommand);
            $subCommand = 'help';
            $handler = $handle->getHandler($subCommand);
            $handler->eh = $handle;
            if (Ethna::isError($handler)) {
                exit(1);  //  should not happen.
            }
        }

        // don't know what will happen:)
        $handler->setArgList($arg_list);
        $r = $handler->perform();
        if (Ethna::isError($r)) {
            printf("error occured w/ command [%s]\n  -> %s\n\n", $subCommand, $r->getMessage());
            if ($r->getCode() == 'usage') {
                $handler->usage();
            }
            exit(1);
        }

    }

    // {{{ getHandler
    /**
     *  get handler object
     *
     *  @access public
     */
    public function getHandler($subCommand)
    {
        $name = preg_replace_callback('/\-(.)/', function($matches){
                return strtoupper($matches[1]);
                    }, ucfirst($subCommand));

        $handler = $this->plugin->getPlugin('Handle', $name);
        if (Ethna::isError($handler)) {
            return $handler;
        }

        return $handler;
    }
    // }}}

    // {{{ getHandlerList
    /**
     *  get an object list of all available handlers
     *
     *  @access public
     */
    public function getHandlerList()
    {
        $handler_list = $this->plugin->getPluginList('Handle');
        usort($handler_list, array($this, "_handler_sort_callback"));

        return $handler_list;
    }

    /**
     *  sort callback method
     */
    public static function _handler_sort_callback($a, $b)
    {
        return strcmp($a->getId(), $b->getId());
    }
    // }}}

    // {{{ getEthnaController
    /**
     *  Ethna_Controllerのインスタンスを取得する
     *  (Ethna_Commandの文脈で呼び出されることが前提)
     *
     *  @access public
     *  @static
     */
    public static function getEthnaController()
    {
        return Ethna_Controller::getInstance();
    }
    // }}}

    // {{{ getAppController
    /**
     *  アプリケーションのコントローラファイル/クラスを検索する
     *
     *  @access public
     *  @static
     */
    public static function getAppController($app_dir = null)
    {
        static $app_controller = array();

        if (isset($app_controller[$app_dir])) {
            return $app_controller[$app_dir];
        } else if ($app_dir === null) {
            return Ethna::raiseError('$app_dir not specified.');
        }

        $ini_file = null;
        while (is_dir($app_dir)) {
            if (is_file("$app_dir/.ethna")) {
                $ini_file = "$app_dir/.ethna";
                break;
            }
            $app_dir = dirname($app_dir);
            if (Ethna_Util::isRootDir($app_dir)) {
                break;
            }
        }

        if ($ini_file === null) {
            return Ethna::raiseError('no .ethna file found');
        }
        
        $macro = parse_ini_file($ini_file);
        if (isset($macro['controller_file']) == false
            || isset($macro['controller_class']) == false) {
            return Ethna::raiseError('invalid .ethna file');
        }
        $file = $macro['controller_file'];
        $class = $macro['controller_class'];

        $controller_file = "$app_dir/$file";
        if (is_file($controller_file) == false) {
            return Ethna::raiseError("no such file $controller_file");
        }

        include_once $controller_file;
        if (class_exists($class) == false) {
            return Ethna::raiseError("no such class $class");
        }

        $global_controller = $GLOBALS['_Ethna_controller'];
        $app_controller[$app_dir] = new $class(GATEWAY_CLI);
        $GLOBALS['_Ethna_controller'] = $global_controller;
        Ethna::clearErrorCallback();

        return $app_controller[$app_dir];
    }
    // }}}

    // {{{ getMasterSetting
    /**
     *  Ethna 本体の設定を取得する (ethnaコマンド用)
     *
     *  @param  $section    ini ファイルの section
     *  @access public
     */
    public static function getMasterSetting($section = null)
    {
        static $setting = null;
        if ($setting === null) {
            $ini_file = ETHNA_BASE . "/.ethna";
            if (is_file($ini_file) && is_readable($ini_file)) {
                $setting = parse_ini_file($ini_file, true);
            } else {
                $setting = array();
            }
        }

        if ($section === null) {
            return $setting;
        } else if (array_key_exists($section, $setting)) {
            return $setting[$section];
        } else {
            $array = array();
            return $array;
        }
    }
    // }}}

    public function separateArgList($arg_list)
    {
        $my_arg_list = array();

        //  はじめの引数に - が含まれていたら、
        //  それを $my_arg_list に入れる
        //  これは --version 判定のため
        for ($i = 0; $i < count($arg_list); $i++) {
            if ($arg_list[$i]{0} == '-') {
                // assume this should be an option for myself
                $my_arg_list[] = $arg_list[$i];
            } else {
                break;
            }
        }
        $arg_list = array_slice($arg_list, $i);

        return array($my_arg_list, $arg_list);

    }
}
// }}}
