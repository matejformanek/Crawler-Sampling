<?php

namespace src\form;

class CQuality extends CFormAttribute
{
    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $this->active = true;
        $this->quality = "clean";
    }

    /**
     * @param bool $stepBack
     * @inheritDoc
     */
    public function change(bool $stepBack): bool
    {
        if ($this->quality === "clean") $this->quality = "medium";
        else if ($this->quality === "medium") $this->quality = "dirty";
        else {
            $this->active = false;
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string
    {
        return $this->active ? "&quality=" . $this->quality : "";
    }

    private string $quality;
}