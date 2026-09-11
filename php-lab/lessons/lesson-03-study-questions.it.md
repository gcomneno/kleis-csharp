# PHP 3 — Domande e risposte di ripasso

Questa scheda accompagna `lesson-03-learned.it.md` e ripassa il passaggio dal catalogo statico al catalogo basato su MySQL/PDO.

## 1. Perché PHP 3 rappresenta un salto rispetto a PHP 2?

Perché i prodotti non sono più scritti manualmente nell'HTML: vengono letti dal database e renderizzati dinamicamente.

## 2. A cosa servono gli `include`?

Separano responsabilità diverse in file distinti, per esempio connessione DB, query, header, footer, filtro e rendering del prodotto. `prodotti.php` compone poi la pagina finale.

## 3. Perché usare PDO?

PDO fornisce un'interfaccia coerente verso il database, supporta eccezioni, fetch associativi e prepared statement, e mantiene separati SQL e valori dinamici.

## 4. Perché il parametro `pagina` va normalizzato?

Per evitare valori non validi o negativi. La lezione forza la pagina ad almeno `1` prima di calcolare l'offset.

## 5. Come funzionano `LIMIT` e `OFFSET`?

`LIMIT` decide quanti record restituire; `OFFSET` quanti record saltare. Con 12 elementi per pagina:

```text
pagina 1 → offset 0
pagina 2 → offset 12
```

## 6. Perché `LIMIT` e `OFFSET` vengono bindati come interi?

Perché sono valori numerici strutturali della query. Il binding esplicito con `PDO::PARAM_INT` evita conversioni ambigue e mantiene il tipo previsto dal DB.

## 7. Perché viene usata una `LEFT JOIN` per i generi?

Perché il genere è opzionale. Una `INNER JOIN` eliminerebbe dal risultato i brani con `genere_id = NULL`; la `LEFT JOIN` li conserva.

## 8. Qual è la differenza tra prepared statement e `htmlspecialchars()`?

Proteggono confini diversi. I prepared statement separano SQL e valori e proteggono il confine database. `htmlspecialchars()` impedisce che dati renderizzati vengano interpretati come markup HTML.

## 9. Perché l'utente DB della lezione ha solo privilegio `SELECT`?

Perché PHP 3 deve soltanto leggere il catalogo. Applicare il minimo privilegio significa concedere solo le operazioni realmente necessarie.

## 10. Perché il dataset locale non viene presentato come dataset originale del docente?

Perché DDL e dataset originali non sono stati recuperati. La fixture deterministica serve a riprodurre e verificare il comportamento, ma non viene confusa con evidence storica.

## Sintesi

```text
GET filtro/pagina
→ normalizzazione input
→ PDO prepared query
→ JOIN + LIMIT/OFFSET
→ array PHP
→ escaping HTML
→ rendering dinamico
```
