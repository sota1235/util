#!/usr/bin/python3
# -*- coding: utf-8 -*-

# generateTreeFromTable.py
#
# Description:
#   親子構造の情報を持った一意の配列を
#   入れ子構造の連想配列へ変換する関数

# List must be
#   [[id, name, parent_id] * N]
def orgTree(orgs):
    orgTree = {}
    # 最初に親無しを全てtreeに突っ込む
    noneCount = 0
    for i in range(len(orgs)):
        if orgs[i][2] is None:
            orgTree[orgs[i][1]] = {'id': orgs[i][0], 'child': {}}
            orgs[i] = None
            noneCount += 1
    for i in range(noneCount): orgs.remove(None)
    # その後、配列がなくなるまで突っ込み続ける
    for o in orgs:
        for v in orgTree.values():
            if v['id'] == o[2]:
                v['child'][o[1]] = {'id': o[0], 'child': {}}
    print(orgTree)

# Test
testCase = [
    [1, 'アイスタイル',       None],
    [2, 'テクノロジー本部',   1],
    [3, 'クオリティ部',       1],
    [4, '営業部',             1],
    [5, '技術開発部',         2],
    [6, 'メディアテクノロジ', 2],
    [7, '技術基盤開発部',     5],
    [8, 'SS本部',             4],
    [9, 'MP本部',             4],
    [10,'アイスポット',       None],
    [11,'アイスタイルキャリア', None],
    [12,'アイスポット営業部', 10]
]
orgTree(testCase)
# Must be
# アイスタイル:
#   テクノロジー本部:
#     技術開発部
#       技術基盤開発部
#     メディアテクノロジ
#   クオリティ部
#   営業部
#     SS本部
#     MP本部
# アイスポット
#   アイスポット営業部
# アイスタイルキャリア
