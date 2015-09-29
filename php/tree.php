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

/**
 * treeからarrayを生成
 */
function treeToArray($orgsTree, $depth = 0)
{
    $orgs = [];
    foreach ($orgsTree as $name => $value) {
        $orgs[] = [ "name" => $name, "id" => $value['id'], "depth" => $depth];
        if (count($value['child']) !== 0) {
            $orgs = array_merge($orgs, treeToArray($value['child'], $depth + 1));
        }
    }
    return $orgs;
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

$testCase2 = [
    [1, 'アイスタイル',           null],
    [2, 'テクノロジー本部',       1],
    [3, '技術開発部',             2],
    [4, 'メディアテクノロジー部', 2],
    [5, 'デザインチーム',         3],
    [6, 'MP本部',                 1],
    [7, 'MP1部',                  6],
    [8, 'MP2部',                  6],
    [9, 'IBS',                    null],
    [10,'IBS営業部',              9],
    [11,'IBS技術開発部',          9],
    [12,'IBSデザインチーム',      11]
];
echo "<pre>";
//echo json_encode(makeTree(null, $testCase2));
$list = treeToArray(makeTree(null, $testCase2));
var_dump($list);
echo "</pre>";
