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

    public function getCoach(): string
    {
        return $this->response['allenatore'];
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
            && strtolower($this->response['indisponibiliformazione']) != '-'
        ) {
            foreach (explode(',', $this->response['indisponibiliformazione']) as $data) {
                $regexMatches = [];
                preg_match('/^(.*)\. (.{3,})$/', $data, $regexMatches);
                if (count($regexMatches)) {
                    $unavailable[] = trim($regexMatches[1]);
                    $unavailable[] = trim($regexMatches[2]);
                } else {
                    $unavailable[] = trim($data);
                }
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
        ) {
            foreach (explode(',', $this->response['squalificati']) as $data) {
                $disqualified[] = trim($data);
            }
        }

        return $disqualified;
    }

    public function getMatches(): array
    {
        return $this->response['content']['Tables'][0]['Rows'];
    }
}
