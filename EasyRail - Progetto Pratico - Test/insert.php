<!DOCTYPE html>
<?php session_start();?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyRail</title>
    <link rel="stylesheet" href="../stile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap">
    <link rel="icon" href="pictures/LogoEasyRail.jpg" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../funzioni.js"></script>
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
                </table>
                <p>
                <div style="text-align: center;">
                    <input class="button" type="submit" value="Inserisci" id="inserisci">
                </div>
                <p>
            </form>
			<form action="code.php" method="post" style="margin-top: 60px auto 60px auto;">
                <div class="formhead">INSERISCI DATI VIAGGI</div>
                <table>
                    <tr>
                        <p>
                            <td><label for="codice">codice </label></td>
                            <td><input type="text" name="inputcodice2" id="nome" required></td>
                        </p>
                    </tr><tr>
                        <p>
                            <td><label for="partenza">partenza </label></td>
                            <td><input type="text" name="inputpartenza" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="arrivo">arrivo </label></td>
                            <td><input type="text" name="inputarrivo" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="andata">andata </label></td>
                            <td><input type="date" name="inputandata" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="ritorno">ritorno </label></td>
                            <td><input type="date" name="inputritorno" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="passeggeri">passeggeri </label></td>
                            <td><input type="number" name="inputpasseggeri" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="orariopart">orario partenza </label></td>
                            <td><input type="time" name="inputorariopart" id="nome" required></td>
                        </p>
                    </tr>
					<tr>
                        <p>
                            <td><label for="orarioarr">orario arrivo </label></td>
                            <td><input type="time" name="inputorarioarr" id="nome" required></td>
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