<?php 

namespace App;
require_once __DIR__.'/interfaces/StudentsInterface.php';

class ProcessArrayStudent extends ProcessArray implements Students {
    protected $arrayRestult = [];


    public static function currentYear() : int {
        $year = date('Y');
        $year = substr($year, 2);
        return (int) $year;
    }

    public function removeHeader () : array {
        
        array_splice($this->array, 0, 1);

        if (count($this->array[0]) === 3) {
            $arrayLength = ProcessArrayStudent::arrayLength();
            for($i = 0; $i < $arrayLength; $i++) {
                array_splice($this->array[$i], 0, 1);
            }
        }
        return $this->array;
    }

    public function groupByCode () : array {

        $firstCode = 1;
        $lastCode = ProcessArrayStudent::currentYear();

        if(count($this->array[0]) === 3) {
            for($i = $firstCode; $i <= $lastCode; $i++) {
                $aux_array = [];
                $indexCount = 1;
                $end = ProcessArrayStudent::arrayLength();
                while($indexCount < $end) {
                    if (($i < 10) && (strlen($this->array[$indexCount][1]) == 5)) {

                        if ($i == substr($this->array[$indexCount][1],0,1)) {
                            array_push($aux_array, array_slice($this->array[$indexCount],1));
                        }
                    }
                    else {
                        if($i == substr($this->array[$indexCount][1], 0, 2)) {
                            array_push($aux_array, array_slice($this->array[$indexCount],1));
                        }
                    }
                    $indexCount ++;
                }
                if (!empty($aux_array)){
                    $this->arrayResult["$i"] = $aux_array;
                }
            }
        }
        else if (count($this->array[0]) === 2){
            for($i = $firstCode; $i <= $lastCode; $i++) {
                $aux_array = [];
                $indexCount = 1;
                $end = ProcessArrayStudent::arrayLength();
                while($indexCount < $end) {
                    if (($i < 10) && (strlen($this->array[$indexCount][0]) == 5)) {

                        if ($i == substr($this->array[$indexCount][0],0,1)) {
                            array_push($aux_array, $this->array[$indexCount]);
                        }
                    }
                    else {
                        if($i == substr($this->array[$indexCount][0], 0, 2)) {
                            array_push($aux_array, $this->array[$indexCount]);
                        }
                    }
                    $indexCount ++;
                }
                if (!empty($aux_array)){
                    $this->arrayResult[$i] = $aux_array;
                }
            }
        }
        return $this->arrayResult;
    }

}