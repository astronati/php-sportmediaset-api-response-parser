<?php

namespace SMRP\Response\Parser;

use SMRP\Exception\NotFoundResponseTypeException;
use SMRP\Model\MatchModel;
use SMRP\Model\TeamFormationModel;
use SMRP\Response\GetMatchesResponse;
use SMRP\Response\GetTeamFormationResponse;

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
                foreach ($apiResponse['titolari']['content']['Tables'][0]['Rows'] as $footballer) {
                    if ($firstString = FootballerParser::parse($footballer)) {
                        $firstStrings[] = $firstString;
                    }
                }
                $teamFormationModel->setFirstStrings($firstStrings);

                $reserves = [];
                foreach ($apiResponse['sostituzioni']['content']['Tables'][0]['Rows'] as $footballer) {
                    if ($reserve = FootballerParser::parse($footballer)) {
                        $reserves[] = $reserve;
                    }
                }
                $teamFormationModel->setReserves($reserves);

                $unavailables = [];
                if (array_key_exists('indisponibiliformazione', $apiResponse) && strtolower($apiResponse['indisponibiliformazione']) != 'nessuno') {
                    foreach (explode(',', $apiResponse['indisponibiliformazione']) as $footballerName) {
                        if ($unavailable = FootballerParser::parse($footballerName)) {
                            $unavailables[] = $unavailable;
                        }
                    }
                }
                $teamFormationModel->setUnavailables($unavailables);

                $disqualified = [];
                if (array_key_exists('squalificati', $apiResponse) && strtolower($apiResponse['squalificati']) != 'nessuno') {
                    foreach (explode(',', $apiResponse['squalificati']) as $footballerName) {
                        if ($disqualifiedFootballer = DisqualifiedFootballerParser::parse($footballerName)) {
                            $disqualified[] = $disqualifiedFootballer;
                        }
                    }
                }
                $teamFormationModel->setDisqualified($disqualified);

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
