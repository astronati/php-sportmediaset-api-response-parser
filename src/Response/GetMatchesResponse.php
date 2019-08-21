<?php

namespace SMRP\Response;

use SMRP\Model\MatchModel;

class GetMatchesResponse
{
    /**
     * @var MatchModel[]
     */
    private $matchModels;

    /**
     * @param MatchModel[] $matchModels
     */
    public function __construct(array $matchModels)
    {
        $this->matchModels = $matchModels;
    }

    /**
     * @return MatchModel[]
     */
    public function getMatchModels(): array
    {
        return $this->matchModels;
    }
}
