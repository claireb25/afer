
<?php
$user = 'admin';
$pass= 'online@2017';
try {
    $db = new PDO('mysql:host=localhost;dbname=afer', $user, $pass);
   
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

