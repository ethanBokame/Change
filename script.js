// Déclaration des constantes
const from = document.getElementById("from");
const to = document.getElementById("to");
const from_number = document.getElementById("from_number");

// Déclaration des variables
var value_from = from.value;
var value_to = to.value;
var value_from_number = from_number.value;

// fonction pour tester la connexion
/*async function testConnexion() {
    try {
        const reponse = await fetch(            
            "https://api.fxratesapi.com/convert?from=" +
            value_from +
            "&to=" +
            value_to +
            "&amount=" +
            value_from_number +
            "&format=json");
        
        
    } catch (error) {
        
        return true;
    }
}*/



// fonction pour la conversion des monnaies
function conversion() {
    if (value_from && value_to && value_from_number) {
        var ajax_object = new XMLHttpRequest();
        ajax_object.open(
            "GET",
            "https://api.fxratesapi.com/convert?from=" +
                value_from +
                "&to=" +
                value_to +
                "&amount=" +
                value_from_number +
                "&format=json"
        );
        
        ajax_object.send();
        ajax_object.responseType = "json";
        ajax_object.onload = () => {

            if (ajax_object.readyState == 4 && ajax_object.status == 200)
            {
                const data = ajax_object.response;
                document.getElementById("result").innerHTML = data.result + " " + value_to;
            }
        };

    }
}

// Premier appel de la fonction
conversion();

// Ecouteurs d'évennements sur les entrées utilisateurs
from.addEventListener("change", function () {
    value_from = from.value;

    conversion();
});

to.addEventListener("change", function () {
    value_to = to.value;

    conversion();
});

from_number.addEventListener("input", function () {
    value_from_number = from_number.value;

    conversion();
});


//changement de fleche au select
const select_from = document.querySelector('.from-container select');
const select_to = document.querySelector('.to-container select');


function select_drop(select) {
    if (document.querySelector('.' + select + '-container .select-container img').getAttribute("src") == "image/fleche-deroulante (1).png")
        {
            document.querySelector('.' + select + '-container .select-container img').setAttribute("src", "image/fleche-deroulante.png")
        }
        else 
        {
            document.querySelector('.' + select + '-container .select-container img').setAttribute("src", "image/fleche-deroulante (1).png")
        }
}

function select_drop_close(select) {
    if (document.querySelector('.' + select + '-container .select-container img').getAttribute("src") == "image/fleche-deroulante (1).png")
        {
            document.querySelector('.' + select + '-container .select-container img').setAttribute("src", "image/fleche-deroulante.png")
        }
}

/*const aaa = document.querySelector('body');
console.log(aaa);



document.querySelector('body').addEventListener('click', () => {
    select_drop_close('from');
    select_drop_close('to');

})*/

from.addEventListener("click", function () {
    select_drop('from');
});

to.addEventListener("click", function () {
    select_drop('to');
});

document.addEventListener('click', (event_info) => {
    //console.log(event_info);
    if (!from.contains(event_info.target)){
        select_drop_close('from');
    }

    if (!to.contains(event_info.target)){
        select_drop_close('to');
    }
})



//survol de l'image de changement
const img_changement = document.getElementById('conv-img');

img_changement.addEventListener("mouseover", function (){
    this.setAttribute("src", "image/fleches-gauche-et-droite2.png")
})

img_changement.addEventListener("mouseout", function (){
    this.setAttribute("src", "image/fleches-gauche-et-droite.png")
})


// Interchangement des valeurs en cas de clique sur le bouton changement
img_changement.addEventListener("click", function () {
    var from_selected_index = from.selectedIndex;
    var from_option_selected = from.options[from_selected_index];


    var to_selected_index = to.selectedIndex;
    var to_option_selected = to.options[to_selected_index];

    [from_option_selected.label, to_option_selected.label] = [to_option_selected.label, from_option_selected.label];
    [from_option_selected.value, to_option_selected.value] = [to_option_selected.value, from_option_selected.value];


    value_from = from_option_selected.value;
    value_to = to_option_selected.value;

    conversion();
})

