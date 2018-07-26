<?php 
require_once("utils/db.php");
// NEW
function create($lieu_stage, $stage_numero, $date_debut, $date_fin, $stage_hpo){
    global $db;
    $response = $db->prepare("INSERT INTO stage(lieu_stage_id_id, stage_numero, date, stage_hpo, date_fin) VALUES(:lieu_stage, :stage_numero, :date_debut, :stage_hpo, :date_fin)");
    $response->bindParam(':lieu_stage', $lieu_stage, PDO::PARAM_INT);
    $response->bindParam(':stage_numero', $stage_numero, PDO::PARAM_STR);
    $response->bindParam(':date_debut', $date_debut, PDO::PARAM_STR);
    $response->bindParam(':stage_hpo', $stage_hpo, PDO::PARAM_BOOL);
    $response->bindParam(':date_fin', $date_fin, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
function createStage($lieu_stage_nom, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers){
    global $db;
    $response = $db->prepare("INSERT INTO lieu_stage(lieu_nom, etablissement_nom, adresse, code_postal, commune, tel, latitude, longitude, divers) VALUES(:lieu_stage_nom, :etablissement_nom, :adresse, :code_postal, :commune, :tel, :latitude, :longitude, :divers");
    $response->bindParam(':lieu_stage_nom', $lieu_stage_nom, PDO::PARAM_STR);
    $response->bindParam(':etablissement_nom', $etablissement_nom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':tel', $tel, PDO::PARAM_STR);
    $response->bindParam(':latitude', $latitude, PDO::PARAM_STR);
    $response->bindParam(':longitude', $longitude, PDO::PARAM_STR);
    $response->bindParam(':divers', $divers, PDO::PARAM_STR);
    $response->execute();
    return $response->lastInsertId();
}
function updateLieux($lieu_id, $lieu_stage, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers){
    global $db;
        $response = $db->prepare("UPDATE lieu_stage SET lieu_nom = :lieu_nom, etablissement_nom = :etablissement_nom, adresse = :adresse, code_postal = :code_postal, commune = :commune, tel = :tel, latitude = :latitude, longitude = :longitude, divers = :divers WHERE id = :id");
        $response->bindParam(':lieu_nom', $lieu_stage, PDO::PARAM_STR);
        $response->bindParam(':etablissement_nom', $etablissement_nom, PDO::PARAM_STR);
        $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
        $response->bindParam(':commune', $commune, PDO::PARAM_STR);
        $response->bindParam(':tel', $tel, PDO::PARAM_STR);
        $response->bindParam(':latitude', $latitude, PDO::PARAM_STR);
        $response->bindParam(':longitude', $longitude, PDO::PARAM_STR);
        $response->bindParam(':divers', $divers, PDO::PARAM_STR);
        $response->bindParam(':id', $lieu_id, PDO::PARAM_INT);
        var_dump($lieu_id, $lieu_stage, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers);
        $response->execute();
        return true; 
}

//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT stage.id, stage.stage_numero, lieu_stage.lieu_nom, stage_numero, date, stage_hpo, date_fin FROM `stage` INNER JOIN lieu_stage ON stage.lieu_stage_id_id = lieu_stage.id");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function listLieux($keyword){
    global $db;
    $response = $db->prepare("SELECT * FROM lieu_stage WHERE lieu_nom LIKE :keyword");
    $keyword = $keyword.'%';
    $response->bindParam(':keyword', $keyword, PDO::PARAM_STR);
   
    $response->execute();
    $response = $response->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($response);
    // foreach ($result as $rs) {
    //     // put in bold the written text
    //     $lieu_nom = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['lieu_nom']);
        
    //     // add new option
    //     echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['lieu_nom']).'\')">'.$lieu_nom.'</li>';
    // }
}




// //EDIT
// function getOne($id){
//     global $db;
//     $response = $db->prepare("SELECT animateur.id, animateur.civilite_id_id, civilite.nom, animateur.fonction_animateur_id_id, fonction_animateur.fonction_nom, animateur.statut_id_id, statut_animateur.status_nom, animateur.nom, prenom, gta, raison_sociale, adresse, code_postal, commune, region, tel_portable, tel_fixe, email, urssaf, siret, observations FROM animateur INNER JOIN civilite ON animateur.civilite_id_id = civilite.id INNER JOIN fonction_animateur ON animateur.fonction_animateur_id_id = fonction_animateur.id INNER JOIN statut_animateur ON statut_id_id = statut_animateur.id 
//     WHERE animateur.id = :id");
//     $response->bindParam(':id', $id, PDO::PARAM_INT);
//     $response->execute();
//     return $response->fetch(PDO::FETCH_ASSOC);
// }
// function edit($civilite, $nom, $prenom, $fonction, $statut, $gta, $raison_sociale, $adresse, $code_postal, $ville, $region, $tel_portable, $tel_fixe, $email, $urssaf, $siret, $observations, $id){
//     global $db;
//     $response = $db->prepare("UPDATE animateur SET civilite_id_id = :civilite, fonction_animateur_id_id = :fonction,statut_id_id = :statut, nom = :nom, prenom = :prenom, gta = :gta, raison_sociale = :raison_sociale, adresse = :adresse, code_postal = :code_postal, commune = :ville, region = :region, tel_portable = :tel_portable,tel_fixe = :tel_fixe, email = :email, urssaf = :urssaf, siret = :siret, observations = :observations WHERE animateur.id = :id");
//     $response->bindParam(':civilite', $civilite, PDO::PARAM_INT);
//     $response->bindParam(':nom', $nom, PDO::PARAM_STR);
//     $response->bindParam(':prenom', $prenom, PDO::PARAM_STR);
//     $response->bindParam(':fonction', $fonction, PDO::PARAM_INT);
//     $response->bindParam(':statut', $statut, PDO::PARAM_INT);
//     $response->bindParam(':gta', $gta, PDO::PARAM_BOOL);
//     $response->bindParam(':raison_sociale', $raison_sociale, PDO::PARAM_STR);
//     $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
//     $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
//     $response->bindParam(':ville', $ville, PDO::PARAM_STR);
//     $response->bindParam(':region', $region, PDO::PARAM_STR);
//     $response->bindParam(':tel_portable', $tel_portable, PDO::PARAM_STR);
//     $response->bindParam(':tel_fixe', $tel_fixe, PDO::PARAM_STR);
//     $response->bindParam(':email', $email, PDO::PARAM_STR);
//     $response->bindParam(':urssaf', $urssaf, PDO::PARAM_STR);
//     $response->bindParam(':siret', $siret, PDO::PARAM_STR);
//     $response->bindParam(':observations', $observations, PDO::PARAM_STR);
//     $response->bindParam(':id', $id, PDO::PARAM_INT);
//     var_dump($civilite);
//     var_dump($nom);
//     $response->execute();
//     return true; 
// }



//DELETE
function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM animateur
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
