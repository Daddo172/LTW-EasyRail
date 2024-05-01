<?php session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /");
}
else {
    $dbconn = pg_connect("host=localhost port=5432 dbname=Easyrail 
                user=daddo password=biar") 
                or die('Could not connect: ' . pg_last_error());
}

    if(isset($_POST['inputnome']))
    {
        $email=$_POST['inputemail'];
        $nome=$_POST['inputnome'];
        $cognome=$_POST['inputcognome'];
        $password=$_POST['inputpassword'];
        


        $q2 = "insert into utente values ($1,$2,$3,$4)";
        $data = pg_query_params($dbconn, $q2,
            array($email, $nome, $cognome, $password));
            header('location: admin.php');
    }

    if(isset($_POST['inputcodice']))
    {
        $codice=$_POST['inputcodice'];
        $email=$_POST['inputemail2'];
        


        $q1 = "insert into prenotazioni values ($1,$2)";
        $data = pg_query_params($dbconn, $q1,
            array($codice, $email));
            header('location: admin.php');
    }
    if(isset($_POST['inputcodice2']))
    {
        $codice=$_POST['inputcodice2'];
        $partenza=$_POST['inputpartenza'];
        $andata=$_POST['inputandata'];
        $ritorno=$_POST['inputritorno'];
        $passeggeri=$_POST['inputpasseggeri'];
        $orariopart=$_POST['inputorariopart'];
        $orarioarr=$_POST['inputorarioarr'];
        


        $q = "insert into viaggi values ($1,$2,$3,$4,$5,$6,$7,$8)";
        $data = pg_query_params($dbconn, $q,
            array($codice, $partenza, $arrivo, $andata, $ritorno, $passeggeri, $orariopart, $orarioarr));
            header('location: admin.php');
    }

    if(isset($_POST['updateemail']))
    {
        $email=$_POST['updateemail'];
        $nome=$_POST['inputnome'];
        $cognome=$_POST['inputcognome'];
        $password=$_POST['inputpassword'];

        $query = "UPDATE utente SET email='$email', nome='$nome', cognome='$cognome', paswd='$password'  WHERE email='$email'";
        $data = pg_query($dbconn,$query);
        header('location: shutente.php');
    }

    if(isset($_POST['updatecodice']))
    {
        $codice=$_POST['updatecodice'];
        $partenza=$_POST['inputpartenza'];
        $andata=$_POST['inputandata'];
        $arrivo=$_POST['inputarrivo'];
        $passeggeri=$_POST['inputpasseggeri'];
        $orariopart=$_POST['inputorariopart'];
        $orarioarr=$_POST['inputorarioarr'];

        $query = "UPDATE viaggi SET codice='$codice', partenza='$partenza', arrivo='$arrivo', andata='$andata'
        , passeggeri='$passeggeri', orariopartenza='$orariopart', orarioarrivo='$orarioarr'  WHERE codice='$codice'";
        $data = pg_query($dbconn,$query);
        header('location: shviaggi.php');
    }

    //UPDATE PRENOTAZIONE AGGIUNGERE CODICE BIGLIETTO

    if(isset($_POST['deleteemail'])){
        $email=$_POST['deleteemail'];
        $query="DELETE FROM utente WHERE email='$email'";
        $result=pg_query($dbconn,$query);
        header('location: shutente.php');
    }

    if(isset($_POST['deletecodice'])){
        $codice=$_POST['deletecodice'];
        $query="DELETE FROM viaggi WHERE codice='$codice'";
        $result=pg_query($dbconn,$query);
        header('location: shviaggi.php');
    }

    //DELETE PRENOTAZIONE AGGIUNGERE CODICE BIGLIETTO


?>