<?php

namespace src;

use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

class CScraper
{
    /**
     * Cleans database
     */
    public function __construct()
    {
        $this->cn = pg_connect("host=10.119.71.46 port=5432 dbname=deep_web user=postgres password=heslo");
        $this->scrapedData = 0;
        $this->dtb_count = pg_fetch_result(pg_query($this->cn, "SELECT COUNT(*) AS cnt FROM supplier_drug"), "cnt");
        $this->startTime = microtime(true);
        $this->numOfCalls = 0;
        $this->linesRead = 0;
    }

    public function search(int $max): bool
    {
        return $this->scrapedData < $max;
    }

    /**
     * @param string $url with filled form
     * @return array[2] 0 = all_retrieved, 1 = newly_add
     */
    public function retrieve(string $url): array
    {
        $client = new HttpBrowser();
        $crawler = $client->request('GET', $url);

        $readData = $crawler->filter('#results')->each(function (Crawler $node) {
            $count = 0;
            $id = array();
            $sup_id = array();
            $clean = array();
            $quality = array();

            foreach ($node->filter('#id') as $name) {
                $id[] = $name->textContent;
                $count++;
            }
            foreach ($node->filter('#sup_id') as $name)
                $sup_id[] = $name->textContent;
            foreach ($node->filter('#quality') as $name)
                $quality[] = $name->textContent;
            foreach ($node->filter('#consistence') as $name)
                $clean[] = $name->textContent;


            for ($i = 0; $i < $count; ++$i) {
                pg_query($this->cn, "INSERT INTO crawled_data VALUES ( $sup_id[$i] , $id[$i] , '$clean[$i]' , '$quality[$i]' ) ON CONFLICT DO NOTHING;");
            }

            return $count;
        });

        return array(intval($readData[0]), $this->statistic($this->scrapedData, intval($readData[0])));
    }

    public function finalStats($signal): void
    {
        echo "Running time: " . round((microtime(true) - $this->startTime) / 60, 2) . " minutes." . PHP_EOL;
        echo "Return limit: " . pg_fetch_result(pg_query($this->cn,"select getlimit() as lim"),"lim") . PHP_EOL;
        echo "Database discovered " . round(($this->scrapedData / $this->dtb_count) * 100, 2) . "% ( " . $this->scrapedData . " / " . $this->dtb_count . " )" . PHP_EOL;
        echo "Read: " . $this->linesRead . " lines." . PHP_EOL . "Saved: " . $this->scrapedData . " lines." . PHP_EOL;
        echo "Redundant lines read: " . ($this->linesRead - $this->scrapedData) . " ( " . round(100 - ($this->scrapedData / $this->linesRead) * 100, 2) . "% )" . PHP_EOL;
        echo "Crawled: " . $this->numOfCalls . " times." . PHP_EOL;
        echo "Average crawled: " . round($this->linesRead / $this->numOfCalls, 2) . " lines." . PHP_EOL;
        echo "Unique lines crawled: " . round(($this->scrapedData) / $this->numOfCalls, 2) . " lines.". PHP_EOL;

        if($signal === SIGINT) exit(0);
    }

    private function statistic(int $before, int $read): int
    {
        $this->scrapedData = pg_fetch_result(pg_query($this->cn, "SELECT COUNT(*) AS curr FROM crawled_data"), "curr");
        $this->linesRead += $read;
        $this->numOfCalls++;

        $diff = ($this->scrapedData - $before);
        $percent = $diff == 0 ? 0 : round((($diff / $read) * 100), 2);
        $dtb_percent = round(($this->scrapedData / $this->dtb_count) * 100, 2);

        $line = sprintf(
            "Read %s lines. Added %s ~ %s%% of read data. Database discovered %s%% ( %s / %s )",
            str_pad($read, 3, ' ', STR_PAD_LEFT),
            str_pad(number_format($diff, 2), 6, ' ', STR_PAD_LEFT),
            str_pad(number_format($percent, 2), 6, ' ', STR_PAD_LEFT),
            str_pad(number_format($dtb_percent, 2), 6, ' ', STR_PAD_LEFT),
            str_pad($this->scrapedData, 6, ' ', STR_PAD_LEFT),
            str_pad($this->dtb_count, 6, ' ', STR_PAD_LEFT)
        );
        echo $line . PHP_EOL;

        return $diff;
    }

    private $cn;
    private int $dtb_count;
    private int $scrapedData;
    private int $numOfCalls;
    private int $linesRead;
    private float|string $startTime;
}