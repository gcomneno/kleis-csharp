# PHP 4 — Domande e risposte di ripasso

Questa scheda accompagna `lesson-04-learned.it.md` e ripassa il CRUD completo, mantenendo distinto lo snapshot docente intermedio dall'implementazione finale verificata.

## 1. Cosa significa CRUD?

CRUD indica quattro capacità distinte:

```text
Create → INSERT
Read   → SELECT
Update → UPDATE
Delete → DELETE
```

Avere solo un form non significa avere un CRUD completo.

## 2. Perché ricevere `$_POST` non equivale a persistere dati?

Perché `$_POST` contiene soltanto input ricevuto dalla richiesta. La persistenza avviene solo quando il codice esegue con successo una mutation SQL sul database.

## 3. Perché `salva.php` usa un prepared `INSERT`?

Perché i valori del form sono dati dinamici. Il prepared statement separa la struttura SQL dai valori ricevuti e rende la mutation più controllata.

## 4. Perché la modifica richiede prima una SELECT?

Per precompilare il form con lo stato corrente del prodotto e assicurarsi di modificare il record identificato dall'`id` richiesto.

## 5. Perché la cancellazione reale non avviene con GET?

GET dovrebbe leggere o navigare, non provocare una mutation distruttiva. Il link `Elimina` apre quindi una pagina di conferma; il `DELETE` reale viene eseguito solo dopo un POST esplicito.

## 6. Perché servono validazione applicativa e vincoli del database?

Perché lavorano a livelli diversi. L'applicazione controlla input e riferimenti prima della query; il database protegge l'integrità strutturale dei dati.

## 7. Perché il genere può essere `NULL`?

Perché nello schema il genere è opzionale. La validazione deve quindi distinguere fra un genere valido e l'assenza intenzionale di genere.

## 8. Quali privilegi servono all'utente DB del CRUD?

La versione finale necessita di:

```text
SELECT, INSERT, UPDATE, DELETE
```

A differenza di PHP 3, il solo `SELECT` non basta più.

## 9. Perché `descrizione` non è stata aggiunta al database?

Perché la presenza del campo nel form docente non prova l'esistenza di una colonna `brani.descrizione`. Lo schema viene dedotto solo da evidence corroborata, non inventato a partire dal nome di un input.

## 10. Perché il road test end-to-end è importante?

Perché verifica realmente Create, Read, Update e Delete su un database temporaneo, oltre alla sintassi PHP e all'assenza di errori server. È una prova molto più forte del solo controllo statico del codice.

## Sintesi

```text
form
→ validazione
→ prepared statement
→ mutation SQL
→ redirect/read-back
→ verifica runtime

GET conferma DELETE
POST esegue DELETE
```
