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


  if( document.querySelector('.form-natureTribunal-create') !== null ){
    natureTribunalForm( 'create');
  }

  if( document.querySelector('.form-natureTribunal-edit') !== null ){
    natureTribunalForm( 'edit');
  }
  

  
  if( document.querySelector('.tbl-link-delete') !== null ){
      msgDelete();
  }

   if( document.querySelector('.modal-btn-change-pwd') !== null ){
      showPassword();
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
    }else{
        document.querySelector('.modal-btn-no').addEventListener('click', () => {
            overlay.classList.add('hidden');
        });
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


function natureTribunalForm( action ){
    formNature = document.querySelector( '.form-nature' );
    formNature.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;


        //gestion des messages d'erreurs
        if( document.querySelector('#nature_nom').value.trim().length === 0 ){
            document.querySelector('#msg-nature_nom').classList.remove( 'hidden');
            document.querySelector('#msg-nature_nom').innerHTML = "Veuillez saisir le champ nature";
            test = false;
        }else{
            document.querySelector('#msg-nature_nom').classList.add( 'hidden');
            document.querySelector('#msg-nature_nom').innerHTML = "";
        }

       
        //di pas de soucis dans le formulaire
        //on l'envoi sinon on injecte le modal pour
        //informer des erreurs
        if( test === true ){
            formNature.submit();
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


//execute la fonction main au chargement
main();


