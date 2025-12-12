<?php
/**
 * Stampa un div con del testo e una classe specificata
 * @param string $text Il testo da inserire nel div
 * @param string $class La classe CSS da assegnare al div
 * @return void
 */
function printDiv($text, $class) {
    echo "<div class='" . $class . "'>" . $text . "</div>";
};
?>