#!/bin/bash
set -e
target_dir=~/src/github.com/DQNEO/ethnamdoc

( cd $target_dir && rm -f *.html )

for i  in *.md
do
    ./convert.php $i > $target_dir/${i%*.md}.html
done

cp -ar css $target_dir

cd $target_dir

ln README.html index.html

echo -n "git commit and push ? [y/n] "
read answer
if [[ "$answer" != "y" ]] ; then
    exit
fi

git add .
git commit -m "auto generated"
git push
