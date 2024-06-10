<?php

namespace src\form;

class CConsistence extends CFormAttribute
{

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $this->active = true;
        $this->consistence = "dried";
    }

    /**
     * @param bool $stepBack
     * @inheritDoc
     */
    public function change(bool $stepBack): bool
    {
        if ($this->consistence === "sniffgas") {
            $this->active = false;
            return true;
        }


        if ($this->consistence === "dried") $this->consistence = "liquid";
        else if ($this->consistence === "liquid") $this->consistence = "powder";
        else if ($this->consistence === "powder") $this->consistence = "sniffgas";

        return false;
    }

    public function getUrl(): string
    {
        return $this->active ? "&checkbox_" . $this->consistence . "=" . $this->consistence : "";
    }

    private string $consistence;
}