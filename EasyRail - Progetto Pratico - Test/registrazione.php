<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /");
}
else {
    $dbconn = pg_connect("host=localhost port=5432 dbname=Easyrail 
                user=daddo password=biar") 
                or die('Could not connect: ' . pg_last_error());
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrati</title>
    <link href="stile.css" rel="stylesheet">
    <link rel="icon" href="pictures/LogoEasyRail.jpg" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
    <body>
        <?php
            if ($dbconn) {
                $email = $_POST['InputEmail'];
                $q1="select * from utente where email= $1";
                //metto tutto dentro mail
                $result=pg_query_params($dbconn, $q1, array($email));
                //controlla se esiste
                if ($tuple=pg_fetch_array($result, null, PGSQL_ASSOC)) {?>
                    <script >
                    Swal.fire({
  title: "<strong>Errore nella registrazione</strong>",
  icon: "error",
  html: `<b>L'email  <?= $_POST['InputEmail']?> è già utilizzata</b>`,
  focusConfirm: false,
  confirmButtonText: `
    <a style="color:white" href="Register.html" class="fa fa-thumbs-up">Riprova!</a>`
});

                    </script>
                <?php
                }
                //inserisce tutto in database
                else {
                    $nome = $_POST['InputName'];
                    $cognome = $_POST['InputSurname'];
                    $password =$_POST['InputPassword'];
                    $q2 = "insert into utente values ($1,$2,$3,$4)";
                    $data = pg_query_params($dbconn, $q2,
                        array($email, $nome, $cognome, $password));
                    if ($data) {
                        ?>
                    <script >
                    Swal.fire({
  title: "<strong>L'accesso è stato effettuato correttamente</strong>",
  icon: "success",
  html: `<b>Effettua il login per iniziare ad utilizzare il sito!</b>`,
  focusConfirm: false,
  confirmButtonText: `
    <a style="color:white" href="Login.html" class="fa fa-thumbs-up">Loggati!</a>`
});

                    </script> <?php
                    }
                }
            }
        ?> 
    </body>
</html>