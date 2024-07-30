<?php
namespace MyApp\Formatters\Stylish;

const INDENT_COUNT = 4; 
const INDENT_SYMBOL = ' '; 
const COMPARE_SYMBOL_LENGTH = 2; 

function format($result){
    return     "{\n" . iter($result) . "\n}";
}

function iter($result, $depth = 1)
{

    $indentSize = $depth * INDENT_COUNT -2;
    $indentValue = str_repeat(INDENT_SYMBOL, $indentSize);
    $indentSizeBrackets = $indentSize - INDENT_COUNT + COMPARE_SYMBOL_LENGTH; 
    $indentValueBrackets = str_repeat(INDENT_SYMBOL,  $indentSizeBrackets);
    // dd($indentValueBrackets); 
    // dd($result);

    $result1 = array_map(
        static function ($val) use ($depth, $indentValue, $indentValueBrackets, $indentSize) {

            $key = $val['key'];
            $compare = $val['compare'];

            if ($compare === 'children') {
                $value = $val['value'];

                $indentSizeBrackets = $indentSize - INDENT_COUNT + COMPARE_SYMBOL_LENGTH + 4; 
                $indentValueBrackets = str_repeat(INDENT_SYMBOL,  $indentSizeBrackets);

                return $indentValue . '  ' . $key  . ': {' . "\n". iter($value, $depth + 1) . "\n" . $indentValueBrackets . "}";
                // return '  ' . $key  . ': complex';
                // continue;
            }

            if ($compare === 'added') {
               $value = $val['value'];
               $value = stringify($value, $depth+1);
                // if (is_array($value)) {
                //     $value = stringify($value, $depth+1);
                // }

                return $indentValue . '+ ' . $key  . ': ' .  $value;
            }
            if ($compare === 'deleted') {
                $value = $val['value'];
                if (is_array($value)) {
                    // dd($value); 
                    $value = stringify($value, $depth+1);  //2, 1
                    //  dd($indentValue); 

                }
                return $indentValue  . '- ' . $key  . ': ' . $value;
            }
            if ($compare === 'changed') {
                $value1 = $val['value1'];
                $value2 = $val['value2'];
                
                $value1 = '- ' . $key  . ': ' . stringify($value1, $depth+1);
                $value2 = '+ ' . $key  . ': ' . stringify($value2, $depth+1); 
                return $indentValue . $value1 . "\n" . $indentValue . $value2;
            }
            if ($compare === 'unchanged') {
                $value = $val['value'];
                if (is_array($value)) {
                    
                    $value = stringify($value, $indentSize, $depth);
                }

                return $indentValue . '  ' . $key  . ': ' . $value;
            }
        },

        $result
    );

    // dd($result1); 


    return  implode("\n", $result1);
    

    


    // print_r($result);
    // die; 
    
}


function toString($value)
{
    return strtolower(trim(var_export($value, true), "'"));
}

function stringify(mixed $value, $depth): string
{
    return stringifyiter($value, $depth);
}

function stringifyiter(mixed $value, int $depth): string
{
    // if (!is_array($value)) {
    //     return toString($value);
    // }

    $indentSize = $depth * INDENT_COUNT;
    $indentValue = str_repeat(INDENT_SYMBOL, $indentSize);
    $closeBracketIndent = str_repeat(INDENT_SYMBOL, $indentSize - INDENT_COUNT);

    if (!is_array($value)) {
        return toString($value);
    }

    $result = array_map(
        static function ($key, $val) use ($depth, $indentValue) {
            return "{$indentValue}{$key}: " . stringifyiter($val, $depth + 1) . "\n";
        },
        array_keys($value),
        $value
    );

    return "{\n" . implode($result) . "{$closeBracketIndent}}";
}
