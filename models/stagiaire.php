<?php 
require_once("utils/db.php");

// NEW
function create($civilite, $nom, $nomNaissance, $prenom, $dateNaissance, $lieuNaissance, $adresse, $codePostal, $commune, $pays, $telPortable, $telFixe, $email, $carteAvantagesJeunes, $partenaires, $adherents){
    global $db;
    $response = $db->prepare("INSERT INTO stagiaire(civilite_id_id, nom, nom_naissance, prenom, date_naissance, lieu_naissance, adresse, code_postal, commune, pays, tel_portable, tel_fixe, email, carte_avantages_jeunes, partenaires, adherents) VALUES(:civilite_id_id, :nom, :nom_naissance, :prenom, :date_naissance, :lieu_naissance, :adresse, :code_postal, :commune, :pays, :tel_portable, :tel_fixe, :email, :carte_avantages_jeunes, :partenaires, :adherents)");
    $response->bindParam(':civilite_id_id', $civilite, PDO::PARAM_INT);
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    $response->bindParam(':nom_naissance', $nomNaissance, PDO::PARAM_STR);
    $response->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $response->bindParam(':date_naissance', $dateNaissance, PDO::PARAM_STR);
    $response->bindParam(':lieu_naissance', $lieuNaissance, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $codePostal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':pays', $pays, PDO::PARAM_STR);
    $response->bindParam(':tel_portable', $telPortable, PDO::PARAM_STR);
    $response->bindParam(':tel_fixe', $telFixe, PDO::PARAM_STR);
    $response->bindParam(':email', $email, PDO::PARAM_STR);
    $response->bindParam(':carte_avantages_jeunes', $carteAvantagesJeunes, PDO::PARAM_BOOL);
    $response->bindParam(':partenaires', $partenaires, PDO::PARAM_BOOL);
    $response->bindParam(':adherents', $adherents, PDO::PARAM_STR);
    $response->execute();
    return true; 
}



// Function called with Ajax to find a stagiaire from a keyword in the input
function listStagiaire($keyword){
    global $db;
    $response = $db->prepare("SELECT * FROM stagiaire WHERE nom LIKE :keyword");
    $keyword = $keyword.'%';
    $response->bindParam(':keyword', $keyword, PDO::PARAM_STR);
    $response->execute();
    $response = $response->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($response);
}


//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT stagiaire.id, stagiaire.civilite_id_id, stagiaire.nom, stagiaire.prenom, stagiaire.commune, stagiaire.code_postal, stagiaire.tel_portable, stagiaire.tel_fixe, stagiaire.email, stagiaire.carte_avantages_jeunes, stagiaire.partenaires, stagiaire.adherents, civilite.nom AS civilite_nom FROM `stagiaire` 
    INNER JOIN civilite ON stagiaire.civilite_id_id = civilite.id");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function stagiaire(){
    global $db;
    $response = $db->prepare("SELECT * FROM stagiaire");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function stagiaireByID($stagiaireID){
    global $db;
    $response = $db->prepare("SELECT * FROM stagiaire WHERE id = :id");
    $response->bindParam(':id', $stagiaireID, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function civilite(){
    global $db;
    $response = $db->prepare("SELECT * FROM civilite");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function civilitelByID($civiliteID){
    global $db;
    $response = $db->prepare("SELECT * FROM civilite WHERE id = :id");
    $response->bindParam(':id', $civiliteID, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}



//EDIT
function editStagiaire($civilite, $nom, $nomNaissance, $prenom, $dateNaissance, $lieuNaissance, $adresse, $codePostal, $commune, $pays, $telPortable, $telFixe, $email, $carteAvantagesJeunes, $partenaires, $adherents, $id){
    global $db;
    $response = $db->prepare("UPDATE stagiaire SET 
        civilite_id_id = :civilite, 
        nom = :nom, 
        nom_naissance = :nomNaissance, 
        prenom = :prenom, 
        date_naissance = :dateNaissance,  
        lieu_naissance = :lieuNaissance, 
        adresse = :adresse, 
        code_postal = :codePostal, 
        commune = :commune, 
        pays = :pays, 
        tel_portable = :telPortable, 
        tel_fixe = :telFixe, 
        email = :email,  
        carte_avantages_jeunes = :carteAvantagesJeunes, 
        partenaires = :partenaires, 
        adherents = :adherents 
        WHERE id = :id");
    $response->bindParam(':civilite', $civilite, PDO::PARAM_INT);
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    $response->bindParam(':nomNaissance', $nomNaissance, PDO::PARAM_STR);
    $response->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $response->bindParam(':dateNaissance', $dateNaissance, PDO::PARAM_STR);
    $response->bindParam(':lieuNaissance', $lieuNaissance, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':codePostal', $codePostal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':pays', $pays, PDO::PARAM_STR);
    $response->bindParam(':telPortable', $telPortable, PDO::PARAM_STR);
    $response->bindParam(':telFixe', $telFixe, PDO::PARAM_STR);
    $response->bindParam(':email', $email, PDO::PARAM_STR);
    $response->bindParam(':carteAvantagesJeunes', $carteAvantagesJeunes, PDO::PARAM_BOOL);
    $response->bindParam(':partenaires', $partenaires, PDO::PARAM_BOOL);
    $response->bindParam(':adherents', $adherents, PDO::PARAM_BOOL);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE
function deleteStagiaire($id){
    global $db;
    $response = $db->prepare("DELETE FROM stagiaire 
    WHERE stagiaire.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

