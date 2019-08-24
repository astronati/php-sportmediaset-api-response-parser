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
                    $firstStrings[] = FootballerParser::parse($footballer);
                }
                $teamFormationModel->setFirstStrings($firstStrings);

                $reserves = [];
                foreach ($apiResponse['sostituzioni']['content']['Tables'][0]['Rows'] as $footballer) {
                    $reserves[] = FootballerParser::parse($footballer);
                }
                $teamFormationModel->setReserves($reserves);

                $unavailables = [];
                if (array_key_exists('indisponibiliformazione', $apiResponse) && $apiResponse['indisponibiliformazione'] != 'Nessuno') {
                    foreach (explode(', ', $apiResponse['indisponibiliformazione']) as $footballerName) {
                        $unavailables[] = FootballerParser::parse($footballerName);
                    }
                }
                $teamFormationModel->setUnavailables($unavailables);

                $disqualified = [];
                if (array_key_exists('squalificati', $apiResponse) && $apiResponse['squalificati'] != 'Nessuno') {
                    foreach (explode(', ', $apiResponse['squalificati']) as $footballerName) {
                        $disqualified[] = FootballerParser::parse($footballerName);
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
