
<?php



function delete($tables, $condition){
    global $db;
    $response = $db->prepare("DELETE FROM :tables
    WHERE id = :condition");
    $response->bindParam(':tables', $tables, PDO::PARAM_STR);
    $response->bindParam(':condition', $condition, PDO::PARAM_INT);
    $response->execute();
    return true; 
}


