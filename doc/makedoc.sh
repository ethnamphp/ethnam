#!/bin/bash
#set -e

if type gsed >/dev/null ; then
    sed=gsed
else
    sed=sed
fi

for file in *.md
do
    head -n 1 $file | grep "README" >/dev/null || $sed -i -e "1i [UP](README.md)" $file
done
