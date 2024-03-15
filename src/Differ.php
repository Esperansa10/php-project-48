<?php

namespace MyApp\Differ; 



function genDiff($pathToFile1, $pathToFile2) {

  $arr1 = json_decode($pathToFile1); 
  $arr2 = json_decode($pathToFile2); 
  
  // array_key_exists

foreach($arr1 as $key => $value) {
  if (array_key_exists($key, $arr2)) {
    $key;
  }


}




die; 





$diff = []; //сюда складываем разницу

$keyset1 = get_object_vars($pathToFile1);  //получили ключи от 1 файла
$keyset2 = get_object_vars($pathToFile2); //получили ключи от 2 файла

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

$diffArr2 = array_diff($keyset2, $keyset1);
// array(2) {
//   'timeout' =>
//   int(20)
//   'verbose' =>
//   bool(true)
// }
foreach ($diffArr2 as $key => $value) {

  if ($value === true) {
    $value = 'true'; 
  }

  $diff[] = '+ ' . $key . ': ' . $value; 
}; 



// 1. нужно находить общий ключ
// 2. сравнивать значение этого ключа
// если значение совпадает выводить найденное значение + ключ
// если значения у кого то нет, то выводить ключ + значение со знаком -
// если оба значения есть то выводить ключ-значение со знаками + и -

print_r(json_encode($diff)); 
}