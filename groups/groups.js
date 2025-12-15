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