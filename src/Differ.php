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
          'compare' => ' '
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
        'compare' => '+'
      ];
    }
  }


usort($result, function($a, $b) {
  if ($a['key'] == $b['key']) {
    return 0;
}
return ($a['key'] < $b['key']) ? -1 : 1;
}

);  

  foreach  ($result as $arr) { 
  $compare = $arr['compare'] . ' ';
  $key = $arr['key'] . ': ';  
  $value = $arr['value']; 
  $diff[] = $compare . $key . $value; 
};
  
$diff = implode("\n", $diff); 
  print_r("{ \n" . $diff. "\n}"); 
  }