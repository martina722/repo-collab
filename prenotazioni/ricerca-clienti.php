<?php
$host = 'localhost';
$db   = 'prenotazioni';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $stmtRegioni = $pdo->query("SELECT regione FROM regioni ORDER BY regione ASC");
    $elencoRegioni = $stmtRegioni->fetchAll();
} catch (\PDOException $e) {
    die("Errore di connessione: " . $e->getMessage());
}

$risultati = [];
$ricercaEffettuata = false;

if (!empty($_GET['clienti']) || !empty($_GET['regione'])) {
    $ricercaEffettuata = true;
    $clienteCercato = trim($_GET['clienti'] ?? '');
    $regioneCercata = $_GET['regione'] ?? '';

    $sql = "SELECT * FROM clienti WHERE 1=1";
    $params = [];

    if ($clienteCercato !== '') {
        $sql .= " AND (CONCAT(nome, ' ', cognome) LIKE ? OR CONCAT(cognome, ' ', nome) LIKE ?)";
        $params[] = "%$clienteCercato%";
        $params[] = "%$clienteCercato%";
    }

    if ($regioneCercata !== '') {
        $sql .= " AND citta = ?"; 
        $params[] = $regioneCercata;
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
</head>
<body style="font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #f0f2f5; margin: 0; padding: 40px; display: flex; justify-content: center;">

    <div style="width: 100%; max-width: 900px; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
        
        <h2 style="color: #1a73e8; margin-top: 0; text-align: center; font-size: 28px;">Gestione Clienti</h2>

        <div style="background: #f8f9fa; padding: 25px; border-radius: 10px; border: 1px solid #e9ecef; margin-bottom: 30px;">
            <form method="GET" action="" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px; align-items: end;">
                
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Nome/Cognome:</label>
                    <input type="text" name="clienti" value="<?= htmlspecialchars($_GET['clienti'] ?? '') ?>" placeholder="Cerca cliente..." 
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box;">
                </div>

                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #555;">Regione:</label>
                    <select name="regione" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; background: white;">
                        <option value="">-- Tutte le regioni --</option>
                        <?php foreach ($elencoRegioni as $r): ?>
                            <option value="<?= htmlspecialchars($r['regione']) ?>" <?= (isset($_GET['regione']) && $_GET['regione'] == $r['regione']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($r['regione']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div style="display: flex; gap: 10px;">
                    <button type="submit" style="background: #1a73e8; color: white; border: none; padding: 12px 25px; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s;">Cerca</button>
                    <a href="?" style="background: #dee2e6; color: #495057; padding: 12px 15px; border-radius: 6px; text-decoration: none; font-size: 14px; display: flex; align-items: center;">Reset</a>
                </div>
            </form>
        </div>

        <?php if ($ricercaEffettuata): ?>
            <h3 style="border-left: 5px solid #1a73e8; padding-left: 15px; color: #333;">Risultati della ricerca</h3>
            
            <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <thead>
                    <tr style="background: #1a73e8; color: white;">
                        <th style="padding: 15px; text-align: left; border-top-left-radius: 8px;">Nome Cognome</th>
                        <th style="padding: 15px; text-align: left;">Regione (Città)</th>
                        <th style="padding: 15px; text-align: left; border-top-right-radius: 8px;">Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($risultati) > 0): ?>
                        <?php foreach ($risultati as $index => $row): ?>
                            <tr style="background-color: <?= $index % 2 == 0 ? '#ffffff' : '#f8f9fa' ?>; border-bottom: 1px solid #eee;">
                                <td style="padding: 15px; font-weight: 500; color: #2c3e50;">
                                    <?= htmlspecialchars($row['nome'] . ' ' . $row['cognome']) ?>
                                </td>
                                <td style="padding: 15px;">
                                    <span style="background: #e8f0fe; color: #1a73e8; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: bold;">
                                        <?= htmlspecialchars($row['citta'] ?? 'N/D') ?>
                                    </span>
                                </td>
                                <td style="padding: 15px; color: #666; font-style: italic;">
                                    <?= htmlspecialchars($row['email'] ?? 'N/D') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="padding: 30px; text-align: center; color: #999; font-style: italic;">
                                ❌ Nessun cliente trovato con questi criteri.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</body>
</html>