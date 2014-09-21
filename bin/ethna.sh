#!/bin/sh
#
#   ethna.sh
#
#   simple command line gateway
#
#
THIS_DIR=$(cd $(dirname $0); pwd)
CUR_DIR="$PWD"
PHP_COMMAND="php"

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

DOT_ETHNA=$DOT_ETHNA $PHP_COMMAND -d html_errors=off -d error_reporting="E_ALL & ~E_DEPRECATED" -qC $ETHNA_HOME/bin/ethna_handle.php $*
