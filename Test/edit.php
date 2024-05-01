<!DOCTYPE html>
<?php session_start();
    $dbconn = pg_connect("host=localhost port=5432 dbname=Easyrail 
                user=daddo password=biar") 
                or die('Could not connect: ' . pg_last_error());
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyRail</title>
    <link rel="stylesheet" href="stile.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap">
    <link rel="icon" href="pictures/LogoEasyRail.jpg" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <style>
    input {
        margin: 0;
        width: 240px;
    }
    </style>
</head>

<body>
    <main style="background: url(pictures/back3.jpg) no-repeat; background-size: cover; background-position: center;">
        <!--Barra superiore-->
        <header class="topnav">
            <nav>
                <a class="titolo" href="HomePage.html">EasyRail</a>
                <?php if(isset($_SESSION['name'])){?>
                <div class="log dropdown">
                    <button class="dropbtn"><?= $_SESSION['name']?></button>
                    <div class="dropdown-content">
                        <a href="profilo.php"></a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
                <?php }else{?>
                <div class="log dropdown">
                    <button class="dropbtn">Accedi</button>
                    <div class="dropdown-content">
                        <a href="./Login.html">Login</a>
                        <a href="Register.html">Registrati</a>
                    </div>
                </div>
                <?php }?>
                <a class="active center" href="HomePage.php">Home</a>
                <a class="center" href="TrainStatus.html">Stato treno</a>
                <a class="center" href="FindTicket.html">Trova biglietto</a>
            </nav>
        </header>

        <body>
            <?php if(isset($_GET['email'])){ ?>
            <DIV class="card">
                <div class="card-header">
                    <h4>MODIFICA I DATI</h4>
                </div>
                <div class="card-body">
                    <?php        
                    $email=$_GET['email'];
                    $query="SELECT * FROM utente WHERE email='$email'";
                    $result=pg_query($dbconn,$query);
                    while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))
                    {?>
                    <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;">
                        <div class="formhead">MODIFICA DATI UTENTE</div>
                        <table>
                            <tr>
                                <p>
                                    <td><label for="nome">Nome </label></td>
                                    <td><input type="text" name="inputnome" value="<?php echo $row['nome'];?>" id="nome"
                                            required></td>
                                </p>
                            </tr>
                            <tr>
                                <p>
                                    <td><label for="cognome">Cognome </label></td>
                                    <td><input type="text" name="inputcognome" value="<?php echo $row['cognome'];?>"
                                            id="cognome" required></td>
                                </p>
                            </tr>
                            <tr>
                                <p>
                                    <td><label for="pw">Password </label></td>
                                    <td><input type="password" name="inputpassword" value="<?php echo $row['paswd'];?>"
                                            id="pw" required></td>
                                </p>
                            </tr>
                            <tr>
                                <p>
                                    <td><label for="email">Email </label></td>
                                    <td><input type="email" name="updateemail" value="<?php echo $row['email'];?>"
                                            id="email" readonly></td>
                                </p>
                            </tr>
                        </table>
                        <p>
                        <div style="text-align: center;">
                            <input class="button" type="submit" value="Modifica" id="inserisci">
                        </div>
                        <p>
                    </form>
                    <?php
                    }}
                    ?>
                </div>
            </div>
            <?php if(isset($_GET['codice'])){ ?>
            <DIV class="card">
                <div class="card-header">
                    <h4>MODIFICA I DATI</h4>
                </div>
                <div class="card-body">
                    <?php        
                    $codice=$_GET['codice'];
                    $query="SELECT * FROM viaggi WHERE codice='$codice'";
                    $result=pg_query($dbconn,$query);
                    while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))
                    {?>
                    <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;">
                        <div class="formhead">MODIFICA DATI VIAGGI</div>
                        <table>
                    <tr>
                        <p>
                            <td><label for="codice">codice </label></td>
                            <td><input type="text" name="updatecodice" value="<?php echo $row['codice'];?>" id="nome" readonly></td>
                        </p>
                    </tr><tr>
                        <p>
                            <td><label for="partenza">partenza </label></td>
                            <td><input type="text" name="inputpartenza" value="<?php echo $row['partenza'];?>" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="arrivo">arrivo </label></td>
                            <td><input type="text" name="inputarrivo" value="<?php echo $row['arrivo'];?>" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="andata">andata </label></td>
                            <td><input type="date" name="inputandata" value="<?php echo $row['andata'];?>" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="passeggeri">passeggeri </label></td>
                            <td><input type="number" name="inputpasseggeri" value="<?php echo $row['passeggeri'];?>" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="orariopart">orario partenza </label></td>
                            <td><input type="time" name="inputorariopart" value="<?php echo $row['orariopartenza'];?>" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="orarioarr">orario arrivo </label></td>
                            <td><input type="time" name="inputorarioarr" value="<?php echo $row['orarioarrivo'];?>" id="nome" required></td>
                        </p>
                    </tr>
                </table>
                        <p>
                        <div style="text-align: center;">
                            <input class="button" type="submit" value="Modifica" id="inserisci">
                        </div>
                        <p>
                    </form>
                    <?php
                    }}
                    ?>
                </div>
            </div>
            <?php if(isset($_GET['prenotazioni'])){ ?>
            <DIV class="card">
                <div class="card-header">
                    <h4>MODIFICA I DATI</h4>
                </div>
                <div class="card-body">
                    <?php        
                    $email=$_GET['prenotazioni'];
                    $query="SELECT * FROM prenotazioni WHERE email='$email'";
                    $result=pg_query($dbconn,$query);
                    while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))
                    {?>
                    <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;">
                        <div class="formhead">MODIFICA DATI PRENOTAZIONI</div>
                        <table>
                    <tr>
                        <p>
                            <td><label for="codice">Codice </label></td>
                            <td><input type="text" name="inputcodice" value="<?php echo $row['codice'];?>"id="codice" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="email">Email </label></td>
                            <td><input type="email" name="inputemail2" value="<?php echo $row['email'];?>" id="email" required></td>
                        </p>
                    </tr>
                </table>
                        <p>
                        <div style="text-align: center;">
                            <input class="button" type="submit" value="Modifica" id="inserisci">
                        </div>
                        <p>
                    </form>
                    <?php
                    }}
                    ?>
                </div>
            </div>
        </body>
        <footer class="bottom">
            <table>
                <tr>
                    <td>
                        <p>EasyRail &copy;</p>
                        <p>Un progetto per LTW (Linguaggi e Tecnologie per il Web) - A.A. 2023/24 - Prof. Lorenzo
                            Marconi</p>
                    </td>
                <tr>
                    <td>Capitale Sociale 0&euro;. Fondatori: Mirelli&Scolamiero<p>Tutti i diritti riservati.</p>
                    </td>
                    <td colspan="">Sede legale Università La Sapienza - Edificio Marco Polo, Viale Scalo San Lorenzo,
                        82, Roma</td>
                </tr>
            </table>
        </footer>
</body>

</html>