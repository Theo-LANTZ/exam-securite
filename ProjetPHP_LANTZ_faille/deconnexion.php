<?php
session_start();
$_SESSION = array();
session_destroy();
session_start();
$_SESSION["nom"] = "";
$_SESSION["idredacteur"]=0;
$_SESSION["prenom"]="";
$_SESSION["adressemail"]="";
$_SESSION["erreur"]="";
header("Location: Page_accueil.php");
?>