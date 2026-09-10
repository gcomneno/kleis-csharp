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

## Lessons

- [Lesson 1 — Language fundamentals and first dynamic page](lessons/lesson-01-learned.md)
- [Lesson 2 — Static catalog layout as a bridge to dynamic rendering](lessons/lesson-02-learned.md)
- [Lesson 3 — Database-backed catalog with PDO, filtering, and pagination](lessons/lesson-03-learned.md)
- [Lesson 4 — Complete CRUD with PDO, validation, detail, edit, delete, and Bootstrap UI](lessons/lesson-04-learned.md)
- [Lesson 4 — CRUD completion note](lessons/lesson-04-crud-completion.md)

### PHP 4: what to inspect

Lesson 4 is the most complete checkpoint in the current PHP module. It includes:

- catalog filtering and pagination;
- product detail;
- creation through a prepared `INSERT`;
- editing through a pre-populated form and prepared `UPDATE`;
- deletion with GET confirmation and the actual mutation performed only through POST;
- HTML escaping and server-side validation;
- MySQL access through PDO;
- Bootstrap presentation for catalog, forms, detail, and delete confirmation;
- an isolated end-to-end CRUD road test.

Code: [`exercises/lesson-04/`](exercises/lesson-04/)

Canonical Lesson Learned: [`lessons/lesson-04-learned.md`](lessons/lesson-04-learned.md)

## Evidence boundary

HANDOUT CONTENT != EVIDENCE OF CLASSROOM COMPLETION

TEACHER SNAPSHOT != OUR IMPLEMENTATION

For PHP 4, the teacher snapshot supports reconstruction up to the POST boundary, while the final lab requirement was completed and verified as end-to-end CRUD. The two are documented separately.

Only locally reproduced and verified work is marked as completed in this lab.

## Runtime readiness

Verified local baseline:

- PHP 8.3.6;
- PDO available;
- `pdo_sqlite` available;
- `pdo_mysql` available;
- MySQL 8.0.46 available and verified for PHP 3 and PHP 4.

PDO/MySQL readiness was verified before reproducing the database-backed PHP 3 and PHP 4 lessons.

For the PHP 4 demo, start the development server from the lesson directory:

```bash
cd php-lab/exercises/lesson-04
PHP4_DB_PASSWORD='LOCAL_PASSWORD' php -S 127.0.0.1:8084
```

The application requires the password through the `PHP4_DB_PASSWORD` environment variable; the repository contains no real credentials. Opening `http://127.0.0.1:8084/` redirects to the catalog.
