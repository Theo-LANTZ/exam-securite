<?php
session_start();
$erreur=$_SESSION['erreur'];
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
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">

</head>
<body>
  <header>
    <h1><center><font color="white">Le site des news !</font></center></h1>
<nav>
  <ul>
    <li class="deroulant"><a href="">Connexion</a>
      <ul class="sous">
        <li><a href="Connexion.php">Se connecter</a></li>
        <li><a href="inscription.php">S'inscrire</a></li>
        <li><a href="deconnexion.php">Se deconnecter</a></li>
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
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="slideshow-container">

<div class="mySlides fade">
  <center><img src="images/news1.jpg" style="width:50%"></center>
</div>

<div class="mySlides fade">
  <center><img src="images/news2.png" style="width:50%"></center>
</div>

<div class="mySlides fade">
  <center><img src="images/news3.jpg" style="width:50%"></center>
</div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>

<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>
<h2><center><Big>Bienvenue sur notre site web !</Big><br><br>
<font size="3">L'objectif est de permettre a nos inscrits d'avoir accès a des pages permettant la rédaction de news..
<br><br>
Certaines sont en exemples ci-dessous !
<br><br>
Si vous souhaiter regarder le travail des internautes il vous suffit de cliquer  <a href="vue.php">ici.</a><br><br>
ou si vous voulez créer vos propres news n'hésitez pas a utiliser le lien "s'inscrire".
</font></center>
</h2>
<center><a href="inscription.php">S'inscrire.</a>
  <p>
  <?php
 if(isset($erreur))
      {
        echo '<font color="red">'.$erreur."</font>";
      }
  ?>
</p>
</center>
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
</body>
</html> 

<style> 

header{
  background-color: #111;
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
h1{
  font-family: "Courier New", Monospace;
}
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: red;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: black;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
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