<?php 

namespace App;
require_once __DIR__.'/interfaces/DeleteRetiredStudentsInterface.php';

class CleanTutorship implements DeleteRetiredStudents {
    private $retiredStudents;
    private $tutorship;

    public function __construct (array $tutorship, array $retiredStudents) {
        $this->retiredStudents = $retiredStudents;
        $this->tutorship = $tutorship;
    }

    public function cleaningTutorship () : array{
        foreach($this->retiredStudents as $student) {
            $tutorCount = 0;
            foreach($this->tutorship as $tutor=>$tutorStudents) {
                $studentCount = 0;
                $test = false;
                foreach($tutorStudents as $currentStudent) {
                    if($student[0] === $currentStudent[0]) {
                        array_splice($this->tutorship[$tutor], $studentCount, 1);
                        break;
                        $test = true;
                    }
                    $studentCount++;
                }
                if($test) {
                    break;
                }
            }
        }
        return $this->tutorship;
    }
}