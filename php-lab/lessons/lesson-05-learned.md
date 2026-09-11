# Lesson Learned — PHP 5: cart, sessions, and order preparation

## Lesson status

This document formalizes the fifth PHP lesson of the Kleis course, taught on **10 September 2026**.

Teacher evidence:

- archive `20260910 backup sito.zip`;
- SHA-256 `cb6bf82d80658f3c630f1ed0f35c550785bdfaf16e57e8e2a1d979ad65b95bb1`;
- `info.txt` documenting the lesson, homework, and the next topic.

Canonical status:

```text
PHP_5_TOPIC=CART_AND_SESSIONS
PHP_5_TEACHER_SNAPSHOT=RECOVERED
PHP_5_CART_TABLE=PROVEN
PHP_5_SESSION_ID_PERSISTENCE=PROVEN
PHP_5_CART_PAGE=PROVEN
PHP_5_HOMEWORK_CART_TABLE=IMPLEMENTED_IN_LAB
PHP_5_HOMEWORK_ORDER_FORM=IMPLEMENTED_AS_NON_PERSISTING_SKELETON
PHP_5_ORDER_PERSISTENCE=NOT_YET_TAUGHT
PHP_5_TRANSACTIONS=NEXT_LESSON
```

## Core idea

PHP 4 completed product CRUD. PHP 5 introduces temporary per-user state.

The teacher snapshot uses:

```php
session_start();
$sessionid = session_id();
```

and stores that identifier with the product id:

```sql
INSERT INTO carrello (id_brano, sessionid)
VALUES (:id_brano, :sessionid)
```

The cart is then read by filtering rows for the current session id.

## Lab implementation

The lab preserves the taught concept while tightening the boundaries:

- cart mutation is POST-only;
- PDO prepared statements are used for runtime values;
- credentials come from environment variables;
- InnoDB, a foreign key, and an index replace the teacher snapshot's MyISAM table;
- the homework list is completed as an HTML table with total;
- the order-data form is present but intentionally does not persist an order yet.

The lesson flow is:

```text
catalog
→ POST add-to-cart
→ session_start()
→ session_id()
→ INSERT cart row
→ redirect to cart
→ SELECT current-session rows
→ cart table + total
→ order-data form
→ STOP: order persistence and transactions belong to the next lesson
```

## Study order

Read:

1. `exercises/lesson-05/database/schema.sql`
2. `exercises/lesson-05/include/db.php`
3. `exercises/lesson-05/include/cart.php`
4. `exercises/lesson-05/prodotti.php`
5. `exercises/lesson-05/aggiungialcarrello.php`
6. `exercises/lesson-05/carrello.php`
7. `exercises/lesson-05/README.it.md`

Teacher evidence is recorded in `evidence/php-05/README.it.md`.

## Questions to be able to answer

- Why is `session_start()` required?
- What does `session_id()` identify?
- Why does each cart row contain both product id and session id?
- How are two users' carts separated?
- Why should a state-changing INSERT use POST rather than GET?
- Why are prepared statements still needed for the session id?
- Why is the order form present while order persistence is deferred?
- Why is InnoDB relevant to the next lesson on transactions?

## Final checkpoint

```text
PHP_5=FORMALIZED
CART_MODEL=UNDERSTOOD
SESSION_ID_BOUNDARY=UNDERSTOOD
ADD_TO_CART=IMPLEMENTED
CART_READ=IMPLEMENTED
HOMEWORK_TABLE=IMPLEMENTED
ORDER_FORM_SKELETON=IMPLEMENTED
ORDER_PERSISTENCE=DEFERRED
TRANSACTIONS=DEFERRED_TO_NEXT_LESSON
```
