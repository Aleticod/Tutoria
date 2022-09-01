<?php 
namespace App;

interface NormalizeTutorship {
    public function extractStudents() : array;
    public function extractTutors() : array;
}

