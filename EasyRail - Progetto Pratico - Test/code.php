<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /");
}
else {
    $dbconn = pg_connect("host=localhost port=5432 dbname=Easyrail 
                user=daddo password=biar") 
                or die('Could not connect: ' . pg_last_error());
}
session_start();
    if(isset($_POST['inputnome']))
    {
        $email=$_POST['inputemail'];
        $nome=$_POST['inputname'];
        $cognome=$_POST['inputcognome'];
        $password=$_POST['inputpassword'];
        


        $q2 = "insert into utente values ($1,$2,$3,$4)";
        $data = pg_query_params($dbconn, $q2,
            array($email, $nome, $cognome, $password));
        if($data)
        {
            header('location: admin.php');
        }
        else
        {
            header('location: insert.php');
        }
    }
    if(isset($_POST['inputcodice']))
    {
        $codice=$_POST['inputcodice'];
        $email=$_POST['inputemail2'];
        


        $q1 = "insert into prenotazioni values ($1,$2)";
        $data = pg_query_params($dbconn, $q1,
            array($codice, $email));
        if($data)
        {
            header('location: admin.php');
        }
        else
        {
            header('location: insert.php');
        }
    }
    if(isset($_POST['inputcodice2']))
    {
        $codice=$_POST['inputcodice2'];
        $partenza=$_POST['inputpartenza'];
        $arrivo=$_POST['inputarrivo'];
        $andata=$_POST['inputandata'];
        $ritorno=$_POST['inputritorno'];
        $passeggeri=$_POST['inputpasseggeri'];
        $orariopart=$_POST['inputorariopart'];
        $orarioarr=$_POST['inputorarioarr'];
        


        $q = "insert into viaggi values ($1,$2,$3,$4,$5,$6,$7,$8)";
        $data = pg_query_params($dbconn, $q,
            array($codice, $partenza, $arrivo, $andata, $ritorno, $passeggeri, $orariopart, $orarioarr));
        if($data)
        {
            header('location: admin.php');
        }
        else
        {
            header('location: insert.php');
        }
    }


?>