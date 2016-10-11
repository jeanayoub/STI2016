<?php

session_start(); // On démarre la session AVANT toute chose

?>

<?php
include('config.php');
?>

<html>
    <head>
        <title>Modifier le mot de passe</title>
    </head>
    <body>
    	
<?php
//On verifie si lutilisateur est connecte
if($_SESSION['estActif'] == 1)
{
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['password'], $_POST['passverif']))
	{
		//On enleve lechappement si get_magic_quotes_gpc est active
		if(get_magic_quotes_gpc())
		{
			
			$_POST['password'] = stripslashes($_POST['password']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
			
		}
		//On verifie si le mot de passe et celui de la verification sont identiques
		if($_POST['password']==$_POST['passverif'])
		{
			//On verifie si le mot de passe a 5 caracteres ou plus
			if(strlen($_POST['password'])>=5)
			{

						$req = $file_db->query('select nomUtilisateur from utilisateurs where nomUtilisateur="'.$_SESSION['username'].'"');
		$dn = $req->fetchAll();
						if($file_db->exec('UPDATE utilisateurs SET motDePasse = "'.$_POST['password'].'" WHERE  nomUtilisateur = "'.$_SESSION['username'].'" '))
						{
							//Si ca a fonctionne, on naffiche pas le formulaire
							$form = false;
							
?>
<div class="message">Vos informations ont bien &eacute;t&eacute; modifi&eacute;e. Vous devez vous reconnecter.<br />
<a href="connexion.php">Se connecter</a></div>
<?php
						}
						else
						{
							//Sinon on dit quil y a eu une erreur
							$form = true;
							$message = 'Une erreur est survenue lors des modifications.';
						}

			}
			else
			{
				//Sinon, on dit que le mot de passe nest pas assez long
				$form = true;
				$message = 'Le mot de passe doit contenir au moins 5 caract&egrave;res.';
			}
		}
		else
		{
			//Sinon, on dit que les mots de passes ne sont pas identiques
			$form = true;
			$message = 'Les mot de passe que vous avez entr&eacute; ne sont pas identiques.';
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
			echo '<strong>'.$message.'</strong>';
		}
		//Si le formulaire a deja ete envoye on recupere les donnes que lutilisateur avait deja insere
		if(isset($_POST['username'],$_POST['password']))
		{
			$username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
			if($_POST['password']==$_POST['passverif'])
			{
				$password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
			}
			else
			{
				$password = '';
			}
			
		}
		//On affiche le formulaire
?>
<div class="content">
    <form action="edit_infos.php" method="post">
        Vous pouvez changer votre mote de passe:<br />
        <div class="center">
            
            <label for="password">Mot de passe<span class="small">(5 caract&egrave;res min.)</span></label><input type="password" name="password" id="password"  /><br />
            <label for="passverif">Mot de passe<span class="small">(v&eacute;rification)</span></label><input type="password" name="passverif" id="passverif"  /><br />
            
            <input type="submit" value="Modifier" />

        </div>
    </form>
</div>
<?php
	}
}
else
{
?>
<div class="message">Pour acc&eacute;der &agrave; cette page, vous devez &ecirc;tre connect&eacute;.<br />
<a href="connexion.php">Se connecter</a></div>
<?php
}
?>
		<a href="collaborateur.php">Retour sur votre page initiale</a>
	</body>
</html>
