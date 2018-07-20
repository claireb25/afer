function main(){

  if( document.querySelector('.modal-btn') !== null ){
      closeModal();
  }
}


function closeModal(){
    const modal = document.querySelector('.modal-btn');
    const overlay = document.querySelector('.boxOverlay');
    modal.addEventListener('click', () => {
        overlay.classList.add('hidden');
    });
}

main();


