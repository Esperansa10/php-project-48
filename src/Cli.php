<?php

namespace MyApp\Cli; 
use Docopt; 

function printHelp() {
    $doc = <<<DOC
    Generate diff

    Usage:
      gendiff (-h|--help)
      gendiff (-v|--version)
      gendiff [--format <fmt>] <firstFile> <secondFile>
    
    Options:
      -h --help                     Show this screen
      -v --version                  Show version
      --format <fmt>                Report format [default: stylish]
    DOC;
    
    $args = Docopt::handle($doc, ['version'=>'Gendiff 1.0.', 'help'=>true]); 
    foreach ($args as $k=>$v)
    echo $k.': '.json_encode($v).PHP_EOL;
}


