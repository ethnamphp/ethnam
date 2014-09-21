#!/bin/sh
#
#   ethna.sh
#
#   simple command line gateway
#
#
THIS_DIR=$(cd $(dirname $0); pwd)
CUR_DIR="$PWD"

if test -z "$ETHNA_HOME"
then
    while [ 1 ];
    do
        if [[ -f ".ethna" ]] && [[ -d "$PWD""/vendor/dqneo/ethnam" ]] ; then
                ETHNA_HOME="$PWD""/vendor/dqneo/ethnam"
                DOT_ETHNA="$PWD""/.ethna"
                break
        fi
        cd ..
 
	if [ "$PWD" = "/" ]; then
	    echo ".ethna file not found"
	    exit 1
	fi

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
