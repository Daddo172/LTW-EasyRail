<body>
   <?php
    $dbconn = pg_connect("host=localhost port=5432 dbname=Easyrail 
                user=daddo password=biar") 
                or die('Could not connect: ' . pg_last_error());
session_start();   
//PRENDO TUTTI I DATI DEL FORM
if(isset($_SESSION['part'])!=NULL){
$arrivo = $_SESSION['arr'];
$ritorno = $_SESSION['dataRit'];
$partenza = $_SESSION['part'];
$andata = $_SESSION['dataAnd'];
}
else{
$partenza = $_POST['part'];
$arrivo = $_POST['arr'];
$andata = ($_POST['dataAnd']);
$ritorno = ($_POST['dataRit']);
$passeggeri = $_POST['pass'];
}
if(isset($_SESSION['name'])){
  $nome = $_SESSION['name'];
  $email = $_SESSION['email'];
}
$_SESSION['part'] = $partenza;
$_SESSION['dataAnd'] = $andata;
$_SESSION['arr'] = $arrivo;
$_SESSION['dataRit'] = $ritorno;



//QUERYANDATA
    $queryand ="select * from viaggi where partenza like '%$partenza%' and andata = '$andata'";
    $result=pg_query($queryand) or die ('Query failed: ' . pg_last_error()); 

    while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){
    echo '<br><br>Codice Treno: ' .$row['codice'];
    $codice=$row['codice'];
    $_SESSION['codice'] = $codice;
    echo '<br /> Stazione di Partenza: ' .$row['partenza'];
    echo '<br /> Stazione di Arrivo: '.$row['arrivo'];
    echo '<br /> Data Andata:'.$row['andata'];
    echo '<br /> orario di partenza:'.$row['orariopartenza'];
    echo '<br /> oario di arrivo:'.$row['orarioarrivo'];
    echo '<br /> Posti disponibili:'.$row['passeggeri'];
    if(isset($_SESSION['name'])!=NULL){
      echo '<br> <a href="prenotazione.php"> PRENOTA </a>';    }
      else{
      echo '<br> <a href="HomePage.php"> EFFETTUA LOGIN PER PRENOTARE </a>';
    }
    
    if($_POST['dataRit']!= NULL){
        echo '<br><a class="button" href="formrit.php" value="Ritorno"> Ritorno </a>';
        $_SESSION["stato"]='ritorno';
    }
    else{
      $_SESSION["stato"]='andata';

    }
  }
   ?>
     </body>