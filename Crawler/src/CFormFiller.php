<?php

namespace src;

use OutOfRangeException;
use src\form\CAvailability;
use src\form\CConsistence;
use src\form\CDrug;
use src\form\CFormAttribute;
use src\form\CPrice;
use src\form\CQuality;
use src\form\CRating;
use src\form\CSupplier;
use src\form\CTextbox;

/**
 * Creates urls to be given to crawler
 * Plus logic depending on how many results were returned
 */
class CFormFiller
{
    public function __construct()
    {
        $this->cn = pg_connect("host=10.119.71.46 port=5432 dbname=deep_web user=postgres password=heslo");
        $this->limit = pg_fetch_result(pg_query($this->cn, "select getlimit() as lim"), "lim");
        $this->depth = -1;
        $this->type = 1;
        $this->innitFiller();
    }

    public function setType(int $type): void
    {
        if ($type < 0 || $type > 5) throw new OutOfRangeException("Type has to be between 1 - 5!");

        $this->type = $type;
        echo "Set filler type: " . $type . PHP_EOL;

        $this->filler = array();
        $this->innitFiller();
    }

    public function fillForm(int $retrieved): string
    {
        if ($retrieved < $this->limit || count($this->filler) == $this->depth + 1)
            while ($this->depth >= 0 && $this->filler[$this->depth]->change($retrieved < $this->limit)) {
                $this->depth--;
            }
        else {
            if ($this->type === 4) { // randomize next form attribute
                $hold = $this->filler[$this->depth + 1];
                $rand = rand($this->depth + 1, count($this->filler) - 1);
                $this->filler[$this->depth + 1] = $this->filler[$rand];
                $this->filler[$rand] = $hold;
            }
            $this->filler[++$this->depth]->start();
        }

        return $this->generateUrl();
    }

    private function innitFiller(): void
    {
        switch ($this->type) {
            case 1:
                $this->firstFiller();
                break;
            case 2:
                $this->secondFiller();
                break;
            case 3:
                $this->thirdFiller();
                break;
            case 4:
                $this->fourthFiller();
                break;
            case 5:
                $this->fifthFiller();
                break;
        }
    }

    private function firstFiller(): void
    {
        $this->filler[] = new CPrice();
        $this->filler[] = new CQuality();
        $this->filler[] = new CAvailability();
        $this->filler[] = new CConsistence();
        $this->filler[] = new CRating();
        $this->filler[] = new CDrug($this->cn);
        $this->filler[] = new CSupplier($this->cn);
        $this->filler[] = new CTextbox();
    }

    private function secondFiller(): void
    {
        $this->filler[] = new CSupplier($this->cn);
        $this->filler[] = new CDrug($this->cn);
        $this->filler[] = new CQuality();
        $this->filler[] = new CAvailability();
        $this->filler[] = new CConsistence();
        $this->filler[] = new CRating();
        $this->filler[] = new CPrice();
        $this->filler[] = new CTextbox();
    }

    private function thirdFiller(): void
    {
        $this->filler[] = new CTextbox();
        $this->filler[] = new CSupplier($this->cn);
        $this->filler[] = new CQuality();
        $this->filler[] = new CAvailability();
        $this->filler[] = new CConsistence();
        $this->filler[] = new CRating();
        $this->filler[] = new CPrice();
        $this->filler[] = new CDrug($this->cn);
    }

    private function fourthFiller(): void
    {
        $this->filler[] = new CTextbox();
        $this->filler[] = new CSupplier($this->cn);
        $this->filler[] = new CDrug($this->cn);
        $this->filler[] = new CConsistence();
        $this->filler[] = new CRating();
        $this->filler[] = new CPrice();
        $this->filler[] = new CQuality();
        $this->filler[] = new CAvailability();
        shuffle($this->filler);
    }

    private function fifthFiller(): void
    {
        $this->filler[] = new CSupplier($this->cn);
        $this->filler[] = new CQuality();
        $this->filler[] = new CAvailability();
        $this->filler[] = new CConsistence();
        $this->filler[] = new CRating();
        $this->filler[] = new CPrice();
        $this->filler[] = new CDrug($this->cn);
        $this->filler[] = new CTextbox();
    }

    private function generateUrl(): string
    {
        if ($this->depth == -1) return "http://10.119.71.46/index.php?crawler=set&drug_supplier=none&drug_name=none&drug_price=none";
        $res = "http://10.119.71.46/index.php?crawler=set";

        for ($i = 0; $i < count($this->filler); $i++)
            $res .= $this->filler[$i]->getUrl();

        return $res;
    }

    private $cn;
    private int $limit;
    private int $depth;
    private int $type;

    /**
     * @var array{CFormAttribute}
     */
    private array $filler;
}