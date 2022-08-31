<?php 

namespace App;
require_once __DIR__.'/interfaces/TutorshipInterface.php';
require_once __DIR__.'/interfaces/NormalizeTutorshipInterface.php';

class ProcessArrayTutorship extends ProcessArray implements Tutorship, NormalizeTutorship {
    protected $arrayResultStudents = [];
    protected $arrayResultTutors= [];
    protected $arrayResultGroup = [];

    public function extractStudents() : array{
        
        $arrayLength = ProcessArrayTutorship::arrayLength();
        for($i = 1; $i < $arrayLength; $i++) {
            if(strlen($this->array[$i][0]) <=6) {
                array_push($this->arrayResultStudents, $this->array[$i]);
            }
        }
        return $this->arrayResultStudents;
    }

    public function extractTutors() : array{
        $arrayLength = ProcessArrayTutorship::arrayLength();
        for($i = 1; $i < $arrayLength; $i++) {
            if(strlen($this->array[$i][0]) > 6) {
                array_push($this->arrayResultTutors, $this->array[$i]);
            }
        }
        return $this->arrayResultTutors;

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
                $this->arrayResultGroup[$tutorCode] = $auxArray;
            }  
        }
        return $this->arrayResultGroup;
    }

}