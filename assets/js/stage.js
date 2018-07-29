$(document).ready( function() {
    $('body').on("click", ".form div h3", function(){
        // console.log($(this).children('div'))
      if ($(this).children('span').hasClass('close')) {
        $(this).children('span').removeClass('close');
      }
      else {
        $(this).children('span').addClass('close');
      }
      $(this).parent().children('div').slideToggle(250);
    });
});



if (document.getElementById('animateur_nom') !== null){
  var inputAnimateurNom = document.getElementById('animateur_nom');
  inputAnimateurNom.addEventListener('keyup', function(e){
    autoCompleteAnimateur();
  })
}


//AutoComplete for animateur

function autoCompleteAnimateur(){
  var min_length = 1; // min caracters to display the autocomplete
  var animateur = inputAnimateurNom.value;
  if (animateur.length >= min_length) {
    $.ajax({
      url: 'stage/query',
      type: 'POST',
      data: {animateur:animateur},
      success:function(data){
        data = JSON.parse(data);
        // console.log(data);
        // console.log(animateur);
        var html = "";
        // console.log(data);
        for (elem of data){
          
          html += '<li data-id="'+elem.id+'">'+ elem.nom + ' ' + elem.prenom + ' ' + elem.fonction_nom +'</li>';
          document.getElementById('animateur_nom_list').innerHTML = html;
          $('#animateur_nom_list').show();
        }
        animClicked(data);
      }
    });
  } else {
      document.getElementById('animateur_nom_hidden').value = "";
    console.log('coucou');
    $('#animateur_nom_list').hide();
  }
}

function animClicked(data){
  listElem= document.getElementById('input_nom_anim1'); 
  listElem.addEventListener('click', function(e){ // listen to click on children of input_lieu
    // var newValue = e.target.innerText //
    // console.log(e.target.innerText);
    var idValue = e.target.getAttribute('data-id');
    var civilite ="";
    var fonction ="";
    var statut ="";
    var nom = "";
    var prenom = "";
    var adresse ="";
    var gta ="";
    var code_postal ="";
    var commune ="";
    var raison_sociale = "";
    var region = "";
    var tel_portable = "";
    var tel_fixe = "";
    var email = "";
    var urssaf = "";
    var siret = "";
    var observations = "";
    $('#animateur_nom_list').hide();
    //document.getElementById('animateur_nom').value = newValue; // change main input name
    document.getElementById('animateur_nom_hidden').value = idValue; // change value of hidden input into chosen id number
    // console.log(data)
    for (elements of data){ 
      console.log(elements);//if data element is the same as chosen element, change all the other inputs values 
      if (elements.nom+ ' '+ elements.prenom+ ' '+ elements.fonction_nom == e.target.innerText){
        // console.log(elements);

        civilite = elements.civilite_id;
        document.getElementById('civilite_anim').value = civilite;

        fonction = elements.fonction_id;
        document.getElementById('fonction_anim').value = fonction;

        statut = elements.statut_id;
        document.getElementById('statut_anim').value = statut;

        nom = elements.nom;
        document.getElementById('animateur_nom').value = nom;

        prenom = elements.prenom;
        document.getElementById('prenom').value = prenom;

        gta = elements.gta;
        if (elements.gta == 1){
          document.getElementById('gta').checked = true
        }

        raison_sociale = elements.raison_sociale;
        document.getElementById('raison_sociale').value = raison_sociale;

        adresse = elements.adresse;
        document.getElementById('adresse_anim').value = adresse;

        code_postal = elements.code_postal;
        document.getElementById('code_postal_anim').value = code_postal;

        commune = elements.commune;
        document.getElementById('ville').value = commune;

        region = elements.region;
        document.getElementById('region').value = region;

        tel_portable = elements.tel_portable;
        document.getElementById('tel_portable').value = tel_portable;

        tel_fixe = elements.tel_fixe;
        document.getElementById('tel_fixe').value = tel_fixe;

        email = elements.email;
        document.getElementById('email').value = email;

        urssaf = elements.urssaf;
        document.getElementById('urssaf').value = urssaf;

        siret = elements.siret;
        document.getElementById('siret').value = siret;

        observations = elements.observations;
        document.getElementById('observations').value = observations;
      }
    
    }
  })
}  
