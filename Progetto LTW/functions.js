function controllaNazioneorCitta(){
    function controllaNazioneorCitta() {
        var citta = document.getElementById("input-city").value;
        var nazione = document.getElementById("input-country").value;
        if (citta == "" && nazione == "") {
            alert("Please enter at least city or country");
            return false;
        }
        return false;
    }
}