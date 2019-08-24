<?php

namespace SODRP\tests\Response\Parser;

use PHPUnit\Framework\TestCase;
use SMRP\Exception\NotFoundResponseTypeException;
use SMRP\Response\GetMatchesResponse;
use SMRP\Response\GetTeamFormationResponse;
use SMRP\Response\Parser\ResponseParser;

class ResponseParserTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [
                [
                    'titolari' => ['content' => ['Tables' => [['Rows' => []]]]],
                    'sostituzioni' => ['content' => ['Tables' => [['Rows' => []]]]],
                    'indisponibiliformazione' => 'Nessuno',
                    'squalificati' => 'Nessuno',
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
     * @dataProvider dataProvider
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

    /**
     * @throws NotFoundResponseTypeException
     */
    public function testException()
    {
        $this->expectException("\Exception");
        ResponseParser::create([], -1);
    }
}
