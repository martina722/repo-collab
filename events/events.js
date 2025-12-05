// funzione generale
function changeColor(buttonId, className, color) {
    let clickmeButton = document.getElementById(buttonId);
    clickmeButton.addEventListener('click', function() {
        let elements = document.getElementsByClassName(className);
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.backgroundColor = color;
        }
    });
}
// richiamo della funzione per i singoli bottoni
changeColor('rosso', 'div', 'red');
changeColor('giallo', 'div', 'yellow');
changeColor('blu', 'div', 'blue');

/*
//bottone rosso
let clickmeButton = document.getElementById("rosso");
clickmeButton.addEventListener ('click', function() {
                let redColor = document.getElementsByClassName("giallo");
                for (i = 0; i < redColor.length; i++) {
                        redColor[i].style.backgroundColor = "red";
                }
        }
);
//bottone giallo
clickmeButton = document.getElementById("giallo");
clickmeButton.addEventListener('click', function() {
        let yellowColor = document.getElementsByClassName("giallo");
        for (i = 0; i < yellowColor.length; i++) {
                        yellowColor[i].style.backgroundColor = "yellow";
                }
        }
);
//bottone blu
clickmeButton = document.getElementById("blu");
clickmeButton.addEventListener('click', function() {
        let blueColor = document.getElementsByClassName("giallo");
        for (i = 0; i < blueColor.length; i++) {
                        blueColor[i].style.backgroundColor = "blue";
                }
        }
);
*/