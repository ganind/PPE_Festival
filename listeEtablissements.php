<!DOCTYPE html> 
<html lang="fr">

<head>

<title>Festival | Établissements</title> 
<meta charset="utf-8"> <!-- reconnaissance des accents -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="M2L Festival">
<link href=css/cssGeneral.css rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="bootstrap4/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

<!-- Accès espace client -->
   <div class="user_box ml-auto"> 
      <div class="user_box_login user_box_link"><a href="login.php">S'Identifier |&nbsp</a></div>
         <div class="user_box_register user_box_link"><a href="creationEtablissement.php?action=demanderCreEtab">Ajouter un établisement</a></div>
   </div>
      <br><br><br>

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
   <div class="menu">
      <table class="tabMenu" align="center">
         <tr>
            <td class="menu"><a href="index.php">Accueil</a></td>
            <td class="menu"><a href="listeEtablissements.php">Gestion établissements</a></td>
            <td class="menu"><a href="consultationAttributions.php">Attributions chambres</a></td>
         </tr>
      </table>
   </div>
<br><br>

 <!--  <br>
   <div class="user_box ml-auto"> 
         <div class="user_box_register user_box_link"><a href="creationEtablissement.php?action=demanderCreEtab">Création d'un établisement</a></div>
   </div>
      <br><br> -->

</body>
</html>

<?php //manque du nom php

include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival

$connexion=connect();
if (!$connexion)
{
   ajouterErreur("Échec de la connexion au serveur MySql");
   afficherErreurs();
   exit();
}
if (!selectBase($connexion))
{
   ajouterErreur("La base de données festival est inexistante ou non accessible");
   afficherErreurs();
   exit();
}

// AFFICHER L'ENSEMBLE DES ÉTABLISSEMENTS
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// ÉTABLISSEMENT

echo "
<table width='70%' cellspacing='0' cellpadding='0' align='center' 
class='tabQuadrille'>
   <tr class='enTeteTabQuad'>
      <td colspan='4'>Etablissements</td>
   </tr>";
     
   $req=obtenirReqEtablissements();
   //$rsEtab=mysql_query($req, $connexion);
   $rsEtab=$connexion->query($req); //NOUVEAU
   //$lgEtab=mysql_fetch_array($rsEtab);
   $lgEtab=$rsEtab->fetch(PDO::FETCH_ASSOC);
   // BOUCLE SUR LES ÉTABLISSEMENTS
   while ($lgEtab!=FALSE)
   {
      $id=$lgEtab['id'];
      $nom=$lgEtab['nom'];
      echo "
		<tr class='ligneTabQuad'>
         <td width='52%'>$nom</td>
         
         <td width='16%' align='center'> 
         <a href='detailEtablissement.php?id=$id'>
         Voir détail</a></td>
         
         <td width='16%' align='center'> 
         <a href='modificationEtablissement.php?action=demanderModifEtab&amp;id=$id'>
         Modifier</a></td>";
      	
         // S'il existe déjà des attributions pour l'établissement, il faudra
         // d'abord les supprimer avant de pouvoir supprimer l'établissement
			if (!existeAttributionsEtab($connexion, $id))
			{
            echo "
            <td width='16%' align='center'> 
            <a href='suppressionEtablissement.php?action=demanderSupprEtab&amp;id=$id'>
            Supprimer</a></td>";
         }
         else
         {
            echo "
            <td width='16%'>&nbsp; </td>";          
			}
			echo "
      </tr>";
      //$lgEtab=mysql_fetch_array($rsEtab);
      $lgEtab=$rsEtab->fetch(PDO::FETCH_ASSOC);
   }

      echo "
   <table class='user_box ml-auto' align='center' cellspacing='0' cellpadding='0'>
      <tr>
        <br> <td><a href='creationEtablissement.php?action=demanderCreEtab'>Création d'un établisement</a>
         </td>
      </tr>
   </table>";

?>