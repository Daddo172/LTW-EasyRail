<!DOCTYPE html>
<html lang="en">
<?php session_start();
unset($_SESSION['temp']); 
unset($_SESSION['ok']); ?>

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
    .button {
        text-align: center;
        color: white; font-weight: bold;
        display: inline;
        border-radius: 10px;
        background-color: rgb(16, 16, 104);
        padding: 12px;
    }
    form {
	    width: 120px;
    }
    th {
        text-align: center;
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
    <?php
//connessione DB
$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");
//Prendo tutti i dati utili dal form/imposto le diverse variabili di stato
if(isset($_SESSION['stato'])!=NULL){
$arrivo = $_SESSION['arr'];
if(isset($_POST['dataRit']))
$ritorno = $_SESSION['dataRit'];
$partenza = $_SESSION['part'];
$andata = $_SESSION['dataAnd'];
$sconto=$_SESSION['sconto'];
$pass=$_SESSION['pass'];
}
else{
$partenza = $_POST['part'];
$arrivo = $_POST['arr'];
$andata = $_POST['dataAnd'];
if(isset($_POST['dataRit']))
$ritorno = $_POST['dataRit'];
$sconto =$_POST['cs'];
$pass=$_POST['adt'] + $_POST['yng'];
}

if(isset($_SESSION['name'])){
  $nome = $_SESSION['name'];
  $email = $_SESSION['email'];
}

$_SESSION['part'] = $partenza;
$_SESSION['dataAnd'] = $andata;
$_SESSION['arr'] = $arrivo;
if(isset($_POST['dataRit']))
$_SESSION['dataRit'] = $ritorno;
$_SESSION['sconto'] = $sconto;
$_SESSION['pass'] = $pass;


//Cookie per Ricerche recenti
$i = 1;
while($i <= 3) {

    //La ricerca appena fatta non deve essere uguale alla precedente
    $j = 1;
    while ($j <= 3) {
        if (isset($_COOKIE["part$j"]) && isset($_COOKIE["arr$j"]))
            $j++;
        else break;
    }
    $j--;
    if (isset($_COOKIE["part$j"]) && isset($_COOKIE["arr$j"]) &&
    $_COOKIE["part$j"]==$partenza && $_COOKIE["arr$j"]==$arrivo) {
        break;
    }

    //Se già presenti 3 ricerche recenti rimpiazza la più vecchia
    else if (isset($_COOKIE["part1"]) && isset($_COOKIE["arr1"]) &&
        isset($_COOKIE["part2"]) && isset($_COOKIE["arr2"]) &&
        isset($_COOKIE["part3"]) && isset($_COOKIE["arr3"])) {
        setcookie("part1", $_COOKIE["part2"], time() + 3600, "/");
        setcookie("arr1", $_COOKIE["arr2"], time() + 3600, "/");
        setcookie("part2", $_COOKIE["part3"], time() + 3600, "/");
        setcookie("arr2", $_COOKIE["arr3"], time() + 3600, "/");
        setcookie("part3", $partenza, time() + 3600, "/");
        setcookie("arr3", $arrivo, time() + 3600, "/");
        break;
    }

    //Inserimento
    else if (!isset($_COOKIE["part$i"]) && !isset($_COOKIE["arr$i"])) {
        setcookie("part$i", $partenza, time() + 3600, "/");
        setcookie("arr$i", $arrivo, time() + 3600, "/");
        break;
    }
    $i++;
}



//Imposto lo stato della ricerca
if(isset($_POST['dataRit'])){
$_SESSION["stato"]='ritorno';
}else{
$_SESSION["stato"]='andata';
$_SESSION["temp"] ='solo';
}
//Variabili da confrontare per i diversi controlli
$data = '2024-06-08';
$ora= date("H:i:s");
$oggi= date("Y-m-d");
//Controllo se la data è quella dei potenziamenti infrastrutturali
if($data == $andata)
{?>
<div class="form-2" style="width:100%; margin-left: auto; margin-right: auto;">
    <table style="width:50%;margin-left: auto;margin-right: auto;">
                <thead>
                    <h2 style="text-align: center; color:black;">Seleziona treno di andata</h4>
                    <div style="text-align: center; margin-bottom: 16px;">(prezzi a persona)</div>
                    <?php

//Controllo se la data è diversa da quella odierna
if($oggi != $andata){
$queryand ="select * from treno where partenza like '%$partenza%' and destinazione like '%$arrivo%'  and codice >= 1050 and codice <=1063 ORDER BY hpartenza";
$result=pg_query($queryand);
$check=pg_num_rows($result);
if($check >0){ ?>
            
                    <tr>
                        <th>Codice</th>
                        <th>Stazione di partenza</th>
                        <th>Stazione di arrivo</th>
                        <th>Orario di partenza</th>
                        <th>Orario di arrivo</th>
                        <th colspan="2" class="text-center">Prenotazione</th>
                    </tr>
                </thead>
                <tbody> <?php
    while ($row = pg_fetch_array($result)){
          ?>
                    <tr>
                        <td><?php echo $row['codice']; ?></td>
                        <td><?php echo $row['partenza']; ?></td>
                        <td><?php echo $row['destinazione']; ?></td>
                        <td><?php echo date("H:i", strtotime($row["hpartenza"])); ?></td>
                        <td><?php echo date("H:i", strtotime($row["harrivo"])); ?></td>
                        <td> <?php 
        if(isset($_SESSION['name'])!=NULL){
            ?> <form style="margin-top: -10px;"><a class="button"
                                    href="pagamento.php?prezzo=<?php echo $row['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                    ECONOMY </a>
                                    <br><br><?php
                                    if($sconto == 'LTW24'){
                                    echo 'Prezzo: <br>';  ?><del style="color: red;"> <?Php echo $row['prezzoeconomy'] . "€"; ?> </del> <?php
                                    $scont= $row['prezzoeconomy'] /100 *20;
                                    $prezzotempeco = $row['prezzoeconomy'] - $scont ;
                                    echo $prezzotempeco . "€";
                                    }else{
                                        echo 'Prezzo: <br>'; echo $row['prezzoeconomy'] . "€";
                                    }
                                    ?></form>
                            <?php }      else{
                echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> Effettua il login per acquistare</a> </form>';
            } ?> </td>
                        <td> <?php 
        if(isset($_SESSION['name'])!=NULL){
            ?> <form style="margin-top: -10px;"><a class="button"
                                    href="pagamento.php?prezzo=<?php echo $row['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                    PRIMA </a>
                                    <br><br><?php
                                    if($sconto == 'LTW24'){
                                        echo 'Prezzo: <br>';  ?><del style="color:red;"> <?Php echo $row['prezzoprima'] . "€"; ?> </del> <?php
                                        $sconto2= $row['prezzoprima'] /100 *20;
                                        $prezzotemppri = $row['prezzoprima'] - $sconto2 ;
                                        echo $prezzotemppri . "€";
                                        }else{
                                            echo 'Prezzo: <br>'; echo $row['prezzoprima'] . "€";
                                        }
                                    ?></form>
                            <?php }      else{
                echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> Effettua il login per acquistare</a> </form>';
            } ?> </td>
                    </tr> <?php
        }
        }else {
            echo "<h4 style=\"text-align:center;\">Nessun treno disponibile per la tua ricerca.</h4>";
        }}

//Controllo se la data è quella odierna
if($oggi==$andata){
$queryand2 ="select * from treno where partenza like '%$partenza%' and destinazione like '%$arrivo%'  and codice >= 1050 and codice <=1063 ORDER BY hpartenza";
$result2=pg_query($queryand2) or die ('Query failed: ' . pg_last_error()); 
$check2=pg_num_rows($result2);
if($check2 >0){ ?>
                    <tr>
                        <th>Codice</th>
                        <th>Stazione di partenza</th>
                        <th>Stazione di arrivo</th>
                        <th>Orario di partenza</th>
                        <th>Orario di arrivo</th>
                        <th colspan="2" class="text-center">Prenotazione</th>
                    </tr>
                </thead>
                <tbody> <?php
while ($row2 = pg_fetch_array($result2)){

if($row2['hpartenza']> $ora&&$oggi == $andata){ ?>
                    <tr>
                        <td><?php echo $row2['codice']; ?></td>
                        <td><?php echo $row2['partenza']; ?></td>
                        <td><?php echo $row2['destinazione']; ?></td>
                        <td><?php echo date("H:i", strtotime($row2["hpartenza"])); ?></td>
                        <td><?php echo date("H:i", strtotime($row2["harrivo"])); ?></td>
                        <td> <?php 
           if(isset($_SESSION['name'])!=NULL){
               ?> <form style="margin-top: -10px;"><a class="button"
                                    href="pagamento.php?prezzo=<?php echo $row2['prezzoeconomy'];?>&orariopartenza=<?php echo $row2['hpartenza'];?>&orariodestinazione= <?php echo $row2['harrivo']; ?>&codice= <?php echo $row2['codice']; ?>">
                                    ECONOMY </a>
                                    <br><br><?php
                                    if($sconto == 'LTW24'){
                                    echo 'Prezzo: <br>';  ?><del style="color:red;"> <?Php echo $row2['prezzoeconomy'] . "€"; ?> </del> <?php
                                    $scont= $row2['prezzoeconomy'] /100 *20;
                                    $prezzotempeco = $row2['prezzoeconomy'] - $scont ;
                                    echo $prezzotempeco . "€";
                                    }else{
                                        echo 'Prezzo: <br>'; echo $row2['prezzoeconomy'] . "€";
                                    }
                                    ?></form>
                            <?php }      else{
                   echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> Effettua il login per acquistare</a> </form>';
               } ?> </td>
                        <td> <?php 
           if(isset($_SESSION['name'])!=NULL){
               ?> <form style="margin-top: -10px;"><a class="button"
                                    href="pagamento.php?prezzo=<?php echo $row2['prezzoprima'];?>&orariopartenza=<?php echo $row2['hpartenza'];?>&orariodestinazione= <?php echo $row2['harrivo']; ?>&codice= <?php echo $row2['codice']; ?>">
                                    PRIMA </a>
                                    <br><br><?php
                                    if($sconto == 'LTW24'){
                                        echo 'Prezzo: <br>';  ?><del style="color:red;"> <?Php echo $row2['prezzoprima'] . "€"; ?> </del> <?php
                                        $sconto2= $row2['prezzoprima'] /100 *20;
                                        $prezzotemppri = $row2['prezzoprima'] - $sconto2 ;
                                        echo $prezzotemppri . "€";
                                        }else{
                                            echo 'Prezzo: <br>'; echo $row2['prezzoprima'] . "€";
                                        }
                                    ?></form>
                            <?php }      else{
                   echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> Effettua il login per acquistare</a> </form>';
               } ?> </td>
                    </tr> <?php
           }
           }}else {
            echo "<td>Nessun treno disponibile per la tua ricerca.</td>";
        }
        }
?>
                </tbody>
     <?php
//Controllo se la data è diversa da quella dei potenziamenti infrastrutturali
}else{
?> <div class="form-2" style="width:auto;margin-left: auto;margin-right: auto;">
        <div class="table-responsive-lg" style="border:5px outset;">

            <table class="table table-bordered">

                <thead>
                <h2 style="text-align: center; color:black;">Seleziona treno di andata</h4>
                <div style="text-align: center; margin-bottom: 16px;">(prezzi a persona)</div>
                    <tr>
                        <th>Codice</th>
                        <th>Stazione di partenza</th>
                        <th>Stazione di arrivo</th>
                        <th>Orario di partenza</th>
                        <th>Orario di arrivo</th>
                        <th colspan="2" class="text-center">Prenotazione</th>
                    </tr>
                </thead>
                <tbody> <?php 
//Controllo se la data è diversa da quella odierna
if($oggi != $andata){
$queryand ="select * from treno where partenza like '%$partenza%' and destinazione like '%$arrivo%' ORDER BY hpartenza" ;
$result=pg_query($queryand) or die ('Query failed: ' . pg_last_error()); 
$check=pg_num_rows($result);
                        if($check >0){
while ($row = pg_fetch_array($result)){
?>
                    <tr>
                        <td><?php echo $row['codice']; ?></td>
                        <td><?php echo $row['partenza']; ?></td>
                        <td><?php echo $row['destinazione']; ?></td>
                        <td><?php echo date("H:i", strtotime($row["hpartenza"])); ?></td>
                        <td><?php echo date("H:i", strtotime($row["harrivo"])); ?></td>
                        <td> <?php 
if(isset($_SESSION['name'])!=NULL){
?> <form style="margin-top: -10px;"><a class="button"
                                    href="pagamento.php?prezzo=<?php echo $row['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                    ECONOMY </a>
                                    <br><br><?php
                                    if($sconto == 'LTW24'){
                                    echo 'Prezzo: <br>';  ?><del style="color:red;"> <?Php echo $row['prezzoeconomy'] . "€"; ?> </del> <?php
                                    $scont= $row['prezzoeconomy'] /100 *20;
                                    $prezzotempeco = $row['prezzoeconomy'] - $scont ;
                                    echo $prezzotempeco . "€";
                                    }else{
                                        echo 'Prezzo: <br>'; echo $row['prezzoeconomy'] . "€";
                                    }
                                    ?></form>
                            <?php }      else{
echo '<form style="margin-top: -10px;"><a  class="button" style=\";\" href="Login.html"> Effettua il login per acquistare</a> </form>';
} ?> </td>
                        <td> <?php 
if(isset($_SESSION['name'])!=NULL){
?> <form style="margin-top: -10px;"><a class="button"
                                    href="pagamento.php?prezzo=<?php echo $row['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                    PRIMA </a>
                                    <br><br><?php
                                    if($sconto == 'LTW24'){
                                        echo 'Prezzo: <br>';  ?><del style="color:red;"> <?Php echo $row['prezzoprima'] . "€"; ?> </del> <?php
                                        $sconto2= $row['prezzoprima'] /100 *20;
                                        $prezzotemppri = $row['prezzoprima'] - $sconto2 ;
                                        echo $prezzotemppri . "€";
                                        }else{
                                            echo 'Prezzo: <br>'; echo $row['prezzoprima'] . "€";
                                        }
                                    ?></form>
                            <?php }      else{
echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> Effettua il login per acquistare</a> </form>';
} ?> </td>
                    </tr> <?php
}
} else{
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
}}

//Controllo se la data è quella odierna
if($oggi==$andata){
$queryand2 ="select * from treno where partenza like '%$partenza%' and destinazione like '%$arrivo%' ORDER BY hpartenza" ;
$result2=pg_query($queryand2) or die ('Query failed: ' . pg_last_error()); 
$check2=pg_num_rows($result2);
                        if($check2 >0){
while ($row2 = pg_fetch_array($result2)){

if($row2['hpartenza']> $ora&&$oggi == $andata){ ?>
                    <tr>
                        <td><?php echo $row2['codice']; ?></td>
                        <td><?php echo $row2['partenza']; ?></td>
                        <td><?php echo $row2['destinazione']; ?></td>
                        <td><?php echo date("H:i", strtotime($row2["hpartenza"])); ?></td>
                        <td><?php echo date("H:i", strtotime($row2["harrivo"])); ?></td>
                        <td > <?php 
if(isset($_SESSION['name'])!=NULL){
?> <form style="margin-top: -10px;"><a class="button" 
                                    href="pagamento.php?prezzo=<?php echo $row2['prezzoeconomy'];?>&orariopartenza=<?php echo $row2['hpartenza'];?>&orariodestinazione= <?php echo $row2['harrivo']; ?>&codice= <?php echo $row2['codice']; ?>">
                                    ECONOMY </a>
                                    <br><br><?php
                                    if($sconto == 'LTW24'){
                                    echo 'Prezzo: <br>';  ?><del style="color:red;"> <?Php echo $row2['prezzoeconomy'] . "€"; ?> </del> <?php
                                    $scont= $row2['prezzoeconomy'] /100 *20;
                                    $prezzotempeco = $row2['prezzoeconomy'] - $scont ;
                                    echo $prezzotempeco . "€";
                                    }else{
                                        echo 'Prezzo: <br>'; echo $row2['prezzoeconomy'] . "€";
                                    }
                                    ?>
                                </form>
                            <?php }      else{
echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> Effettua il login per acquistare</a> </form>';
} ?> </td>
                        <td> <?php 
if(isset($_SESSION['name'])!=NULL){
?> <form style="margin-top: -10px;"><a class="button"
                                    href="pagamento.php?prezzo=<?php echo $row2['prezzoprima'];?>&orariopartenza=<?php echo $row2['hpartenza'];?>&orariodestinazione= <?php echo $row2['harrivo']; ?>&codice= <?php echo $row2['codice']; ?>">
                                    PRIMA </a>
                                    <br><br><?php
                                    if($sconto == 'LTW24'){
                                        echo 'Prezzo: <br>';  ?><del style="color:red;"> <?Php echo $row2['prezzoprima'] . "€"; ?> </del> <?php
                                        $sconto2= $row2['prezzoprima'] /100 *20;
                                        $prezzotemppri = $row2['prezzoprima'] - $sconto2 ;
                                        echo $prezzotemppri . "€";
                                        }else{
                                            echo 'Prezzo: <br>'; echo $row2['prezzoprima'] . "€";
                                        }
                                    ?>
                                    </form>
                            <?php }      else{
echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> Effettua il login per acquistare</a> </form>';
} ?> </td>
                    </tr> <?php
}
}
} else{
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
echo'<td>NULL</td>';
}}}?>
                </tbody>
            </table>
</main>
</body>

</html>