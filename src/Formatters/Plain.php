<?php

namespace MyApp\Formatters\Plain;
use MyApp\Formatters\Plain;

function format($result){
    return     iter($result);
}

function iter($result, $acc = []) 

{
    // dump($initarr, $result); 
    // dd($result); 
    if (!is_array($result)) {
      return  toString($result); 
    }

    $result1 = array_map(
        static function ($val) use ($acc) {

            $key = $val['key'];
            // dd($key); 
            $compare = $val['compare'];

            if ($compare === 'children') {
                $value = $val['value'];
                // dd( iter($value, $key) ); 
                // dd($key); 
                
                $acc[] = $key; 
                return iter($value, $acc); 
                
                // return 'Property '. $key. format($value) . ' was added with value: ' . format($value); 

            }

            if ($compare === 'added') {
                $value = $val['value'];
              if(is_array($value)) {
                return "Property '". implode('.', $acc) . ".". $key. "' was added with value: [complex value]" ; 
                }
                return "Property '". implode('.', $acc) . ".". $key. "' was added with value: '" . iter($value) . "'" ; 
        
            }
            if ($compare === 'deleted') {
                $value = $val['value'];
                // return 'deleted';
                if(is_array($value)) {
                    return "Property '". $key. "' was removed" ; 
                    }
                    return "Property '". implode('.', $acc) . ".". $key. "' was removed " ; 
            
            }
            if ($compare === 'changed') {
                $value1 = $val['value1'];
                $value2 = $val['value2'];

                // return 'changed';
                if(is_array($value1)) {
                    return "Property '". implode('.', $acc) .".". $key. "' was updated from " . iter($value1) . " to " . iter($value2); 
                    }
                    return "Property '". implode('.', $acc) .".". $key. "' was updated from '" . iter($value1) . "' to '" . iter($value2) . "'";
            }
            if ($compare === 'unchanged') {
                $value = $val['value'];

                return 'unchanged';
            }
        },
        $result
    );
    // dd($result1); 
    
    return implode("\n", $result1); 
};

function toString($value)
{
    return strtolower(trim(var_export($value, true), "'"));
}
