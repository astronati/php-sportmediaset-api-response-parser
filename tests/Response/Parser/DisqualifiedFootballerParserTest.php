<?php

namespace SODRP\tests\Response\Parser;

use PHPUnit\Framework\TestCase;
use SMRP\Response\Parser\DisqualifiedFootballerParser;

class DisqualifiedFootballerParserTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [
                'Andrea (2)',
                'Andrea',
                2
            ],
            [
                'Andrea',
                'Andrea',
                1
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $data
     * @param string $expectedName
     * @param string $expectedNUmber
     */
    public function testGetResponse($data, $expectedName, $expectedNUmber)
    {
        $footballer = DisqualifiedFootballerParser::parse($data);
        $this->assertSame($expectedName, $footballer->getName());
        $this->assertSame($expectedNUmber, $footballer->getDisqualificationDays());
    }
}
