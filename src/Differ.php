<?php

namespace MyApp\Differ; 

function genDiff($file1, $file2) {

  $key = ''; 
  $value = ''; 
  $compare = ''; 

  $diff =  [
    'key' => $key,
    'value' => $value,
    'compare' => $compare
  ]; 

  $arr1 = json_decode($file1, true); 
  $arr2 = json_decode($file2, true); 
  
   
foreach($arr1 as $key => $value) { //"host": "hexlet.io",
 
  $diff['key'] = $arr1[$key]; 
  $diff['value'] = $arr1[$value]; 
  $diff['compare'] = 'test'; 

  if (array_key_exists($key, $arr2)) { 

    
    if ($arr1[$key] === $arr2[$key]) {
      // echo $key . ': ' . $arr1[$key] . "\n" ; 
      // $diff[] = $key . ': ' . $arr1[$key] . "\n" ; 
      // $diff['key'] = $arr1[$key]; 
      // $diff['value'] = $arr1[$value]; 
      // $diff['compare'] = 'test'; 
    }
    else {
      // echo '- ' . $key. ': ' . $arr1[$key]."\n" ;
      // echo'+ ' . $key. ': ' . $arr2[$key]. "\n" ;
      
    //  $diff[$key] = $arr1[$key]; 
    //  $diff[$compare] = '-'; 
    //  $diff[$key] = $arr2[$key]; 
    //  $diff[$compare] = '+'; 
     
    //   ;
      
    } 

  }
  else {
    
  //   if($arr1[$key] === false) {
  //     // echo  '- ' . $key. ': ' . "false \n" ;
  //     $diff[$key] = 'false';
  //     $diff[$compare] = '-'; 
      
  //   }
  //   else {
  //     // echo '- ' . $key. ': ' . $arr1[$key]."\n" ;
  //     $diff[$key] = $arr1[$key]; 
  //     $diff[$compare] = '-'; 
      
  //   }
    

  // }
}

// foreach($arr2 as $key => $value) {
//   if (!array_key_exists($key, $arr1)) {
//     if($arr2[$key] === true) {
//       // echo  '+ ' . $key. ': ' . "true \n" ; 
//       $diff[$key] = 'true'; 
//       $diff[$compare] = '+'; 
     
//     } 
//     else {
//     // echo '+ ' . $key. ': ' . $arr2[$key]."\n" ;
//     $diff[$key] = $arr2[$key]; 
  
//   }
//   }
  
}


// print_r(json_encode($diff)); 
// ksort($diff);
print_r($diff); 
}