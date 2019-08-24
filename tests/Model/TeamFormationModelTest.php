<?php

namespace SMRP\tests\Model;

use PHPUnit\Framework\TestCase;
use SMRP\Model\FootballerModel;
use SMRP\Model\TeamFormationModel;

class TeamFormationModelTest extends TestCase
{
    public function getCoachDataProvider()
    {
        return [
            [['allenatore' => 'Sarri'], 'Sarri'],
        ];
    }

    /**
     * @dataProvider getCoachDataProvider
     * @param array $apiResponse
     * @param string $expectedResult
     */
    public function testGetCoach($apiResponse, $expectedResult)
    {
        $teamFormationModel = new TeamFormationModel($apiResponse);
        $this->assertEquals($expectedResult, $teamFormationModel->getCoach());
    }

    public function getModuleDataProvider()
    {
        return [
            [['modulo' => '4-3-3'], '4-3-3'],
        ];
    }

    /**
     * @dataProvider getModuleDataProvider
     * @param array $apiResponse
     * @param string $expectedResult
     */
    public function testGetModule($apiResponse, $expectedResult)
    {
        $teamFormationModel = new TeamFormationModel($apiResponse);
        $this->assertEquals($expectedResult, $teamFormationModel->getModule());
    }

    public function testGetFirstStrings()
    {
        $teamFormationModel = new TeamFormationModel([]);
        $teamFormationModel->setFirstStrings([new FootballerModel('andrea')]);
        $this->assertEquals(1, count($teamFormationModel->getFirstStrings()));
        $this->assertEquals(0, $teamFormationModel->getFirstStrings()[0]->getPosition());
        $this->assertEquals('FIRST_STRING', $teamFormationModel->getFirstStrings()[0]->getStatus());
    }

    public function testGetReserves()
    {
        $teamFormationModel = new TeamFormationModel([]);
        $teamFormationModel->setReserves([new FootballerModel('andrea')]);
        $this->assertEquals(1, count($teamFormationModel->getReserves()));
        $this->assertEquals(0, $teamFormationModel->getReserves()[0]->getPosition());
        $this->assertEquals('RESERVE', $teamFormationModel->getReserves()[0]->getStatus());
    }

    public function testGetUnavailables()
    {
        $teamFormationModel = new TeamFormationModel([]);
        $teamFormationModel->setUnavailables([new FootballerModel('andrea')]);
        $this->assertEquals(1, count($teamFormationModel->getUnavailables()));
        $this->assertEquals(0, $teamFormationModel->getUnavailables()[0]->getPosition());
        $this->assertEquals('UNAVAILABLE', $teamFormationModel->getUnavailables()[0]->getStatus());
    }

    public function testGetDisqualified()
    {
        $teamFormationModel = new TeamFormationModel([]);
        $teamFormationModel->setDisqualified([new FootballerModel('andrea')]);
        $this->assertEquals(1, count($teamFormationModel->getDisqualified()));
        $this->assertEquals(0, $teamFormationModel->getDisqualified()[0]->getPosition());
        $this->assertEquals('DISQUALIFIED', $teamFormationModel->getDisqualified()[0]->getStatus());
    }
}
