<!DOCTYPE html> 
<html lang="fr">

<!-- TITRE ET MENUS -->

<head>

<title>Festival</title> 
<meta charset="utf-8"> <!-- reconnaissance des accents -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="M2L Festival">
<link href=css/cssGeneral.css rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="bootstrap4/bootstrap.min.css">

</head>

<!-- Accès espace client -->
<body>

      <div class="user_box"> 
         <table>
            <tr>
               <td class="user_box_login"><a href="login.php">S'Identifier |</a></td>
               <td class="user_box_register"><a href="creationEtablissement.php">Ajouter un Etablissement</a></td>
            </tr>
         </table>
      </div>
      <br><br><br>

<?php

session_start();
/* ici débute la session*/ 
   if (isset($_SESSION["access_level"]))
   {
   if ($_SESSION["access_level"] == '1') /* on établit un niveau d'accès pour créer le back office, ici l'administrateur possède le niveau d'accès 1 */
   {
echo '<li class="main_nav_item"><a href="admin.php">Admin</a></li>';
echo '<li class="main_nav_item"><a href="logout.php">Déconnexion</a></li>';
}
else
{
/* N'affiche pas l'onglet ADMIN si l'utilisateur ne possède pas le niveau d'accès 1 */
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
         
<!-- Tableau contenant les menus -->

   <div class="menu">
      <table class="tabMenu" align="center">
         <tr>
            <td class="menu"><a href="_debut.inc.php">Accueil</a></td>
            <td class="menu"><a href="listeEtablissements.php">Gestion établissements</a></td>
            <td class="menu"><a href="consultationAttributions.php">Attributions chambres</a></td>
         </tr>
      </table>
   </div>
<br><br>

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

?> -->