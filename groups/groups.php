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
    <?php
        $numero = rand(5, 10);
        for ($i = 1; $i <= $numero; $i++) {
            printDiv("", "primo-gruppo tutti");
        }
    ?>
    <h2>
        Secondo gruppo
    </h2>
    <?php
        genRandomDiv(10, 15, "secondo-gruppo tutti");
    ?>
    <script src="groups.js"></script>
</body>
</html>