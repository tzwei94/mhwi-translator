<?php
$string_eng = file_get_contents("eng.json");
$string_chs = file_get_contents("chs.json");
$string_cht = file_get_contents("cht.json");
$string_jpn = file_get_contents("jpn.json");
$json_eng = json_decode($string_eng, true);
$json_chs = json_decode($string_chs, true);
$json_cht = json_decode($string_cht, true);
$json_jpn = json_decode($string_jpn, true);
$result_eng = iterate($json_eng, "eng");
$result_chs = iterate($json_chs, "chs");
$result_cht = iterate($json_cht, "cht");
$result_jpn = iterate($json_jpn, "jpn");

$final_array = mergeArray($result_eng,$result_chs);
$final_array = mergeArray($final_array,$result_cht);
$final_array = mergeArray($final_array,$result_jpn);

print_r(json_encode($final_array));die();

function iterate($json_a = [], $lang = "eng")
{
    foreach ($json_a as $key => $value) {
        $keyword = substr($value['value'], 5);
        $name = $value['label'];
        $result[] = [
            'key' => $keyword,
            $lang => $name
        ];
    }
    return $result;
}

function mergeArray($array1 = [], $array2 = [])
{
    $finalized_array = [];
    foreach($array1 as $key1 => $value1){
        foreach ($array2 as $key2 => $value2) {
            if($value1['key'] == $value2['key']){
                $finalized_array[] = array_merge($value1,$value2);
            }
        }
    }
    return $finalized_array;
}
