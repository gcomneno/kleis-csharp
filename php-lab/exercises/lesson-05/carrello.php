<?php
require_once __DIR__ . '/include/db.php';
require_once __DIR__ . '/include/cart.php';

$carrello = php5_cart_items($pdo);
$totale = array_reduce(
    $carrello,
    static fn (float $sum, array $item): float => $sum + (float) $item['prezzo'],
    0.0
);
?>
<!doctype html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP 5 — Carrello</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 mb-1">Carrello</h1>
      <p class="text-secondary mb-0">Le righe sono associate alla sessione PHP corrente.</p>
    </div>
    <a class="btn btn-outline-secondary" href="prodotti.php">Torna al catalogo</a>
  </div>

  <?php if ($carrello === []): ?>
    <div class="alert alert-info">Il carrello è vuoto.</div>
  <?php else: ?>
    <div class="table-responsive mb-4">
      <table class="table align-middle">
        <thead>
        <tr>
          <th>Codice</th>
          <th>Titolo</th>
          <th>Autore</th>
          <th>Genere</th>
          <th class="text-end">Prezzo</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($carrello as $item): ?>
          <tr>
            <td>#<?= (int) $item['id'] ?></td>
            <td><?= htmlspecialchars($item['titolo'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($item['autore'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($item['genere'] ?? 'Non specificato', ENT_QUOTES, 'UTF-8') ?></td>
            <td class="text-end">€ <?= number_format((float) $item['prezzo'], 2, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
          <th colspan="4" class="text-end">Totale</th>
          <th class="text-end">€ <?= number_format($totale, 2, ',', '.') ?></th>
        </tr>
        </tfoot>
      </table>
    </div>

    <section class="card border-0 shadow-sm">
      <div class="card-body">
        <h2 class="h5">Dati per l'ordine — compito PHP 5</h2>
        <p class="text-secondary">Il form è presente come richiesto dal compito, ma in questa lezione non salva ancora alcun ordine nel database.</p>

        <form method="post" action="#" onsubmit="return false;">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="nome">Nome e cognome</label>
              <input class="form-control" id="nome" name="nome" type="text">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="email">Email</label>
              <input class="form-control" id="email" name="email" type="email">
            </div>
            <div class="col-12">
              <label class="form-label" for="indirizzo">Indirizzo</label>
              <input class="form-control" id="indirizzo" name="indirizzo" type="text">
            </div>
          </div>
          <button class="btn btn-secondary mt-3" type="submit" disabled>Salvataggio ordine: prossima lezione</button>
        </form>
      </div>
    </section>
  <?php endif; ?>
</div>
</body>
</html>
