<?php
   session_start(); 
   date_default_timezone_set('Europe/Paris');
  
   ?>
<?php
   include('config.php');
 
   ?>

<!DOCTYPE html>
<?php 
   if ($_SESSION['estActif'] == 0  ) {
   
   	header ('Location: logout.php');
   }
if(isset($_POST['logOff'])){
		$file_db->exec('UPDATE utilisateurs SET estActif =' .' "inactif" '.' WHERE  nomUtilisateur = "'.$_SESSION['username'].'" ');      
		header("Location: ./connexion.php");
	}elseif(isset($_POST['voirrepondre']) ){
		$_SESSION['identifiant'] = $_POST['voirrepondre'];
		header("Location: ./mail.php");
	}elseif(isset($_POST['supprimer']) or isset($_POST['selection'])){		
			$file_db->exec('DELETE FROM messages where id= "'.$_POST['selection'].'"');			
			header("Location: ./collaborateur.php");
	
	}




   ?>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Page collaborateur</title>
   </head>
   <body>
      <h1>Vous êtes sur la page des colloborateurs</h1>
      <p>Bonjour <?php echo $_SESSION['username']; ?>.
	</p>
	
<head>
      <a href="mail.php"> composer un message</a>

      <br />
      <br />
      <title>répondre aux messages</title>
      <p> Vous pouvez r&eacutepondre à la personne en cochant sa case. </p> 
      <form action="collaborateur.php" method="post">
	<TABLE BORDER>
		<TR>
			<TH COLSPAN=4>Messages </TH>
		</TR>
		<TR>
			<TH>De</TH> <TH>Sujet</TH> <TH>Date</TH> <TH></TH>    
		</TR>
		<TR>
	<?php
		$result =  $file_db->query('SELECT expediteur, sujet, dateReception, id FROM messages WHERE destinataire = "'.$_SESSION['username'].'"');
	
		foreach($result as $row) {
	?>
		
			<TD><INPUT type="radio" value="<?php echo $row['id'] ?>" name="selection" > <?php echo $row['expediteur'] ?></TD> <TD><?php echo $row['sujet'] ?></TD> <TD><?php echo $row['dateReception'] ?></TD> 

 <TD><button name = "voirrepondre"  type="submit" value="<?php echo $row['id'] ?>">voir et répondre </TD> 
	</TR>
		
	<?php
		}
	?>	
	</TABLE>
	<input type="submit"value="supprimer"/>
	</form>
   </head>
	<br />

	<form action="collaborateur.php" method="POST">
         <input name = "logOff" type="submit" value="Log off" />
      </form>

   </body>
   <a href="edit_infos.php"> Modifier votre mot de passe</a>
</html>


