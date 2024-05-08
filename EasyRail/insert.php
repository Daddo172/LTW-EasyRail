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
    <main style="background: url(pictures/back3.jpg) no-repeat; background-size: cover; background-position: center;">
        <!--Barra superiore-->
        <header class="topnav">
			<nav>
            <a class="titolo" >EasyRail</a>
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
				<a class="center" href="FindTicket.html">Trova biglietto</a>
			</nav>
		</header>
        <main>
            <form action="code.php" method="post" style="margin-top: 60px auto 60px auto;">
                <div class="formhead">INSERISCI DATI UTENTE</div>
                <table>
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
            <form action="code.php" method="post" style="margin-top: 60px auto 60px auto;">
                <div class="formhead">INSERISCI DATI PRENOTAZIONI</div>
                <table>
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
                </table>
                <p>
                <div style="text-align: center;">
                    <input class="button" type="submit" value="Inserisci" id="inserisci">
                </div>
                <p>
            </form>
            <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;">
                <div class="formhead">INSERSICI DATI TRENI</div>
                <table>
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
            <form action="code.php" method="POST" style="margin-top: 60px auto 60px auto;">
                        <div class="formhead">INSERISCI DATI VIAGGI</div>
                        <table>
                    <tr>
                        <p>
                            <td><label for="codice">codice </label></td>
                            <td><input type="text" name="inputcodice2"  id="nome" required></td>
                        </p>
                    </tr><tr>
                        <p>
                            <td><label for="partenza">partenza </label></td>
                            <td><input type="text" name="inputpartenza"  id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="destinazione">destinazione </label></td>
                            <td><input type="text" name="inputarrivo"  id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="orariopart">orario partenza </label></td>
                            <td><input type="time" name="inputorariopart"  id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="orarioarr">orario arrivo </label></td>
                            <td><input type="time" name="inputorarioarr"  id="nome" required></td>
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