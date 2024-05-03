<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stato treno</title>
	<link href="stile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
	<link rel="icon" href="pictures/LogoEasyRail.jpg" type="image/x-icon">
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
			$ct = $_POST["ct"];
			$query = "SELECT 1 from trenoCompleto where codice=$1";
			$result = pg_query_params($dbconn, $query, array($ct));
			$tuple = pg_fetch_array($result, null, PGSQL_ASSOC);
			if (!$tuple) {
				echo"Treno non trovato, riprova";
			} else {
				echo "treno $ct<br>partenza:";
				echo $tuple["f0"];
				echo " alle ore ";
				echo $tuple["hf0"];
			}
		?>
	</main>
	<footer>
		<table>
			<tr>
				<td>
					<p>EasyRail &copy;</p>
					<p>Un progetto per LTW (Linguaggi e Tecnologie per il Web) - A.A. 2023/24 - Prof. Lorenzo Marconi</p>
				</td>
			<tr>	
				<td>Capitale Sociale 0&euro;. Fondatori: Mirelli&Scolamiero<p>Tutti i diritti riservati.</p></td>
				<td colspan="">Sede legale Università La Sapienza<br>Edificio Marco Polo, Viale Scalo San Lorenzo, 82, Roma</td>
			</tr>
		</table>
	</footer>
</body>
</html>