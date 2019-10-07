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
	<!-- Tableau contenant le titre -->
   <div class="basePage">
      <table id="table_basePage">
         <tr> 
            <td class="titre">Festival Folklores du Monde<br><br>
            <span class="texteNiveau2">Hébergement des groupes</span><br><br>
            </td>
         </tr>
      </table>
   </div>
   <br><br>
   <!-- Tableau contenant les menus -->
      <?php include 'header.php';?>
<br><br>


<?php

session_start();

if(isset($_SESSION["username"]))
{
	echo '<h5 class="container text-center">Connexion avec succès. <br><br> Bienvenue, '.$_SESSION["username"].'.</h5>';
	echo '<br /><br /> 
   <div class="row">
      <div class="container col-lg-2 col-md-2 col-sm-2">
         <a href="logout.php" class="container btn btn-danger">Déconnexion</a>
      </div>
   <div>';
}
else
{
   header("location:login.php");
}
?>

</body>
</html>

