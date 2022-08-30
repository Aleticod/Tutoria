<?php 

namespace App;
require_once __DIR__.'/interfaces/BalanceInterface.php';

class BalanceTutorship implements Balance {
    private $tutorship;
    private $newStudents;
    private $totalStudents = [];

    public function __construct(array $tutorship, array $newStudents){
        $this->tutorship = $tutorship;
        $this->newStudents = $newStudents;
    }
    public function calculateTotalStudents () {
        foreach($this->tutorship as $tutor=>$students) {
            $this->totalStudents[$tutor] = count($students);
        }
        return $this->totalStudents;
    }

    public function balance () : array {
        $max = max(BalanceTutorship::calculateTotalStudents());
        while(count($this->newStudents) > 0) {
            foreach($this->totalStudents as $tutor=>$num) {
                $dif = $max - $num;
                if(count($this->newStudents) > 0) {
                    foreach($this->newStudents as $cod=>$students) {
                        if($dif > 0) {
                            array_push($this->tutorship[$tutor], $this->newStudents[$cod][0]);
                            array_splice($this->newStudents[$cod], 0, 1);
                            $this->totalStudents[$tutor] = $this->totalStudents[$tutor]++;
                            $dif--;
                            if(count($this->newStudents[$cod]) == 0) {
                                unset($this->newStudents[$cod]);
                            }
                            // if (count($this->newStudents) == 0){
                            //     break;
                            // }
                        }
                        else {
                            break;
                        }
                    }
                }
                else {
                    break;
                }
            }
            $max++;
        }
        return $this->tutorship;
    }
}