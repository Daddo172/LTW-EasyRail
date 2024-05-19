<!DOCTYPE html>
<?php session_start();
$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");    ?>
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
	<script src="funzioni.js"></script>
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
                <a class="center" href="HomePage.php">Home</a>
                <a class="center" href="TrainStato.php">Stato treno</a>
            </nav>
        </header>
        <main>
            
            <?php //CARICAMENTO CON ROTELLINA
                $email = $_SESSION['email'];
                $codice = $_GET['codice'];
                $hpartenza= $_GET['orariopartenza'];
                $harrivo= $_GET['orariodestinazione'];
                $partenza=$_SESSION['part'];
                $arrivo=$_SESSION['arr'];
                $_SESSION['codice'] = $codice;
                $_SESSION['orariopartenza'] = $hpartenza;
                $_SESSION['orariodestinazione'] = $harrivo;
            $q1="select * from prenotazione where email= $1 and codice = $2 and hpartenza=$3 and harrivo=$4";
        $result=pg_query_params($dbconn, $q1, array($email,$codice,$hpartenza,$harrivo));
        //controlla se esiste
        if (pg_fetch_array($result, null, PGSQL_ASSOC)){
            header("location:prenotazione.php");
                if($stato != 'ritorno'){
                    echo '<div style="text-align:center;"><a class="button"  href="HomePage.php" value="Ritorno"> Torna HomepAge </a></div>';
                }else{
					unset($_SESSION['stato']);
                    echo '<div style="text-align:center;"><a " class="button" href="formrit.php" value="Ritorno"> Prenota il ritorno </a></div>';
                }
            }
            
            ?>
        <div class="container">
        <div class="row" style="width:100%;">
            <div class="col-12 mt-4">
                <div class="card p-3">
                    <p class="mb-0 fw-bold h4">Pagamento</p>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-3">
                    <div class="card-body border p-0">
                        <p>
                            <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"
                                data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true"
                                aria-controls="collapseExample">
                                <span class="fw-bold">Carta di Credito</span>
                            </a>
                        </p>
                        <div class="collapse show p-3 pt-0" id="collapseExample">
                            <div class="row">
                                <div class="col-lg-5 mb-lg-0 mb-3">
                                    <p class="h4 mb-0">Resoconto</p>
                                    <p class="mb-0"><span class="fw-bold">Prodotto:</span><span class="c-green"> Biglietto </span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bold">Prezzo:</span>
                                        <?php $prezzo= $_GET['prezzo']; 
                                        $pass=$_SESSION['pass'];

                                        if($_SESSION['sconto'] == 'LTW24'){
                                            $sconto = ($prezzo/100) * 20;
                                            $prezzo= $prezzo - $sconto;
                                        }
                                        $prezzo=$prezzo * $pass; ?>
                                        <span class="c-green">€ <?php echo $prezzo ?></span>
                                    </p>
                                    
                                    <p class="mb-0">Pagamento in corso per il treno con il codice: <?php echo $codice ?>.</p>
                                    <br>
                                    <p class="mb-0">In partenza dalla stazione di: <?php echo $partenza ?> </p>
                                    <p>alle ore: <?php 
                                    $datapartenza=new DateTime($hpartenza);
                                    echo $datapartenza->format("H:i"); ?>.</p>
                                    <p class="mb-0">Con destinazione alla stazione di: <?php echo $arrivo ?> </p>
                                    <p>alle ore: <?php 
                                    $datarrivo=new DateTime($harrivo);
                                    echo $datarrivo->format("H:i"); ?>.</p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="prenotazione.php" class="form" onsubmit="return validaCarta();">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <label for="" class="form__label">Nome e Cognome del titolare</label>
                                                    <input type="text" class="form-control" maxlength="40" placeholder="nome e cognome" pattern="([A-Za-z]+)( [A-Za-z]+)+" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <label for="carta" class="form__label">Numero Carta</label>
                                                    <input id="carta" oninput="validaCarta()" type="number" class="form-control" placeholder="inserire numero carta" required>
                                                    <div id="messaggioCarta" style="color: rgb(200, 0, 0);"></div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <label for="scad" class="form__label">Scadenza</label>
                                                    <input id="scad" type="month" class="form-control" placeholder="mm/yyyy" required>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <label for="cvv" class="form__label">CVV</label>
                                                    <input id="cvv" type="password" class="form-control" pattern="\d\d\d\d*" placeholder="codice di 3 o 4 cifre" required>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top: 24px;">
                                                <input class="btn btn-primary w-100" type="submit"  value="Acquista"></input>
                                                <!--
                                                <a class="btn btn-primary w-100" href="prenotazione.php?orariopartenza=<?php echo $_GET['orariopartenza'];?>&orariodestinazione= 
                                                <?php echo $_GET['orariodestinazione']; ?>&codice= <?php echo $_GET['codice']; ?>">
                                                -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
        </main>
</body>

</html>