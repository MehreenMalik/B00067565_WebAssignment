<?php
/**
 * Created by PhpStorm.
 * User: Mehreen Malik
 * Date: 02/05/2016
 * Time: 12:05 AM
 */

namespace Hdip\Model;

use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;

/**
 * Class Student
 * @package Hdip\Model
 */
class Student extends DatabaseTable
{
    /**
     * student id
     * @var integer
     */
    private $id;
    /**
     * class id
     * @var integer
     */
    private $classId;
    /**
     * username
     * @var string
     */
    private $username;
    /**
     * instructor username
     * @var string
     */
    private $instructorUsername;
    /**
     * current grade
     * @var string
     */
    private $currentGrade;
    /**
     * age of attendance
     * @var integer
     */
    private $ageAttendance;
    /**
     * date of next grading
     * @var string
     */
    private $nextGrading;
    /**
     * average grade of student
     * @var string
     */
    private $averageGrade;
    /**
     * current status of student
     * @var string
     */
    private $status;

    /**
     * set the id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * get the id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set class id
     * @param $classId
     */
    public function setClassId($classId)
    {
        $this->classId = $classId;
    }

    /**
     * get class id
     * @return mixed
     */
    public function getClassId()
    {
        return $this->classId;
    }

    /**
     * set the username
     * @param $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * get the username
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * set the instructor's username
     * @param $instructorUsername
     */
    public function setInstructorUsername($instructorUsername)
    {
        $this->instructorUsername = $instructorUsername;
    }

    /**
     * get the instructor's username
     * @return mixed
     */
    public function getInstructorUsername()
    {
        return $this->instructorUsername;
    }

    /**
     * set the current grade
     * @param $currentGrade
     */
    public function setCurrentGrade($currentGrade)
    {
        $this->currentGrade = $currentGrade;
    }

    /**
     * get the current grade
     * @return mixed
     */
    public function getCurrentGrade()
    {
        return $this->currentGrade;
    }

    /**
     * set the age attendance
     * @param $ageAttendance
     */
    public function setAgeAttendance($ageAttendance)
    {
        $this->ageAttendance = $ageAttendance;
    }

    /**
     * get the age attendance
     * @return mixed
     */
    public function getAgeAttendance()
    {
        return $this->ageAttendance;
    }

    /**
     * set the date of the next grading
     * @param $nextGrading
     */
    public function setNextGrading($nextGrading)
    {
        $this->nextGrading = $nextGrading;
    }

    /**
     * get the  date of the next grading
     * @return mixed
     */
    public function getNextGrading()
    {
        return $this->nextGrading;
    }

    /**
     * set the average grade of the student
     * @param $averageGrade
     */
    public function setAverageGrade($averageGrade)
    {
        $this->averageGrade = $averageGrade;
    }

    /**
     * get the average grade of the student
     * @return mixed
     */
    public function getAverageGrade()
    {
        return $this->averageGrade;
    }

    /**
     * set the status of students
     * @param $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * get the status of students
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Retrieve the students with the same instructor username
     * @param $username
     * @return mixed|null
     */
    public static function getAllStudentsByInstructorUsername($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM students WHERE instructorUsername=:username';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        if ($object = $statement->fetch())
        {
            return $object;
        }
        else
        {
            return null;
        }
    }

    /**
     * if record exists with $username, return Student object for that record
     * otherwise return 'null'
     *
     * @param $username
     *
     * @return mixed|null
     */
    public static function getOneByUsername($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM students WHERE username=:username';
        $statement = $connection->prepare($sql);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->setFetchMode(\PDO::FETCH_CLASS, __CLASS__);
        $statement->execute();

        if ($object = $statement->fetch()) {
            return $object;
        } else {
            return null;
        }
    }

    /**
     * This method inserts a new student into the student table
     * @param Student $student
     * @return int|string
     */
    public static function insert(Student $student)
    {
        $classId = $student->getClassId();
        $username = $student->getUsername();
        $instructorUsername = $student->getInstructorUsername();
        $currentGrade = $student->getCurrentGrade();
        $ageAttendance = $student->getAgeAttendance();
        $nextGrading = $student->getNextGrading();
        $averageGrade = $student->getAverageGrade();
        $status = $student->getstatus();

        $db = new DatabaseManager();
        $connection = $db->getDbh();

        //INSERT INTO table (name, value) VALUES (:name, :value)
        $statement = $connection->prepare
        ('INSERT into students (classId, username, instructorUsername, currentGrade, ageAttendance, nextGrading, averageGrade, status)
        VALUES (:classId, :username, :instructorUsername, :currentGrade, :ageAttendance, :nextGrading, :averageGrade, :status)');
        $statement->bindParam(':classId', $classId, \PDO::PARAM_INT);
        $statement->bindParam(':username', $username, \PDO::PARAM_STR);
        $statement->bindParam(':instructorUsername', $instructorUsername, \PDO::PARAM_STR);
        $statement->bindParam(':currentGrade', $currentGrade, \PDO::PARAM_STR);
        $statement->bindParam(':ageAttendance', $ageAttendance, \PDO::PARAM_STR);
        $statement->bindParam(':nextGrading', $nextGrading, \PDO::PARAM_STR);
        $statement->bindParam(':averageGrade', $averageGrade, \PDO::PARAM_STR);
        $statement->bindParam(':status', $status, \PDO::PARAM_STR);
        $statement->execute();

        $queryWasSuccessful = ($statement->rowCount() > 0);
        if($queryWasSuccessful) {
            return $connection->lastInsertId();
        } else {
            return -1;
        }
    }
}