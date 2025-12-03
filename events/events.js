var clickmeButton = document.getElementById("click-me-button");
clickmeButton.addEventListener ('click', function() {
                var cambioColore = document.getElementsByClassName("giallo");
                for (i = 0; i < cambioColore.length; i++) {
                        cambioColore[i].style.backgroundColor = "red";
                }
        }
);
