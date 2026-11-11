<?php

require_once 'config/database.php';

// Recuperiamo gli immobili dal database
$sql = "SELECT * FROM immobili WHERE disponibile = 1";

$stmt = $pdo->query($sql);

$immobili = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>StayEasy - Case in affitto</title>

    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<header>
	  <div class="logo">StayEasy</div>

    <nav class="main-nav">
        <a href="index.php">Home</a>
        <a href="#immobili">Trova una casa</a>
    </nav>

    <div class="auth-buttons">
        <a href="auth/login.php" class="btn-login">Accedi</a>
        <a href="auth/register.php" class="btn-register">Registrati</a>
    </div>    
</header>

<div class="container">

    <h1>Trova la tua prossima casa</h1>

    <p>Scopri gli appartamenti disponibili in tutta Italia.</p>

    <div class="search">
        <input type="text" placeholder="Dove vuoi abitare?">
        <button>Cerca</button>
    </div>

    <h2>Immobili disponibili</h2>

    <div class="properties" id="immobili">

        <?php foreach ($immobili as $casa): ?>

            <div class="property">

                <img src="images/<?php echo htmlspecialchars($casa['immagine']); ?>"
                     alt="Foto appartamento">

                <h3>
                    <?php echo htmlspecialchars($casa['titolo']); ?>
                </h3>

                <p>
                    <?php echo htmlspecialchars($casa['citta']); ?>
                </p>

                <p>
                    <?php echo $casa['camere']; ?> camere |
                    <?php echo $casa['bagni']; ?> bagni |
                    <?php echo $casa['metratura']; ?> m²
                </p>

                <p class="price">
                    €<?php echo number_format($casa['prezzo'], 2, ',', '.'); ?>/mese
                </p>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>

