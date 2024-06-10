<?php

namespace src\form;

class CDrug extends CFormAttribute
{
    public function __construct($cn)
    {
        $this->active = false;
        $queried = pg_query($cn,"SELECT drug_name FROM drug");
        while ($res = pg_fetch_object($queried))
            $this->drug[] = $res->drug_name;
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $this->active = true;
        $this->index = 0;
        shuffle($this->drug);
    }

    /**
     * @param bool $stepBack
     * @inheritDoc
     */
    public function change(bool $stepBack): bool
    {
        $this->index++;
        if($this->index === count($this->drug)) {
            $this->active = false;
            return true;
        }

        return false;
    }

    public function getUrl(): string
    {
        return $this->active ? "&drug_name=" . $this->drug[$this->index] : "&drug_name=none";
    }

    /**
     * @var array{string}
     */
    private array $drug;
    private int $index;
}