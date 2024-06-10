<?php
// catch GET and echo results
if (isset($_GET['drug_price'])) {
    $cn = pg_connect("host=10.119.71.46 port=5432 dbname=deep_web user=postgres password=heslo");

    if (isset($_GET['crawler'])) $query = "SELECT drug_id, supplier_id, clean, consistence FROM drug JOIN supplier_drug USING (drug_id) JOIN supplier USING (supplier_id) WHERE 1=1 ";
    else $query = "SELECT * FROM drug JOIN supplier_drug USING (drug_id) JOIN supplier USING (supplier_id) WHERE 1=1 ";
    if ($_GET['drug_supplier'] !== "none") drugSupplier($_GET['drug_supplier'], $query);
    if ($_GET['drug_name'] !== "none") drugName($_GET['drug_name'], $query);
    if (isset($_GET['quality'])) qualityLevel($_GET['quality'], $query);
    if (isset($_GET['availability'])) availability($_GET['availability'], $query);
    consistence($query);
    rating($query);
    if ($_GET['textbox'] !== "") textboxSearch($_GET['textbox'], $query);
    if ($_GET['drug_price'] !== "none") {
        $tmp = $_GET['drug_price'];
        $query .= "AND price<$tmp ORDER BY price DESC ";
    }
    $query .= "LIMIT getlimit()";

    $prepared = pg_query($cn, $query);

    if (isset($_GET['crawler'])) {
        echo "<tr>
            <th>Drug ID</th>
            <th>Consistence</th>
            <th>Quality</th>
            <th>Supplier ID</th>
        </tr>";
        while ($res = pg_fetch_object($prepared)) {
            echo "<tr id='result_row'>
            <td id='id'>$res->drug_id</td>
            <td id='consistence'>$res->consistence</td>
            <td id='quality'>$res->clean</td>
            <td id='sup_id'>$res->supplier_id</td>
        </tr>";
        }
    } else {
        echo "<tr>
            <th>Row</th>
            <th>Drug ID</th>
            <th>About</th>
            <th>Name</th>
            <th>Consistence</th>
            <th>Quality</th>
            <th>Delivery</th>
            <th>Price</th>
            <th>Supplier ID</th>
            <th>Supplier</th>
            <th>Rating</th>
        </tr>";
        $row = 1;
        while ($res = pg_fetch_object($prepared)) {
            echo "<tr id='result_row'>
            <td id='row'>$row</td>
            <td id='id'>$res->drug_id</td>
            <td id='about'>$res->drug_description</td>
            <td id='drug'>$res->drug_name</td>
            <td id='consistence'>$res->consistence</td>
            <td id='quality'>$res->clean</td>
            <td id='availability'>$res->availability</td>
            <td id='price'>$res->price</td>
            <td id='sup_id'>$res->supplier_id</td>
            <td id='supplier'>$res->supplier_name</td>
            <td id='rating'>$res->rating</td>
        </tr>";
            $row++;
        }
    }
}

/**
 * @param $supplier string
 * @param &$query string
 * @return void
 */
function drugSupplier($supplier, &$query)
{
    $query .= "AND supplier_name='$supplier' ";
}

/**
 * @param $drug string
 * @param &$query string
 * @return void
 */
function drugName($drug, &$query)
{
    $query .= "AND drug_name='$drug' ";
}

/**
 * @param $quality string
 * @param &$query string
 * @return void
 */
function qualityLevel($quality, &$query)
{
    $query .= "AND clean='$quality' ";
}

/**
 * @param $availability string
 * @param &$query string
 * @return void
 */
function availability($availability, &$query)
{
    $query .= "AND availability='$availability' ";
}

/**
 * @param &$query string
 * @return void
 */
function consistence(&$query)
{
    if (isset($_GET['checkbox_dried']) || isset($_GET['checkbox_liquid']) || isset($_GET['checkbox_powder']) || isset($_GET['checkbox_sniffgas'])) {
        $query .= "AND ( 1=2 ";
        if (isset($_GET['checkbox_dried'])) {
            $tmp = $_GET['checkbox_dried'];
            $query .= "OR consistence='$tmp' ";
        }
        if (isset($_GET['checkbox_liquid'])) {
            $tmp = $_GET['checkbox_liquid'];
            $query .= "OR consistence='$tmp' ";
        }
        if (isset($_GET['checkbox_powder'])) {
            $tmp = $_GET['checkbox_powder'];
            $query .= "OR consistence='$tmp' ";
        }
        if (isset($_GET['checkbox_sniffgas'])) {
            $tmp = $_GET['checkbox_sniffgas'];
            $query .= "OR consistence='$tmp' ";
        }

        $query .= ") ";
    }
}

/**
 * @param &$query string
 * @return void
 */
function rating(&$query)
{
    if (isset($_GET['checkbox_rating_1']) || isset($_GET['checkbox_rating_2']) || isset($_GET['checkbox_rating_3']) || isset($_GET['checkbox_rating_4']) || isset($_GET['checkbox_rating_5'])) {
        $query .= "AND ( 1=2 ";
        if (isset($_GET['checkbox_rating_1'])) $query .= "OR rating<=1 ";
        if (isset($_GET['checkbox_rating_2'])) $query .= "OR (rating>=1 AND rating<=2) ";
        if (isset($_GET['checkbox_rating_3'])) $query .= "OR (rating>=2 AND rating<=3) ";
        if (isset($_GET['checkbox_rating_4'])) $query .= "OR (rating>=3 AND rating<=4) ";
        if (isset($_GET['checkbox_rating_5'])) $query .= "OR (rating>=4) ";

        $query .= ") ";
    }
}

/**
 * @param $value string
 * @param &$query string
 * @return void
 */
function textboxSearch($value, &$query)
{
    $query .= "AND (drug_name ILIKE '%$value%' OR drug_description ILIKE '%$value%' OR supplier_name ILIKE '%$value%' OR consistence ILIKE '%$value%' OR clean ILIKE '%$value%' OR availability ILIKE '%$value%') ";
}