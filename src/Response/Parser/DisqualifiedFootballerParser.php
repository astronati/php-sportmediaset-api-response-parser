<?php

namespace SMRP\Response\Parser;

use SMRP\Model\FootballerModel;

class DisqualifiedFootballerParser
{
    public static function parse($footballerData): ?FootballerModel
    {
        $regexMatches = [];
        preg_match('/^(.*) \((\d+)\)$/', $footballerData, $regexMatches);
        if (count($regexMatches)) {
            $footballer = FootballerParser::parse($regexMatches[1]);
            if ($footballer) {
                $footballer->setDisqualificationDays($regexMatches[2]);
            }
        }
        else {
            $footballer = FootballerParser::parse($footballerData);
            if ($footballer) {
                $footballer->setDisqualificationDays(1);
            }
        }
        return $footballer;
    }
}
