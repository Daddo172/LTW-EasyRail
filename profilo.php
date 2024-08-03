<!DOCTYPE html>
<?php
$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432"); session_start();?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyRail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="stile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" href="pictures/LogoEasyRail.jpg" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="funzioni.js"></script>
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
            <a class="titolo" href="HomePage.php">EasyRail</a>
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
            <a class="center" href="HomePage.php">Home</a>
            <a class="center" style="margin-right:1%;" href="TrainStato.php">Stato treno</a>
        </nav>
    </header>

    <body>
        <div class="form-2">
        <form>
            <h1 style="text-align:center;">Informazioni Utente</h1>
            <div class="table-responsive-lg" style="width:100%;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                if(isset($_SESSION['name'])){
                    $nome = $_SESSION['name'];
                    $email = $_SESSION['email'];
                  }
                $query="select nome,cognome from utente where email='$email'";
                $result=pg_query($query) or die ('Query failed: ' . pg_last_error());
                while ($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){  ?>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['cognome']; ?></td>
                        <td><?php echo $email ?></td>
                        <?php

                }
                ?>
                    </tbody>
                </table>
                
            </div>
        </form>
        </div>
        <div class="form-2" style="width:auto;margin-left: auto;margin-right: auto;padding:16px;">
            <h1 style="text-align:center;">Treni Prenotati</h1>
            <div class="table-responsive-lg">
                
                
                        <?php  $query="SELECT * FROM prenotazione WHERE email='$email'";
                        $result=pg_query($query); 
                        $check=pg_num_rows($result);
                        if($check >0){
                            ?><table  style="border-collapse:collapse;height:50px;"class="table table-bordered">
                    <thead>
                        <tr padding:0>
                            <th>Codice</th>
                            <th>Partenza</th>
                            <th>Destinazione</th>
                            <th>Orario di partenza</th>
                            <th>Orario di destinazione</th>
                            <th>Data Partenza</th>
                            <th>Stato</th>
                            <th>Cancella </th>
                        </tr>
                    </thead>
                    <tbody > <?php
                while ($row = pg_fetch_array($result)){ 
                    $codice= $row['codice'];
                    $email=$row['email'];
					$codbiglietto= $row['codbiglietto'];
                    $orariopart= $row['hpartenza'];
                    $orariodest= $row['harrivo'];
                    $datapartenza=$row['datapartenza'];
                    $oggi= date("Y-m-d");
                    $query2="SELECT * FROM treno WHERE codice='$codice' AND hpartenza='$orariopart' AND harrivo='$orariodest'";
                    $result2=pg_query($query2);
                    $row2 = pg_fetch_array($result2,NULL,PGSQL_ASSOC) ?>
                        <tr>
                            <td><?php echo $row['codice']; ?></td>
                            <td><?php echo $row2['partenza']; ?></td>
                            <td><?php echo $row2['destinazione']; ?></td>
                            <td><?php echo $row2['hpartenza']; ?></td>
                            <td><?php echo $row2['harrivo']; ?></td>
                            <td><?php echo $row['datapartenza']; ?></td>
                            <?php if($oggi != $datapartenza){ ?> <td><form style="margin-top: 0px;" ><a class="button"style="width:100px;pointer-events: none;cursor: default;opacity:70%;" href="trainstatus.php?codice=<?php echo $row['codice']; ?>"
                                    value="Stato"> Stato </a></form></td> <?php
                            }else{ ?>
                                <td><form style="margin-top: 0px;"><a class="button" style="width:100px;text-align:center;"  href="trainstatus.php?codice=<?php echo $row['codice']; ?>"
                                    value="Stato"> Stato </a></form></td>
                            <?php
                            } ?>
                            <td>
                                <form action="code.php" style="margin-top: -10px;"method="POST">
                                    <input type="hidden" name=deletecodbiglietto2 value="<?php echo $row['codbiglietto']; ?>">
                                    <input type="hidden" name=email value="<?php echo $row['email']; ?>">
                                    <button type="submit" onclick="showAlert()" class="btn btn-danger">Cancella Prenotazione</button>

                                    <script>
                                    function showAlert() {
                                        alert ("Cancellazione effettuata correttamente");
                                    }
                                    </script>
                                </form>
                            </td>
                        </tr>
                        <?php  }}else{ ?>
                                <h2 style="text-align:center;color:darkblue;">Non ci sono treni prenotati</h2>
                                                           <?php }


                ?>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        </body>
        <footer class="bottom">
            <table>
                <tr>
                    <td>
                        <p>EasyRail &copy;</p>
                        <p>Un progetto per LTW (Linguaggi e Tecnologie per il Web) - A.A. 2023/24 - Prof.
                            Lorenzo Marconi</p>
                    </td>
                <tr>
                    <td>Capitale Sociale 0&euro;. Fondatori: Mirelli&Scolamiero<p>Tutti i diritti riservati.</p>
                    </td>
                    <td colspan="">Sede legale Università La Sapienza - Edificio Marco Polo, Viale Scalo San
                        Lorenzo, 82, Roma</td>
                </tr>
            </table>
        </footer>

</main>
</html>