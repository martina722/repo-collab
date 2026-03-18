<?php
    // 1. Logica di connessione e recupero dati (in cima)
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "prenotazioni";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $sql = "SELECT id_citta, citta FROM citta";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento Clienti</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 80px; }
        .buttons { text-decoration: none; margin: 0;}
        .btn-salva { background-color: green ;}
        .btn-annulla { background-color: red ;}
    </style>
</head>
<body>

    <h1>Inserimento clienti</h1>
    <h2>Dati</h2>

    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>
        <label for="cognome">Cognome:</label>
        <input type="text" id="cognome" name="cognome" required><br>
        <label for="citta">Città:</label>
        <select id="citta" name="citta" required>
            <option value="">-- Seleziona Città --</option>
            <?php
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['id_citta']) . "'>" . htmlspecialchars($row['citta']) . "</option>";
                    }
                } else {
                    echo "<option value=''>Nessuna città trovata</option>";
                }
            ?>
        </select><br>
        <button type="reset" class="btn-annulla" onclick="document.querySelector('form').reset();">Annulla</button>
        <button type="submit" class="btn-salva">Salva</button>
    </form>

    <?php
        // leggo il campo nome dal parametro POST
        $nome_nuovo_cliente = isset($_POST['nome']) ? trim($_POST['nome']) : '';

        // leggo il campo cognome dal parametro POST
        $cognome_nuovo_cliente = isset($_POST['cognome']) ? trim($_POST['cognome']) : '';

        //leggo l'ID della citta dal parametro POST
        $citta_id = isset($_POST['citta']) ? intval($_POST['citta']) : 0;

        //eseguo una query per caricare i dati del nuovo cliente nel database
        $nome_nuovo_cliente = mysqli_real_escape_string($conn, $nome_nuovo_cliente);
        $cognome_nuovo_cliente = mysqli_real_escape_string($conn, $cognome_nuovo_cliente);

        $query = "INSERT INTO clienti (nome, cognome, citta)
        VALUES ('" . $nome_nuovo_cliente . "', '" . $cognome_nuovo_cliente . "', " . $citta_id . ")";

        $result = mysqli_query($conn, $query);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($result) {
                echo "<p style='color:green;'>Cliente inserito con successo!</p>";
            } else {
                echo "<p style='color:red;'>Errore nell'inserimento del cliente: " . mysqli_error($db_connection) . "</p>";
            }
         }
    ?>
</body>
</html>

