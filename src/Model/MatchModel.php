<?php

namespace SMRP\Model;

class MatchModel
{
    const MATCH_DATE_KEY = 'data-partita';
    const MATCH_TIME_KEY = 'ora-partita';
    const HOME_TEAM_KEY = 'squadra-casa';
    const AWAY_TEAM_KEY = 'squadra-trasferta';

    /**
     * @var array
     */
    private $apiResponse;

    public function __construct(array $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function getDate(): string
    {
        // The date format is: dd/mm/yyyy
        return $this->apiResponse[self::MATCH_DATE_KEY];
    }

    public function getTime(): string
    {
        // The date format is: HH:ii
        return $this->apiResponse[self::MATCH_TIME_KEY];
    }

    public function getHomeTeam(): string
    {
        return $this->apiResponse[self::HOME_TEAM_KEY];
    }

    public function getAwayTeam(): string
    {
        return $this->apiResponse[self::AWAY_TEAM_KEY];
    }
}
