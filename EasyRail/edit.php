<!DOCTYPE html>
<?php session_start();
$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyRail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="stile.css">
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
<main style="background: url(pictures/back3.jpg) no-repeat; background-size: cover; background-position: center;">
    <!--Barra superiore-->
    <header class="topnav">
        <nav>
            <a class="titolo">EasyRail</a>
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
            <a class="active center" href="HomePage.php">Home</a>
            <a class="center" href="TrainStato.php">Stato treno</a>
        </nav>
    </header>

    <body>
        <?php if(isset($_GET['email'])){ ?>
            <DIV style="width:100%">
            <div class="table-responsive-lg" style="width:100%;">
                <?php        
                    $email=$_GET['email'];
                    $query="SELECT * FROM utente WHERE email='$email'";
                    $result=pg_query($dbconn,$query);
                    while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))
                    {?>
                <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;">
                    <div class="formhead">MODIFICA DATI UTENTE</div>
                    <table style="margin-left: auto;margin-right: auto;">
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
        <?php if(isset($_GET['partenza'])){ ?>
            <DIV style="width:100%">
            <div class="card-body">
                <?php        
                    $codice=$_GET['codice'];
                    $partenza=$_GET['partenza'];
                    $destinazione=$_GET['destinazione'];
                    $query="SELECT * FROM treno WHERE codice='$codice'and destinazione='$destinazione' and partenza='$partenza'";
                    $result=pg_query($dbconn,$query);
                    while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))
                    {?>
                <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;">
                    <div class="formhead">MODIFICA DATI VIAGGI</div>
                    <table style="margin-left: auto;margin-right: auto;">
                        <tr>
                            <p>
                                <td><label for="codice">codice </label></td>
                                <td><input type="text" name="updatecodice" value="<?php echo $row['codice'];?>"
                                        id="nome" readonly></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="partenza">partenza </label></td>
                                <td><input type="text" name="inputpartenza" value="<?php echo $row['partenza'];?>"
                                        id="nome" required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="destinazione">destinazione </label></td>
                                <td><input type="text" name="inputarrivo" value="<?php echo $row['destinazione'];?>"
                                        id="nome" required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="orariopart">orario partenza </label></td>
                                <td><input type="time" name="inputorariopart" value="<?php echo $row['hpartenza'];?>"
                                        id="nome" required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="orarioarr">orario arrivo </label></td>
                                <td><input type="time" name="inputorarioarr" value="<?php echo $row['harrivo'];?>"
                                        id="nome" required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="economy">Prezzo Economy</label></td>
                                <td><input type="number" name="inputeconomy" id="economy" required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="prima">Prezzo Prima</label></td>
                                <td><input type="number" name="inputprima" id="prima" required></td>
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
        <?php if(isset($_GET['codice']) && isset($_GET['fermata'])){ ?>
            <DIV style="width:100%">
            <div class="card-body">
                <?php        
                    $codice=$_GET['codice'];
                    $query="SELECT * FROM trenocompleto WHERE codice='$codice'";
                    $result=pg_query($dbconn,$query);
                    while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))
                    {?>
                <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;">
                    <div class="formhead">MODIFICA DATI TRENI</div>
                    <table style="margin-left: auto;margin-right: auto;">
                        <tr>
                            <p>
                                <td><label for="codice">codice</label></td>
                                <td><input type="text" name="updatecodice2" value="<?php echo $row['codice'];?>"
                                        id="nome" readonly></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Fermata N°0</label></td>
                                <td><input type="text" name="inputfermata0" value="<?php echo $row['f0'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Fermata N°1</label></td>
                                <td><input type="text" name="inputfermata1" value="<?php echo $row['f1'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Fermata N°2</label></td>
                                <td><input type="text" name="inputfermata2" value="<?php echo $row['f2'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Fermata N°3</label></td>
                                <td><input type="text" name="inputfermata3" value="<?php echo $row['f3'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Fermata N°4</label></td>
                                <td><input type="text" name="inputfermata4" value="<?php echo $row['f4'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Fermata N°5</label></td>
                                <td><input type="text" name="inputfermata5" value="<?php echo $row['f5'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Orario Fermata N°0</label></td>
                                <td><input type="time" name="inputhfermata0" value="<?php echo $row['hf0'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Orario Fermata N°1</label></td>
                                <td><input type="time" name="inputhfermata1" value="<?php echo $row['hf1'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Orario Fermata N°2</label></td>
                                <td><input type="time" name="inputhfermata2" value="<?php echo $row['hf2'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Orario Fermata N°3</label></td>
                                <td><input type="time" name="inputhfermata3" value="<?php echo $row['hf3'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Orario Fermata N°4</label></td>
                                <td><input type="time" name="inputhfermata4" value="<?php echo $row['hf4'];?>" id="nome"
                                        required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="fermata">Orario Fermata N°5</label></td>
                                <td><input type="time" name="inputhfermata5" value="<?php echo $row['hf5'];?>" id="nome"
                                        required></td>
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
        <?php if(isset($_GET['codbiglietto'])){ ?>
        <DIV style="width:100%">
            <div class="card-body">
                <?php        
                    $codbiglietto=$_GET['codbiglietto'];
                    $query="SELECT * FROM prenotazione WHERE codbiglietto='$codbiglietto'";
                    $result=pg_query($dbconn,$query);
                    while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))
                    {?>
                <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;">
                    <div class="formhead">MODIFICA DATI PRENOTAZIONI</div>
                    <table style="margin-left: auto;margin-right: auto;">
                        <tr>
                            <p>
                                <td><label for="codice">Codice </label></td>
                                <td><input type="text" name="inputcodice3" value="<?php echo $row['codice'];?>"
                                        id="codice" required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="email">Email </label></td>
                                <td><input type="email" name="inputemail2" value="<?php echo $row['email'];?>"
                                        id="email" required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="codbiglietto">Codice Biglietto </label></td>
                                <td><input type="number" name="updatecodbiglietto"
                                        value="<?php echo $row['codbiglietto'];?>" id="codbiglietto" readonly></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="hpartenza">Orario Partenza</label></td>
                                <td><input type="time" name="inputhpartenza" value="<?php echo $row['hpartenza'];?>"
                                        id="nome" required></td>
                            </p>
                        </tr>
                        <tr>
                            <p>
                                <td><label for="harrivo">Orario Arrivo</label></td>
                                <td><input type="time" name="inputharrivo" value="<?php echo $row['harrivo'];?>"
                                        id="nome" required></td>
                            </p>
                        </tr>
                        <tr>
                        <p>
                            <td><label for="datapartenza">Data Partenza</label></td>
                            <td><input type="date" name="inputdatapartenza" value="<?php echo $row['DataPartenza']; ?>" id=datapartenza required></td>
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
</main>

</html>