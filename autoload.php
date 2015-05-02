<?php

/**
 *  Ethna_* クラス群のオートロード
 */
spl_autoload_register(function($className){
    //Ethnaクラス
    if ($className === 'Ethna') {
        include_once __DIR__ . '/src/Ethna.php';
    }

    if (strpos($className, 'Ethna_Command') === 0 ||
        strpos($className, 'Ethna_Plugin_Subcommand') === 0 ||
        strpos($className, 'Ethna_Plugin_Generator') === 0 ||
        strpos($className, 'Ethna_Generator') === 0
    ) {
        //skip
        return;
    }

    //Ethna_*クラス
    //単純に_区切りをディレクトリ区切りにマッピングする
    if (strpos($className, 'Ethna_') === 0) {
        $separated = explode('_', $className);
        array_shift($separated);  // remove first element
        //読み込み失敗しても死ぬ必要はないのでrequireではなくincludeする
        //see http://qiita.com/Hiraku/items/72251c709503e554c280
        include_once __DIR__ . '/src/' . join('/', $separated) . '.php';
    }
});
