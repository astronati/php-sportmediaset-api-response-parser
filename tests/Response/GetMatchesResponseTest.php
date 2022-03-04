<?php

namespace Tests\Response;

use PHPUnit\Framework\TestCase;
use SMRP\Model\MatchModel;
use SMRP\Response\GetMatchesResponse;

class GetMatchesResponseTest extends TestCase
{
    private function getMatchModelInstance()
    {
        $instance = $this->getMockBuilder(MatchModel::class)
          ->disableOriginalConstructor()
          ->setMethods(['getDate'])
          ->getMock();
        $instance->method('getDate')->willReturn('13/05/2019');
        return $instance;
    }

    public function testGetMatchModels()
    {
        $getMatchesResponse = new GetMatchesResponse([$this->getMatchModelInstance()]);
        $this->assertSame('13/05/2019', $getMatchesResponse->getMatchModels()[0]->getDate());
    }
}
