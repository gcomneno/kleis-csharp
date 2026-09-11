<?php
require_once __DIR__ . '/include/db.php';
require_once __DIR__ . '/include/cart.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Metodo non consentito');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);

if ($id === false || $id === null) {
    http_response_code(422);
    exit('Codice prodotto non valido');
}

try {
    php5_add_to_cart($pdo, $id);
} catch (InvalidArgumentException $exception) {
    http_response_code(404);
    exit(htmlspecialchars($exception->getMessage(), ENT_QUOTES, 'UTF-8'));
}

header('Location: carrello.php');
exit;
