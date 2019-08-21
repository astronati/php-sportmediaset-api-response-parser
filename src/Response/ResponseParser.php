<?php

namespace SMRP\Response;

use SMRP\Exception\NotFoundResponseTypeException;
use SMRP\Model\FootballerModel;
use SMRP\Model\MatchModel;
use SMRP\Model\TeamFormationModel;

class ResponseParser
{
    const GET_TEAM_FORMATION = 1;
    const GET_MATCHES = 2;

    /**
     * @param array $apiResponse The response from the API
     * @param int $type
     * @return mixed
     * @throws NotFoundResponseTypeException When the type is not allowed
     */
    public static function create(array $apiResponse, $type)
    {
        switch ($type) {
            case self::GET_TEAM_FORMATION:
                $teamFormationModel = new TeamFormationModel($apiResponse);
                $firstStrings = [];
                foreach ($apiResponse['formazionetitolari']['content']['Tables'][0]['Rows'] as $footballer) {
                    $firstStrings[] = new FootballerModel($footballer);
                }
                $teamFormationModel->setFirstStrings($firstStrings);

                $reserves = [];
                foreach ($apiResponse['sostituzioni']['content']['Tables'][0]['Rows'] as $footballer) {
                    $reserves[] = new FootballerModel($footballer);
                }
                $teamFormationModel->setReserves($reserves);
                return new GetTeamFormationResponse($teamFormationModel);
            case self::GET_MATCHES:
                $matchModels = [];
                foreach ($apiResponse['content']['Tables'][0]['Rows'] as $match) {
                    $matchModels[] = new MatchModel($match);
                }
                return new GetMatchesResponse($matchModels);
            default:
                throw new NotFoundResponseTypeException('Response type not found');
        }
    }
}
