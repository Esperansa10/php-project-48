<?php

namespace MyApp\Formatter;


function format($result, $format)
{

    if ($format === 'stylish') {

        foreach ($result as $arr) {

            if ($arr['compare'] === 'added') {
                $compare = '+';
            } elseif ($arr['compare'] === 'deleted') {
                $compare = '-';
            } else {
                $compare = ' ';
            };
    
            $key = $arr['key'] . ': ';
            $value = $arr['value'];
            $diff[] = ' '. $compare . ' ' . $key . $value;
        };
    }
    

    $diff = implode("\n", $diff);
    $result = "{ \n" . $diff . "\n}";
    
    return $result;
}
