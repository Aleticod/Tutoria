<?php 

namespace App;

class ProcessArrayTutor extends ProcessArray {
    protected $arrayRestult = [];

    public function removeHeader () : array {
        
        array_splice($this->array, 0, 1);

        if (count($this->array[0]) === 3) {
            $arrayLength = ProcessArrayTutor::arrayLength();
            for($i = 0; $i < $arrayLength; $i++) {
                array_splice($this->array[$i], 0, 1);
            }
        }
        return $this->array;
    }
}