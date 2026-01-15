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
        $query = 'SELECT clienti.nome, clienti.cognome, regioni.regione, aree_geografiche.area_geografica, citta.citta
            FROM clienti
            JOIN citta ON citta.id_citta = clienti.citta
            JOIN aree_geografiche ON aree_geografiche.id_area = citta.area_geografica
            JOIN regioni ON regioni.id_regione = aree_geografiche.regione';
        $result = mysqli_query($dbConnection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $clientiDivContent = '<h2>' . $row['nome'] . ' ' . $row['cognome'] . '</h2><p>' . $row['regione'] . '<br>' . $row['area_geografica'] . '<br>' . $row['citta'] . '</p>';
            printDiv($clientiDivContent, 'cliente');
        }
    ?>
</body>
</html>
