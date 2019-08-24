<?php

namespace SMRP\Response\Parser;

use SMRP\Model\FootballerModel;

class FootballerParser
{
    const FOOTBALLER_KEY = 'giocatore';
    const NUMBER_KEY = 'numero-maglia';

    public static function parse($footballerData): FootballerModel
    {
        switch (gettype($footballerData)) {
            case 'string':
                return new FootballerModel($footballerData);
            case 'array':
            default:
                return new FootballerModel($footballerData[self::FOOTBALLER_KEY], $footballerData[self::NUMBER_KEY]);
        }
    }
}
