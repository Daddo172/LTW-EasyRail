//Swap stazione partenza con stazione arrivo
function swap() {
	var stzPart = document.getElementById("part");
	var stzArr = document.getElementById("arr");
	var temp = stzPart.value;
	stzPart.value = stzArr.value;
	stzArr.value = temp;
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
		alert("Inserire stazioni di partenza e di destinazione valide");
		return false;
	}
	return true;
}

//Visibilità campo Ritorno
function ritornoOnOff() {
	var rit = document.getElementById("dataRit");
	if (document.getElementById("onOff").checked) {
		document.getElementById("lr").style.display = "inline";
		rit.style.display = "inline";
	}
	else {
		rit.value="";
		document.getElementById("lr").style.display = "none";
		rit.style.display = "none";
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
	$("#dataAnd").attr("value", minDate);
	$("#dataRit").attr("min", minDate);
});

//Gestione date
function vincoliDate() {
	var maxDateAnd = document.getElementById("dataRit").value;
	if (maxDateAnd < document.getElementById("dataAnd").value)
		document.getElementById("dataRit").value="";
	var minDateRit = document.getElementById("dataAnd").value;
	document.getElementById("dataRit").min = minDateRit;
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
		alert("Inserire almeno un passeggero");
		return false;
	}
	return true;
}
