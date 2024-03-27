<?php

namespace MyApp\Differ; 

function genDiff($file1, $file2) {

  $result = []; 

  $arr1 = json_decode($file1, true); 
  $arr2 = json_decode($file2, true); 
  
   
foreach($arr1 as $key => $value) { 
 
  if (array_key_exists($key, $arr2)) { 
    
    if ($arr1[$key] === $arr2[$key]) {
      
    
      $result[] = [
      'key' => $key, 
      'value' => $value, 
      'compare' => '']; 
       
    }
    else {

      $result[] = [
        'key' => $key, 
        'value' => $value, 
        'compare' => '-']; 

  
     
    } 

  }
  else {
    
    if($arr1[$key] === false) {

      $result[] = [
        'key' => $key, 
        'value' => 'false', 
        'compare' => '-']; 

      
    }
    else {


      $result[] = [
        'key' => $key, 
        'value' => $value, 
        'compare' => '-']; 
    
     
      
    }
    

  }
}

foreach($arr2 as $key => $value) {

  //---
  if (array_key_exists($key, $arr1)) { 
    
    if ($arr2[$key] === $arr1[$key]) {
      
    }
    else {

      $result[] = [
        'key' => $key, 
        'value' => $value, 
        'compare' => '+']; 
     
    } 
  }
  //---


  if (!array_key_exists($key, $arr1)) {
    if($arr2[$key] === true) {

      $result[] = [
        'key' => $key, 
        'value' => 'true', 
        'compare' => '+']; 
    
   
    } 
    else {
      $result[] = [
        'key' => $key, 
        'value' => $value, 
        'compare' => '']; 
  
  
  }

  
  }
  
}

array_multisort(
  $result,
  SORT_ASC,
  SORT_REGULAR,
  
); 

//---
function convert_multi_array($result) {
  $out = implode("\n", array_map(function($a) {return implode(": ",$a);}, $result));
  print_r($out);
}
convert_multi_array($result) ; 
//---
// print_r($result); 

}