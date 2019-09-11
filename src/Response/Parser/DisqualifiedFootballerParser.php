<?php

namespace SMRP\Response\Parser;

use SMRP\Model\FootballerModel;

class DisqualifiedFootballerParser
{
    public static function parse($footballer): ?FootballerModel
    {
        $matches = [];
        preg_match('/^(.*) \((\d+)\)$/', $footballer, $matches);
        if (count($matches)) {
            $footballer = FootballerParser::parse($matches[1]);
            if ($footballer) {
                $footballer->setDisqualificationDays($matches[2]);
            }
        }
        else {
            $footballer = FootballerParser::parse($footballer);
            if ($footballer) {
                $footballer->setDisqualificationDays(1);
            }
        }
        return $footballer;
    }
}
