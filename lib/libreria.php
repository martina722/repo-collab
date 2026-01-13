<?php
/**
 * Stampa un div con del testo e una classe specificata
 * @param string $text Il testo da inserire nel div
 * @param string $class La classe CSS da assegnare al div
 * @return void
 */
function printDiv($text, $class, $id = "") {
    echo "<div id ='" . $id . "' class='" . $class . "'>" . $text . "</div>";
};

/**
 * Connects a database
 * @param string $host the database host
 * @param string $username the database username
 * @param string $password the database password
 * @param string $dbname the database name
 * @return mysqli the connection object
 */
function connectDatabase($dbname, $host = 'localhost', $username = 'root', $password = '') {
	$mysqli = mysqli_connect($host, $username, $password, $dbname);
	if (!$mysqli) {
		die("Connection failed: " . mysqli_connect_error());
	}
	return $mysqli;
};

/**
 * Generatore di un numero random di div con classe e testo specifici
 * @param int $min Numero minimo di div da generare
 * @param int $max Numero massimo di div da generare
 * @param string $class La classe CSS da assegnare al div
 * @param string $text Il testo da inserire nel div
 * @return void
 */
function genRandomDivs($min, $max, $class, $text = "") {
    $numero = rand($min, $max);
        for ($i = 1; $i <= $numero; $i++) {
            printDiv($text, $class);
        }
}
?>