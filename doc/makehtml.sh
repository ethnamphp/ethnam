#!/bin/bash

set -e
target_dir=~/src/github.com/DQNEO/ethnamdoc

( cd $target_dir && rm *.html )

for i  in *.md
do
    ./convert.php $i $target_dir
done

cd $target_dir
