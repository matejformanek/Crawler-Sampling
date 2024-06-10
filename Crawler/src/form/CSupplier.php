<?php

namespace src\form;

class CSupplier extends CFormAttribute
{
    public function __construct($cn)
    {
        $this->active = false;
        $queried = pg_query($cn,"SELECT supplier_name FROM supplier");
        while ($res = pg_fetch_object($queried))
            $this->supplier[] = $res->supplier_name;
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $this->active = true;
        $this->index = 0;
        shuffle($this->supplier);
    }

    /**
     * @param bool $stepBack
     * @inheritDoc
     */
    public function change(bool $stepBack): bool
    {
        $this->index++;
        if($this->index === count($this->supplier)) {
            $this->active = false;
            return true;
        }

        return false;
    }

    public function getUrl(): string
    {
        return $this->active ? "&drug_supplier=" . $this->supplier[$this->index] : "&drug_supplier=none";
    }

    /**
     * @var array{string}
     */
    private array $supplier;
    private int $index;
}