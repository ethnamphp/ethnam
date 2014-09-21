<?php
// vim: foldmethod=marker
/**
 *  Handle.php
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

require_once ETHNA_BASE . '/src/Getopt.php';

// {{{ Ethna_Plugin_Handle
/**
 *  コマンドラインハンドラプラグインの基底クラス
 *  
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @access     public
 *  @package    Ethna
 */
class Ethna_Plugin_Handle
{
    /** @protected    handler's id */
    protected $id;

    /** @protected    command line arguments */
    protected $arg_list;

    /** @protected    object  Ethna_Controller    Controller Object */
    public $controller;
    public $ctl; /* Alias */

    /** @protected    object  Ethna_Backend       Backend Object */
    public $backend;

    /** @protected    object  Ethna_Config        設定オブジェクト */
    public $config;

    /** @protected    object  Ethna_Logger        ログオブジェクト */
    public $logger;

    /**
     *  Ethna_Handle constructor (stub for php4)
     *
     *  @access public
     */
    public function __construct($controller, $type, $name)
    {
        $this->controller = $controller;
        $this->ctl = $this->controller;

        $this->backend = $this->controller->getBackend();

        $this->logger = $controller->getLogger();
        $this->config = $controller->getConfig();

        $id = $name;
        $id = preg_replace_callback('/^([A-Z])/', function($matches){
                return strtolower($matches[1]);
            }, $id);
        $id = preg_replace_callback('/([A-Z])/', function($matches){
                return '-' . strtolower($matches[1]);
                    }, $id);
        $this->id = $id;
    }

    /**
     *  get handler-id
     *
     *  @access public
     */
    function getId()
    {
        return $this->id;
    }

    /**
     *  get handler's description
     *
     *  @access public
     */
    function getDescription()
    {
        return "description of " . $this->id;
    }

    /**
     *  get handler's usage
     *
     *  @access public
     */
    function getUsage()
    {
        return "usage of " . $this->id;
    }

    /**
     *  set arguments
     *
     *  @access public
     */
    function setArgList($arg_list)
    {
        $this->arg_list = $arg_list;
    }

    /**
     * easy getopt :)
     *
     * @param   array   $lopts  long options
     * @return  array   list($opts, $args)
     * @access  protected
     */
    function _getopt($lopts = array())
    {
        // create opts
        // ex: $lopts = array('foo', 'bar=');
        $lopts = to_array($lopts);
        $sopts = '';
        $opt_def = array();
        foreach ($lopts as $lopt) {
            if ($lopt{strlen($lopt) - 2} === '=') {
                $opt_def[$lopt{0}] = substr($lopt, 0, strlen($lopt) - 2);
                $sopts .= $lopt{0} . '::';
            } else if ($lopt{strlen($lopt) - 1} === '=') {
                $opt_def[$lopt{0}] = substr($lopt, 0, strlen($lopt) - 1);
                $sopts .= $lopt{0} . ':';
            } else {
                $opt_def[$lopt{0}] = $lopt;
                $sopts .= $lopt{0};
            }
        }

        // do getopt
        // ex: $sopts = 'fb:';
        $opt = new Ethna_Getopt();
        $opts_args = $opt->getopt($this->arg_list, $sopts, $lopts);
        if (Ethna::isError($opts_args)) {
            return $opts_args;
        }

        // parse opts
        // ex: "-ff --bar=baz" gets
        //      $opts = array('foo' => array(true, true),
        //                    'bar' => array('baz'));
        $opts = array();
        foreach ($opts_args[0] as $opt) {
            $opt[0] = $opt[0]{0} === '-' ? $opt_def[$opt[0]{2}] : $opt_def[$opt[0]{0}];
            $opt[1] = $opt[1] === null ? true : $opt[1];
            if (isset($opts[$opt[0]]) === false) {
                $opts[$opt[0]] = array($opt[1]);
            } else {
                $opts[$opt[0]][] = $opt[1];
            }
        }
        $opts_args[0] = $opts;

        return $opts_args;
    }

    /**
     *  just perform
     *
     *  @access public
     */
    function perform()
    {
    }

    /**
     *  show usage
     *
     *  @access public
     */
    function usage()
    {
        echo "usage:\n";
        echo $this->getUsage() . "\n\n";
    }
}
// }}}
