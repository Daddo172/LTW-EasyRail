<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stato treno</title>
	<link href="stile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
	<link rel="icon" href="pictures/LogoEasyRail.jpg" type="image">
	<style>
		th {
			font-weight: 600;
		}
		th, td {
			padding: 5px;
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
		if ($_POST==null) echo "nessun codice inserito";
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
			//(DA TERMINARE) Tabella con tutti i dati + barra
			echo "<p>";
			echo "<table style=\"width: 100%; text-align: left;\">";
			echo "<tr><th>Fermata</th><th>Orario</th><th style=\"text-align: right;\">Avanzamento</th><tr>";
			$i = 0;
			foreach($tuple as $index => $value) {
				if (preg_match("/\bf\d/", $index)) {
					if ($value!="") {
						echo "<tr>";
						echo "<td>" . $tuple["f$i"] . "</td>";
						echo "<td>" . $tuple["hf$i"]. "</td>";
						echo "<td style=\"text-align: center;\">barra</td>";
						echo "</tr>";
					}
				$i++;
				}
			}
			echo "</table>";
			echo "</p>";
			echo "</div>";
			}
		}
		?>
	</main>
</body>
</html>