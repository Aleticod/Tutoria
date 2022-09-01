<?php 

use PHPUnit\Framework\TestCase;
use App\ProcessEnroll;

class ProcessEnrollTest extends TestCase {

    public function testNewStudents() {
        $studentsWithTutor = [['194567','ACHAHUANCO-ACHAHUI-EURID'],
                        ['28045','ACHAHUANCO-VALENCIA-ANDR'],
                        ['194564','PFOCCORI-QUISPE-ALEX'],
                        ['40567','PFOCCORI-QUISPE-ALEX'],
                        ['228956','PFOCCORI-QUISPE-ALEX'],
            ];
        $studentsCurrentEnroll = [
                        ['225643','JUAN CARLOS CARLIN'],
                        ['28045','ACHAHUANCO-VALENCIA-ANDR'],
                        ['194564','PFOCCORI-QUISPE-ALEX'],
                        ['54334','PFOCCORI-QUISPE-ALEX'],
                        ['228956','PFOCCORI-QUISPE-ALEX'],
                        ['196467','ACHAHUANCO-ACHAHUI-EURID'],
                        ['145657','ACHAHUANCO-VALENCIA-ANDR'],
                        ['53636','PFOCCORI-QUISPE-ALEX'],
                        ['145635','ACHAHUANCO-VALENCIA-ANDR'],
                        ['536436','PFOCCORI-QUISPE-ALEX'],
        ];
        //var_dump($studentsCurrentEnroll);
        $sut = new ProcessEnroll($studentsWithTutor, $studentsCurrentEnroll);
        $newStudents = $sut->extractNewStudents();
        //echo "new students \n";
        //var_dump($newStudents);
        $this->assertEquals(7, count($newStudents));
    }

    public function testRetiredStudents() {
        $studentsWithTutor = [['194567','ACHAHUANCO-ACHAHUI-EURID'],
                        ['28045','ACHAHUANCO-VALENCIA-ANDR'],
                        ['194564','PFOCCORI-QUISPE-ALEX'],
                        ['40567','PFOCCORI-QUISPE-ALEX'],
                        ['228956','PFOCCORI-QUISPE-ALEX'],
            ];
        $studentsCurrentEnroll = [
                        ['225643','JUAN CARLOS CARLIN'],
                        ['28045','ACHAHUANCO-VALENCIA-ANDR'],
                        ['194564','PFOCCORI-QUISPE-ALEX'],
                        ['54334','PFOCCORI-QUISPE-ALEX'],
                        ['228956','PFOCCORI-QUISPE-ALEX'],
                        ['196467','ACHAHUANCO-ACHAHUI-EURID'],
                        ['145657','ACHAHUANCO-VALENCIA-ANDR'],
                        ['53636','PFOCCORI-QUISPE-ALEX'],
                        
        ];

        $sut = new ProcessEnroll($studentsWithTutor, $studentsCurrentEnroll);
        $retiredStudents = $sut->extractRetiredStudents();
        //echo "retired students \n";
        //var_dump($retiredStudents);
        $this->assertEquals(2, count($retiredStudents));
    
    }
    
}