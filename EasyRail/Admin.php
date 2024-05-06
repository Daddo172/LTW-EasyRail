<!DOCTYPE html>
<?php 
session_start();
$dbconn = pg_connect("host=localhost dbname=EasyRail_2 user=daddo password=biar port=5432");?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EasyRail</title>
	<link rel="stylesheet" href="stile.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap">
	<link rel="icon" href="pictures/LogoEasyRail.jpg" type="image/x-icon">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="funzioni.js"></script>
	<style>
		input {
			margin: 0;
			width: 240px;
		}
	</style>
</head>
<body>
	<main style="background: url(pictures/back3.jpg) no-repeat; background-size: cover; background-position: center;">
		<!--Barra superiore-->
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
            <form>
                <h1>INSERISCI DATI NEI DATABASE</h1>
                <a  class=button href="insert.php">Inserisci i dati</a>
                <?php
                ?>
            </form>
            <form>
                <h1>VISUALIZZA DATABASE UTENTE</h1>
				<a  class=button href="shutente.php">Visualizza i dati</a>
                <?php
                ?>
            </form>
			<form>
                <h1>VISUALIZZA DATABASE TRENI</h1>
				<a  class=button href="shtrenocompleto.php">Visualizza i dati</a>
                <?php
                ?>
            </form>
			<form>
                <h1>VISUALIZZA DATABASE VIAGGI</h1>
				<a  class=button href="shtreno.php">Visualizza i dati</a>
                <?php
                ?>
            </form>
			<form>
                <h1>VISUALIZZA DATABASE PRENOTAZIONI</h1>
				<a  class=button href="shprenotazioni.php">Visualizza i dati</a>
                <?php
                ?>
            </form>
        <footer class="bottom">
		<table>
			<tr>
				<td>
					<p>EasyRail &copy;</p>
					<p>Un progetto per LTW (Linguaggi e Tecnologie per il Web) - A.A. 2023/24 - Prof. Lorenzo Marconi</p>
				</td>
			<tr>	
				<td>Capitale Sociale 0&euro;. Fondatori: Mirelli&Scolamiero<p>Tutti i diritti riservati.</p></td>
				<td colspan="">Sede legale Università La Sapienza -	Edificio Marco Polo, Viale Scalo San Lorenzo, 82, Roma</td>
			</tr>
		</table>
	</footer>
</body>
</html>