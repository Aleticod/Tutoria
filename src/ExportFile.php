<?php

namespace App;

class ExportFile {
    private $array;
    private $fileName;
    private $exportDirectory = __DIR__.'/../archivos/';

    public function __construct(array $array, string $fileName) {
        $this->array = $array;
        $this->fileName = $fileName;
    }

    public function exportToCsv() {
        $filePath = $this->exportDirectory . $this->fileName;

        $fexport = fopen($filePath, 'w');

        foreach($this->array as $fields) {
            fputcsv($fexport, $fields);
        }

        fclose($fexport);
    }
}