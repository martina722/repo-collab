<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="rosso">colori</h1>
    <div class="casuali">
        <?php
        $numero = rand(5, 30);
        for ($i = 1; $i <= $numero; $i++) {
            if ($i % 2 == 0) {
                echo "<div> pari ($i) </div>";
                echo "<div> dispari ($i)</div>"
            }
        }
        ?>
    </div>
    <div class="end">fine pagina</div>
</body>
</html>