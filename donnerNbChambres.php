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
<?php //manque du mot php

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

// SÉLECTIONNER LE NOMBRE DE CHAMBRES SOUHAITÉES

$idEtab=$_REQUEST['idEtab'];
$idGroupe=$_REQUEST['idGroupe'];
$nbChambres=$_REQUEST['nbChambres'];

echo "
<form method='POST' action='modificationAttributions.php'>
	<input type='hidden' value='validerModifAttrib' name='action'>
   <input type='hidden' value='$idEtab' name='idEtab'>
   <input type='hidden' value='$idGroupe' name='idGroupe'>";
   $nomGroupe=obtenirNomGroupe($connexion, $idGroupe);
   
   echo "
   <br><center><h5>Combien de chambres souhaitez-vous pour le 
   groupe $nomGroupe dans cet établissement ?";
   
   echo "&nbsp;<select name='nbChambres'>";
   for ($i=0; $i<=$nbChambres; $i++)
   {
      echo "<option>$i</option>";
   }
   echo "
   </select></h5>
   <input type='submit' value='Valider' name='valider'>&nbsp&nbsp&nbsp&nbsp
   <input type='reset' value='Annuler' name='Annuler'><br><br>
   <a href='modificationAttributions.php?action=demanderModifAttrib'>Retour</a>
   </center>
</form>";

?>