/*
// funzione generale
function changeColor(buttonId, className, color) {
    let clickmeButton = document.getElementById(buttonId);
    clickmeButton.addEventListener('click', function() {
        let divs = document.getElementsByClassName(className);
        for (let i = 0; i < divs.length; i++) {
            divs[i].style.backgroundColor = color;
        }
    });
}
// richiamo della funzione per i singoli bottoni
changeColor('rosso', 'div', 'red');
changeColor('giallo', 'div', 'yellow');
changeColor('blu', 'div', 'blue');
*/

//bottone rosso
let clickmeButton = document.getElementById("rosso");
clickmeButton.addEventListener ('click', function() {
                let divs = document.getElementsByClassName("div");
                for (i = 0; i < divs.length; i++) {
                        divs[i].style.backgroundColor = "red";
                }
        }
);
//bottone giallo
clickmeButton = document.getElementById("giallo");
clickmeButton.addEventListener('click', function() {
        let divs = document.getElementsByClassName("div");
        for (i = 0; i < divs.length; i++) {
                        divs[i].style.backgroundColor = "yellow";
                }
        }
);
//bottone blu
clickmeButton = document.getElementById("blu");
clickmeButton.addEventListener('click', function() {
        let divs = document.getElementsByClassName("div");
        for (i = 0; i < divs.length; i++) {
                        divs[i].style.backgroundColor = "blue";
                }
        }
);
// bottone che alterna i colori
clickmeButton = document.getElementById("altern");
clickmeButton.addEventListener('click', function() {
        let divs = document.getElementsByClassName("div");
        for (i = 0; i < div)
})
