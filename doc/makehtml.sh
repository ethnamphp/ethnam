#!/bin/bash

set -e
rm html -rf
mkdir html

for i  in *.md
do
    ./convert.php $i html
done
