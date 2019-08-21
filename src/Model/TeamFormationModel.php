<?php

namespace SMRP\Model;

class TeamFormationModel
{
    const COACH_KEY = 'allenatore';
    const MODULE_KEY = 'modulo';
    const UNAVAILABLES_KEY = 'indisponibiliformazione';
    const NULL_VALUE = 'Nessuno';

    /**
     * @var array
     */
    private $apiResponse;

    /**
     * @var FootballerModel[]
     */
    private $firstStrings = [];

    /**
     * @var FootballerModel[]
     */
    private $reserves = [];

    public function __construct(array $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function getCoach(): string
    {
        return $this->apiResponse[self::COACH_KEY];
    }

    public function getModule(): string
    {
        return $this->apiResponse[self::MODULE_KEY];
    }

    public function getUnavailables(): array
    {
        if ($this->apiResponse[self::UNAVAILABLES_KEY] == self::NULL_VALUE) {
            return [];
        }

        return explode(', ', $this->apiResponse[self::UNAVAILABLES_KEY]);
    }

    /**
     * @return FootballerModel[]
     */
    public function getFirstStrings(): array
    {
        return $this->firstStrings;
    }

    /**
     * @param FootballerModel[]
     */
    public function setFirstStrings(array $firstStrings): void
    {
        $this->firstStrings = $firstStrings;
    }

    /**
     * @return FootballerModel[]
     */
    public function getReserves(): array
    {
        return $this->reserves;
    }

    /**
     * @param FootballerModel[] $reserves
     */
    public function setReserves(array $reserves): void
    {
        $this->reserves = $reserves;
    }
}
