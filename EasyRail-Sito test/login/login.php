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
	<title>Login</title>
	<link rel="stylesheet" href="/assets/login.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
    <body>
        <?php
        session_start();
            if ($dbconn) {
                $email = $_POST['InputEmail'];
                $q1 = "select * from utente where email= $1";
                $result = pg_query_params($dbconn, $q1, array($email));
                if (!($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                    ?>
                    <script >
                    Swal.fire({
  title: "<strong>Errore nell'accesso</strong>",
  icon: "error",
  html: `<b>Non sembra che ti sia registrato</b>`,
  focusConfirm: false,
  confirmButtonText: `
    <a style="color:white" href="../registrazione/registro.php" class="fa fa-thumbs-up">Registrati!</a>`
});

                    </script> <?php                }
                else {
                    $password =$_POST['InputPassword'];
                    $q2 = "select * from utente where email = $1 and paswd = $2";
                    $result = pg_query_params($dbconn, $q2, array($email,$password));
                    if (!($tuple=pg_fetch_array($result, null, PGSQL_ASSOC))) {
                        ?>
                    <script >
                    Swal.fire({
  title: "<strong>Errore nell'accesso</strong>",
  icon: "error",
  html: `<b>La password e' sbagliata!</b>`,
  focusConfirm: false,
  confirmButtonText: `
    <a style="color:white" href="Login.html" class="fa fa-thumbs-up">Riprova!</a>`
});

                    </script> <?php                     }
                    else {
                        $nome = $tuple['nome'];
                        $_SESSION['name']=$tuple['nome'];
                        $_SESSION['email']=$tuple['email'];
                        header("location:../HomePage.php");
                    }
                }
            }
        ?> 
    </body>
</html>