<?php
   session_start(); 

  
   ?>
<?php
   include('config.php');
 
   ?>

<!DOCTYPE html>
<?php 
   if ($_SESSION['estActif'] == 0  ) {
   
   	header ('Location: logout.php');
   }

   ?>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Page collaborateur</title>
   </head>
   <body>
      <h1>Vous êtes sur la page des colloborateurs</h1>
      <p>Bonjour <?php echo $_SESSION['username']; ?></p>


	<form action="collaborateur.php" method="POST">
         
         <input name = "logOff" type="submit" value="Log off" />
      </form>
<?php
	if(isset($_POST['logOff'])){
		$file_db->exec('UPDATE utilisateurs SET estActif =' .' "inactif" '.' WHERE  nomUtilisateur = "'.$_SESSION['username'].'" ');      
		header("Location: ./connexion.php");
	}
	
?>
	

   </body>
   <a href="edit_infos.php"> Modifier votre mot de passe</a>
</html>


