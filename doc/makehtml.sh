#!/bin/bash

set -e
target_dir=~/src/github.com/DQNEO/ethnamdoc

cd $target_dir
rm *.html
cd -

for i  in *.md
do
    ./convert.php $i $target_dir
done

cp $target_dir/README.html $target_dir/index.html
