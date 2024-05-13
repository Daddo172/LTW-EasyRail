<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stato treno</title>
	<link href="stile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
	<link rel="icon" href="pictures/LogoEasyRail.jpg" type="image">
	<script>src="funzioni.js"</script>
	<style>
		th {
			font-weight: 600;
		}
		td {
			padding: 0px 10px 0px 10px;
		}
		/*Barra orizzontale avanzamento treno*/
		.horizontal-bar {
			color: white;
			text-align: center;
			overflow: hidden;
		}
		/*Zona lampeggiante*/
		@keyframes blinker {
			50% {
				background-color: rgb(100, 100, 240);
			}
		}
		.blinking {
			animation: blinker 3s linear infinite;
		}
		@keyframes slide {
			0% {
				left: -110%;
			}
			100% {
				left: 125%;
			}
		}
		img {
			position: relative;
			margin-top: 2px;
			width: 48px;
			animation: slide 3s linear infinite;
		}
	</style>
</head>
<body>
	<header class="topnav">
		<nav>	
			<a class="titolo" href="HomePage.html" ALT="EasyRail">EasyRail</a>
			<div class="log dropdown">
				<button class="dropbtn">Accedi</button>
				<div class="dropdown-content">
					<a href="Login.html">Login</a>
					<a href="Register.html">Registrati</a>
				</div>
			</div>
			<a class="center" href="HomePage.html">Home</a>
			<a class="active center" href="TrainStatus.html">Stato treno</a>
		</nav>
	</header>
	<main>
	<?php
	$dbconn = pg_connect("host=localhost dbname=EasyRail_2 user=daddo password=biar port=5432");
	session_start();
	if ($_POST==null&&$_GET==NULL) goto RETRY;
	else {
		if($_POST==null){
			$ct=$_GET["codice"];
		}
		else{
		$ct = $_POST["ct"];
	}
		if (!is_numeric($ct)) goto RETRY;
		$query = "SELECT * from trenoCompleto where codice=$1";
		$result = pg_query_params($dbconn, $query, array($ct));
		$tuple = pg_fetch_assoc($result);
		//Rimostra form ma stavolta con messaggio di errore
		if ($tuple==false) {
RETRY:			echo "<form action=\"TrainStatus.php\" method=\"post\" style=\"margin-top: 60px auto 60px auto;\">
			<div class=\"formhead\">Visualizza informazioni</div>
			<table style=\"margin: 20px 0 20px 0;\">
				<tr>
					<p>
					<td><label for=\"ct\">Codice treno </label></td>
					<td><input type=\"number\" name=\"ct\" id=\"ct\" placeholder=\" codice identificativo\" required></td>
					</p>
				</tr>
				<tr>
					<td></td>
					<td style=\"color: rgb(200, 0, 0);\">Treno non trovato, inserisci un altro codice</td>
				</tr>
			</table>
			<p>
				<div style=\"text-align: center;\">
				<input class=\"button\" type=\"submit\" value=\"Cerca\" id=\"cerca\">
				</div>
			<p>
		</form>";
		} else {
		//Header del risultato
		echo "<div class=train-status>";
		echo "<table style=\"font-size: 24px; width: 90%;\"><tr>
		<td>EasyRail #$ct</td>" . "<td style=\"text-align: right;\">" . date("d/m/Y") . "</td>";
		echo "</tr></table>";
		//Subheader
		echo "<div style=\"border-bottom: solid 1px black; padding-bottom: 10px;\">";
		echo "Da " .
		"<span style=\"font-weight: 600;\">" . $tuple["f0"] . "</span>" .
		' a ' .
		"<span style=\"font-weight: 600;\">" . $tuple["f5"] . "</span><br>";
		echo "</div>";
		//Box blu stato treno
		echo  "<p>Stato treno:";
//		$ora = date("20:59:59");
//		$ora = date("10:30:00");
		$ora = date("H:i:s");
		if ($ora < $tuple["hf0"]) {
		echo "<span class=box-stato>NON PARTITO</span>";
		} elseif ($ora >= $tuple["hf5"]) {
			echo "<span class=box-stato>FINE CORSA</span>";
		}
		else echo "<span class=box-stato>IN VIAGGIO</span>";
		echo "</p>";
		//Tabella con tutti i dati + barra
		echo "<p>";
		echo "<table style=\"max width: 60%; text-align: left;\">";
		$i = 0; $c = 0;
		echo "<tr>";
		echo "<th>Fermata</th>";

		foreach($tuple as $index => $value) {
			if (preg_match("/\bf\d/", $index)) {
				if ($value!="") {
					$c++;
					echo "<td style=\" text-align: center;\">" . $tuple["f$i"] . "</td>";
				}
			$i++;
			}
		}
		echo "</tr>";
		/*Non sono riuscito a distanziare le righe in altro modo mi dispiace*/
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		
		echo "<tr>";
		echo "<th>Orario partenza</th>";
		$i = 0;
		foreach($tuple as $index => $value) {
			if (preg_match("/\bhf\d/", $index)) {
				if ($value!="") {
					echo "<td  style=\"text-align: right;\">" . date("H:i", strtotime($tuple["hf$i"])) . "</td>";
				}
			$i++;
			}
		}
		echo "</tr>";
		/*Hehehehehe pt.2*/
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		echo "<tr><td></td></tr>";
		
		echo "<tr>
				<th>Avanzamento</th>";
		//Colorazione delle sezioni della barra orizzontale
		$lampeggiante = true;
		for ($c = 0; $c < 6; $c++) {
			$orafermata = $tuple["hf$c"];
			$n = $c - 1;
			for (; $n >= 0; $n--) {
				if ($tuple["hf$n"] != NULL)
					$orafermataprec = $tuple["hf$n"];
					break;
			}
			if ($orafermata!=NULL) {
				/*Lampeggiante*/
				if ($lampeggiante && $ora < $orafermata && $n >= 0 && $ora >= $orafermataprec) {
					echo "<td class=\"horizontal-bar blinking\" style=\"background-color: rgb(16, 16, 104); text-align: left;";
					if ($c==5) {
						echo "border-top-right-radius: 20px; border-bottom-right-radius: 20px;\">";
					}
					else {
						echo "\">";
					}
					echo "<img src=\"pictures/minitreno.png\">";
					$lampeggiante = false;
				}
				/*Grigio*/
				elseif ($ora < $orafermata) {
					if ($c==0) {
						echo "<td class=\"horizontal-bar\" style=\"background-color: rgb(200, 200, 200); border-top-left-radius: 20px; border-bottom-left-radius: 20px;\">";
					}
					elseif ($c==5) {
						echo "<td class=\"horizontal-bar\" style=\"background-color: rgb(200, 200, 200); border-top-right-radius: 20px; border-bottom-right-radius: 20px;\">";
					}
					else {
						echo "<td class=\"horizontal-bar\" style=\"background-color: rgb(200, 200, 200);\">";
					}
				}
				/*Blu*/
				elseif ($ora >= $orafermata) {
					if ($c==0) {
						echo "<td class=\"horizontal-bar\" style=\"background-color: rgb(16, 16, 104); border-top-left-radius: 20px; border-bottom-left-radius: 20px;\">Partito &#10004;";
					}
					elseif ($c==5) {
						echo "<td class=\"horizontal-bar\" style=\"background-color: rgb(16, 16, 104); border-top-right-radius: 20px; border-bottom-right-radius: 20px;\">Arrivato &#10004;";
					}
					else {
						echo "<td class=\"horizontal-bar\" style=\"background-color: rgb(16, 16, 104);\">&#10004;";
					}
				}
			}
		}
				echo "</td>";
				echo "</tr>";
				echo "</table>";
			echo "</p>";
		echo "</div>";
		}
	}
	?>
	</main>
</body>
</html>