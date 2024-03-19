<?php

namespace MyApp\Differ; 

function genDiff($file1, $file2) {

  $arr1 = json_decode($file1, true); 
  $arr2 = json_decode($file2, true); 
  
  
foreach($arr1 as $key => $value) {
  if (array_key_exists($key, $arr2)) { 
    if ($arr1[$key] === $arr2[$key]) {
      echo $key . ': ' . $arr1[$key] . "\n" ; 
    }
    else {
      echo '- ' . $key. ': ' . $arr1[$key]."\n" ;
      echo'+ ' . $key. ': ' . $arr2[$key]. "\n" ;
    } 

  }
  else {
    echo '- ' . $key. ': ' . $arr1[$key]."\n" ;
  }
}

foreach($arr2 as $key => $value) {
  if (!array_key_exists($key, $arr1)) {
    echo '+ ' . $key. ': ' . $arr2[$key]."\n" ;
  }
  
}

die; 



// print_r(json_encode($diff)); 
}