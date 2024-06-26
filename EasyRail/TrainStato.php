<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stato treno</title>
	<link href="stile.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
	<link rel="icon" href="pictures/LogoEasyRail.jpg" type="image/x-icon">
	<script src="funzioni.js"></script>
</head>
<body>
<header class="topnav">
			<nav>
				<a class="titolo" href="HomePage.php">EasyRail</a>
				<?php if(isset($_SESSION['name'])){?>
					<div class="log dropdown">
						<button class="dropbtn"><?= $_SESSION['name']?></button>
						<div class="dropdown-content">
							<?php if($_SESSION['name'] == 'Admin'){ 
								header("location:Admin.php");?>
							
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
				<a class="center" href="HomePage.php">Home</a>
				<a class="active center" style="margin-right:1%;" href="TrainStato.php">Stato treno</a>
			</nav>
		</header>
	<main>
		<form action="TrainStatus.php" method="post" onsubmit="return validaCT();" style="margin: 60px auto 60px auto;">
			<div class="formhead">Visualizza informazioni</div>
			<table style="margin: 20px auto 20px auto">
				<tr>
					<p>
					<td><label for="ct">Codice treno </label></td>
					<td><input type="number" id="ct" oninput="validaCT()" placeholder=" codice identificativo" required></td>
					<tr><td></td><td><div id="messaggioCT" style="color: rgb(200, 0, 0);"></div></td></tr>
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
</body>
</html>