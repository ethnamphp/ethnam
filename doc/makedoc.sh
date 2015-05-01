#!/bin/bash
#set -e

if type gsed ; then
    sed=gsed
else
    sed=sed
fi

for file in *.md
do
    echo "file==$file"
    head -n 1 $file | grep "README" || $sed -i -e "1i hoge" $file
done
