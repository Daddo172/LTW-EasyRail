<!DOCTYPE html>
<?php 
     $dbconn = pg_connect("host=localhost dbname=EasyRail_2 user=daddo password=biar port=5432");
session_start();?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyRail</title>
    <link rel="stylesheet" href="stile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
			<h1>Informazioni Utente</h1>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                if(isset($_SESSION['name'])){
                    $nome = $_SESSION['name'];
                    $email = $_SESSION['email'];
                  }
                $query="select nome,cognome from utente where email='$email'";
                $result=pg_query($query) or die ('Query failed: ' . pg_last_error());
                while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){  ?>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['cognome']; ?></td>
                    <td><?php echo $email ?></td>
                    <?php

                }
                ?></tbody>
			</table>
        </div>
			</form>
        
        <form>
            <h1>Treni Prenotati</h1>
			<div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Codice</th>
                        <th>Codice Biglietto</th>
                        <th>Stazione di Partenza</th>
						<th>Stazione di Arrivo</th>
						<th>orario di partenza</th>
						<th>orario di arrivo</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                $query="select codice,codbiglietto from prenotazione where email='$email'";
                $result=pg_query($query) or die ('Query failed: ' . pg_last_error());
                while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){  
                    $codice= $row['codice'];
					$codbiglietto= $row['codbiglietto'];
                    $query2="select * from treno where codice='$codice'";
                    $result2=pg_query($query2) or die ('Query failed: ' . pg_last_error());                           
                    while ($row2 = pg_fetch_array($result2,NULL,PGSQL_ASSOC)){ ?>
						<tr><td><?php echo $row['codice']; ?></td>
                    <td><?php echo $row['codbiglietto']; ?></td>
					<td><?php echo $row2['partenza']; ?></td>
                    <td><?php echo $row2['destinazione']; ?></td>
					<td><?php echo $row2['hpartenza']; ?></td>
                    <td><?php echo $row2['harrivo']; ?></td></tr>
					<?php                 
					}
                } 
				
                ?>
				</tbody>
			</table>
        </div>
        </form>

        <footer class="bottom">
            <table>
                <tr>
                    <td>
                        <p>EasyRail &copy;</p>
                        <p>Un progetto per LTW (Linguaggi e Tecnologie per il Web) - A.A. 2023/24 - Prof.
                            Lorenzo Marconi</p>
                    </td>
                <tr>
                    <td>Capitale Sociale 0&euro;. Fondatori: Mirelli&Scolamiero<p>Tutti i diritti riservati.</p>
                    </td>
                    <td colspan="">Sede legale Università La Sapienza - Edificio Marco Polo, Viale Scalo San
                        Lorenzo, 82, Roma</td>
                </tr>
            </table>
        </footer>
</body>

</html>