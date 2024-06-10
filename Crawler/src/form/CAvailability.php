<?php

namespace src\form;

class CAvailability extends CFormAttribute
{

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $this->active = true;
        $this->availability = "on_street";
    }

    /**
     * @param bool $stepBack
     * @inheritDoc
     */
    public function change(bool $stepBack): bool
    {
        if ($this->availability === "on_street") $this->availability = "delivery";
        else if ($this->availability === "delivery") $this->availability = "warehouse";
        else {
            $this->active = false;
            return true;
        }

        return false;
    }

    public function getUrl(): string
    {
        return $this->active ? "&availability=" . $this->availability : "";
    }

    private string $availability;
}