//cette fontion est appelée après chargement de la page

function main(){

    //elle va vérifier si les élément son présent dans la,page
    //si c'est le cas elle va appeler la bonne fonction en conséquence
  if( document.querySelector('.modal-btn-ok') !== null ){      
      closeModal();
  }

  if( document.querySelector('.modal-btn-no') !== null ){
    closeModal();
  } 
  
  if( document.querySelector('.btn-add-autorite') !== null ){
    addAutorite();
  }

  if( document.querySelector('.btn-add-service') !== null ){
    addService();
  }

  if( document.querySelector('.btn-add-civilite') !== null ){
    addCivilite();
  }  

  if( document.querySelector('.btn-add-autorite-tribunal') !== null ){
    addAutoriteTribunal();
  }

  if( document.querySelector('.btn-add-service-tribunal') !== null ){
    addServiceTribunal();
  }


  if( document.querySelector('.btn-add-fonction') !== null ){
    addFonctionAnimateur();
  }


  if( document.querySelector('.btn-add-statut') !== null ){
    addStatutAnimateur();
  }



  if( document.querySelector('.form-user-create') !== null ){
    userForm( 'create');
  }

  if( document.querySelector('.form-user-edit') !== null ){
    userForm( 'edit');
  }

  if( document.querySelector('.form-servicePrefecture-create') !== null ){
    servicePrefectureForm( 'create');
  }

  if( document.querySelector('.form-servicePrefecture-edit') !== null ){
    servicePrefectureForm( 'edit');
  }

  if( document.querySelector('.form-autoritePrefecture-create') !== null ){
    autoritePrefectureForm( 'create');
  }

  if( document.querySelector('.form-autoritePrefecture-edit') !== null ){
    autoritePrefectureForm( 'edit');
  }

  

  if( document.querySelector('.form-autoriteTribunal-create') !== null ){
    autoriteTribunalForm( 'create');
  }

  if( document.querySelector('.form-autoriteTribunal-edit') !== null ){
    autoriteTribunalForm( 'edit');
  }


  if( document.querySelector('.form-serviceTribunal-create') !== null ){
    serviceTribunalForm( 'create');
  }

  if( document.querySelector('.form-serviceTribunal-edit') !== null ){
    serviceTribunalForm( 'edit');
  }


  

  if( document.querySelector('.form-fonctionAnimateur-create') !== null ){
    fonctionAnimateurForm( 'create');
  }

  if( document.querySelector('.form-fonctionAnimateur-edit') !== null ){
    fonctionAnimateurForm( 'edit');
  }

  if( document.querySelector('.form-statutAnimateur-create') !== null ){
    statutAnimateurForm( 'create');
  }

  if( document.querySelector('.form-statutAnimateur-edit') !== null ){
    statutAnimateurForm( 'edit');
  }

  if( document.querySelector('.form-prefecture-create') !== null ){
    prefectureForm( 'create');
  }

  if( document.querySelector('.form-prefecture-edit') !== null ){
    prefectureForm( 'edit');
  }

  if( document.querySelector('.form-tribunal-create') !== null ){
    tribunalForm( 'create');
  }

  if( document.querySelector('.form-tribunal-edit') !== null ){
    tribunalForm( 'edit');
  }

  if( document.querySelector('.form-civilite-create') !== null ){
    civiliteForm( 'create');
  }

  if( document.querySelector('.form-civilite-edit') !== null ){
    civiliteForm( 'edit');
  }

  

  if( document.querySelector('.form-animateur-create') !== null ){
    animateurForm( 'create');
  }

  if( document.querySelector('.form-animateur-edit') !== null ){
    animateurForm( 'edit');
  }




  
  if( document.querySelector('.tbl-link-delete') !== null ){
      msgDelete();
  }

   if( document.querySelector('.modal-btn-change-pwd') !== null ){
      showPassword();
  }

  if( document.querySelector('.firstLetterUpper') !== null ){
      firstLetterMaj();
  }

  if( document.querySelector('.shift') !== null ){
    allLetterMaj();
  }

  if( document.querySelector('.noshift') !== null ){
    noLetterMaj();
  }

  if( document.querySelector('.autocomplete') !== null ){
    autocomplete();
  }


}

//fonction qui permet d'affécter l'événement
//click au bouton ok pour pour fermer la modal
function closeModal(){
    const overlay = document.querySelector('.boxOverlay');
    if( document.querySelector('.modal-btn-ok') !== null ){
        document.querySelector('.modal-btn-ok').addEventListener('click', () => {
            overlay.classList.add('hidden');
        });
    }else if(document.querySelector('.modal-btn-no') !== null ){
        document.querySelector('.modal-btn-no').addEventListener('click', () => {
            overlay.classList.add('hidden');
        });
    }else{
        overlay.classList.add('hidden');
    }
    
    
    
}

//cette fonction est appelé si le formulaire
//form-user est chargé et affect l'événement onsubmit
//ce formulaire existe pour l'action edit ou new
function userForm( action ){
    formUser = document.querySelector( '.form-user' );
    formUser.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#identifiant').value.trim().length === 0 ){
            document.querySelector('#msg-identifiant').classList.remove( 'hidden');
            document.querySelector('#msg-identifiant').innerHTML = "Veuillez saisir le champ identifiant";
            test = false;
        }else{
            document.querySelector('#msg-identifiant').classList.add( 'hidden');
            document.querySelector('#msg-identifiant').innerHTML = "";
        }

        if( action === 'create'){
            if( document.querySelector('#mdp').value.trim().length === 0 ){
                document.querySelector('#msg-mdp').classList.remove( 'hidden');
                document.querySelector('#msg-mdp').innerHTML = "Veuillez saisir le champ mot de passe";
                test = false;
            }else{
                document.querySelector('#msg-mdp').classList.add( 'hidden');
                document.querySelector('#msg-mdp').innerHTML = "";
            }
        }
        

        if( document.querySelector('#prenom').value.trim().length === 0 ){
            document.querySelector('#msg-prenom').classList.remove( 'hidden');
            document.querySelector('#msg-prenom').innerHTML = "Veuillez saisir le champ prenom";
            test = false;
        }else{
            document.querySelector('#msg-prenom').classList.add( 'hidden');
            document.querySelector('#msg-prenom').innerHTML = "";
        }

        if( document.querySelector('#nom').value.trim().length === 0 ){
            document.querySelector('#msg-nom').classList.remove( 'hidden');
            document.querySelector('#msg-nom').innerHTML = "Veuillez saisir le champ nom";
            test = false;
        }else{
            document.querySelector('#msg-nom').classList.add( 'hidden');
            document.querySelector('#msg-nom').innerHTML = "";
        }

        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){
            formUser.submit();
          }else{
            html = '<div class="boxOverlay" >';
            html += '<div class="modal fas fa-exclamation-triangle">';
            html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
            html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
            html += '</div>';
            html += '</div>';
            document.querySelector('#alertUser').innerHTML =   html;
        }
    });
}


function servicePrefectureForm( action ){
    formService = document.querySelector( '.form-service' );
    formService.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#service_nom').value.trim().length === 0 ){
            document.querySelector('#msg-service_nom').classList.remove( 'hidden');
            document.querySelector('#msg-service_nom').innerHTML = "Veuillez saisir le champ service";
            test = false;
        }else{
            document.querySelector('#msg-service_nom').classList.add( 'hidden');
            document.querySelector('#msg-service_nom').innerHTML = "";
        }

       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){
            formService.submit();
          }else{
            html = '<div class="boxOverlay" >';
            html += '<div class="modal fas fa-exclamation-triangle">';
            html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
            html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
            html += '</div>';
            html += '</div>';
            document.querySelector('#alertUser').innerHTML =   html;
        }
    });
}


function autoritePrefectureForm( action ){
    formService = document.querySelector( '.form-autorite' );
    formService.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#autorite_nom').value.trim().length === 0 ){
            document.querySelector('#msg-autorite_nom').classList.remove( 'hidden');
            document.querySelector('#msg-autorite_nom').innerHTML = "Veuillez saisir le champ autorité";
            test = false;
        }else{
            document.querySelector('#msg-autorite_nom').classList.add( 'hidden');
            document.querySelector('#msg-autorite_nom').innerHTML = "";
        }

       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){
            formService.submit();
          }else{
            html = '<div class="boxOverlay" >';
            html += '<div class="modal fas fa-exclamation-triangle">';
            html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
            html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
            html += '</div>';
            html += '</div>';
            document.querySelector('#alertUser').innerHTML =   html;
        }
    });
}


function autoriteTribunalForm( action ){
    formService = document.querySelector( '.form-autorite' );
    formService.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#autorite_nom').value.trim().length === 0 ){
            document.querySelector('#msg-autorite_nom').classList.remove( 'hidden');
            document.querySelector('#msg-autorite_nom').innerHTML = "Veuillez saisir le champ autorité";
            test = false;
        }else{
            document.querySelector('#msg-autorite_nom').classList.add( 'hidden');
            document.querySelector('#msg-autorite_nom').innerHTML = "";
        }

       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){
            formService.submit();
          }else{
            html = '<div class="boxOverlay" >';
            html += '<div class="modal fas fa-exclamation-triangle">';
            html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
            html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
            html += '</div>';
            html += '</div>';
            document.querySelector('#alertUser').innerHTML =   html;
        }
    });
}



function serviceTribunalForm( action ){
    formService = document.querySelector( '.form-service' );
    formService.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#service_nom').value.trim().length === 0 ){
            document.querySelector('#msg-service_nom').classList.remove( 'hidden');
            document.querySelector('#msg-service_nom').innerHTML = "Veuillez saisir le champ service";
            test = false;
        }else{
            document.querySelector('#msg-service_nom').classList.add( 'hidden');
            document.querySelector('#msg-service_nom').innerHTML = "";
        }

       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){
            formService.submit();
          }else{
            html = '<div class="boxOverlay" >';
            html += '<div class="modal fas fa-exclamation-triangle">';
            html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
            html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
            html += '</div>';
            html += '</div>';
            document.querySelector('#alertUser').innerHTML =   html;
        }
    });
}




function fonctionAnimateurForm( action ){
    formFonction = document.querySelector( '.form-fonction' );
    formFonction.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#fonction_nom').value.trim().length === 0 ){
            document.querySelector('#msg-fonction_nom').classList.remove( 'hidden');
            document.querySelector('#msg-fonction_nom').innerHTML = "Veuillez saisir le champ fonction";
            test = false;
        }else{
            document.querySelector('#msg-fonction_nom').classList.add( 'hidden');
            document.querySelector('#msg-fonction_nom').innerHTML = "";
        }

       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){
            formFonction.submit();
          }else{
            html = '<div class="boxOverlay" >';
            html += '<div class="modal fas fa-exclamation-triangle">';
            html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
            html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
            html += '</div>';
            html += '</div>';
            document.querySelector('#alertUser').innerHTML =   html;
        }
    });
}


function statutAnimateurForm( action ){
    formStatut = document.querySelector( '.form-statut' );
    formStatut.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#statut_nom').value.trim().length === 0 ){
            document.querySelector('#msg-statut_nom').classList.remove( 'hidden');
            document.querySelector('#msg-statut_nom').innerHTML = "Veuillez saisir le champ statut";
            test = false;
        }else{
            document.querySelector('#msg-statut_nom').classList.add( 'hidden');
            document.querySelector('#msg-statut_nom').innerHTML = "";
        }

       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){
            formStatut.submit();
          }else{
            html = '<div class="boxOverlay" >';
            html += '<div class="modal fas fa-exclamation-triangle">';
            html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
            html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
            html += '</div>';
            html += '</div>';
            document.querySelector('#alertUser').innerHTML =   html;
        }
    });
}



function prefectureForm( action ){
    formPrefecture = document.querySelector( '.form-prefecture' );
    formPrefecture.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#prefecture_nom').value.trim().length === 0 ){
            document.querySelector('#msg-prefecture_nom').classList.remove( 'hidden');
            document.querySelector('#msg-prefecture_nom').innerHTML = "Veuillez saisir le champ préfecture";
            test = false;
        }else{
            document.querySelector('#msg-prefecture_nom').classList.add( 'hidden');
            document.querySelector('#msg-prefecture_nom').innerHTML = "";
        }

        let code_postal = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;
        if( document.querySelector('#code_postal').value.trim().length === 0 || code_postal.test( document.querySelector('#code_postal').value.trim() ) === false ){
            document.querySelector('#msg-code_postal').classList.remove( 'hidden');
            document.querySelector('#msg-code_postal').innerHTML = "Veuillez saisir le champ code postal";
            test = false;
        }else{
            document.querySelector('#msg-code_postal').classList.add( 'hidden');
            document.querySelector('#msg-code_postal').innerHTML = "";
        }

        
        if( document.querySelector('#commune').value.trim().length === 0 ){
            document.querySelector('#msg-commune').classList.remove( 'hidden');
            document.querySelector('#msg-commune').innerHTML = "Veuillez saisir le champ commune";
            test = false;
        }else{
            document.querySelector('#msg-commune').classList.add( 'hidden');
            document.querySelector('#msg-commune').innerHTML = "";
        }


       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){            
            if( document.querySelector('#autorite_prefecture').value !== 'autorite_prefecture' && document.querySelector('#service_prefecture').value !== 'service_prefecture'){
               formPrefecture.submit();
            }else{
                html ='<div class="boxOverlay  ">';
                html += '<div class="modal modal-yesNo fas fa-exclamation-triangle">';
                html += '<p class="modal-message">Êtes-vous sûre de vouloir continuer sans définir une autorité et/ou un service ?</p>';
                html += '<button type="button" data-link="prefecture/new" onclick="document.querySelector( \'.form-prefecture\' ).submit();" class="modal-btn form-login-button modal-btn--inline modal-btn-yes">Oui</button>  ';
                html += '<button type="button" onclick="closeModal()" class="modal-btn form-login-button modal-btn--inline modal-btn-no"> Non</button>';
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html;  
            }        
            
        }else{
           
                html = '<div class="boxOverlay" >';
                html += '<div class="modal fas fa-exclamation-triangle">';
                html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
                html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html;            
        }
    });
}



function tribunalForm( action ){
    formTribunal = document.querySelector( '.form-tribunal' );
    formTribunal.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#tribunal_nom').value.trim().length === 0 ){
            document.querySelector('#msg-tribunal_nom').classList.remove( 'hidden');
            document.querySelector('#msg-tribunal_nom').innerHTML = "Veuillez saisir le champ tribunal";
            test = false;
        }else{
            document.querySelector('#msg-tribunal_nom').classList.add( 'hidden');
            document.querySelector('#msg-tribunal_nom').innerHTML = "";
        }

        let code_postal = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;
        if( document.querySelector('#code_postal').value.trim().length === 0 || code_postal.test( document.querySelector('#code_postal').value.trim() ) === false ){
            document.querySelector('#msg-code_postal').classList.remove( 'hidden');
            document.querySelector('#msg-code_postal').innerHTML = "Veuillez saisir le champ code postal";
            test = false;
        }else{
            document.querySelector('#msg-code_postal').classList.add( 'hidden');
            document.querySelector('#msg-code_postal').innerHTML = "";
        }

        
        if( document.querySelector('#commune').value.trim().length === 0 ){
            document.querySelector('#msg-commune').classList.remove( 'hidden');
            document.querySelector('#msg-commune').innerHTML = "Veuillez saisir le champ commune";
            test = false;
        }else{
            document.querySelector('#msg-commune').classList.add( 'hidden');
            document.querySelector('#msg-commune').innerHTML = "";
        }


       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){            
            if( document.querySelector('#autorite_tribunal').value !== 'autorite_tribunal' && document.querySelector('#service_tribunal').value !== 'service_tribunal' ){
               formTribunal.submit();
            }else{
                html ='<div class="boxOverlay  ">';
                html += '<div class="modal modal-yesNo fas fa-exclamation-triangle">';
                html += '<p class="modal-message">Êtes-vous sûre de vouloir continuer sans définir une autorité et/ou un service ?</p>';
                html += '<button type="button" data-link="tribunal/new" onclick="document.querySelector( \'.form-tribunal\' ).submit();" class="modal-btn form-login-button modal-btn--inline modal-btn-yes">Oui</button>  ';
                html += '<button type="button" onclick="closeModal()" class="modal-btn form-login-button modal-btn--inline modal-btn-no"> Non</button>';
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html;  
            }        
            
        }else{
           
                html = '<div class="boxOverlay" >';
                html += '<div class="modal fas fa-exclamation-triangle">';
                html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
                html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html;            
        }
    });
}


function animateurForm( action ){
    formAnimateur = document.querySelector( '.form-animateur' );
    formAnimateur.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#civilite').value === "civilite" ){
            document.querySelector('#msg-civilite').classList.remove( 'hidden');
            document.querySelector('#msg-civilite').innerHTML = "Veuillez choisir une valeur dans le champ civilité";
            test = false;
        }else{
            document.querySelector('#msg-civilite').classList.add( 'hidden');
            document.querySelector('#msg-civilite').innerHTML = "";
        }


        
        if( document.querySelector('#nom').value.trim().length === 0 ){
            document.querySelector('#msg-nom').classList.remove( 'hidden');
            document.querySelector('#msg-nom').innerHTML = "Veuillez saisir le champ nom";
            test = false;
        }else{
            document.querySelector('#msg-nom').classList.add( 'hidden');
            document.querySelector('#msg-nom').innerHTML = "";
        }

        if( document.querySelector('#prenom').value.trim().length === 0 ){
            document.querySelector('#msg-prenom').classList.remove( 'hidden');
            document.querySelector('#msg-prenom').innerHTML = "Veuillez saisir le champ prenom";
            test = false;
        }else{
            document.querySelector('#msg-prenom').classList.add( 'hidden');
            document.querySelector('#msg-prenom').innerHTML = "";
        }

        if( document.querySelector('#adresse').value.trim().length === 0 ){
            document.querySelector('#msg-adresse').classList.remove( 'hidden');
            document.querySelector('#msg-adresse').innerHTML = "Veuillez saisir le champ adresse";
            test = false;
        }else{
            document.querySelector('#msg-adresse').classList.add( 'hidden');
            document.querySelector('#msg-adresse').innerHTML = "";
        }

        let code_postal = /^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/;
        if( document.querySelector('#code_postal').value.trim().length === 0 || code_postal.test( document.querySelector('#code_postal').value.trim() ) === false ){
            document.querySelector('#msg-code_postal').classList.remove( 'hidden');
            document.querySelector('#msg-code_postal').innerHTML = "Veuillez saisir le champ code postal";
            test = false;
        }else{
            document.querySelector('#msg-code_postal').classList.add( 'hidden');
            document.querySelector('#msg-code_postal').innerHTML = "";
        }

        
        if( document.querySelector('#commune').value.trim().length === 0 ){
            document.querySelector('#msg-commune').classList.remove( 'hidden');
            document.querySelector('#msg-commune').innerHTML = "Veuillez saisir le champ commune";
            test = false;
        }else{
            document.querySelector('#msg-commune').classList.add( 'hidden');
            document.querySelector('#msg-commune').innerHTML = "";
        }


       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){            
            
               formAnimateur.submit();
                  
            
        }else{
           
                html = '<div class="boxOverlay" >';
                html += '<div class="modal fas fa-exclamation-triangle">';
                html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
                html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html;
                document.querySelector('#valeurObligatoire').setAttribute('style', "");             
        }
    });
}



function civiliteForm( action ){
    formCivilite = document.querySelector( '.form-civilite' );
    formCivilite.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#nom').value.trim().length === 0 ){
            document.querySelector('#msg-nom').classList.remove( 'hidden');
            document.querySelector('#msg-nom').innerHTML = "Veuillez saisir le champ civilité";
            test = false;
        }else{
            document.querySelector('#msg-nom').classList.add( 'hidden');
            document.querySelector('#msg-nom').innerHTML = "";
        }

       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){
            formCivilite.submit();
          }else{
            html = '<div class="boxOverlay" >';
            html += '<div class="modal fas fa-exclamation-triangle">';
            html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
            html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
            html += '</div>';
            html += '</div>';
            document.querySelector('#alertUser').innerHTML =   html;
        }
    });
}


//affecte l'événement click au bouton changer le mot de passe
//et il afficher le champs mdp et son label
function showPassword(){
    btn = document.querySelector('.modal-btn-change-pwd');
    btn.addEventListener('click', () => {
        document.querySelector('#mdp').classList.remove('hidden');
        document.querySelector('#mdp-label').classList.remove('hidden');
        btn.classList.add('hidden');
    })
}

//affecte l'événement click aux images en forme de croix
//affiche la modal voulez vous supprimer l'utilisateur
//récupère l'url dans l'attribut href et l'affecte
//à l'attribut data-link du bouton yes
function msgDelete(){
    btnDelete = document.querySelectorAll('.tbl-link-delete');
    
    btnDelete.forEach( ( element ) => {
        element.addEventListener('click', (e) =>{
            e.preventDefault();
            const overlay = document.querySelector('.boxOverlay');
            const txtidentifiant = document.querySelector('.modal-message--value');
            overlay.classList.remove('hidden');
            btnYes = document.querySelector( '.modal-btn-yes' );
            btnYes.setAttribute('data-link', element.getAttribute( 'href' ) );
            txtidentifiant.innerHTML = element.getAttribute('data-value');
        })
    });
}


//affecte l'évenement click ou bouton oui et on bouton non
//si lapersonne click sur oui on récupère url qui est dans l'attribut 
//data-link et on redirige la personne si elle click non et masque le lightbox
function deleteUser(){
    btn = document.querySelector( '.modal-btn-yes' );
    url = btn.getAttribute( 'data-link' );
    if( url !== '' ){
        
        location.href = url;
        
    }

    const overlay = document.querySelector('.boxOverlay');
    overlay.classList.add('hidden');
}



function addAutorite(){
    const btn = document.querySelector('.btn-add-autorite').addEventListener('click', () =>{
        fetch('/autoriteprefecture/newjson')
        .then( ( reponse ) => {
            return reponse.json();
        })
        .then( ( reponse ) => {
            if( reponse.error.length === 0 ){
                html ='<div class="boxOverlay  ">';
                html += '<div class="modal modal-ajout">';
                html +=  reponse.data;
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html; 
                validAutoriteJsonEdit(); 
            }
        });
    });
}

function validAutoriteJsonEdit(){
    formAutorite = document.querySelector( '.form-autorite' );
    saisieAutorite = document.querySelector('.form-autorite .firstLetterUpper');
    formAutorite.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;
        if( document.querySelector('#autorite_nom').value.trim().length === 0 ){
            document.querySelector('#msg-autorite_nom').classList.remove( 'hidden');
            document.querySelector('#msg-autorite_nom').innerHTML = "Veuillez saisir le champ Autorité";
            test = false;
        }else{
            document.querySelector('#msg-autorite_nom').classList.add( 'hidden');
            document.querySelector('#msg-autorite_nom').innerHTML = "";
        }

        if( test === true ){
            
            formData = new FormData();
            formData.append('autorite_nom', document.querySelector('#autorite_nom').value.trim() );
            header = {
                method: "POST",
                body: formData
            };

            fetch('/autoriteprefecture/newjson', header)
            .then( (response ) => {
                return response.json();
            })
            .then( (response) =>{              
                if( response.error === 'exist' ){
                    document.querySelector('#msg-autorite_nom').classList.remove( 'hidden');
                    document.querySelector('#msg-autorite_nom').innerHTML = "Cette autorité existe déjà";
                }else if( response.error === 'add' ){
                    const selectAutorite = document.querySelector('#autorite_prefecture');
                    const option = document.createElement("option");
                    option.setAttribute('value', response.data.id )
                    option.text = response.data.autorite_nom;
                    selectAutorite.add(option);
                    selectAutorite.selectedIndex =  selectAutorite.length - 1 ;
                    closeModal();
                }
            });
        }
    });

    saisieAutorite.addEventListener( 'keyup', () => {
        if( saisieAutorite.value.length > 0 ){
            saisieAutorite.value = saisieAutorite.value.trimStart();
            saisieAutorite.value = saisieAutorite.value[0].toUpperCase() + saisieAutorite.value.substring(1);
        }                
    });
}

function addService(){
    const btn = document.querySelector('.btn-add-service').addEventListener('click', () =>{
        fetch('/serviceprefecture/newjson')
        .then( ( reponse ) => {
            return reponse.json();
        })
        .then( ( reponse ) => {
            if( reponse.error.length === 0 ){
                html ='<div class="boxOverlay  ">';
                html += '<div class="modal modal-ajout">';
                html +=  reponse.data;
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html; 
                validServiceJsonEdit();
            }
        });
    });
}


function validServiceJsonEdit(){
    formService = document.querySelector( '.form-service' );
    saisieService = document.querySelector('.form-service .firstLetterUpper');
    formService.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;
        if( document.querySelector('#service_nom').value.trim().length === 0 ){
            document.querySelector('#msg-service_nom').classList.remove( 'hidden');
            document.querySelector('#msg-service_nom').innerHTML = "Veuillez saisir le champ Service";
            test = false;
        }else{
            document.querySelector('#msg-service_nom').classList.add( 'hidden');
            document.querySelector('#msg-service_nom').innerHTML = "";
        }

        if( test === true ){
            
            formData = new FormData();
            formData.append('service_nom', document.querySelector('#service_nom').value.trim() );
            header = {
                method: "POST",
                body: formData
            };

            fetch('/serviceprefecture/newjson', header)
            .then( (response ) => {
                return response.json();
            })
            .then( (response) =>{              
                if( response.error === 'exist' ){
                    document.querySelector('#msg-service_nom').classList.remove( 'hidden');
                    document.querySelector('#msg-service_nom').innerHTML = "Cet service existe déjà";
                }else if( response.error === 'add' ){
                    const selectService = document.querySelector('#service_prefecture');
                    const option = document.createElement("option");
                    option.setAttribute('value', response.data.id )
                    option.text = response.data.service_nom;
                    selectService.add(option);
                    selectService.selectedIndex =  selectService.length - 1 ;
                    closeModal();
                }
            });
        }
    });

    saisieService.addEventListener( 'keyup', () => {
        if( saisieService.value.length > 0 ){
            saisieService.value = saisieService.value.trimStart();
            saisieService.value = saisieService.value[0].toUpperCase() + saisieService.value.substring(1);
        }                
    });
}







function addAutoriteTribunal(){
    const btn = document.querySelector('.btn-add-autorite-tribunal').addEventListener('click', () =>{
        fetch('/autoritetribunal/newjson')
        .then( ( reponse ) => {
            return reponse.json();
        })
        .then( ( reponse ) => {
            if( reponse.error.length === 0 ){
                html ='<div class="boxOverlay  ">';
                html += '<div class="modal modal-ajout">';
                html +=  reponse.data;
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html; 
                validAutoriteTribunalJsonEdit(); 
            }
        });
    });
}


function validAutoriteTribunalJsonEdit(){
    formAutorite = document.querySelector( '.form-autorite' );
    saisieAutorite = document.querySelector('.form-autorite .firstLetterUpper');
    formAutorite.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;
        if( document.querySelector('#autorite_nom').value.trim().length === 0 ){
            document.querySelector('#msg-autorite_nom').classList.remove( 'hidden');
            document.querySelector('#msg-autorite_nom').innerHTML = "Veuillez saisir le champ Autorité";
            test = false;
        }else{
            document.querySelector('#msg-autorite_nom').classList.add( 'hidden');
            document.querySelector('#msg-autorite_nom').innerHTML = "";
        }

        if( test === true ){
            
            formData = new FormData();
            formData.append('autorite_nom', document.querySelector('#autorite_nom').value.trim() );
            header = {
                method: "POST",
                body: formData
            };

            fetch('/autoritetribunal/newjson', header)
            .then( (response ) => {
                return response.json();
            })
            .then( (response) =>{              
                if( response.error === 'exist' ){
                    document.querySelector('#msg-autorite_nom').classList.remove( 'hidden');
                    document.querySelector('#msg-autorite_nom').innerHTML = "Cette autorité existe déjà";
                }else if( response.error === 'add' ){
                    const selectAutorite = document.querySelector('#autorite_tribunal');
                    const option = document.createElement("option");
                    option.setAttribute('value', response.data.id )
                    option.text = response.data.autorite_nom;
                    selectAutorite.add(option);
                    selectAutorite.selectedIndex =  selectAutorite.length - 1 ;
                    closeModal();
                }
            });
        }
    });

    saisieAutorite.addEventListener( 'keyup', () => {
        if( saisieAutorite.value.length > 0 ){
            saisieAutorite.value = saisieAutorite.value.trimStart();
            saisieAutorite.value = saisieAutorite.value[0].toUpperCase() + saisieAutorite.value.substring(1);
        }                
    });

    
}


function addServiceTribunal(){
    const btn = document.querySelector('.btn-add-service-tribunal').addEventListener('click', () =>{
        fetch('/servicetribunal/newjson')
        .then( ( reponse ) => {
            return reponse.json();
        })
        .then( ( reponse ) => {
            if( reponse.error.length === 0 ){
                html ='<div class="boxOverlay  ">';
                html += '<div class="modal modal-ajout">';
                html +=  reponse.data;
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html; 
                validServiceTribunalJsonEdit(); 
                firstLetterMaj();
            }
        });
    });
}


function validServiceTribunalJsonEdit(){
    formService = document.querySelector( '.form-service' );
    saisieService = document.querySelector('.form-service .firstLetterUpper');
    formService.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;
        if( document.querySelector('#service_nom').value.trim().length === 0 ){
            document.querySelector('#msg-service_nom').classList.remove( 'hidden');
            document.querySelector('#msg-service_nom').innerHTML = "Veuillez saisir le champ Service";
            test = false;
        }else{
            document.querySelector('#msg-service_nom').classList.add( 'hidden');
            document.querySelector('#msg-service_nom').innerHTML = "";
        }

        if( test === true ){
            
            formData = new FormData();
            formData.append('service_nom', document.querySelector('#service_nom').value.trim() );
            header = {
                method: "POST",
                body: formData
            };

            fetch('/servicetribunal/newjson', header)
            .then( (response ) => {
                return response.json();
            })
            .then( (response) =>{              
                if( response.error === 'exist' ){
                    document.querySelector('#msg-service_nom').classList.remove( 'hidden');
                    document.querySelector('#msg-service_nom').innerHTML = "Ce service existe déjà";
                }else if( response.error === 'add' ){
                    const selectService = document.querySelector('#service_tribunal');
                    const option = document.createElement("option");
                    option.setAttribute('value', response.data.id )
                    option.text = response.data.service_nom;
                    selectService.add(option);
                    selectService.selectedIndex =  selectService.length - 1 ;
                    closeModal();
                }
            });
        }
    });

    saisieService.addEventListener( 'keyup', () => {
        if( saisieService.value.length > 0 ){
            saisieService.value = saisieService.value.trimStart();
            saisieService.value = saisieService.value[0].toUpperCase() + saisieService.value.substring(1);
        }                
    });
}


function addCivilite(){
    const btn = document.querySelector('.btn-add-civilite').addEventListener('click', () =>{
        fetch('/civilite/newjson')
        .then( ( reponse ) => {
            return reponse.json();
        })
        .then( ( reponse ) => {
            if( reponse.error.length === 0 ){
                html ='<div class="boxOverlay  ">';
                html += '<div class="modal modal-ajout">';
                html +=  reponse.data;
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html; 
                validCiviliteJsonEdit(); 
            }
        });
    });
}


function validCiviliteJsonEdit(){
    formCivilite = document.querySelector( '.form-civilite' );
    saisieCivilite = document.querySelector('.form-civilite .firstLetterUpper');
    formCivilite.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;
        if( document.querySelector('#civilite-nom').value.trim().length === 0 ){
            document.querySelector('#msg-civilite-nom').classList.remove( 'hidden');
            document.querySelector('#msg-civilite-nom').innerHTML = "Veuillez saisir le champ Civilité";
            test = false;
        }else{
            document.querySelector('#msg-civilite-nom').classList.add( 'hidden');
            document.querySelector('#msg-civilite-nom').innerHTML = "";
        }

        if( test === true ){
            
            formData = new FormData();
            formData.append('nom', document.querySelector('#civilite-nom').value.trim() );
            header = {
                method: "POST",
                body: formData
            };

            fetch('/civilite/newjson', header)
            .then( (response ) => {
                return response.json();
            })
            .then( (response) =>{             
                if( response.error === 'exist' ){
                    document.querySelector('#msg-civilite-nom').classList.remove( 'hidden');
                    document.querySelector('#msg-civilite-nom').innerHTML = "Cette civilité existe déjà";
                }else if( response.error === 'add' ){
                    const selectCivilite = document.querySelector('#civilite');
                    const option = document.createElement("option");
                    option.setAttribute('value', response.data.id )
                    option.text = response.data.nom;
                    selectCivilite.add(option);
                    selectCivilite.selectedIndex =  selectCivilite.length - 1 ;
                    closeModal();
                }
            });
        }
    });

    saisieCivilite.addEventListener( 'keyup', () => {
        if( saisieCivilite.value.length > 0 ){
            saisieCivilite.value = saisieCivilite.value.trimStart();
            saisieCivilite.value = saisieCivilite.value[0].toUpperCase() + saisieCivilite.value.substring(1);
        }                
    });
}


function addFonctionAnimateur(){
    const btn = document.querySelector('.btn-add-fonction').addEventListener('click', () =>{
        fetch('/fonctionanimateur/newjson')
        .then( ( reponse ) => {
            return reponse.json();
        })
        .then( ( reponse ) => {
            if( reponse.error.length === 0 ){
                html ='<div class="boxOverlay  ">';
                html += '<div class="modal modal-ajout">';
                html +=  reponse.data;
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html; 
                validFonctionAnimateurJsonEdit(); 
            }
        });
    });
}


function validFonctionAnimateurJsonEdit(){
    formFonctionAnimateur = document.querySelector( '.form-fonctionAnimateur' );
    saisieFonctionAnimateur = document.querySelector('.form-fonctionAnimateur .firstLetterUpper');
    formFonctionAnimateur.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;
        if( document.querySelector('#fonctionAnimateur_nom').value.trim().length === 0 ){
            document.querySelector('#msg-fonctionAnimateur_nom').classList.remove( 'hidden');
            document.querySelector('#msg-fonctionAnimateur_nom').innerHTML = "Veuillez saisir le champ fonction";
            test = false;
        }else{
            document.querySelector('#msg-fonctionAnimateur_nom').classList.add( 'hidden');
            document.querySelector('#msg-fonctionAnimateur_nom').innerHTML = "";
        }

        if( test === true ){
            
            formData = new FormData();
            formData.append('nom', document.querySelector('#fonctionAnimateur_nom').value.trim() );
            header = {
                method: "POST",
                body: formData
            };

            fetch('/fonctionanimateur/newjson', header)
            .then( (response ) => {
                return response.json();
            })
            .then( (response) =>{  
                console.log(response)  ;         
                if( response.error === 'exist' ){
                    document.querySelector('#msg-fonctionAnimateur_nom').classList.remove( 'hidden');
                    document.querySelector('#msg-fonctionAnimateur_nom').innerHTML = "Cette fonction existe déjà";
                }else if( response.error === 'add' ){
                    const selectFonction = document.querySelector('#fonction_animateur');
                    const option = document.createElement("option");
                    option.setAttribute('value', response.data.id )
                    option.text = response.data.fonction_nom;
                    selectFonction.add(option);
                    selectFonction.selectedIndex =  selectFonction.length - 1 ;
                    closeModal();
                }
            });
        }
    });

    saisieFonctionAnimateur.addEventListener( 'keyup', () => {
        if( saisieFonctionAnimateur.value.length > 0 ){
            saisieFonctionAnimateur.value = saisieFonctionAnimateur.value.trimStart();
            saisieFonctionAnimateur.value = saisieFonctionAnimateur.value[0].toUpperCase() + saisieFonctionAnimateur.value.substring(1);
        }                
    });
}



function addStatutAnimateur(){
    const btn = document.querySelector('.btn-add-statut').addEventListener('click', () =>{
        fetch('/statutanimateur/newjson')
        .then( ( reponse ) => {
            return reponse.json();
        })
        .then( ( reponse ) => {
            if( reponse.error.length === 0 ){
                html ='<div class="boxOverlay  ">';
                html += '<div class="modal modal-ajout">';
                html +=  reponse.data;
                html += '</div>';
                html += '</div>';
                document.querySelector('#alertUser').innerHTML =   html; 
                validStatutAnimateurJsonEdit(); 
            }
        });
    });
}


function validStatutAnimateurJsonEdit(){
    formStatutAnimateur = document.querySelector( '.form-statutAnimateur' );
    saisieStatutAnimateur = document.querySelector('.form-statutAnimateur .firstLetterUpper');
    formStatutAnimateur.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;
        if( document.querySelector('#statutAnimateur_nom').value.trim().length === 0 ){
            document.querySelector('#msg-statutAnimateur_nom').classList.remove( 'hidden');
            document.querySelector('#msg-statutAnimateur_nom').innerHTML = "Veuillez saisir le champ statut";
            test = false;
        }else{
            document.querySelector('#msg-statutAnimateur_nom').classList.add( 'hidden');
            document.querySelector('#msg-statutAnimateur_nom').innerHTML = "";
        }

        if( test === true ){
            
            formData = new FormData();
            formData.append('nom', document.querySelector('#statutAnimateur_nom').value.trim() );
            header = {
                method: "POST",
                body: formData
            };

            fetch('/statutanimateur/newjson', header)
            .then( (response ) => {
                return response.json();
            })
            .then( (response) =>{  
                     
                if( response.error === 'exist' ){
                    document.querySelector('#msg-statutAnimateur_nom').classList.remove( 'hidden');
                    document.querySelector('#msg-statutAnimateur_nom').innerHTML = "Ce statut existe déjà";
                }else if( response.error === 'add' ){
                    const selectStatut = document.querySelector('#statut_animateur');
                    const option = document.createElement("option");
                    option.setAttribute('value', response.data.id )
                    option.text = response.data.status_nom;
                    selectStatut.add(option);
                    selectStatut.selectedIndex =  selectStatut.length - 1 ;
                    closeModal();
                }
            });
        }
    });

    saisieStatutAnimateur.addEventListener( 'keyup', () => {
        if( saisieStatutAnimateur.value.length > 0 ){
            saisieStatutAnimateur.value = saisieStatutAnimateur.value.trimStart();
            saisieStatutAnimateur.value = saisieStatutAnimateur.value[0].toUpperCase() + saisieStatutAnimateur.value.substring(1);
        }                
    });
}


function firstLetterMaj(){
    const inputSaisie = document.querySelectorAll('.firstLetterUpper' );

    inputSaisie.forEach( ( element ) => {
        element.addEventListener( 'keyup', () => {
            if( element.value.length > 0 ){
                element.value = element.value.trimStart();
                element.value = element.value[0].toUpperCase() + element.value.substring(1);
            }                
        });
    });
}

function allLetterMaj(){
    const inputSaisie = document.querySelectorAll('.shift' );

    inputSaisie.forEach( ( element ) => {
        element.addEventListener( 'keyup', () => {
            if( element.value.length > 0 ){
                element.value = element.value.trimStart();
                element.value = element.value.toUpperCase();
            }                
        });
    });
}

function noLetterMaj(){
    const inputSaisie = document.querySelectorAll('.noshift' );

    inputSaisie.forEach( ( element ) => {
        element.addEventListener( 'keyup', () => {
            if( element.value.length > 0 ){
                element.value = element.value.trimStart();
                element.value = element.value.toLowerCase();
            }                
        });
    });
}



function autocomplete(){
    const autoComplete = document.querySelectorAll('.autocomplete');

    autoComplete.forEach( ( element ) => {
        element.addEventListener( 'keyup', () => {            
            let itemSearch = element.getAttribute('id');
            let valueSearch = element.value;
            const elemHtmlAutoComplete = document.querySelector('.listeAutoComplete--' + itemSearch );
            if( element.value.length > 2 ){                
                let formData = new FormData();
                formData.append('itemSearch', itemSearch );
                formData.append('valueSearch', valueSearch);
                fetch('/animateur/newjson', {
                    method :  'POST',
                    body : formData
                })
                .then( ( result ) => result.json() )
                .then( ( result ) => {
                    if( result.error === false ){                        
                        if( result.list.length ){                            
                            elemHtmlAutoComplete.classList.remove('hidden');
                            elemHtmlAutoComplete.innerHTML = '';
                            for( let i in result.list ){
                                for( let z in result.list[i] ){
                                    elemHtmlAutoComplete.innerHTML += '<p><a href="#" class="autocomplete--choix" >' + result.list[i][z] + '</a></p>';
                                }
                            }
                        }

                        const choiceLink = document.querySelectorAll('.listeAutoComplete--' + itemSearch + ' .autocomplete--choix');
                        choiceLink.forEach( (elemLink) => {
                            console.log(elemLink);
                            elemLink.addEventListener('click' , (e ) => {
                                console.log(e.target);
                                e.preventDefault();
                                element.value = elemLink.textContent;
                                elemHtmlAutoComplete.classList.add('hidden');
                                elemHtmlAutoComplete.innerHTML = '';
                            });
                        });
                    }
                });
            }else{
                elemHtmlAutoComplete.classList.add('hidden');
                elemHtmlAutoComplete.innerHTML = '';
            }                            
        });        
        
    });

}


//execute la fonction main au chargement
main();


