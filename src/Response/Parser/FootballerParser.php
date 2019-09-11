<?php

namespace SMRP\Response\Parser;

use SMRP\Model\FootballerModel;

class FootballerParser
{
    const FOOTBALLER_KEY = 'giocatore';
    const NUMBER_KEY = 'numero-maglia';

    public static function parse($footballerData): ?FootballerModel
    {
        switch (gettype($footballerData)) {
            case 'string':
                if (trim($footballerData)) {
                    return new FootballerModel(trim($footballerData));
                }
                break;
            case 'array':
                if (trim($footballerData[self::FOOTBALLER_KEY])) {
                    return new FootballerModel(trim($footballerData[self::FOOTBALLER_KEY]), $footballerData[self::NUMBER_KEY]);
                }
                break;
        }
        return null;
    }
}
