#!/usr/bin/python
# -*- coding: utf-8 -*-

# version Python3.4
# 全角文字を2文字として幅を数える関数

import unicodedata

def count_word_width(word):
    width = 0
    for w in word:
        if unicodedata.east_asian_width(w) is 'W':
            width += 2
        else:
            width += 1
    return width
