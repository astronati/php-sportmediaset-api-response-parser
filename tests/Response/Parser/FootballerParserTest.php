<?php

namespace Tests\Response\Parser;

use PHPUnit\Framework\TestCase;
use SMRP\Response\Parser\FootballerParser;

class FootballerParserTest extends TestCase
{
    public function dataProvider()
    {
        return [
            [
                ['numero-maglia' => 1, 'giocatore' => 'Andrea'],
                false,
                'Andrea',
                '1'
            ],
            [
                'Andrea',
                false,
                'Andrea',
                null
            ],
            [
                'ZANIOLO PEROTTI',
                false,
                'ZANIOLO PEROTTI',
                null
            ],
            [
                '',
                true,
                null,
                null
            ],
        ];
    }

    /**
     * @dataProvider dataProvider
     * @param array $data
     * @param bool $expectedNullableValue
     * @param string $expectedName
     * @param string $expectedNUmber
     */
    public function testGetResponse($data, $expectedNullableValue, $expectedName, $expectedNUmber)
    {
        $footballer = FootballerParser::parse($data);
        if (!$expectedNullableValue) {
            $this->assertSame($expectedName, $footballer->getName());
            $this->assertSame($expectedNUmber, $footballer->getNumber());
        } else {
          $this->assertNull($footballer);
        }
    }
}
