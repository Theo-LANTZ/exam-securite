<?php
session_start();
if($_SESSION["nom"]!= ""){
	$_SESSION['erreur']="Deconnectez-vous avant de vous réinscrire";
	header("Location: Page_accueil.php");
}
else{
$_SESSION['erreur']="";
}
$bdd = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=lantz8u_projetPHP', 'lantz8u_appli', '31901820');
if(isset($_POST['forminscription']))
{
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
	
	if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp'])AND !empty($_POST['mdp2']))
		{		
			$prenomlength = strlen($prenom);
			$nomlength = strlen($nom);
			if($nomlength <= 255)
			{	
				if($prenomlength <= 255)
				{
				if($mail == $mail2)
				{	
					if(filter_var($mail, FILTER_VALIDATE_EMAIL))
					{
						$reqmail = $bdd->prepare("SELECT * FROM redacteur WHERE adressemail = ?");
						$reqmail ->execute(array($mail));
						$mailexist = $reqmail ->rowCount();
						if($mailexist == 0) {
						if($mdp == $mdp2)
						{
							$insertmbr = $bdd -> prepare("INSERT INTO redacteur(nom, prenom, adressemail, motdepasse) VALUES(?, ?, ?, ?)")
							;
							$insertmbr->execute(array($nom, $prenom, $mail, $mdp));
							$erreur = "Votre compte a bien été crée !";
						}
						else
						{
							$erreur = "Vos mots de passes ne correspondent pas !";
						
						}
				}
				else { 
				$erreur ="Adresse mail déjà utilisée !";
				}
					}
					else{
						$erreur ="Votre adresse mail n'est pas valide !";
					}
					}		
					else
					{
						$erreur = "Vos adresses mail ne correspondent pas !";
				
					}
				
			}
			else{
				$erreur ="Votre prenom ne doit pas dépasser 255 caractères !";
			}
		}
			else	
			{
				$erreur =" Votre nom ne doit pas dépasser 255 caractères !";
			
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
			<title>Inscription</title>
			<meta charset="utf-8">
		</head>
		<body><center>
			
			<header>
    <h1><center><font color="white">Inscription</font></center></h1>

  </header>
<div class="inscris-form">
	<h1>Inscrivez-vous !</h1>
			<form method="POST" action="">
			
					<div class="txtb">
					<label for="nom">Nom :</label>
					<input type="text" placeholder="Votre nom" 
					id="nom" name="nom" value="<?php if(isset($nom)) { echo $nom;} ?>"/>
					</div>
				
					<div class="txtb">
					<label for="prenom">Prénom :</label>
					<input type="text" placeholder="Votre prénom" 
					id="prenom" name="prenom" value="<?php if(isset($prenom)) { echo $prenom;} ?>"/>
					</div>
				
					<div class="txtb">
					<label for="mail">Mail :</label>
					<input type="email" placeholder="Votre mail" 
					id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail;} ?>"/>
					</div>

					<div class="txtb">
					<label for="mail2">Confirmation du Mail :</label>
					<input type="email" placeholder="Confirmez votre mail" 
					id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2;} ?>"/>
					</div>

					<div class="txtb">
					<label for="mdp">Mot de passe :</label>
					<input type="password" placeholder="Votre mot de passe" 
					id="mdp" name="mdp" />
					</div>

					<div class="txtb">
					<label for="mdp2"> Confirmation du Mot de passe :</label>
					<input type="password" placeholder="Confirmez votre mot de passe" 
					id="mdp2" name="mdp2" />
					</div>
					
					
					<input type="submit" name="forminscription" value="Je m'inscris" />
					
			</form>
		</div>
			<?php
			if(isset($erreur))
			{
				echo '<font color="red">'.$erreur."</font>";
			}
			?>
			Déjà inscrit ? <a href="Connexion.php">Connectez vous !</a>
		</center>
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
	background: #34495e;
	color:white;
}
a{
	color:white;
}
body{
	font-family:sans-serif;
	margin: 0;
	padding: 0;
}
.inscris-form{
width: 85%;
max-width: 600px;
background: #f1f1f1;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%,-50%);
padding: 30px 40px;
box-sizing: border-box;
border-radius: 	8px;
text-align: center;
box-shadow: 0 0 20px #000000b3;
font-family: "Montserrat-Thin",sans-serif;
color: black;
}
}
.inscris-form h1{
	margin-top: 0;
	font-weight: 200;
	color: black;
}
.txtb{
	border:1px solid gray;
	margin: 8px 0;
	padding: 12px 18px;
	border-radius: 8px;
}
.txtb label{
	display: block;
	text-align: left;
	color: #333;
	text-transform: uppercase;
	font-size: 14px;
}
.txtb input{
	width: 100%;
	border:none;
	background: none;
	outline: none;
	font-size: 18px;
	margin-top: 6px;
}
input[type="submit"]{
	display: block;
	background: #9b59b6;
	padding: 14px 0;
	color: white;
	text-transform: uppercase;
	cursor: pointer;
	margin-top: 8px;
	width: 100%;
}
.middle{
  position: absolute;
  top: 90%;
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
