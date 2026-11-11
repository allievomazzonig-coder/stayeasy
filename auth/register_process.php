<?php

session_start();

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$cognome = trim($_POST['cognome'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$ruolo = $_POST['ruolo'] ?? 'client';

$ruoli_validi = ['client', 'host', 'both'];

if (
    empty($nome) ||
    empty($cognome) ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) ||
    strlen($password) < 8 ||
    !in_array($ruolo, $ruoli_validi, true)
) {
    exit('Dati non validi. La password deve avere almeno 8 caratteri.');
}

try {

    $controllo = $pdo->prepare(
        "SELECT id FROM users WHERE email = ?"
    );

    $controllo->execute([$email]);

    if ($controllo->fetch()) {
        exit('Questa email è già registrata.');
    }

    $password_hash = password_hash(
        $password,
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO users
            (nome, cognome, email, password, ruolo)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $nome,
        $cognome,
        $email,
        $password_hash,
        $ruolo
    ]);

    header('Location: login.php?registrazione=successo');
    exit;

} catch (PDOException $e) {

    error_log($e->getMessage());
    http_response_code(500);
    exit('Errore durante la registrazione.');

}

