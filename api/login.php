<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit(json_encode(['errore' => 'Metodo non consentito']));
}

$input    = json_decode(file_get_contents('php://input'), true) ?? [];
$email    = trim($input['email'] ?? '');
$password = $input['password'] ?? '';

if ($email === '' || $password === '') {
    http_response_code(400);
    exit(json_encode(['errore' => 'Email e password obbligatorie']));
}

// ADATTA nome tabella e colonne al tuo database
$stmt = $pdo->prepare('SELECT id, email, password FROM utenti WHERE email = ?');
$stmt->execute([$email]);
$utente = $stmt->fetch();

if (!$utente || !password_verify($password, $utente['password'])) {
    http_response_code(401);
    exit(json_encode(['errore' => 'Credenziali non valide']));
}

echo json_encode([
    'successo' => true,
    'utente'   => ['id' => $utente['id'], 'email' => $utente['email']],
]);