<?php
/**
 * Created by PhpStorm.
 * User: Mehreen Malik
 * Date: 30/04/2016
 * Time: 10:58 PM
 */

namespace Hdip\Model;
use Mattsmithdev\PdoCrud\DatabaseTable;
use Mattsmithdev\PdoCrud\DatabaseManager;

/**
 * Class Classe
 * @package Hdip\Model
 */
class Classe extends DatabaseTable
{
    /**
     * username
     * @var string
     */
    private $username;
    /**
     * classes is used to retrieve info about a single class
     * @var
     */
    private $classes;
    /**
     * class id
     * @var integer
     */
    private $id;
    /**
     * instructor id
     * @var integer
     */
    private $instructorId;
    /**
     * no of students in a class
     * @var integer
     */
    private $noOfStudents;
    /**
     * class level
     * @var string
     */
    private $level;

    /**
     * set the id
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get the id of the class
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * set the username
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * set the instructor id
     * @param $instructorId
     */
    public function setInstructorId($instructorId)
    {
        $this->instructorId = $instructorId;
    }

    /**
     * get the instructor id
     * @return mixed
     */
    public function getInstructorId()
    {
        return $this->instructorId;
    }

    /**
     * set the level of the class
     * @param $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * get the level of the class
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * set the number of students in a class
     * @param $noOfStudents
     */
    public function setNoOfStudents($noOfStudents)
    {
        $this->noOfStudents = $noOfStudents;
    }

    /**
     * get the number of students in a class
     * @return mixed
     */
    public function getNoOfStudents()
    {
        return $this->noOfStudents;
    }

    /**
     * get all the classes with the same instructor username
     * @param $username
     * @return mixed|null
     */
    public static function getAllByInstructorUsername($username)
    {
        $db = new DatabaseManager();
        $connection = $db->getDbh();

        $sql = 'SELECT * FROM classes WHERE instructorUsername=:username';
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
     * attempt to retrieve and return class for given id = $id
     * @param int $id
     * @return Classe (if found)
     * @return null (if not found)
     */
    public function getOneClass($id)
    {
        if(array_key_exists($id, $this->classes))
        {
            return $this->classes[$id];
        }
        else
        {
            return null;
        }
    }
}