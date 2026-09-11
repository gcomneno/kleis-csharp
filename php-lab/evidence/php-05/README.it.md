# PHP 5 — evidence della lezione del 10 settembre 2026

Archivio docente analizzato: `20260910 backup sito.zip`

SHA-256:

```text
cb6bf82d80658f3c630f1ed0f35c550785bdfaf16e57e8e2a1d979ad65b95bb1
```

## Fatti dimostrati dallo snapshot

Lo snapshot contiene 19 elementi e dimostra che in aula sono stati introdotti:

- una nuova tabella `carrello`;
- il salvataggio degli identificativi dei prodotti nel carrello;
- l'uso di `session_start()` e `session_id()` per associare le righe del carrello alla sessione corrente;
- una pagina `carrello.php` che recupera i prodotti della sessione corrente;
- un endpoint `aggiungialcarrello.php` che inserisce `id_brano` e `sessionid` tramite prepared statement;
- CRUD prodotto già presente nello snapshot (`INSERT`, `UPDATE`, `DELETE`);
- Bootstrap per la struttura delle pagine.

La tabella osservata nello snapshot è:

```text
carrello
├── id INT AUTO_INCREMENT PRIMARY KEY
├── id_brano INT NOT NULL
└── sessionid VARCHAR(100) NOT NULL
```

Lo snapshot usa `ENGINE=MyISAM` e non dichiara foreign key. Questo è evidence del materiale docente, non una prescrizione architetturale per il laboratorio.

## Compito assegnato

`info.txt` assegna per casa:

1. trasformare l'elenco dei prodotti del carrello in una tabella;
2. aggiungere sotto la tabella un form con i dati necessari per eseguire l'ordine.

## Prossima lezione annunciata

Il docente anticipa come argomento successivo:

```text
salvataggio dell'ordine nel database
→ transazioni
```

## Confine dell'evidence

Questa lezione prova il carrello legato alla sessione e l'assegnazione del form ordine. Non prova ancora:

- persistenza dell'ordine;
- tabelle ordine/righe ordine definitive;
- commit/rollback applicativo;
- gestione transazionale dell'ordine.

Questi aspetti restano `NOT YET TAUGHT / NOT YET PROVEN` fino a nuova evidence.
