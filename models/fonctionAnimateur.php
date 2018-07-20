<?php

require("utils/db.php");

function listAll($tables){
    global $db;
    $response = $db->prepare("SELECT * FROM :tables");
    $response->bindParam(':tables', $tables);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}


function create($insertInto, $val){
    global $db;
    $response = $db->prepare("INSERT INTO :insertInto VALUES(:val)");
    $response->bindParam(':insertInto', $insertInto);
    $response->bindParam(':val', $val);
    $response->execute();
    return true; 
}