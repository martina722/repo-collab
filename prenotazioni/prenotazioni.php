<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazioni</title>
    <link rel="stylesheet" href="prenotazioni.css">
</head>
<body>
    <h1>
        Prenotazioni
    </h1>
    <?php
        require_once '../lib/libreria.php'

         //inizializza la connessione al database tramite funzione contenuta nella libreria libreria
        $dbConnection = connectDatabase('cescot');

        //esegui la query che legge la tabella clienti
        $query = 'SELECT * FROM clienti WHERE';
        $result = mysqli_query($dbConnection, $query);

        //ciclo sulle righe restituite e stampo il valore di ogni riga
        while ($row = mysqli_fetch_assoc($result)) {
            $clientiDivContent = '<h2>' . $row['id'] . '</h2><p>' . $row['nome'] . ' ' . $row['cognome'] . '</p>';
            printDiv($clientiDivContent, 'cliente');
        }
    ?>
</body>
</html>