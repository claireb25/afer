<?php
require("utils/security.php");
require_once "models/tribunal.php";
if (isset($_GET['action'])){ 
    $action= $_GET['action'];

    require 'vendor/autoload.php';
    $loader = new Twig_Loader_Filesystem('views');
    $twig = new Twig_Environment($loader, array(
        'cache'=> false
    ));
    switch ($action) {
        case 'list':
            makeList();            
            break;

        case 'new':
        if ( count( $_POST )  > 0 ){
            $tribunal_nom = '';
            $adresse = '';
            $code_postal = '';
            $commune = '';
            $service_tribunal = '';
            $autorite_tribunal = '';

            if( isset( $_POST['tribunal_nom'] ) ){
                if( !empty( $_POST['tribunal_nom'] ) ){
                    $tribunal_nom =  trim( $_POST['tribunal_nom']  );
                }
            }

            if( isset( $_POST['adresse'] ) ){
                if( !empty( $_POST['adresse'] ) ){
                    $adresse =  trim( $_POST['adresse']  );
                }
            }


            if( isset( $_POST['code_postal'] ) ){
                if( !empty( $_POST['code_postal'] ) ){
                    $code_postal =  trim( $_POST['code_postal']  );
                }
            }

            if( isset( $_POST['commune'] ) ){
                if( !empty( $_POST['commune'] ) ){
                    $commune =  trim( $_POST['commune']  );
                }
            }

            if( isset( $_POST['autorite_tribunal'] ) ){
                if( !empty( $_POST['autorite_tribunal'] ) ){
                    $autorite_tribunal =  trim( $_POST['autorite_tribunal']  );
                    $autorite_tribunal = (int) $autorite_tribunal;
                }
            }

            if( isset( $_POST['service_tribunal'] ) ){
                if( !empty( $_POST['service_tribunal'] ) ){
                    $service_tribunal =  trim( $_POST['service_tribunal']  );
                    $service_tribunal = (int) $service_tribunal;
                }
            }


           

            if( $autorite_tribunal == "" ){
                $autorite_tribunal = null;
            }

            if( $service_tribunal == "" ){
                $service_tribunal = null;
            }


           
            
            
            
            $reponse = (int) getCountTribunal( $tribunal_nom,  $adresse, $code_postal, $commune, $autorite_tribunal, $service_tribunal);
            
            
            if( $reponse === 0 ){                   
                addNew( $tribunal_nom, $autorite_tribunal, $service_tribunal, $adresse, $code_postal, $commune    );
            }else{
                showExist( $tribunal_nom,  $adresse, $code_postal, $commune, $autorite_tribunal, $service_tribunal );
            }
            
        } else {
            showNew();
        }
        break; 

        case 'edit':
            if (count($_POST) > 0){
                $id = (int) $_GET['id'];
                $tribunal_nom = '';
                $adresse = '';
                $code_postal = '';
                $commune = '';
                $service_tribunal = '';
                $autorite_tribunal = '';

                if( isset( $_POST['tribunal_nom'] ) ){
                    if( !empty( $_POST['tribunal_nom'] ) ){
                        $tribunal_nom =trim( $_POST['tribunal_nom']  );
                    }
                }

                if( isset( $_POST['adresse'] ) ){
                    if( !empty( $_POST['adresse'] ) ){
                        $adresse = trim( $_POST['adresse']  );
                    }
                }


                if( isset( $_POST['code_postal'] ) ){
                    if( !empty( $_POST['code_postal'] ) ){
                        $code_postal =  trim( $_POST['code_postal']  );
                    }
                }

                if( isset( $_POST['commune'] ) ){
                    if( !empty( $_POST['commune'] ) ){
                        $commune =  trim( $_POST['commune']  );
                    }
                }

                if( isset( $_POST['autorite_tribunal'] ) ){
                    if( !empty( $_POST['autorite_tribunal'] ) ){
                        $autorite_tribunal =  trim( $_POST['autorite_tribunal']  );
                        $autorite_tribunal = (int) $autorite_tribunal;
                    }
                }

                if( isset( $_POST['service_tribunal'] ) ){
                    if( !empty( $_POST['service_tribunal'] ) ){
                        $service_tribunal =  trim( $_POST['service_tribunal']  );
                        $service_tribunal = (int) $service_tribunal;
                    }
                }

               

                if( $autorite_tribunal == "" ){
                    $autorite_tribunal = null;
                }

                if( $service_tribunal == "" ){
                    $service_tribunal = null;
                }


                

                $reponse = (int) getCountTribunalEdit( $tribunal_nom,  $adresse, $code_postal, $commune, $autorite_tribunal, $service_tribunal, $id );
                if( $reponse === 0 ){   
                    update( $tribunal_nom,   $autorite_tribunal, $service_tribunal, $adresse, $code_postal, $commune, $id  );
                    redirectTribunalList();
                }else{
                    showExistEdit( $tribunal_nom,   $autorite_tribunal, $service_tribunal, $adresse, $code_postal, $commune, $id );
                }
            }else{
                showEdit($_GET['id']);
            }
            
            break;
        
        case 'view':
            if( isset( $_GET['id'] ) ){
                showView( $_GET['id'] );
            }
            break;

        case 'delete':
            deleteElement($_GET['id']);
            break;
    }
}
// LIST
function makeList(){
    $list = listAll();
    global $twig;
    $template = $twig->load('indexTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'list'=>$list));

}

function showView( $id ){  
    $id = (int) $id;  
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('viewTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'toEdit'=>$toEdit ) );
}

// NEW
function addNew($tribunal_nom,  $autorite_tribunal, $service_tribunal, $adresse, $code_postal, $commune){ //adds a new tribunal
    $nom = $tribunal_nom;
    $autorite = $autorite_tribunal;
    $service = $service_tribunal;
    $adr = $adresse;
    $cp = $code_postal;
    $ville = $commune;
    create($nom,  $autorite, $service, $adr, $cp, $ville);
    redirectTribunalList();
}
function showNew(){
    $autorite = autorite();
    $service = service();
    global $twig;
    $template = $twig->load('newTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'autorite'=>$autorite, 'service'=>$service));
}

function showExist( $tribunal_nom,  $adresse, $code_postal, $commune, $autorite_tribunal, $service_tribunal ){
    global $twig;
    $autorite = autorite();
    $service = service();
    $template = $twig->load('newTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'tribunal_nom' => $tribunal_nom, 'adresse' => $adresse, "code_postal" => $code_postal, "commune" => $commune, "autorite" => $autorite, "service_tribunal" => $service_tribunal, "autorite_tribunal" => $autorite_tribunal,  "service" => $service ) );
}


function showExistEdit( $prefecture_nom, $autorite_prefecture, $service_prefecture, $adresse, $code_postal, $commune, $id ){
    global $twig;
    $autorite = autorite();
    $service = service();
    $template = $twig->load('editPrefecture.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ), 'error' => 'exist', 'toEdit' => array( 'prefecture_nom' => $prefecture_nom, 'adresse' => $adresse, "code_postal" => $code_postal, "commune" => $commune,  "service_nom" => $service_prefecture, "autorite_nom" => $autorite_prefecture, 'id' => $id),  "autorite" => $autorite, "service" => $service ) );
}

//EDIT 
function showEdit($id){
    $autorite = autorite();
    $service = service();
    $toEdit = getOne($id);
    global $twig;
    $template = $twig->load('editTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] ),'toEdit'=>$toEdit, 'autorite'=>$autorite, 'service'=>$service));
}
function update($tribunal_nom,  $autorite_tribunal, $service_tribunal, $adresse, $code_postal, $commune, $id){
    $nom = $tribunal_nom;
    $autorite = $autorite_tribunal;
    $service = $service_tribunal;
    $adr = $adresse;
    $cp = $code_postal;
    $ville = $commune;
    $id = $id;
    edit($nom,  $autorite, $service, $adr, $cp, $ville, $id);
   
}

function showDeleteError( $id ){
    global $twig;
    $template = $twig->load('deleteTribunal.html.twig');
    echo $template->render(array("user" => array( 'id' => $_SESSION['user']["id"], 'identifiant' => $_SESSION['user']["identifiant"],  'prenom' => $_SESSION['user']["prenom"] , 'nom' => $_SESSION['user']["nom"], 'fullName' => $_SESSION['user']["prenom"].' '.$_SESSION['user']["nom"] )));
}

//DELETE
function deleteElement($id){
    $id = (int)$id;
    $countInfraction = nombreRelationTribunalInfraction( $id );
    $countStage = nombreRelationTribunalStage( $id );
    if( $countInfraction == 0 && $countStage == 0 ){
        delete($id);
        header('Location: /tribunal/list');
    }else{
        showDeleteError( $id );
    }    
}

// REDIRECTIONS

function redirectTribunalList(){
    header('Location: /tribunal/list');
}