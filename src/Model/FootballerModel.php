<?php

namespace SMRP\Model;

class FootballerModel
{
    const NUMBER_KEY = 'numero-maglia';
    const NAME_KEY = 'giocatore';

    /**
     * @var array
     */
    private $apiResponse;

    public function __construct(array $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function getNumber(): int
    {
        return $this->apiResponse[self::NUMBER_KEY];
    }

    public function getName(): string
    {
        return $this->apiResponse[self::NAME_KEY];
    }
}
