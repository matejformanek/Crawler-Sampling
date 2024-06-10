<?php

namespace src\form;

abstract class CFormAttribute
{
    public function __construct()
    {
        $this->active = false;
    }

    /**
     * When the form is called after increasing depth to current state
     */
    abstract public function start() : void;

    /**
     * Iterates over possible options of filling the form
     * @param bool $stepBack
     * @return true if the function called stepbacked
     */
    abstract public function change(bool $stepBack) : bool;

    abstract public function getUrl() : string;

    protected bool $active;
}