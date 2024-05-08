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
			<a class="titolo" href="HomePage.php">EasyRail</a>
				<?php if(isset($_SESSION['name'])){?>
					<div class="log dropdown">
						<button class="dropbtn"><?= $_SESSION['name']?></button>
						<div class="dropdown-content">
							<?php if($_SESSION['name'] == 'Admin'){ ?>
							<a href="Admin.php">Area Admin</a>
							<a href="logout.php">Logout</a>
							<?php }else{?>
							<a href="profilo.php">Area Personale</a>
							<a href="logout.php">Logout</a>
							<?php } ?>
						</div>
					</div>
					<?php }else{?>
					<div class="log dropdown">
						<button class="dropbtn">Accedi</button>
					<div class="dropdown-content">
						<a href="Login.html">Login</a>
						<a href="Register.html">Registrati</a>
					</div>
				</div>
				<?php }?>
				<a class="active center" href="HomePage.php">Home</a>
				<a class="center" href="TrainStato.php">Stato treno</a>
				<a class="center" href="FindTicket.html">Trova biglietto</a>
			</nav>
		</header>
	<main>
		<form action="TrainStatus.php" method="post" style="margin-top: 60px auto 60px auto;">
			<div class="formhead">Visualizza informazioni</div>
			<table style="margin: 20px 0 20px 0;">
				<tr>
					<p>
					<td><label for="ct">Codice treno </label></td>
					<td><input type="number" name="ct" id="ct" placeholder=" codice identificativo" required></td>
					</p>
				</tr>
			</table>
			<p>
				<div style="text-align: center;">
				<input class="button" type="submit" value="Cerca" id="cerca">
				</div>
			<p>
		</form>
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