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
    <form action="submit" method="post">
    <select id="regione_scelta" nome="scelta">
        <option value="">-- seleziona --</option>
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
<?php
    $regione_selezionata = isset($_GET['regione_scelta']) ? $_GET['regione_scelta'] : '';


        require_once '../lib/libreria.php';

         //connessione al database
        $dbConnection = connectDatabase('prenotazioni');

        //query
        $query = 'SELECT clienti.nome, clienti.cognome, regioni.regione, regioni.area_geografica, citta.citta
        FROM citta
        JOIN regioni ON regioni.ID_regione = citta.regione
        JOIN clienti ON clienti.citta = citta.id_citta';
        $result = mysqli_query($dbConnection, $query);
        $queryFiltrata = 'SELECT clienti.nome, clienti.cognome, regioni.regione, regioni.area_geografica, citta.citta
        FROM citta
        JOIN regioni ON regioni.ID_regione = citta.regione
        JOIN clienti ON clienti.citta = citta.id_citta
        WHERE regioni.regione LIKE "%' . $regione_selezionata . '%"';
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
