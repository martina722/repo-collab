<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=prenotazioni;charset=utf8mb4", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    $elencoRegioni = $pdo->query("SELECT regione FROM regioni ORDER BY regione ASC")->fetchAll();
} catch (Exception $e) { die("Errore: " . $e->getMessage()); }

$risultati = [];
if (!empty($_GET['regione'])) {
    $cliente = trim($_GET['clienti'] ?? '');
    $regione = $_GET['regione'];

    $sql = "SELECT * FROM clienti WHERE citta = ?";
    $params = [$regione];

    if ($cliente !== '') {
        $sql .= " AND (CONCAT(nome, ' ', cognome) LIKE ? OR CONCAT(cognome, ' ', nome) LIKE ?)";
        $params[] = "%$cliente%";
        $params[] = "%$cliente%";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $risultati = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Ricerca Clienti</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .container { background: white; max-width: 700px; margin: auto; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        input, select { padding: 8px; margin: 5px 0; width: 100%; box-sizing: border-box; }
        button { background: #007bff; color: white; border: none; padding: 10px; cursor: pointer; border-radius: 4px; width: 100%; }
        button:hover { background: #0056b3; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #ddd; }
        th { background: #f8f9fa; }
        .reset { display: block; text-align: center; margin-top: 10px; color: #666; text-decoration: none; font-size: 14px; }
    </style>
    <script>
        function valida() {
            if (document.getElementById("r").value == "") {
                alert("nessuna regione selezionata");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Ricerca Clienti</h2>
    <form method="GET" onsubmit="return valida()">
        <label>Nome e Cognome:</label>
        <input type="text" name="clienti" placeholder="inserisci nome/cognome ..." value="<?= htmlspecialchars($_GET['clienti'] ?? '') ?>">
        
        <label>Regione:</label>
        <select name="regione" id="r">
            <option value="">-- Seleziona regione --</option>
            <?php foreach ($elencoRegioni as $reg): ?>
                <option value="<?= $reg['regione'] ?>" <?= (isset($_GET['regione']) && $_GET['regione'] == $reg['regione']) ? 'selected' : '' ?>>
                    <?= $reg['regione'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Cerca</button>
        <a href="?" class="reset">Reset</a>
    </form>

    <?php if (isset($_GET['regione'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Nome e cognome</th>
                    <th>Regione</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($risultati): ?>
                    <?php foreach ($risultati as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nome'] . " " . $row['cognome']) ?></td>
                            <td><?= htmlspecialchars($row['citta']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="2">Nessun risultato trovato.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>