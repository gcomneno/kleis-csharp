# PHP Lab

[English](README.md) | [Italiano](README.it.md)

Questo laboratorio ricostruisce, riproduce e verifica il modulo PHP del corso Sviluppatore Software Kleis.

Il materiale recuperato dal docente costituisce evidence del corso, non prova che un argomento sia stato appreso o riprodotto localmente. Quando il requisito finale della lezione supera ciò che è dimostrato dallo snapshot docente, il laboratorio mantiene esplicito il confine fra evidence recuperata e implementazione finale verificata.

## Workflow di recupero

source evidence -> reconstruct -> understand -> reproduce -> run -> verify -> document

## Checkpoint di recupero

| Lezione | Stato ricostruzione | Riproduzione locale |
| --- | --- | --- |
| PHP 1 | RECONSTRUCTED | REPRODUCED AND VERIFIED |
| PHP 2 | RECONSTRUCTED TO AVAILABLE ARTIFACT | REPRODUCED AND VERIFIED |
| PHP 3 | RECONSTRUCTED TO AVAILABLE ARTIFACT | REPRODUCED AND VERIFIED |
| PHP 4 | RECONSTRUCTED TO AVAILABLE SNAPSHOT + FINAL CRUD | REPRODUCED AND VERIFIED END TO END |
| PHP 5 | TEACHER SNAPSHOT RECOVERED — CART + SESSIONS | LAB IMPLEMENTATION PREPARED; RUNTIME VERIFICATION PENDING |

## Lezioni

- [Lezione 1 — Fondamenti del linguaggio e prima pagina dinamica](lessons/lesson-01-learned.it.md)
- [Lezione 2 — Layout statico del catalogo come ponte verso il rendering dinamico](lessons/lesson-02-learned.it.md)
- [Lezione 3 — Catalogo basato su database con PDO, filtro e paginazione](lessons/lesson-03-learned.it.md)
- [Lezione 4 — CRUD completo con PDO, validazione, dettaglio, modifica, eliminazione e UI Bootstrap](lessons/lesson-04-learned.it.md)
- [Lezione 4 — Nota di completamento CRUD](lessons/lesson-04-crud-completion.it.md)
- [Lezione 5 — Carrello, sessioni e preparazione dell'ordine](lessons/lesson-05-learned.it.md)

### PHP 4: cosa osservare

La Lezione 4 chiude il ciclo CRUD prodotto. Contiene:

- catalogo con filtro e paginazione;
- dettaglio prodotto;
- creazione tramite `INSERT` preparato;
- modifica tramite form precompilato e `UPDATE` preparato;
- eliminazione con conferma GET e mutazione effettiva solo tramite POST;
- escaping HTML e validazione lato server;
- accesso MySQL tramite PDO;
- interfaccia Bootstrap;
- road test isolato del ciclo CRUD completo.

Codice: [`exercises/lesson-04/`](exercises/lesson-04/)

Lesson Learned: [`lessons/lesson-04-learned.it.md`](lessons/lesson-04-learned.it.md)

### PHP 5: cosa osservare

La Lezione 5 introduce stato utente temporaneo tramite sessioni e carrello persistito nel database:

- `session_start()` e `session_id()`;
- tabella `carrello` con associazione prodotto/sessione;
- aggiunta prodotto al carrello;
- lettura delle sole righe della sessione corrente;
- completamento del compito: carrello come tabella e totale;
- form dati ordine predisposto ma senza persistenza;
- confine esplicito: salvataggio ordine e transazioni appartengono alla lezione successiva.

Codice: [`exercises/lesson-05/`](exercises/lesson-05/)

Lesson Learned: [`lessons/lesson-05-learned.it.md`](lessons/lesson-05-learned.it.md)

Evidence docente: [`evidence/php-05/README.it.md`](evidence/php-05/README.it.md)

## Confine dell'evidence

HANDOUT CONTENT != EVIDENCE OF CLASSROOM COMPLETION

TEACHER SNAPSHOT != OUR IMPLEMENTATION

Per PHP 4 lo snapshot docente e l'implementazione finale CRUD restano documentati separatamente.

Per PHP 5 lo snapshot docente prova carrello + `session_id()` + pagina carrello e assegna come compito tabella e form ordine. La persistenza dell'ordine e le transazioni sono esplicitamente rinviate alla lezione successiva.

Solo il lavoro realmente eseguito e verificato viene marcato come verificato. L'implementazione PHP 5 presente nel repository è pronta per la verifica runtime, che resta un gate separato.

## Readiness del runtime

Baseline locale già verificata nelle lezioni precedenti:

- PHP 8.3.6;
- PDO disponibile;
- `pdo_sqlite` disponibile;
- `pdo_mysql` disponibile;
- MySQL 8.0.46 disponibile e verificato per PHP 3 e PHP 4.

Per PHP 5 il codice usa variabili d'ambiente `PHP5_DB_*` e non contiene credenziali reali.
