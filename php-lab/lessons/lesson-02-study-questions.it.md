# PHP 2 — Domande e risposte di ripasso

Questa scheda accompagna `lesson-02-learned.it.md` e resta entro il confine realmente osservato e verificato della Lezione 2: catalogo statico Bootstrap, senza logica PHP o database.

## 1. Perché una pagina statica può essere utile prima di introdurre PHP?

Perché definisce il contratto visuale: header, navigazione, sidebar, area prodotti, paginazione e footer. La struttura può essere validata prima di aggiungere logica dinamica.

## 2. Qual è il ruolo del container Bootstrap?

Fornisce un contenitore centrale e una base coerente per il layout responsive della pagina.

## 3. Perché usare la griglia Bootstrap?

La griglia consente di dividere la pagina in aree responsive, ad esempio sidebar e contenuto principale, e di distribuire le card su più colonne.

## 4. Cosa significa `col-md-4`?

Dal breakpoint `md` in su, l'elemento occupa 4 colonne su 12. Tre elementi `col-md-4` possono quindi stare sulla stessa riga.

## 5. Perché le dodici card statiche sono didatticamente utili?

Rendono evidente la ripetizione strutturale. Questa ripetizione prepara il passaggio successivo a un rendering dinamico basato su dati e cicli.

## 6. La paginazione visibile in PHP 2 è già vera paginazione?

No. I link `1`, `2`, `3` sono solo presentazione. Non calcolano offset e non selezionano record diversi.

## 7. Perché non aggiungiamo `foreach` o PDO in questa lezione?

Perché l'artifact recuperato non li contiene. Inserirli qui mescolerebbe PHP 2 con concetti documentati soltanto nelle lezioni successive.

## 8. Qual è la differenza tra struttura statica e contenuto dinamico?

La struttura statica è markup scritto direttamente nel file. Il contenuto dinamico viene invece generato a runtime a partire da dati, condizioni o query.

## 9. Perché l'assenza di PHP nell'artifact è anch'essa evidence?

Perché stabilisce un confine: ciò che possiamo affermare con certezza è che l'artifact disponibile era HTML statico. Non possiamo attribuirgli logica non presente.

## 10. Perché servire il file via HTTP è una verifica migliore del solo controllo del sorgente?

Perché verifica che il browser/server riceva realmente la pagina e che il markup atteso venga restituito con successo, non solo che il file esista sul disco.

## Sintesi

```text
layout statico
→ griglia Bootstrap
→ card ripetute
→ paginazione solo visuale
→ nessun PHP/database ancora
→ base per il rendering dinamico successivo
```
