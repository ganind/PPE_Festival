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