<?php
/**
 *  ethna_handle.php
 *
 *  Ethna Handle Gateway
 *
 *  @author     Masaki Fujimoto <fujimoto@php.net>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 */

 // suppose this file is located at 'project/vendor/dqneo/ethnam/bin/command.php'
$binDir = __DIR__;
$ethnamDir = $binDir . '/..';
$vendorDir = $ethnamDir . '/../..'; // 'project/vendor'

require_once  $vendorDir . '/autoload.php';

$handle = new Ethna_Command();
$handle->run();
