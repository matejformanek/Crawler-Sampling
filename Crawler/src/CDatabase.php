<?php

namespace src;

class CDatabase
{
    public function __construct()
    {
        $this->cn = pg_connect("host=10.119.71.46 port=5432 dbname=deep_web user=postgres password=heslo");
    }

    public function resetDatabase()
    {
        pg_query($this->cn, "TRUNCATE crawled_data; DELETE FROM crawled_data;");

        echo "Previous crawled results deleted" . PHP_EOL;
    }

    public function createSmallDatabase()
    {
        $create = file_get_contents("../Database/createSmall.sql");
        $insert = file_get_contents("../Database/insertSmall.sql");
        pg_query($this->cn, $create);
        pg_query($this->cn, $insert);

        echo "Small database created" . PHP_EOL;
    }

    public function createMediumDatabase()
    {
        $create = file_get_contents("../Database/createMedium.sql");
        $insert = file_get_contents("../Database/insertMedium.sql");
        pg_query($this->cn, $create);
        pg_query($this->cn, $insert);

        echo "Medium database created" . PHP_EOL;
    }

    public function setLimit(int $limit)
    {
        pg_query($this->cn, "UPDATE return_limit SET ret_limit = $limit ");

        echo "Limit set to $limit" . PHP_EOL;
    }

    private $cn;
}