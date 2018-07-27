function filterIsComming(filter, column){ //3 colonnes en paramètre
    document.getElementById(filter).addEventListener("keyup", function (event) {
        var filterContainer = document.getElementById(filter).value;
        sizeArray = document.querySelectorAll(column).length;
        for (var i = 0; i < sizeArray; i++) {
            var colId = document.querySelectorAll(column)[i].textContent;
            console.log(colId);
            // console.log(colId);
            // console.log(filterContainer + '!=' + colId.substr(0, filterContainer.length));
            if (filterContainer != colId.substr(0, filterContainer.length)) {
                document.querySelectorAll(".ligne")[i].classList.add("hidden");
            } else if (filterContainer === colId.substr(0, filterContainer.length)) {
                document.querySelectorAll(".ligne")[i].classList.remove("hidden");
            }
        }
    })
}

filterIsComming("identifiant", ".username");
filterIsComming("firstname", ".prenom");
filterIsComming("name", ".nom");


// for (var c = 0; c < document.querySelectorAll("tr").length; c++) {
//     for (var i = 0; i < 2; i++){
//         document.querySelectorAll("td")[i].textContent;
//         console.log(document.querySelectorAll("td")[i].textContent);
//     }
//     // console.log(document.querySelectorAll("tr"));
// }

// console.log(document.querySelectorAll("tr").length);