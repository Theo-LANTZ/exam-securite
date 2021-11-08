<?php
date_default_timezone_set("Europe/Paris");
session_start();
if($_SESSION['nom']==""){
	header("Location:Page_accueil.php");
	$_SESSION['erreur']="Utilisateur non connecté";
}
else{
$_SESSION['erreur']="";
}
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$mail = $_SESSION['adressemail'];


try{
$bdd = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=lantz8u_projetPHP', 'lantz8u_appli', '31901820');
}
catch(exception $e){
	die('Erreur '.$e->getMessage());
}

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if(isset($_POST['formredaction']))
	{
	$titre = htmlspecialchars($_POST['titre']);
	$textnews = htmlspecialchars($_POST['textnews']);
	$date = date("Y-m-d H:i:s");
	$idtheme = intval($_POST['theme']);
	
	if(!empty($_POST['titre']) AND !empty($_POST['textnews']))
		{		
			$titrelength = strlen($titre);
			if($titrelength <= 255)
			{	
			$insertnews = $bdd -> query("INSERT INTO news(idnews, idtheme, titrenews, datenews, textnews, idredacteur) VALUES(NULL, $idtheme, $titre, $date, $textnews, $_SESSION['idredacteur'])")
			;
			$erreur="Votre news a bien étée envoyée !";
			}
				else
				{
					$erreur = "Votre titre ne doit pas dépasser 255 caractères !";
						
				}
				}
		else
		{
			$erreur = "Tous les champs doivent être complétés !";
			
		}
}
?>

<html>
		<head>
			<title>Page de redaction :</title>
			<meta charset="utf-8">
		</head>
		<body>
			<header>
    <h1><center><font color="white">Redaction</font></center></h1>
<nav>
  <ul>
    <li class="deroulant"><a href="">Connexion</a>
      <ul class="sous">
        <li><a href="Page_accueil.php">Retour au menu</a></li>
        <li><a href="deconnexion.php">Se déconnecter</a></li>
      </ul>
    </li>
     <li><a href="vue.php">Les articles</a></li>
  </ul>
</nav>

  </header>
</right></h1>

		<div align="center">
			<?php
	if(isset($erreur))
	{
		echo '<font color="red">'.$erreur."</font>";
	}
?>

<br />
<br />
		<form method="post" action="redaction.php" class="block">

					Inserez un titre a votre nouvelle : <input type="text" size="50" name="titre" value="<?php if(isset($titre)) {echo $titre;} ?>"/><br/><br/>
					Theme : <select name="theme">
						<?php
               			$theme=$bdd -> query("SELECT * from theme");
               		 	while($ligne=$theme->fetch()){
                    	echo"<option value=".$ligne['idtheme'].">".$ligne['description']."</option>";
                		}
            		?>
       				 </select>
       				<br />
       				</br />
					<textarea id="textnews" name="textnews" rows="10" cols="80"/></textarea>
					<br />
					<br />
					<input type="submit" name="formredaction" value="Je publie ma news" />
					<br />
</form>
</div>
<br>
<div class="footer">
<?php
echo "Redacteur :" .$_SESSION['nom']. " " .$_SESSION['prenom']; 
?>
</div>
	</body>
	</html>


<style>

header h1{
	background-color:#111;
	height:50px;
}
	body{
		background-repeat: no-repeat;
		font-family: sans-serif;
		background-image: url(images/img.jpeg);
		background-size: cover;
		color:white;
	}
nav{
  width: 100%;
  margin: 0 auto;
  background-color: white;
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
  color: black;
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
.footer{
  position:fixed;
  left:0;
  bottom:0;
  width: 100%;
  background-color: black;
  color: white;
  text-align:center;
}

</style>