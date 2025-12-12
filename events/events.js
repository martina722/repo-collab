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
// bottone che alterna i colori alternati progressivamente rosso, giallo, blu
clickmeButton = document.getElementById("altern");
clickmeButton.addEventListener('click', function() {
        let divs = document.getElementsByClassName("div");
        for (i = 0; i < divs.length; i++) {
                if (i % 3 == 0) {
                        divs[i].style.backgroundColor = "red";
                }
                else if (i % 3 == 1) {
                        divs[i].style.backgroundColor = "yellow";
                }
                else {
                        divs[i].style.backgroundColor = "blue";
                }
        }
        /* oppure
        // parto da 0 e vado avanti di 3
        for (i = 0; i < divs.length; i+=3) {
                divs[i].style.backgroundColor = "red";
        }
        // parto da 1 e vado avanti di 3
        for (i = 1; i < divs.length; i+=3) {
                divs[i].style.backgroundColor = "red";
        }
        // parto da 2 e vado avanti di 3
        for (i = 2; i < divs.length; i+=3) {
                divs[i].style.backgroundColor = "red";
        }
        */
})
