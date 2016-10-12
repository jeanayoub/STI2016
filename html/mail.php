<?php
session_start();
date_default_timezone_set('Europe/Paris');

?>
<?php
include('config.php');

?>


<?php
$now = date("F j, Y, g:i a");
if (isset($_POST['envoyer'])) {
    $file_db->exec('INSERT into messages( dateReception, expediteur, destinataire, sujet, contenu) VALUES ("' . $now . '",  "' . $_SESSION['username'] . '" ,"' . $_POST['listeUtilisateur'] . '", "' . $_POST['sujet'] . '" , "' . $_POST['message'] . '")');
    
    
}
?>
<?php


if (isset($_SESSION['identifiant'])) {
    $result = $file_db->query('SELECT contenu, id , expediteur FROM messages WHERE id = "' . $_SESSION['identifiant'] . '"');
    foreach ($result as $row) {
        echo "le message reçu de la part de ";
        echo $row['expediteur'];
        echo "<br>";
        echo $row['contenu'];
    }
    echo "<br><br><br>";
}

?>



<!DOCTYPE html>
<?php
if ($_SESSION['estActif'] == 0) {
    
    header('Location: logout.php');
}

?>
<html>
   <head>
      <meta charset="utf-8" />
      <title>Page mail</title>
   </head>
   <body>
      
    </p>
    
    <h3> Message </h3>
    <form action="mail.php" method="POST">
    <p>sujet : <input type="text" name="sujet" /></p>
    <textarea name="message" rows="8" cols="45"> Ecrivez votre message!
    </textarea>
    <br />
         <select name="listeUtilisateur">
            
               <?php
if (isset($_SESSION['identifiant'])) {
    $result = $file_db->query('SELECT expediteur FROM messages WHERE id = "' . $_SESSION['identifiant'] . '"');
    foreach ($result as $row) {
?>
           <option value = "<?php
        echo $row['expediteur'];
?>" ><?php
        echo $row['expediteur'];
?> </option>
            
        
        
        <?php
        
        
    }
    $key = array_search($_GET['identifiant'], $_SESSION['identifiant']);
    if ($key != false)
        unset($_SESSION['identifiant'][$key]);
    $_SESSION["identifiant"] = array_values($_SESSION["identifiant"]);
} else {
    
    $result = $file_db->query('SELECT nomUtilisateur FROM utilisateurs');
    foreach ($result as $row) {
?>
                       <option value = "<?php
        echo $row['nomUtilisateur'];
?>"  > <?php
        echo $row['nomUtilisateur'];
?> </option>
    
            <?php
    }
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
if (isset($_POST['logOff'])) {
    $file_db->exec('UPDATE utilisateurs SET estActif =' . ' "inactif" ' . ' WHERE  nomUtilisateur = "' . $_SESSION['username'] . '" ');
    header("Location: ./connexion.php");
}

?>
   

   </body>
   <a href="edit_infos.php"> Modifier votre mot de passe</a>
</html>
