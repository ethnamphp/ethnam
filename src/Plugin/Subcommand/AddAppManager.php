<?php
/**
 *  AddAppManager.php
 *
 *  @author     nozzzzz <nozzzzz@gmail.com>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id$
 */

// {{{ Ethna_Plugin_Subcommand_AddAppManager
/**
 *  add-app-manager handler
 *
 *  @author     nozzzzz <nozzzzz@gmail.com>
 *  @access     public
 *  @package    Ethna
 */
class Ethna_Plugin_Subcommand_AddAppManager extends Ethna_Plugin_Subcommand_Base
{
    /**
     *  add app-manager
     *
     *  @access public
     */
    function perform()
    {
        return $this->_perform('AppManager');
    }

    /**
     *  get handler's description
     *
     *  @access public
     */
    function getDescription()
    {
        return <<<EOS
add new app-manager to project:
    {$this->id} [-b|--basedir=dir] [app-manager name]

EOS;
    }

    /**
     *  get usage
     *
     *  @access public
     */
    function getUsage()
    {
        return <<<EOS
ethna {$this->id} [-b|--basedir=dir] [app-manager name]
EOS;
    }
}
// }}}
