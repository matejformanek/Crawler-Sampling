const url = window.location.search;
const urlParams = new URLSearchParams(url);
if (urlParams.get('drug_price'))
    document.getElementById('drug_price').value = urlParams.get('drug_price');
if (urlParams.get('drug_supplier'))
    document.getElementById('drug_supplier').value = urlParams.get('drug_supplier');
if (urlParams.get('drug_name'))
    document.getElementById('drug_name').value = urlParams.get('drug_name');
const quality = urlParams.get('quality');
if (quality)
    document.getElementById(quality).checked = true;
const availability = urlParams.get('availability');
if (availability)
    document.getElementById(availability).checked = true;
if (urlParams.get('checkbox_dried'))
    document.getElementById('checkbox_dried').checked = true;
if (urlParams.get('checkbox_liquid'))
    document.getElementById('checkbox_liquid').checked = true;
if (urlParams.get('checkbox_powder'))
    document.getElementById('checkbox_powder').checked = true;
if (urlParams.get('checkbox_sniffgas'))
    document.getElementById('checkbox_sniffgas').checked = true;
if (urlParams.get('checkbox_rating_1'))
    document.getElementById('checkbox_rating_1').checked = true;
if (urlParams.get('checkbox_rating_2'))
    document.getElementById('checkbox_rating_2').checked = true;
if (urlParams.get('checkbox_rating_3'))
    document.getElementById('checkbox_rating_3').checked = true;
if (urlParams.get('checkbox_rating_4'))
    document.getElementById('checkbox_rating_4').checked = true;
if (urlParams.get('checkbox_rating_5'))
    document.getElementById('checkbox_rating_5').checked = true;
if (urlParams.get('textbox'))
    document.getElementById('textbox').value = urlParams.get('textbox');
