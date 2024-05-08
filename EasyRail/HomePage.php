<!DOCTYPE html>
<?php session_start(); 
unset($_SESSION['stato']);
?>
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
				<a class="active center" href="HomePage.php">Home</a>
				<a class="center" href="TrainStato.php">Stato treno</a>
				<a class="center" href="FindTicket.html">Trova biglietto</a>
			</nav>
		</header>

	<!--Carousel di messaggi promozionali/codici sconto-->
	<div class="carousel-container">
		<div class="carousel my-carousel carousel--translate">
			<input class="carousel__activator" type="radio" name="carousel" id="1" checked="checked"/>
			<input class="carousel__activator" type="radio" name="carousel" id="2"/>
			<input class="carousel__activator" type="radio" name="carousel" id="3"/>

			<div class="carousel__controls">
				<label class="carousel__control carousel__control--forward" for="2"></label>
				<label class="carousel__control carousel__control--backward" for="3"></label>
			</div>
			<div class="carousel__controls">
				<label class="carousel__control carousel__control--backward" for="1"></label>
				<label class="carousel__control carousel__control--forward" for="3"></label>
			</div>
			<div class="carousel__controls">
				<label class="carousel__control carousel__control--backward" for="2"></label>
				<label class="carousel__control carousel__control--forward" for="1"></label>
			</div>
			<div class="carousel__track">
				<li class="carousel__slide" style="text-align: center;">
					<p>Viaggia in serenità e risparmia con EasyRail!</p>
					<p>Solo per questa settimana, 20% di sconto sulla tariffa Economy, con codice sconto
						<span style="background-color: white; font-weight: bold; padding: 2px 6px 2px 6px; border-radius: 6px;">LTW24</span>
					</p>
					<p>Posti disponibili: 50.000.</p>
				</li>
				<li class="carousel__slide" style="text-align: left; padding: 30px 0px 0px 50px; background-color: white;">
					<table style="background-color: yellow; border-radius: 10px;">						
						<tr>
							<td style="font-size: 80px; padding: 0px 0px 10px 30px;">&#x26A0;</td>
							<td style="font-size: 25px; padding: 0px 40px 10px 0px;">ATTENZIONE</td>
						</tr>
					</table>
					<p style="margin: 3% 10% 3% 1%;">Si informano i viaggiatori che per lavori di potenziamento infrastrutturale la tratta
						<span style="text-decoration: underline 1px;">Milano-Torino sarà chiusa al traffico ferroviario</span>
						per tutta la giornata di sabato 8 giugno 2024. 
						<span style="text-decoration: underline 1px;">Tutti i treni che coinvolgono tale tratta sono cancellati.</span>
					</p>
				</li>
				<li class="carousel__slide" style="text-align: right;">
					<div style="margin-right: 40px; min-width: 100px;">
						<h1>Con EasyRail</h1>
						<p>Scopri le principali città italiane a<br>prezzi imbattibili!</p>
						<p>Le nostre destinazioni sono:<br>Roma, Milano, Venezia, Napoli,<br>Firenze, Bologna e Torino.</p>
						<p>Ogni giorno, offriamo ai nostri<br>passeggeri decine di collegamenti<br>con l'efficienza del nostro servizio.</p>
					</div>
				</li>
			</div>
			<div class="carousel__indicators">
				<label class="carousel__indicator" for="1"></label>
				<label class="carousel__indicator" for="2"></label>
				<label class="carousel__indicator" for="3"></label>
			</div>
		</div>
	</div>
	
	<!--Form Cerca viaggio-->	
	<div style="text-align: center;">
		<form action="formand.php" method="post" onsubmit="return (validaStz() && validaPass());" autocomplete="off" name="form" id="form" style="min-width: 666px; max-width: 666px; margin-bottom: 90px;">
			<div class="formhead">Cerca viaggio</div> 
			<p>
				<label for="part">Da</label>
				<input list="stazioni" name="part" id="part" maxlength="27" placeholder=" inserisci stazione di partenza">
				<button onclick="swap()" class="swap" type="button">&rlarr;</button>
				<label for="arr">A</label>
				<input list="stazioni" name="arr" id="arr" maxlength="27" placeholder=" inserisci stazione di arrivo">

				<datalist id="stazioni">
					<option value="Bologna Centrale"></option>
					<option value="Firenze Santa Maria Novella"></option>
					<option value="Milano Centrale"></option>
					<option value="Napoli Centrale"></option>
					<option value="Roma Termini"></option>
					<option value="Torino Porta Nuova"></option>
					<option value="Venezia Santa Lucia"></option>
				</datalist>
			</p>
			<p>
				<table><tr>
					<td style="padding: 0px 10px 0px 7px;">Andata e ritorno</td>
					<td><input onclick="ritornoOnOff()" class="checkbox" type="checkbox" id="onOff" name="onOff">
					<label for="onOff" class="toggle"></label></td>
				</tr></table>
			</p>
			<p>
				<label for="dataAnd">Andata</label>
				<input oninput="vincoliDate()" type="date" name="dataAnd" id="dataAnd" style="width: 160px;">
				<label for="dataRit" id="lr" style="margin-left: 24px;" >Ritorno</label>
				<input oninput="vincoliDate()" type="date" name="dataRit" id="dataRit" style="width: 160px; opacity: 0.5;" >
			</p>
			<label name="pass">Passeggeri (massimo: 10)</label>
			<div class="dropdown" style="padding: 5px; border: solid 1px gray; border-radius: 5px; background-color: rgb(224, 224, 224);">
				<button class="dropbtn" type="button" name="pass" id="pass" style="background-color: rgb(224, 224, 224);">Visualizza</button>
				<div class="dropdown-content2" style="padding: 12px; border-radius: 10px;">
					<table>
						<tr>
							<td><label for="adt">Adulti</label></td>
							<td>
								<button type="button" onclick="subAdt()" class="addSubPass">-</button>
								<input type="number" name="adt" id="adt" readonly value="0" style="width: 50px; border: hidden; background-color: rgb(224, 224, 224); text-align: center;" required>
								<button type="button" onclick="addAdt()" class="addSubPass">+</button>
							</td>
						</tr>
						<tr>
							<td><label for="yng">Ragazzi (&lt;25 anni)</label></td>
							<td>
								<button type="button" onclick="subYng()" class="addSubPass">-</button>
								<input type="number" name="yng" id="yng" readonly value="0" style="width: 50px; border: hidden; background-color: rgb(224, 224, 224); text-align: center;">
								<button type="button" onclick="addYng()" class="addSubPass">+</button>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<p>
				<label for="cs">Codice sconto (opzionale) </label>
				<input class="cs" type="text" name="cs" id="cs" style="width: 160px;">
			</p>
			<p>
				<div style="text-align: center;">
				<input class="button" type="submit" value="Cerca" id="cerca">
				<input class="button" type="reset" value="Cancella" id="cancella">
				</div>
			<p>
		</form>
	</div>
	</main>

	<!--Parte inferiore-->
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