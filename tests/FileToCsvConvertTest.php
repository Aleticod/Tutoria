<?php 

use PHPUnit\Framework\TestCase;
use App\FileToArray;

class FileToCsvConvertTest extends TestCase {
    
    public function testCovertCsvToArray() {
        $sut = new FileToArray('./test-files/MatriculadosGeneral-2022-1.csv');
        $this->assertIsArray($sut->csvToArray(), 'It is not a array');
    }

    public function testContentInArray() {
        $sut = new FileToarray('./test-files/MatriculadosGeneral-2022-1.csv');
        $contentOfArray = $sut->csvToArray();
        $this->assertEquals(563, count($contentOfArray));
    }

    public function testComponentInArray() {
        $sut = new FileToArray('./test-files/MatriculadosGeneral-2022-1.csv');
        $componentInArray = $sut->eachRowToArray();
        $this->assertEquals(3, count($componentInArray[0]));
    }
}