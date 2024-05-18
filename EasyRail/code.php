<?php session_start();
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /");
}
else {
$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");}

    if(isset($_POST['inputnome']))
    {
        $email=$_POST['inputemail'];
        $nome=$_POST['inputnome'];
        $cognome=$_POST['inputcognome'];
        $password=$_POST['inputpassword'];
        


        $q2 = "INSERT into utente values ($1,$2,$3,$4)";
        $data = pg_query_params($dbconn, $q2,
            array($email, $nome, $cognome, $password));
            header('location: admin.php');
    }

    if(isset($_POST['inputcodice']))
    {
        $codice=$_POST['inputcodice'];
        $email=$_POST['inputemail2'];
        $codbiglietto=$_POST['inputcodbiglietto'];
        $orariopart=$_POST['inputhpartenza'];
        $orarioarr=$_POST['inputharrivo'];
        $datapartenza=$_POST['inputdatapartenza'];
        


        $q1 = "INSERT into prenotazione values ($1,$2,$3,$4,$5,$6)";
        $data = pg_query_params($dbconn, $q1,
            array($codice, $email,$codbiglietto,$orariopart,$orarioarr,$datapartenza));
            header('location: admin.php');
    }
    if(isset($_POST['inputcodice2']))
    {
        $codice=$_POST['inputcodice2'];
        $partenza=$_POST['inputpartenza'];
        $destinazione=$_POST['inputarrivo'];
        $orariopart=$_POST['inputorariopart'];
        $orarioarr=$_POST['inputorarioarr'];
        $economy=$_POST['inputeconomy'];
        $prima=$_POST['inputprima'];
        


        $q3 = "insert into treno values ($1,$2,$3,$4,$5,$6,$7)";
        $data = pg_query_params($dbconn, $q3,
            array($codice, $partenza, $destinazione,$orariopart, $orarioarr,$economy,$prima));
            header('location: admin.php');
    }
    if(isset($_POST['inputcodice3']))
    {
        $codice=$_POST['inputcodice3'];
        $f0=$_POST['inputfermata0'];
        $f1=$_POST['inputfermata1'];
        $f2=$_POST['inputfermata2'];
        $f3=$_POST['inputfermata3'];
        $f4=$_POST['inputfermata4'];
        $f5=$_POST['inputfermata5'];
        $hf0=$_POST['inputhfermata0'];
        $hf1=$_POST['inputhfermata1'];
        $hf2=$_POST['inputhfermata2'];
        $hf3=$_POST['inputhfermata3'];
        $hf4=$_POST['inputhfermata4'];
        $hf5=$_POST['inputhfermata5'];
        


        $q4 = "insert into trenocompleto values ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13)";
        $data = pg_query_params($dbconn, $q4,
            array($codice,$f0,$f1,$f2,$f3,$f4,$f5,$hf0,$hf1,$hf2,$hf3,$hf4,$hf5));
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
        $destinazione=$_POST['inputarrivo'];
        $orariopart=$_POST['inputorariopart'];
        $orarioarr=$_POST['inputorarioarr'];
        $economy=$_POST['inputeconomy'];
        $prima=$_POST['inputprima'];

        $query = "UPDATE treno SET codice='$codice', partenza='$partenza', destinazione='$destinazione',
        , hpartenza='$orariopart', harrivo='$orarioarr', prezzoeconomy='$economy', prezzoprima='$prima'
        WHERE codice='$codice' and partenza='$partenza' and destinazione='$destinazione'";
        $data = pg_query($dbconn,$query);
        header('location: shtreno.php');
    }

    if(isset($_POST['updatecodice2']))
    {
        $codice=$_POST['updatecodice2'];
        $f0=$_POST['inputfermata0'];
        $f1=$_POST['inputfermata1'];
        $f2=$_POST['inputfermata2'];
        $f3=$_POST['inputfermata3'];
        $f4=$_POST['inputfermata4'];
        $f5=$_POST['inputfermata5'];
        $hf0=$_POST['inputhfermata0'];
        $hf1=$_POST['inputhfermata1'];
        $hf2=$_POST['inputhfermata2'];
        $hf3=$_POST['inputhfermata3'];
        $hf4=$_POST['inputhfermata4'];
        $hf5=$_POST['inputhfermata5'];

        $query = "UPDATE trenocompleto SET codice='$codice', f0='$f0', f1='$f1', f2='$f2', f3='$f3', f4='$f4', f5='$f5', hf0='$hf0',
         hf1='$hf1', hf2='$hf2', hf3='$hf3', hf4='$hf4', hf5='$hf5' WHERE codice='$codice'";
        $data = pg_query($dbconn,$query);
        header('location: shtrenocompleto.php');
    }

    if(isset($_POST['updatecodbiglietto']))
    {
        $codice=$_POST['inputcodice3'];
        $email=$_POST['inputemail2'];
        $codbiglietto=$_POST['updatecodbiglietto'];
        $orariopart=$_POST['inputhpartenza'];
        $orarioarr=$_POST['inputharrivo'];
        $datapartenza=$POST['inputdatapartenza'];

        $query = "UPDATE prenotazione SET codice='$codice', email='$email', codbiglietto='$codbiglietto',hpartenza='$orariopart' , harrivo ='$orarioarr', DataPartenza='$datapartenza' WHERE codbiglietto='$codbiglietto' and email='$email'";
        $data = pg_query($dbconn,$query);
        header('location: shprenotazioni.php');
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
        $query="DELETE FROM treno WHERE codice='$codice'";
        $result=pg_query($dbconn,$query);
        header('location: shtreno.php');
    }

    if(isset($_POST['deletecodice2'])){
        $codice=$_POST['deletecodice2'];
        $query="DELETE FROM trenocompleto WHERE codice='$codice'";
        $result=pg_query($dbconn,$query);
        header('location: shtrenocompleto.php');
    }

    if(isset($_POST['deletecodbiglietto'])){
        $codbiglietto=$_POST['deletecodbiglietto'];
        $email=$_POST['email'];
        $query="DELETE FROM prenotazione WHERE codbiglietto='$codbiglietto' and email='$email'";
        $result=pg_query($dbconn,$query);
        header('location: shprenotazioni.php');
    }

    if(isset($_POST['deletecodbiglietto2'])){
        $codbiglietto=$_POST['deletecodbiglietto2'];
        $email=$_POST['email'];
        $query="DELETE FROM prenotazione WHERE codbiglietto='$codbiglietto' and email='$email'";
        $result=pg_query($dbconn,$query);
        header('location: profilo.php');
    }

    //DELETE PRENOTAZIONE AGGIUNGERE CODICE BIGLIETTO


?>