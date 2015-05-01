#!/usr/bin/env php
<?php
/**
 *  Ethna Command
 *
 */
 // suppose this file is located at 'project/vendor/dqneo/ethnam/bin/command.php'
$binDir = __DIR__;
$ethnamDir = $binDir . '/..';
$vendorDir = $ethnamDir . '/../..'; // 'project/vendor'

require_once  $vendorDir . '/autoload.php';

$handle = new Ethna_Command();
$handle->run();
