<!DOCTYPE html>
<?php session_start();
$dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");?>
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

    <body>
        <div class="table-responsive-lg" style="width:100%;">
            <?php $query="SELECT * FROM prenotazione";
                    $result=pg_query($query); 
                        ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Codice</th>
                        <th>Email</th>
                        <th>Codice Biglietto</th>
                        <th>Orario Partenza</th>
                        <th>Orario Arrivo</th>
                        <th>Modifica</th>
                        <th>Cancella</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                
                if(pg_fetch_array($result,NULL,PGSQL_ASSOC)){
                    while($row = pg_fetch_array($result,NULL,PGSQL_ASSOC)){?>
                    <tr>
                        <td><?php echo $row['codice']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['codbiglietto']; ?></td>
                        <td><?php echo $row['hpartenza']; ?></td>
                        <td><?php echo $row['harrivo']; ?></td>
                        <td><form action="">
                            <a href="edit.php?codbiglietto=<?php echo $row['codbiglietto']; ?>"
                                class="btn btn-success">Modifica dati</a>
                        </form></td>
                        <td>
                            <form action="code.php" method="POST">
                                <input type="hidden" name=deletecodbiglietto
                                    value="<?php echo $row['codbiglietto']; ?>">
                                <input type="hidden" name=email value="<?php echo $row['email']; ?>">
                                <button type="submit" class="btn btn-danger">Cancella dati</button>
                            </form>
                        </td>
                    </tr><?php
                    }}else{ ?>
                    <td>NULL</td>
                    <td>NULL</td>
                    <td>NULL</td>
                    <td>NULL</td>
                    <td>NULL</td>  
                    <td>NULL</td>
                    <td>NULL</td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</main>

</html>