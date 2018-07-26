function main(){

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

  
  if( document.querySelector('.tbl-link-delete') !== null ){
      msgDelete();
  }


}


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


function userForm( action ){
    formUser = document.querySelector( '.form-user' );
    formUser.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;
        console.log( true );
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

        // if( test === true ){
        //     formUser.submit();
        //  }else{
        //     html = '<div class="boxOverlay" >';
        //     html += '<div class="modal fas fa-exclamation-triangle">';
        //     html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
        //     html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
        //     html += '</div>';
        //     html += '</div>';
        //     document.querySelector('#alertUser').innerHTML =   html;
        // }
    });
}


function msgDelete(){
    btnDelete = document.querySelectorAll('.tbl-link-delete');

    btnDelete.forEach( ( element ) => {
        element.addEventListener('click', (e) =>{
            e.preventDefault();
            const overlay = document.querySelector('.boxOverlay');
            overlay.classList.remove('hidden');
            btnYes = document.querySelector( '.modal-btn-yes' );
            btnYes.setAttribute('data-link', element.getAttribute( 'href' ) );
        })
    });
}



function deleteUser(){
    btn = document.querySelector( '.modal-btn-yes' );
    url = btn.getAttribute( 'data-link' );
    if( url !== '' ){
        
        location.href = url;
        
    }

    const overlay = document.querySelector('.boxOverlay');
    overlay.classList.add('hidden');
}

main();


