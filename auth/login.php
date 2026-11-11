<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi - StayEasy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="container">

    <h1>Accedi a StayEasy</h1>

    <form method="POST" action="login_process.php">

        <input type="email" name="email"
               placeholder="La tua email" required>

        <input type="password" name="password"
               placeholder="La tua password" required>

        <button type="submit">Accedi</button>

    </form>

    <p>
        Non hai un account?
        <a href="register.php">Registrati</a>
    </p>

    <a href="../index.php">Torna alla homepage</a>

</div>

</body>
</html>

