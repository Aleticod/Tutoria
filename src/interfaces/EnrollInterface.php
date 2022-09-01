<?php 

namespace App;

interface Enroll {
    public function extractNewStudents() : array;
    public function extractRetiredStudents() : array;
}