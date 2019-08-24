<?php

namespace SMRP\Model;

class TeamFormationModel
{
    const COACH_KEY = 'allenatore';
    const MODULE_KEY = 'modulo';

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

    /**
     * @var FootballerModel[]
     */
    private $unavailables = [];

    /**
     * @var FootballerModel[]
     */
    private $disqualified = [];

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

    /**
     * @return FootballerModel[]
     */
    public function getFirstStrings(): array
    {
        return $this->firstStrings;
    }

    /**
     * @param FootballerModel[] $firstStrings
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

    /**
     * @return FootballerModel[]
     */
    public function getUnavailables(): array
    {
        return $this->unavailables;
    }

    /**
     * @param FootballerModel[] $unavailables
     */
    public function setUnavailables(array $unavailables): void
    {
        $this->unavailables = $unavailables;
    }

    /**
     * @return FootballerModel[]
     */
    public function getDisqualified(): array
    {
        return $this->disqualified;
    }

    /**
     * @param FootballerModel[] $disqualified
     */
    public function setDisqualified(array $disqualified): void
    {
        $this->disqualified = $disqualified;
    }
}
