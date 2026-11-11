<?php

$host = "localhost";
$dbname = "stayeasy";
$username = "stayeasy_user";
$password = "CasaStayEasy_2026!";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    

} catch (PDOException $e) {

    die("Errore di connessione: " . $e->getMessage());

}
