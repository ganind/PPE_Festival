<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="fr">

<!-- TITRE ET MENUS -->
<head>

<title>Festival | Accueil</title> 
<meta charset="utf-8"> <!-- reconnaissance des accents -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="M2L Festival">
<link href=css/cssGeneral.css rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="bootstrap4/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<!-- Accès espace client -->


<body>

   <?php 
   if (empty($_SESSION))
   {
      echo '
      <div class="container" align="right">
         <br>
         <a href="login.php" class="btn btn-primary">Identification</a>
         <a href="register.php" class="btn btn-primary">Inscription</a>
      </div>
      <br>';
   }
   else 
   {
   echo '
   <div class="row">
      <div class="container col-lg-2 col-md-2 col-sm-2" align="left">
         <a href="logout.php" class="container btn btn-danger">Déconnexion</a>
      </div>
      <div class="container" align="center">
         <a href="index.php" class="btn btn-primary" style="background-color: #e2ddff; color:#0a0869; border:none;">Accueil</a>
         </div>
      <div class="container" align="right">
         <a href="creationEtablissement.php?action=demanderCreEtab" class="btn btn-primary" style="background-color: #e2ddff; color:#0a0869; border:none;">Ajouter un Établissement</a>
         </div>
   <div>';
   }

 ?> 
<!-- Tableau contenant les menus -->

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
         
	<!-- Tableau contenant le texte -->
   <div class='texte_accueil'>
<table>
   <tr>  
      <td class='texteAccueil'>
         Cette application web permet de gérer l'hébergement des groupes de musique 
         durant le festival Folklores du Monde.<br><br><br>
         Elle offre les services suivants :<br><br><br>
         Gérer les établissements (caractéristiques et capacités d'accueil) acceptant d'héberger les groupes de musiciens.<br><br>
         Consulter, réaliser ou modifier les attributions des chambres aux groupes dans les établissements. 
      </td>
   </tr>
</table>
   <img src="images\festival_logo.jpg" alt="Logo" class='logo'>
</div>
</body>
</html>