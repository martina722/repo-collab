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
    <form action="" method="get">
    <select id="regione_scelta" name="regione_scelta">
        <option value="">-- Seleziona una regione --</option>
        <option value="emilia_romagna">Emilia Romagna</option>
        <option value="lombardia">Lombardia</option>
        <option value="piemonte">Piemonte</option>
        <option value="veneto">Veneto</option>
        <option value="toscana">Toscana</option>
        <option value="lazio">Lazio</option>
        <option value="campania">Campania</option>
        <option value="sicilia">Sicilia</option>
        <option value="sardegna">Sardegna</option>
        <option value="puglia">Puglia</option>
        <option value="calabria">Calabria</option>
        <option value="abruzzo">Abruzzo</option>
        <option value="marche">Marche</option>
        <option value="umbria">Umbria</option>
        <option value="friuli_venezia_giulia">Friuli Venezia Giulia</option>
        <option value="trentino_alto_adige">Trentino Alto Adige</option>
        <option value="valle_d_aosta">Valle d'Aosta</option>
        <option value="liguria">Liguria</option>
        <option value="basilicata">Basilicata</option>
        <option value="molise">Molise</option>        
    </select>
    <input type="submit" value="Invia">
</form>
<br><br>
    <?php
        require_once '../lib/libreria.php';

         //connessione al database
        $dbConnection = connectDatabase('prenotazioni');

        // 1. Contare i record
        $sql_count = "SELECT COUNT(*) FROM clienti";

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
        $sql_dati = "SELECT * FROM clienti ORDER BY id DESC LIMIT $offset, $risultati_per_pagina"; // ... (esegui query e itera sui risultati)
        $regione_selezionata = isset($_GET['regione_scelta']) ? $_GET['regione_scelta'] : '';

        // 5. Generare i link di paginazione indietro/avanti
        if ($pagina_corrente > 1) {
            echo '<a href="?page=' . ($pagina_corrente - 1) . '&regione_scelta=' . $regione_selezionata . '">Indietro</a> - ';
        } 
        if ($pagina_corrente < $tot_pagine) {
            echo '<a href="?page=' . ($pagina_corrente + 1) . '&regione_scelta=' . $regione_selezionata . '">Avanti</a><br><br>';
        }

        echo '<br>';
        //stampa il numero totale di clienti a seconda della regione selezionata
        $sql_count_filtrato = "SELECT COUNT(*) 
            FROM citta
            JOIN regioni ON regioni.ID_regione = citta.regione
            JOIN clienti ON clienti.citta = citta.id_citta
            WHERE regioni.regione LIKE '%" . $regione_selezionata . "%'";
        $tot_records_result_filtrato = mysqli_query($dbConnection, $sql_count_filtrato);
        $tot_records_row_filtrato = mysqli_fetch_array($tot_records_result_filtrato);
        $tot_records_filtrato = $tot_records_row_filtrato[0];

        if (!empty($regione_selezionata)) {
            echo 'Totale clienti nella regione ' . ucfirst(str_replace('_', ' ', $regione_selezionata)) . ': ' . $tot_records_filtrato . '<br><br>';
        } else {
            echo 'Totale clienti: ' . $tot_records . '<br><br>';
        }
        
        //query
        $query = "SELECT clienti.nome, clienti.cognome, regioni.regione, regioni.area_geografica, citta.citta
        FROM citta
        JOIN regioni ON regioni.ID_regione = citta.regione
        JOIN clienti ON clienti.citta = citta.id_citta
        LIMIT $offset, $risultati_per_pagina";
        $result = mysqli_query($dbConnection, $query);

        $queryFiltrata = "SELECT clienti.nome, clienti.cognome, regioni.regione, regioni.area_geografica, citta.citta
        FROM citta
        JOIN regioni ON regioni.ID_regione = citta.regione
        JOIN clienti ON clienti.citta = citta.id_citta
        WHERE regioni.regione LIKE '%" . $regione_selezionata . "%'
        LIMIT $offset, $risultati_per_pagina";
        $resultFiltrato = mysqli_query($dbConnection, $queryFiltrata);

        if (!empty($regione_selezionata)) {
            while ($row = mysqli_fetch_assoc($resultFiltrato)) {
            $clientiDivContent = '<h2>' . $row['nome'] . ' ' . $row['cognome'] . '</h2><p>REGIONE: ' . $row['regione'] . '<br>AREA GEOGRAFICA: ' . $row['area_geografica'] . '<br>CITTA: ' . $row['citta'] . '</p>';
            printDiv($clientiDivContent, 'cliente display-inline-block');
        } 
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
            $clientiDivContent = '<h2>' . $row['nome'] . ' ' . $row['cognome'] . '</h2><p>REGIONE: ' . $row['regione'] . '<br>AREA GEOGRAFICA: ' . $row['area_geografica'] . '<br>CITTA: ' . $row['citta'] . '</p>';
            printDiv($clientiDivContent, 'cliente display-inline-block');
        }
        }
    ?>
</body>
</html>
