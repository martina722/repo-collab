<?php

?>

<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Page</title>
    <link rel="stylesheet" href="page.css">
</head>
<body>
    <h1>Pagina di prova</h1>
    <div class="numerati">
        <?php 
        // dato un numero 15 crea 15 div numerati da 1 a 15
        $numero_div = 15;
        for ($i = 1; $i <= $numero_div; $i++) {
            echo "<div>Questo è il div numero $i</div>";
        }
        ?>
    </div>
    <div class="ultimo">Questa è la fine della pagina</div>
</body>
