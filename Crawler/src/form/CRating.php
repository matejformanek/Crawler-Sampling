<?php

namespace src\form;

class CRating extends CFormAttribute
{
    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $this->active = true;
        $this->rating = 1;
    }

    /**
     * @param bool $stepBack
     * @inheritDoc
     */
    public function change(bool $stepBack): bool
    {
        if($this->rating === 5){
            $this->active = false;
            return true;
        }

        $this->rating++;

        return false;
    }

    public function getUrl(): string
    {
        return $this->active ? "&checkbox_rating_" . $this->rating . "=" . $this->rating : "";
    }

    private int $rating;
}