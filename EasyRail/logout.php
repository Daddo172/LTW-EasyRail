<?php
//Diversi unset e indirizzamento alla pagina di HomePage
session_start();
session_unset();
session_destroy();
header("location:HomePage.php");
?>