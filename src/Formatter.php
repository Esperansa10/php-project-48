<?php

namespace MyApp\Formatter;


function format($result, $format)
{
    // dd($result); 
    if ($format === 'stylish') {

        foreach ($result as $arr) {

            $key = $arr['key'];
            $value = $arr['value'];
            $compare = $arr['compare'];
        
if (is_array($value)) {
//  dd($value); 
    $value = implode("\n", $value); 
    dd($value); 
}

            if ($arr['compare'] === 'added') {
                $compare = '+';
                $diff[] = ' '. $compare . ' ' . $key  . ': '. $value;
            } elseif ($arr['compare'] === 'deleted') {
                $compare = '-';
                $diff[] = ' '. $compare . ' ' . $key  . ': '. $value;
            } else {
                $compare = 'changed';
                
                $diff[] = ' '. $compare . ' ' . $key  . ': '. $value;
            };
    
        };

    $diff = implode("\n", $diff);
    $result = "{ \n" . $diff . "\n}";

    } else { $result = 'format no stylish';  }
    
    // print_r($result);
    // die; 
    return $result;
}
