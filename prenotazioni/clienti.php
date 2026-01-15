<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clienti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>
        Clienti
    </h1>
    <?php
        require_once '../lib/libreria.php';

         //connessione al database
        $dbConnection = connectDatabase('prenotazioni');

        //query
        $query = 'SELECT clienti.nome, clienti.cognome, regioni.regione, regioni.area_geografica, citta.citta
        FROM citta
        JOIN regioni ON regioni.ID_regione = citta.regione
        JOIN clienti ON clienti.citta = citta.id_citta';
        $result = mysqli_query($dbConnection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $clientiDivContent = '<h2>' . $row['nome'] . ' ' . $row['cognome'] . '</h2><p>REGIONE: ' . $row['regione'] . '<br>AREA GEOGRAFICA: ' . $row['area_geografica'] . '<br>CITTA: ' . $row['citta'] . '</p>';
            printDiv($clientiDivContent, 'cliente display-inline-block');
        }
    ?>
</body>
</html>
