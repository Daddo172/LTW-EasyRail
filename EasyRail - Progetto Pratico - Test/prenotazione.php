<?php
    session_start();
    $dbconn = pg_connect("host=localhost port=5432 dbname=Easyrail 
                user=daddo password=biar") 
                or die('Could not connect: ' . pg_last_error());
    $stato= $_SESSION["stato"];
    $email = $_SESSION['email'];
    $codice = $_SESSION['codice'];
        $q1="select * from prenotazioni where email= $1 and codice = $2";
        $result=pg_query_params($dbconn, $q1, array($email,$codice));
        //controlla se esiste
        if (pg_fetch_array($result, null, PGSQL_ASSOC)){
                echo'Hai già prenotato';
                if($stato != 'ritorno')
                    echo '<a class="button" href="HomePage.php" value="Ritorno"> Torna HomepAge </a>';
                else{
                    echo '<a class="button" href="formrit.php" value="Ritorno"> Prenota il ritorno </a>';
                }
            }
        else{
            $query = "insert into prenotazioni values ($2,$1)";
        $data = pg_query_params($dbconn, $query, array($email, $codice));
        echo '<a class="button" href="HomePage.php" value="Ritorno"> Torna HomepAge </a>';

        }
?>