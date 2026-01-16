<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>regioni</title>
    <link rel ="stylesheet" href="style.css">
</head>
<body>
    <h1>Regioni</h1>
    <form method="get">
        <label for="regione_inserita">cerca regione:</label>
        <input type="text" name="regione_inserita" id="regione_inserita" required>
        <input type="submit" value="Cerca">
    </form>
    <br>
    <?php
        // prendo il valore inserito nel form
        $regione_da_cercare = isset($_GET['regione_inserita']) ? $_GET['regione_inserita'] : '';

        require_once '../lib/libreria.php';

        $dbConnection = connectDatabase('prenotazioni');
        
        // query per ottenere le regioni, dove deve calcolare anche il numero totale di prenotazioni in ciascuna regione
        $query = 'SELECT regioni.regione, COUNT(prenotazioni.id_prenotazione) AS totale_prenotazioni,
            ROUND(SUM(prenotazioni.importo), 2) AS totale_importo,
            ROUND(SUM(prenotazioni.importo - prenotazioni.caparra), 2) AS totale_saldo
            FROM regioni
            JOIN citta ON citta.regione = regioni.ID_regione
            JOIN clienti ON clienti.citta = citta.id_citta
            JOIN prenotazioni ON prenotazioni.cliente = clienti.id_cliente
            GROUP BY regioni.regione';
        $result = mysqli_query($dbConnection, $query);
        
        // query per ottenere le regioni filtrate in base al nome inserito
        $query1 = 'SELECT regioni.regione, COUNT(prenotazioni.id_prenotazione) AS totale_prenotazioni,
            ROUND(SUM(prenotazioni.importo), 2) AS totale_importo,
            ROUND(SUM(prenotazioni.importo - prenotazioni.caparra), 2) AS totale_saldo
            FROM regioni
            JOIN citta ON citta.regione = regioni.ID_regione
            JOIN clienti ON clienti.citta = citta.id_citta
            JOIN prenotazioni ON prenotazioni.cliente = clienti.id_cliente
            WHERE regioni.regione = "' . $regione_da_cercare . '"
            GROUP BY regioni.regione';

        $result1 = mysqli_query($dbConnection, $query1);

        // se nome da cercare è stato inserito mostra i risultati 
        if (!empty($regione_da_cercare)) {
            while ($row = mysqli_fetch_assoc($result1)) {
                $regioniDivContent = '<h2>' . $row['regione'] . '</h2><p>Num. prenotazioni: ' . $row['totale_prenotazioni'] . '<br>importo totale: ' . $row['totale_importo'] . '<br>saldo totale: ' . $row['totale_saldo'] . '</p>';
                printDiv($regioniDivContent, 'cliente display-inline-block');
            }
        }   else {
                while ($row = mysqli_fetch_assoc($result)) {
                $regioniDivContent = '<h2>' . $row['regione'] . '</h2><p>Num. prenotazioni: ' . $row['totale_prenotazioni'] . '<br>importo totale: ' . $row['totale_importo'] . '<br>saldo totale: ' . $row['totale_saldo'] . '</p>';
                printDiv($regioniDivContent, 'cliente display-inline-block');
            }
        }
    ?>
</body>
</html>