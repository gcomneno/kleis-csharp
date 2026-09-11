# PHP 4 — Study questions and answers

This sheet accompanies `lesson-04-learned.md` and reviews the complete CRUD flow while keeping the recovered teacher snapshot distinct from the final verified implementation.

## 1. What does CRUD mean?

CRUD represents four distinct capabilities:

```text
Create → INSERT
Read   → SELECT
Update → UPDATE
Delete → DELETE
```

A form alone does not prove a complete CRUD implementation.

## 2. Why is receiving `$_POST` not the same as persistence?

`$_POST` only contains input received from the request. Persistence happens only when a SQL mutation successfully changes the database.

## 3. Why does `salva.php` use a prepared `INSERT`?

Because form values are dynamic data. Prepared statements keep SQL structure separate from submitted values.

## 4. Why does editing require a SELECT first?

The current record must be loaded to pre-populate the form and ensure the intended `id` is being updated.

## 5. Why is the real delete operation not triggered by GET?

GET should be safe for navigation/read operations. The `Elimina` link opens confirmation, while the actual `DELETE` executes only after an explicit POST.

## 6. Why use both application validation and database constraints?

They protect different layers. The application validates input and references before the query; the database preserves structural integrity.

## 7. Why may genre be `NULL`?

Because genre is optional in the schema. Validation must distinguish a valid genre from intentionally having no genre.

## 8. Which privileges does the CRUD DB user need?

The final application needs:

```text
SELECT, INSERT, UPDATE, DELETE
```

Unlike PHP 3, read-only `SELECT` access is no longer enough.

## 9. Why was `descrizione` not added to the database?

Because a field appearing in the teacher form does not prove that a `brani.descrizione` column exists. The schema is based only on corroborated evidence.

## 10. Why is the end-to-end road test important?

It actually executes Create, Read, Update, and Delete against a temporary database and also checks PHP syntax and server errors. This provides stronger evidence than static inspection alone.

## Summary

```text
form
→ validation
→ prepared statement
→ SQL mutation
→ redirect/read-back
→ runtime verification

GET confirms DELETE
POST performs DELETE
```
