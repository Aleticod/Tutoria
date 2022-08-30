<?php 

use PHPUnit\Framework\TestCase;
use App\ProcessArrayStudent;
use App\ProcessArrayTutor;
use App\ProcessArrayTutorship;

class ProcessArrayTest extends TestCase {
    
    public function testGroupByCodeStudents (){
        /*
        $arrayStudents = [['#', 'code','nombres'],
                        ['1','194567','ACHAHUANCO-ACHAHUI-EURID'],
                        ['2','28045','ACHAHUANCO-VALENCIA-ANDR'],
                        ['3','194564','PFOCCORI-QUISPE-ALEX'],
                        ['4','40567','PFOCCORI-QUISPE-ALEX'],
                        ['5','228956','PFOCCORI-QUISPE-ALEX'],
                    ];
        */
        $arrayStudents = [['code','nombres'],
            ['194567','ACHAHUANCO-ACHAHUI-EURID'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
            ['228956','PFOCCORI-QUISPE-ALEX'],
        ];         

        $sut = new ProcessArrayStudent($arrayStudents);
        $groupedArray = $sut->groupByCode();
        $this->assertArrayHasKey('19',$groupedArray, 'It has not');
        $this->assertArrayHasKey('2',$groupedArray, 'It has not');
        $this->assertArrayHasKey('4',$groupedArray, 'It has not');
        $this->assertArrayHasKey('22',$groupedArray, 'It has not');
        $this->assertEquals(6,$sut->arrayLength());
        $this->assertEquals(2, count($groupedArray['19']) );
        

    }

    public function testGroupByCodeTutors () {
        $arrayTutorship = [['code','nombres'],
            ['Docente #1','BORIS CHULLO LLAVE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
            ['228956','PFOCCORI-QUISPE-ALEX'],
            ['Docente #2','CARLOS RAMON QUISPE ONOFRE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
        ];

        $sut = new ProcessArrayTutorship($arrayTutorship);
        $groupedArray = $sut->groupByTutor();
        $this->assertArrayHasKey('Docente #1',$groupedArray, 'It has not');
        $this->assertArrayHasKey('Docente #2',$groupedArray, 'It has not');
        $this->assertEquals(10,$sut->arrayLength());
        $this->assertEquals(4, count($groupedArray['Docente #1']) );
        $this->assertEquals(3, count($groupedArray['Docente #2']) );

    }

    public function testExtractStudentsFromTutorship () {
        $arrayTutorship = [['code','nombres'],
            ['Docente #1','BORIS CHULLO LLAVE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
            ['228956','PFOCCORI-QUISPE-ALEX'],
            ['Docente #2','CARLOS RAMON QUISPE ONOFRE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
        ];

        $sut = new ProcessArrayTutorship($arrayTutorship);
        $students = $sut->extractStudents();
        $this->assertEquals(7, count($students));
        $this->assertEquals(2, count($students[0]));
    }

    public function testExtractTutorsFromTutroship() {
        $arrayTutorship = [['code','nombres'],
            ['Docente #1','BORIS CHULLO LLAVE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
            ['228956','PFOCCORI-QUISPE-ALEX'],
            ['Docente #2','CARLOS RAMON QUISPE ONOFRE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
        ];

        $sut = new ProcessArrayTutorship($arrayTutorship);
        $tutors = $sut->extractTutors();
        //var_dump($tutors);
        $this->assertEquals(2, count($tutors));
        $this->assertEquals(2, count($tutors[0]));
    }
}