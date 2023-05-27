<?php

// CSVファイルを読み込み、配列に変換
function readCSV($file) {
    $file = fopen($file, "r");
    $result = [];
    while (($data = fgetcsv($file)) !== FALSE) {
        $result[] = $data[0];
    }
    fclose($file);
    return $result;
}

// URL一覧を取得
$urls1 = readCSV('sitemap1.csv');
$urls2 = readCSV('sitemap2.csv');

// 各URL一覧の差分を取得
$uniqueTo1 = array_diff($urls1, $urls2);
$uniqueTo2 = array_diff($urls2, $urls1);

// 差分をマージ
$diff = array_merge($uniqueTo1, $uniqueTo2);

// 新しいCSVファイルに保存
$file = fopen('diff.csv', 'w');
foreach ($diff as $url) {
    fputcsv($file, [$url]);
}
fclose($file);

echo "Done!\n";