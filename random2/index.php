<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="rosso">Contenuti a caso</h1>
    <div class="casuali">
        <?php
        $numero = rand(10, 30);
        for ($i = 1; $i <= $numero; $i++) {
            if ($i % 2 == 0) {
                echo "<div>io sono pari ($i)</div>";
            } else {
                echo "<div>io sono dispari ($i)</div>";
            }
        }
        ?>
    </div>
    <div class="fine">fine pagina</div>
</body>
</html>