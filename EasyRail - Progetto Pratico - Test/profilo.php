<!DOCTYPE html>
<?php 
 $dbconn = pg_connect("host=localhost port=5432 dbname=Easyrail 
 user=daddo password=biar") 
 or die('Could not connect: ' . pg_last_error());
session_start();?>
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
				<a class="titolo" href="HomePage.html">EasyRail</a>
				<?php if(isset($_SESSION['name'])){?>
					<div class="log dropdown">
						<button class="dropbtn"><?= $_SESSION['name']?></button>
						<div class="dropdown-content">
							<a href="profilo.php">Area Personale</a>
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
				<a class="active center" href="HomePage.php">Home</a>
				<a class="center" href="TrainStatus.html">Stato treno</a>
				<a class="center" href="FindTicket.html">Trova biglietto</a>
			</nav>
		</header>
        <?php }?>
            <form>
                <h1>Informazioni Utente:</h1>
                <?php
                if(isset($_SESSION['name'])){
                    $nome = $_SESSION['name'];
                    $email = $_SESSION['email'];
                  }
                $query="select nome,cognome from utente where email='$email'";
                $result=pg_query($query) or die ('Query failed: ' . pg_last_error());
                while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){                 
                    echo '<br /> Email:'.$_SESSION['email'];
                    echo '<br /> Nome : ' .$row['nome'];
                    echo '<br /> Cognome : '.$row['cognome'];

                }
                ?>
            </form>
            <form>
                <h1>Treni Prenotati:</h1>
                <?php
                $query="select codice from prenotazioni where email='$email'";
                $result=pg_query($query) or die ('Query failed: ' . pg_last_error());
                while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){  
                    $codice= $row['codice'];
                    $query2="select * from viaggi where codice='$codice'";
                    $result2=pg_query($query2) or die ('Query failed: ' . pg_last_error());                           
                    while ($row2 = pg_fetch_array($result2,NULL,PGSQL_ASSOC)){
                        echo '<br /> Stazione di Partenza: ' .$row2['partenza'];
                        echo '<br /> Stazione di Arrivo: '.$row2['arrivo'];
                        echo '<br /> Data Andata:'.$row2['andata'];
                        echo '<br /> orario di partenza:'.$row2['orariopartenza'];
                        echo '<br /> oario di arrivo:'.$row2['orarioarrivo'];echo '<br>';                    }
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