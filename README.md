# Kleis Software Lab — Corso di sviluppo software

Repository didattico del corso di sviluppo software. I materiali documentano un percorso progressivo: dai fondamenti di programmazione con C# e .NET alla costruzione di pagine web con HTML, CSS, responsive design e Bootstrap, fino alle basi di dati relazionali, SQL e PHP con accesso MySQL tramite PDO.

Non è una raccolta di esercizi isolati. Codice, esempi, appunti, quiz, soluzioni e Lesson Learned permettono di studiare un argomento, applicarlo e verificare ciò che si è compreso.

Il percorso attualmente presente comprende:

- C# e .NET 8: tipi, condizioni, stringhe, metodi, validazione, array, progettazione top-down e primi passi verso una struttura a oggetti;
- HTML e CSS: struttura delle pagine, collegamenti, tabelle, form, selettori, box model e layout;
- responsive design: Flexbox, Grid e media query;
- Bootstrap 5: griglia, utility, componenti, form e riscrittura di interfacce esistenti;
- basi di dati relazionali e SQL: DBMS, tabelle, chiavi, relazioni, CRUD, filtri, `NULL`, `JOIN`, ordinamento, aggregazioni, raggruppamenti e progettazione di tabelle e-commerce;
- PHP: fondamenti del linguaggio, rendering dinamico, catalogo basato su database, PDO, filtro, paginazione e CRUD completo con interfaccia Bootstrap;
- teoria, metodo di lavoro e preparazione alle verifiche.

## Ultimi aggiornamenti

- completato e verificato il percorso PHP fino alla Lezione 4;
- aggiunto il CRUD PHP end-to-end su catalogo prodotti: creazione, lettura, dettaglio, modifica ed eliminazione;
- aggiunti accesso MySQL con PDO, prepared statements, validazione server-side ed escaping HTML;
- aggiunta una UI Bootstrap alla demo PHP 4 e un entrypoint `index.php` per l'esecuzione locale;
- aggiunti Lesson Learned bilingui per PHP 1–4 e nota separata di completamento CRUD per PHP 4;
- avviata la preparazione del mini-ecommerce finale con roadmap, moduli, flussi, modello dati e checklist d'esame;
- aggiunto il quiz finale SQL con 60 domande di ripasso e soluzioni commentate;
- completato il modulo sulle basi di dati in cinque lezioni progressive, con quiz, laboratori SQL sul database `shop`, soluzioni commentate ed esempi eseguibili.

## Struttura del repository

Le aree principali del percorso sono:

- [`csharp/`](./csharp/) — esercitazioni C# organizzate in ordine progressivo;
- [`web/`](./web/) — esercitazioni HTML, CSS, responsive design e Bootstrap;
- [`php-lab/`](./php-lab/) — modulo PHP con quattro lezioni ricostruite, riprodotte e verificate;
- [`theory/`](./theory/) — materiali teorici, analisi del rischio, basi di dati e preparazione del mini-ecommerce;
- [`test-prep/`](./test-prep/) — test di ripasso con soluzioni separate;
- file di soluzione e progetto .NET — [`Kleis.sln`](./Kleis.sln) alla radice e i file `.csproj` nelle singole esercitazioni C#.

Ogni cartella conserva, quando disponibili, sorgenti, tracce, asset, esempi, quiz, soluzioni e note didattiche. Le esercitazioni rimangono autonome: è quindi possibile affrontarle in sequenza oppure aprirne una singola per un ripasso mirato.

## Come usare il repository per studiare

Per seguire il percorso in modo progressivo:

1. scegli un'area e procedi secondo la numerazione delle cartelle;
2. leggi prima il README locale, la traccia o la Lesson Learned disponibile;
3. osserva l'esempio e prova a spiegare il ruolo delle sue parti;
4. svolgi o modifica l'esercizio senza consultare subito la soluzione;
5. usa quiz e materiali in `test-prep/` per verificare la comprensione;
6. confronta il lavoro con soluzioni, refactoring e Lesson Learned;
7. annota non solo cosa funziona, ma anche errori, decisioni e concetti da riutilizzare.

La progressione didattica è:

> teoria → esempio → esercizio → verifica → Lesson Learned

## PHP — percorso attuale

Il modulo PHP è raccolto in [`php-lab/`](./php-lab/) e arriva attualmente alla Lezione 4.

- [PHP 1 — Fondamenti del linguaggio e prima pagina dinamica](./php-lab/lessons/lesson-01-learned.it.md)
- [PHP 2 — Layout statico del catalogo come ponte verso il rendering dinamico](./php-lab/lessons/lesson-02-learned.it.md)
- [PHP 3 — Catalogo basato su database con PDO, filtro e paginazione](./php-lab/lessons/lesson-03-learned.it.md)
- [PHP 4 — CRUD completo con PDO, validazione e UI Bootstrap](./php-lab/lessons/lesson-04-learned.it.md)
- [PHP 4 — Codice completo](./php-lab/exercises/lesson-04/)
- [PHP 4 — Nota di completamento CRUD](./php-lab/lessons/lesson-04-crud-completion.it.md)

La Lezione 4 implementa e verifica il ciclo completo:

```text
Create → Read → Update → Delete
```

Il catalogo usa MySQL e PDO, query preparate, validazione lato server ed escaping HTML. La cancellazione viene confermata via GET ma la mutazione effettiva avviene soltanto tramite POST. Il runtime è coperto da un road test isolato del CRUD completo.

### Avvio locale della demo PHP 4

Prerequisiti: PHP con `pdo_mysql`, MySQL e un database compatibile con lo schema incluso in [`php-lab/exercises/lesson-04/database/`](./php-lab/exercises/lesson-04/database/).

Dalla radice del repository:

```bash
cd php-lab/exercises/lesson-04
PHP4_DB_PASSWORD='PASSWORD_LOCALE' php -S 127.0.0.1:8084
```

La password viene letta dalla variabile d'ambiente `PHP4_DB_PASSWORD`; il repository non contiene credenziali reali.

Aprendo `http://127.0.0.1:8084/` si arriva al catalogo. Le pagine principali sono `prodotti.php`, `adminprodotti.php`, `dettaglioprodotto.php`, `modificaprodotto.php` ed `eliminaprodotto.php`.

## Prerequisiti e comandi operativi

Per le esercitazioni C# servono il [.NET 8 SDK](https://dotnet.microsoft.com/download/dotnet/8.0) e un terminale. Dalla radice del repository è possibile compilare gli otto progetti inclusi nella soluzione:

```bash
dotnet build Kleis.sln
```

Le esercitazioni si possono eseguire indicando il relativo progetto, per esempio:

```bash
dotnet run --project csharp/08-gestione-voti-menu/Esercitazione-14.csproj
dotnet run --project csharp/09-gestione-ordini/09-gestione-ordini.csproj
dotnet run --project csharp/09-gestione-ordini/refactored/refactored.csproj
```

I materiali web sono file HTML e CSS statici: basta aprire il file `.html` dell'esercitazione in un browser. Alcuni esempi Bootstrap caricano Bootstrap o Bootswatch tramite CDN e richiedono quindi una connessione Internet per visualizzare correttamente gli stili e i componenti collegati.

Per eseguire gli script SQL in [`theory/02-basi-di-dati/examples/`](./theory/02-basi-di-dati/examples/) serve un DBMS MySQL o MariaDB. La lettura delle lezioni, dei quiz e delle soluzioni non richiede invece l'installazione di un database.

## Esercitazioni C#

- [`01-type-inspector`](./csharp/01-type-inspector/) — tipi base e ispezione dei valori;
- [`02-min-max`](./csharp/02-min-max/) — logica condizionale e confronto;
- [`03-stringhe`](./csharp/03-stringhe/) — stringhe, metodi, immutabilità e confronto con C;
- [`04-calcolatrice`](./csharp/04-calcolatrice/) — input utente, validazione, metodi e gestione degli errori;
- [`05-triangolo`](./csharp/05-triangolo/) — validazione semantica, metodi riutilizzabili e operatore ternario;
- [`06-codice-fiscale`](./csharp/06-codice-fiscale/) — generatore semplificato del codice fiscale italiano;
- [`07-ripasso-array-top-down`](./csharp/07-ripasso-array-top-down/) — array, statistiche, ricerca, progettazione top-down e refactoring;
- [`08-gestione-voti-menu`](./csharp/08-gestione-voti-menu/) — gestione dei voti con menu, array, metodi e validazione dell'input;
- [`09-gestione-ordini`](./csharp/09-gestione-ordini/) — gestione ordini con array paralleli e successivo refactoring a oggetti con modelli e servizi.

## HTML, CSS, responsive design e Bootstrap

- [`01-html-base`](./web/01-html-base/) — struttura HTML, link, liste, tabelle e percorsi relativi;
- [`02-css-base`](./web/02-css-base/) — selettori CSS, scope, spaziatura e separazione tra struttura e stile;
- [`03-html-forms`](./web/03-html-forms/) — form, input, login, recupero password e UX di base;
- [`04-css-layout`](./web/04-css-layout/) — classi, identificatori, box model, float e layout CSS;
- [`05-html-css-form-layout`](./web/05-html-css-form-layout/) — layout più articolati e form di registrazione;
- [`06-flexgrid-responsive-layout`](./web/06-flexgrid-responsive-layout/) — Flexbox, Grid, media query e layout responsive;
- [`07-product-card-responsive`](./web/07-product-card-responsive/) — scheda prodotto responsive, pagina di dettaglio e Lesson Learned CSS;
- [`08-bootstrap`](./web/08-bootstrap/) — Bootstrap 5, approccio mobile-first, griglia, utility, form, componenti ed esempi numerati;
- [`09-bootstrap-rewrite`](./web/09-bootstrap-rewrite/) — migrazione di vetrina prodotti, dettaglio libro e form di registrazione da HTML/CSS tradizionale a Bootstrap, con quiz e soluzioni.

## Teoria, metodo e basi di dati

- [`01-analisi-rischio`](./theory/01-analisi-rischio/) — materiale sulle lezioni apprese nell'analisi del rischio;
- [`02-basi-di-dati`](./theory/02-basi-di-dati/) — percorso didattico completo sulle basi di dati relazionali e SQL;
- [`03-mini-ecommerce`](./theory/03-mini-ecommerce/) — preparazione del progetto finale: roadmap, moduli, modello dati, flussi utente e checklist d'esame.

Il modulo sulle basi di dati è organizzato in cinque lezioni: concetti generali; relazioni e CRUD; laboratorio `shop` con `SELECT`, `WHERE`, `NULL` e `JOIN`; aggregazioni e raggruppamenti; progettazione delle tabelle per il mini-ecommerce.

## Preparazione alle verifiche

- [`01-html-css`](./test-prep/01-html-css/) — pre-test su HTML, CSS, layout e form, con soluzioni separate;
- [`02-csharp`](./test-prep/02-csharp/) — pre-test su sintassi, input/output, condizioni, cicli, array, metodi, validazione e progettazione top-down, con soluzioni separate.

Per una verifica attendibile, apri prima il file del test e consulta le soluzioni soltanto dopo aver completato le risposte.

## Metodo di lavoro

Il materiale privilegia una crescita graduale e verificabile:

- codice semplice e leggibile prima di soluzioni premature o troppo astratte;
- nomi intenzionali e responsabilità chiare;
- validazione dell'input e attenzione ai casi limite;
- separazione tra struttura, stile e logica;
- confronto tra una prima soluzione e i refactoring successivi;
- documentazione degli errori e delle decisioni nelle Lesson Learned.

L'obiettivo è passare da codice che funziona a codice che funziona, ha senso, è leggibile e può essere spiegato ad altre persone.

Per proporre correzioni o nuovi materiali, consulta [`CONTRIBUTING.md`](./CONTRIBUTING.md).
