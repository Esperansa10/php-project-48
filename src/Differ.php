<?php

namespace MyApp\Differ;

use MyApp\Parsers;
use MyApp\Formatter;

function getFileData($filePath)
{
    $content = file_get_contents($filePath);
    // pathinfo($filePath); //получает расширение
    $format = pathinfo($filePath)['extension'];

    return [
        'content' => $content,
        'format' => $format
    ];
}

function genDiff($file1Path, $file2Path, $format = 'stylish')
{

    $result = [];

    $fileData = getFileData($file1Path);
    $file1content = $fileData['content'];
    $file1format =  $fileData['format'];

    $fileData = getFileData($file2Path);
    $file2content = $fileData['content'];
    $file2format =  $fileData['format'];

    
    $arr1 = Parsers\parse($file1content, $file1format);
    $arr2 = Parsers\parse($file2content, $file2format);

    

    if (!is_array($arr1)) {
        print_r($arr1); 
        die; 

    }

    if (!is_array($arr2)) {
        print_r($arr2); 
        die; 

    }

    // перебираем первый массив
    foreach ($arr1 as $key => $value) {
        // если $value массив а не значение
        if(is_array($value)) {
          // если значение массив, надо в него зайти и перебрать также как массив первого уровня
          genDiff($value, $arr2[$key]); 
            }
        
        if (array_key_exists($key, $arr2)) {
            if ($arr1[$key] === $arr2[$key]) {
                $result[] = [
                'key' => $key,
                'value' => $value,
                'compare' => 'unchanged'
                ];
            } else {
                $result[] = [
                'key' => $key,
                'value' => $arr1[$key],
                'compare' => 'deleted'
                ];

                $result[] = [
                'key' => $key,
                'value' => $arr2[$key],
                'compare' => 'added'
                ];
            }
        } else {
            $result[] = [
            'key' => $key,
            'value' => $value,  //false не выводится, но это ок
            'compare' => 'deleted'
            ];
        }
    }

    // перебираем второй массив
    foreach ($arr2 as $key => $value) {
       
            // если $value массив а не значение
            if(is_array($value)) {
              // если значение массив, надо в него зайти и перебрать также как массив первого уровня
              genDiff($value, $arr1[$key]); 
            }


        if (!array_key_exists($key, $arr1)) {
            $result[] = [
            'key' => $key,
            'value' => $value, // true не выводится в $value, но это ок
            'compare' => 'added'
            ];
        }
    }


    usort($result, function ($a, $b) {
        if ($a['key'] == $b['key']) {
            return 0;
        }
        return ($a['key'] < $b['key']) ? -1 : 1;
    });

    return Formatter\format($result, $format); 
    
}


function differ($arr1, $arr2, $format = 'stylish') {
return 'hi'; 
}
