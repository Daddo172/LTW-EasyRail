<!DOCTYPE html>
<html lang="en">
<?php session_start();  ?>

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
            <a class="center" href="TrainStato.php">Stato treno</a>
        </nav>
    </header>
    <?php 
$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");//PRENDO TUTTI I DATI DEL FORM
if(isset($_SESSION['name'])){
  $nome = $_SESSION['name'];
  $email = $_SESSION['email'];
}
$arrivo = $_SESSION['arr'];
$ritorno = $_SESSION['dataRit'];
$partenza = $_SESSION['part'];
$andata = $_SESSION['dataAnd'];
$_SESSION["stato"]='andata';
//QUERYANDATA ?>
    <div class="form-2" style="	background: rgb(200, 200, 200);text-align:center;">
        <a class="button" href="formand.php" value="Ritorno"> Visualizza i treni di Andata </a>
    </div> <?php
        $data = '2024-06-08';
		$ora= date("H:i:s");
        $oggi= date("Y-m-d");
 if($data == $ritorno)
    {
        ?>    <div class="form-2" style="width:80%;margin-left: auto;margin-right: auto;">
                <div class="card-body">
                        <div class="table-responsive-lg" style="border:5px outset;">
                            <table class="table table-bordered">
                                <thead>
                                <h1 style="text-align:center;color:black;">TRENI PRENOTABILI:</h1>

                                    <tr>
                                        <th>Codice</th>
                                        <th>Stazione di partenza</th>
                                        <th>Stazione di arrivo</th>
                                        <th>Orario di partenza</th>
                                        <th>Orario di arrivo</th>
                                        <th colspan="2" class="text-center">Prenotazione</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($oggi != $ritorno){
                                        $queryand ="select * from treno where partenza like '%$arrivo%' and destinazione like '%$partenza%'  and codice >= 1050 and codice <=1063 ORDER BY hpartenza";
                                        $result=pg_query($queryand) or die ('Query failed: ' . pg_last_error()); 
                                        if(pg_fetch_array($result,NULL,PGSQL_ASSOC)){
                                        while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){
                                                              ?>
                                                    <tr>
                                                        <td><?php echo $row['codice']; ?></td>
                                                        <td><?php echo $row['partenza']; ?></td>
                                                        <td><?php echo $row['destinazione']; ?></td>
                                                        <td><?php echo $row['hpartenza']; ?></td>
                                                        <td><?php echo $row['harrivo']; ?></td>
                                                        <td> <?php 
                                                            if(isset($_SESSION['name'])!=NULL){
                                                                ?> <form style="margin-top: -10px;"><a class="button"
                                                                    href="pagamento.php?prezzo=<?php echo $row['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                                                    ECONOMY </a></form>
                                                            <?php }      else{
                                                                    echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> LOGIN</a> </form>';
                                                                } ?> </td>
                                                        <td> <?php 
                                                            if(isset($_SESSION['name'])!=NULL){
                                                                ?> <form style="margin-top: -10px;"><a class="button"
                                                                    href="pagamento.php?prezzo=<?php echo $row['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                                                    PRIMA </a></form>
                                                            <?php }      else{
                                                                    echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> LOGIN</a> </form>';
                                                                } ?> </td>
                                                    </tr> <?php
                                                            }} else{
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                               }
                                                            }
                                        if($oggi==$ritorno){
                                            $queryand2 ="select * from treno where partenza like '%$arrivo%' and destinazione like '%$partenza%'  and codice >= 1050 and codice <=1063 ORDER BY hpartenza";
                                            $result2=pg_query($queryand2) or die ('Query failed: ' . pg_last_error()); 
                                            if(pg_fetch_array($result2,NULL,PGSQL_ASSOC)){
                                            while ($row2 = pg_fetch_array($result2,NULL,PGSQL_ASSOC)){
                                
                                                                if($row2['hpartenza']> $ora&&$oggi == $ritorno){ ?>
                                                    <tr>
                                                        <td><?php echo $row2['codice']; ?></td>
                                                        <td><?php echo $row2['partenza']; ?></td>
                                                        <td><?php echo $row2['destinazione']; ?></td>
                                                        <td><?php echo $row2['hpartenza']; ?></td>
                                                        <td><?php echo $row2['harrivo']; ?></td>
                                                        <td> <?php 
                                                               if(isset($_SESSION['name'])!=NULL){
                                                                   ?> <form style="margin-top: -10px;"><a class="button"
                                                                    href="pagamento.php?prezzo=<?php echo $row2['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                                                    ECONOMY </a></form>
                                                            <?php }      else{
                                                                       echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> LOGIN</a> </form>';
                                                                   } ?> </td>
                                                        <td> <?php 
                                                               if(isset($_SESSION['name'])!=NULL){
                                                                   ?> <form style="margin-top: -10px;"><a class="button"
                                                                    href="pagamento.php?prezzo=<?php echo $row2['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                                                    PRIMA </a></form>
                                                            <?php }      else{
                                                                       echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> LOGIN</a> </form>';
                                                                   } ?> </td>
                                                    </tr> <?php
                                                               }
                                                               }} else{
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                                echo'<td>NULL</td>';
                                                               }
                                                            }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </span>
                </div>
            </div> <?php
                            
                            }
                            else{
            $queryand ="select * from treno where partenza like '%$arrivo%' and destinazione like '%$partenza%' ORDER BY hpartenza" ;
            $result=pg_query($queryand) or die ('Query failed: ' . pg_last_error()); 
        
            ?> <div class="form-2" style="width:auto;margin-left: auto;margin-right: auto;">
                <div class="table-responsive-lg" style="border:5px outset;">
                    <table class="table table-bordered">
                        <thead>
                        <h1 style="text-align:center;color:black;">TRENI PRENOTABILI:</h1>

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
            //RICERCA IN DATA DIVERSA DA QUELLA ODIERNA
            if($oggi != $ritorno){
                $queryand ="select * from treno where partenza like '%$arrivo%' and destinazione like '%$partenza%' ORDER BY hpartenza" ;
                $result=pg_query($queryand) or die ('Query failed: ' . pg_last_error()); 
                if(pg_fetch_array($result,NULL,PGSQL_ASSOC)){
                while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){
                                      ?>
                            <tr>
                                <td><?php echo $row['codice']; ?></td>
                                <td><?php echo $row['partenza']; ?></td>
                                <td><?php echo $row['destinazione']; ?></td>
                                <td><?php echo $row['hpartenza']; ?></td>
                                <td><?php echo $row['harrivo']; ?></td>
                                <td> <?php 
                                    if(isset($_SESSION['name'])!=NULL){
                                        ?> <form style="margin-top: -10px;"><a class="button"
                                            href="pagamento.php?prezzo=<?php echo $row['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                            ECONOMY </a></form>
                                    <?php }      else{
                                            echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> LOGIN</a> </form>';
                                        } ?> </td>
                                <td> <?php 
                                    if(isset($_SESSION['name'])!=NULL){
                                        ?> <form style="margin-top: -10px;"><a class="button"
                                            href="pagamento.php?prezzo=<?php echo $row['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                            PRIMA </a></form>
                                    <?php }      else{
                                            echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> LOGIN</a> </form>';
                                        } ?> </td>
                            </tr> <?php
                                    }} else{
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                       }
                                    }
                if($oggi==$ritorno){
                    $queryand2 ="select * from treno where partenza like '%$arrivo%' and destinazione like '%$partenza%' ORDER BY hpartenza" ;
                    $result2=pg_query($queryand2) or die ('Query failed: ' . pg_last_error()); 
                    if(pg_fetch_array($result2,NULL,PGSQL_ASSOC)){
                    while ($row2 = pg_fetch_array($result2,NULL,PGSQL_ASSOC)){
        
                                        if($row2['hpartenza']> $ora&&$oggi == $ritorno){ ?>
                            <tr>
                                <td><?php echo $row2['codice']; ?></td>
                                <td><?php echo $row2['partenza']; ?></td>
                                <td><?php echo $row2['destinazione']; ?></td>
                                <td><?php echo $row2['hpartenza']; ?></td>
                                <td><?php echo $row2['harrivo']; ?></td>
                                <td> <?php 
                                       if(isset($_SESSION['name'])!=NULL){
                                           ?> <form style="margin-top: -10px;"><a class="button"
                                            href="pagamento.php?prezzo=<?php echo $row2['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                            ECONOMY </a></form>
                                    <?php }      else{
                                               echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> LOGIN</a> </form>';
                                           } ?> </td>
                                <td> <?php 
                                       if(isset($_SESSION['name'])!=NULL){
                                           ?> <form style="margin-top: -10px;"><a class="button"
                                            href="pagamento.php?prezzo=<?php echo $row2['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                            PRIMA </a></form>
                                    <?php }      else{
                                               echo '<form style="margin-top: -10px;"><a  class="button" href="Login.html"> LOGIN</a> </form>';
                                           } ?> </td>
                            </tr> <?php
                                       }
                                       }} else{
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                        echo'<td>NULL</td>';
                                       }
                                    }}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        </body>
        
        </html>