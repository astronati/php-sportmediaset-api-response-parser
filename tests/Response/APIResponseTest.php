<?php

namespace Tests\Response;

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
                ['squalificati' => '-\n'],
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
            [
                array (
                    'titolari' =>
                        array (
                            'title' => 'formazionetitolari',
                            'content' =>
                                array (
                                    'Tables' =>
                                        array (
                                            0 =>
                                                array (
                                                    'id' => 'tableformazionetitolari',
                                                    'didascalie' =>
                                                        array (
                                                        ),
                                                    'Rows' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'numero-maglia' => '28',
                                                                    'giocatore' => 'CRAGNO',
                                                                ),
                                                            1 =>
                                                                array (
                                                                    'numero-maglia' => '3',
                                                                    'giocatore' => 'GOLDANIGA',
                                                                ),
                                                            2 =>
                                                                array (
                                                                    'numero-maglia' => '66',
                                                                    'giocatore' => 'lovato',
                                                                ),
                                                            3 =>
                                                                array (
                                                                    'numero-maglia' => '15',
                                                                    'giocatore' => 'ALTARE',
                                                                ),
                                                            4 =>
                                                                array (
                                                                    'numero-maglia' => '12',
                                                                    'giocatore' => 'bellanova',
                                                                ),
                                                            5 =>
                                                                array (
                                                                    'numero-maglia' => '8',
                                                                    'giocatore' => 'MARIN',
                                                                ),
                                                            6 =>
                                                                array (
                                                                    'numero-maglia' => '14',
                                                                    'giocatore' => 'DEIOLA',
                                                                ),
                                                            7 =>
                                                                array (
                                                                    'numero-maglia' => '27',
                                                                    'giocatore' => 'grassi',
                                                                ),
                                                            8 =>
                                                                array (
                                                                    'numero-maglia' => '29',
                                                                    'giocatore' => 'DALBERT',
                                                                ),
                                                            9 =>
                                                                array (
                                                                    'numero-maglia' => '20',
                                                                    'giocatore' => 'PEREIRO',
                                                                ),
                                                            10 =>
                                                                array (
                                                                    'numero-maglia' => '10',
                                                                    'giocatore' => 'joao pedro',
                                                                ),
                                                        ),
                                                ),
                                        ),
                                ),
                        ),
                    'sostituzioni' =>
                        array (
                            'title' => 'sostituzioniformazione',
                            'content' =>
                                array (
                                    'Tables' =>
                                        array (
                                            0 =>
                                                array (
                                                    'id' => 'tablesostituzioniformazione',
                                                    'didascalie' =>
                                                        array (
                                                        ),
                                                    'Rows' =>
                                                        array (
                                                            0 =>
                                                                array (
                                                                    'numero-maglia' => '31',
                                                                    'giocatore' => 'RADUNOVIC',
                                                                ),
                                                            1 =>
                                                                array (
                                                                    'numero-maglia' => '1',
                                                                    'giocatore' => 'ARESTI',
                                                                ),
                                                            2 =>
                                                                array (
                                                                    'numero-maglia' => '44',
                                                                    'giocatore' => 'carboni',
                                                                ),
                                                            3 =>
                                                                array (
                                                                    'numero-maglia' => '23',
                                                                    'giocatore' => 'CEPPITELLI',
                                                                ),
                                                            4 =>
                                                                array (
                                                                    'numero-maglia' => '22',
                                                                    'giocatore' => 'Lykogiannis',
                                                                ),
                                                            5 =>
                                                                array (
                                                                    'numero-maglia' => '33',
                                                                    'giocatore' => 'OBERT',
                                                                ),
                                                            6 =>
                                                                array (
                                                                    'numero-maglia' => '25',
                                                                    'giocatore' => 'zappa',
                                                                ),
                                                            7 =>
                                                                array (
                                                                    'numero-maglia' => '39',
                                                                    'giocatore' => 'Kourfalidis',
                                                                ),
                                                            8 =>
                                                                array (
                                                                    'numero-maglia' => '4',
                                                                    'giocatore' => 'baselli',
                                                                ),
                                                            9 =>
                                                                array (
                                                                    'numero-maglia' => '9',
                                                                    'giocatore' => 'keita',
                                                                ),
                                                            10 =>
                                                                array (
                                                                    'numero-maglia' => '30',
                                                                    'giocatore' => 'PAVOLETTI',
                                                                ),
                                                        ),
                                                ),
                                        ),
                                ),
                        ),
                    'squalificati' => '-
',
                    'indisponibiliformazione' => 'Ceter, Walukiewicz, Rog, Strootman, Nandez',
                    'modulo' => '3-5-1-1',
                    'ufficiali' => 'false',
                    'allenatore' => 'Mazzarri',
                    'kpm3id' => '6707482',
                    'teamOptaId' => '124',
                    'urlSquadra' => 'https://www.sportmediaset.mediaset.it/risultati-classifiche/calcio/serie-a/squadra.shtml?season=2021&competition=21&team=124',
                ),
                []
            ]
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
