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
        require_once '../lib/libreria.php';

         //inizializza la connessione al database tramite funzione contenuta nella libreria
        $dbConnection = connectDatabase('prenotazioni');

        //esegui la query che legge la tabella clienti
        $query = 'SELECT clienti.nome, clienti.cognome, prenotazioni.arrivo, citta.citta, prenotazioni.importo, prenotazioni.caparra, ROUND(prenotazioni.importo - prenotazioni.caparra) AS saldo
            FROM clienti
            JOIN citta ON citta.id_citta = clienti.citta
            JOIN prenotazioni  ON prenotazioni.cliente = clienti.id_cliente';
        $result = mysqli_query($dbConnection, $query);

        //ciclo sulle righe restituite e stampo il valore di ogni riga
        while ($row = mysqli_fetch_assoc($result)) {
            $clientiDivContent = '<h2>' . $row['arrivo'] . '</h2><p>' . $row['nome'] . ' ' . $row['cognome'] . '<br>' . $row['citta'] . '<br> Importo prenotazione: ' . $row['importo'] . '<br> Caparra: ' . $row['caparra'] . '<br> Saldo: ' . $row['saldo'] . '</p>';
            printDiv($clientiDivContent, 'prenotazione');
        }
    ?>
</body>
</html>