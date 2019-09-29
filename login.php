<?php
/* Set server path */
$PARAM_hote='localhost';
/* Set server port */
$PARAM_port='3306';
/* Set database name */
$PARAM_nom_bd='festival';
/* Connect as root */
$PARAM_utilisateur='festival';
/* No password */
$PARAM_mot_passe='secret';

session_start();
/* Initialize connexion to database */
$connexion = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
/* Is it a return from login form? */
if (isset($_POST["id"]) && isset($_POST["motDePasse"]))
{
	/* Select all data from database where login info match */
	$query = $connexion->query("SELECT * FROM Etablissement WHERE id='".$_POST["id"]."' AND motDePasse=PASSWORD('".$_POST["motDePasse"]."')");
	/* Get number of result returned by this request */
	/* Is at least one user found? */
	if ($query->rowCount() >= 1)
	{
		$firstRow = $query->fetch();
		echo "Utilisateur trouvé avec le niveau d'accès :  ".$firstRow['access_level'];
		$_SESSION["access_level"] = $firstRow['access_level'];
		$_SESSION["total_product"] = 0;
	}
	else
	{
		echo "Utilisateur inconnu";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<div class="titre">
	<h6>Se connecter</h6>
	</div>
    	<section>
	<div class="login">
<FORM action="" method="post">
	<table>
		<tr>
			<td><label>Pseudo : </label></td>
			<td><input type="text" name="pseudo"/></td>
		</tr>
		<tr>
			<td><label>Mot de passe : </label></td>
			<td><input type="password" name="passe"/></td>
		</tr>
	
		<tr>
			<td></td>
			<td><input type="submit" value="Connexion"/></td>
		</tr>
	</table>
</FORM>
</div>
<!-- Accès espace client -->

						<div class="user_box ml-auto">
							<?php
							/* on créé un session pour enregistrer les données de l'utilisateur*/
							if (isset($_SESSION["access_level"]))
							{
								echo "<div class='user_box_login user_box_link'><a href='panier.php'>Mon panier</a></div>";
								echo "<div class='user_box_login user_box_link'><a href='logout.php'>Déconnexion</a></li>";
							}
							else
							{
								echo "<div class='user_box_login user_box_link'><a href='login.php'>S'Identifier</a></div>";
								echo "<div class='user_box_register user_box_link'><a href='Nouveau_Membre.php'>Créer un compte</a></div>";
							}
							?>
						</div>

						<?php
								/* SESSION ADMINISTRATEUR : Visible uniquement pour les utilisateurs ayant le niveau d'accès 1 */
									if (isset($_SESSION["access_level"]))
										
									{
										if ($_SESSION["access_level"] == '1')
										{
											echo '<li class="main_nav_item"><a href="admin.php">Admin</a></li>';
										}
										else
										{
											/* N'affiche pas l'onglet ADMIN si l'utilisateur ne possède pas le niveau d'accès 1 */
										} 
									}
								?>
</section>


</body>
</html>
