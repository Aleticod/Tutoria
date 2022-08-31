<?php 
namespace App;


require_once __DIR__.'/ProcessArray.php';
require_once __DIR__.'/FileToArray.php';
require_once __DIR__.'/ProcessArrayTutorship.php';
require_once __DIR__.'/BalanceTutorship.php';
require_once __DIR__.'/CleanTutorship.php';
require_once __DIR__.'/DistributionTutorship.php';
require_once __DIR__.'/ExportFile.php';
require_once __DIR__.'/ProcessArrayStudent.php';
require_once __DIR__.'/ProcessArrayTutor.php';
require_once __DIR__.'/ProcessEnroll.php';
require_once __DIR__.'/TutorshipToSimpleArray.php';


$distribution = new FileToArray(__DIR__.'/../test-files/DistribucionTutoria-2022-1.csv');
$generalEnrolled = new FileToArray(__DIR__.'/../test-files/MatriculadosGeneral-2022-1.csv');
$teachers = new FileToArray(__DIR__.'/../test-files/Docentes-2022-1.csv');

$arrayDistribution = $distribution->eachRowToArray();
$arrayEnrolled = $generalEnrolled->eachRowToArray();
$arrayTeachers = $teachers->eachRowToArray();

//var_dump($arrayDistribution);
//var_dump($arrayEnrolled);
//var_dump($arrayTeachers);

$processStudents = new ProcessArrayStudent($arrayEnrolled);
$studentsGroups = $processStudents->groupByCode();
$studentsWithoutHeader = $processStudents->removeHeader();
//var_dump($studentsGroups);
//var_dump($studentsWithoutHeader);

$processTutor = new ProcessArrayTutor($arrayTeachers);
$tutorWithoutHeader = $processTutor->removeHeader();
//var_dump($tutorWithoutHeader);

$processTutorship = new ProcessArrayTutorship($arrayDistribution);
$studentsWithTutor = $processTutorship->extractStudents();
$tutorsWithJobs = $processTutorship->extractTutors();
$tutorshipGroupByTutors = $processTutorship->groupByTutor();
//var_dump($studentsWithTutor);
//var_dump($tutorsWithJobs);
//var_dump($tutorshipGroupByTutors);



$processEnroll = new ProcessEnroll($studentsWithTutor, $studentsWithoutHeader);
$newStudents = $processEnroll->extractNewStudents();
$retiredStudents = $processEnroll->extractRetiredStudents();

//var_dump($newStudents);
//var_dump($retiredStudents);

$processCleanTutorship = new CleanTutorship($tutorshipGroupByTutors, $retiredStudents);
$cleanTutorship = $processCleanTutorship->cleaningTutorship();

//var_dump($cleanTutorship);

$processNewStudents = new ProcessArrayStudent($newStudents);
$newStudentsGroups = $processNewStudents->groupByCode();
//var_dump($newStudentsGroups);

$processBalanceTutorship = new BalanceTutorship($cleanTutorship, $newStudentsGroups);
$balancedTutorship = $processBalanceTutorship->balance();

//var_dump($balancedTutorship);



$processDistributionTutorship = new DistributionTutorship($tutorWithoutHeader, $studentsGroups);
$distributedTutorship = $processDistributionTutorship->distribution();

//var_dump($distributedTutorship);

$processNormalizeBalancedTutorship = new TutorshipToSimpleArray($balancedTutorship,$tutorsWithJobs );
$arraySimpleBalancedTutorship = $processNormalizeBalancedTutorship->convertToSimple();

//var_dump($arraySimpleBalancedTutorship);

$processNormalizeDistributedTutorship = new TutorshipToSimpleArray($distributedTutorship,$tutorWithoutHeader );
$arraySimpleDistributedTutorship = $processNormalizeDistributedTutorship->convertToSimple();

//var_dump($arraySimpleDistributedTutorship);

// array_unshift($newStudents, ['Codigo', 'Nombres']);
// $processExportNewStudentsFile = new ExportFile($newStudents, 'new-students.csv');
// $processExportNewStudentsFile->exportToCsv();

// array_unshift($retiredStudents, ['Codigo', 'Nombres']);
// $processExportRetiredStudentsFile = new ExportFile($retiredStudents, 'retired-students.csv');
// $processExportRetiredStudentsFile->exportToCsv();


// $processExportBalancedFile = new ExportFile($arraySimpleBalancedTutorship, 'balanced-tutorship.csv');
// $processExportBalancedFile->exportToCsv();

// $processExportDistributedFile = new ExportFile($arraySimpleDistributedTutorship, 'distributed-tutorship.csv');
// $processExportDistributedFile->exportToCsv();


