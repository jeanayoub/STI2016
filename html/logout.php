<?php 
session_start();
session_unset();
session_destroy();

unset($_session['estActif']);
header('Location: connexion.php');
?>

