<?php

$bdd = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=lantz8u_projetPHP', 'lantz8u_appli', '31901820');

$bdd = null;
?>
<form method="post" action="">

Theme : <select name="theme">
            		<?php
               			 $theme = $bdd->query("SELECT * from theme");
               			 while($row=$theme->fetch()){
                    		echo"<option value=".$row['idtheme'].">".$row['description']."</option>";
                		}
            		?>
            	</select>
<input type="submit" name="formredaction" value="Je publie ma news" />
</form>