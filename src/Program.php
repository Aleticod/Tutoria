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

class Program {

    public static function resultNewStudents($fileName1, $fileName2) : array {
        $distribution = new FileToArray(__DIR__."/../files/$fileName1"); //DistribucionTutoria-2022-1.csv
        $arrayDistribution = $distribution->eachRowToArray();

        $generalEnrolled = new FileToArray(__DIR__."/../files/$fileName2");//
        $arrayEnrolled = $generalEnrolled->eachRowToArray();

        $processTutorship = new ProcessArrayTutorship($arrayDistribution);
        $studentsWithTutor = $processTutorship->extractStudents();

        $processStudents = new ProcessArrayStudent($arrayEnrolled);
        $studentsWithoutHeader = $processStudents->removeHeader();

        $processEnroll = new ProcessEnroll($studentsWithTutor, $studentsWithoutHeader);
        $newStudents = $processEnroll->extractNewStudents();

        return $newStudents;
    }

    public static function resultRetiredStudents($fileName1, $fileName2) : array {
        $distribution = new FileToArray(__DIR__."/../files/$fileName1");
        $arrayDistribution = $distribution->eachRowToArray();

        $generalEnrolled = new FileToArray(__DIR__."/../files/$fileName2");
        $arrayEnrolled = $generalEnrolled->eachRowToArray();

        $processTutorship = new ProcessArrayTutorship($arrayDistribution);
        $studentsWithTutor = $processTutorship->extractStudents();

        $processStudents = new ProcessArrayStudent($arrayEnrolled);
        $studentsWithoutHeader = $processStudents->removeHeader();

        $processEnroll = new ProcessEnroll($studentsWithTutor, $studentsWithoutHeader);
        $retiredStudents = $processEnroll->extractRetiredStudents();

        return $retiredStudents;
    }

    public static function resultBalancedTutorship ($fileName1, $fileName2) : array {
        $distribution = new FileToArray(__DIR__."/../files/$fileName1"); //DistribucionTutoria-2022-1.csv
        $arrayDistribution = $distribution->eachRowToArray();

        $generalEnrolled = new FileToArray(__DIR__."/../files/$fileName2"); //MatriculadosGeneral-2022-1.csv
        $arrayEnrolled = $generalEnrolled->eachRowToArray();

        $processStudents = new ProcessArrayStudent($arrayEnrolled);
        $studentsWithoutHeader = $processStudents->removeHeader();

        $processTutorship = new ProcessArrayTutorship($arrayDistribution);
        $studentsWithTutor = $processTutorship->extractStudents();
        $tutorshipGroupByTutors = $processTutorship->groupByTutor();

        $processEnroll = new ProcessEnroll($studentsWithTutor, $studentsWithoutHeader);
        $newStudents = $processEnroll->extractNewStudents();
        $retiredStudents = $processEnroll->extractRetiredStudents();

        $processCleanTutorship = new CleanTutorship($tutorshipGroupByTutors, $retiredStudents);
        $cleanTutorship = $processCleanTutorship->cleaningTutorship();

        $processNewStudents = new ProcessArrayStudent($newStudents);
        $newStudentsGroups = $processNewStudents->groupByCode();

        $processBalanceTutorship = new BalanceTutorship($cleanTutorship, $newStudentsGroups);
        $balancedTutorship = $processBalanceTutorship->balance();

        $processTutorship = new ProcessArrayTutorship($arrayDistribution);
        $tutorsWithJobs = $processTutorship->extractTutors();

        $processNormalizeBalancedTutorship = new TutorshipToSimpleArray($balancedTutorship,$tutorsWithJobs );
        $arraySimpleBalancedTutorship = $processNormalizeBalancedTutorship->convertToSimple();

        return $arraySimpleBalancedTutorship;
    }

    public static function resultDistributionTutorship($fileName1, $fileName2) {

        $teachers = new FileToArray(__DIR__."/../files/$fileName1");
        $arrayTeachers = $teachers->eachRowToArray();

        $generalEnrolled = new FileToArray(__DIR__."/../files/$fileName2");
        $arrayEnrolled = $generalEnrolled->eachRowToArray();

        $processTutor = new ProcessArrayTutor($arrayTeachers);
        $tutorWithoutHeader = $processTutor->removeHeader();

        $processStudents = new ProcessArrayStudent($arrayEnrolled);
        $studentsGroups = $processStudents->groupByCode();

        $processDistributionTutorship = new DistributionTutorship($tutorWithoutHeader, $studentsGroups);
        $distributedTutorship = $processDistributionTutorship->distribution();

        $processNormalizeDistributedTutorship = new TutorshipToSimpleArray($distributedTutorship,$tutorWithoutHeader );
        $arraySimpleDistributedTutorship = $processNormalizeDistributedTutorship->convertToSimple();

        return $arraySimpleDistributedTutorship;
    }
}

