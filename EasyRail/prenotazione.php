<!DOCTYPE html>
<?php session_start();
$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");	?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EasyRail</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
		img {
			height: 120px;
			margin: -25px 0 0 0%;
		}
	</style>
</head>
<main>
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
				<a class="center" href="HomePage.php">Home</a>
				<a class="center" style="margin-right:1%;" href="TrainStato.php">Stato treno</a>
			</nav>
		</header>
		<body>
    <form style="padding: 25px; min-width: 545px;">
<?php
//Prendo tutti i dati utili dalle diverse variabili di sessioni
//imposto le diverse variabili di stato
    $stato= $_SESSION["stato"];
    $email = $_SESSION['email'];
    $codicetemp = $_SESSION['codicetemp'];
	$hpartenzatemp= $_SESSION['hpartenzatemp'];
	$harrivotemp= $_SESSION['harrivotemp'];
	$datapartenzatemp = $_SESSION['datapartenzatemp'];
        $q1="select * from prenotazione where email= $1 and codice = $2 and hpartenza=$3 and harrivo=$4 and datapartenza=$5";
        $result=pg_query_params($dbconn, $q1, array($email,$codicetemp,$hpartenzatemp,$harrivotemp,$datapartenzatemp));
		if(isset($_SESSION['ok'])){
		$q2="select * from prenotazione where email= $1 and codice = $2 and hpartenza=$3 and harrivo=$4 and datapartenza=$5";
        $result2=pg_query_params($dbconn, $q2, array($email, $_SESSION['codice'], $_SESSION['orariopartenza'],$_SESSION['orariodestinazione'],$_SESSION['datapartenza']));
		if (pg_fetch_array($result2, null, PGSQL_ASSOC) && isset($_SESSION['ok'])){
			$_SESSION['ritornoprenotato']= 'test';
			echo'<h1 style="text-align:center;">HAI GIÀ EFFETTUATO LA PRENOTAZIONE DEL TRENO DI RITORNO</h1> <BR>';
			echo "<table style=\"width: 100%;\"><tr>";	
			echo '<td style="text-align:center;"><div style="float:left;"><a style="text-align:center;" class="button"  href="HomePage.php" value="Ritorno"> Torna alla Homepage </a></td>';
            echo '<td style="text-align:center;"><img src="pictures/no-ticket.jpg" href="HomePage.php"></img></td>';
			echo '<td style="text-align:right;"><a style="text-align:center;" class="button"  href="profilo.php" value="profilo"> Visualizza nel profilo</a></div></td>';
			echo "</table></tr>";	
		}else{
		$_SESSION['ritornoprenotato']='falso';}
		}else{$_SESSION['ritornoprenotato'] = 'falso';}
        //controlla se il treno di andata si trova nel DB
        if (pg_fetch_array($result, null, PGSQL_ASSOC)){
				$_SESSION['andataprenotato']='test';
                echo'<h1 style="text-align:center;">HAI GIÀ EFFETTUATO LA PRENOTAZIONE DEL TRENO DI ANDATA</h1> <BR>';
			echo "<table style=\"width: 100%;\"><tr>";	
			echo '<td><div style="float:left;"><a style="text-align:center;" class="button"  href="HomePage.php" value="Ritorno"> Torna alla Homepage </a></td>';
            echo '<td style="text-align:center;"><img src="pictures/no-ticket.jpg" href="HomePage.php"></img></td>';
			echo '<td style="text-align:right;"><a style="text-align:center;" class="button"  href="profilo.php" value="profilo"> Visualizza nel profilo</a></div></td>';
			echo "</table></tr>";	
		}else{
		$_SESSION['andataprenotato']='falso';}
        if ($_SESSION['ritornoprenotato'] != 'test' && $_SESSION['andataprenotato'] != 'test'){
		$query1="select * from prenotazione";
		//QUERY PRENOTAZIONE ANDATA
		$result=pg_query($dbconn,$query1);
		$row=pg_num_rows($result);
		$row= 1000 + $row;
		$query = "insert into prenotazione values ($2,$1,$3,$4,$5,$6)";
        $data = pg_query_params($dbconn, $query, array($email,$_SESSION['codicetemp'],$row,$_SESSION['hpartenzatemp'],$_SESSION['harrivotemp'],$_SESSION['datapartenzatemp']));
		echo'<h1>PRENOTAZIONE DEL TRENO DI ANDATA EFFETTUATA CORRETTAMENTE!</h1> <BR>';
		//QUERY PRENOTAZIONE RITORNO
		if(isset($_SESSION['ok'])){
			unset($_SESSION['ok']);
		$result=pg_query($dbconn,$query1);
		$row=pg_num_rows($result);
		$row= 1000 + $row;
		$query = "insert into prenotazione values ($2,$1,$3,$4,$5,$6)";
        $data = pg_query_params($dbconn, $query, array($email,$_SESSION['codice'],$row,$_SESSION['orariopartenza'],$_SESSION['orariodestinazione'],$_SESSION['datapartenza']));
		//Mostra diversi bottoni/messaggio di conferma
		echo'<h1>PRENOTAZIONE DEL TRENO DI RITORNO EFETTUATA CORRETTAMENTE!</h1> <BR>';
		}
        if($stato != 'ritorno'){
            unset($_SESSION['stato']);
			echo "<table style=\"width: 100%;\"><tr>";	
			echo '<td><div style="text-align:center;float:left;"><a style="text-align:center;" class="button" href="HomePage.php" value="Ritorno"> Torna alla Homepage </a></td>';
            echo '<td style="text-align:center;"><img src="pictures/acquisto.jpg" href="HomePage.php"></img></td>';
			echo '<td style="text-align:right;"><a style="text-align:center;" class="button"  href="profilo.php" value="profilo"> Visualizza nel profilo</a></div></td>';
			echo "</table></tr>";	
        }else{
            echo '<div style="text-align:center;"><a " class="button" href="formrit.php" value="Ritorno"> Prenota il ritorno </a></div>';
        }

        }
		unset($_SESSION['stato']);
		unset($_SESSION['ritornoprenotato']);
		unset($_SESSION['andataprenotato']);?>
</form>
     </body>
	</main>
     </html>