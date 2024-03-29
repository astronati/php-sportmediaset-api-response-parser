<?php

namespace SMRP\Response;

class APIResponse
{
    /**
     * @var array
     */
    private $response;

    public function __construct(array $response = [])
    {
        $this->response = $response;
    }

    public function getCoach(): ?string
    {
        return array_key_exists('allenatore', $this->response) ? $this->response['allenatore'] : null;
    }

    public function getModule(): string
    {
        return $this->response['modulo'];
    }

    public function getFirstStrings(): array
    {
        return $this->response['titolari']['content']['Tables'][0]['Rows'];
    }

    public function getReserves(): array
    {
        return $this->response['sostituzioni']['content']['Tables'][0]['Rows'];
    }

    public function getUnavailable(): array
    {
        $unavailable = [];

        if (array_key_exists('indisponibiliformazione', $this->response)
            && strpos(strtolower($this->response['indisponibiliformazione']), 'nessuno') === false
            && trim(strtolower($this->response['indisponibiliformazione'])) != '-'
        ) {
            $responseUnavailable = str_replace(
                ' e ',
                ', ',
                str_replace('\n', '', $this->response['indisponibiliformazione'])
            );
            foreach (explode(',', $responseUnavailable) as $data) {
                $unavailable = array_merge($unavailable, $this->extractFootballers($data));
            }
        }

        return $unavailable;
    }

    public function getDisqualified(): array
    {
        $disqualified = [];

        if (array_key_exists('squalificati', $this->response)
            && strpos(strtolower($this->response['squalificati']), 'nessuno') === false
            && strtolower($this->response['squalificati']) != '-'
            && strtolower($this->response['squalificati']) != '-\n'
            && strtolower($this->response['squalificati']) != '-'.PHP_EOL
        ) {
            $responseDisqualified = str_replace('\n', '', $this->response['squalificati']);
            foreach (explode(',', $responseDisqualified) as $data) {
                $disqualified = array_merge($disqualified, $this->extractFootballers($data));
            }
        }

        return $disqualified;
    }

    private function extractFootballers(string $data): array
    {
        $regexMatches = [];
        $footballers = [];
        preg_match('/^(.{2,})\. (.{3,})$/', trim($data), $regexMatches);
        if (count($regexMatches)) {
            $footballers[] = trim($regexMatches[1]);
            $footballers[] = trim($regexMatches[2]);
        } else {
            $footballers[] = trim($data);
        }
        return $footballers;
    }

    public function getMatches(): array
    {
        return $this->response['content']['Tables'][0]['Rows'];
    }
}
