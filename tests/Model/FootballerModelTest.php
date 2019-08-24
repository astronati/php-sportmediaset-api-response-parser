<?php

namespace SMRP\tests\Model;

use PHPUnit\Framework\TestCase;
use SMRP\Model\FootballerModel;

class FootballerModelTest extends TestCase
{
    public function testGetNumber()
    {
        $footballerModel = new FootballerModel('Andrea', 1);
        $this->assertEquals(1, $footballerModel->getNumber());
    }

    public function testSetNumber()
    {
        $footballerModel = new FootballerModel('Andrea', 1);
        $footballerModel->setNumber(3);
        $this->assertEquals(3, $footballerModel->getNumber());
    }

    public function testGetName()
    {
        $footballerModel = new FootballerModel('Andrea', 1);
        $this->assertEquals('Andrea', $footballerModel->getName());
    }

    public function testSetName()
    {
        $footballerModel = new FootballerModel('Andrea', 1);
        $footballerModel->setName('Roberto');
        $this->assertEquals('Roberto', $footballerModel->getName());
    }
}
