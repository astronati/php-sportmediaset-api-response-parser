<?php

namespace SMRP\Response\Parser;

use SMRP\Model\MatchModel;

class MatchParser
{
    const HOME_TEAM_KEY = 'squadra-casa';
    const AWAY_TEAM_KEY = 'squadra-trasferta';
    const DATE_KEY = 'data-partita';
    const TIME_KEY = 'ora-partita';
    const DATE_FORMAT = 'd/m/Y';
    const TIME_FORMAT = 'H:i';

    public static function parse(array $matchData): MatchModel
    {
        return new MatchModel(
            $matchData[self::HOME_TEAM_KEY],
            $matchData[self::AWAY_TEAM_KEY],
            \DateTime::createFromFormat(
                self::DATE_FORMAT . ' ' . self::TIME_FORMAT,
                $matchData[self::DATE_KEY] . ' ' . $matchData[self::TIME_KEY],
                new \DateTimeZone('Europe/Rome')
            )
        );
    }
}
