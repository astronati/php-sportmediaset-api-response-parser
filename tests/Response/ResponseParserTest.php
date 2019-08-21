<?php

namespace SODRP\tests\Response;

use PHPUnit\Framework\TestCase;
use SMRP\Exception\NotFoundResponseTypeException;
use SMRP\Response\GetTeamFormationResponse;
use SMRP\Response\ResponseParser;

class ResponseParserTest extends TestCase
{
    public function dataProvider()
    {
        return [
          [
              [
                  'formazionetitolari' => ['content' => ['Tables' => [['Rows' => []]]]],
                  'sostituzioni' => ['content' => ['Tables' => [['Rows' => []]]]],
              ],
              ResponseParser::GET_TEAM_FORMATION,
              GetTeamFormationResponse::class
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
