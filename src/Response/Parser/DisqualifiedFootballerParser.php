<?php

namespace SMRP\Response\Parser;

use SMRP\Model\FootballerModel;

class DisqualifiedFootballerParser
{
    public static function parse($footballer): FootballerModel
    {
        $matches = [];
        preg_match('/^(.*) \((\d+)\)$/', $footballer, $matches);
        if (count($matches)) {
            $footballer = FootballerParser::parse($matches[1]);
            $footballer->setDisqualificationDays($matches[2]);
        }
        else {
            $footballer = FootballerParser::parse($footballer);
            $footballer->setDisqualificationDays(1);
        }
        return $footballer;
    }
}
