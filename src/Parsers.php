<?php

namespace MyApp\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse($file, $fileFormat)
{

    if ($fileFormat === 'json') {
        $arr1 = json_decode($file, true);
    } elseif ($fileFormat === 'yml' or $fileFormat === 'yaml') {
        $arr1 = Yaml::parse($file, Yaml::PARSE_OBJECT_FOR_MAP);
        // print_r($arr1); 
        // die; 
        $arr1 = json_decode(json_encode($arr1), true);
        
    } else {
        $arr1 = ['неизвестный формат '];
    }



// в зависимости от формата, возвращать данные из json или yml массивом.
    return $arr1;
}
