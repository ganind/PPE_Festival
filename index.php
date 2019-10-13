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

<!-- Accès espace client -->
      <div class="container" align="right">
         <br>
         <a href="login.php" class="btn btn-primary">S'Identifier</a>
         <a href="register.php" class="btn btn-primary">S'Inscrire</a>
      </div>

      <br>

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



<!-- ancienne version

<?php

echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
 TITRE ET MENUS 
<html lang="fr">
<head>
<title>Festival</title>
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/cssGeneral.css" rel="stylesheet" type="text/css">
</head>
<body class="basePage">

  Tableau contenant le titre 
<table width="100%" cellpadding="0" cellspacing="0">
   <tr> 
      <td class="titre">Festival Folklores du Monde <br>
      <span id="texteNiveau2" class="texteNiveau2">
      H&eacute;bergement des groupes</span><br>&nbsp;
      </td>
   </tr>
</table>

 Tableau contenant les menus
<table width="80%" cellpadding="0" cellspacing="0" class="tabMenu" align="center">
   <tr>
      <td class="menu"><a href="index.php">Accueil</a></td>
      <td class="menu"><a href="listeEtablissements.php">
      Gestion établissements</a></td>
      <td class="menu"><a href="consultationAttributions.php">
      Attributions chambres</a></td>
   </tr>
</table>
<br>';

?> 
-->




