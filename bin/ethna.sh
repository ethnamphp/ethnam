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

# vendor/bin
THIS_DIR=$(cd $(dirname $0); pwd)
VENDOR_DIR=$(dirname $THIS_DIR)
ETHNAM_DIR=${VENDOR_DIR}/dqneo/ethnam
CUR_DIR="$PWD"

cd $CUR_DIR

php -d html_errors=off -d error_reporting="E_ALL & ~E_DEPRECATED" -qC $ETHNAM_DIR/bin/command.php $*
