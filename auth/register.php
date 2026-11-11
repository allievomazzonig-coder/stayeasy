<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrati - StayEasy</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">

    <h1>Crea il tuo account</h1>

    <form method="POST" action="register_process.php">

        <input type="text" name="nome" placeholder="Nome" required>

        <input type="text" name="cognome" placeholder="Cognome" required>

        <input type="email" name="email" placeholder="Email" required>

        <input type="password" name="password" placeholder="Password" required>

        <label>Come vuoi utilizzare StayEasy?</label>

        <select name="ruolo" required>
            <option value="client">Voglio prenotare (Client)</option>
            <option value="host">Voglio pubblicare immobili (Host)</option>
            <option value="both">Entrambi</option>
        </select>

        <button type="submit">Registrati</button>

    </form>

    <p>Hai già un account? <a href="login.php">Accedi</a></p>

</div>

</body>
</html>
