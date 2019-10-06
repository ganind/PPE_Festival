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

// CRÉER UN ÉTABLISSEMENT 

// Déclaration du tableau des civilités
$tabCivilite=array("M.","Mme","Melle");  

$action=$_REQUEST['action'];
// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action=='demanderCreEtab') 
{  
   $id='';
   $nom='';
   $adresseRue='';
   $ville='';
   $codePostal='';
   $tel='';
   $adresseElectronique='';
   $type=0;
   $civiliteResponsable='Monsieur';
   $nomResponsable='';
   $prenomResponsable='';
   $nombreChambresOffertes='';
   $infoP='';
}
else
{
   $id=$_REQUEST['id']; 
   $nom=$_REQUEST['nom']; 
   $adresseRue=$_REQUEST['adresseRue'];
   $codePostal=$_REQUEST['codePostal'];
   $ville=$_REQUEST['ville'];
   $tel=$_REQUEST['tel'];
   $adresseElectronique=$_REQUEST['adresseElectronique'];
   $type=$_REQUEST['type'];
   $civiliteResponsable=$_REQUEST['civiliteResponsable'];
   $nomResponsable=$_REQUEST['nomResponsable'];
   $prenomResponsable=$_REQUEST['prenomResponsable'];
   $nombreChambresOffertes=$_REQUEST['nombreChambresOffertes'];
   $infoP=$_REQUEST['infoP'];

   verifierDonneesEtabC($connexion, $id, $nom, $adresseRue, $codePostal, $ville, 
                        $tel, $nomResponsable, $nombreChambresOffertes);      
   if (nbErreurs()==0)
   {        
    creerEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, $ville,  
                         $tel, $adresseElectronique, $type, $civiliteResponsable, 
                         $nomResponsable, $prenomResponsable, $nombreChambresOffertes, $infoP);
   }
}

echo '
<form method="POST" action="creationEtablissement.php?">
   <input type="hidden" value="validerCreEtab" name="action">
   <table width="85%"" align="center" cellspacing="0" cellpadding="0" 
   class="tabNonQuadrille">
   
      <tr class="enTeteTabNonQuad">
         <td colspan="3">Nouvel établissement</td>
      </tr>

      <tr class="ligneTabNonQuad">
         <td> Les champs indiqués par (*) sont obligatoires. </td>
      </tr>

      <tr class="ligneTabNonQuad">
         <td> Id (*): </td>
         <td><input type="number" required value="$id" name="id" maxlength="8"</td> 
      </tr>

      <tr class="ligneTabNonQuad">
         <td> Nom (*): </td>
         <td><input type="text" required value="'.$nom.'" name="nom" maxlength="45"></td>
      </tr>

      <tr class="ligneTabNonQuad">
         <td> Adresse (*): </td>
         <td><input type="text" required value="'.$adresseRue.'" name="adresseRue" maxlength="45"></td>
      </tr>

      <tr class="ligneTabNonQuad">
         <td> Code postal (*): </td>
         <td><input type="number" required value="'.$codePostal.'" name="codePostal" maxlength="5"></td>
      </tr>

      <tr class="ligneTabNonQuad">
         <td> Ville (*): </td>
         <td><input type="text" required value="'.$ville.'" name="ville" maxlength="35"></td>
      </tr>

      <tr class="ligneTabNonQuad">
         <td> Téléphone (*): </td>
         <td><input type="number" required value="'.$tel.'" name="tel" maxlength="10"></td>
      </tr>

      <tr class="ligneTabNonQuad">
         <td> E-mail: </td>
         <td><input type="email" value="'.$adresseElectronique.'" name="adresseElectronique" maxlength="70"></td>
      </tr>

      <tr class="ligneTabNonQuad">
         <td> Type (*): </td>
         <td>';

            if ($type==1)
            {
               echo " 
               <input type='radio' name='type' value='1' checked>  
               Etablissement Scolaire
               <input type='radio' name='type' value='0'>  Autre";
             }
             else
             {
                echo " 
                <input type='radio'  name='type' value='1'> 
                Etablissement Scolaire
                <input type='radio' name='type' value='0' checked> Autre";
              }

           echo "
           </td>
         </tr>

         <tr class='ligneTabNonQuad'>
            <td colspan='2' ><strong>Responsable:</strong></td>
         </tr>

         <tr class='ligneTabNonQuad'>
            <td> Civilité (*): </td>
            <td> <select name='civiliteResponsable'>";
               for ($i=0; $i<3; $i=$i+1)
                  if ($tabCivilite[$i]==$civiliteResponsable) 
                  {
                     echo "<option selected>$tabCivilite[$i]</option>";
                  }
                  else
                  {
                     echo "<option>$tabCivilite[$i]</option>";
                  }
               echo '
               </select>&nbsp; &nbsp; &nbsp; &nbsp; Nom (*): 
               <input type="text" required value="'.$nomResponsable.'" name="nomResponsable">
               &nbsp; &nbsp; &nbsp; &nbsp; Prénom: 
               <input type="text" value="'.$prenomResponsable.'" name="prenomResponsable">
            </td>
         </tr>

          <tr class="ligneTabNonQuad">
            <td> Nombre chambres offertes (*): </td>
            <td><input type="number" required value="'.$nombreChambresOffertes.'" name="nombreChambresOffertes"></td>
         </tr>
         
          <tr class="ligneTabNonQuad">
         <td> Informations pratiques: </td>
         <td><input type="text" value="'.$infoP.'" name="infoP" maxlength="200"></td>
      </tr>

   </table>';
   
   echo "
   <table align='center' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
         </td>
         <td align='left'><input type='reset' value='Annuler' name='annuler'>
         </td>
      </tr>
      <tr>
         <td colspan='2' align='center'><a href='listeEtablissements.php'>Retour</a>
         </td>
      </tr>
   </table>
</form>";

// En cas de validation du formulaire : affichage des erreurs ou du message de 
// confirmation
if ($action=='validerCreEtab')
{
   if (nbErreurs()!=0)
   {
      afficherErreurs();
   }
   else
   {
      echo "
      <h5><center>La création de l'établissement a été effectuée</center></h5>";
   }
}

?>