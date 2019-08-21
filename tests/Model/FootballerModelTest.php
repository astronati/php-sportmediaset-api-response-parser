<?php

namespace SMRP\tests\Model;

use PHPUnit\Framework\TestCase;
use SMRP\Model\FootballerModel;

class FootballerModelTest extends TestCase
{
    public function testGetNumber()
    {
        $footballerModel = new FootballerModel(['numero-maglia' => 1, 'giocatore' => 'Andrea']);
        $this->assertEquals(1, $footballerModel->getNumber());
    }

    public function testGetName()
    {
        $footballerModel = new FootballerModel(['numero-maglia' => 1, 'giocatore' => 'Andrea']);
        $this->assertEquals('Andrea', $footballerModel->getName());
    }
}
