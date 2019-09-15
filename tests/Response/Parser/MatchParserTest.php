<?php

namespace SMRP\tests\Response\Parser;

use PHPUnit\Framework\TestCase;
use SMRP\Model\MatchModel;
use SMRP\Response\Parser\MatchParser;

class MatchParserTest extends TestCase
{
    public function homeTeamDataProvider()
    {
        return [
            [["squadra-casa" => "Parma", "squadra-trasferta" => "Juventus", "data-partita" => "24/08/2019", "ora-partita" => "18:00"], 'Parma'],
        ];
    }

    /**
     * @dataProvider homeTeamDataProvider
     * @param array $apiResponse
     * @param string $expectedResult
     */
    public function testGetHomeTeam($apiResponse, $expectedResult)
    {
        $matchModel = MatchParser::parse($apiResponse);
        $this->assertEquals($expectedResult, $matchModel->getHomeTeam());
    }

    public function awayTeamDataProvider()
    {
        return [
            [["squadra-casa" => "Parma", "squadra-trasferta" => "Juventus", "data-partita" => "24/08/2019", "ora-partita" => "18:00"], 'Juventus'],
        ];
    }

    /**
     * @dataProvider awayTeamDataProvider
     * @param array $apiResponse
     * @param string $expectedResult
     */
    public function testGetAwayTeam($apiResponse, $expectedResult)
    {
        $matchModel = MatchParser::parse($apiResponse);
        $this->assertEquals($expectedResult, $matchModel->getAwayTeam());
    }

    public function dateDataProvider()
    {
        return [
            [["squadra-casa" => "Parma", "squadra-trasferta" => "Juventus", "data-partita" => "24/08/2019", "ora-partita" => "18:00"], '24/08/2019'],
        ];
    }

    /**
     * @dataProvider dateDataProvider
     * @param array $apiResponse
     * @param string $expectedResult
     */
    public function testGetDate($apiResponse, $expectedResult)
    {
        $matchModel = MatchParser::parse($apiResponse);
        $this->assertEquals($expectedResult, $matchModel->getDate());
    }

    public function timeDataProvider()
    {
        return [
            [["squadra-casa" => "Parma", "squadra-trasferta" => "Juventus", "data-partita" => "24/08/2019", "ora-partita" => "18:00"], '18:00'],
        ];
    }

    /**
     * @dataProvider timeDataProvider
     * @param array $apiResponse
     * @param string $expectedResult
     */
    public function testGetTime($apiResponse, $expectedResult)
    {
        $matchModel = MatchParser::parse($apiResponse);
        $this->assertEquals($expectedResult, $matchModel->getTime());
    }

    public function dateTimeDataProvider()
    {
        return [
            [["squadra-casa" => "Parma", "squadra-trasferta" => "Juventus", "data-partita" => "24/08/2019", "ora-partita" => "18:00"], '2019-08-24T18:00:00+02:00'],
        ];
    }

    /**
     * @dataProvider dateTimeDataProvider
     * @param array $apiResponse
     * @param string $expectedResult
     */
    public function testGetDateTime($apiResponse, $expectedResult)
    {
        $matchModel = MatchParser::parse($apiResponse);
        $this->assertEquals($expectedResult, $matchModel->getDateTime()->format(\DateTime::W3C));
    }
}
