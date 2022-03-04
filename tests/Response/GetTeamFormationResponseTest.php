<?php

namespace Tests\Response;

use PHPUnit\Framework\TestCase;
use SMRP\Response\GetTeamFormationResponse;

class GetTeamFormationResponseTest extends TestCase
{
    private function getTeamFormationModelInstance()
    {
        $instance = $this->getMockBuilder('SMRP\Model\TeamFormationModel')
          ->disableOriginalConstructor()
          ->setMethods(['getCoach'])
          ->getMock();
        $instance->method('getCoach')->willReturn('Sarri');
        return $instance;
    }

    public function testGetMatches()
    {
        $getTeamFormationResponse = new GetTeamFormationResponse($this->getTeamFormationModelInstance());
        $this->assertSame('Sarri', $getTeamFormationResponse->getTeamFormationModel()->getCoach());
    }
}
