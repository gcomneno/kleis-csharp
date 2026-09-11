# PHP 3 — Study questions and answers

This sheet accompanies `lesson-03-learned.md` and reviews the move from a static catalog to a MySQL/PDO-backed catalog.

## 1. Why is PHP 3 a major step beyond PHP 2?

Because products are no longer hard-coded in HTML; they are fetched from the database and rendered dynamically.

## 2. What are `include` files for?

They separate responsibilities such as DB connection, query logic, header, footer, filter form, and product rendering.

## 3. Why use PDO?

PDO provides a controlled DB interface with exceptions, associative fetches, and prepared statements that keep SQL separate from runtime values.

## 4. Why normalize the `pagina` parameter?

To prevent invalid or negative page values. The lesson constrains the page to at least `1` before calculating the offset.

## 5. How do `LIMIT` and `OFFSET` work?

`LIMIT` controls how many rows are returned; `OFFSET` controls how many rows are skipped. With 12 items per page, page 2 starts at offset 12.

## 6. Why bind `LIMIT` and `OFFSET` as integers?

Because they are numeric query controls. Explicit `PDO::PARAM_INT` binding preserves the intended type.

## 7. Why use a `LEFT JOIN` for genres?

Because genre is optional. A left join keeps songs whose `genere_id` is `NULL` instead of dropping them.

## 8. What is the difference between prepared statements and `htmlspecialchars()`?

They protect different boundaries. Prepared statements protect SQL/query composition; `htmlspecialchars()` protects HTML rendering.

## 9. Why does the lesson DB user only have `SELECT`?

Because PHP 3 only needs to read the catalog. Least privilege means granting only the operations the application actually requires.

## 10. Why is the local dataset not presented as the teacher's original dataset?

Because the original DDL and data were not recovered. The deterministic fixture enables reproducible verification without falsifying provenance.

## Summary

```text
GET filter/page
→ normalize input
→ PDO prepared query
→ JOIN + LIMIT/OFFSET
→ PHP arrays
→ HTML escaping
→ dynamic rendering
```
