<?php

namespace src\form;


class CTextbox extends CFormAttribute
{
    public function __construct()
    {
        $this->active = false;
        $this->dictionary = array("drug", "relax", "sativa", "phet", "halluc", "psych", "thc", "hybrid", "high", "medic", "dopamine", "happy", "rape", "depres", "addict", "mushroom", "opi", "white");
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $this->active = true;
        $this->index = 0;
    }

    /**
     * @param bool $stepBack
     * @inheritDoc
     */
    public function change(bool $stepBack): bool
    {
        $this->index++;
        if ($this->index === count($this->dictionary)) {
            $this->active = false;
            return true;
        }

        return false;
    }

    public function getUrl(): string
    {
        return $this->active ? "&textbox=" . $this->dictionary[$this->index] : "";
    }

    /**
     * @var array{string}
     */
    private array $dictionary;
    private int $index;
}