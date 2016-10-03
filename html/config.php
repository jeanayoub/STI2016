<html>
<head></head>
<body>

<?php
 
  // Set default timezone
  date_default_timezone_set('UTC');
 
  try {
    /**************************************
    * Create databases and                *
    * open connections                    *
    **************************************/
 
    // Create (connect to) SQLite database in file
    $file_db = new PDO('sqlite:/var/www/databases/mail.sqlite');
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION); 
 
    /**************************************
    * Create tables                       *
    **************************************/
 
    // Create table messages
    $file_db->exec("CREATE TABLE IF NOT EXISTS messages (
                    id INTEGER PRIMARY KEY, 
                    dateReception TEXT, 
                    expediteur TEXT,
		    destinataire TEXT  
                    suject TEXT,
		    contenu TEXT)"); 
    $file_db->exec("CREATE TABLE IF NOT EXISTS roles (
                    id INTEGER PRIMARY KEY, 
                    name TEXT)"); 
    $file_db->exec("CREATE TABLE IF NOT EXISTS utilisateurs (           
                    nomUtilisateur TEXT PRIMARY KEY,
		    motDePasse TEXT,
		    estActif TEXT,
    	  	    role TEXT)");
    
			
 
    /**************************************
    * Close db connections                *
    **************************************/
 
    // Close file db connection
    //$file_db = null;
  }
  catch(PDOException $e) {
    // Print PDOException message
    echo $e->getMessage();
  }
?>

</body>
</html>
