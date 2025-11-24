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
</head>
<body>
    <h1>CSS casuali!!!</h1>
    <div class="contenitore-div">
        <?php
        for ($i = 1; $i <= 10; $i++) :
            if ($i % 2 == 0) :
                echo printDiv("questo è un div pari", "contenitore-div");
                else : echo printDiv("questo è un div disapri", "contenitore-div");
            endif;
        endfor;
        ?>
        
</body>
</html>