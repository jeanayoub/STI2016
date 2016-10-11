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
      <p>Bonjour <?php echo $_SESSION['username']; ?>.
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
            <option value = "<?php echo $row['nomUtilisateur'] ?>" > <?php echo $row['nomUtilisateur'] ?> </option>
            <?php 
               }
                             ?>
         </select>
         <input type="submit"value="envoyer"/>
      </form>
	<br />
	<br />
	<br />
	<TABLE BORDER>
		<TR>
			<TH COLSPAN=4>Messages </TH>
		</TR>
		<TR>
			<TH>De</TH> <TH>Sujet</TH> <TH>Date</TH> <TH>Détail message </TH>
		</TR>
		<TR>
			<TD>A</TD> <TD>BBBBBBBBBBBBBBBBBBB</TD> <TD>C</TD> <TD></TD>
		</TR>
		<TR>
			<TD>D</TD> <TD>E</TD> <TD>F</TD> <TD></TD>
		</TR>
	</TABLE>

	<form action="collaborateur.php" method="POST">
         
	 <br />
	 <br />
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


