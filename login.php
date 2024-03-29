<?php

session_start();
$host = "localhost";
$username = "festival";
$password = "secret";
$database ="festival";
$message = "";

try
{
	$connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if(isset($_POST["login"]))
	{
		if(empty($_POST["username"]) || empty($_POST["password"]))
		{
			$message = '<label> Remplissez tous les champs</label>';
		}
		else
		{
			$query = "SELECT * FROM users WHERE username = :username AND password = PASSWORD(:password)";
			$statement = $connect->prepare($query);
			$statement->execute(
				array(
						'username' => $_POST["username"],
						'password' => $_POST["password"]
					)
			);
			$count = $statement->rowCount();
			if($count > 0)
			{		
				$firstRow = $statement->fetch();
				echo "Utilisateur trouvé avec le niveau d'accès :  ".$firstRow['level'];

				$_SESSION["level"] = $firstRow['level'];

				$_SESSION["username"] = $_POST["username"];
				header("location:login_sucess.php");

			}
			else
			{
				$message = '<label> Saisie incorret. Veuillez ressayer.</label>';
			}
		}
	}
}
catch(PDOException $error)
{
	$message = $error->getMessage();
}

?>

<!DOCTYPE html> 
<html lang="fr">

<head>

<title>Festival | Login</title> 
<meta charset="utf-8"> <!-- reconnaissance des accents -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="M2L Festival">
<link href=css/cssGeneral.css rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>


	<?php
	if (isset($message))
	{
		echo'<label class="text_danger">'.$message.'</label>';
	}
	?>

<!-- Tableau contenant le titre -->
   <div class="basePage">
      <table id="table_basePage">
         <tr> 
            <td class="titre">Festival Folklores du Monde<br>
            <span class="texteNiveau2">Connexion</span><br>
            </td>
         </tr>
      </table>
   </div>
   <br>

<!-- Tableau contenant les menus -->
   <div class="menu">
      <table class="" align="center">
         <tr>
            <td>
            	<a href="index.php" class="btn btn-primary" style='background-color: #e2ddff; color:#0a0869; border:none;'>Accueil</a>
            </td>
         </tr>
      </table>
   </div>
<br><br> 

	<div class="container" style="width:500px;">
	<form method="post">
		<label>Utilisateur : </label>
		<input type="text" required name="username" class="form-control"/>
		<br />
	
		<label>Mot de passe : </label>
		<input type="password" required name="password" class="form-control"/>
		<br />

		<input type="submit" name="login" class="btn btn-primary" align="center" value="Connexion"/>

</form>
</div>
</body>
</html>
