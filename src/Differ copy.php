<?php

namespace MyApp\Differ; 



function genDiff($pathToFile1, $pathToFile2) {

$diff = []; //сюда складываем разницу

$keyset1 = findKeys($pathToFile1);  //получили ключи от 1 файла
$keyset2 = findKeys($pathToFile2); //получили ключи от 2 файла

$common_keys = array_intersect_key($keyset1, $keyset2);
// print_r($common_keys); // получили общие ключи

// Array
// (
//     [host] => hexlet.io
//     [timeout] => 50
// )

$keys = array_keys($common_keys); 
// print_r($keys); // получили ключи как значение массива

// Array
// (
//     [0] => host
//     [1] => timeout
// )

//теперь надо найти такой же ключ во втором массиве и вытащить его значение. 
//надо вытащить ключ по одному
// этот ключ найти с помощью array_search($key, $pathToFile2);
$arr2 = get_object_vars($pathToFile2); // получили масси в из второго файла  

// Array
// (
//     [timeout] => 20
//     [verbose] => 1
//     [host] => hexlet.io
// )

// этот forech актуален если ключи в массиве $arr2 есть
foreach($keys as $key) {
  // echo $key; // host timeout
  if(array_key_exists($key, $arr2)){
    // echo $arr2[$key]; // выводит значения ключей которые совпадают: hexlet.io 20
    if ($arr2[$key] === $common_keys[$key] )  {  //если значения совпали
      $diff[] = $key . ': ' . $common_keys[$key]; // выводим ключ + значение в результативный массив
    }

    if($arr2[$key] !== $common_keys[$key] ) {
      // echo $arr2[$key]; //20
      // echo $common_keys[$key]; //50
      $diff[] = '+ ' . $key . ': ' . $arr2[$key]; 
      
    }   

  }
} //закончили forech 

$diffArr = array_diff($keyset1, $keyset2); 
// нашли ключи, значение по которым не совпадают
// Array
// (
//     [timeout] => 50
//     [proxy] => 123.234.53.22
//     [follow] => 
// )
// надо эти элементы записать в массив $diff с '-'

foreach ($diffArr as $key => $value) {

  if ($value === false) {
    $value = 'false'; 
  }

  $diff[] = '- ' . $key . ': ' . $value; 
}




// 1. нужно находить общий ключ
// 2. сравнивать значение этого ключа
// если значение совпадает выводить найденное значение + ключ
// если значения у кого то нет, то выводить ключ + значение со знаком -
// если оба значения есть то выводить ключ-значение со знаками + и -
print_r(json_encode($diff)); 
}; 


function findKeys($object) {
  $arr = get_object_vars($object); //преобразовали объект в массив
  // $keys = array_keys($arr); //получили ключи
  return $arr; 
  
  
}


  
  
    



