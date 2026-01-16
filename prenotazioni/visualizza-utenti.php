<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $nome_da_cercare = $_GET['nome'];
    require_once '../lib/libreria.php';
    $db_connection = connectDatabase('prenotazioni');

    $query = 'SELECT *
    FROM clienti
    WHERE nome = "' . $nome_da_cercare . '"';
    $result = mysqli_query($db_connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo 'Nome: ' . $row['nome'] . ', Cognome: ' . $row['cognome'];
    }
?>
</body>
</html>