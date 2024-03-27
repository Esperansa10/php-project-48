<?php

namespace MyApp\Differ; 

function genDiff($file1, $file2) {

  $key = ''; 
  $value = ''; 
  $compare = ''; 

  $result[] = [
    'key' => $key,
    'value' => $value,
    'compare' => $compare
  ]; ; 

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

        $result[] = [
          'key' => $key, 
          'value' => $value, 
          'compare' => '+']; 
     
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


// ksort($result['key']);
print_r($result); 
}