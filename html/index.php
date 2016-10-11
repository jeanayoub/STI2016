<!DOCTYPE html >
<html lang="fr">
   <head>
      <title>Service de messagerie</title>
   </head>
   <body>
      <img src="./default/images/iconeMessagerie.jpg" alt="iconeMessagerie" /></a>
      <br />
      <?php
         //On affiche un message de bienvenue, si lutilisateur est connecte, on affiche son pseudo
         ?>
      Bonjour<?php if(isset($_SESSION['username'])){echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');} ?>,<br />
      Bienvenue sur le portail de messagerie Intranet.<br />
      <br />
      <br />
      
      
      <form action="connexion.php"> 
         <input type="submit"value="  Se connecter  ">
      </form>
      <br />
      
   </body>
</html>
