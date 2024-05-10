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

    td {
        padding: 15px;
    }
    </style>
</head>

<body style="background: url(pictures/back3.jpg) no-repeat; background-size: cover; background-position: center;">
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
                <a class="active center" href="HomePage.php">Home</a>
                <a class="center" href="TrainStato.php">Stato treno</a>
            </nav>
        </header>
        <div class="train-status">
            <?php
    $dbconn = pg_connect("host=localhost dbname=EasyRail_2 user=daddo password=biar port=5432");

//PRENDO TUTTI I DATI DEL FORM
if(isset($_SESSION['stato'])!=NULL){
$arrivo = $_SESSION['arr'];
$ritorno = $_SESSION['dataRit'];
$partenza = $_SESSION['part'];
$andata = $_SESSION['dataAnd'];
}
else{
$partenza = $_POST['part'];
$arrivo = $_POST['arr'];
$andata = $_POST['dataAnd'];
$ritorno = ($_POST['dataRit']);
}

if(isset($_SESSION['name'])){
  $nome = $_SESSION['name'];
  $email = $_SESSION['email'];
}

$_SESSION['part'] = $partenza;
$_SESSION['dataAnd'] = $andata;
$_SESSION['arr'] = $arrivo;
$_SESSION['dataRit'] = $ritorno;



//QUERYANDATA?>
            <div class="card-body">
                <table class="table table-bordered"><?php
				if($_SESSION['dataRit']!= ''){
    echo '<br><br><a class="button" href="formrit.php" value="Ritorno"> Ritorno </a>';
    $_SESSION["stato"]='ritorno';
	}
else{
  $_SESSION["stato"]='andata';
} 
						$data = '2024-06-08';
						$ora= date("H:i:s");
                        $oggi= date("Y-m-d");
						if($data == $andata)
						{
							$queryand2 ="select * from treno where partenza like '%$partenza%' and destinazione like '%$arrivo%'  and codice >= 1050 and codice <=1063";
								$result=pg_query($queryand2); 
                                if (pg_fetch_array($result, null, PGSQL_ASSOC)){?>
                    <table>
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Stazione di partenza</th>
                                <th>Stazione di arrivo</th>
                                <th>Orario di partenza</th>
                                <th>Orario di arrivo</th>
                                <th>Prenotazione</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
								while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){
								if($row['hpartenza']> $ora&&$oggi == $andata){?>
                            <tr>
                                <td><?php echo $row['codice']; ?></td> <?php
                            ?><td><?php echo $row['partenza']; ?></td>
                                <td><?php echo $row['destinazione']; ?></td>
                                <td><?php echo $row['hpartenza']; ?></td>
                                <td><?php echo $row['harrivo']; ?></td>
                                <td> <?php
														if(isset($_SESSION['name'])!=NULL){
								?> <a class="button" href="prenotazione.php?orariopartenza=<?php echo $row['hpartenza'];?>
                                &orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>"> PRENOTA </a> <?php }
								else{
								echo '<a  class="button" href="HomePage.php"> EFFETTUA LOGIN PER PRENOTARE </a>';
														}  
								}else if($oggi != $andata) //FARE CONTROLLO IF (GIORNO DIVERSO DA OGGI MOSTRA TUTTO)
                                                    { ?>
                                                        <tr>
                                <td><?php echo $row['codice']; ?></td>
                                <td><?php echo $row['partenza']; ?></td>
                                <td><?php echo $row['destinazione']; ?></td>
                                <td><?php echo $row['hpartenza']; ?></td>
                                <td><?php echo $row['harrivo']; ?></td>
                                <td> <?php
														if(isset($_SESSION['name'])!=NULL){
								?> <a class="button" href="prenotazione.php?orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>"> PRENOTA </a> <?php }
								else{
								echo '<a  class="button" href="HomePage.php"> EFFETTUA LOGIN PER PRENOTARE </a>';
                                                    }

						        } 
                            ?> </td>
                        </tbody>
                    </table> <?php
                    }}else{
                    echo '<form><h1>non ci sono treni da prentoare <h1></form>';
                }
                }
                    else{
    $queryand ="select * from treno where partenza like '%$partenza%' and destinazione like '%$arrivo%'" ;
    $result=pg_query($queryand) or die ('Query failed: ' . pg_last_error()); 
    if (pg_fetch_array($result, null, PGSQL_ASSOC)){
    ?><table>
                        <thead>
                            <tr>
                                <th>Codice</th>
                                <th>Stazione di partenza</th>
                                <th>Stazione di arrivo</th>
                                <th>Orario di partenza</th>
                                <th>Orario di arrivo</th>
                                <th>Prenotazione</th>
                            </tr>
                        </thead>
                        <tbody> <?php
    while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){
		if($row['hpartenza']> $ora&&$oggi==$andata){?>

                            <tr>
                                <td><?php echo $row['codice']; ?></td>
                                <td><?php echo $row['partenza']; ?></td>
                                <td><?php echo $row['destinazione']; ?></td>
                                <td><?php echo $row['hpartenza']; ?></td>
                                <td><?php echo $row['harrivo']; ?></td>
                                <td> <?php 
							if(isset($_SESSION['name'])!=NULL){
                              ?>  <a class="button" href="prenotazione.php?orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>"> PRENOTA </a> <?php }      else{
      echo '<a  class="button" href="HomePage.php"> EFFETTUA LOGIN PER PRENOTARE </a>';
    }  }else if($oggi != $andata) //FARE CONTROLLO IF (GIORNO DIVERSO DA OGGI MOSTRA TUTTO)
    { ?>
        <tr>
<td><?php echo $row['codice']; ?></td>
?><td><?php echo $row['partenza']; ?></td>
<td><?php echo $row['destinazione']; ?></td>
<td><?php echo $row['hpartenza']; ?></td>
<td><?php echo $row['harrivo']; ?></td>
<td> <?php
        if(isset($_SESSION['name'])!=NULL){
?><a class="button" href="prenotazione.php?orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>"> PRENOTA </a> <?php }
else{
echo '<a  class="button" href="HomePage.php"> EFFETTUA LOGIN PER PRENOTARE </a>';
    }

} 
}
}else{
    echo '<form><h1>non ci sono treni da prentoare <h1></form>';
    }}?> </td>
                        </tbody>
                    </table>

            </div>
    </main>
</body>

</html>