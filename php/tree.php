<?php
/**
 * 部署ツリー作成用スクリプト
 */

function makeTree($parintId, $orgs)
{
    $tree = [];
    for($i=0;$i<count($orgs);) {
        $org = $orgs[$i];
        if($org[2] == $parintId) {
            $child = [
                $org[1] => [
                    'id'    => $org[0],
                    'child' => []
                ]
            ];
            array_splice($orgs, $i, 1);
            //array_push($child[$org[1]]['child'], makeTree([], $org[0], $orgs));
            //array_push($tree, $child);
            $child[$org[1]]['child'] += makeTree($org[0], $orgs);
            $tree += $child;
        } else {
            $i++;
        }
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
