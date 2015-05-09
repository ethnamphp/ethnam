#!/bin/bash

set -e
target_dir=~/src/github.com/DQNEO/ethnamdoc

( cd $target_dir && rm *.html )

for i  in *.md
do
    ./convert.php $i $target_dir
done

cd $target_dir
ln README.html index.html
git add .
git commit -m "auto generated"
git push
