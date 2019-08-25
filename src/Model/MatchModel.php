<?php

namespace SMRP\Model;

class MatchModel
{
    const MATCH_DATE_KEY = 'data-partita';
    const MATCH_TIME_KEY = 'ora-partita';
    const HOME_TEAM_KEY = 'squadra-casa';
    const AWAY_TEAM_KEY = 'squadra-trasferta';
    const DATE_FORMAT = 'd/m/Y';
    const TIME_FORMAT = 'H:i';

    /**
     * @var array
     */
    private $apiResponse;

    public function __construct(array $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function getDateTime(): \DateTime
    {
        return \DateTime::createFromFormat(
            self::DATE_FORMAT . ' ' . self::TIME_FORMAT,
            "{$this->getDate()} {$this->getTime()}",
            new \DateTimeZone('Europe/Rome')
        );
    }

    public function getDate(): string
    {
        // The date format is: d/m/Y
        return $this->apiResponse[self::MATCH_DATE_KEY];
    }

    public function getTime(): string
    {
        // The date format is: H:i
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
