<?php

namespace SMRP\Model;

class FootballerModel
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $number;

    /**
     * @var int|null
     */
    private $disqualificationDays;

    /**
     * @var string
     */
    private $status;

    /**
     * @var int
     */
    private $position;

    public function __construct(string $name, string $number = null)
    {
        $this->name = $name;
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string|null $number
     */
    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return int|null
     */
    public function getDisqualificationDays(): ?int
    {
        return $this->disqualificationDays;
    }

    /**
     * @param int $disqualificationDays
     */
    public function setDisqualificationDays(int $disqualificationDays): void
    {
        $this->disqualificationDays = $disqualificationDays;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }
}
