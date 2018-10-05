<?php
// require_once("utils/db.php");

function edit($tables, $nomColonne, $nouvelleValeur, $condition){
    global $db;
    $response = $db->prepare("UPDATE :tables
    SET :nomColonne = :nouvelleValeur
    WHERE id = :condition");
    $response->bindParam(':tables', $tables, PDO::PARAM_STR);
    $response->bindParam(':nomColonne', $nomColonne, PDO::PARAM_STR);
    $response->bindParam(':nouvelleValeur', $nouvelleValeur, PDO::PARAM_STR);
    $response->bindParam(':condition', $condition, PDO::PARAM_INT);
    $response->execute();
    return true; 
}