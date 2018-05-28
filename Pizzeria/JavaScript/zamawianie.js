class DaneZamowienia {
    constructor() {
        this.pizza = "";
        this.rozmiar = "";
        this.napoj = "";
        this.adres = "";
        this.telefon = "";
    }

    pokazPizze() {
        console.log("Pizza: " + this.pizza);
    }
}

var listaZamowien = [];

function pokazWartosc(identity) {
    var wartosc = document.getElementById(identity).value;
    alert(wartosc);
}   



function zapiszDane() {
    console.log("zapisuje...");
    const zamowienie = new DaneZamowienia();

    zamowienie.pizza = document.getElementById("rodzajPizzy").value;
    zamowienie.rozmiar = document.getElementById("rozmiarPizzy").value;
    zamowienie.napoj= document.getElementById("napoj").value;
    zamowienie.adres = document.getElementById("adres").value;
    zamowienie.telefon= document.getElementById("numerTelefonu").value;

    if(zamowienie.adres != "" && zamowienie.telefon != "") {

        listaZamowien.push(zamowienie); // Dodaj do listy zamowien

        var i;
        for(i=0; i<listaZamowien.length; i++) {
            console.log(listaZamowien[i]);
        }

        var podsumowanie = document.getElementsByClassName("podsumowanie");
        podsumowanie[0].innerHTML += zamowienie.pizza + " " + zamowienie.rozmiar + ", " + zamowienie.napoj + "<br/>"; // Dopisz do div'a

        console.log("Zapisano!");
    
    }
    else {
        alert('Uzupełnij pola adres i zamówienie');
    }

}

function wyslijZamowienie() {
    console.log("wysyłam...");
}
