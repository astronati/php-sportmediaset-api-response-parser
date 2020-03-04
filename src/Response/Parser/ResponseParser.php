<?php

namespace SMRP\Response\Parser;

use SMRP\Exception\NotFoundResponseTypeException;
use SMRP\Model\TeamFormationModel;
use SMRP\Response\APIResponse;
use SMRP\Response\GetMatchesResponse;
use SMRP\Response\GetTeamFormationResponse;

class ResponseParser
{
    const GET_TEAM_FORMATION = 1;
    const GET_MATCHES = 2;

    /**
     * @param array $response The response from the API
     * @param int $type
     * @return mixed
     * @throws NotFoundResponseTypeException When the type is not allowed
     */
    public static function create(array $response, $type)
    {
        $apiResponse = new APIResponse($response);
        switch ($type) {
            case self::GET_TEAM_FORMATION:
                $teamFormationModel = new TeamFormationModel($apiResponse->getModule(), $apiResponse->getCoach());
                $firstStrings = [];
                foreach ($apiResponse->getFirstStrings() as $footballerData) {
                    if ($firstString = FootballerParser::parse($footballerData)) {
                        $firstStrings[] = $firstString;
                    }
                }
                $teamFormationModel->setFirstStrings($firstStrings);

                $reserves = [];
                foreach ($apiResponse->getReserves() as $footballerData) {
                    if ($reserve = FootballerParser::parse($footballerData)) {
                        $reserves[] = $reserve;
                    }
                }
                $teamFormationModel->setReserves($reserves);

                $unavailable = [];
                foreach ($apiResponse->getUnavailable() as $footballerData) {
                    if ($unavailableFootballer = FootballerParser::parse($footballerData)) {
                        $unavailable[] = $unavailableFootballer;
                    }
                }
                $teamFormationModel->setUnavailable($unavailable);

                $disqualified = [];
                foreach ($apiResponse->getDisqualified() as $footballerData) {
                    if ($disqualifiedFootballer = DisqualifiedFootballerParser::parse($footballerData)) {
                        $disqualified[] = $disqualifiedFootballer;
                    }
                }
                $teamFormationModel->setDisqualified($disqualified);

                return new GetTeamFormationResponse($teamFormationModel);
            case self::GET_MATCHES:
                $matchModels = [];
                foreach ($apiResponse->getMatches() as $matchData) {
                    $matchModels[] = MatchParser::parse($matchData);
                }
                return new GetMatchesResponse($matchModels);
            default:
                throw new NotFoundResponseTypeException("{$type} is not a valid response type");
        }
    }
}
