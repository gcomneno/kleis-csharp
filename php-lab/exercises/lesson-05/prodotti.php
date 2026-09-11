<?php
require_once __DIR__ . '/include/db.php';

$sql = 'SELECT b.id, b.titolo, a.nome AS autore, g.nome AS genere, b.prezzo
          FROM brani b
          JOIN autori a ON a.autore_id = b.autore_id
     LEFT JOIN generi g ON g.genere_id = b.genere_id
      ORDER BY b.id';
$prodotti = $pdo->query($sql)->fetchAll();
?>
<!doctype html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP 5 — Catalogo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 mb-1">Catalogo</h1>
      <p class="text-secondary mb-0">PHP 5 — carrello associato alla sessione.</p>
    </div>
    <a class="btn btn-outline-primary" href="carrello.php">Apri carrello</a>
  </div>

  <div class="row g-3">
    <?php foreach ($prodotti as $prodotto): ?>
      <div class="col-md-6 col-xl-4">
        <article class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <h2 class="h5"><?= htmlspecialchars($prodotto['titolo'], ENT_QUOTES, 'UTF-8') ?></h2>
            <p class="mb-1"><strong>Autore:</strong> <?= htmlspecialchars($prodotto['autore'], ENT_QUOTES, 'UTF-8') ?></p>
            <p class="mb-1"><strong>Genere:</strong> <?= htmlspecialchars($prodotto['genere'] ?? 'Non specificato', ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong>Prezzo:</strong> € <?= number_format((float) $prodotto['prezzo'], 2, ',', '.') ?></p>

            <form method="post" action="aggiungialcarrello.php">
              <input type="hidden" name="id" value="<?= (int) $prodotto['id'] ?>">
              <button class="btn btn-primary" type="submit">Aggiungi al carrello</button>
            </form>
          </div>
        </article>
      </div>
    <?php endforeach; ?>
  </div>
</div>
</body>
</html>
