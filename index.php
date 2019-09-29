
<!-- Accès espace client -->
<html>
   <div class="user_box ml-auto"> 
      <div class="user_box_login user_box_link"><a href="login.php">S'Identifier</a></div>
         <div class="user_box_register user_box_link"><a href="Nouveau_Membre.php">Créer un compte</a></div>
   </div>
</html>

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

include "_debut.inc.php";

echo " <br> 
<table width='80%' cellspacing='0' cellpadding='0' align='center'>
   <tr>  
      <td class='texteAccueil'>
         Cette application web permet de gérer l'hébergement des groupes de musique 
         durant le festival Folklores du Monde.
      </td>
   </tr>
   <tr>
      <td>&nbsp;
      </td>
   </tr>
   <tr>
      <td class='texteAccueil'>
          Elle offre les services suivants :
      </td>
   </tr>
   <tr>
      <td>&nbsp;
      </td>
   </tr>
   <tr>
      <td class='texteAccueil'>
      <ul>
         <li>Gérer les établissements (caractéristiques et capacités d'accueil) acceptant d'héberger les groupes de musiciens.
         <p>
	      </p>
         <li>Consulter, réaliser ou modifier les attributions des chambres aux groupes dans les établissements.
      </ul>
      </td>
   </tr>
</table>";

?>
