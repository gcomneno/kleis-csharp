# PHP 5 — Domande e risposte di ripasso

Questa scheda completa la Lesson Learned della Lezione PHP 5 su **sessioni, carrello e preparazione dell'ordine**.

Riferimento principale: [`lesson-05-learned.it.md`](lesson-05-learned.it.md).

## 1. Perché serve `session_start()`?

`session_start()` avvia una nuova sessione PHP oppure riprende quella già associata alla richiesta corrente.

Serve quindi a dare a PHP il contesto della sessione del visitatore e rende disponibile lo stato di sessione, incluso `$_SESSION`.

Nel flusso del carrello è il primo passo necessario prima di recuperare l'identificatore della sessione corrente.

```php
session_start();
$sessionid = session_id();
```

Idea da ricordare:

```text
request HTTP
→ session_start()
→ sessione corrente disponibile
```

## 2. Che cos'è `session_id()`?

`session_id()` restituisce l'identificatore della sessione PHP corrente.

Possiamo considerarlo una targa temporanea che permette al server di riconoscere richieste appartenenti allo stesso contesto di navigazione.

Nel laboratorio PHP 5 questo valore viene usato per associare le righe del carrello alla sessione che le ha create.

## 3. Perché il carrello salva sia `id_brano` sia `sessionid`?

Perché una riga del carrello deve rispondere a due domande diverse:

```text
id_brano  → quale prodotto?
sessionid → a quale carrello/sessione appartiene?
```

`id_brano` identifica il prodotto, mentre `sessionid` identifica il contesto utente temporaneo.

Senza `id_brano` non sapremmo quale prodotto è stato aggiunto; senza `sessionid` non sapremmo a quale carrello assegnarlo.

## 4. Come distinguiamo il carrello di due utenti diversi?

Ogni sessione ha un proprio identificatore. Le righe vengono quindi filtrate usando il `sessionid` della sessione corrente.

Esempio concettuale:

```sql
SELECT ...
FROM carrello
WHERE sessionid = :sessionid;
```

Se due browser hanno sessioni differenti, avranno identificatori differenti e quindi vedranno insiemi di righe differenti.

```text
sessione A → righe A
sessione B → righe B
```

## 5. Perché un `INSERT` non dovrebbe essere provocato da una GET?

Una richiesta GET dovrebbe essere usata per leggere o navigare, non per provocare una mutazione dello stato.

Gli URL GET possono essere:

- ricaricati;
- salvati nei preferiti;
- aperti automaticamente;
- prefetchati;
- indicizzati o analizzati da software esterno.

Se un semplice GET provocasse un `INSERT`, potremmo modificare il carrello solo aprendo un link.

Per questo il laboratorio usa:

```text
GET  → lettura / navigazione
POST → mutazione
```

L'endpoint `aggiungialcarrello.php` accetta quindi soltanto POST.

## 6. Perché usiamo prepared statement anche per `sessionid`?

Perché `sessionid` è comunque un valore dinamico che entra in una query SQL.

La regola del laboratorio è separare sempre:

```text
struttura SQL
≠
valori runtime
```

Quindi:

```php
$stmt = $pdo->prepare(
    'INSERT INTO carrello (id_brano, sessionid) VALUES (:id_brano, :sessionid)'
);

$stmt->execute([
    'id_brano' => $productId,
    'sessionid' => session_id(),
]);
```

Il prepared statement evita concatenazioni arbitrarie e mantiene la query più sicura, leggibile e prevedibile.

## 7. Qual è la differenza tra sessione PHP e dati persistiti nel database?

La sessione PHP rappresenta **stato temporaneo associato al visitatore**.

Il database rappresenta invece **dati persistenti**, memorizzati indipendentemente dalla singola richiesta PHP.

Nel nostro caso:

```text
sessione PHP
→ produce/recupera l'identità temporanea della sessione

session_id
→ viene usato come chiave di associazione

database
→ conserva le righe del carrello
```

Quindi la sessione identifica il contesto; il database conserva i dati del carrello collegati a quel contesto.

## 8. Perché il form dell'ordine esiste già ma non salva niente?

Perché il compito della Lezione PHP 5 richiede di preparare il form con i dati necessari all'ordine, ma lo snapshot docente specifica che il **salvataggio dell'ordine** verrà affrontato nella lezione successiva.

Il confine didattico corretto è quindi:

```text
ORDER FORM=YES
ORDER INSERT=NO
TRANSACTION=NO
```

Il form prepara l'interfaccia e chiarisce quali dati serviranno, senza anticipare concetti non ancora insegnati.

## 9. Che problema risolveranno le transazioni nella prossima lezione?

Le transazioni permettono di trattare più operazioni SQL come un'unica operazione logica.

Per esempio un ordine potrebbe richiedere:

```text
crea ordine
→ salva righe ordine
→ aggiorna/svuota carrello
```

Se una delle operazioni fallisce a metà, non vogliamo lasciare il database in uno stato parziale o incoerente.

Con una transazione possiamo avere il principio:

```text
tutto riesce → COMMIT
qualcosa fallisce → ROLLBACK
```

Quindi il problema principale che le transazioni risolvono è l'**atomicità** dell'operazione complessiva.

## 10. Perché InnoDB è più adatto di MyISAM quando entreranno in gioco le transazioni?

Perché InnoDB supporta le transazioni e quindi operazioni come:

```text
BEGIN
COMMIT
ROLLBACK
```

Inoltre supporta foreign key e un modello di locking più adatto a operazioni concorrenti e dati relazionali.

MyISAM non offre vere transazioni; per questo è meno adatto quando ordine, righe ordine e carrello devono rimanere coerenti come un'unica operazione.

## Sintesi da ricordare

```text
session_start()
→ apre/riprende il contesto della sessione

session_id()
→ identifica quel contesto

id_brano + sessionid
→ collega prodotto e carrello

POST
→ esegue la mutazione

prepared statements
→ separano SQL e valori runtime

database
→ persiste il carrello

transazione
→ garantisce tutto-o-niente

InnoDB
→ rende possibili COMMIT / ROLLBACK e vincoli relazionali
```

## Checkpoint di studio

Dopo il ripasso dovresti riuscire a spiegare senza consultare il codice:

```text
PHP_5_SESSION_START=UNDERSTOOD
PHP_5_SESSION_ID=UNDERSTOOD
PHP_5_CART_OWNERSHIP=UNDERSTOOD
PHP_5_POST_MUTATION_BOUNDARY=UNDERSTOOD
PHP_5_PREPARED_STATEMENTS=UNDERSTOOD
PHP_5_SESSION_VS_DATABASE=UNDERSTOOD
PHP_5_ORDER_FORM_BOUNDARY=UNDERSTOOD
PHP_5_TRANSACTION_PURPOSE=UNDERSTOOD
PHP_5_INNODB_REASON=UNDERSTOOD
```
