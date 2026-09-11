# PHP 1 — Domande e risposte di ripasso

Questa scheda accompagna `lesson-01-learned.it.md` e resta entro i concetti realmente ricostruiti e verificati nella Lezione 1.

## 1. Come si dichiara e usa una variabile in PHP?

Una variabile PHP inizia con `$`, per esempio:

```php
$prezzo = 12.50;
```

Il valore può essere riassegnato durante l'esecuzione. PHP determina dinamicamente il tipo del valore assegnato.

## 2. Perché serve una variabile temporanea per scambiare due valori?

Senza conservare uno dei due valori, la prima assegnazione lo sovrascriverebbe. Il pattern classico è:

```php
$tmp = $a;
$a = $b;
$b = $tmp;
```

## 3. A cosa serve `number_format()`?

Serve a formattare un numero per la visualizzazione, ad esempio fissando il numero di decimali. Non cambia il significato matematico del dato: produce una rappresentazione testuale adatta all'output.

## 4. Qual è la differenza tra array indicizzato e array associativo?

Un array indicizzato usa chiavi numeriche; un array associativo usa chiavi significative:

```php
$prodotto = [
    'nome' => 'Libro',
    'prezzo' => 9.99,
];
```

Gli array associativi sono utili per rappresentare record strutturati.

## 5. Che differenza c'è tra `define()` e `const`?

Entrambi definiscono costanti. `define()` è una funzione eseguita a runtime; `const` è sintassi del linguaggio. Una costante, una volta definita, non viene riassegnata come una variabile.

## 6. Cosa rappresentano `PHP_VERSION` e `__DIR__`?

`PHP_VERSION` espone la versione del runtime PHP. `__DIR__` è una costante magica che contiene il percorso della directory del file corrente.

## 7. Quando usare `for` e quando `foreach`?

`for` è adatto quando controlliamo esplicitamente un contatore. `foreach` è più naturale quando vogliamo visitare gli elementi di un array, eventualmente leggendo chiave e valore.

## 8. Cosa fanno `%` e `continue` nel ciclo della lezione?

L'operatore `%` calcola il resto della divisione e permette, per esempio, di riconoscere i multipli di 3. `continue` interrompe l'iterazione corrente e passa alla successiva.

## 9. A cosa servono `$_GET` e l'operatore `??`?

`$_GET` contiene i parametri della query string. L'operatore null coalescing `??` permette di fornire un valore di default quando una chiave non è presente:

```php
$age = $_GET['age'] ?? null;
```

## 10. Come può PHP generare HTML dinamico?

PHP può essere incorporato nel documento HTML. La forma breve:

```php
<?= $valore ?>
```

stampa un'espressione nell'output. Cicli e condizioni consentono quindi di generare markup diverso in base ai dati.

## Sintesi

```text
variabili → dati modificabili
array → dati strutturati
for/foreach → iterazione
if/else → decisione
$_GET → input dalla query string
<?= ?> → output dinamico
```
