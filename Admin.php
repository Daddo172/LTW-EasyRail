<!DOCTYPE html>
<?php 
session_start();
$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");?>
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
	<main>
		<!--Barra superiore-->
		<header class="topnav">
			<nav>
			<a class="titolo" >EasyRail</a>
				<?php if(isset($_SESSION['name'])){?>
					<div class="log dropdown">
						<button class="dropbtn"><?= $_SESSION['name']?></button>
						<div class="dropdown-content">
							<?php if($_SESSION['name'] == 'Admin'){ ?>
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
				<a class="active center" href="Admin.php">Area Admin</a>
				<a href="logout.php" style="margin-right: 1%;">  Logout</a>
			</nav>
		</header>
		<!-- Diversi Form per l'inserimento e la visualizzazione dei dati -->
		
			<div style="text-align:center;"></div>
            <form style="min-width:30%;margin-left: auto;margin-right: auto;">
                <h1 style="text-align:center;" >INSERISCI DATI NEI DATABASE</h1>
				<div style="text-align:center;">
				<a  class=button href="insert.php">Inserisci i dati</a></div>
				
            </form><table style="width:100%;">
				<tr><td style="width:50%;">
            <form>
                <h1 style="text-align:center;">VISUALIZZA DATABASE UTENTE</h1>
				<div style="text-align:center;">
				<a  class=button href="shutente.php">Visualizza i dati</a></div>
                <?php
                ?>
            </form>
					</td><td>
			<form style="min-width:30%;">
                <h1 style="text-align:center;">VISUALIZZA DATABASE TRENI</h1>
				<div style="text-align:center;">
				<a  class=button href="shtrenocompleto.php">Visualizza i dati</a></div>
                <?php
                ?>
            </form>
					</td></tr><tr><td>
			<form style="min-width:30%;">
                <h1 style="text-align:center;">VISUALIZZA DATABASE VIAGGI</h1>
				<div style="text-align:center;">
				<a  class=button href="shtreno.php">Visualizza i dati</a></div>
                <?php
                ?>
            </form>
					</td><td>
			<form style="min-width:30%;">
                <h1 style="text-align:center;">VISUALIZZA DATABASE PRENOTAZIONI</h1>
				<div style="text-align:center;">
				<a  class=button href="shprenotazioni.php">Visualizza i dati</a></div>
                <?php
                ?>
            </form></td></tr>
			</table>
</body>
</html>