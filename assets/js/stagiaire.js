function addNewStagiaire(){
    var carte_avantages_jeunes = "";
    var partenaires = "";
    var adherents = "";

    if (document.getElementById('stagiaire_carte_avantages_jeunes').checked == true){
         carte_avantages_jeunes = 1;
    } else { carte_avantages_jeunes = 0; }

    if (document.getElementById('stagiaire_partenaires').checked == true){
        partenaires = 1;
    } else { partenaires = 0; }

    if (document.getElementById('stagiaire_adherents').checked == true){
        adherents = 1;
    } else { adherents = 0; }


        $.ajax({
            url: 'stagiaire/new',
            type: 'POST',
            data: {
                civilite:document.getElementById('stagiaire_civilite').value,
                nom:document.getElementById('stagiaire').value,
                nom_naissance:document.getElementById('stagiaire_nom_naissance').value,
                prenom:document.getElementById('stagiaire_prenom').value,
                date_naissance:document.getElementById('stagiaire_date_naissance').value,
                lieu_naissance:document.getElementById('stagiaire_lieu_naissance').value,
                adresse:document.getElementById('stagiaire_adresse').value,
                code_postal:document.getElementById('stagiaire_code_postal').value,
                commune:document.getElementById('stagiaire_commune').value,
                pays:document.getElementById('stagiaire_pays').value,
                tel_portable:document.getElementById('stagiaire_tel_portable').value,
                tel_fixe:document.getElementById('stagiaire_tel_fixe').value,
                email:document.getElementById('stagiaire_email').value,
                carte_avantages_jeunes:carte_avantages_jeunes,
                partenaires:partenaires,
                adherents:adherents
            },
            success:function(data){
                data = JSON.parse(data);
            }
        }); 
}


if (document.getElementById('stagiaire') !== null) {
    var inputStagiaire = document.getElementById('stagiaire');
    var addStagiaire = document.getElementById('stagiaire_ajout');

    inputStagiaire.addEventListener('keyup', function (e) {
        autoCompleteStagiaire();
    });

    addStagiaire.addEventListener('click', function (e){
        addNewStagiaire();
    });
}


function autoCompleteStagiaire(){
    var min_length = 1; // min caracters to display the autocomplete
    var keyword = inputStagiaire.value;
    if (keyword.length >= min_length) {
      $.ajax({
        url: 'stagiaire/query',
        type: 'POST',
        data: {keyword:keyword},
        success:function(data){
          data = JSON.parse(data);
          console.log(data);
          console.log(keyword);
          var html = "";
          for (elem of data){
            
            html += '<li data-id="'+elem.id+'">'+ elem.nom + '</li> <input id="stagiaire_hidden" name="stagiaire" type="hidden" value="'+elem.nom+'">';
            document.getElementById('stagiaire_list').innerHTML = html;
            $('#stagiaire_list').show();
          }
          itemClicked(data);
        }
      });
    } else {
        document.getElementById('stagiaire_hidden').value = "";
      $('#stagiaire_list').hide();
    }
}
  


  
function itemClicked(data){
    listElem= document.getElementById('input_stagiaire'); 
    listElem.addEventListener('click', function(e){ // listen to click on children of input_lieu
      var newValue = e.target.innerText //
      var idValue = e.target.getAttribute('data-id');
      var civilite = "";
      var nom = "";
      var prenom = "";
      var nom_naissance = "";
      var date_naissance = "";
      var lieu_naissance = "";
      var adresse ="";
      var code_postal ="";
      var commune ="";
      var pays = "";
      var tel_portable = "";
      var tel_fixe = "";
      var email = "";
      var carte_avantages_jeunes = "";
      var partenaires = "";
      var adherents = "";    
      $('#stagiaire_list').hide();
      document.getElementById('stagiaire').value = newValue; // change main input name
      document.getElementById('stagiaire_hidden').value = idValue; // change value of hidden input into chosen id number
      
      for (elements of data){ //if data element is the same as chosen element, change all the other inputs values 
        if (elements.nom == e.target.innerText){
          console.log(elements);
          civilite = elements.civilite_id_id;
          document.getElementById('stagiaire_civilite').value = civilite;

          nom = elements.nom;
          document.getElementById('stagiaire').value = nom;

          prenom = elements.prenom;
          document.getElementById('stagiaire_prenom').value = prenom;

          nom_naissance = elements.nom_naissance;
          document.getElementById('stagiaire_nom_naissance').value = nom_naissance;

          date_naissance = elements.date_naissance;
          document.getElementById('stagiaire_date_naissance').value = date_naissance;

          lieu_naissance = elements.lieu_naissance;
          document.getElementById('stagiaire_lieu_naissance').value = lieu_naissance;
  
          adresse = elements.adresse;
          document.getElementById('stagiaire_adresse').value = adresse;
  
          code_postal = elements.code_postal;
          document.getElementById('stagiaire_code_postal').value = code_postal;
  
          commune = elements.commune;
          document.getElementById('stagiaire_commune').value = commune;

          pays = elements.pays;
          document.getElementById('stagiaire_pays').value = pays;

          tel_portable = elements.tel_portable;
          document.getElementById('stagiaire_tel_portable').value = tel_portable;

          tel_fixe = elements.tel_fixe;
          document.getElementById('stagiaire_tel_fixe').value = tel_fixe;

          email = elements.email;
          document.getElementById('stagiaire_email').value = email;

          carte_avantages_jeunes = elements.carte_avantages_jeunes;
          if (carte_avantages_jeunes == 1){
            document.getElementById('stagiaire_carte_avantages_jeunes').checked = true;
          }

          partenaires = elements.partenaires;
          if (partenaires == 1){
            document.getElementById('stagiaire_partenaires').checked = true;
          }

          adherents = elements.adherents;
          if (adherents == 1){
            document.getElementById('stagiaire_adherents').checked = true;
          }
        }
      }
    })
  }  
   
  