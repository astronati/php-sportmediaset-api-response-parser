<?php

namespace SODRP\tests\Response\Parser;

use PHPUnit\Framework\TestCase;
use SMRP\Exception\NotFoundResponseTypeException;
use SMRP\Response\GetMatchesResponse;
use SMRP\Response\GetTeamFormationResponse;
use SMRP\Response\Parser\ResponseParser;

class ResponseParserTest extends TestCase
{
    public function getResponseDataProvider()
    {
        return [
            [
                [
                    'allenatore' => 'Sarri',
                    'modulo' => '4-3-3',
                    'titolari' => ['content' => ['Tables' => [['Rows' => []]]]],
                    'sostituzioni' => ['content' => ['Tables' => [['Rows' => []]]]],
                    'indisponibiliformazione' => 'Nessuno',
                    'squalificati' => 'nessuno',
                ],
                ResponseParser::GET_TEAM_FORMATION,
                GetTeamFormationResponse::class
            ],
            [

                ['content' => ['Tables' => [['Rows' => []]]]],
                ResponseParser::GET_MATCHES,
                GetMatchesResponse::class
            ],
        ];
    }

    /**
     * @dataProvider getResponseDataProvider
     * @param array $apiResponse
     * @param int $type
     * @param string $expectedClass
     * @throws NotFoundResponseTypeException
     */
    public function testGetResponse($apiResponse, $type, $expectedClass)
    {
        $response = ResponseParser::create($apiResponse, $type);
        $this->assertSame($expectedClass, get_class($response));
    }

    public function getTeamFormationResponseDataProvider()
    {
        return [
            [
                [
                    'allenatore' => 'Sarri',
                    'modulo' => '4-3-3',
                    'titolari' => ['content' => ['Tables' => [['Rows' => []]]]],
                    'sostituzioni' => ['content' => ['Tables' => [['Rows' => []]]]],
                    'indisponibiliformazione' => 'Nessuno, -',
                    'squalificati' => 'Ter Stegen (2),',
                ],
                1,
                'Ter Stegen',
                0
            ],
        ];
    }

    /**
     * @dataProvider getTeamFormationResponseDataProvider
     * @param array $apiResponse
     * @param int $expectedDisqualifiedCount
     * @param string $expectedDisqualified
     * @param int $expectedUnavailableCount
     * @throws NotFoundResponseTypeException
     */
    public function testGetTeamFormationResponse($apiResponse, $expectedDisqualifiedCount, $expectedDisqualified, $expectedUnavailableCount)
    {
        /** @var GetTeamFormationResponse $response */
        $response = ResponseParser::create($apiResponse, ResponseParser::GET_TEAM_FORMATION);
        $this->assertSame($expectedDisqualifiedCount, count($response->getTeamFormationModel()->getDisqualified()));
        $this->assertSame($expectedDisqualified, $response->getTeamFormationModel()->getDisqualified()[0]->getName());
        $this->assertSame($expectedUnavailableCount, count($response->getTeamFormationModel()->getUnavailable()));
    }

    /**
     * @throws NotFoundResponseTypeException
     */
    public function testException()
    {
        $this->expectException("\Exception");
        ResponseParser::create([], -1);
    }
}
