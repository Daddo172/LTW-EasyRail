<!DOCTYPE html>
<?php session_start();?>
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
                <a class="active center" href="HomePage.php">Home</a>
                <a class="center" href="TrainStato.php">Stato treno</a>
            </nav>
        </header>
        <main>
        <div class="container">
        <div class="row">
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
                                    <p class="mb-0"><span class="fw-bold">Prodotto:</span><span class="c-green"> Treno </span>
                                    </p>
                                    <p class="mb-0">
                                        <span class="fw-bold">Prezzo:</span>
                                        <?php $prezzo= $_GET['prezzo'] ?>
                                        <span class="c-green">€ <?php echo $prezzo ?></span>
                                    </p>
                                    <p class="mb-0">Testo!</p>
                                </div>
                                <div class="col-lg-7">
                                    <form action="" class="form">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <label for="" class="form__label">Numero Carta</label>
                                                    <input type="number" class="form-control" maxlength="21" pattern="^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$" placeholder="0000-0000-0000-0000" required>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <label for="" class="form__label">Scadenza</label>
                                                    <input type="text" class="form-control" maxlength="7" pattern="\d{1,2}\/\d{1,2}\/\d{2,4}" placeholder="MM/YY" required>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form__div">
                                                    <label for="" class="form__label"> CVV</label>
                                                    <input type="password" maxlength="3" class="form-control" placeholder="***" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form__div">
                                                    <label for="" class="form__label">Nome Carta</label>
                                                    <input type="text" class="form-control" placeholder="ROSSI MARIO" required>
<br>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a class="btn btn-primary w-100" href="prenotazione.php?orariopartenza=<?php echo $_GET['orariopartenza'];?>&orariodestinazione= 
                                                <?php echo $_GET['orariodestinazione']; ?>&codice= <?php echo $_GET['codice']; ?>">Invia Pagamento</a>
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