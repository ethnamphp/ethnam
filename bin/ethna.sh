#!/bin/sh
#
#   ethna.sh
#
#   simple command line gateway
#
#
THIS_DIR=$(cd $(dirname $0); pwd)
ETHNA_HOME=$(dirname $THIS_DIR)
CUR_DIR="$PWD"

if test -z "$ETHNA_HOME"
then
    while [ 1 ];
    do
        if test -f ".ethna"
        then
            if test -f "$PWD""/lib/Ethna/Ethna.php"
            then
                ETHNA_HOME="$PWD""/lib/Ethna"
                DOT_ETHNA="$PWD""/.ethna"
                break
            fi
        fi
        cd ..
    done
fi

cd $CUR_DIR

if test -z "$PHP_COMMAND"
then
    if test "@PHP-BIN@" = '@'PHP-BIN'@'
    then
        PHP_COMMAND="php"
    else
        PHP_COMMAND="@PHP-BINARY@"
    fi
    export PHP_COMMAND
fi

if test -z "$PHP_CLASSPATH"
then
    PHP_CLASSPATH="$ETHNA_HOME/src"
    export PHP_CLASSPATH
fi

DOT_ETHNA=$DOT_ETHNA $PHP_COMMAND -d html_errors=off -d error_reporting="E_ALL & ~E_DEPRECATED" -qC $ETHNA_HOME/bin/ethna_handle.php $*
