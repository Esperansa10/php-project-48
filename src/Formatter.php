<?php

namespace MyApp\Formatter;

function format($result, $format)
{
    if ($format === 'stylish') {
        return  "{ \n" . iter($result) . "\n}" ; 
    } else {
        return $result = 'format no stylish';
    }
}



function iter($result, $depth = 1, $indentCount = 2, $replacer = ',')
{

    $indentSize = $depth * $indentCount;
    $indentValue = str_repeat($replacer, $indentSize);
    $indentSizeBrackets = $indentCount + 2 ; 
    $indentValueBrackets = str_repeat($replacer,  $indentSizeBrackets);
    // dd($indentValueBrackets); 
    // dd($result);

    $result1 = array_map(
        static function ($val) use ($depth, $indentValue, $indentValueBrackets, $indentSize) {

            $key = $val['key'];
            $compare = $val['compare'];

            if ($compare === 'children') {
                $value = $val['value'];
                return $indentValue . '  ' . $key  . ': {' . "\n". iter($value, $depth + 1) . "\n" . $indentValueBrackets . "}";
                // return '  ' . $key  . ': complex';
                // continue;
            }

            if ($compare === 'added') {
                $value = $val['value'];
                if (is_array($value)) {
                    $value = stringify($value, '.', $indentSize, $depth);
                }

                return $indentValue . '+ ' . $key  . ': ' . $value;
            }
            if ($compare === 'deleted') {
                $value = $val['value'];
                if (is_array($value)) {

                    $value = stringify($value, '.', $indentSize, $depth);  //2, 1
                    //  dd($indentValue); 

                }
                return $indentValue  . '- ' . $key  . ': ' . $value;
            }
            if ($compare === 'changed') {
                $value1 = $val['value1'];
                $value2 = $val['value2'];

                $value1 = '- ' . $key  . ': ' . stringify($value1, '.', $indentSize, $depth);
                $value2 = '+ ' . $key  . ': ' . stringify($value2, '.', $indentSize, $depth);
                return $indentValue . $value1 . "\n" . $indentValue . $value2;
            }
            if ($compare === 'unchanged') {
                $value = $val['value'];
                if (is_array($value)) {
                    
                    $value = stringify($value, '.', $indentSize, $depth);
                }

                return $indentValue . '  ' . $key  . ': ' . $value;
            }
        },

        $result
    );

    // dd($result1); 


    return implode("\n", $result1);
    

    


    // print_r($result);
    // die; 
    
}


function toString($value)
{
    return trim(var_export($value, true), "'");
}

function stringify(mixed $value, string $replacer = ',', int $indentCount = 1, $depth): string
{
    return stringifyiter($value, $replacer, $indentCount, $depth);
}

function stringifyiter(mixed $value, string $replacer, int $indentCount, int $depth): string
{
    // if (!is_array($value)) {
    //     return toString($value);
    // }

    $indentSize = $depth * $indentCount;
    $indentValue = str_repeat($replacer, $indentSize);
    $closeBracketIndent = str_repeat($replacer, $indentSize - $indentCount);

    if (!is_array($value)) {
        return toString($value);
    }

    $result = array_map(
        static function ($key, $val) use ($replacer, $depth, $indentValue, $indentCount) {
            return "{$indentValue}{$key}: " . stringifyiter($val, $replacer, $indentCount, $depth + 1) . "\n";
        },
        array_keys($value),
        $value
    );

    return "{\n" . implode($result) . "{$closeBracketIndent}}";
}
