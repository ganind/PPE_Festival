<?php //manque du nom php

// FONCTIONS DE CONNEXION

/*function connect() --> OBSOLETE
{
   $hote="localhost";
   $login="festival";
   $mdp="secret";
   return mysql_connect($hote, $login, $mdp);
}
*/
//nouvelle fonction
//Connexion à une base MySQL avec l'invocation de pilote --> FONCTION A JOUR BY DOC PHP
function connect() 
{
   $dsn = 'mysql:dbname=festival;host=localhost';
   $user = 'festival';
   $password = 'secret';

   try {
      $dbh = new PDO($dsn, $user, $password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (PDOException $e) {
      echo 'Connexion échouée : ' . $e->getMessage();
   }
   return $dbh; //retourne l'object connexion 
}

function selectBase($connexion)
{
   $bd="festival";
   $query="SET CHARACTER SET utf8"; // Modification du jeu de caractères de la connexion //requete
   //$ok=mysql_select_db($bd, $connexion); selection bd deja presente dans $connexion
   $res=$connexion->query($query); //mysql_query obsolete
   //$res recoit resultat de l'appel de la methode query presente dans l'object $connexion
   return $res;
}

// FONCTIONS DE GESTION DES ÉTABLISSEMENTS

function obtenirReqEtablissements()
{
   $req="select id, nom from Etablissement order by id";
   return $req;
}

function obtenirReqEtablissementsOffrantChambres()
{
   $req="select id, nom, nombreChambresOffertes from Etablissement where 
         nombreChambresOffertes!=0 order by id";
   return $req;
}

function obtenirReqEtablissementsAyantChambresAttribuées()
{
   $req="select distinct id, nom, nombreChambresOffertes from Etablissement, 
         Attribution where id = idEtab order by id";
   return $req;
}

function obtenirDetailEtablissement($connexion, $id)
{
   $req="select * from Etablissement where id='$id'"; //requete 
   //$rsEtab=mysql_query($req, $connexion); --> obsolete
   $rsEtab=$connexion->query($req); //recoit resultat de l'appel de la methode query presente dans l'object $connexion
   //mysql_fetch_array($rsEtab); --> Obsolete
   return $rsEtab->fetch(PDO::FETCH_ASSOC); //nouvelle methode PDO::FETCH_ASSOC: retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats 
}

function supprimerEtablissement($connexion, $id)
{
   $req="delete from Etablissement where id='$id'"; //requete
   //mysql_query($req, $connexion);
   $connexion->query($req); 
}
 
function modifierEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                               $ville, $tel, $adresseElectronique, $type, 
                               $civiliteResponsable, $nomResponsable, 
                               $prenomResponsable, $nombreChambresOffertes, $infoP)
{  
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
   $infoP=str_replace("'", "'", $infoP);
  
   $req="update Etablissement set nom='$nom',adresseRue='$adresseRue',
         codePostal='$codePostal',ville='$ville',tel='$tel',
         adresseElectronique='$adresseElectronique',type='$type',
         civiliteResponsable='$civiliteResponsable',nomResponsable=
         '$nomResponsable',prenomResponsable='$prenomResponsable',
         nombreChambresOffertes='$nombreChambresOffertes',infoP='$infoP' where id='$id'";
   
   //mysql_query($req, $connexion);
   $connexion->query($req);
}

function creerEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, 
                            $ville, $tel, $adresseElectronique, $type, 
                            $civiliteResponsable, $nomResponsable, 
                            $prenomResponsable, $nombreChambresOffertes, $infoP)
{ 
   $nom=str_replace("'", "''", $nom);
   $adresseRue=str_replace("'","''", $adresseRue);
   $ville=str_replace("'","''", $ville);
   $adresseElectronique=str_replace("'","''", $adresseElectronique);
   $nomResponsable=str_replace("'","''", $nomResponsable);
   $prenomResponsable=str_replace("'","''", $prenomResponsable);
   $infoP=str_replace("'","''", $infoP);
   
   $req="insert into Etablissement values ('$id', '$nom', '$adresseRue', 
         '$codePostal', '$ville', '$tel', '$adresseElectronique', '$type', 
         '$civiliteResponsable', '$nomResponsable', '$prenomResponsable',
         '$nombreChambresOffertes', '$infoP')";

   $connexion->query($req);
   /*echo $req; --> verification des erreurs sur la requete vers la BDD
   //mysql_query($req, $connexion);
   $ret=$connexion->query($req);
   if( $ret == FALSE){
      echo "false";
   }else {
      echo "true";
   }*/
}


function estUnIdEtablissement($connexion, $id)
{
   $req="select * from Etablissement where id='$id'";
   //$rsEtab=mysql_query($req, $connexion);
   $rsEtab=$connexion->query($req);
   //return mysql_fetch_array($rsEtab);
   return $rsEtab->fetch(PDO::FETCH_ASSOC);
}

function estUnNomEtablissement($connexion, $mode, $id, $nom)
{
   $nom=str_replace("'", "''", $nom);
   // S'il s'agit d'une création, on vérifie juste la non existence du nom sinon
   // on vérifie la non existence d'un autre établissement (id!='$id') portant 
   // le même nom
   if ($mode=='C')
   {
      $req="select * from Etablissement where nom='$nom'";
   }
   else
   {
      $req="select * from Etablissement where nom='$nom' and id!='$id'";
   }
   //$rsEtab=mysql_query($req, $connexion);
   $rsEtab=$connexion->query($req);
   //return mysql_fetch_array($rsEtab);
   return $rsEtab->fetch(PDO::FETCH_ASSOC);
}

function obtenirNbEtab($connexion)
{
   $req="select count(*) as nombreEtab from Etablissement";
   //$rsEtab=mysql_query($req, $connexion);
   $rsEtab=$connexion->query($req);
   $lgEtab=$rsEtab->fetch(PDO::FETCH_ASSOC);
   //$lgEtab=mysql_fetch_array($rsEtab);
   return $lgEtab["nombreEtab"];
}

function obtenirNbEtabOffrantChambres($connexion)
{
   $req="select count(*) as nombreEtabOffrantChambres from Etablissement where 
         nombreChambresOffertes!=0";
   //$rsEtabOffrantChambres=mysql_query($req, $connexion);
   $rsEtabOffrantChambres=$connexion->query($req);
   $lgEtabOffrantChambres=$rsEtabOffrantChambres->fetch(PDO::FETCH_ASSOC);
   //$lgEtabOffrantChambres=mysql_fetch_array($rsEtabOffrantChambres);
   return $lgEtabOffrantChambres["nombreEtabOffrantChambres"];
}

// Retourne false si le nombre de chambres transmis est inférieur au nombre de 
// chambres occupées pour l'établissement transmis 
// Retourne true dans le cas contraire
function estModifOffreCorrecte($connexion, $idEtab, $nombreChambres)
{
   $nbOccup=obtenirNbOccup($connexion, $idEtab);
   return ($nombreChambres>=$nbOccup);
}

// FONCTIONS RELATIVES AUX GROUPES

function obtenirReqIdNomGroupesAHeberger()
{
   $req="select id, nom, nombrePersonnes from Groupe where hebergement='O' order by id";
   return $req;
}

function obtenirNomGroupe($connexion, $id)
{
   $req="select nom from Groupe where id='$id'";
   //$rsGroupe=mysql_query($req, $connexion);
   $rsGroupe=$connexion->query($req);
   $lgGroupe=$rsGroupe->fetch(PDO::FETCH_ASSOC);
   //$lgGroupe=mysql_fetch_array($rsGroupe);
   return $lgGroupe["nom"];
}

// FONCTIONS RELATIVES AUX ATTRIBUTIONS

// Teste la présence d'attributions pour l'établissement transmis    
function existeAttributionsEtab($connexion, $id)
{
   $req="select * From Attribution where idEtab='$id'";
   //$rsAttrib=mysql_query($req, $connexion);
   $rsAttrib=$connexion->query($req);
   //return mysql_fetch_array($rsAttrib);
   return $rsAttrib->fetch(PDO::FETCH_ASSOC);
}

// Retourne le nombre de chambres occupées pour l'id étab transmis
function obtenirNbOccup($connexion, $idEtab)
{
   $req="select IFNULL(sum(nombreChambres), 0) as totalChambresOccup from
        Attribution where idEtab='$idEtab'";
   //$rsOccup=mysql_query($req, $connexion);
   $rsOccup=$connexion->query($req);
   //$lgOccup=mysql_fetch_array($rsOccup);
   $lgOccup=$rsOccup->fetch(PDO::FETCH_ASSOC);
   return $lgOccup["totalChambresOccup"];
}

// Met à jour (suppression, modification ou ajout) l'attribution correspondant à
// l'id étab et à l'id groupe transmis
function modifierAttribChamb($connexion, $idEtab, $idGroupe, $nbChambres)
{
   $req="select count(*) as nombreAttribGroupe from Attribution where idEtab=
        '$idEtab' and idGroupe='$idGroupe'";
   //$rsAttrib=mysql_query($req, $connexion);
   $rsAttrib=$connexion->query($req);
   //$lgAttrib=mysql_fetch_array($rsAttrib);
   $lgAttrib=$rsAttrib->fetch(PDO::FETCH_ASSOC);
   if ($nbChambres==0)
      $req="delete from Attribution where idEtab='$idEtab' and idGroupe='$idGroupe'";
   else
   {
      if ($lgAttrib["nombreAttribGroupe"]!=0)
         $req="update Attribution set nombreChambres=$nbChambres where idEtab=
              '$idEtab' and idGroupe='$idGroupe'";
      else
         $req="insert into Attribution values('$idEtab','$idGroupe', $nbChambres)";
   }
   //mysql_query($req, $connexion);
   $connexion->query($req);
}

// Retourne la requête permettant d'obtenir les id et noms des groupes affectés
// dans l'établissement transmis
function obtenirReqGroupesEtab($id)
{
   $req="select distinct id, nom, nombrePersonnes from Groupe, Attribution where 
        Attribution.idGroupe=Groupe.id and idEtab='$id'";
   return $req;
}
            
// Retourne le nombre de chambres occupées par le groupe transmis pour l'id étab
// et l'id groupe transmis
function obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe)
{
   $req="select nombreChambres From Attribution where idEtab='$idEtab'
        and idGroupe='$idGroupe'";
   //$rsAttribGroupe=mysql_query($req, $connexion);
   $rsAttribGroupe=$connexion->query($req);
   //if ($lgAttribGroupe=mysql_fetch_array($rsAttribGroupe))
   if ($lgAttribGroupe=$rsAttribGroupe->fetch(PDO::FETCH_ASSOC))
      return $lgAttribGroupe["nombreChambres"];
   else
      return 0;
}

//balise n'etait pas fermé
?>