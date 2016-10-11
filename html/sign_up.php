

<?php
   include('config.php');
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Inscription</title>
   </head>
   <body>
      <br /> Inscription <br />
      <?php
         //On verifie que le formulaire a ete enregistre
         if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['role']) and $_POST['username']!='')
         {
         
         	//On enleve le backslashe si get_magic_quotes_gpc(analyse syntaxique) est active
         	if(get_magic_quotes_gpc())
         	{	
         		// La fonction stripslashes enlève le backslashe
         		$_POST['username'] = stripslashes($_POST['username']);
         		$_POST['password'] = stripslashes($_POST['password']);
         		$_POST['passverif'] = stripslashes($_POST['passverif']);
         		
         	}
         	//On verifie si le mot de passe et celui de la verification sont identiques
         	if($_POST['password']==$_POST['passverif'])
         	{
         
         		//On verifie si le mot de passe a 5 caracteres ou plus
         		if(strlen($_POST['password'])>=5)
         		{
         
         			
         				$username = $_POST['username'];
         				$password = $_POST['password'];
         
         				//On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
         				$res = $file_db->query('select nomUtilisateur from utilisateurs where nomUtilisateur="'.$username.'"');
         
         				//$dn = $res->rowCount();
         				$res2 = $res->fetchAll();
         					$dn = count($res2);
         				
         
         				if($dn==0)
         				{
         
         					
         					try {
         						//On enregistre les informations dans la base de donnee
         						if($file_db->exec('insert into utilisateurs( nomUtilisateur, motDePasse, estActif, role) values ("'.$username.'", "'.$password.'", "inactif" , "'.$_POST['role'] .'" )'))
         						{
         							//Si ca a fonctionne, on naffiche pas le formulaire
         							$form = false;
         ?>
      <div class="message">Inscription effectu&eacutee;. Vous pouvez vous connecter.<br />
         <a href="connexion.php">Se connecter</a>
      </div>
      <?php
         }
         else
         {
         	//Sinon on dit quil y a eu une erreur
         	$form = true;
         	$message = 'Une erreur est survenue lors de l\'inscription.';
         }
         }
         catch(PDOException $e) {
         // Print PDOException message
         echo $e->getMessage();
         }
         }
         else
         {
         //Sinon, on dit que le pseudo voulu est deja pris
         $form = true;
         $message = 'Un autre utilisateur utilise d&eacute;j&agrave; le nom d\'utilisateur que vous d&eacute;sirez utiliser.';
         }
         
         
         }
         else
         {
         //Sinon, on dit que le mot de passe nest pas assez long
         $form = true;
         $message = 'Le mot de passe que vous avez entr&eacute; contien moins de 6 caract&egrave;res.';
         }
         }
         else
         {
         //Sinon, on dit que les mots de passes ne sont pas identiques
         $form = true;
         $message = 'Les mots de passe que vous avez entr&eacute; ne sont pas identiques.';
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
         <form action="sign_up.php" method="post">
            <br />Veuillez remplir ce formulaire pour vous inscrire:<br />
            <div class="center">
               <label for="username">Nom d'utilisateur</label><input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
               <label for="password">Mot de passe<span class="small">(6 caract&egrave;res min.)</span></label><input type="password" name="password" /><br />
               <label for="passverif">Mot de passe<span class="small">(v&eacute;rification)</span></label><input type="password" name="passverif" /><br />

	
	 rôle de l'utilisateur : 
         <select name="role">
            <option value = "collaborateur"> collaborateur </option>
            <option value = "administrateur"> administrateur </option>
         </select>
		<br />
	
		


               <input type="submit" value="Enregister" />
            </div>
         </form>
      </div>
      <?php


	
         }
         ?>
      <a href="admin.php">Retour &agrave; la page d'admin</a>
      <a href="index.php">Retour &agrave; l'accueil</a>
   </body>
</html>


