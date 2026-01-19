<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazioni</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>
        Prenotazioni
    </h1>
    <?php
        require_once '../lib/libreria.php';

         //inizializza la connessione al database tramite funzione contenuta nella libreria
        $dbConnection = connectDatabase('prenotazioni');

        // 1. Contare i record
        $sql_count = "SELECT COUNT(*) FROM prenotazioni";

        // 2. Definire parametri
        $risultati_per_pagina = 50;
        $pagina_corrente = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Ottieni la pagina o imposta a 1
        $tot_records_result = mysqli_query($dbConnection, $sql_count);
        $tot_records_row = mysqli_fetch_array($tot_records_result);
        $tot_records = $tot_records_row[0];


        // 3. Calcolare pagine e offset
        $tot_pagine = ceil($tot_records / $risultati_per_pagina);
        $offset = ($pagina_corrente - 1) * $risultati_per_pagina;

        // 4. Recuperare i dati
        $sql_dati = "SELECT * FROM prenotazioni ORDER BY id DESC LIMIT $offset, $risultati_per_pagina"; // ... (esegui query e itera sui risultati)

        // 5. Generare i link di paginazione indietro/avanti
        if ($pagina_corrente > 1) {
            echo '<a href="?page=' . ($pagina_corrente - 1) . '">Indietro</a> - ';
        }
        if ($pagina_corrente < $tot_pagine) {
            echo '<a href="?page=' . ($pagina_corrente + 1) . '">Avanti</a><br><br>';
        }

        //esegui la query che legge la tabella clienti
        $query = "SELECT clienti.nome, clienti.cognome, prenotazioni.arrivo, citta.citta, prenotazioni.importo, prenotazioni.caparra, ROUND(prenotazioni.importo - prenotazioni.caparra, 2) AS saldo
            FROM clienti
            JOIN citta ON citta.id_citta = clienti.citta
            JOIN prenotazioni  ON prenotazioni.cliente = clienti.id_cliente
            LIMIT $offset, $risultati_per_pagina";
        $result = mysqli_query($dbConnection, $query);

        //ciclo sulle righe restituite e stampo il valore di ogni riga
        while ($row = mysqli_fetch_assoc($result)) {
            $clientiDivContent = '<h2>' . $row['arrivo'] . '</h2><p>' . $row['nome'] . ' ' . $row['cognome'] . '<br>' . $row['citta'] . '<br> Importo prenotazione: ' . $row['importo'] . '<br> Caparra: ' . $row['caparra'] . '<br> <span class="saldo">Saldo: ' . $row['saldo'] . '</span></p>';
            printDiv($clientiDivContent, 'prenotazione display-inline-block');
        }
    ?>
</body>
</html>