<?php

namespace SMRP\Model;

class MatchModel
{
    const DATE_FORMAT = 'd/m/Y';
    const TIME_FORMAT = 'H:i';

    /**
     * @var string
     */
    private $homeTeam;

    /**
     * @var string
     */
    private $awayTeam;

    /**
     * @var \DateTime
     */
    private $datetime;

    /**
     * @var TeamFormationModel
     */
    private $homeFormation;

    /**
     * @var TeamFormationModel
     */
    private $awayFormation;

    public function __construct(string $homeTeam, string $awayTeam, \DateTime $datetime)
    {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->datetime = $datetime;
    }

    public function getHomeTeam(): string
    {
        return $this->homeTeam;
    }

    public function getAwayTeam(): string
    {
        return $this->awayTeam;
    }

    public function getDateTime(): \DateTime
    {
        return $this->datetime;
    }

    public function getDate(): string
    {
        // The date format is: d/m/Y
        return $this->datetime->format(self::DATE_FORMAT);
    }

    public function getTime(): string
    {
        // The date format is: H:i
        return $this->datetime->format(self::TIME_FORMAT);
    }

    /**
     * @return TeamFormationModel|null
     */
    public function getHomeFormation(): ?TeamFormationModel
    {
        return $this->homeFormation;
    }

    /**
     * @param TeamFormationModel $homeFormation
     */
    public function setHomeFormation(TeamFormationModel $homeFormation): void
    {
        $this->homeFormation = $homeFormation;
    }

    /**
     * @return TeamFormationModel|null
     */
    public function getAwayFormation(): ?TeamFormationModel
    {
        return $this->awayFormation;
    }

    /**
     * @param TeamFormationModel $awayFormation
     */
    public function setAwayFormation(TeamFormationModel $awayFormation): void
    {
        $this->awayFormation = $awayFormation;
    }
}
