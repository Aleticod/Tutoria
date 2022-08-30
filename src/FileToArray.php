<?php
namespace App;
require __DIR__.'/interfaces/ConvertFileToArrayInterface.php';

class FileToArray implements ConvertFileToArray {

    private $fileName = null;
    private $arrayFromFile = null;
    private $arraySeparated = [];

    public function __construct($fileName) {
        $this->fileName = $fileName;
    }

    public function csvToArray() : array {
        $this->arrayFromFile = file($this->fileName);

        return $this->arrayFromFile;
    }

    public static function stringToArray(string $string) : array {
        return explode(',', $string);
    }

    public function eachRowToArray() : array {
        foreach (FileToArray::csvToArray() as $row) {
            array_push($this->arraySeparated, FileToArray::stringToArray($row));
        }

        return $this->arraySeparated;
    }
}