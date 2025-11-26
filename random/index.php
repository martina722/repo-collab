<?php
function printDiv($text, $class) {
    echo "<div class='" . $class . "'>" . $text . "</div>";
};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prova</title>

    <!-- collegamento random a diversi file css utilizzando la funzione RAND(<min>,<max>) -->
    <?php 
    $randomCss = rand(1, 3);
    echo "<link rel='stylesheet' href='style_" . $randomCss . ".css'>";
    ?>

</head>
<body>
    <h1>CSS casuali!!!</h1>
    <div>
        <?php
        for ($i = 1; $i <= 10; $i++) :
            if ($i % 2 == 0) :
                echo printDiv("questo è un div pari", "pari");
                else : echo printDiv("questo è un div disapri", "dispari");
            endif;
        endfor;
        ?> 
    </div>
</body>
</html>