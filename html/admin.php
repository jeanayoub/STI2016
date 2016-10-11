<?php
   session_start(); 
   
   ?>
<?php
   include('config.php');
   ?>
<!DOCTYPE html>
<?php 
//   if ($_SESSION['username'] != "admin" || $_SESSION['password'] != "admin" ) {
//   
//   header ('Location: logout.php');
//   }
   
   
   
   ?>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Page d'admin</title>
   </head>
   <body>
      <h1>Vous êtes sur la page d'admin</h1>
      <?php
         if (!isset($_POST['modifUtilisateurs']))
         { 
         ?>
      <form action="admin.php" method="POST">
         <select name="modifUtilisateurs">
            <option value = "Ajout"> Ajout </option>
            <option value = "Modification"> Modification </option>
            <option value = "Suppression"> Suppression </option>
         </select>
         <input type="submit" value="J'ai choisie" />
      </form>
      <?php
         }
         if (isset($_POST['modifUtilisateurs']))
         	{
         		
         		if ($_POST['modifUtilisateurs'] == "Ajout")
         			header("Location: ./sign_up.php");
         		else if ($_POST['modifUtilisateurs'] == "Modification" ){
         			
         			$_SESSION['estActifModif'] = 1; 
         			$_SESSION['estActifSupression'] = 0; 
         			$result =  $file_db->query('SELECT nomUtilisateur FROM utilisateurs');
         ?>
      <form action="admin.php" method="POST">
         <select name="listeUtilisateur">
            <?php	
               foreach($result as $row) {
               ?>
            <option value = "<?php echo $row['nomUtilisateur'] ?>" > <?php echo $row['nomUtilisateur'] ?> </option>
            <?php 
               }
                             ?>
         </select>
         <input type="submit"value="valider le nom d'utilisateur pour le modifier"/>
      </form>
      <?php
         }else if ($_POST['modifUtilisateurs'] == "Suppression" ){
         	$_SESSION['estActifModif'] = 0; 
         	$_SESSION['estActifSupression'] = 1; 
         
         	$result =  $file_db->query('SELECT nomUtilisateur FROM utilisateurs');
         ?>
      <form action="admin.php" method="POST">
         <select name="listeUtilisateur">
            <?php	
               foreach($result as $row) {
               ?>
            <option value = "<?php echo $row['nomUtilisateur'] ?>" > <?php echo $row['nomUtilisateur'] ?> </option>
            <?php 
               }
                             ?>
         </select>
         <input type="submit"value="valider le nom d'utilisateur pour le suprimmer"/>
      </form>
      <?php
         }
         

         }
         ?>
      <?php
         if(isset($_POST['listeUtilisateur'])){
         	
         	
         	if($_SESSION['estActifModif'] == 1){
         		$_SESSION['nomUser'] = $_POST['listeUtilisateur']; 
         		header ('Location: editProfile.php');
         	}
         	else if($_SESSION['estActifSupression'] == 1){
         		$file_db->query('DELETE FROM utilisateurs where nomUtilisateur="'.$_POST['listeUtilisateur'].'"');
         		echo 'La supression de ' .$_POST['listeUtilisateur'].' est faite';
          
         
         	}
         }
         ?>
      <br />
      <a href="logout.php">Log off</a>
   </body>
</html>
