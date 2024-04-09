<?php

namespace MyApp\Differ;

function genDiff($file1, $file2)
{

    $diff = [];

    $arr1 = json_decode($file1, true);
    $arr2 = json_decode($file2, true);


    foreach ($arr1 as $key => $value) {
        if (array_key_exists($key, $arr2)) {
            if ($arr1[$key] === $arr2[$key]) {
                // echo $key . ': ' . $arr1[$key] . "\n" ;
                // $diff[] = $key . ': ' . $arr1[$key] . "\n" ;
                $diff[$key] = $arr1[$key];
            } else {
                // echo '- ' . $key. ': ' . $arr1[$key]."\n" ;
                // echo'+ ' . $key. ': ' . $arr2[$key]. "\n" ;
                $diff['- ' . $key] = $arr1[$key];

                $diff['+ ' . $key] = $arr2[$key];
                ;
            }
        } else {
            if ($arr1[$key] === false) {
              // echo  '- ' . $key. ': ' . "false \n" ;
                $diff['- ' . $key] = 'false';
            } else {
              // echo '- ' . $key. ': ' . $arr1[$key]."\n" ;
                $diff['- ' . $key] = $arr1[$key];
            }
        }
    }

    foreach ($arr2 as $key => $value) {
        if (!array_key_exists($key, $arr1)) {
            if ($arr2[$key] === true) {
                // echo  '+ ' . $key. ': ' . "true \n" ;
                $diff['+ ' . $key] = 'true';
            } else {
              // echo '+ ' . $key. ': ' . $arr2[$key]."\n" ;
                $diff[$key] = $arr2[$key];
            }
        }
    }


// print_r(json_encode($diff));
// ksort($diff);
    print_r($diff);
}
