<?php

namespace SODRP\tests\Response\Parser;

use PHPUnit\Framework\TestCase;
use SMRP\Response\Parser\FootballerParser;

class FootballerParserTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [
                ['numero-maglia' => 1, 'giocatore' => 'Andrea'],
                'Andrea',
                '1'
            ],
            [

                'Andrea',
                'Andrea',
                null
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
        $footballer = FootballerParser::parse($data);
        $this->assertSame($expectedName, $footballer->getName());
        $this->assertSame($expectedNUmber, $footballer->getNumber());
    }
}
