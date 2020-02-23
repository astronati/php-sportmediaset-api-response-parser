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
            ['Sarri'],
        ];
    }

    /**
     * @dataProvider getCoachDataProvider
     * @param string $coach
     */
    public function testGetCoach($coach)
    {
        $teamFormationModel = new TeamFormationModel($coach, '');
        $this->assertEquals($coach, $teamFormationModel->getCoach());
    }

    public function getModuleDataProvider()
    {
        return [
            ['4-3-3'],
        ];
    }

    /**
     * @dataProvider getModuleDataProvider
     * @param string $module
     */
    public function testGetModule($module)
    {
        $teamFormationModel = new TeamFormationModel('Sarri', '4-3-3');
        $this->assertEquals($module, $teamFormationModel->getModule());
    }

    public function testGetFirstStrings()
    {
        $teamFormationModel = new TeamFormationModel('Sarri', '4-3-3');
        $teamFormationModel->setFirstStrings([new FootballerModel('andrea')]);
        $this->assertEquals(1, count($teamFormationModel->getFirstStrings()));
        $this->assertEquals(0, $teamFormationModel->getFirstStrings()[0]->getPosition());
        $this->assertEquals('FIRST_STRING', $teamFormationModel->getFirstStrings()[0]->getStatus());
    }

    public function testGetReserves()
    {
        $teamFormationModel = new TeamFormationModel('Sarri', '4-3-3');
        $teamFormationModel->setReserves([new FootballerModel('andrea')]);
        $this->assertEquals(1, count($teamFormationModel->getReserves()));
        $this->assertEquals(0, $teamFormationModel->getReserves()[0]->getPosition());
        $this->assertEquals('RESERVE', $teamFormationModel->getReserves()[0]->getStatus());
    }

    public function testGetUnavailable()
    {
        $teamFormationModel = new TeamFormationModel('Sarri', '4-3-3');
        $teamFormationModel->setUnavailable([new FootballerModel('andrea')]);
        $this->assertEquals(1, count($teamFormationModel->getUnavailable()));
        $this->assertEquals(0, $teamFormationModel->getUnavailable()[0]->getPosition());
        $this->assertEquals('UNAVAILABLE', $teamFormationModel->getUnavailable()[0]->getStatus());
    }

    public function testGetDisqualified()
    {
        $teamFormationModel = new TeamFormationModel('Sarri', '4-3-3');
        $teamFormationModel->setDisqualified([new FootballerModel('andrea')]);
        $this->assertEquals(1, count($teamFormationModel->getDisqualified()));
        $this->assertEquals(0, $teamFormationModel->getDisqualified()[0]->getPosition());
        $this->assertEquals('DISQUALIFIED', $teamFormationModel->getDisqualified()[0]->getStatus());
    }
}
