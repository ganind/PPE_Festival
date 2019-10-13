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
<?php
session_start();
?>

<body>
	<!-- Tableau contenant le titre -->
   <div class="basePage">
      <table id="table_basePage">
         <tr> 
            <td class="titre">Festival Folklores du Monde<br>
            </td>
         </tr>
      </table>
   </div>
   <br>

<div class="menu">
      <table class="tabMenu" align="center">
         <tr>
            <td class="menu"><a href="index.php" class="btn btn-primary" style='background-color: #e2ddff; color:#0a0869; border:none;'>Accueil</a></td>
            <td class="menu"><a href="creationEtablissement.php?action=demanderCreEtab" class="btn btn-primary" style='background-color: #e2ddff; color:#0a0869; border:none;'>Ajouter un Établissement</a></td> 
<?php
if(isset($_SESSION["level"]))
{
   $level=$_SESSION["level"];
   if ($level=1)
   {
   echo'
<div class="container">
      <table class="tabMenu" align="center">
         <tr>
            <td class="menu"><a href="listeEtablissements.php" class="btn btn-primary" style="background-color: #e2ddff; color:#0a0869; border:none;">Gestion établissements</a></td>
            <td class="menu"><a href="consultationAttributions.php" class="btn btn-primary" style="background-color: #e2ddff; color:#0a0869; border:none;">Attributions chambres</a></td>
         </tr>
      </table>
   </div>';
   }
}
?>
            <br>
         </tr>
      </table>
</div>

<br><br>

<?php


if(isset($_SESSION["username"]))
{
	echo '<h5 class="container text-center">Connexion avec succès.  <br><br> Bienvenue, '.$_SESSION["username"].'.</h5>';
   echo '<br /><h5 class="container text-center">Vous pouvez ajouter votre établissement dans Ajouter un Établissement. </h5>';
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

