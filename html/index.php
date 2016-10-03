

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
      <?php
         if (!isset($_POST['role']))
         { 
         ?>
      Veuillez choisir votre rôle pour s'authentifier!
      <?php
         }
         ?>
      <br />
      <?php
         if (!isset($_POST['role']))
         { 
         ?>
      <form action="index.php" method="POST">
         <select name="role">
            <option value = "Collaborateur"> Collaborateur </option>
            <option value = "Administrateur"> Administrateur </option>
         </select>
         <input type="submit" value="J'ai choisie" />
      </form>
      <?php
         }
         ?>
      <br />
      <br />
      <?php
         //Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour voir ses messages et un pour se deconnecter
         if(isset($_SESSION['username']))
         {
         ?>
      <a href="edit_infos.php">Modifier mes informations personnelles</a><br />
      <a href="connexion.php">Se d&eacute;connecter</a>
      <?php
         }
         else
         {
         	
         
         	if (isset($_POST['role']))
         	{
         
         		if ($_POST['role'] == "Collaborateur")
         		{
         ?>
      <form action="sign_up.php"> 
         <input type="submit"value="  Inscription  ">
      </form>
      <br />
      <?php
         }
         ?>
      <form action="connexion.php"> 
         <input type="submit"value="  Se connecter  ">
      </form>
      <br />
      <?php
         }
         }
         ?>
   </body>
</html>


