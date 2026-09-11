<?php

$dbHost = getenv('PHP5_DB_HOST') ?: 'localhost';
$dbName = getenv('PHP5_DB_NAME') ?: 'php5_shop_lab';
$dbUser = getenv('PHP5_DB_USER') ?: 'php5_lab';
$dbPassword = getenv('PHP5_DB_PASSWORD');

if ($dbPassword === false) {
    throw new RuntimeException('PHP5_DB_PASSWORD is required');
}

$pdo = new PDO(
    "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4",
    $dbUser,
    $dbPassword,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
);
