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
        <label for="regione">cerca regione:</label>
        <input type="text" name="regione" id="regione" required>
        <input type="submit" value="Cerca">
    </form>
    <?php
    $nome_da_cercare = $_GET['regione'];
    require_once '../lib/libreria.php';
    $dbConnection = connectDatabase('prenotazioni');
    $query1 = 'SELECT regioni.regione
    FROM regioni
    WHERE regione = "' . $nome_da_cercare . '"';
    $result1 = mysqli_query($dbConnection, $query1);
    
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

    // se nome da cercare è stato inserito mostra i risultati 
    if (!empty($nome_da_cercare)) {
        while ($row = mysqli_fetch_assoc($result1)) {
            $clientiDivContent = '<h2>' . $row['regione'] . '</h2><p>Num. prenotazioni: ' . $row['totale_prenotazioni'] . '<br>importo totale: ' . $row['totale_importo'] . '<br>saldo totale: ' . $row['totale_saldo'] . '</p>';
            printDiv($clientiDivContent, 'cliente display-inline-block');
        }
    }   else {
            while ($row = mysqli_fetch_assoc($result)) {
            $clientiDivContent = '<h2>' . $row['regione'] . '</h2><p>Num. prenotazioni: ' . $row['totale_prenotazioni'] . '<br>importo totale: ' . $row['totale_importo'] . '<br>saldo totale: ' . $row['totale_saldo'] . '</p>';
            printDiv($clientiDivContent, 'cliente display-inline-block');
        }
    }

    ?>
</body>
</html>