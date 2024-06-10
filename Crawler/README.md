# Průchody formulářem

* Return limit 100 -> 1742
* Return limit 55 -> 3168
* Return limit 10 -> 17420

### Klíčové pojmy

* Read limit - Udává počet kolik řad má max číst pokud není nastaveno čte dokud může či nenačte celou databázi.
* Return limit - maximální počet řádků vracených webem.

## 1) Větvící

    Postupuje formulářem začínaje prvky které nejméně ořezávají počet vrácených výsledků.
    Mělo by to zapříčinit husté rozvětvování a které budou rozhodovat finální dropdowny.
    (Textbox by byl výrazně přesnější a rychlejší pro velký return)

1) Dropdown - Price
2) Radio - Quality
3) Radio - Availability
4) Checkbox - Consistence
5) Checkbox - Rating
6) Dropdown - Drug
7) Dropdown - Supplier
8) Textbox

### Výsledky (1)

#### I. Return limit 100

* Running time: 18.12 minutes.
* Return limit: 100
* Database discovered 99.52% ( 173348 / 174192 )
* Read: 210388 lines.
* Saved: 173348 lines.
* Redundant lines read: 37040 ( 17.61% )
* Crawled: 34611 times.
* Average crawled: 6.08 lines.
* Unique lines crawled: 5.01 lines.

#### II. Return limit average(6)

* Running time: 565.41 minutes.
* Return limit: 6
* Database discovered 99.47% ( 173265 / 174192 )
* Read: 282874 lines.
* Saved: 173265 lines.
* Redundant lines read: 109609 ( 38.75% )
* Crawled: 1227811 times.
* Average crawled: 0.23 lines.
* Unique lines crawled: 0.14 lines.

#### III. Return limit 55

* Running time: 18.38 minutes.
* Return limit: 55
* Database discovered 99.5% ( 173315 / 174192 )
* Read: 199993 lines.
* Saved: 173315 lines.
* Redundant lines read: 26678 ( 13.34% )
* Crawled: 34611 times.
* Average crawled: 5.78 lines.
* Unique lines crawled: 5.01 lines.

#### IV. Return limit 10

* Running time: 114.7 minutes.
* Return limit: 10
* Database discovered 99.47% ( 173268 / 174192 )
* Read: 216618 lines.
* Saved: 173268 lines.
* Redundant lines read: 43350 ( 20.01% )
* Crawled: 239963 times.
* Average crawled: 0.9 lines.
* Unique lines crawled: 0.72 lines.

## 2) Přesný

    Začíná 2 drop downy kde rovnou určí zadavatele i drogu.
    To by mělo vést na malé větvení s malou redundancí.
    Avšak za cenu malých returnu => hodne crawlu. 

1) Dropdown - Supplier
2) Dropdown - Drug
3) Radio - Quality
4) Radio - Availability
5) Checkbox - Consistence
6) Checkbox - Rating
7) Dropdown - Price
8) Textbox

### Výsledky (2)

#### I. Return limit 100

* Running time: 8.02 minutes.
* Return limit: 100
* Database discovered 99.5% ( 173316 / 174192 )
* Read: 181080 lines.
* Saved: 173316 lines.
* Redundant lines read: 7764 ( 4.29% )
* Crawled: 14594 times.
* Average crawled: 12.41 lines.
* Unique lines crawled: 11.88 lines.

#### II. Return limit average(13)

* Running time: 7.78 minutes.
* Return limit: 13
* Database discovered 99.48% ( 173280 / 174192 )
* Read: 174294 lines.
* Saved: 173280 lines.
* Redundant lines read: 1014 ( 0.58% )
* Crawled: 14594 times.
* Average crawled: 11.94 lines.
* Unique lines crawled: 11.87 lines.

#### III. Return limit 55

* Running time: 8.06 minutes.
* Return limit: 55
* Database discovered 99.49% ( 173299 / 174192 )
* Read: 177570 lines.
* Saved: 173299 lines.
* Redundant lines read: 4271 ( 2.41% )
* Crawled: 14594 times.
* Average crawled: 12.17 lines.
* Unique lines crawled: 11.87 lines.

#### IV. Return limit 10

* Running time: 27.98 minutes.
* Return limit: 10
* Database discovered 99.48% ( 173280 / 174192 )
* Read: 318460 lines.
* Saved: 173280 lines.
* Redundant lines read: 145180 ( 45.59% )
* Crawled: 57914 times.
* Average crawled: 5.5 lines.
* Unique lines crawled: 2.99 lines.

## 3) Textbox s upřesněním

    Začíná vyplňováním klíčových slov v textboxu.
    Měl by mít naopak velmi řídké větvení (neměl by se dostat zpravidla dál než na 4).
    Avšak klíčová slova nemusí stačit na nalezení velké části databáze.

1) Textbox
2) Dropdown - Supplier
3) Radio - Quality
4) Radio - Availability
5) Checkbox - Consistence
6) Checkbox - Rating
7) Dropdown - Price
8) Dropdown - Drug

### Výsledky (3)

#### I. Return limit 100

* Running time: 6.35 minutes.
* Return limit: 100
* Database discovered 100% ( 174192 / 174192 )
* Read: 489168 lines.
* Saved: 174192 lines.
* Redundant lines read: 314976 ( 64.39% )
* Crawled: 8307 times.
* Average crawled: 58.89 lines.
* Unique lines crawled: 20.97 lines.

#### II. Return limit average(59)

* Running time: 8.48 minutes.
* Return limit: 59
* Database discovered 100% ( 174192 / 174192 )
* Read: 469183 lines.
* Saved: 174192 lines.
* Redundant lines read: 294991 ( 62.87% )
* Crawled: 13147 times.
* Average crawled: 35.69 lines.
* Unique lines crawled: 13.25 lines.

#### III. Return limit 55

* Running time: 9.16 minutes.
* Return limit: 55
* Database discovered 100% ( 174192 / 174192 )
* Read: 464703 lines.
* Saved: 174192 lines.
* Redundant lines read: 290511 ( 62.52% )
* Crawled: 13835 times.
* Average crawled: 33.59 lines.
* Unique lines crawled: 12.59 lines.

#### IV. Return limit 10

* Running time: 261.1 minutes.
* Return limit: 10
* Database discovered 100% ( 174191 / 174192 )
* Read: 650847 lines.
* Saved: 174191 lines.
* Redundant lines read: 476656 ( 73.24% )
* Crawled: 534682 times.
* Average crawled: 1.22 lines.
* Unique lines crawled: 0.33 lines.

## 4) Random

    Vybírá náhodně který atribut formuláře bude vyplňovat.

1-8. ???

### Výsledky (4)

#### I. Return limit 100

* Running time: 32.85 minutes.
* Return limit: 100
* Database discovered 99.81% ( 173856 / 174192 )
* Read: 527821 lines.
* Saved: 173856 lines.
* Redundant lines read: 353965 ( 67.06% )
* Crawled: 61822 times.
* Average crawled: 8.54 lines.
* Unique lines crawled: 2.81 lines.

#### II. Return limit average(9)

* Running time: 518.6 minutes.
* Return limit: 9
* Database discovered 99.72% ( 173696 / 174192 )
* Read: 477264 lines.
* Saved: 173696 lines.
* Redundant lines read: 303568 ( 63.61% )
* Crawled: 1137275 times.
* Average crawled: 0.42 lines.
* Unique lines crawled: 0.15 lines.

#### III. Return limit 55

* Running time: 37.72 minutes.
* Return limit: 55
* Database discovered 99.47% ( 173272 / 174192 )
* Read: 455603 lines.
* Saved: 173272 lines.
* Redundant lines read: 282331 ( 61.97% )
* Crawled: 76678 times.
* Average crawled: 5.94 lines.
* Unique lines crawled: 2.26 lines.

#### IV. Return limit 10

* Running time: 280.06 minutes.
* Return limit: 10
* Database discovered 99.52% ( 173362 / 174192 )
* Read: 423952 lines.
* Saved: 173362 lines.
* Redundant lines read: 250590 ( 59.11% )
* Crawled: 611837 times.
* Average crawled: 0.69 lines.
* Unique lines crawled: 0.28 lines.

## 5) Optimalizovaný

    neměl by nikdy jít hlouběji než do 4).
    Crawl 1) a 2) by mel byt vzdy return limit 100.
    Crawl 3) by mel byt v rozmezi 30  - 90.

1) Dropdown - Supplier
2) Radio - Quality
3) Radio - Availability
4) Checkbox - Consistence
5) Checkbox - Rating
6) Dropdown - Price
7) Dropdown - Drug
8) Textbox

### Výsledky (5)

#### I. Return limit 100

* Running time: 3.56 minutes.
* Return limit: 100
* Database discovered 100% ( 174192 / 174192 )
* Read: 274708 lines.
* Saved: 174192 lines.
* Redundant lines read: 100516 ( 36.59% )
* Crawled: 3800 times.
* Average crawled: 72.29 lines.
* Unique lines crawled: 45.84 lines.

#### II. Return limit average(73)

* Running time: 5.66 minutes.
* Return limit: 73
* Database discovered 100% ( 174192 / 174192 )
* Read: 320406 lines.
* Saved: 174192 lines.
* Redundant lines read: 146214 ( 45.63% )
* Crawled: 8360 times.
* Average crawled: 38.33 lines.
* Unique lines crawled: 20.84 lines.

#### III. Return limit 55

* Running time: 8.01 minutes.
* Return limit: 55
* Database discovered 100% ( 174192 / 174192 )
* Read: 335869 lines.
* Saved: 174192 lines.
* Redundant lines read: 161677 ( 48.14% )
* Crawled: 12515 times.
* Average crawled: 26.84 lines.
* Unique lines crawled: 13.92 lines.

#### IV. Return limit 10

* Running time: 950.93 minutes.
* Return limit: 10
* Database discovered 99.91% ( 174040 / 174192 )
* Read: 436284 lines.
* Saved: 174040 lines.
* Redundant lines read: 262244 ( 60.11% )
* Crawled: 2048767 times.
* Average crawled: 0.21 lines.
* Unique lines crawled: 0.08 lines.
