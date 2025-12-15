<?php
require_once '../lib/libreria.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Eventi Javascript</h1>
    <button id="rosso">Rosso</button>
    <button id="giallo">giallo</button>
    <button id="blu">blu</button>
    <button id="altern">alterna</button>
    <button id="arancione">colore arancione</button>
    <?php
        $numeroDiv = 20;
        for ($i = 1; $i <= $numeroDiv; $i++) {
            printDiv("", "div");
        }
    ?>
    <script src="events.js"></script>
</body>
</html>