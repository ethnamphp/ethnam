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
ETHNA_HOME=$(dirname $THIS_DIR)
CUR_DIR="$PWD"
PHP_COMMAND="php"

cd $CUR_DIR

$PHP_COMMAND -d html_errors=off -d error_reporting="E_ALL & ~E_DEPRECATED" -qC $ETHNA_HOME/bin/command.php $*
