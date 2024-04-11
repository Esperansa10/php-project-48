<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use function MyApp\Differ\genDiff; 

// Класс DifferTest наследует класс TestCase
// Имя класса совпадает с именем файла
class DifferTest extends TestCase
{
    // Метод (функция), определенный внутри класса,
    // Должен начинаться со слова test
    // Ключевое слово public нужно, чтобы PHPUnit мог вызвать этот тест снаружи
    public function testJson(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $fixturesPath = __DIR__ . '/fixtures' ; 
        $file1 = $fixturesPath . '/file1.json'; 
        $file2 = $fixturesPath . '/file2.json'; 
        $expected = $fixturesPath . '/expected.txt'; 

        $this->assertStringEqualsFile($expected, genDiff($file1, $file2));
    }
}