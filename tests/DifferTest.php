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

    

    public function testJsonrec(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $fixturesPath = __DIR__ . '/fixtures' ; 
        $file1 = $fixturesPath . '/file1nested.json'; 
        $file2 = $fixturesPath . '/file2nested.json'; 
        $expected = $fixturesPath . '/expectedrec.txt'; 

        $this->assertStringEqualsFile($expected, genDiff($file1, $file2));
    } 

    public function testYamlrec(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $fixturesPath = __DIR__ . '/fixtures' ; 
        $file1 = $fixturesPath . '/file1nested.yml'; 
        $file2 = $fixturesPath . '/file2nested.yml'; 
        $expected = $fixturesPath . '/expectedrec.txt'; 

        $this->assertStringEqualsFile($expected, genDiff($file1, $file2));
    } 
    
    public function testYamlJsonrec(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $fixturesPath = __DIR__ . '/fixtures' ; 
        $file1 = $fixturesPath . '/file1nested.yml'; 
        $file2 = $fixturesPath . '/file2nested.json'; 
        $expected = $fixturesPath . '/expectedrec.txt'; 

        $this->assertStringEqualsFile($expected, genDiff($file1, $file2));
    } 

    public function testJsonYmlPlain(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $fixturesPath = __DIR__ . '/fixtures' ; 
        $file1 = $fixturesPath . '/file1nested.json'; 
        $file2 = $fixturesPath . '/file2nested.yml'; 
        $expected = $fixturesPath . '/expected.txt'; 

        $this->assertStringEqualsFile($expected, genDiff($file1, $file2));
    } 

    public function testYmlJsonPlain(): void
    {
        // Сначала идет ожидаемое значение (expected)
        // И только потом актуальное (actual)
        $fixturesPath = __DIR__ . '/fixtures' ; 
        $file1 = $fixturesPath . '/file1nested.yml'; 
        $file2 = $fixturesPath . '/file2nested.json'; 
        $expected = $fixturesPath . '/expected.txt'; 

        $this->assertStringEqualsFile($expected, genDiff($file1, $file2));
    } 
    
 
}