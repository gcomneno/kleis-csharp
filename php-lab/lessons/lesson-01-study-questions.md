# PHP 1 — Study questions and answers

This sheet accompanies `lesson-01-learned.md` and stays within concepts actually reconstructed and verified in Lesson 1.

## 1. How are variables declared and used in PHP?

PHP variables start with `$`, for example:

```php
$price = 12.50;
```

Their value can be reassigned while the program runs.

## 2. Why use a temporary variable when swapping two values?

Because assigning one value over the other would otherwise lose the original value:

```php
$tmp = $a;
$a = $b;
$b = $tmp;
```

## 3. What is `number_format()` for?

It formats a number for display, such as fixing the number of decimal places. It produces a presentation-oriented string.

## 4. What is the difference between indexed and associative arrays?

Indexed arrays use numeric keys; associative arrays use meaningful keys such as `name` and `price`. Associative arrays are useful for record-like data.

## 5. What is the difference between `define()` and `const`?

Both define constants. `define()` is a runtime function, while `const` is language syntax.

## 6. What do `PHP_VERSION` and `__DIR__` represent?

`PHP_VERSION` reports the current PHP runtime version. `__DIR__` is a magic constant containing the current file directory.

## 7. When should `for` and `foreach` be used?

`for` is useful when an explicit counter matters. `foreach` is usually the natural choice for iterating array elements or key/value pairs.

## 8. What do `%` and `continue` do?

`%` computes a remainder, which can identify values such as multiples of three. `continue` skips the rest of the current iteration.

## 9. What are `$_GET` and `??` used for?

`$_GET` exposes query-string parameters. `??` provides a fallback when a value is missing:

```php
$age = $_GET['age'] ?? null;
```

## 10. How can PHP generate dynamic HTML?

PHP expressions and control structures can be embedded in HTML. The short echo syntax `<?= $value ?>` renders a value directly into the response.

## Summary

```text
variables → mutable data
arrays → structured data
for/foreach → iteration
if/else → decisions
$_GET → query-string input
<?= ?> → dynamic output
```
