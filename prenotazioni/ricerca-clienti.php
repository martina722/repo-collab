<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=prenotazioni;charset=utf8mb4", "root", "", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    $elencoRegioni = $pdo->query("SELECT regione FROM regioni ORDER BY regione ASC")->fetchAll();
} catch (Exception $e) { die("Errore: " . $e->getMessage()); }

$risultati = [];
$erroreCliente = '';
if (!empty($_GET['regione'])) {
    $cliente = trim($_GET['clienti'] ?? '');
    $regione = $_GET['regione'];

    if ($cliente === '') {
        $erroreCliente = 'Inserire il filtro per il cliente.';
    } else {
        $sql = "SELECT * FROM clienti WHERE citta = ?";
        $params = [$regione];

        $sql .= " AND (CONCAT(nome, ' ', cognome) LIKE ? OR CONCAT(cognome, ' ', nome) LIKE ?)";
        $params[] = "%$cliente%";
        $params[] = "%$cliente%";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $risultati = $stmt->fetchAll();
    }
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
            var regione = document.getElementById("r").value;
            var cliente = document.getElementById("clienti").value.trim();
            if (regione == "") {
                alert("Nessuna regione selezionata");
                return false;
            }
            if (cliente == "") {
                alert("Inserire il filtro per il cliente");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<div class="container">
    <h2 style="display: flex; align-items: center; gap: 10px; color: #d12a2a;">
    <svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16" style="color: #007bff;">
        <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5"/>
        <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96q.04-.245.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 1 1 12z"/>
    </svg>
        Ricerca Clienti
    </h2>
    <form method="GET" onsubmit="return valida()">
        <label>Nome e Cognome:</label>
        <input type="text" id="clienti" name="clienti" placeholder="inserisci nome/cognome ..." value="<?= htmlspecialchars($_GET['clienti'] ?? '') ?>">
        <?php if ($erroreCliente !== ''): ?>
            <div style="color: #d8000c; background: #ffd2d2; border: 1px solid #d8000c; padding: 8px; margin: 8px 0; border-radius: 4px;">
                <?= htmlspecialchars($erroreCliente) ?>
            </div>
        <?php endif; ?>
        
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