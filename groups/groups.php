<?php
require_once '../lib/libreria.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <button id="primo-rosso"> Primo Rosso</button>
    <button id="secondo-rosso"> Secondo Rosso</button>
    <button id="rossi"> Tutti Rosso</button>
    <button id="primo-blu"> Primo Blu</button>
    <button id="secondo-blu"> Secondo Blu</button>
    <button id="blu"> Tutti Blu</button>
    <h2>
        Primo gruppo
    </h2>
    <div class="display-inline">
        <?php
            genRandomDivs(5, 10, "primo-gruppo tutti");
        ?>
    </div>
    <h2>
        Secondo gruppo
    </h2>
    <div class="display-inline">
        <?php
            genRandomDivs(10, 15, "secondo-gruppo tutti");
        ?>
    </div>
    <script src="groups.js"></script>
</body>
</html>