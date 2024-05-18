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
	</style>
</head>
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
				<a class="center" href="HomePage.php">Home</a>
				<a class="center" href="TrainStato.php">Stato treno</a>
			</nav>
		</header>
		<body>
    <form>
<?php
    $stato= $_SESSION["stato"];
    $email = $_SESSION['email'];
    $codice = $_SESSION['codice'];
    $arrivo = $_SESSION['arr'];
    $ritorno = $_SESSION['dataRit'];
    $partenza = $_SESSION['part'];
    $andata = $_SESSION['dataAnd'];
	//TOGLIERE SECONDI
	$hpartenza= $_SESSION['orariopartenza'];
	$harrivo= $_SESSION['orariodestinazione'];
        $q1="select * from prenotazione where email= $1 and codice = $2 and hpartenza=$3 and harrivo=$4";
        $result=pg_query_params($dbconn, $q1, array($email,$codice,$hpartenza,$harrivo));
        //controlla se esiste
        if (pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo'<h1 style="text-align:center;">HAI GIÀ EFFETTUATO LA PRENOTAZIONE DI QUESTO TRENO</h1> <BR>';
                if($stato != 'ritorno'){
                    echo '<div><div style="text-align:left;float:left;"><a style="text-align:left;" class="button"  href="HomePage.php" value="Ritorno"> Torna HomepAge </a></div>';
					echo '<div style="text-align:right;"><a style="text-align:left;" class="button"  href="profilo.php" value="profilo"> Visualizza nel profilo</a></div></div>';
                }else{
					unset($_SESSION['stato']);
                    echo '<div style="text-align:center;"><a " class="button" href="formrit.php" value="Ritorno"> Prenota il ritorno </a></div>';
                }
            }
        else{
		$query1="select * from prenotazione";
		$result=pg_query($dbconn,$query1);
		$row=pg_num_rows($result);
		$row= 1000 + $row;
		$query = "insert into prenotazione values ($2,$1,$3,$4,$5,$6)";
		if($stato != 'ritorno'){
        $data = pg_query_params($dbconn, $query, array($email, $codice,$row,$hpartenza,$harrivo,$andata));
		}else{
			$data = pg_query_params($dbconn, $query, array($email, $codice,$row,$hpartenza,$harrivo,$ritorno));
		}
		echo'<h1>PRENOTAZIONE EFFETTUATA CORRETTAMENTE!</h1> <BR>';
        if($stato != 'ritorno'){
            unset($_SESSION['stato']);
			echo '<div><div style="text-align:left;float:left;"><a style="text-align:left;" class="button"  href="HomePage.php" value="Ritorno"> Torna HomepAge </a></div>';
			echo '<div style="text-align:right;"><a style="text-align:left;" class="button"  href="profilo.php" value="profilo"> Visualizza nel profilo</a></div></div>';
        }else{

            echo '<div style="text-align:center;"><a " class="button" href="formrit.php" value="Ritorno"> Prenota il ritorno </a></div>';
        }

        }
?>
</form>
     </body>
	</main>
     </html>