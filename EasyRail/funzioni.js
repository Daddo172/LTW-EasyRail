//Swap stazione partenza con stazione arrivo
function swap() {
	var stzPart = document.getElementById("part");
	var stzArr = document.getElementById("arr");
	var temp = stzPart.value;
	stzPart.value = stzArr.value;
	stzArr.value = temp;
}

//Visualizza ricerche recenti
function visualizza() {
	var contenuto = document.getElementById("risultato");
	if(contenuto.hidden==true)
		contenuto.hidden=false;
	else
		contenuto.hidden=true;
}

//Carica ricerca recente cliccata
function compila(id) {
	var re = /\u2192/u;
	var arr = id.innerHTML.split(re);
	var part = arr[0].trim();
	var arr = arr[1].trim();
	document.getElementById("part").value = part;
	document.getElementById("arr").value = arr;
}

//Controllo validità stazioni inserite
function validaStz() {
	var stzPart = document.getElementById("part").value;
	var stzArr = document.getElementById("arr").value;
	var a = document.getElementsByTagName("option");
	var c=0;
	for (var i = 0; i < a.length; i++) {
		if (stzPart.toLowerCase() == a[i].value.toLowerCase() ||
			 stzArr.toLowerCase() == a[i].value.toLowerCase())
			c++;
	}
	if (c<2) {
		document.getElementById("messaggioStz").innerHTML = "inserire stazioni di partenza e di destinazione valide"
		return false;
	}
	else
	document.getElementById("messaggioStz").innerHTML = "";
	return true;
}

//Visibilità campo Ritorno
function ritornoOnOff() {
	var rit = document.getElementById("dataRit");
	if (document.getElementById("onOff").checked) {
		document.getElementById("lr").style.opacity = "1";
		rit.style.opacity = "1";
		rit.readOnly = false;
		rit.disabled = false;
	}
	else {
		rit.value="";
		document.getElementById("lr").style.opacity = "0.5";
		rit.style.opacity = "0.5";
		rit.readOnly = true;
		rit.disabled = true;
	}
}

//Data minima impostabile
$(function() {
	var today = new Date();
	var day = today.getDate();
	var month = today.getMonth() + 1;
	var year = today.getFullYear();
	if(day < 10)
		day = '0' + day.toString();
	if(month < 10)
		month = '0' + month.toString();
	var minDate = year + '-' + month + '-' + day;
	$("#dataAnd").attr("min", minDate);
	$("#dataRit").attr("min", minDate);
	$("#dataAnd").attr("value", minDate);
	var minMonth = year + '-' + month;
	$("#scad").attr("min", minMonth);
});

//Gestione date
function vincoliDate() {
	var dataRit = document.getElementById("dataRit");
	var dataAnd = document.getElementById("dataAnd");
	if (dataAnd.value > dataRit.value)
		dataRit.value = "";
	if (!dataAnd.value == "")
		dataRit.min = dataAnd.value;
	else {
		var today = new Date();
		var day = today.getDate();
		var month = today.getMonth() + 1;
		var year = today.getFullYear();
		if(day < 10)
			day = '0' + day.toString();
		if(month < 10)
			month = '0' + month.toString();
		today = year + '-' + month + '-' + day;
		dataRit.min = today;
	}
}

//Funzioni di aumento e diminuzione numero passeggeri tramite tasti -/+
function subAdt() {
	var adt = document.getElementById("adt");
	var yng = document.getElementById("yng");
	if (parseInt(adt.value) > 0) adt.value--;
}
function addAdt() {
	var adt = document.getElementById("adt");
	var yng = document.getElementById("yng");
	if (parseInt(adt.value) + parseInt(yng.value) < 10) adt.value++;
}
function subYng() {
	var adt = document.getElementById("adt");
	var yng = document.getElementById("yng");
	if (parseInt(yng.value) > 0) yng.value--;
}
function addYng() {
	var adt = document.getElementById("adt");
	var yng = document.getElementById("yng");
	if (parseInt(adt.value) + parseInt(yng.value) < 10) yng.value++;
}
function validaPass() {
	var adt = document.getElementById("adt");
	var yng = document.getElementById("yng");
	if (parseInt(adt.value) + parseInt(yng.value) == 0) {
		document.getElementById("messaggioPass").innerHTML = "inserire almeno un passeggero";		return false;
		return false;
	}
	else
	document.getElementById("messaggioPass").innerHTML = "";
	return true;
}

//Funzione per cancellare i messaggi di errore alla pressione del tasto Cancella
function cancellaErr() {
	document.getElementById("messaggioStz").innerHTML = "";
	document.getElementById("messaggioPass").innerHTML = "";
}

//Funzione per controllare la validità del codice treno
function validaCT() {
	var re = new RegExp("[1-9][0-9]*");
	if (!re.test(document.getElementById("ct").value)) {
		document.getElementById("messaggioCT").innerHTML = "inserire un codice valido";
		return false;
	}
	else
		document.getElementById("messaggioCT").innerHTML = "";
	return true;
}

//Pagamento
//Funzione per controllare la validità del nome
function validaNC() {
	var re = new RegExp("^([A-Za-z]+)( [A-Za-z]+)+$");
	if (!re.test(document.getElementById("nc").value)) {
		document.getElementById("messaggioNC").innerHTML = "inserire un nome valido";
		return false;
	}
	else
		document.getElementById("messaggioNC").innerHTML = "";
	return true;
}

//Funzione per controllare la "validità" della carta
function validaCarta() {
	var carta = document.getElementById("carta");
	if (carta.value.length != 15 && carta.value.length != 16) {
		document.getElementById("messaggioCarta").innerHTML = "inserire un numero di carta valido";
		return false;
	}
	else
		document.getElementById("messaggioCarta").innerHTML = "";
	return true;
}

//Funzione per controllare la "validità" del CVC
function validaCVC() {
	var re = new RegExp("^[0-9]{3,4}$");
	if (!re.test(document.getElementById("cvc").value)) {
		document.getElementById("messaggioCVC").innerHTML = "inserire un CVC valido";
		return false;
	}
	else
		document.getElementById("messaggioCVC").innerHTML = "";
	return true;
}