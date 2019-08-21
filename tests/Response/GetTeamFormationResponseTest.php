<?php

namespace SODRP\tests\Response;

use PHPUnit\Framework\TestCase;
use SMRP\Model\TeamFormationModel;
use SMRP\Response\GetTeamFormationResponse;

class GetTeamFormationResponseTest extends TestCase
{
    private function getTeamFormationModelInstance()
    {
        $instance = $this->getMockBuilder(TeamFormationModel::class)
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
