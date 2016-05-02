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
 * Class User
 * @package Hdip\Model
 */
class User extends DatabaseTable
{
    /**
     * id
     * @var integer
     */
    private $id;
    /**
     * username
     * @var string
     */
    private $username;
    /**
     * password
     * @var string
     */
    private $password;
    /**
     * role
     * @var integer
     */
    private $role;
    /**
     * email
     * @var string
     */
    private $email;

    /**
     * get the id
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set the id
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * get the password
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * get the role
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * set the role
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * set the email
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * get the email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * hash the password before storing ...
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $hashedPassword;
    }

    /**
     * return success (or not) of attempting to find matching username/password
     * @param $username
     * @param $password
     *
     * @return bool
     */
    public static function canFindMatchingUsernameAndPassword($username, $password)
    {
        $user = User::getOneByUsername($username);

        // if no record has this username, return FALSE
        if(null == $user)
        {
            return false;
        }

        // hashed correct password
        $hashedStoredPassword = $user->getPassword();

        // return whether or not hash of input password matches stored hash
        return password_verify($password, $hashedStoredPassword);
    }

    /**
     * if record exists with $username, return User object for that record
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

        $sql = 'SELECT * FROM users WHERE username=:username';
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
}