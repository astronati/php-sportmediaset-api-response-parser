<?php

namespace SMRP\tests\Model;

use PHPUnit\Framework\TestCase;
use SMRP\Model\MatchModel;

class MatchModelTest extends TestCase
{
    public function homeTeamDataProvider()
    {
        return [
            ["Parma", "Juventus", 'Parma'],
        ];
    }

    /**
     * @dataProvider homeTeamDataProvider
     * @param string $homeTeam
     * @param string $awayTeam
     * @param string $expectedResult
     */
    public function testGetHomeTeam($homeTeam, $awayTeam, $expectedResult)
    {
        $matchModel = new MatchModel($homeTeam, $awayTeam, new \DateTime());
        $this->assertEquals($expectedResult, $matchModel->getHomeTeam());
    }

    public function awayTeamDataProvider()
    {
        return [
            ["Parma", "Juventus", 'Juventus'],
        ];
    }

    /**
     * @dataProvider awayTeamDataProvider
     * @param string $homeTeam
     * @param string $awayTeam
     * @param string $expectedResult
     */
    public function testGetAwayTeam($homeTeam, $awayTeam, $expectedResult)
    {
        $matchModel = new MatchModel($homeTeam, $awayTeam, new \DateTime());
        $this->assertEquals($expectedResult, $matchModel->getAwayTeam());
    }
}
