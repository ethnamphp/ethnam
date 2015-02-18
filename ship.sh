#!/bin/bash
#
# リリース作業自動化コマンド
# 引数でバージョンを指定すると、下記のことをしてくれます。
#
# * ETHNA_VERSIONの数字を変更してコミット
# * git tag vx.y.z

set -e

prog=$(basename $0)
if [[ $# -eq 0 ]] || [[ $1 = "--help" ]] ; then
    echo "Usage: $prog <version_number>"
    echo ""
    echo "Example:  $prog 2.23.4"
    exit 1
fi

ver=$1

echo shipping version $ver ...

version_file=bootstrap.php
perl -pi -e "s/\'\d*\.\d*\.\d*\'/'$ver'/" $version_file

git add $version_file
git commit -m "bump version to $ver"
git tag v${ver}

echo ''
echo 'next, run "git push" and "git push --tags"'

