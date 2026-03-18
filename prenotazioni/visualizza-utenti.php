<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizzazione Utenti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <p><a href="ricerca-utenti.php">Torna alla ricerca clienti</a></p>
    <?php
    $nome_da_cercare = $_GET['nome'];
    require_once '../lib/libreria.php';
    $db_connection = connectDatabase('prenotazioni');

    $query = 'SELECT *
    FROM clienti
    WHERE nome = "' . $nome_da_cercare . '"';
    $result = mysqli_query($db_connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="display-inline-block"><h2>Nome e Cognome:</h2> ' . $row['nome'] . ' ' . $row['cognome'] . '</div>';
    }
?>
</body>
</html>