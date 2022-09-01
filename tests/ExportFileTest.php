<?php 

use PHPUnit\Framework\TestCase;
use App\ExportFile;

class ExportFileTest extends TestCase {

    public function testExportToCsv() {
        $arrayTutorship = [['code','nombres'],
            ['Docente #1','BORIS CHULLO LLAVE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
            ['228956','PFOCCORI-QUISPE ALEX'],
            ['Docente #2','CARLOS RAMON QUISPE ONOFRE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
            ['228956','PFOCCORI-QUISPE ALEX'],
            ['Docente #3','CARLOS RAMON QUISPE ONOFRE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
            ['228956','PFOCCORI-QUISPE ALEX'],
            ['Docente #4','CARLOS RAMON QUISPE ONOFRE'],
            ['28045','ACHAHUANCO-VALENCIA-ANDR'],
            ['194564','PFOCCORI-QUISPE-ALEX'],
            ['40567','PFOCCORI-QUISPE-ALEX'],
        ];

        $fileName = 'tutorship.csv';

        $sut = new ExportFile($arrayTutorship, $fileName);
        $sut->exportToCsv();
    }
}