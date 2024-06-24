<?php

namespace MyApp\Differ;

use MyApp\Parsers;
use MyApp\Formatter;
use function Functional\sort;

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
    // dd($arr2);
    // die;

    $result = recurcion($arr1, $arr2);
    return Formatter\format($result, $format);
};

function recurcion($arr1, $arr2)
{

    $commonKeys = array_unique(array_merge(array_keys($arr1), array_keys($arr2)));

    $commonKeys = sort($commonKeys, fn ($left, $right) => strcmp($left, $right));
    

    $result = array_map(function ($key) use ($arr1, $arr2) {
 
        $value1 = $arr1[$key] ?? null;
        $value2 = $arr2[$key] ?? null;

        
        if (is_array($value1) && is_array($value2)) {

            return [
                    'key' => $key,
                    'value' => recurcion($value1, $value2),

                    'compare' => 'children' 
                  ]; 
                
                }

        if ($value2 === null) {
            return [
                'key' => $key,
                'value' => $value1,
                'compare' => 'deleted'
            ];
        }

        if ($value1 === null) {
            return [
                'key' => $key,
                'value' => $value2,
                'compare' => 'added'
            ];
        }

        if ($value1 === $value2) {
            return [
                'key' => $key,
                'value' => $value1,
                'compare' => 'unchanged'
            ];
        }
        return [
            'key' => $key,
            'value1' => $value1,
            'value2' => $value2,
            'compare' => 'changed'
        ];
    }, $commonKeys);

    return $result;
}
