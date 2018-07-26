document.getElementById("identifiant").addEventListener("keyup", function(event){
    var identifiant = document.getElementById("identifiant").value;
    sizeArray = document.querySelectorAll(".username").length;
    for (var i = 0; i < sizeArray; i++) {
        var colId = document.querySelectorAll(".username")[i].textContent;
        // console.log(colId);
        console.log(identifiant + '!=' + colId.substr(0, identifiant.length));
        if (identifiant != colId.substr(0, identifiant.length)) {
             document.querySelectorAll(".ligne")[i].classList.add("hidden");
        }else if (identifiant === colId.substr(0, identifiant.length)){
                document.querySelectorAll(".ligne")[i].classList.remove("hidden");
        }
    }
})


console.log(identifiant);
    // var colId = document.getElementsByClassName("tbl-col-list").value;
    // console.log(colId);