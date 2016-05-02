<?php
/**
* Created by PhpStorm.
* User: Mehreen Malik
* Date: 02/05/2016
* Time: 04:19 PM
*/

namespace HdipTest;

use Hdip\Model\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateUser()
    {
        //arrange
        $user = new User();
        //act

        //assert
        $this->assertNotNull($user);
    }

    public function testGetId()
    {
        //arrange
        $user = new User();

        //act
        $i ='2';
        $id = $user->setId($i);
        $newId = $user->getId();

        //assert
        $this->assertNotNull($newId);
    }

    public function testGetUsername()
    {
        //arrange
        $user = new User();

        //act
        $name ='alex';
        $userName = $user->setUsername($name);
        $username = $user->getUsername();

        //assert
        $this->assertNotNull($username);
    }

    public function testGetPassword()
    {
        //arrange
        $user = new User();

        //act
        $password ='alex';
        $passWord = $user->setPassword($password);
        $password = $user->getPassword();

        //assert
        $this->assertNotNull($password);
    }

    public function testGetRole()
    {
        //arrange
        $user = new User();

        //act
        $role = '2';
        $Role = $user->setRole($role);
        $role = $user->getRole();

        //assert
        $this->assertNotNull($role);
    }

    public function testCanFindMatchingUsernameAndPassword()
    {
        // the DatabaseManager class needs the following 4 constants to be defined in order to create the DB connection
        define('DB_HOST', 'localhost');
        define('DB_USER', 'root');
        define('DB_PASS', '');
        define('DB_NAME', 'webassignment');

        // Arrange
        $p = new User();
        $username = 'matt';
        $password = '$2y$10$.sJKzo1iy644pLja.SGY6O7s7As6bmg1sGXOnPkCHyqM4c6XWHVWK';
        $expectedResult=false;

        // Act
        $result = $p->canFindMatchingUsernameAndPassword($username, $password);

        // Assert
        $this->assertEquals($result, $expectedResult);
    }
}