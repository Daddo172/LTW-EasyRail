<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<script src="https://kit.fontawesome.com/cbe8049c6b.js" crossorigin="anonymous"></script>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EasyRail</title>
	<link rel="stylesheet" href="assets/styleLogin.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
	<nav class="navbar navbar-expand-lg fixed-top">
		<div class="container-fluid">
		  <a class="navbar-brand me-auto" >EasyRail</a>
		  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
			<div class="offcanvas-header">
			  <h5 class="offcanvas-title" id="offcanvasNavbarLabel">EasyRail</h5>
			  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			
			<div class="offcanvas-body">
			  <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
				<li class="nav-item">
				  <a class="nav-link mx-lg-2 active" href="#">Home</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link mx-lg-2" href="#">Recupera Biglietto</a>
				</li>
				<li class="nav-item">
					<a class="nav-link mx-lg-2" href="#">Stato Treno</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link mx-lg-2" href="#">Contatti</a>
				  </li><?php if(isset($_SESSION['name'])){?>
				  <li class="nav-item">
					<a class="nav-link mx-lg-2" href="#"><?= $_SESSION['name']?></a>
				  </li>
				  
			  </ul>
			</div>
		  </div>  
			<a href="logout.php" class="login-button">Logout</a>
			<div>
			<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
			 aria-controls="offcanvasNavbar" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
		  </button>
		  </button></div>
		  	<?php }else{?>
				</ul>
			</div>
		  </div>
		  	<a href="login/Login.html" class="login-button">Login</a>
			  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
			 aria-controls="offcanvasNavbar" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
		  </button>
			<?php }?>
		</div>
	  </nav>
	  <br><br>


	  <div>
	<form class="mx-auto">
		<div class="formhead">Cerca viaggio</div> 
		<p>
			<label for="part">Da</label>
			<input type="text" name="part" size=auto style="margin-right: 16px;"
			placeholder=" inserisci stazione di partenza">
			<button style="width: 36px; height: 36px; border: 1px solid gray; border-radius: 20%;">
				&rlarr;
			</button>
			<label for="arr">A</label>
			<input type="text" name="arr"
			placeholder=" inserisci stazione di arrivo">
		</p>
		<p>
			<table>
				<tr>
					<td>Andata e ritorno</td>
					<td><div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
					  </div></td>
				</tr>
			</table>
		</p>
		<p>
			<br>
			<label for="dataAnd">Andata</label>
			<input type="date" name="dataAnd">
			<br>
			<label for="dataRit">Ritorno</label>
			<input type="date" name="dataRit">
		</p>
		<p>
			<label for="pass">Passeggeri (popup con età)</label>
			<input type="number" name="pass">
		</p>
		<p>
			<label for="cs">Codice sconto (opzionale) </label>
			<input type="text" name="cs">
		</p>
		<p>
			<div style="text-align: center;">
			<input class="button" type="submit" value="Cerca">
			<input class="button" type="reset" value="Cancella">
			</div>
		<p>
	</form>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
<footer>
</footer>
</html>