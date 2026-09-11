# PHP Lab

[English](README.md) | [Italiano](README.it.md)

This lab reconstructs, reproduces, and verifies the PHP module of the Kleis Software Developer course.

Recovered teacher material is evidence of the course, not proof that a topic has been learned or reproduced locally. When the final lesson requirement goes beyond what the recovered teacher snapshot proves, the lab keeps the boundary between recovered evidence and the final verified implementation explicit.

## Recovery workflow

source evidence -> reconstruct -> understand -> reproduce -> run -> verify -> document

## Recovery checkpoint

| Lesson | Reconstruction status | Local reproduction |
| --- | --- | --- |
| PHP 1 | RECONSTRUCTED | REPRODUCED AND VERIFIED |
| PHP 2 | RECONSTRUCTED TO AVAILABLE ARTIFACT | REPRODUCED AND VERIFIED |
| PHP 3 | RECONSTRUCTED TO AVAILABLE ARTIFACT | REPRODUCED AND VERIFIED |
| PHP 4 | RECONSTRUCTED TO AVAILABLE SNAPSHOT + FINAL CRUD | REPRODUCED AND VERIFIED END TO END |
| PHP 5 | TEACHER SNAPSHOT RECOVERED — CART + SESSIONS | REPRODUCED AND VERIFIED END TO END |

## Lessons and study sheets

Every PHP lesson now has both a canonical Lesson Learned and a dedicated question-and-answer study sheet.

- [Lesson 1 — Lesson Learned](lessons/lesson-01-learned.md) · [Study questions](lessons/lesson-01-study-questions.md)
- [Lesson 2 — Lesson Learned](lessons/lesson-02-learned.md) · [Study questions](lessons/lesson-02-study-questions.md)
- [Lesson 3 — Lesson Learned](lessons/lesson-03-learned.md) · [Study questions](lessons/lesson-03-study-questions.md)
- [Lesson 4 — Lesson Learned](lessons/lesson-04-learned.md) · [Study questions](lessons/lesson-04-study-questions.md)
- [Lesson 4 — CRUD completion note](lessons/lesson-04-crud-completion.md)
- [Lesson 5 — Lesson Learned](lessons/lesson-05-learned.md) · [Study questions](lessons/lesson-05-study-questions.md)

### PHP 4: what to inspect

Lesson 4 closes the product CRUD cycle with filtering/pagination, product detail, prepared `INSERT`/`UPDATE`/`DELETE`, GET confirmation but POST-only deletion, validation, HTML escaping, PDO/MySQL, Bootstrap, and an isolated end-to-end road test.

Code: [`exercises/lesson-04/`](exercises/lesson-04/)

### PHP 5: what to inspect

Lesson 5 introduces temporary per-user state through PHP sessions and a database-backed cart:

- `session_start()` and `session_id()`;
- `carrello` table linking product and session;
- POST-only add-to-cart;
- reading only rows belonging to the current session;
- cart table and total;
- order-data form prepared without persisting an order yet;
- explicit boundary: order persistence and transactions belong to the next lesson.

Code: [`exercises/lesson-05/`](exercises/lesson-05/)

Teacher evidence: [`evidence/php-05/README.it.md`](evidence/php-05/README.it.md)

Road test: [`exercises/lesson-05/road-test-cart.sh`](exercises/lesson-05/road-test-cart.sh)

## Evidence boundary

HANDOUT CONTENT != EVIDENCE OF CLASSROOM COMPLETION

TEACHER SNAPSHOT != OUR IMPLEMENTATION

For PHP 4, the teacher snapshot and the final CRUD implementation remain documented separately.

For PHP 5, the teacher snapshot proves cart + `session_id()` + cart page and assigns the table/order-form homework. Order persistence and transactions are explicitly deferred to the next lesson.

Only work that has actually been run and verified is marked as verified. PHP 5 passed the runtime road test covering add-to-cart, session isolation, cart table, order-form skeleton, PHP syntax, and server error gate.

## Runtime readiness

Verified local baseline:

- PHP 8.3.6;
- PDO available;
- `pdo_sqlite` available;
- `pdo_mysql` available;
- MySQL 8.0.46 available and verified for PHP 3, PHP 4, and PHP 5.

PHP 5 uses `PHP5_DB_*` environment variables and stores no real credentials in the repository.
