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
            <a href="HomePage.php">Home</a>
            <a class="center" href="TrainStato.php">Stato treno</a>
        </nav>
    </header>
    <?php 
    $dbconn = pg_connect("host=localhost dbname=EasyRail_2 user=daddo password=biar port=5432"); 
//PRENDO TUTTI I DATI DEL FORM
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
    <div class="form-2" style="text-align:center;">
        <br><a class="button" href="formand.php" value="Ritorno"> Visualizza i treni di Andata </a>
    </div> <?php
        $data = '2024-06-08';
						$ora= date("H:i:s");
                        $oggi= date("Y-m-d");
						if($data == $ritorno){
              $queryrit ="select * from treno where destinazione like '$partenza' and partenza like '$arrivo' and codice >= 1050 and codice <=1063";
              $res=pg_query($queryrit) or die ('Query failed: ' . pg_last_error());    
              if (pg_fetch_array($res, null, PGSQL_ASSOC)){ ?>
    <div class="form-2" style="width:auto;margin-left: auto;margin-right: auto;">
        <div class="card-body">
            <div class="table-responsive-lg" style="width:100%;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Codice</th>
                            <th>Stazione di partenza</th>
                            <th>Stazione di arrivo</th>
                            <th>Orario di partenza</th>
                            <th>Orario di arrivo</th>
                            <th colspan="2">Prenotazione</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = pg_fetch_array($res,NULL,PGSQL_ASSOC)){
                         if($row['hpartenza']> $ora&&$oggi == $ritorno){?>
                        <td><?php echo $row['codice']; ?></td>
                        <td><?php echo $row['partenza']; ?></td>
                        <td><?php echo $row['destinazione']; ?></td>
                        <td><?php echo $row['hpartenza']; ?></td>
                        <td><?php echo $row['harrivo']; ?></td>
                        <td> <?php 
							if(isset($_SESSION['name'])!=NULL){
                              ?> <a class="button"
                                href="pagamento.php?prezzo=<?php echo $row['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                ECONOMY </a>
                            <?php }      else{
      echo '<a  class="button" href="HomePage.php">  LOGIN</a>';
    } ?> </td>
                        <td> <?php 
							if(isset($_SESSION['name'])!=NULL){
                              ?> <a class="button"
                                href="pagamento.php?prezzo=<?php echo $row['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                PRIMA </a>
                            <?php }      else{
      echo '<a  class="button" href="HomePage.php">  LOGIN </a>';
    } ?> </td>
                        <?php                      
            }else if($oggi != $ritorno) //FARE CONTROLLO IF (GIORNO DIVERSO DA OGGI MOSTRA TUTTO)
            { ?>
                        <tr>
                            <td><?php echo $row['codice']; ?></td>
                            <td><?php echo $row['partenza']; ?></td>
                            <td><?php echo $row['destinazione']; ?></td>
                            <td><?php echo $row['hpartenza']; ?></td>
                            <td><?php echo $row['harrivo']; ?></td>
                            <td> <?php 
							if(isset($_SESSION['name'])!=NULL){
                              ?> <a class="button"
                                    href="pagamento.php?prezzo=<?php echo $row['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                    ECONOMY </a>
                                <?php }      else{
                                    echo '<form><a  class="button" href="HomePage.php">  LOGIN</a> </form>';
                                } ?> </td>
                            <td> <?php 
							if(isset($_SESSION['name'])!=NULL){
                              ?> <a class="button"
                                    href="pagamento.php?prezzo=<?php echo $row['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                    PRIMA </a>
                                <?php }      else{
                                    echo '<form><a  class="button" href="HomePage.php">  LOGIN</a> </form>';
                                } ?> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <?php
        }}}else{
        echo '<form><h1>non ci sono treni da prentoare <h1></form>';
    }}else{
    $queryrit ="select * from treno where destinazione like '$partenza' and partenza like '$arrivo'";
    $res=pg_query($queryrit) or die ('Query failed: ' . pg_last_error()); 
    if (pg_fetch_array($res, null, PGSQL_ASSOC)){
      ?><div class="form-2" style="width:auto;margin-left: auto;margin-right: auto;">
        <div class="table-responsive-lg">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Codice</th>
                        <th>Stazione di partenza</th>
                        <th>Stazione di arrivo</th>
                        <th>Orario di partenza</th>
                        <th>Orario di arrivo</th>
                        <th colspan="2">Prenotazione</th>
                    </tr>
                </thead>
                <tbody> <?php
    while ($row = pg_fetch_array($res,NULL,PGSQL_ASSOC)){
      if($row['hpartenza']> $ora&&$oggi == $andata){ ?>
                    <tr>
                        <td><?php echo $row['codice']; ?></td>
                        <td><?php echo $row['partenza']; ?></td>
                        <td><?php echo $row['destinazione']; ?></td>
                        <td><?php echo $row['hpartenza']; ?></td>
                        <td><?php echo $row['harrivo']; ?></td>
                        <td> <?php 
							if(isset($_SESSION['name'])!=NULL){
                              ?> <a class="button"
                                href="pagamento.php?prezzo=<?php echo $row['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                ECONOMY </a>
                            <?php }      else{
                                    echo '<form><a  class="button" href="HomePage.php">  LOGIN</a> </form>';
                                } ?> </td>
                        <td> <?php 
							if(isset($_SESSION['name'])!=NULL){
                              ?> <a class="button"
                                href="pagamento.php?prezzo=<?php echo $row['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                PRIMA </a>
                            <?php }      else{
                                    echo '<form><a  class="button" href="HomePage.php">  LOGIN</a> </form>';
                                } ?> </td>
                    </tr> <?php
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
                              ?> <a class="button"
                                href="pagamento.php?prezzo=<?php echo $row['prezzoeconomy'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                ECONOMY </a>
                            <?php }      else{
                                    echo '<form><a  class="button" href="HomePage.php">  LOGIN</a> </form>';
                                } ?> </td>
                        <td> <?php 
							if(isset($_SESSION['name'])!=NULL){
                              ?> <a class="button"
                                href="pagamento.php?prezzo=<?php echo $row['prezzoprima'];?>&orariopartenza=<?php echo $row['hpartenza'];?>&orariodestinazione= <?php echo $row['harrivo']; ?>&codice= <?php echo $row['codice']; ?>">
                                PRIMA </a>
                            <?php }      else{
                                    echo '<form><a  class="button" href="HomePage.php">  LOGIN</a> </form>';
                                } ?> </td>
                    </tr> <?php
  }  }}else{
    echo '<form><h1>non ci sono treni da prenotare <h1></form>';
    }}?> </td>
                </tbody>
            </table>
        </div>
    </div>
</main>
</body>

</html>