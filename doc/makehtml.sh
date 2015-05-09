#!/bin/bash

test -d html || mkdir html

for i  in *.md
do
    ./convert.php $i html
done
