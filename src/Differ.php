<?php

namespace MyApp\Differ;

function genDiff($file1, $file2)
{

  $result = [];

  $arr1 = json_decode($file1, true);
  $arr2 = json_decode($file2, true);


  foreach ($arr1 as $key => $value) {

    if (array_key_exists($key, $arr2)) {

      if ($arr1[$key] === $arr2[$key]) {

        $result[] = [
          'key' => $key,
          'value' => $value,
          'compare' => ''
        ];
      } else {

        $result[] = [
          'key' => $key,
          'value' => $arr1[$key],
          'compare' => '-'
        ];

        $result[] = [
          'key' => $key,
          'value' => $arr2[$key],
          'compare' => '+'
        ];
      }
    } else {
      $result[] = [
        'key' => $key,
        'value' => $value,  //false не выводится, но это ок
        'compare' => '-'
      ];
    }
  }

  foreach ($arr2 as $key => $value) {

    if (!array_key_exists($key, $arr1)) {

      $result[] = [
        'key' => $key,
        'value' => $value, // true не выводится в $value, но это ок
        'compare' => ''
      ];
    }
  }

  array_multisort(
    $result,
    SORT_ASC,
    SORT_REGULAR,
  ); 

  foreach  ($result as $arr) { // заходим в массив разбираем по внутр. массивам
  echo $arr['compare'] . ' ';
  echo $arr['key'] . ': ';  
  echo $arr['value'];
  echo PHP_EOL;
  }
  
}
