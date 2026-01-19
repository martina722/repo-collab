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
    <form action="" method="post">
    <select id="regione_scelta" name="regione_scelta">
        <option value="">-- Seleziona --</option>
        <option value="emilia_romagna">emilia romagna</option>
        <option value="lombardia">lombardia</option>
        <option value="piemonte">piemonte</option>
        <option value="veneto">veneto</option>
        <option value="toscana">toscana</option>
        <option value="lazio">lazio</option>
        <option value="campania">campania</option>
        <option value="sicilia">sicilia</option>
        <option value="sardegna">sardegna</option>
        <option value="puglia">puglia</option>
        <option value="calabria">calabria</option>
        <option value="abruzzo">abruzzo</option>
        <option value="marche">marche</option>
        <option value="umbria">umbria</option>
        <option value="friuli_venezia_giulia">friuli venezia giulia</option>
        <option value="trentino_alto_adige">trentino alto adige</option>
        <option value="valle_d_aosta">valle d'aosta</option>
        <option value="liguria">liguria</option>
        <option value="basilicata">basilicata</option>
        <option value="molise">molise</option>        
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

        // 5. Generare i link di paginazione indietro/avanti
        if ($pagina_corrente > 1) {
            echo '<a href="?page=' . ($pagina_corrente - 1) . '">Indietro</a> - ';
        } 
        if ($pagina_corrente < $tot_pagine) {
            echo '<a href="?page=' . ($pagina_corrente + 1) . '">Avanti</a><br><br>';
        }

        echo '<br><br>';

        $regione_selezionata = isset($_POST['regione_scelta']) ? $_POST['regione_scelta'] : '';

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
