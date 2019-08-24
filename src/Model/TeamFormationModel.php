<?php

namespace SMRP\Model;

class TeamFormationModel
{
    const COACH_KEY = 'allenatore';
    const MODULE_KEY = 'modulo';

    const FIRST_STRING = 'FIRST_STRING';
    const RESERVE = 'RESERVE';
    const UNAVAILABLE = 'UNAVAILABLE';
    const DISQUALIFIED = 'DISQUALIFIED';

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
        foreach ($firstStrings as $index => $firstString) {
            $firstString->setPosition($index);
            $firstString->setStatus(self::FIRST_STRING);
            $this->firstStrings[] = $firstString;
        }
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
        foreach ($reserves as $index => $reserve) {
            $reserve->setPosition($index);
            $reserve->setStatus(self::RESERVE);
            $this->reserves[] = $reserve;
        }
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
        foreach ($unavailables as $index => $unavailable) {
            $unavailable->setPosition($index);
            $unavailable->setStatus(self::UNAVAILABLE);
            $this->unavailables[] = $unavailable;
        }
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
        foreach ($disqualified as $index => $disqualifiedFootballer) {
            $disqualifiedFootballer->setPosition($index);
            $disqualifiedFootballer->setStatus(self::DISQUALIFIED);
            $this->disqualified[] = $disqualifiedFootballer;
        }
    }
}
