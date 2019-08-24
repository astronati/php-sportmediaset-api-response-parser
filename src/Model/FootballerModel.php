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
}
