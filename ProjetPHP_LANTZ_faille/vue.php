<?php
session_start();

$_SESSION['erreur']="";
try{
$bdd = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=lantz8u_projetPHP', 'lantz8u_appli', '31901820');
}
catch(exception $e){
	die('Erreur '.$e->getMessage());
}
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>


<html>
		<head>
			<title>Page des news</title>
			<meta charset="utf-8">
		</head>
		<body>
			<header>
    <h1><center><font color="white">Les news !</font></center></h1>

<nav>
  <ul>
    <li class="deroulant"><a href="">Connexion</a>
      <ul class="sous">
        <li><a href="Page_accueil.php">Retour a l'accueil</a></li>
        <li><a href="deconnexion.php" name="deconnexion">Se déconnecter</a></li>
      </ul>
    </li>
    <li class="deroulant"><a href="">Les articles</a>
    <ul class="sous">
      <li><a href="vue.php">Regarder les articles publiés</a></li>
      <li><a href="redaction.php">Rédiger un article</a></li>
    </ul>
  </li>
  </ul>
</nav>

  </header>

<form method="post" action="vue.php">
<br />
<br />
<br />
<div align="center" class="theme">Theme : 
	<div class="select">
	<select name="theme">
						<?php
               			$theme=$bdd->query("SELECT * from theme");
               		 	while($ligne=$theme->fetch()){
                    	echo"<option value=".$ligne['idtheme'].">".$ligne['description']."</option>";
                		}
            		?>
					<br />
					<br />
					
					<br />
</select></div><br/>
<div class="middle">
<input type="submit" class="btn" name="Validation" value="Valider"/>
</div>
</div>
<section>
<?php
if(isset($_POST['Validation']))
{
	$idtheme=intval($_POST['theme']);
	$lisnews= $bdd -> prepare("SELECT * FROM news WHERE idtheme=?");
	$lisnews -> execute(array($idtheme));
	while($valeur=$lisnews->fetch()){
		$idred=$valeur['idredacteur'];
		$redacteur = $bdd-> prepare("SELECT * FROM redacteur WHERE idredacteur=?");
		$redacteur -> execute(array($idred));
		$infos = $redacteur->fetch();
	echo"<div>
			<article>
				<h2>".$valeur['titrenews']."</h2>
				<p>".$valeur['textnews']."</p>
				<p>Rédigé par ".$infos['nom']." ".$infos['prenom']." le ".$valeur['datenews']."</p>
				<br/>
				</article>
			</div>";
}
}

?>
<div class="footer">
<?php
if($_SESSION['idredacteur']>0){
echo "Redacteur :" .$_SESSION['nom']. " " .$_SESSION['prenom'];  
}
else{
  echo "Redacteur : non connecté ";
}
?>
</div>
</footer>
</section>
</body>
</html>



<style>
header{
	background-color:#111;
	height:50px;
}
nav{
  width: 100%;
  margin: 0 auto;
  background-color: black;
  position: sticky;
  top:0px;
}
nav ul{
  list-style-type: none;
}
nav ul li{
  float: left;
  width: 25%;
  text-align: center;
}
nav ul::after{
  content: "";
  display: table;
  clear: both;
}
nav a{
  display: block;
  text-decoration: none;
  color: white;
  border-bottom: 2px solid transparent;
  padding: 10px 0px;
}
nav a:hover{
  color: orange;
  border-bottom: 2px solid gold;
}
.sous{
  display: none;
  box-shadow: 0px 1px 2px #CCC;
  background-color: white;
}
nav > ul li:hover .sous{
  display: block;
}
.sous li{
  float:none;
  width: 100%;
  text-align: left;
}
.sous a{
  padding: 10px;
  border-bottom: none;
  color:black;
}
.sous a:hover{
  border-bottom: none;
  background-color: rgba(200,200,200,0.1);
}
.deroulant > a::after{
  content:" ▼";
  font-size: 12px;
}
.sous{
  display: none;
  box-shadow: 0px 1px 2px #CCC;
  background-color: white;
  position: absolute;
  width: 100%;
  z-index: 1000;
}
nav ul li{
  float: left;
  width: 25%;
  text-align: center;
  position: relative;
}
.theme{
	padding:60px;
}

.footer{
	position:fixed;
	left:0;
	bottom:0;
	width: 100%;
	background-color: black;
	color: white;
	text-align:center;
}
select{
	-webkit-appearance:none;
	-moz-appearance:none;
	-ms-appearance:none;
	outline: 0;
	appearance:none;
	box-shadow: none;
	border:0!important;
	background: #5c6664;
	background-image: none;
	flex:1;
	padding: 0 .5em;
	color: #fff;
	cursor: pointer;
	font-size: 1em;
}
select::-ms-expand{
	display: none;
}
.select{
	position: relative;
	display: flex;
	width: 20em;
	height: 3em;
	line-height: 3;
	background: #5c6664;
	overflow: hidden;
	border-radius: .25em;
}

.select::after{
	content: '\25BC';
	position: absolute;
	top: 0;
	right: 0;
	padding: 0 1em;
	background: #000;
	cursor: pointer;
	pointer-events: none;
	transition: .25s all ease;
}
.select:hover::after{
	color:#23b499;

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
  position: relative;
  color:white;
}
article{
	box-sizing: border-box;
	position: relative;
	left: 35%;
	border-color:black;
	border:2px solid black;
	margin: 14px;
	background-color: black;
	background: rgba(0, 0, 0, 0.4);
	width:50%;
}
body{
	background-size: cover;
	background-image: url(images/ciel.jpg);
	color:white;
}
</style>