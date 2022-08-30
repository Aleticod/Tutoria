<?php 

namespace App;
require __DIR__.'/interfaces/ProcessingArrayInterface.php';

class ProcessArray implements ProcessingArray {
    protected $array = null;
    protected $arrayLength = 0;
    protected $arrayResult = [];
    
    public function __construct (array $array) {
        $this->array = $array;
    }

    public function arrayLength () : int {
        return count($this->array);
    }

    public function printArray() {

    }
}