if (document.getElementById('lieu_stage') !== null){
    var inputLieuStage = document.getElementById('lieu_stage');
    inputLieuStage.addEventListener('keyup', function(e){
      autoComplete();
    });
  }

// AutoComplete for Lieu_Stage
function autoComplete(){
    var min_length = 1; // min caracters to display the autocomplete
    var keyword = inputLieuStage.value;
    if (keyword.length >= min_length) {
      $.ajax({
        url: 'stage/query',
        type: 'POST',
        data: {keyword:keyword},
        success:function(data){
          data = JSON.parse(data);
          console.log(data);
          console.log(keyword);
          var html = "";
          for (elem of data){
            
            html += '<li data-id="'+elem.id+'">'+ elem.lieu_nom + '</li>';
            document.getElementById('lieu_stage_list').innerHTML = html;
            $('#lieu_stage_list').show();
          }
          lieuClicked(data);
        }
      });
    } else {
        document.getElementById('lieu_stage_hidden').value = "";
      $('#lieu_stage_list').hide();
    }
  }
  

// document.getElementById('lieu_stage_list').addEventListener('click', function (e){
//     console.log('ça clique')
// })
  function lieuClicked(data){
    console.log('test')
    listElem= document.getElementById('lieu_stage_list'); 
    console.log(listElem);
    listElem.addEventListener('click', function(e){ // listen to click on children of input_lieu
      console.log(e.target);
      var newValue = e.target.innerText //
      var idValue = e.target.getAttribute('data-id');
      var etablissement = "";
      var adresse ="";
      var code_postal ="";
      var commune ="";
      var tel = "";
      var latitude = "";
      var longitude = "";
      var divers ="";
      var numero_agrement ="";
      $('#lieu_stage_list').hide();
      document.getElementById('lieu_stage').value = newValue; // change main input name
      document.getElementById('lieu_stage_hidden').value = idValue; // change value of hidden input into chosen id number
      
      for (elements of data){ //if data element is the same as chosen element, change all the other inputs values 
        if (elements.lieu_nom == e.target.innerText){
          console.log(elements);
          etablissement = elements.etablissement_nom;
          document.getElementById('etablissement_nom').value = etablissement;
  
          adresse = elements.adresse;
          document.getElementById('adresse').value = adresse;
  
          code_postal = elements.code_postal;
          document.getElementById('code_postal').value = code_postal;
  
          commune = elements.commune;
          document.getElementById('commune').value = commune;
  
          tel = elements.tel;
          document.getElementById('tel').value = tel;
  
          latitude = elements.latitude;
          document.getElementById('latitude').value = latitude;
  
          longitude = elements.longitude;
          document.getElementById('longitude').value = longitude;
  
          divers = elements.divers;
          document.getElementById('divers').value = divers;
  
          numero_agrement = elements.numero_agrement;
          document.getElementById('numero_agrement').value = numero_agrement;
        }
      
      }
    })
  }  
   
  
  
  