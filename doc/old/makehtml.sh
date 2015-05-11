#!/bin/bash

for i in  *.md ; do ../convert.php $i > ${i%*.md}.html; done
