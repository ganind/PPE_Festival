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

<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<?php
// define variables and set to empty values
$username = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
    <p>Veuillez remplir le formulaire ci-dessus.</p>
    <hr>

    <label for="username"><b>Nom d'utilisateur : </b></label>
    <input type="text" placeholder="Nom d'utilisateur" name="email" required>

    <label for="email"><b>Email : </b></label>
    <input type="text" placeholder="Email" name="email" required>

    <label for="psw"><b>Mot de passe :</b></label>
    <input type="password" placeholder="Mot de passe" name="psw" required>

    <label for="psw-repeat"><b>Confirmez le mot de passe :</b></label>
    <input type="password" placeholder="Confirmez le mot de passe" name="psw-repeat" required>
    <hr>
    
    <div class="container" align="center">
    <button type="submit" class="btn btn-primary">S'Inscrire</button> </div>
  </div>
  <br>

  <div class="container" align="center">
    <p>Vous avez déjà un compte? <a href="login.php">S'identifier</a>.</p>
  </div>
</form>
</body>
</html>

<?php



