<?php
/**
 * Created by PhpStorm.
 * User: Mehreen Malik
 * Date: 02/05/2016
 * Time: 04:38 PM
 */

namespace HdipTest;

use Hdip\Model\Student;

class StudentTest extends \PHPUnit_Framework_TestCase
{
    public function testCanCreateStudent()
    {
        //arrange
        $student = new Student();
        //act

        //assert
        $this->assertNotNull($student);

    }

    public function testGetId()
    {
        //arrange
        $student = new Student();

        //act
        $i ='2';
        $id = $student->setId($i);
        $newId = $student->getId();

        //assert
        $this->assertNotNull($newId);
    }
}