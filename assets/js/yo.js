function filterIsComming2(){
    document.getElementById("filter").addEventListener("keyup", function(){
        var arrayLines = document.querySelectorAll(".line");
        // console.log(arrayLines);
        var identifiant = document.getElementById("identifiant").value.toLowerCase();
        // console.log(identifiant);
        var nom = document.querySelector("#name").value.toLowerCase();
        var prenom = document.querySelector("#firstname").value.toLowerCase();
        for (var i = 0; i < arrayLines.length; i++){
            var column1 = arrayLines[i].cells[0].innerHTML.toLowerCase();
            var column2 = arrayLines[i].cells[1].innerHTML.toLowerCase();
            var column3 = arrayLines[i].cells[2].innerHTML.toLowerCase();

            if (identifiant != column1.substr(0, identifiant.length) | prenom != column2.substr(0, prenom.length) | nom != column3.substr(0, nom.length)) {
                arrayLines[i].classList.add("hidden");
            }else{
                arrayLines[i].classList.remove("hidden");
            }
        }
    })
}

filterIsComming2();

// filterIsComming("identifiant", ".username");
// filterIsComming("firstname", ".prenom");
// filterIsComming("name", ".nom");


// for (var c = 0; c < document.querySelectorAll("tr").length; c++) {
//     for (var i = 0; i < 2; i++){
//         document.querySelectorAll("td")[i].textContent;
//         console.log(document.querySelectorAll("td")[i].textContent);
//     }
//     // console.log(document.querySelectorAll("tr"));
// }

// console.log(document.querySelectorAll("tr").length);



/****************************************************************************************************************
 **************************************                                    **************************************
 **************************************  Pour un seul et unique champs de  **************************************
 **************************************            Recherche               **************************************
 **************************************                                    **************************************
 ****************************************************************************************************************                  
*/


// function filterIsComming(){ //3 colonnes en paramètre
//     document.getElementById(filter).addEventListener("keyup", function (event) {
//         var filterContainer = document.getElementById(filter).value;
//         sizeArray = document.querySelectorAll(column).length;
//         for (var i = 0; i < sizeArray; i++) {
//             var colId = document.querySelectorAll(column)[i].textContent;
//             console.log(colId);
//             // console.log(colId);
//             // console.log(filterContainer + '!=' + colId.substr(0, filterContainer.length));
//             if (filterContainer != colId.substr(0, filterContainer.length)) {
//                 document.querySelectorAll(".ligne")[i].classList.add("hidden");
//             } else if (filterContainer === colId.substr(0, filterContainer.length)) {
//                 document.querySelectorAll(".ligne")[i].classList.remove("hidden");
//             }
//         }
//     })
// }

// filterIsComming("identifiant", ".username");
// filterIsComming("firstname", ".prenom");
// filterIsComming("name", ".nom");


// for (var c = 0; c < document.querySelectorAll("tr").length; c++) {
//     for (var i = 0; i < 2; i++){
//         document.querySelectorAll("td")[i].textContent;
//         console.log(document.querySelectorAll("td")[i].textContent);
//     }
//     // console.log(document.querySelectorAll("tr"));
// }

// console.log(document.querySelectorAll("tr").length);


// var filters = [
//     'prenom',
//     'nom',
//     'profession'
// ];

// function search(filter) {
//     // Boucle de chaque filter
//     //
//     var lines = document.querySelectorAll('tbody tr');
//     for (var i = 0; i < lines.length; i++) {
//         count = 0;
//         count_filter = 0;
//         columns = lines[i].querySelectorAll('td');
//         for (var x = 0; x < filters.length; x++) {
//             filter = document.getElementById(filters[x]);
//             filterValue = filter.value;
//             if (filterValue != '') {
//                 count_filter++;
//                 column_id = filter.dataset.column;
//                 column = columns[column_id];
//                 TextChamp = column.innerText;
//                 //
//                 if (filterValue === textChamp.toLowerCase().substr(0, filterValue.length)) {
//                     count++;
//                 }
//             }
//         }
//         if (count == count_filter) {
//             lines[i].style.display = "table-row";
//         } else {
//             lines[i].style.display = "none";
//         }
//     }
// }
// filters.forEach(function (value) {
//     document.getElementById(value).addEventListener("keyup", search, false);
// });