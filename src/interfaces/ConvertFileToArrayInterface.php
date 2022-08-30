<?php 
namespace App;
interface ConvertFileToArray {
    public function csvToArray() : array;
    public static function stringToArray(string $string) : array;
    public function eachRowToArray() : array;
}