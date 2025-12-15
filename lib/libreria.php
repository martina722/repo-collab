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

/**
 * Generatore di div random con classe e testo specifici
 * @param int $min Numero minimo di div da generare
 * @param int $max Numero massimo di div da generare
 * @param string $class La classe CSS da assegnare al div
 * @param string $text Il testo da inserire nel div
 * @return void
 */
function genRandomDiv($min, $max, $class, $text = "") {
    $numero = rand($min, $max);
        for ($i = 1; $i <= $numero; $i++) {
            echo "<div class='" . $class . "'>" . $text . "</div>";
        }
}
?>