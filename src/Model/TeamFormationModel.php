<?php

namespace SMRP\Model;

class TeamFormationModel
{
    const FIRST_STRING = 'FIRST_STRING';
    const RESERVE = 'RESERVE';
    const UNAVAILABLE = 'UNAVAILABLE';
    const DISQUALIFIED = 'DISQUALIFIED';

    /**
     * @var string
     */
    private $module;

    /**
     * @var string|null
     */
    private $coach;

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
    private $unavailable = [];

    /**
     * @var FootballerModel[]
     */
    private $disqualified = [];

    public function __construct(string $module, ?string $coach)
    {
        $this->coach = $coach;
        $this->module = $module;
    }

    public function getCoach(): ?string
    {
        return $this->coach;
    }

    public function getModule(): string
    {
        return $this->module;
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
    public function getUnavailable(): array
    {
        return $this->unavailable;
    }

    /**
     * @param FootballerModel[] $unavailable
     */
    public function setUnavailable(array $unavailable): void
    {
        foreach ($unavailable as $index => $unavailableFootballer) {
            $unavailableFootballer->setPosition($index);
            $unavailableFootballer->setStatus(self::UNAVAILABLE);
            $this->unavailable[] = $unavailableFootballer;
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
