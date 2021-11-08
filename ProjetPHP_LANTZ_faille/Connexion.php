<?php
session_start();
if($_SESSION["nom"] != ""){
	$_SESSION['erreur']="Utilisateur déjà connecté";
	header("Location: Page_accueil.php");
}
else{
$_SESSION['erreur']="";
}
$bdd = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=lantz8u_projetPHP', 'lantz8u_appli', '31901820');

if(isset($_POST['formconnexion']))
{
	$mailconnect = $_POST['mailconnect'];
	$mdpconnect = $_POST['mdpconnect'];
		$requser = $bdd->query("SELECT * FROM redacteur WHERE adressemail = '".$mailconnect."' AND motdepasse = '" .$mdpconnect. "'; ");
		$rows = $requser->fetchAll(PDO::FETCH_ASSOC);
		
		if(sizeof($rows)>0){
			echo "<p>Vous voilà connecté !</p>";
		}else{
			echo "<p>Il y a eu une erreur</p>";
		}
		
}	
?>

<html>
		<head>
			<title>Connexion</title>
			<meta charset="utf-8">
		</head>
		<body>
			<header>
    <h1><center><font color="white">Connexion</font></center></h1>
  </header>
			<center>
			<br /><br />
			<form method="POST" action="Connexion.php" class="box">
					<input type="text" name="mailconnect" placeholder="Mail" />
					<input type="text" name="mdpconnect" placeholder="Mot de passe" />
					<input type="submit" name="formconnexion" value="Se connecter !" />
					<label><a href="inscription.php">Pas encore inscrit ?</a></label>

			</form>
		</center>
		</div>
		
		<div class="middle">
      <button onclick="window.location.href='Page_accueil.php';" class="btn btn1">Accueil</button>
    </div>
	</body>
	</html>
	<style>
header{
	background-color:#111;
	height:50px;
}
body{
	margin:0;
	padding:0;
	font-family: sans-serif;
	background: #34495e;
}
.box{
	width: 300px;
	padding: 40px;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	background: #191919;
	text-align: center;
}
.box h1{
	color: white;
	text-transform: uppercase;
	font-weight: 500;
}
.box a{
	color: white;
}
.box input[type="email"],.box input[type= "password"]{
	border:0;
	background: none;
	display: block;
	margin:20px auto;
	text-align: center;
	border:2px solid #3498db;
	padding: 14px 10px;
	width: 200px;
	outline: none;
	color: white;
	border-radius: 24px;
	transition: 0.25s; 
}
.box input[type="email"]:focus,.box input[type= "password"]:focus{
	width: 280px;
	border-color: #2ecc71;
}
.box input[type ="submit"]{
	border:0;
	background: none;
	display: block;
	margin: 20px auto;
	text-align: center;
	border : 2px solid #2ecc71;
	padding: 14px 40px;
	width: 200px;
	outline: none;
	color: white;
	border-radius: 24px;
	transition: 0.25s;
	cursor: pointer;
}
.box input[type ="submit"]:hover{
	background: #2ecc71;
}
.middle{
  position: absolute;
  top: 75%;
  left: 50%;
  transform: translate(-50%,-50%);
  text-align: center;
}
.btn{
  background: none;
  border: 2px solid #000;
  font-family: "montserrat",sans-serif;
  text-transform: uppercase;
  padding: 12px 20px;
  min-width: 200px;
  margin: 10px;
  cursor: pointer;
  transition: color 0.4s linear;
  position: relative;
}
.btn:hover{
  color: #fff;
}
.btn::before{
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: #000;
  z-index: -1;
  transition: transform 0.5s;
  transform-origin: 0 0;
  transition-timing-function: cubic-bezier(0.5,1.6,0.4,0.7);
   transform: scaleX(0);
}
.btn1:hover::before{
  transform: scaleX(1);
}
</style>
