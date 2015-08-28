<?php
/**
 * 部署ツリー作成用スクリプト
 */
function makeTree($parentId, $orgs)
{
    $tree = [];
    for($i=0;$i<count($orgs);) {
        $org = $orgs[$i];
        if($org[2] != $parentId) {
            $i++;
            continue;
        }
        // 子要素として追加するための配列生成
        $child = [
            $org[1] => [
                'id'    => $org[0],
                'child' => []
            ]
        ];
        // 子部署候補から削除
        array_splice($orgs, $i, 1);
        // さらに子供を再帰で追加
        $child[$org[1]]['child'] += makeTree($org[0], $orgs);
        // 全ての子供を抱えた状態で$treeに連結
        $tree += $child;
    }
    return $tree;
}

$testCase = [
    [1, "おいしんぼ", null],
    [2, "おいしん",   1],
    [3, "おいんし",   1],
    [4, "おいし",     2],
    [5, "おしい",     2],
    [6, "おし",       4],
    [7, "さぼるなよ", null],
    [8, "さぼるな",   7],
    [9, "さぼなる",   7],
    [10,"さぼる",     8]
];

echo "<pre>";
echo json_encode(makeTree(null, $testCase));
echo "</pre>";
