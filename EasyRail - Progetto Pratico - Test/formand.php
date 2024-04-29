<!DOCTYPE html>
<html lang="en">
	<?php session_start();  ?>
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
				<a class="titolo" href="HomePage.html">EasyRail</a>
				<?php if(isset($_SESSION['name'])){?>
					<div class="log dropdown">
						<button class="dropbtn"><?= $_SESSION['name']?></button>
						<div class="dropdown-content">
							<a href="profilo.html">Area Personale</a>
							<a href="logout.php">Logout</a>
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
				<a class="center" href="TrainStatus.html">Stato treno</a>
				<a class="center" href="FindTicket.html">Trova biglietto</a>
			</nav>
		</header>
    <form>
   <?php
    $dbconn = pg_connect("host=localhost port=5432 dbname=Easyrail 
                user=daddo password=biar") 
                or die('Could not connect: ' . pg_last_error()); 
//PRENDO TUTTI I DATI DEL FORM
if(isset($_SESSION['part'])!=NULL){
$arrivo = $_SESSION['arr'];
$ritorno = $_SESSION['dataRit'];
$partenza = $_SESSION['part'];
$andata = $_SESSION['dataAnd'];
$passeggeri = $_SESSION['adt'];
}
else{
$partenza = $_POST['part'];
$arrivo = $_POST['arr'];
$andata = ($_POST['dataAnd']);
$passeggeri = $_POST['adt'];
}
$ritorno = ($_POST['dataRit']);
if(isset($_SESSION['name'])){
  $nome = $_SESSION['name'];
  $email = $_SESSION['email'];
}

$_SESSION['part'] = $partenza;
$_SESSION['dataAnd'] = $andata;
$_SESSION['arr'] = $arrivo;
$_SESSION['dataRit'] = $ritorno;
$_SESSION['adt']=$passeggeri;



//QUERYANDATA
    $queryand ="select * from viaggi where partenza like '%$partenza%' and andata = '$andata'";
    $result=pg_query($queryand) or die ('Query failed: ' . pg_last_error()); 

    while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){
    echo 'Codice Treno: ' .$row['codice'];
    $codice=$row['codice'];
    $_SESSION['codice'] = $codice;
    echo '<br /> Stazione di Partenza: ' .$row['partenza'];
    echo '<br /> Stazione di Arrivo: '.$row['arrivo'];
    echo '<br /> Data Andata:'.$row['andata'];
    echo '<br /> orario di partenza:'.$row['orariopartenza'];
    echo '<br /> oario di arrivo:'.$row['orarioarrivo'];
    echo '<br /> Posti disponibili:'.$row['passeggeri'];
    if(isset($_SESSION['name'])!=NULL){
      echo '<a  class="button" href="prenotazione.php"> PRENOTA </a>';    }
      else{
      echo '<a  class="button" href="HomePage.php"> EFFETTUA LOGIN PER PRENOTARE </a>';
    }
  }
if($_SESSION['dataRit']!= ''){
    echo '<br><br><a class="button" href="formrit.php" value="Ritorno"> Ritorno </a>';
    $_SESSION["stato"]='ritorno';
	}
else{
  $_SESSION["stato"]='andata';

}
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