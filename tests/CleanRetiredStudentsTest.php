<?php 

use PHPUnit\Framework\TestCase;
use App\CleanTutorship;

class CleanRetiredStudentsTest extends TestCase {

    public function testCleanningTutorship () {
        $retiredStudents = [
            ['194567','ACHAHUANCO-ACHAHUI-EURID'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
        ];

        $tutorship = [
            'Docente #1' => [
                        ['165756','ACHAHUANCO-ACHAHUI-EURID'],
                        ['185435','ACHAHUANCO-VALENCIA-ANDR'],
                        ['203455','PFOCCORI-QUISPE-ALEX'],
                        ['194567','PFOCCORI-QUISPE-ALEX'],
                        ['228956','PFOCCORI-QUISPE-ALEX'],
            ],
            'Docente #2' => [
                        ['195757','ACHAHUANCO-ACHAHUI-EURID'],
                        ['28045','ACHAHUANCO-VALENCIA-ANDR'],
                        ['163456','PFOCCORI-QUISPE-ALEX'],
                        ['40567','PFOCCORI-QUISPE-ALEX'],
                        ['194564','PFOCCORI-QUISPE-ALEX'],
            ]
        ];

        $sut = new CleanTutorship($tutorship, $retiredStudents);
        $cleanTutorship = $sut->cleaningTutorship();
        //var_dump($cleanTutorship);

        $this->assertEquals(4, count($cleanTutorship['Docente #1']));
        $this->assertEquals(3, count($cleanTutorship['Docente #2']));
    }
}