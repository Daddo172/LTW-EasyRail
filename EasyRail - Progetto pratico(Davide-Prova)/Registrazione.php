<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registrazione</title>
	<link rel="stylesheet" href="styleLogin.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
		<nav class="navbar navbar-expand-lg fixed-top">
			<div class="container-fluid">
			  <a class="navbar-brand me-auto" href="HomePage.html">EasyRail</a>
			  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
				<div class="offcanvas-header">
				  <h5 class="offcanvas-title" id="offcanvasNavbarLabel">EasyRail</h5>
				  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<div class="offcanvas-body">
				  <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
					<li class="nav-item">
					  <a class="nav-link mx-lg-2" href="#">Home</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link mx-lg-2" href="#">Recupera Biglietto</a>
					</li>
					<li class="nav-item">
						<a class="nav-link mx-lg-2" href="#">Stato Treno</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link mx-lg-2" href="#">Contatti</a>
					  </li>
				  </ul>
				</div>
			  </div>
			  <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			</div>
		  </nav>
          <div class="container-fluid">
			<form class="mx-auto">
				<h4 class="text-center">Registrati</h4>
				<div class="mb-3 mt-5">
					<label for="exampleInputEmail1" class="form-label">Email</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

				</div>
				<div class="mb-3">
					<label for="exampleInputPassword1" class="form-label">Password</label>
					<input type="password" class="form-control" id="exampleInputPassword1">				</div>
                <div class="mb-3 mt-5">
					<label for="exampleInputEmail1" class="form-label">Nome utente</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

				</div>
                <div class="mb-3 mt-5">
					<label for="exampleInputEmail1" class="form-label">Città</label>
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

				</div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Ricordami
                    </label>
                  </div>
                  <a href="HomePage.html" type="submit" class="btn btn-primary mt-4">Registrati</a>
			</form>
		</div>
		<br>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
<footer>LTW-EASYRAIL</footer>
</html>