# PHP 5 — Study questions and answers

This study sheet complements the PHP 5 Lesson Learned on **sessions, cart state, and order preparation**.

Main reference: [`lesson-05-learned.md`](lesson-05-learned.md).

## 1. Why is `session_start()` required?

`session_start()` starts a new PHP session or resumes the session associated with the current request.

It gives PHP access to the visitor's session context, including `$_SESSION`, and is the first step before reading the current session identifier.

```php
session_start();
$sessionid = session_id();
```

## 2. What is `session_id()`?

`session_id()` returns the identifier of the current PHP session.

It can be treated as a temporary identifier that lets the server associate multiple requests with the same browsing context.

In this lesson it is stored with cart rows so they can later be selected for the current session only.

## 3. Why does the cart store both `id_brano` and `sessionid`?

They answer two different questions:

```text
id_brano  → which product?
sessionid → which cart/session owns it?
```

Without the product id we would not know what was added; without the session id we would not know which cart it belongs to.

## 4. How are two users' carts kept separate?

Each session has a different identifier. Cart queries filter rows using the current session id.

```sql
SELECT ...
FROM carrello
WHERE sessionid = :sessionid;
```

Different sessions therefore retrieve different sets of rows.

## 5. Why should an `INSERT` not be triggered by GET?

GET should be used for reading or navigation, not for changing server state.

GET URLs can be reloaded, bookmarked, prefetched, indexed, or opened automatically. If a GET caused an `INSERT`, merely opening a URL could mutate the cart.

The lab therefore uses:

```text
GET  → read / navigate
POST → mutate state
```

## 6. Why use prepared statements for `sessionid` too?

Because `sessionid` is still a dynamic runtime value that enters an SQL statement.

The lab keeps SQL structure separate from runtime values:

```php
$stmt = $pdo->prepare(
    'INSERT INTO carrello (id_brano, sessionid) VALUES (:id_brano, :sessionid)'
);

$stmt->execute([
    'id_brano' => $productId,
    'sessionid' => session_id(),
]);
```

Prepared statements avoid arbitrary string concatenation and keep queries safer and easier to reason about.

## 7. What is the difference between a PHP session and data persisted in the database?

A PHP session represents **temporary visitor-specific state**.

The database contains **persistent data** that remains stored independently from a single PHP request.

In this lesson:

```text
PHP session
→ identifies the temporary browsing context

session id
→ links that context to cart rows

database
→ persists the cart rows
```

## 8. Why does the order form already exist even though it saves nothing?

Because PHP 5 homework requires preparing the form and the required order data, while teacher evidence explicitly places **order persistence** in the next lesson.

The correct boundary is:

```text
ORDER FORM=YES
ORDER INSERT=NO
TRANSACTION=NO
```

The form prepares the interface without pretending that the next topic has already been taught.

## 9. What problem will transactions solve in the next lesson?

Transactions let several SQL operations behave as one logical unit.

An order may require operations such as:

```text
create order
→ save order lines
→ update/clear cart
```

If one step fails, the database should not remain in a half-completed state.

Transactions provide:

```text
all steps succeed → COMMIT
something fails   → ROLLBACK
```

Their core purpose here is atomicity.

## 10. Why is InnoDB more suitable than MyISAM once transactions are involved?

InnoDB supports transactions, including `COMMIT` and `ROLLBACK`, as well as foreign keys and concurrency behavior better suited to relational data.

MyISAM does not provide real transactional semantics, so it is a poor fit when order, order lines, and cart state must remain consistent as one operation.

## Summary

```text
session_start()
→ starts/resumes the session context

session_id()
→ identifies that context

id_brano + sessionid
→ links product and cart

POST
→ performs state mutation

prepared statements
→ separate SQL and runtime values

database
→ persists cart data

transaction
→ provides all-or-nothing behavior

InnoDB
→ supports COMMIT / ROLLBACK and relational constraints
```

## Study checkpoint

After review, you should be able to explain:

```text
PHP_5_SESSION_START=UNDERSTOOD
PHP_5_SESSION_ID=UNDERSTOOD
PHP_5_CART_OWNERSHIP=UNDERSTOOD
PHP_5_POST_MUTATION_BOUNDARY=UNDERSTOOD
PHP_5_PREPARED_STATEMENTS=UNDERSTOOD
PHP_5_SESSION_VS_DATABASE=UNDERSTOOD
PHP_5_ORDER_FORM_BOUNDARY=UNDERSTOOD
PHP_5_TRANSACTION_PURPOSE=UNDERSTOOD
PHP_5_INNODB_REASON=UNDERSTOOD
```
