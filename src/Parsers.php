<?php

namespace MyApp\Parsers;

use Symfony\Component\Yaml\Yaml;

function parse($file, $fileFormat){

    if ($fileFormat === 'json') {
        $arr1 = json_decode($file, true);
    }

    else if ($fileFormat === 'yml' OR $fileFormat === 'yaml') {
        $arr1 = Yaml::parse($file, Yaml::PARSE_OBJECT_FOR_MAP);
    }

    else $arr1 = ['неизвестный формат ']; 

   

// в зависимости от формата, возвращать данные из json или yml массивом. 
    return $arr1; 
    
}