<?php

namespace Tests\Model;

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

    public function hasNumberDataProvider()
    {
        return [
            ["1", true],
            [null, false],
        ];
    }

    /**
     * @dataProvider hasNumberDataProvider
     * @param string|null $hasNumber
     * @param bool $expectedResult
     */
    public function testHasNumber($hasNumber, $expectedResult)
    {
        $footballerModel = new FootballerModel('Andrea', $hasNumber);
        $this->assertEquals($expectedResult, $footballerModel->hasNumber());
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
