<?php

namespace SMRP\tests\Model;

use PHPUnit\Framework\TestCase;
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

    public function getUnavailablesDataProvider()
    {
        return [
            [['indisponibiliformazione' => 'Nessuno'], []],
            [['indisponibiliformazione' => 'Andrea, Giovanni'], ['Andrea', 'Giovanni']],
        ];
    }

    /**
     * @dataProvider getUnavailablesDataProvider
     * @param array $apiResponse
     * @param string $expectedResult
     */
    public function testGetUnavailables($apiResponse, $expectedResult)
    {
        $teamFormationModel = new TeamFormationModel($apiResponse);
        $this->assertEquals($expectedResult, $teamFormationModel->getUnavailables());
    }

    public function testGetFirstStrings()
    {
        $teamFormationModel = new TeamFormationModel([]);
        $teamFormationModel->setFirstStrings(['andrea']);
        $this->assertEquals(['andrea'], $teamFormationModel->getFirstStrings());
    }

    public function testGetReserves()
    {
        $teamFormationModel = new TeamFormationModel([]);
        $teamFormationModel->setReserves(['andrea']);
        $this->assertEquals(['andrea'], $teamFormationModel->getReserves());
    }
}
