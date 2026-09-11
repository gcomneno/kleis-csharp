# PHP 2 — Study questions and answers

This sheet accompanies `lesson-02-learned.md` and stays within the verified Lesson 2 boundary: a static Bootstrap catalog with no PHP or database logic.

## 1. Why is a static page useful before adding PHP?

It establishes the visual contract: header, navigation, sidebar, product area, pagination, and footer.

## 2. What is the role of the Bootstrap container?

It provides a centered responsive layout boundary for the page.

## 3. Why use the Bootstrap grid?

It divides the page into responsive regions and distributes product cards across columns.

## 4. What does `col-md-4` mean?

At the `md` breakpoint and above, the element uses 4 of 12 grid columns, so three such cards fit in one row.

## 5. Why are twelve static cards useful for learning?

They expose repeated structure clearly, making the later refactoring toward data-driven rendering easier to understand.

## 6. Is the visible pagination already real pagination?

No. The page links are presentation only; they do not calculate offsets or select different records.

## 7. Why not add `foreach` or PDO here?

Because the recovered artifact does not contain them. Doing so would blur the evidence boundary with later lessons.

## 8. What is the difference between static structure and dynamic content?

Static structure is written directly in the file. Dynamic content is produced at runtime from data, conditions, loops, or queries.

## 9. Why is the absence of PHP itself evidence?

Because it constrains what can be claimed about the recovered artifact: it is a static HTML catalog, not a dynamic application.

## 10. Why serve the file over HTTP instead of only inspecting it?

Because a real HTTP request verifies that the page is actually delivered and contains the expected markup.

## Summary

```text
static layout
→ Bootstrap grid
→ repeated cards
→ visual-only pagination
→ no PHP/database yet
→ foundation for later dynamic rendering
```
