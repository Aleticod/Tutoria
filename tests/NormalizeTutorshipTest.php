<?php 

use PHPUnit\Framework\TestCase;
use App\TutorshipToSimpleArray;

class NormalizeTutorshipTest extends TestCase {
    public function testConverTutorshipToSimpleArray() {
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

        $tutors = [
            ['Docente #1', 'docente 1'], 
            ['Docente #2', 'docente 2'], 
            ['Docente #3', 'docente 3'], 
            ['Docente #4', 'docente 4'], 
           
        ];

        $sut = new TutorshipToSimpleArray($tutorship, $tutors);
        $simpleTutorship = $sut->convertToSimple();
        //var_dump($simpleTutorship);
        $this->assertEquals(18, count($simpleTutorship));

    }

}