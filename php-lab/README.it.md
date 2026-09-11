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
| PHP 5 | TEACHER SNAPSHOT RECOVERED — CART + SESSIONS | REPRODUCED AND VERIFIED END TO END |

## Lezioni e schede di ripasso

Ogni lezione PHP dispone ora sia della Lesson Learned sia di una scheda domanda/risposta dedicata.

- [Lezione 1 — Lesson Learned](lessons/lesson-01-learned.it.md) · [Domande e risposte](lessons/lesson-01-study-questions.it.md)
- [Lezione 2 — Lesson Learned](lessons/lesson-02-learned.it.md) · [Domande e risposte](lessons/lesson-02-study-questions.it.md)
- [Lezione 3 — Lesson Learned](lessons/lesson-03-learned.it.md) · [Domande e risposte](lessons/lesson-03-study-questions.it.md)
- [Lezione 4 — Lesson Learned](lessons/lesson-04-learned.it.md) · [Domande e risposte](lessons/lesson-04-study-questions.it.md)
- [Lezione 4 — Nota di completamento CRUD](lessons/lesson-04-crud-completion.it.md)
- [Lezione 5 — Lesson Learned](lessons/lesson-05-learned.it.md) · [Domande e risposte](lessons/lesson-05-study-questions.it.md)

### PHP 4: cosa osservare

La Lezione 4 chiude il ciclo CRUD prodotto. Contiene catalogo con filtro e paginazione, dettaglio prodotto, prepared `INSERT`/`UPDATE`/`DELETE`, conferma GET ma mutation DELETE via POST, validazione, escaping HTML, PDO/MySQL, Bootstrap e road test isolato end-to-end.

Codice: [`exercises/lesson-04/`](exercises/lesson-04/)

### PHP 5: cosa osservare

La Lezione 5 introduce stato utente temporaneo tramite sessioni e carrello persistito nel database:

- `session_start()` e `session_id()`;
- tabella `carrello` con associazione prodotto/sessione;
- aggiunta prodotto via POST;
- lettura delle sole righe della sessione corrente;
- carrello come tabella e totale;
- form dati ordine predisposto ma senza persistenza;
- confine esplicito: salvataggio ordine e transazioni appartengono alla lezione successiva.

Codice: [`exercises/lesson-05/`](exercises/lesson-05/)

Evidence docente: [`evidence/php-05/README.it.md`](evidence/php-05/README.it.md)

Road test: [`exercises/lesson-05/road-test-cart.sh`](exercises/lesson-05/road-test-cart.sh)

## Confine dell'evidence

HANDOUT CONTENT != EVIDENCE OF CLASSROOM COMPLETION

TEACHER SNAPSHOT != OUR IMPLEMENTATION

Per PHP 4 lo snapshot docente e l'implementazione finale CRUD restano documentati separatamente.

Per PHP 5 lo snapshot docente prova carrello + `session_id()` + pagina carrello e assegna come compito tabella e form ordine. La persistenza dell'ordine e le transazioni sono esplicitamente rinviate alla lezione successiva.

Solo il lavoro realmente eseguito e verificato viene marcato come verificato. PHP 5 ha superato il road test runtime con add-to-cart, isolamento fra sessioni, tabella carrello, form ordine, sintassi PHP e server error gate tutti PASS.

## Readiness del runtime

Baseline locale verificata:

- PHP 8.3.6;
- PDO disponibile;
- `pdo_sqlite` disponibile;
- `pdo_mysql` disponibile;
- MySQL 8.0.46 disponibile e verificato per PHP 3, PHP 4 e PHP 5.

PHP 5 usa variabili d'ambiente `PHP5_DB_*` e non contiene credenziali reali.
