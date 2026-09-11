# Lesson Learned — PHP 5: carrello, sessioni e preparazione dell'ordine

## Stato della lezione

Questa documentazione formalizza la quinta lezione PHP del corso Kleis, svolta il **10 settembre 2026**.

Evidence docente disponibile:

- archivio `20260910 backup sito.zip`;
- SHA-256 `cb6bf82d80658f3c630f1ed0f35c550785bdfaf16e57e8e2a1d979ad65b95bb1`;
- file `info.txt` con riepilogo della lezione, compito e anticipazione della lezione successiva.

Stato canonico:

```text
PHP_5_TOPIC=CART_AND_SESSIONS
PHP_5_TEACHER_SNAPSHOT=RECOVERED
PHP_5_CART_TABLE=PROVEN
PHP_5_SESSION_ID_PERSISTENCE=PROVEN
PHP_5_CART_PAGE=PROVEN
PHP_5_HOMEWORK_CART_TABLE=IMPLEMENTED_IN_LAB
PHP_5_HOMEWORK_ORDER_FORM=IMPLEMENTED_AS_NON_PERSISTING_SKELETON
PHP_5_ORDER_PERSISTENCE=NOT_YET_TAUGHT
PHP_5_TRANSACTIONS=NEXT_LESSON
```

---

## 1. Il salto concettuale rispetto a PHP 4

PHP 4 concludeva il ciclo CRUD del prodotto:

```text
CREATE → READ → UPDATE → DELETE
```

PHP 5 introduce invece **stato utente temporaneo**.

Il problema nuovo è questo:

> come faccio a ricordare quali prodotti appartengono al carrello di uno specifico visitatore fra una richiesta HTTP e la successiva?

La risposta mostrata in aula usa la sessione PHP come identità temporanea del visitatore:

```php
session_start();
$sessionid = session_id();
```

Il valore di `session_id()` viene poi salvato insieme all'identificativo del prodotto nella tabella `carrello`.

---

## 2. La tabella `carrello`

Lo snapshot docente introduce una tabella concettualmente equivalente a:

```text
carrello
├── id
├── id_brano
└── sessionid
```

Nel laboratorio la formalizziamo come:

```sql
CREATE TABLE carrello (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_brano INT NOT NULL,
    sessionid VARCHAR(128) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_carrello_brani
        FOREIGN KEY (id_brano) REFERENCES brani(id)
        ON DELETE CASCADE,
    INDEX idx_carrello_sessionid (sessionid)
) ENGINE=InnoDB;
```

Differenze intenzionali rispetto allo snapshot:

- `InnoDB` invece di MyISAM;
- foreign key verso `brani`;
- indice su `sessionid`;
- timestamp tecnico `created_at`.

Queste differenze non cambiano il concetto insegnato: il cuore resta `id_brano + sessionid`.

---

## 3. Perché `session_id()` è utile

HTTP, di per sé, è stateless: una richiesta non "ricorda" automaticamente quella precedente.

La sessione fornisce un identificatore che il server può associare al browser.

Nel flusso del carrello:

```text
browser
→ richiesta PHP
→ session_start()
→ session_id()
→ riga nel DB con quello stesso session_id
```

Quando lo stesso browser apre il carrello:

```text
session_start()
→ stesso session_id
→ SELECT delle sole righe con quel session_id
```

Quindi due utenti diversi possono avere righe diverse nella stessa tabella `carrello`.

---

## 4. Aggiungere un prodotto al carrello

Lo snapshot docente usa un endpoint `aggiungialcarrello.php` che inserisce:

```sql
INSERT INTO carrello (id_brano, sessionid)
VALUES (:id_brano, :sessionid)
```

Nel laboratorio manteniamo questo stesso cuore, ma rendiamo la mutazione esplicitamente POST-only:

```php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Metodo non consentito');
}
```

Poi validiamo l'id del prodotto:

```php
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1],
]);
```

E infine inseriamo la riga:

```php
$stmt = $pdo->prepare(
    'INSERT INTO carrello (id_brano, sessionid) VALUES (:id_brano, :sessionid)'
);

$stmt->execute([
    'id_brano' => $productId,
    'sessionid' => php5_session_id(),
]);
```

La distinzione importante è:

```text
GET  = navigazione / lettura
POST = mutazione dello stato
```

---

## 5. Leggere il carrello della sessione corrente

Il principio della query è:

```sql
SELECT ...
FROM carrello c
JOIN brani b ON b.id = c.id_brano
...
WHERE c.sessionid = :sessionid
```

La query completa del laboratorio:

```php
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
```

Il parametro `:sessionid` continua la stessa disciplina già vista con PDO:

```text
dati utente / runtime
→ parametri prepared
→ mai concatenazione SQL arbitraria
```

---

## 6. Il compito: da lista a tabella

In aula il carrello era mostrato come semplice lista.

Il compito chiede di trasformarlo in tabella.

Il laboratorio implementa:

```text
Codice | Titolo | Autore | Genere | Prezzo
```

più il totale:

```php
$totale = array_reduce(
    $carrello,
    static fn (float $sum, array $item): float => $sum + (float) $item['prezzo'],
    0.0
);
```

Qui c'è un passaggio didattico importante: i dati arrivano dal database, vengono trasformati in una struttura PHP e infine renderizzati in HTML.

```text
DB → array PHP → HTML table
```

---

## 7. Il form dell'ordine: prepararlo senza inventare la lezione successiva

Il secondo punto del compito richiede un form con i dati necessari all'ordine.

Nel laboratorio sono presenti campi essenziali come:

```text
nome e cognome
email
indirizzo
```

Ma il submit è intenzionalmente disabilitato.

Perché?

Perché `info.txt` dice esplicitamente che **il salvataggio dell'ordine nel database e le transazioni saranno affrontati nella lezione successiva**.

Quindi il confine corretto è:

```text
FORM ORDER DATA = YES
ORDER INSERT = NO
TRANSACTION = NO
COMMIT / ROLLBACK = NO
```

Questo evita di presentare come "lezione PHP 5" concetti che non sono ancora stati insegnati.

---

## 8. Lo snapshot docente e le scelte del laboratorio

Lo snapshot è evidence preziosa, ma non viene copiato meccanicamente.

### Snapshot docente

- add-to-cart tramite query string GET;
- MyISAM;
- credenziali DB locali direttamente nel codice;
- session id persistito nella tabella carrello;
- carrello inizialmente come lista.

### Laboratorio

- mutazione del carrello tramite POST;
- InnoDB;
- credenziali solo da variabili d'ambiente;
- foreign key e indice;
- output HTML escapato;
- tabella carrello completata;
- form ordine preparato ma non persistente.

Il principio resta:

```text
TEACHER SNAPSHOT != OUR FINAL IMPLEMENTATION
```

ma:

```text
TEACHER SNAPSHOT → PROVENANCE OF THE LESSON
```

---

## 9. Flusso completo da ricordare

```text
prodotti.php
    ↓
POST aggiungialcarrello.php
    ↓
session_start()
    ↓
session_id()
    ↓
INSERT carrello(id_brano, sessionid)
    ↓
redirect carrello.php
    ↓
SELECT ... WHERE sessionid = :sessionid
    ↓
tabella prodotti
    ↓
totale
    ↓
form dati ordine
    ↓
STOP: persistenza ordine e transazioni appartengono a PHP 6 / lezione successiva
```

---

## 10. File da studiare

Il codice della lezione è in:

```text
php-lab/exercises/lesson-05/
```

Ordine di lettura consigliato:

1. `database/schema.sql`
2. `include/db.php`
3. `include/cart.php`
4. `prodotti.php`
5. `aggiungialcarrello.php`
6. `carrello.php`
7. `README.it.md`

Evidence docente:

```text
php-lab/evidence/php-05/README.it.md
```

---

## 11. Domande che dovresti saper spiegare

Dopo aver studiato questa lezione dovresti riuscire a rispondere a queste domande:

1. Perché serve `session_start()`?
2. Che cos'è `session_id()`?
3. Perché il carrello salva sia `id_brano` sia `sessionid`?
4. Come distinguiamo il carrello di due utenti diversi?
5. Perché un INSERT non dovrebbe essere provocato da una GET?
6. Perché usiamo prepared statement anche per `sessionid`?
7. Qual è la differenza tra sessione PHP e dati persistiti nel database?
8. Perché il form dell'ordine esiste già ma non salva niente?
9. Che problema risolveranno le transazioni nella prossima lezione?
10. Perché InnoDB è più adatto di MyISAM quando entreranno in gioco le transazioni?

---

## Checkpoint finale

```text
PHP_5=FORMALIZED
CART_MODEL=UNDERSTOOD
SESSION_ID_BOUNDARY=UNDERSTOOD
ADD_TO_CART=IMPLEMENTED
CART_READ=IMPLEMENTED
HOMEWORK_TABLE=IMPLEMENTED
ORDER_FORM_SKELETON=IMPLEMENTED
ORDER_PERSISTENCE=DEFERRED
TRANSACTIONS=DEFERRED_TO_NEXT_LESSON
```
