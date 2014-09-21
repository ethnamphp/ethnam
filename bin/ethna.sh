#!/bin/sh
#
#   ethna.sh
#
#   simple command line gateway
#
#

if [ "$1" = "--debug" ]; then
    set -x
    shift
fi

THIS_DIR=$(cd $(dirname $0); pwd)
CUR_DIR="$PWD"
PHP_COMMAND="php"

ETHNA_HOME=$(dirname $THIS_DIR)

cd $ETHNA_HOME

    while [ 1 ];
    do
        if [[ -f ".ethna" ]] && [[ -d "$PWD""/vendor/dqneo/ethnam" ]] ; then
                DOT_ETHNA="$PWD""/.ethna"
                break
        fi
        cd ..

	if [ "$PWD" = "/" ]; then
	    echo ".ethna file not found"
	    exit 1
	fi

   done

cd $CUR_DIR

DOT_ETHNA=$DOT_ETHNA $PHP_COMMAND -d html_errors=off -d error_reporting="E_ALL & ~E_DEPRECATED" -qC $ETHNA_HOME/bin/ethna_handle.php $*
