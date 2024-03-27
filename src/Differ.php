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

  $result = []; 

  $arr1 = json_decode($file1, true); 
  $arr2 = json_decode($file2, true); 
  
   
foreach($arr1 as $key => $value) { 
 
  if (array_key_exists($key, $arr2)) { 
    
    if ($arr1[$key] === $arr2[$key]) {
      $diff['key'] = $key; 
      $diff['value'] = $value; 
      $diff['compare'] = ''; 
    
      $result[] = $diff; 
    }
    else {

  $diff['key'] = $key; 
  $diff['value'] = $value; 
  $diff['compare'] = '-'; 

  $result[] = $diff;  

  $diff['key'] = $key; 
  $diff['value'] = $value; 
  $diff['compare'] = '+';

  $result[] = $diff;
     
    } 

  }
  else {
    
    if($arr1[$key] === false) {

      $diff['key'] = $key; 
      $diff['value'] = 'false'; 
      $diff['compare'] = '-'; 
    
      $result[] = $diff;  

      
    }
    else {


      $diff['key'] = $key; 
      $diff['value'] = $value; 
      $diff['compare'] = '-'; 
    
      $result[] = $diff;  
      
    }
    

  }
}

foreach($arr2 as $key => $value) {
  if (!array_key_exists($key, $arr1)) {
    if($arr2[$key] === true) {

      $diff['key'] = $key; 
      $diff['value'] = 'true'; 
      $diff['compare'] = '+'; 
    
      $result[] = $diff;  
    } 
    else {
    $diff[$key] = $arr2[$key]; 
    $diff['key'] = $key; 
    $diff['value'] = $value; 
    $diff['compare'] = ''; 
  
    $result[] = $diff;  
  
  }
  }
  
}


// ksort($result['key']);
print_r($result); 
}