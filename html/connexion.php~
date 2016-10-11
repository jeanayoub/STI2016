

<?php
   session_start(); 
   $_SESSION['password'] = '';
   $_SESSION['username'] = '';
   $_SESSION['estActif'] = 0; 
   ?>
<?php
   include('config.php');
   ?>
<!DOCTYPE html>
<html>
   <head>
      <img src="./default/images/iconeMessagerie.jpg" alt="iconeMessagerie" /></a>
      <title>Connection</title>
   </head>
   <body>
      <?php
         {
         	
         	//On verifie si le formulaire a ete envoye
         	if(isset($_POST['username'], $_POST['password']))
         	{
         		//On echappe les variables pour pouvoir les mettre dans des requetes SQL
         		if(get_magic_quotes_gpc())
         		{
         			
         			$username = stripslashes($_POST['username']);
         			$password = stripslashes($_POST['password']);
         		}
         		else
         		{
         			$username = $_POST['username']/*)*/;
         			$password = $_POST['password'];
         			$_SESSION['password']= $password;
         			$_SESSION['username']= $username;
         
         			if (isset($_POST['password']) and $_POST['password'] == "admin" and 
         			    isset($_POST['username']) and $_POST['username'] == "admin"){
         				header("Location: /admin.php");
         			}
         
         
         		}
         		//On recupere le mot de passe de lutilisateur
         		$req = $file_db->query('select motDePasse from utilisateurs where nomUtilisateur="'.$username.'"');
         		$dn = $req->fetchAll();
         
         		//On le compare a celui quil a entre et on verifie si le membre existe
         		if(count($dn) == 1 and $dn[0]['motDePasse']==$password)
         		{
         			//Si le mot de passe est bon, on ne vas pas afficher le formulaire
         		$_SESSION['estActif'] = 1; 
			$file_db->exec('UPDATE utilisateurs SET estActif = "actif" WHERE  nomUtilisateur = "'.$_POST['username'].'" ');
         		header("Location: ./collaborateur.php");
         			$form = false;
         			//On enregistre son pseudo dans la session username et son identifiant dans la session userid
         			$_SESSION['username'] = $_POST['username'];
         			$_SESSION['password'] = $_POST['password'];
         			//$_SESSION['userid'] = $dn[0]['id'];
         			$_SESSION['estActif'] = 1; 
         ?>
      <?php
         }
         else
         {
         	//Sinon, on indique que la combinaison nest pas bonne
         	$form = true;
         	$message = 'La combinaison que vous avez entr&eacute; n\'est pas bonne.';
         }
         }
         else
         {
         $form = true;
         }
         if($form)
         {
         //On affiche un message sil y a lieu
         if(isset($message))
         {
         echo '<div class="message">'.$message.'</div>';
         }
         //On affiche le formulaire
         ?>
      <div class="content">
         <form action="" method="post">
            Veuillez entrer vos identifiants pour vous connecter:<br />
            <div class="center">
               <label for="username">Nom d'utilisateur</label><input type="text" name="username" id="username"  /><br />
               <label for="password">Mot de passe</label><input type="password" name="password" id="password" /><br />
               <input type="submit" value="Valider" />
            </div>
         </form>
      </div>
      <?php
         }
         }
         ?>
      <a href="index.php">Retour &agrave; l'accueil</a>
   </body>
</html>


