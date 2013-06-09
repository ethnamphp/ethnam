<?php
/**
 *  Abstract.php
 *
 *  @author     Sotaro Karasawa <sotaro.k /at/ gmail.com>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

// {{{ Ethna_Plugin_Abstract
/**
 *  The abstract class of all plugins.
 *
 *  @author     Sotaro Karasawa <sotaro.k /at/ gmail.com>
 *  @access     public
 *  @package    Ethna
 */
// abstract class Ethna_Plugin_Abstract
class Ethna_Plugin_Abstract
{
    /**#@+
     *  @access private
     */

    /** @var    object  Ethna_Controller    Controller Object */
    var $controller;
    var $ctl; /* Alias */

    /** @var    object  Ethna_Backend       Backend Object */
    var $backend;

    /** @var    object  Ethna_Config        設定オブジェクト */
    var $config;

    /** @var    object  Ethna_Logger        ログオブジェクト */
    var $logger;

    /**#@-*/
    /**
     *  Constructor
     *
     *  @access public
     *  @param  object  Ethna_Controller    &$controller    Controller Object
     */
    function __construct($controller)
    {
        $this->controller = $controller;
        $this->ctl = $this->controller;

        $this->backend = $this->controller->getBackend();

        $this->logger = $controller->getLogger();
        $this->config = $controller->getConfig();
    }

}
