<?php
   session_start(); 
   date_default_timezone_set('Europe/Paris');
  
   ?>
<?php
   include('config.php');
 
   ?>

<?php 
   if(isset($_POST['voirrepondre'])){	
	echo $_POST['voirrepondre'];
   }
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
      <title>Page mail</title>
   </head>
   <body>
      <p><?php echo $_SESSION['username']; ?>.
	</p>
	
	<h3> Message </h3>
	<form action="collaborateur.php" method="POST">
	<p>sujet : <input type="text" name="sujet" /></p>
	<textarea name="message" rows="8" cols="45"> Ecrivez votre message!
	</textarea>
	<br />
         <select name="listeUtilisateur">
            <?php
		$result =  $file_db->query('SELECT nomUtilisateur FROM utilisateurs');	
               foreach($result as $row) {
               ?>
            <option value = "<?php echo $row['nomUtilisateur'] ?>"  > <?php echo $row['nomUtilisateur'] ?> </option>
            <?php 
               }
                             ?>
         </select>
         <input name = "envoyer" type="submit"value="envoyer"/>
      </form>
	<br />

	<form action="collaborateur.php" method="POST">         
	 <br />
         <input name = "logOff" type="submit" value="Log off" />
      </form>

<?php
	if(isset($_POST['logOff'])){
		$file_db->exec('UPDATE utilisateurs SET estActif =' .' "inactif" '.' WHERE  nomUtilisateur = "'.$_SESSION['username'].'" ');      
		header("Location: ./connexion.php");
	}
	
?>

<?php
	$now = date("F j, Y, g:i a");
	if(isset($_POST['envoyer'])){
		$file_db->exec('INSERT into messages( dateReception, expediteur, destinataire, sujet, contenu) VALUES ("'.$now.'",  "'.$_SESSION['username'].'" ,"'.$_POST['listeUtilisateur'].'", "'.$_POST['sujet'].'" , "'.$_POST['message'].'")');
		
	}
	
?>

	

   </body>
   <a href="edit_infos.php"> Modifier votre mot de passe</a>
</html>


