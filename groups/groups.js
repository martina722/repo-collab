function changeColor(buttonId, className, color) {
    let clickmeButton = document.getElementById(buttonId);
    clickmeButton.addEventListener('click', function() {
        let divs = document.getElementsByClassName(className);
        for (let i = 0; i < divs.length; i++) {
            divs[i].style.backgroundColor = color;
        }
    });
}

changeColor("primo-rosso", "primo-gruppo", "red");
changeColor("secondo-rosso", "secondo-gruppo", "red");
changeColor("terzo-rosso", "terzo-gruppo", "red");
changeColor("rossi", "tutti", "red");

changeColor("primo-blu", "primo-gruppo", "blue");
changeColor("secondo-blu", "secondo-gruppo", "blue");
changeColor("terzo-blu", "terzo-gruppo", "blue");
changeColor("blu", "tutti", "blue");

changeColor("primo-giallo", "primo-gruppo", "yellow");
changeColor("secondo-giallo", "secondo-gruppo", "yellow");
changeColor("terzo-giallo", "terzo-gruppo", "yellow");
changeColor("tutti-giallo", "tutti", "yellow");

// Singoli bottoni
 /*
let clickmeButton = document.getElementById("primo-rosso");
clickmeButton.addEventListener ('click', function() {
                let div = document.getElementsByClassName('primo-gruppo')
                for (i = 0; i < div.length; i++) {
                        div[i].style.backgroundColor = "red";
                }
});

clickmeButton = document.getElementById("secondo-rosso");
clickmeButton.addEventListener ('click', function() {
                let div = document.getElementsByClassName('secondo-gruppo')
                for (i = 0; i < div.length; i++) {
                        div[i].style.backgroundColor = "red";
                }
});

clickmeButton = document.getElementById("rossi");
clickmeButton.addEventListener ('click', function() {
                let div = document.getElementsByClassName('tutti')
                for (i = 0; i < div.length; i++) {
                        div[i].style.backgroundColor = "red";
                }
});

clickmeButton = document.getElementById("primo-blu");
clickmeButton.addEventListener ('click', function() {
                let div = document.getElementsByClassName('primo-gruppo')
                for (i = 0; i < div.length; i++) {
                        div[i].style.backgroundColor = "blue";
                }
});

clickmeButton = document.getElementById("secondo-blu");
clickmeButton.addEventListener ('click', function() {
                let div = document.getElementsByClassName('secondo-gruppo')
                for (i = 0; i < div.length; i++) {
                        div[i].style.backgroundColor = "blue";
                }
});

clickmeButton = document.getElementById("blu");
clickmeButton.addEventListener ('click', function() {
                let div = document.getElementsByClassName('tutti')
                for (i = 0; i < div.length; i++) {
                        div[i].style.backgroundColor = "blue";
                }
});
*/