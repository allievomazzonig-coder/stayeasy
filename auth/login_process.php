
<?php

session_start();

require_once __DIR__ . '/../config/database.php';

// Controllo metodo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

// Recupero dati
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

// Controllo campi vuoti
if ($email === '' || $password === '') {
    $_SESSION['login_error'] = 'Compila tutti i campi.';
    header('Location: login.php');
    exit;
}

// Controllo formato email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['login_error'] = 'Inserisci un indirizzo email valido.';
    header('Location: login.php');
    exit;
}

try {

    // Ricerca utente nel database
    $sql = "SELECT id, nome, cognome, email, password, ruolo
            FROM users
            WHERE email = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $utente = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controllo esistenza utente e password
    if (!$utente || !password_verify($password, $utente['password'])) {

        $_SESSION['login_error'] = 'Email o password non corretti.';
        header('Location: login.php');
        exit;
    }

    // Rigenera ID sessione per sicurezza
    session_regenerate_id(true);

    // Salvataggio dati utente nella sessione
    $_SESSION['user_id'] = $utente['id'];
    $_SESSION['nome'] = $utente['nome'];
    $_SESSION['cognome'] = $utente['cognome'];
    $_SESSION['email'] = $utente['email'];
    $_SESSION['ruolo'] = $utente['ruolo'];

    // Reindirizzamento in base al ruolo
    switch ($utente['ruolo']) {

        case 'client':
            header('Location: ../client/dashboard.php');
            break;

        case 'host':
            header('Location: ../host/dashboard.php');
            break;

        case 'both':
            header('Location: ../dashboard.php');
            break;

        default:
            session_unset();
            session_destroy();

            header('Location: login.php');
            exit;
    }

    exit;

} catch (PDOException $e) {

    error_log($e->getMessage());

    $_SESSION['login_error'] = 'Errore durante il login. Riprova più tardi.';

    header('Location: login.php');
    exit;
}