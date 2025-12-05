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
    <title>Eventi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Eventi Javascript</h1>
    <button id="click-me-button">Rosso</button>
    <button id="giallo">giallo</button>
    <button id="blu">blu</button>
    <?php
        $numeroDiv = 20;
        for ($i = 1; $i <= $numeroDiv; $i++) {
            printDiv("", "giallo");
        }
    ?>
    <script src="events.js"></script>
</body>
</html>