<?php

namespace SMRP\Response;

use SMRP\Model\TeamFormationModel;

class GetTeamFormationResponse
{
    /**
     * @var TeamFormationModel
     */
    private $teamFormationModel;

    public function __construct(TeamFormationModel $teamFormationModel)
    {
        $this->teamFormationModel = $teamFormationModel;
    }

    /**
     * @return TeamFormationModel
     */
    public function getTeamFormationModel(): TeamFormationModel
    {
        return $this->teamFormationModel;
    }
}
