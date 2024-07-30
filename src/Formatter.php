<?php

namespace MyApp\Formatter;

use  MyApp\Formatters\Stylish;
use  MyApp\Formatters\Plain;

function format($result, $format)
{
    switch ($format) {
        case ('stylish'):
            return Stylish\format($result);
        case ('plain'):
            return Plain\format($result);
        default:
           break; 
        // return "undefined";
    }
}
