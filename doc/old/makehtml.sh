#!/bin/bash

[[ ! -d .html ]] && mkdir .html
for i in  *.md ; do ../convert.php $i > .html/${i%*.md}.html; done
