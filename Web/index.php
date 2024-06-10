<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Deep Web</title>
</head>
<body>
<h1>Child wankers lair</h1>
<div class="selector">
    <h2>Drug selector</h2>
    <form action="index.php">
        <!--  Drop down menu  -->
        <label for="drug_price">
            Price <
            <select name="drug_price" id="drug_price">
                <?php
                    $val = 100;
                    while ($val <= 5000){
                        echo "<option value='$val'>$val</option>";
                        $val += 100;
                    }
                ?>
                <option value="none" selected>none</option>
            </select>
        </label>
        <br>
        <label for="drug_supplier">
            Supplier:
            <select name="drug_supplier" id="drug_supplier">
                <?php
                $cn = pg_connect("host=10.119.71.46 port=5432 dbname=deep_web user=postgres password=heslo");

                $suppliers = pg_query($cn, "SELECT supplier_name FROM supplier");
                while ($res = pg_fetch_object($suppliers)) {
                    echo "
                        <option value='$res->supplier_name'>$res->supplier_name</option>    
                    ";
                }
                ?>
                <option value="none" selected>none</option>
            </select>
        </label>
        <br>
        <label for="drug_name">
            Drug:
            <select name="drug_name" id="drug_name">
                <?php
                $cn = pg_connect("host=10.119.71.46 port=5432 dbname=deep_web user=postgres password=heslo");

                $suppliers = pg_query($cn, "SELECT drug_name FROM drug");
                while ($res = pg_fetch_object($suppliers)) {
                    echo "
                        <option value='$res->drug_name'>$res->drug_name</option>    
                    ";
                }
                ?>
                <option value="none" selected>none</option>
            </select>
        </label>
        <br>
        <!--  Radio buttons  -->
        Clean percentage: <label for="clean">clean <input type="radio" id="clean" name="quality" value="clean"></label>
        <label for="medium">medium <input type="radio" id="medium" name="quality" value="medium"></label>
        <label for="dirty">dirty <input type="radio" id="dirty" name="quality" value="dirty"></label>
        <br>
        Availability: <label for="on_street">on street <input type="radio" id="on_street" name="availability"
                                                              value="on_street"></label>
        <label for="delivery">delivery <input type="radio" id="delivery" name="availability" value="delivery"></label>
        <label for="warehouse">warehouse <input type="radio" id="warehouse" name="availability"
                                                value="warehouse"></label>
        <!-- Check boxes -->
        <br>
        Consistence: <label for="checkbox_dried">dried <input type="checkbox" id="checkbox_dried"
                                                              name="checkbox_dried" value="dried"></label>
        <label for="checkbox_liquid">liquid <input type="checkbox" id="checkbox_liquid" name="checkbox_liquid"
                                                   value="liquid"></label>
        <label for="checkbox_powder">powder <input type="checkbox" id="checkbox_powder" name="checkbox_powder"
                                                   value="powder"></label>
        <label for="checkbox_sniffgas">sniffgas <input type="checkbox" id="checkbox_sniffgas"
                                                       name="checkbox_sniffgas" value="sniffgas"></label>
        <br>
        User rating: <label for="checkbox_rating_1">0-1 <input type="checkbox" id="checkbox_rating_1"
                                                               name="checkbox_rating_1" value="1"></label>
        <label for="checkbox_rating_2">1-2 <input type="checkbox" id="checkbox_rating_2"
                                                  name="checkbox_rating_2" value="2"></label>
        <label for="checkbox_rating_3">2-3 <input type="checkbox" id="checkbox_rating_3"
                                                  name="checkbox_rating_3" value="3"></label>
        <label for="checkbox_rating_4">3-4 <input type="checkbox" id="checkbox_rating_4"
                                                  name="checkbox_rating_4" value="4"></label>
        <label for="checkbox_rating_5">4-5 <input type="checkbox" id="checkbox_rating_5"
                                                  name="checkbox_rating_5" value="5"></label>
        <br>
        <!-- Text box   -->
        <input type="text" name="textbox" id="textbox" placeholder="Enter a keyword">
        <br>
        <input type="submit">
    </form>
</div>
<!--Generated by php from psql -->
<div id="results">
    <h2>Results</h2>
    <table>
        <?php
        include "rest_api.php"
        ?>
    </table>
</div>
<script src="filled_form.js">
</script>
</body>
</html>
