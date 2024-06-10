<?php

namespace src\form;

class CPrice extends CFormAttribute
{

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $this->active = true;
        $this->price = 5000;
    }

    /**
     * @param bool $stepBack
     * @inheritDoc
     */
    public function change(bool $stepBack): bool
    {
        if($stepBack){
            $this->active = false;
            return true;
        }

        $this->price -= 100;
        if($this->price <= 0) {
            $this->active = false;
            return true;
        }

        return false;
    }

    public function getUrl(): string
    {
        return $this->active ? "&drug_price=" . $this->price : "&drug_price=none";
    }


    private int $price;
}