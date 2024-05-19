<!DOCTYPE html>
<?php session_start();
    $dbconn = pg_connect("host=localhost dbname=EasyRail user=postgres password=postgres port=5432");
?>
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
            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Codice</th>
                        <th>Partenza</th>
                        <th>Destinazione</th>
                        <th>Orario Partenza</th>
                        <th>Orario Arrivo</th>
                        <th>Prezzo Economy</th>
                        <th>Prezzo Prima</th>
                        <th>Modifica</th>
                        <th>Cancella</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                
                    $query="SELECT * FROM treno order by codice";
                    $result=pg_query($query);
                    $check=pg_num_rows($result);
                    if($check >0){
                    while($row = pg_fetch_array($result))
                    {?>
                    <tr>
                        <td><?php echo $row['codice']; ?></td>
                        <td><?php echo $row['partenza']; ?></td>
                        <td><?php echo $row['destinazione']; ?></td>
                        <td><?php echo $row['hpartenza']; ?></td>
                        <td><?php echo $row['harrivo']; ?></td>
                        <td><?php echo $row['prezzoeconomy']; ?></td>
                        <td><?php echo $row['prezzoprima']; ?></td>
                        <td><form style="margin-top: -15px;">
                            <a href="edit.php?codice=<?php echo $row['codice'];?>&partenza=<?php echo $row['partenza'];?>&
                                destinazione=<?php echo $row['destinazione'];?>" class="btn btn-success">Modifica
                                dati</a>
                    </form></td>
                        <td>
                            <form style="margin-top: -15px;" action="code.php" method="POST">
                                <input type="hidden" name=deletecodice value="<?php echo $row['codice']; ?>">
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
                    <td>NULL</td>
                    <td>NULL</td>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </body>
</main>

</html>