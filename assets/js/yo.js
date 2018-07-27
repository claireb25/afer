document.getElementById("identifiant").addEventListener("keyup", function(event){
    var identifiant = document.getElementById("identifiant").value;
    sizeArray = document.querySelectorAll(".username").length;
    for (var i = 0; i < sizeArray; i++) {
        var colId = document.querySelectorAll(".username")[i].textContent;
        console.log(colId);
        // console.log(colId);
        // console.log(identifiant + '!=' + colId.substr(0, identifiant.length));
        if (identifiant != colId.substr(0, identifiant.length)) {
             document.querySelectorAll(".ligne")[i].classList.add("hidden");
        }else if (identifiant === colId.substr(0, identifiant.length)){
            document.querySelectorAll(".ligne")[i].classList.remove("hidden");
        }
    }
})
// if ()

// if (document.querySelectorAll(".ligne")[i].classList.contains("hidden") != true)

document.getElementById("firstname").addEventListener("keyup", function (event) {
    var firstname = document.getElementById("firstname").value;
    sizeArray = document.querySelectorAll(".prenom").length;
    for (var i = 0; i < sizeArray; i++) {
        var colId = document.querySelectorAll(".prenom")[i].textContent;
        // console.log(colId);
        console.log(firstname + '!=' + colId.substr(0, firstname.length));
        if (firstname != colId.substr(0, firstname.length)) {
            document.querySelectorAll(".ligne")[i].classList.add("hidden");
        } else if (firstname === colId.substr(0, firstname.length)) {
            document.querySelectorAll(".ligne")[i].classList.remove("hidden");
        }
    }
})

document.getElementById("name").addEventListener("keyup", function (event) {
    var name = document.getElementById("name").value;
    sizeArray = document.querySelectorAll(".nom").length;
    for (var i = 0; i < sizeArray; i++) {
        var colId = document.querySelectorAll(".nom")[i].textContent;
        // console.log(colId);
        console.log(name + '!=' + colId.substr(0, name.length));
        if (name != colId.substr(0, name.length)) {
            document.querySelectorAll(".ligne")[i].classList.add("hidden");
        } else if (name === colId.substr(0, name.length)) {
            document.querySelectorAll(".ligne")[i].classList.remove("hidden");
        }
    }
})

console.log(identifiant);
    // var colId = document.getElementsByClassName("tbl-col-list").value;
    // console.log(colId);