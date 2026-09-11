<?php

function php5_session_id(): string
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    return session_id();
}

function php5_add_to_cart(PDO $pdo, int $productId): void
{
    $check = $pdo->prepare('SELECT id FROM brani WHERE id = :id');
    $check->execute(['id' => $productId]);

    if ($check->fetchColumn() === false) {
        throw new InvalidArgumentException('Prodotto non trovato');
    }

    $stmt = $pdo->prepare(
        'INSERT INTO carrello (id_brano, sessionid) VALUES (:id_brano, :sessionid)'
    );
    $stmt->execute([
        'id_brano' => $productId,
        'sessionid' => php5_session_id(),
    ]);
}

function php5_cart_items(PDO $pdo): array
{
    $stmt = $pdo->prepare(
        'SELECT c.id AS cart_row_id,
                b.id,
                b.titolo,
                a.nome AS autore,
                g.nome AS genere,
                b.prezzo
           FROM carrello c
           JOIN brani b ON b.id = c.id_brano
           JOIN autori a ON a.autore_id = b.autore_id
      LEFT JOIN generi g ON g.genere_id = b.genere_id
          WHERE c.sessionid = :sessionid
       ORDER BY c.id'
    );
    $stmt->execute(['sessionid' => php5_session_id()]);

    return $stmt->fetchAll();
}
