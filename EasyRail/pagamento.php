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
    main {
        background: url(pictures/back3.jpg) space;
        background-size: cover;
        background-position: top;
	}
    </style>
</head>

<body>
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
                <a class="center" style="margin-right:1%;" href="TrainStato.php">Stato treno</a>
            </nav>
        </header> 
            <?php //CARICAMENTO CON ROTELLINA
//Prendo tutti i dati utili dal form/imposto le diverse variabili di stato
                $email = $_SESSION['email'];
                $codice = $_GET['codice'];
                $codicetemp = $_GET['codice'];
                $hpartenzatemp= $_GET['orariopartenza'];
                $harrivotemp= $_GET['orariodestinazione'];
                    
                    if(isset($_SESSION['temp'])){
                    $datapartenzatemp=$_SESSION['dataAnd'];
                    $_SESSION['codicetemp'] = $codicetemp;
                    $_SESSION['hpartenzatemp'] = $hpartenzatemp;
                    $_SESSION['harrivotemp'] = $harrivotemp;
                    $_SESSION['datapartenzatemp'] = $datapartenzatemp;
                    }
                    if($_SESSION['stato'] != 'andata'){
                    $datapartenzatemp=$_SESSION['dataAnd'];
                    $_SESSION['codicetemp'] = $codicetemp;
                    $_SESSION['hpartenzatemp'] = $hpartenzatemp;
                    $_SESSION['harrivotemp'] = $harrivotemp;
                    $_SESSION['datapartenzatemp'] = $datapartenzatemp;
                    }if(!isset($_SESSION['temp']) && $_SESSION['stato'] != 'ritorno'){
                    $datapartenzatemp=$_SESSION['dataRit'];
                    $_SESSION['codice'] = $codicetemp;
                    $_SESSION['orariopartenza'] = $hpartenzatemp;
                    $_SESSION['orariodestinazione'] = $harrivotemp;
                    $_SESSION['datapartenza']=$datapartenzatemp;
                    $_SESSION['ok']= 'si';
                    }
                    $hpartenza= $_GET['orariopartenza'];
                    $harrivo= $_GET['orariodestinazione'];
                    $partenza=$_SESSION['part'];
                    $arrivo=$_SESSION['arr'];
                    $prezzo = $_GET['prezzo'];
                    if($_SESSION['stato'] != 'ritorno' && !isset($_SESSION['temp'])){
                    $_SESSION['prezzo'] = $prezzo + $_SESSION['prezzo'];
                    $prezzo=$_SESSION['prezzo'];}
                    else{
                        $_SESSION['prezzo']=$prezzo;
                        
                    } 
                    
        
                $q1="select * from prenotazione where email= $1 and codice = $2 and hpartenza=$3 and harrivo=$4 and datapartenza=$5";
                $result=pg_query_params($dbconn, $q1, array($email,$codicetemp,$hpartenzatemp,$harrivotemp,$datapartenzatemp));
        //controlla se il treno richiesto per la prenotazione già si trova nel DB
        if (pg_fetch_array($result, null, PGSQL_ASSOC)){
            header("location:prenotazione.php");
                    echo '<div style="text-align:center;"><a class="button"  href="HomePage.php" value="andata"> Torna HomepAge </a></div>';
            }
        else{
            //Attraverso lo stato reindirizzo alla pagina corretta
            if($_SESSION["stato"]!= 'andata'){
                header("location:formrit.php");      
            }else{
                unset($_SESSION['prezzo']);     
            }}
            
            //Div con informazioni sulla prenotazione corrente e 
            //form con inserimento dati del metodo di pagamento
            ?>  
    <main>
        <div class="container" style="width:100%; margin: 15px auto 50px auto;">
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
                                        <?php  
                                        $pass=$_SESSION['pass'];
                                            if($_SESSION['sconto'] == 'LTW24'){
                                            $sconto = ($prezzo/100) * 20;
                                            $prezzo= $prezzo - $sconto;
                                            }
                                        $prezzo=$prezzo * $pass; ?>
                                        <span class="c-green">€ <?php echo "$prezzo,00" ?></span>
                                    </p>
                                    <?php
                                    if(isset($_SESSION['temp'])){
                                         ?><p class="mb-0">Pagamento in corso per il treno di andata con il codice: <?php echo $_SESSION['codicetemp'] ?>.</p>
                                         <br>
                                         <p class="mb-0">In partenza dalla stazione di: <?php echo $partenza ?> </p>
                                         <p>alle ore: <?php 
                                         $datapartenza=new DateTime($_SESSION['hpartenzatemp']);
                                         echo $datapartenza->format("H:i"); ?>.</p>
                                         <p class="mb-0">Con destinazione alla stazione di: <?php echo $arrivo ?> </p>
                                         <p>alle ore: <?php 
                                         $datarrivo=new DateTime($_SESSION['harrivotemp']);
                                         echo $datarrivo->format("H:i"); ?>.</p>
                                        <?php }else{ ?>
                                            <p class="mb-0">Pagamento in corso per il treno di andata con il codice: <?php echo $_SESSION['codicetemp'] ?>.</p>
                                         <br>
                                         <p class="mb-0">In partenza dalla stazione di: <?php echo $partenza ?> </p>
                                         <p>alle ore: <?php 
                                         $datapartenza=new DateTime($_SESSION['hpartenzatemp']);
                                         echo $datapartenza->format("H:i"); ?>.</p>
                                         <p class="mb-0">Con destinazione alla stazione di: <?php echo $arrivo ?> </p>
                                         <p>alle ore: <?php 
                                         $datarrivo=new DateTime($_SESSION['harrivotemp']);
                                         echo $datarrivo->format("H:i"); ?>.</p>
                                    <p class="mb-0">Pagamento in corso per il treno di ritorno con il codice: <?php echo $codice ?>.</p>
                                    <br>
                                    <p class="mb-0">In partenza dalla stazione di: <?php echo $arrivo ?> </p>
                                    <p>alle ore: <?php 
                                    $datapartenza=new DateTime($hpartenza);
                                    echo $datapartenza->format("H:i"); ?>.</p>
                                    <p class="mb-0">Con destinazione alla stazione di: <?php echo $partenza ?> </p>
                                    <p>alle ore: <?php 
                                    $datarrivo=new DateTime($harrivo);
                                    echo $datarrivo->format("H:i"); ?>.</p>
                                    <?php }?>
                                    
                                </div>
                                <div class="col-lg-7">
                                    <form action="prenotazione.php" class="form" onsubmit="return validaCarta() && validaNC() && validaCVC();">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <label for="" class="form__label">Nome e Cognome del titolare</label>
                                                    <input id="nc" oninput="validaNC()" type="text" class="form-control" maxlength="40" placeholder="nome e cognome"required>
				                            	    <div id="messaggioNC" style="color: rgb(200, 0, 0);"></div>
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
                                                    <label for="cvc" class="form__label">CVC</label>
                                                    <input id="cvc" oninput="validaCVC()" type="number" class="form-control" placeholder="codice di 3 o 4 cifre" required>
                                                    <div id="messaggioCVC" style="color: rgb(200, 0, 0);"></div>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top: 24px;">
                                                
                                                <!--
                                                <a class="btn btn-primary w-100" href="prenotazione.php?orariopartenza=<?php echo $_GET['orariopartenza'];?>&orariodestinazione= 
                                                <?php echo $_GET['orariodestinazione']; ?>&codice= <?php echo $_GET['codice']; ?>">
                                                -->
                                            </div>
                                        </div>
                                        <button class="save-btn" type="button">
                                        Acquista
                                    </button>
                                    <script>
                                                    save_btn = document.querySelector(".save-btn");

                                                    save_btn.onclick = function(){
                                                        this.innerHTML="<div class='loader'></div>";
                                                    setTimeout(() =>{
                                                        var firstName = 'John'; 
                                                            this.innerHTML="Conferma Pagamento";
                                                            this.style="background:darkblue;color: white;";
                                                            save_btn.setAttribute('type', 'submit');
                                                        }, 2000);}
                                                </script>
                                </div>
                            </form> 
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