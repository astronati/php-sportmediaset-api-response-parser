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
                foreach ($apiResponse['titolari']['content']['Tables'][0]['Rows'] as $footballerData) {
                    if ($firstString = FootballerParser::parse($footballerData)) {
                        $firstStrings[] = $firstString;
                    }
                }
                $teamFormationModel->setFirstStrings($firstStrings);

                $reserves = [];
                foreach ($apiResponse['sostituzioni']['content']['Tables'][0]['Rows'] as $footballerData) {
                    if ($reserve = FootballerParser::parse($footballerData)) {
                        $reserves[] = $reserve;
                    }
                }
                $teamFormationModel->setReserves($reserves);

                $unavailables = [];
                if (array_key_exists('indisponibiliformazione', $apiResponse) && strpos(strtolower($apiResponse['indisponibiliformazione']), 'nessuno') === false) {
                    foreach (explode(',', $apiResponse['indisponibiliformazione']) as $footballerData) {
                        if ($unavailable = FootballerParser::parse($footballerData)) {
                            $unavailables[] = $unavailable;
                        }
                    }
                }
                $teamFormationModel->setUnavailables($unavailables);

                $disqualified = [];
                if (array_key_exists('squalificati', $apiResponse) && strpos(strtolower($apiResponse['squalificati']), 'nessuno') === false) {
                    foreach (explode(',', $apiResponse['squalificati']) as $footballerData) {
                        if ($disqualifiedFootballer = DisqualifiedFootballerParser::parse($footballerData)) {
                            $disqualified[] = $disqualifiedFootballer;
                        }
                    }
                }
                $teamFormationModel->setDisqualified($disqualified);

                return new GetTeamFormationResponse($teamFormationModel);
            case self::GET_MATCHES:
                $matchModels = [];
                foreach ($apiResponse['content']['Tables'][0]['Rows'] as $matchData) {
                    $matchModels[] = MatchParser::parse($matchData);
                }
                return new GetMatchesResponse($matchModels);
            default:
                throw new NotFoundResponseTypeException('Response type not found');
        }
    }
}
