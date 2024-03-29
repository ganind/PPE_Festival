<!DOCTYPE html> 
<html lang="fr">

<!-- TITRE ET MENUS -->

<head>

<title>Festival | Accueil</title> 
<meta charset="utf-8"> <!-- reconnaissance des accents -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="M2L Festival">
<link href=css/cssGeneral.css rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<!-- define variables and set to empty values  -->
    <?php

include("_gestionBase.inc.php"); 
include("_controlesEtGestionErreurs.inc.php");

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

$username = $email = $password = "";

      if (isset($_POST['create'])) {
          $username   = $_POST["username"];
          $email      = $_POST["email"];
          $password   = $_POST["password"];

          $sql = "INSERT INTO users (username, email, password) VALUES(?,?,password(?))";
          $stmtinsert = $connexion->prepare($sql);
          $result = $stmtinsert->execute([$username, $email, $password]);
          if($result){
            header("location:login_sucess.php");
          } else {
            echo 'Problème de sauvegarde !';
          }
}

?> 
	<!-- Tableau contenant le titre -->
   <div class="basePage">
      <table id="table_basePage">
         <tr> 
            <td class="titre">Festival Folklores du Monde<br>
            <span class="texteNiveau2">Inscription</span>
            </td>
         </tr>
      </table>
   </div>
   <br>
   <!-- Tableau contenant les menus -->
   <div class="menu">
      <table class="" align="center">
         <tr>
            <td>
            	<a href="index.php" class="btn btn-primary" style='background-color: #e2ddff; color:#0a0869; border:none;'>Accueil</a>
            </td>
         </tr>
      </table>
      <br>
   </div>
   <!-- méthode de sécurité pour le transfert de données-->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <div class="container">
    <p>Veuillez remplir le formulaire ci-dessous.</p>
    <hr>

    <label for="username"><b>Nom d'utilisateur : </b></label>
    <input type="text" placeholder="Nom d'utilisateur" name="username" required>

    <label for="email"><b>Email : </b></label>
    <input type="text" placeholder="Email" name="email" required>

    <label for="password"><b>Mot de passe :</b></label>
    <input type="password" placeholder="Mot de passe" name="password" required>
    <hr>
    
    <div class="container" align="center">
    <button type="submit" class="btn btn-primary" name="create">S'Inscrire</button> </div>
  </div>
  <br>

  <div class="container" align="center">
    <p>Vous avez déjà un compte? <a href="login.php">S'identifier</a>.</p>
  </div>
</form>
</body>
</html>

<?php



