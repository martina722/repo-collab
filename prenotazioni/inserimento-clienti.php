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

    <form action="salva.php" method="POST">
        
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required>
        </div>

        <div class="form-group">
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
            </select>
        </div>
        
        
    </form>
    <?php
    $conn->close();
    ?>
</body>
<div class="buttons">
    <button type="reset" class="btn-annulla">Annulla</button>
    <button type="submit" class="btn-salva">Salva</button>
</div>
</html>