<?php 

namespace App;
require_once __DIR__.'/interfaces/EnrollInterface.php';
require_once __DIR__.'/interfaces/ArrayOperationsInterface.php';

class ProcessEnroll implements Enroll, ArrayOperations {
    private $studentsInTutorship;
    private $studentsCurrentEnroll;
    private $newStudents;
    private $retiredStudents;

    public function __construct($studentsInTutorship, $studentsCurrentEnroll) {
        $this->studentsInTutorship = $studentsInTutorship;
        $this->studentsCurrentEnroll = $studentsCurrentEnroll;
    }

    public function diferenceTwoArrays(array $firstArray, array $secondArray) : array {
        $auxArray = [];
        $lengthSecondArray = count($secondArray);
        // $lengthFirstArray = count($firstArray);
        foreach($firstArray as $firstValue){
            $auxCount = 0;
            foreach($secondArray as $secondValue) {
                if($firstValue[0] != $secondValue[0]) {
                    $auxCount++;
                }
            }
            if($auxCount == $lengthSecondArray) {
                array_push($auxArray, $firstValue);
            }
        }
        return $auxArray;
    }

    public function extractNewStudents() : array {
        $this->newStudents = ProcessEnroll::diferenceTwoArrays($this->studentsCurrentEnroll, $this->studentsInTutorship);
        return $this->newStudents;
    }
    public function extractRetiredStudents() : array {
        $this->retiredStudents = ProcessEnroll::diferenceTwoArrays($this->studentsInTutorship, $this->studentsCurrentEnroll);
        return $this->retiredStudents;
    }
}