function search(tableaux){
    tableaux.element.querySelectorAll('tbody tr').forEach((line) => {
        count = 0;
        count_input = 0;
        columns = line.querySelectorAll('td');
        tableaux.inputs.forEach((input) => {
            inputValue = input.value;
            if(inputValue != ''){
                count_input ++;
                chaineChamp = columns[input.dataset.column].innerText;
                if(inputValue === chaineChamp.toLowerCase().substr(0, inputValue.length)){
                    count ++;
                }
            }
        })
        if(count == count_input){
            line.style.display = "table-row";
        }
        else{
            line.style.display = "none";
        }
    });
}

document.querySelectorAll('.tbl-list').forEach((element) => {
    filtres_listes = {};
    filtres_listes.element = element;
    filtres_listes.inputs = element.querySelectorAll('thead input');
    filtres_listes.lignes = element.querySelectorAll('tbody tr');
    filtres_listes.inputs.forEach((input) => {
        input.addEventListener("keyup", search.bind(null, filtres_listes), false)
    })
});