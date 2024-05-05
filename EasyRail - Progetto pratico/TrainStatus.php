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
		}
		/*Zona lampeggiante*/
		.blinking {
			animation: blinker 3s linear infinite;
		}
		@keyframes blinker {
			50% {
				opacity: 0.5;
			}
		}
		img {
			margin-top: 2px;
			width: 48px;
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
			<a class="center" href="FindTicket.html">Trova biglietto</a>
		</nav>
	</header>
	<main>
	<?php
	$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");
	if ($_POST==null) goto RETRY;
	else {
		$ct = $_POST["ct"];
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
					<td style=\"color: rgb(160, 0, 0);\">Treno non trovato, inserisci un altro codice</td>
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
		echo "<div style=\"font-size: 24px;\">
		EasyRail #$ct - " . date("d/m/Y");
		echo "</div>";
		//Subheader
		echo "<div style=\"border-bottom: solid 1px black; padding-bottom: 10px;\">";
		echo "Da " .
		"<span style=\"font-weight: 600;\">" . $tuple["f0"] . "</span>" .
		' a ' .
		"<span style=\"font-weight: 600;\">" . $tuple["f5"] . "</span><br>";
		echo "</div>";
		//Box blu stato treno
		echo  "<p>Stato treno:";
		if (date("H:i:s") < $tuple["hf0"]) {
		echo "<span class=box-stato>NON PARTITO</span>";
		} elseif (date("H:i:s") >= $tuple["hf5"]) {
			echo "<span class=box-stato>FINE CORSA</span>";
		}
		else echo "<span class=box-stato>IN VIAGGIO</span>";
		echo "</p>";
		//Tabella con tutti i dati + barra
		echo "<p>";
		echo "<table style=\"width: 100%; text-align: left;\">";
		$i = 0; $c = 0;
		echo "<tr>";
		echo "<th>Fermata</th>";

		foreach($tuple as $index => $value) {
			if (preg_match("/\bf\d/", $index)) {
				if ($value!="") {
					$c++;
					echo "<td>" . $tuple["f$i"] . "</td>";
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
					echo "<td>" . date("H:i", strtotime($tuple["hf$i"])) . "</td>";
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
		$ora = date("H:i:s");
		$lampeggiante = true;
		for ($c = 0; $c < 6; $c++) {
			$oraproxfermata = $tuple["hf$c"];
			$n = $c - 1;
			if ($n >= 0) $orafermataprec = $tuple["hf$n"];
			if ($oraproxfermata!=NULL) {
				/*Lampeggiante*/
				if ($lampeggiante && $ora < $oraproxfermata && $ora > $orafermataprec) {
					if ($c==0) {
						echo "<td class=\"horizontal-bar blinking\" style=\"background-color: rgb(16, 16, 104); border-top-left-radius: 20px; border-bottom-left-radius: 20px;\"><img src=\"pictures/minitreno.png\">";
					}
					elseif ($c==5) 
						echo "<td class=\"horizontal-bar blinking\" style=\"background-color: rgb(16, 16, 104); border-top-right-radius: 20px; border-bottom-right-radius: 20px;\"><img src=\"pictures/minitreno.png\">";
					
					else {
						echo "<td class=\"horizontal-bar blinking\" style=\"background-color: rgb(16, 16, 104);\"><img src=\"pictures/minitreno.png\">";
					}
					$lampeggiante = false;
				}
				/*Grigio*/
				elseif ($ora < $oraproxfermata) {
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
				elseif ($ora >= $oraproxfermata) {
					if ($c==0) {
						echo "<td class=\"horizontal-bar\" style=\"background-color: rgb(16, 16, 104); border-top-left-radius: 20px; border-bottom-left-radius: 20px;\">&#10004;";
					}
					elseif ($c==5) {
						echo "<td class=\"horizontal-bar\" style=\"background-color: rgb(16, 16, 104); border-top-right-radius: 20px; border-bottom-right-radius: 20px;\">&#10004;";
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