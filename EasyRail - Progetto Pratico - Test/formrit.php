<body>
   <?php 
    $dbconn = pg_connect("host=localhost port=5432 dbname=Easyrail 
                user=daddo password=biar") 
                or die('Could not connect: ' . pg_last_error());
session_start(); 
 
//PRENDO TUTTI I DATI DEL FORM
if(isset($_SESSION['name'])){
  $nome = $_SESSION['name'];
  $email = $_SESSION['email'];
}
$arrivo = $_SESSION['arr'];
$ritorno = $_SESSION['dataRit'];
$partenza = $_SESSION['part'];
$andata = $_SESSION['dataAnd'];

//QUERYANDATA
    $queryrit ="select * from viaggi where arrivo like '%$partenza%' and andata ='$ritorno'";
    $result=pg_query($dbconn,$queryrit) or die ('Query failed: ' . pg_last_error());    
    while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){
    echo '<br><br>Codice Treno: ' .$row['codice'];
    $codice=$row['codice'];
    $_SESSION['codice'] = $codice;
    echo '<br /> Stazione di Partenza: ' .$row['partenza'];
    echo '<br /> Stazione di Arrivo: '.$row['arrivo'];
    echo '<br /> Data Andata:'.$row['andata'];
    echo '<br /> oario di partenza:'.$row['orariopartenza'];
    echo '<br /> oario di arrivo:'.$row['orarioarrivo'];
    echo '<br /> Posti disponibili:'.$row['passeggeri'];
    if(isset($_SESSION['name'])!=NULL){
      echo '<br> <a href="prenotazione.php"> PRENOTA </a>';    }
      else{
      echo '<br> <a href="HomePage.php"> EFFETTUA LOGIN PER PRENOTARE </a>';
      echo '<br><a class="button" href="formand.php" value="Ritorno"> Andata </a>';

    }
  }


  pg_free_result($result);
  pg_close($dbconn);

   ?>
     </body>