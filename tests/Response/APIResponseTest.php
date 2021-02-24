<?php

namespace SODRP\tests\Response;

use PHPUnit\Framework\TestCase;
use SMRP\Response\APIResponse;

class APIResponseTest extends TestCase
{
    public function coachDataProvider()
    {
        return [
            [
                ['allenatore' => 'Sarri'],
                'Sarri'
            ],
            [
                ['indisponibiliformazione' => 'Nessuno, -'],
                null
            ],
        ];
    }

    /**
     * @dataProvider coachDataProvider
     * @param array $response
     * @param string $expectedResult
     */
    public function testGetCoach($response, $expectedResult)
    {
        $apiResponse = new APIResponse($response);
        $this->assertSame($expectedResult, $apiResponse->getCoach());
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
        $apiResponse = new APIResponse(['sostituzioni' => ['content' => ['Tables' => [['Rows' => ['test', 'giovanni']]]]]]);
        $this->assertEquals(['test', 'giovanni'], $apiResponse->getReserves());
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
                ['indisponibiliformazione' => 'Musacchio, Duarte, Castillejo, A. Donnarumma\n'],
                ['Musacchio', 'Duarte', 'Castillejo', 'A. Donnarumma']
            ],
            [
                ['indisponibiliformazione' => 'nome footballer, FARAGò. PAVOLETTI, ANDREA M.'],
                ['nome footballer', 'FARAGò', 'PAVOLETTI', 'ANDREA M.']
            ],
            [
                ['indisponibiliformazione' => 'nome footballer, FARAGò. PAVOLETTI, ANDREA M., Ilicic e Gosens'],
                ['nome footballer', 'FARAGò', 'PAVOLETTI', 'ANDREA M.', 'Ilicic', 'Gosens']
            ],
            [
                ['indisponibiliformazione' => 'ZANIOLO PEROTTI'],
                ['ZANIOLO PEROTTI']
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
                ['squalificati' => 'Nessuno, -, -\n'],
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
            [
                ['squalificati' => 'nome footballer, FARAGò. PAVOLETTI, ANDREA M.'],
                ['nome footballer', 'FARAGò', 'PAVOLETTI', 'ANDREA M.']
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
