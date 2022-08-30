<?php 

namespace App;
require_once __DIR__.'/interfaces/DistributionInterface.php';

class DistributionTutorship implements Distribution {
    private $tutors;
    private $students;
    private $tutorship = [];

    public function __construct(array $tutors, array $students) {
        $this->tutors = $tutors;
        $this->students = $students;
    }

    public function emptyTutorship() {
        foreach($this->tutors as $tutor) {
            $this->tutorship[$tutor[0]] = [];
        }
        return $this->tutorship;
    }

    public function distribution() : array {

        while(count($this->students) > 0) {
            foreach($this->tutorship as $tutor=>$tutorsStudents) {
                $codeStudent = array_key_first($this->students);
                array_push($this->tutorship[$tutor], $this->students[$codeStudent][0]);
                array_splice($this->students[$codeStudent], 0, 1);
                if(count($this->students[$codeStudent]) == 0) {
                    unset($this->students[$codeStudent]);
                }
                if(count($this->students) == 0) {
                    break;
                }
            }
        }
        return $this->tutorship;
    }
    
}