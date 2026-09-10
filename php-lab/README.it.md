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

## Lezioni

- [Lezione 1 — Fondamenti del linguaggio e prima pagina dinamica](lessons/lesson-01-learned.it.md)
- [Lezione 2 — Layout statico del catalogo come ponte verso il rendering dinamico](lessons/lesson-02-learned.it.md)
- [Lezione 3 — Catalogo basato su database con PDO, filtro e paginazione](lessons/lesson-03-learned.it.md)
- [Lezione 4 — CRUD completo con PDO, validazione, dettaglio, modifica, eliminazione e UI Bootstrap](lessons/lesson-04-learned.it.md)
- [Lezione 4 — Nota di completamento CRUD](lessons/lesson-04-crud-completion.it.md)

### PHP 4: cosa osservare

La Lezione 4 è il checkpoint più completo del modulo attuale. Contiene:

- catalogo con filtro e paginazione;
- dettaglio prodotto;
- creazione tramite `INSERT` preparato;
- modifica tramite form precompilato e `UPDATE` preparato;
- eliminazione con conferma GET e mutazione effettiva solo tramite POST;
- escaping HTML e validazione lato server;
- accesso MySQL tramite PDO;
- interfaccia Bootstrap per catalogo, form, dettaglio e conferma eliminazione;
- road test isolato del ciclo CRUD completo.

Codice: [`exercises/lesson-04/`](exercises/lesson-04/)

Lesson Learned canonica: [`lessons/lesson-04-learned.it.md`](lessons/lesson-04-learned.it.md)

## Confine dell'evidence

HANDOUT CONTENT != EVIDENCE OF CLASSROOM COMPLETION

TEACHER SNAPSHOT != OUR IMPLEMENTATION

Per PHP 4 lo snapshot docente dimostra la ricostruzione fino al confine POST, mentre il requisito finale del laboratorio è stato completato e verificato come CRUD end-to-end. Le due cose restano documentate separatamente.

Solo il lavoro riprodotto e verificato localmente viene marcato come completato in questo laboratorio.

## Readiness del runtime

Baseline locale verificata:

- PHP 8.3.6;
- PDO disponibile;
- `pdo_sqlite` disponibile;
- `pdo_mysql` disponibile;
- MySQL 8.0.46 disponibile e verificato per PHP 3 e PHP 4.

La readiness PDO/MySQL è stata verificata prima di riprodurre le lezioni PHP 3 e PHP 4 basate sul database.

Per la demo PHP 4 si può avviare il development server dalla cartella della lezione:

```bash
cd php-lab/exercises/lesson-04
PHP4_DB_PASSWORD='PASSWORD_LOCALE' php -S 127.0.0.1:8084
```

L'applicazione richiede la password tramite variabile d'ambiente `PHP4_DB_PASSWORD`; il repository non contiene credenziali reali. Aprendo `http://127.0.0.1:8084/` si viene reindirizzati al catalogo.
