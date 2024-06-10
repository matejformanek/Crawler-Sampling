<?php

use src\CFormFiller;
use src\CScraper;
use src\CDatabase;

require_once __DIR__ . '/vendor/autoload.php';

declare(ticks = 1);

$lim = 10;
$type = 2;

if($argc === 3) {
    $lim = intval($argv[1]);
    $type = intval($argv[2]);
}

$database = new CDatabase();
//$database->createSmallDatabase(); // Creates new dataset
$database->setLimit($lim); // Sets webs return limit
$database->resetDatabase();

$formFiller = new CFormFiller();
$formFiller->setType($type); // By default: set to 1 (filler)

$scraper = new CScraper();

pcntl_signal(SIGINT, [$scraper, 'finalStats']); // show final stats even when killed

$retrieved = $scraper->retrieve("http://10.119.71.46/index.php?crawler=set&drug_supplier=none&drug_name=none&drug_price=none"); // default form without any filter

while ($scraper->search(174192)) { // Cycle until u have scraped x unique rows
    $url = $formFiller->fillForm($retrieved[0]); // 0 retrieved lines
//    echo $url.PHP_EOL;
    $retrieved = $scraper->retrieve($url);
    if ($url === "http://10.119.71.46/index.php?crawler=set&drug_supplier=none&drug_name=none&drug_price=none") break; // if all the possible options were tried break
}

$scraper->finalStats(1);