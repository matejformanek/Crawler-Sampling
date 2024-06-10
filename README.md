# BI-VWM [Deep web]

## Vysledek zkoumani

[Slozka](Documentation)

## Zadání

Velká část informací na Internetu není jednoduše dostupná s využitím běžného vyhledávače. Pokud se jedná o
legální obsah, který není vyhledávačem běžně indexovaný, označujeme tuto část webu jako deep web. Jednou
z variant deep webu jsou i informace v databázi, ke kterým se lze dostat pouze s využitím webového formuláře.
V rámci projektu je potřeba nejprve navrhnout a implementovat aplikaci, která bude simulovat stránky, ze
kterých se budeme snažit získat data. Je tedy potřeba navrhnout databázi a formulářové rozhraní, přes které se na
databázi budeme dotazovat. Základním předpokladem je, že počet zobrazovaných výsledků vyhledávání je shora
omezený konstantou kmax (tj. získáme vždy k ≤ kmax výsledků, kde např. kmax = 50 nebo 100). Hlavním cílem
projektu je pak navrhnout druhou aplikaci, která bude z výše uvedené aplikace dolovat data a bude sloužit
pro rekonstrukci původní databáze.

## Prostředí

Celá aplikace běží na školním cloudu (Openstack) v Alpine distribuci. Adresa našeho serveru je 10.119.71.46. Pro
připojení je nutné být na školní síti či využívat VPN.

## Web

Běží na Apache serveru. Je napsán v PHP. Obsahuje formulář a REST API pro komunikaci s databází.

## Databáze

Běží na stejném serveru v PostgreSQL. Máme k dispozici 2 sety dat a to malý (14 516 řádků) a střední (174 192
řádků).

## Crawler

Rovněž napsán v PHP. Umí komunikovat s databází, tak aby vracela chtěný počet řádků a také umí nasazovat chtěný datový set.
Dále načítá přes web API data z databáze a ukládá je do stejné databáze.

# Nasazení

Na server stáhnout Apache a PostgreSQL.
Do apache zkopírovat složku Web.
Databázi poté nasadí crawler.

Pro inicializaci crawlera:
``composer install``
stáhne knihovny.
Může po vás chtít povolit či doinstalovat knihovny "pgsql" a "pcntl" -> (dostupné pouze na UNIX).

Pro spuštění s hodnotami nastavenými ve složce: ``composer start`` nebo ``php crawler.php``. Navíc je možné spustit s přesně 2 argumenty, kde první udává "return limit" a druhý "filler type" viz ``php crawler.php 100 2``.
