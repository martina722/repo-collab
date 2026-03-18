<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza utenti</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Ricerca Utenti</h1>
    <form action="visualizza-utenti.php" method="get">
        <label for="nome">Cerca utente per nome:</label>
        <input type="text" name="nome" id="nome" required>
        <input type="submit" value="Cerca">
    </form>
</body>
</html>