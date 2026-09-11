# PHP 5 — Carrello e sessioni

Questa esercitazione riproduce il nucleo della quinta lezione PHP del corso Kleis e completa il compito assegnato a casa senza anticipare il salvataggio dell'ordine.

## Obiettivi

- avviare e usare una sessione PHP;
- associare le righe del carrello a `session_id()`;
- aggiungere un prodotto al carrello;
- leggere solo il carrello della sessione corrente;
- rendere il carrello come tabella;
- predisporre il form dati ordine senza persistere ancora l'ordine;
- mantenere separato ciò che è stato insegnato da ciò che verrà affrontato con le transazioni.

## Setup dati

Creare un database dedicato, per esempio `php5_shop_lab`, poi importare:

```text
database/schema.sql
database/seed.sql
```

L'applicazione usa variabili d'ambiente:

```text
PHP5_DB_HOST
PHP5_DB_NAME
PHP5_DB_USER
PHP5_DB_PASSWORD
```

`PHP5_DB_PASSWORD` è obbligatoria e non viene salvata nel repository.

## Avvio

Dalla cartella della lezione:

```bash
PHP5_DB_PASSWORD='PASSWORD_LOCALE' php -S 127.0.0.1:8085
```

Poi aprire:

```text
http://127.0.0.1:8085/
```

## Flusso da studiare

```text
catalogo
→ POST aggiungialcarrello.php
→ session_start()
→ session_id()
→ INSERT carrello(id_brano, sessionid)
→ redirect carrello.php
→ SELECT per sessionid
→ tabella carrello
→ form dati ordine
```

## Scelte intenzionali del laboratorio

Lo snapshot docente inserisce il prodotto nel carrello via GET. Qui la mutazione avviene via POST, così la navigazione e la modifica dello stato restano separate.

Lo snapshot usa MyISAM. Qui viene usato InnoDB con foreign key e indice su `sessionid`, perché il laboratorio deve essere pronto per la lezione successiva sulle transazioni senza fingere che tali transazioni siano già state insegnate.

Il pulsante di invio dell'ordine è disabilitato: la persistenza dell'ordine appartiene alla lezione successiva.
