<!DOCTYPE html>
<?php session_start();
    $dbconn = pg_connect("host=localhost dbname=EasyRail_2 user=daddo password=biar port=5432");
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
				<a class="center" href="TrainStato.php">Stato treno</a>
                <a class="center" href="FindTicket.html">Trova biglietto</a>
            </nav>
        </header>

        <body>
            <div class="card-body">
                <table class="table table-bordered">
                    
                    <thead>
                        <tr>
                            <th>Codice</th>
                            <th>Partenza</th>
                            <th>Destinazione</th>
                            <th>Orario Partenza</th>
                            <th>Orario Arrivo</th>
                            <th>Modifica</th>
                            <th>Cancella</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                
                    $query="SELECT * FROM treno";
                    $result=pg_query($query);
                    while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC))
                    {?>
                        <tr>
                            <td><?php echo $row['codice']; ?></td>
                            <td><?php echo $row['partenza']; ?></td>
                            <td><?php echo $row['destinazione']; ?></td>
                            <td><?php echo $row['hpartenza']; ?></td>
                            <td><?php echo $row['harrivo']; ?></td>
                            <td> 
                                <a href="edit.php?codice=<?php echo $row['codice'];?>&partenza=<?php echo $row['partenza'];?>&
                                destinazione=<?php echo $row['destinazione'];?>" class="btn btn-success">Modifica dati</a>
                            </td>
                            <td> 
                                <form action="code.php" method="POST">
                                    <input type="hidden" name=deletecodice value="<?php echo $row['codice']; ?>">
                                    <button type="submit" class="btn btn-danger">Cancella dati</button>
                                </form>
                            </td>
                        </tr><?php
                    }  ?>
                    </tbody>
                    
                </table>
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