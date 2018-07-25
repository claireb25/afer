function main(){

  if( document.querySelector('.modal-btn') !== null ){
      closeModal();
  }

  if( document.querySelector('.form-user') !== null ){
     userForm();
  }


}


function closeModal(){
    const modal = document.querySelector('.modal-btn');
    const overlay = document.querySelector('.boxOverlay');
    modal.addEventListener('click', () => {
        overlay.classList.add('hidden');
    });
}


function userForm(){
    formUser = document.querySelector( '.form-user' );

    formUser.addEventListener('submit', ( e ) =>{
        e.preventDefault();
        test = true;

        if( document.querySelector('#identifiant').value.trim().length === 0 ){
            document.querySelector('#msg-identifiant').classList.remove( 'hidden');
            document.querySelector('#msg-identifiant').innerHTML = "Veuillez saisir le champ identifiant";
            test = false;
        }else{
            document.querySelector('#msg-identifiant').classList.add( 'hidden');
            document.querySelector('#msg-identifiant').innerHTML = "";
        }

        if( document.querySelector('#mdp').value.trim().length === 0 ){
            document.querySelector('#msg-mdp').classList.remove( 'hidden');
            document.querySelector('#msg-mdp').innerHTML = "Veuillez saisir le champ mot de passe";
            test = false;
        }else{
            document.querySelector('#msg-mdp').classList.add( 'hidden');
            document.querySelector('#msg-mdp').innerHTML = "";
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

        if( test === true ){
            formUser.submit();
        }else{
            html = '<div class="boxOverlay" >';
            html += '<div class="modal fas fa-exclamation-triangle">';
            html += '<p class="modal-message">Merci de saisir les champs signalés par un message d\'erreur.</p>';
            html += '<button type="button" onclick="document.querySelector(\'.boxOverlay\').classList.add(\'hidden\');" class="modal-btn form-login-button" >OK</button>';
            html += '</div>';
            html += '</div>';
            document.querySelector('body').innerHTML =  document.querySelector('body').innerHTML + html
        }
    })
}

main();


