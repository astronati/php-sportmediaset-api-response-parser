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

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumber(): ?string
    {
        return $this->number;
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
