<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="fr">

<head>
   <?php

   if (isset(($_SESSION)))
   {
      echo '<div class="row">
      <div class="container col-lg-2 col-md-2 col-sm-2" align="left">
      <a href="logout.php" class="container btn btn-danger">Déconnexion</a>
      </div>';

   }
 ?> 
<title>Festival | Attributions</title> 
<meta charset="utf-8"> <!-- reconnaissance des accents -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="M2L Festival">
<link href=css/cssGeneral.css rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="bootstrap4/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

<!-- Tableau contenant le titre -->
   <div class="basePage">
      <table id="table_basePage">
         <tr> 
            <td class="titre">Festival Folklores du Monde<br>
            <span class="texteNiveau2">Hébergement des groupes</span><br>
            </td>
         </tr>
      </table>
   </div>
   <br>

<!-- Tableau contenant les menus -->
     <div class="menu">
      <table class="tabMenu" align="center">
         <tr>
            <td class="menu"><a href="index.php" class="btn btn-primary" style='background-color: #e2ddff; color:#0a0869; border:none;'>Accueil</a></td>

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
         </tr>
      </table>
   </div>
<br><br>

</body>
</html>

<?php //manque du nom php

include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival

$connexion=connect();
if (!$connexion)
{
   ajouterErreur("Echec de la connexion au serveur MySql");
   afficherErreurs();
   exit();
}
if (!selectBase($connexion))
{
   ajouterErreur("La base de données festival est inexistante ou non accessible");
   afficherErreurs();
   exit();
}

// CONSULTER LES ATTRIBUTIONS DE TOUS LES ÉTABLISSEMENTS

// IL FAUT QU'IL Y AIT AU MOINS UN ÉTABLISSEMENT OFFRANT DES CHAMBRES POUR  
// AFFICHER LE LIEN VERS LA MODIFICATION
$nbEtab=obtenirNbEtabOffrantChambres($connexion);
if ($nbEtab!=0)
{
   
   // POUR CHAQUE ÉTABLISSEMENT : AFFICHAGE D'UN TABLEAU COMPORTANT 2 LIGNES 
   // D'EN-TÊTE ET LE DÉTAIL DES ATTRIBUTIONS
   $req=obtenirReqEtablissementsAyantChambresAttribuées();
   //$rsEtab=mysql_query($req, $connexion);
   $rsEtab=$connexion->query($req);
   //$lgEtab=mysql_fetch_array($rsEtab);
   $lgEtab=$rsEtab->fetch(PDO::FETCH_ASSOC);
   // BOUCLE SUR LES ÉTABLISSEMENTS AYANT DÉJÀ DES CHAMBRES ATTRIBUÉES
   while($lgEtab!=FALSE)
   {
      $idEtab=$lgEtab['id'];
      $nomEtab=$lgEtab['nom'];
   
      echo "
      <table width='75%' cellspacing='0' cellpadding='0' align='center' 
      class='tabQuadrille'>";
      
      $nbOffre=$lgEtab["nombreChambresOffertes"];
      $nbOccup=obtenirNbOccup($connexion, $idEtab);
      // Calcul du nombre de chambres libres dans l'établissement
      $nbChLib = $nbOffre - $nbOccup;
      
      // AFFICHAGE DE LA 1ÈRE LIGNE D'EN-TÊTE 
      echo "
      <tr class='enTeteTabQuad'>
         <td colspan='3' align='left'><strong>$nomEtab</strong>&nbsp;
         (Offre : $nbOffre&nbsp;&nbsp;Disponibilités : $nbChLib)
         </td>
      </tr>";
          
      // AFFICHAGE DE LA 2ÈME LIGNE D'EN-TÊTE 
      echo "
      <tr class='ligneTabQuad'>
         <td width='33%' align='left'><i><strong>Nom groupe</strong></i></td>
         <td width='33%' align='left'><i><strong>Chambres attribuées</strong></i>
         </td>
         <td width='33%' align='left'><i><strong>Personnes à loger</strong></i>
         </td>

      </tr>";
        
      // AFFICHAGE DU DÉTAIL DES ATTRIBUTIONS : UNE LIGNE PAR GROUPE AFFECTÉ 
      // DANS L'ÉTABLISSEMENT       
      $req=obtenirReqGroupesEtab($idEtab);
      //$rsGroupe=mysql_query($req, $connexion);
      $rsGroupe=$connexion->query($req);
      //$lgGroupe=mysql_fetch_array($rsGroupe);
      $lgGroupe=$rsGroupe->fetch(PDO::FETCH_ASSOC);
               
      // BOUCLE SUR LES GROUPES (CHAQUE GROUPE EST AFFICHÉ EN LIGNE)
      while($lgGroupe!=FALSE)
      {
         $idGroupe=$lgGroupe['id'];
         $nomGroupe=$lgGroupe['nom'];
         $nombrePersonnes=$lgGroupe['nombrePersonnes'];
         echo "
         <tr class='ligneTabQuad'>
            <td width='65%' align='left'>$nomGroupe</td>";
         // On recherche si des chambres ont déjà été attribuées à ce groupe
         // dans l'établissement

            echo"
            <td width='33%'' align='left'>$nombrePersonnes</td>";

         $nbOccupGroupe=obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe);
         
         echo "
            <td width='35%' align='left'>$nbOccupGroupe</td>
         </tr>";
         //$lgGroupe=mysql_fetch_array($rsGroupe);
         $lgGroupe=$rsGroupe->fetch(PDO::FETCH_ASSOC);
      } // Fin de la boucle sur les groupes
      
      echo "
      </table><br>";
      //$lgEtab=mysql_fetch_array($rsEtab);
      $lgEtab=$rsEtab->fetch(PDO::FETCH_ASSOC);
   } // Fin de la boucle sur les établissements

      echo "
   <table align='center'>
   <tr>
   <td><a href='modificationAttributions.php?action=demanderModifAttrib' class='container btn btn-primary'> Effectuer ou modifier les attributions</a></td>
   </tr>
   </table>";
}

?>