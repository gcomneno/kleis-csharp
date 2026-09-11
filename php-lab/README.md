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
| PHP 5 | TEACHER SNAPSHOT RECOVERED — CART + SESSIONS | LAB IMPLEMENTATION PREPARED; RUNTIME VERIFICATION PENDING |

## Lessons

- [Lesson 1 — Language fundamentals and first dynamic page](lessons/lesson-01-learned.md)
- [Lesson 2 — Static catalog layout as a bridge to dynamic rendering](lessons/lesson-02-learned.md)
- [Lesson 3 — Database-backed catalog with PDO, filtering, and pagination](lessons/lesson-03-learned.md)
- [Lesson 4 — Complete CRUD with PDO, validation, detail, edit, delete, and Bootstrap UI](lessons/lesson-04-learned.md)
- [Lesson 4 — CRUD completion note](lessons/lesson-04-crud-completion.md)
- [Lesson 5 — Cart, sessions, and order preparation](lessons/lesson-05-learned.md)

### PHP 4: what to inspect

Lesson 4 closes the product CRUD cycle. It includes prepared `INSERT`, `SELECT`, `UPDATE`, and `DELETE`, server-side validation, HTML escaping, Bootstrap UI, and an isolated end-to-end road test.

Code: [`exercises/lesson-04/`](exercises/lesson-04/)

Canonical Lesson Learned: [`lessons/lesson-04-learned.md`](lessons/lesson-04-learned.md)

### PHP 5: what to inspect

Lesson 5 introduces temporary per-user state through PHP sessions and a database-backed cart:

- `session_start()` and `session_id()`;
- `carrello` table linking product id and session id;
- add-to-cart mutation;
- reading only rows belonging to the current session;
- homework completion: cart table and total;
- order-data form prepared without persisting an order yet;
- explicit boundary: order persistence and transactions belong to the next lesson.

Code: [`exercises/lesson-05/`](exercises/lesson-05/)

Canonical Lesson Learned: [`lessons/lesson-05-learned.md`](lessons/lesson-05-learned.md)

Teacher evidence: [`evidence/php-05/README.it.md`](evidence/php-05/README.it.md)

## Evidence boundary

HANDOUT CONTENT != EVIDENCE OF CLASSROOM COMPLETION

TEACHER SNAPSHOT != OUR IMPLEMENTATION

For PHP 4, the teacher snapshot and final CRUD implementation remain documented separately.

For PHP 5, the teacher snapshot proves cart + `session_id()` + cart page and assigns the table/order-form homework. Order persistence and transactions are explicitly deferred to the next lesson.

Only work that has actually been run and verified is marked as verified. The PHP 5 lab implementation is prepared for runtime verification, which remains a separate gate.

## Runtime readiness

Previously verified local baseline:

- PHP 8.3.6;
- PDO available;
- `pdo_sqlite` available;
- `pdo_mysql` available;
- MySQL 8.0.46 available and verified for PHP 3 and PHP 4.

PHP 5 uses `PHP5_DB_*` environment variables and stores no real credentials in the repository.
