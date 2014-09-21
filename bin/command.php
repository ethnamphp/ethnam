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
$version = <<<EOD
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

require_once __DIR__ . '/../bootstrap.php';

// fetch arguments
$opt = new Ethna_Getopt();
$arg_list = $opt->readPHPArgv();
if (Ethna::isError($arg_list)) {
    echo $arg_list->getMessage()."\n";
    exit(2);
}
array_shift($arg_list);  // remove "command.php"

$eh = new Ethna_Handle();
if ($dot_ethna = getenv('DOT_ETHNA')) {
    $app_controller = Ethna_Handle::getAppController(dirname($dot_ethna));
}


//  はじめの引数に - が含まれていればそれを分離する
//  含まれていた場合、それは -v|--version でなければならない
list($my_arg_list, $arg_list) = $eh->separateArgList($arg_list);
$r = $opt->getopt($my_arg_list, "v", array("version"));
if (Ethna::isError($r)) {
    $id = 'help';
} else {
    // ad-hoc:(
    foreach ($r[0] as $opt) {
        if ($opt[0] == "v" || $opt[0] == "--version") {
            printf($version, ETHNA_VERSION, PHP_VERSION, date('Y'));
            exit(2);
        }
    }
}

if (count($arg_list) == 0) {
    $id = 'help';
} else {
    $id = array_shift($arg_list);
}

$handler = $eh->getHandler($id);
$handler->eh = $eh;
if (Ethna::isError($handler)) {
    printf("no such command: %s\n\n", $id);
    $id = 'help';
    $handler = $eh->getHandler($id);
    $handler->eh = $eh;
    if (Ethna::isError($handler)) {
       exit(1);  //  should not happen.
    }
}

// don't know what will happen:)
$handler->setArgList($arg_list);
$r = $handler->perform();
if (Ethna::isError($r)) {
    printf("error occured w/ command [%s]\n  -> %s\n\n", $id, $r->getMessage());
    if ($r->getCode() == 'usage') {
        $handler->usage();
    }
    exit(1);
}
