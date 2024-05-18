<!DOCTYPE html>
<?php session_start();?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyRail</title>
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
    <main>
        <!--Barra superiore-->
        <header class="topnav">
			<nav>
			<a class="titolo" >EasyRail</a>
				<?php if(isset($_SESSION['name'])){?>
					<div class="log dropdown">
						<button class="dropbtn"><?= $_SESSION['name']?></button>
						<div class="dropdown-content">
							<?php if($_SESSION['name'] == 'Admin'){ ?>
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
				<a class="active center" href="Admin.php">Area Admin</a>
				<a href="logout.php">  Logout</a>
			</nav>
		</header>
        <main>
            <form action="code.php" method="post" style="margin-top: 60px auto 60px auto;min-width:30%;">
                <div class="formhead">INSERISCI DATI UTENTE</div>
                <table style="margin-left: auto;margin-right: auto;">
                    <tr>
                        <p>
                            <td><label for="nome">Nome </label></td>
                            <td><input type="text" name="inputnome" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="cognome">Cognome </label></td>
                            <td><input type="text" name="inputcognome" id="cognome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="pw">Password </label></td>
                            <td><input type="password" name="inputpassword" id="pw" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="email">Email </label></td>
                            <td><input type="email" name="inputemail" id="email" required></td>
                        </p>
                    </tr>
                </table>
                <p>
                <div style="text-align: center;">
                    <input class="button" type="submit" value="Inserisci" id="inserisci">
                </div>
                <p>
            </form>
            <form action="code.php" method="post" style="margin-top: 60px auto 60px auto;min-width:30%;">
                <div class="formhead">INSERISCI DATI PRENOTAZIONI</div>
                <table style="margin-left: auto;margin-right: auto;">
                    <tr>
                        <p>
                            <td><label for="codice">Codice </label></td>
                            <td><input type="text" name="inputcodice" id="codice" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="email">Email </label></td>
                            <td><input type="email" name="inputemail2" id="email" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="codbiglietto">Codice Biglietto </label></td>
                            <td><input type="number" name="inputcodbiglietto" id="codbiglietto" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="hpartenza">Orario Partenza</label></td>
                            <td><input type="time" name="inputhpartenza" id="codbiglietto" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="harrivo">Orario Arrivo</label></td>
                            <td><input type="time" name="inputharrivo" id="codbiglietto" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="datapartenza">Data Partenza</label></td>
                            <td><input type="date" name="inputdatapartenza" id="datapartenza" required></td>
                        </p>
                    </tr>
                </table>
                <p>
                <div style="text-align: center;">
                    <input class="button" type="submit" value="Inserisci" id="inserisci">
                </div>
                <p>
            </form>
            <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;min-width:30%;">
                <div class="formhead">INSERSICI DATI TRENI</div>
                <table style="margin-left: auto;margin-right: auto;">
                    <tr>
                        <p>
                            <td><label for="codice">codice</label></td>
                            <td><input type="text" name="inputcodice3" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Fermata N°0</label></td>
                            <td><input type="text" name="inputfermata0" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Fermata N°1</label></td>
                            <td><input type="text" name="inputfermata1" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Fermata N°2</label></td>
                            <td><input type="text" name="inputfermata2" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Fermata N°3</label></td>
                            <td><input type="text" name="inputfermata3" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Fermata N°4</label></td>
                            <td><input type="text" name="inputfermata4" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Fermata N°5</label></td>
                            <td><input type="text" name="inputfermata5" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Orario Fermata N°0</label></td>
                            <td><input type="time" name="inputhfermata0" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Orario Fermata N°1</label></td>
                            <td><input type="time" name="inputhfermata1" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Orario Fermata N°2</label></td>
                            <td><input type="time" name="inputhfermata2" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Orario Fermata N°3</label></td>
                            <td><input type="time" name="inputhfermata3" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Orario Fermata N°4</label></td>
                            <td><input type="time" name="inputhfermata4" id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="fermata">Orario Fermata N°5</label></td>
                            <td><input type="time" name="inputhfermata5" id="nome" required></td>
                        </p>
                    </tr>
                </table>
                <p>
                <div style="text-align: center;">
                    <input class="button" type="submit" value="Inserisci" id="inserisci">
                </div>
                <p>
            </form>
            <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;min-width:30%;">
                        <div class="formhead">INSERISCI DATI VIAGGI</div>
                        <table style="margin-left: auto;margin-right: auto;">
                    <tr>
                        <p>
                            <td><label for="codice">codice </label></td>
                            <td><input type="text" style="width:80%;" name="inputcodice2"  id="nome" required></td>
                        </p>
                    </tr><tr>
                        <p>
                            <td><label for="partenza">partenza </label></td>
                            <td><input type="text" style="width:80%;" name="inputpartenza"  id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="destinazione">destinazione </label></td>
                            <td><input type="text" style="width:80%;" name="inputarrivo"  id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="orariopart">orario partenza </label></td>
                            <td><input type="time" style="width:80%;" name="inputorariopart"  id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="orarioarr">orario arrivo </label></td>
                            <td><input type="time" style="width:80%;" name="inputorarioarr"  id="nome" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="economy">Prezzo Economy</label></td>
                            <td><input type="number" style="width:80%;" name="inputeconomy" id="economy" required></td>
                        </p>
                    </tr>
                    <tr>
                        <p>
                            <td><label for="prima">Prezzo Prima</label></td>
                            <td><input type="number" style="width:80%;" name="inputprima" id="prima" required></td>
                        </p>
                    </tr>
                </table>
                        <p>
                        <div style="text-align: center;">
                            <input class="button" type="submit" value="Inserisci" id="inserisci">
                        </div>
                        <p>
                    </form>
        </main>
    </body>
</html>