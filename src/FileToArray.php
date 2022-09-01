<?php
namespace App;
require __DIR__.'/interfaces/ConvertFileToArrayInterface.php';

class FileToArray implements ConvertFileToArray {

    private $fileName = null;
    private $arrayFromFile = null;
    private $arraySeparated = [];

    public function cleanData () {
        $numHeader = count($this->arraySeparated[0]);
        for($i = 0; $i < count($this->arraySeparated); $i++) {
            //$this->arraySeparated[$i][$numHeader-1] = str_replace("\n","",$this->arraySeparated[$i][$numHeader-1]);
            $this->arraySeparated[$i][$numHeader-1] = trim($this->arraySeparated[$i][$numHeader-1]);
        }
    }

    public function __construct($fileName) {
        $this->fileName = $fileName;
    }

    public function csvToArray() : array {
        $this->arrayFromFile = file($this->fileName);

        return $this->arrayFromFile;
    }

    public static function stringToArray(string $string) : array {
        $string = str_replace(';',',',$string);
        return explode(',', $string);
    }

    public function eachRowToArray() : array {
        foreach (FileToArray::csvToArray() as $row) {
            array_push($this->arraySeparated, FileToArray::stringToArray($row));
        }
        FileToArray::cleanData();
        return $this->arraySeparated;
    }
}