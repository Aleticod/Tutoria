<?php 

use PHPUnit\Framework\TestCase;
use App\BalanceTutorship;

class BalanceTest extends TestCase {

    public function testBalancedTutorship() {

        $tutorship = [
            'Docente #1' => [
                        ['165756','ACHAHUANCO-ACHAHUI-EURID'],
                        ['185435','ACHAHUANCO-VALENCIA-ANDR'],
            ],
            'Docente #2' => [
                        ['195757','ACHAHUANCO-ACHAHUI-EURID'],
                        ['28045','ACHAHUANCO-VALENCIA-ANDR'],
                        ['163456','PFOCCORI-QUISPE-ALEX'],
                        ['40567','PFOCCORI-QUISPE-ALEX'],
                        ['194564','PFOCCORI-QUISPE-ALEX'],
            ],
            'Docente #3' => [
                ['195757','ACHAHUANCO-ACHAHUI-EURID'],
                ['28045','ACHAHUANCO-VALENCIA-ANDR'],
                ['163456','PFOCCORI-QUISPE-ALEX'],

            ],
            'Docente #4' => [
                ['195757','ACHAHUANCO-ACHAHUI-EURID'],
                ['28045','ACHAHUANCO-VALENCIA-ANDR'],
                ['163456','PFOCCORI-QUISPE-ALEX'],
                ['40567','PFOCCORI-QUISPE-ALEX'],
             ],
        ];

        $newStudents = [
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

        $sut = new BalanceTutorship($tutorship, $newStudents);
        $numberStudents = $sut->calculateTotalStudents();
        //var_dump($numberStudents);
        $this->assertEquals(2,$numberStudents['Docente #1']);
        $this->assertEquals(5,$numberStudents['Docente #2']);
        $this->assertEquals(3,$numberStudents['Docente #3']);
        $this->assertEquals(4,$numberStudents['Docente #4']);
        //var_dump(max($numberStudents));
        $balancedTutorship = $sut->balance();
        //var_dump($balancedTutorship);
        $this->assertEquals(7, count($balancedTutorship['Docente #1']));
        $this->assertEquals(6, count($balancedTutorship['Docente #4']));
    }
}