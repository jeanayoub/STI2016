

<?php
   session_start(); // On démarre la session AVANT toute chose
   
   ?>
<?php
   include('config.php');
   
   ?>
<?php
/*
$req2 = $file_db->query('select role from utilisateurs where nomUtilisateur="'.$_SESSION['username'].'"');
         		$dn2 = $req2->fetchAll();		
			
			if($dn2[0]['role']== "collaborateur" )         		
			   header("Location: ./logout.php");
    
*/
if($_SESSION['estActif'] == 1 /* isset($_SESSION['username'])*/){
$result = $file_db->query('SELECT role FROM utilisateurs WHERE nomUtilisateur = "' . $_SESSION['username'] . '"');
	
    foreach ($result as $row) {
        if( $row['role'] == "collaborateur"){
		header("Location: ./logout.php");
	}
	
}
}else{
	header("Location: ./logout.php");
}

        
    

?>
<?php
   if (!isset($_POST['choix']))
   { 
   ?>
Veuillez choisir l'option que vous voulez changer pour 
<?php
   echo $_SESSION['username'];
   }
   ?>
<br />
<?php
   if (!isset($_POST['choix']))
	$_SESSION['estActifMotDePasse'] = 0; 
   	$_SESSION['estActifRole'] = 1 ;    
   { 
   ?>
<form action="editProfile.php" method="POST">
   <select name="choix">
      <option value = "motDePasse"> mot de passe </option>
      <option value = "role"> role </option>
   </select>
   <input type="submit" value="J'ai choisie" />
</form>
<?php
   }
   if (isset($_POST['choix'])){
   ?>
<html>
      <?php
         //On verifie si lutilisateur est connecte

         if($_POST['choix']=="motDePasse")
         {

?>
   <head>
      <title>Modification du mot de passe</title>
      
   </head>
   <body>
	<div class="content">
         <form action="editProfile.php" method="post">
            Vous pouvez changer votre mote de passe pour  <?php echo $_SESSION['nomUser']?><br />
            <div class="center">
               <label for="password">Mot de passe (5 caract&egrave;res min.)</label><input type="password" name="password" id="password"  /><br />
               <label for="passverif">Mot de passe(v&eacute;rification)</label><input type="password" name="passverif" id="passverif"  /><br />
               <input type="submit" value="Modifier" />
            </div>
         </form>
      </div>
<?php
		
	 }else if($_POST['choix']=="role"){
?>
   <head>
      <title>Changement du rôle</title>
      <p> Veuillez choisir le rôle? </p> 
         <form action="editProfile.php" method="post">
<input type="radio" name="roleBouton" value="collaborateur" id="collaborateur" checked="checked" /> <label for="collaborateur">Collaborateur</label>

<input type="radio" name="roleBouton" value="administrateur" id="administrateur" /> <label for="administrateur">administrateur</label>
<br />
<input type="submit" value="choisir" />
   </head>
   <body>
<?php

		
	 }
}
if(isset($_POST['roleBouton'])){
	$file_db->exec('UPDATE utilisateurs SET role = "'.$_POST['roleBouton'].'" WHERE  nomUtilisateur = "'.$_SESSION['nomUser'].'" ');
	echo 'le role de  '.$_SESSION['nomUser'].'  est devenu  "'.$_POST['roleBouton'].'" ';
	$form = false;
	
}
//On verifie si le formulaire a ete envoye
elseif(isset($_POST['password'], $_POST['passverif'])){

   //On enleve lechappement si get_magic_quotes_gpc est active
   if(get_magic_quotes_gpc()){
      $_POST['password'] = stripslashes($_POST['password']);
      $_POST['passverif'] = stripslashes($_POST['passverif']);
   }
   //On verifie si le mot de passe et celui de la verification sont identiques
   if($_POST['password']==$_POST['passverif']){
      //On verifie si le mot de passe a 5 caracteres ou plus
      if(strlen($_POST['password'])>=5){
         if($file_db->exec('UPDATE utilisateurs SET motDePasse = "'.$_POST['password'].'" WHERE  nomUtilisateur = "'.$_SESSION['nomUser'].'" ')){
	    
            //Si ca a fonctionne, on naffiche pas le formulaire
            $form = false;
?>
<div class="message">Vos informations ont bien &eacute;t&eacute; modifif&eacute;e. </div>
<?php
         }else{
         	$form = true;
         	$message = 'Une erreur est survenue lors des modifications.';
      	 }
      }else{
         $form = true;
         $message = 'Le mot de passe doit contenir au moins 5 caract&egrave;res.';
      }
   }else{
      $form = true;
      $message = 'Les mot de passe que vous avez entr&eacute; ne sont pas identiques.';
   }
}else{
	
   $form = false;
}

      
if($form){
   //On affiche un message sil y a lieu
   if(isset($message)){
      echo '<strong>'.$message.'</strong>';
   }
         
        
         ?>
      
      <?php
}
         ?>
	<br />
      <a href="collaborateur.php">Retour sur votre page initiale</a>
   </body>
</html>


