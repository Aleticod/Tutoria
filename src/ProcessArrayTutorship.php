<?php 

namespace App;
require_once __DIR__.'/interfaces/TutorshipInterface.php';
require_once __DIR__.'/interfaces/NormalizeTutorshipInterface.php';

class ProcessArrayTutorship extends ProcessArray implements Tutorship, NormalizeTutorship {

    public function extractStudents() : array{
        $arrayLength = ProcessArrayTutorship::arrayLength();
        for($i = 1; $i < $arrayLength; $i++) {
            if(strlen($this->array[$i][0]) <=6) {
                array_push($this->arrayResult, $this->array[$i]);
            }
        }
        return $this->arrayResult;
    }

    public function extractTutors() : array{
        $arrayLength = ProcessArrayTutorship::arrayLength();
        for($i = 1; $i < $arrayLength; $i++) {
            if(strlen($this->array[$i][0]) > 6) {
                array_push($this->arrayResult, $this->array[$i]);
            }
        }
        return $this->arrayResult;

    }

    public function groupByTutor() : array{

        if(count($this->array[0]) === 2) {
            $arrayLength = ProcessArrayTutorship::arrayLength();
            $countIndex = 1;
            while($countIndex < $arrayLength) {
                $tutorCode = $this->array[$countIndex][0];
                $auxArray = [];
                $countIndex++;
                while(strlen($this->array[$countIndex][0]) <= 6) {
                    array_push($auxArray,$this->array[$countIndex]);
                    $countIndex++;
                    if ($countIndex >= $arrayLength) {
                        break;
                    }
                }
                $this->arrayResult[$tutorCode] = $auxArray;
            }  
        }
        return $this->arrayResult;
    }

}