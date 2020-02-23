<?php

namespace SODRP\tests\Response;

use PHPUnit\Framework\TestCase;
use SMRP\Response\APIResponse;

class APIResponseTest extends TestCase
{
    public function testGetCoach()
    {
        $apiResponse = new APIResponse(['allenatore' => 'Sarri']);
        $this->assertSame('Sarri', $apiResponse->getCoach());
    }

    public function testGetModule()
    {
        $apiResponse = new APIResponse(['modulo' => '4-3-3']);
        $this->assertSame('4-3-3', $apiResponse->getModule());
    }

    public function testGetMatches()
    {
        $apiResponse = new APIResponse(['content' => ['Tables' => [['Rows' => ['test']]]]]);
        $this->assertEquals(['test'], $apiResponse->getMatches());
    }

    public function testGetFirstStrings()
    {
        $apiResponse = new APIResponse(['titolari' => ['content' => ['Tables' => [['Rows' => ['test']]]]]]);
        $this->assertEquals(['test'], $apiResponse->getFirstStrings());
    }

    public function testGetReserves()
    {
        $apiResponse = new APIResponse(['sostituzioni' => ['content' => ['Tables' => [['Rows' => ['test']]]]]]);
        $this->assertEquals(['test'], $apiResponse->getReserves());
    }

    public function getUnavailableDataProvider()
    {
        return [
            [
                [],
                []
            ],
            [
                ['indisponibiliformazione' => 'Nessuno, -'],
                []
            ],
            [
                ['indisponibiliformazione' => '-'],
                []
            ],
            [
                ['indisponibiliformazione' => 'nome footballer, altro nome footballer'],
                ['nome footballer', 'altro nome footballer']
            ],
            [
                ['indisponibiliformazione' => 'nome footballer, FARAGò. PAVOLETTI, ANDREA M.'],
                ['nome footballer', 'FARAGò', 'PAVOLETTI', 'ANDREA M.']
            ],
        ];
    }

    /**
     * @dataProvider getUnavailableDataProvider
     * @param array $response
     * @param array $expectedResult
     */
    public function testGetUnavailable($response, $expectedResult)
    {
        $apiResponse = new APIResponse($response);
        $this->assertEquals($expectedResult, $apiResponse->getUnavailable());
    }

    public function getDisqualifiedDataProvider()
    {
        return [
            [
                [],
                []
            ],
            [
                ['squalificati' => 'Nessuno, -'],
                []
            ],
            [
                ['squalificati' => '-'],
                []
            ],
            [
                ['squalificati' => 'nome footballer, altro nome footballer'],
                ['nome footballer', 'altro nome footballer']
            ],
        ];
    }

    /**
     * @dataProvider getDisqualifiedDataProvider
     * @param array $response
     * @param array $expectedResult
     */
    public function testGetDisqualified($response, $expectedResult)
    {
        $apiResponse = new APIResponse($response);
        $this->assertEquals($expectedResult, $apiResponse->getDisqualified());
    }
}
