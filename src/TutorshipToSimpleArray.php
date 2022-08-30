<?php 

namespace App;

class TutorshipToSimpleArray{
    private $tutors;
    private $tutorship;
    private $simpleTutorship = [];

    public function __construct (array $tutorship, array $tutors) {
        $this->tutorship = $tutorship;
        $this->tutors = $tutors;
    }

    public function convertToSimple() {
        $auxCount = 0;
        foreach($this->tutorship as $tutorCod=>$students) {
            array_push($this->simpleTutorship,$this->tutors[$auxCount]);
            foreach($students as $student) {
                array_push($this->simpleTutorship, $student);
            }
          
            $auxCount++;
        }
        return $this->simpleTutorship;
    }

}