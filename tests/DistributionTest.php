<?php 

use PHPUnit\Framework\TestCase;
use App\DistributionTutorship;

class DistributionBalancedTest extends TestCase {

    public function testDistributionBalancedTutorship() {
        $tutors = [
            ['Docente #1', 'docente 1'], 
            ['Docente #2', 'docente 3'], 
            ['Docente #3', 'docente 4'], 
           
        ];

        $students = [
            '10' => [
                ['104567','ACHAHUANCO-ACHAHUI-EURID'],
                ['100455','ACHAHUANCO-VALENCIA-ANDR'],
                ['104564','PFOCCORI-QUISPE-ALEX'],
            ],
            '15' => [
                ['154567','ACHAHUANCO-ACHAHUI-EURID'],
                ['150455','ACHAHUANCO-VALENCIA-ANDR'],
                ['154564','PFOCCORI-QUISPE-ALEX'],
            ],
             '20' => [
                 ['204567','ACHAHUANCO-ACHAHUI-EURID'],
             ],
            '22'=> [
                ['220455','ACHAHUANCO-VALENCIA-ANDR'],
                ['224567','ACHAHUANCO-ACHAHUI-EURID'],
                ['220455','ACHAHUANCO-VALENCIA-ANDR'],
                ['224545','PFOCCORI-QUISPE-ALEX'],
            ],
        ];

        $sut = new DistributionTutorship($tutors, $students);
        $emptyTutorship = $sut->emptyTutorship();
        //var_dump($emptyTutorship);

        $this->assertEquals(3, count($emptyTutorship));

        $distributedTutorship = $sut->distribution();
        var_dump($distributedTutorship);
        $this->assertEquals(4, count($distributedTutorship['Docente #1']));
        $this->assertEquals(3, count($distributedTutorship['Docente #3']));

    }
}