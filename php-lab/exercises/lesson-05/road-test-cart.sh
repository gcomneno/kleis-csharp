#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "$0")" && pwd)"
DB="php5_cart_rt_$RANDOM"
DBUSER="php5cart_$RANDOM"
DBPASS="CartRoad_${RANDOM}_$(date +%s)"
PORT=18086
LOG="$(mktemp)"
COOKIE_A="$(mktemp)"
COOKIE_B="$(mktemp)"
SERVER_PID=""

cleanup() {
  set +e
  if [ -n "${SERVER_PID:-}" ]; then
    kill "$SERVER_PID" 2>/dev/null
    wait "$SERVER_PID" 2>/dev/null
  fi
  sudo mysql -e "DROP DATABASE IF EXISTS \`$DB\`; DROP USER IF EXISTS '$DBUSER'@'localhost';" >/dev/null 2>&1
  rm -f "$LOG" "$COOKIE_A" "$COOKIE_B"
}
trap cleanup EXIT INT TERM

sudo mysql <<SQL
CREATE DATABASE \`$DB\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER '$DBUSER'@'localhost' IDENTIFIED BY '$DBPASS';
GRANT SELECT, INSERT ON \`$DB\`.* TO '$DBUSER'@'localhost';
SQL

sudo mysql "$DB" < "$ROOT/database/schema.sql"
sudo mysql "$DB" < "$ROOT/database/seed.sql"

PHP5_DB_HOST=localhost \
PHP5_DB_NAME="$DB" \
PHP5_DB_USER="$DBUSER" \
PHP5_DB_PASSWORD="$DBPASS" \
php -S "127.0.0.1:$PORT" -t "$ROOT" >"$LOG" 2>&1 &
SERVER_PID=$!

for _ in $(seq 1 30); do
  if curl -fsS "http://127.0.0.1:$PORT/prodotti.php" >/dev/null 2>&1; then
    break
  fi
  sleep 0.2
done

echo "===== METHOD BOUNDARY ====="
STATUS="$(curl -sS -o /dev/null -w '%{http_code}' "http://127.0.0.1:$PORT/aggiungialcarrello.php")"
test "$STATUS" = '405'
echo "ADD_GET_REJECTED=PASS"

echo "===== SESSION A ====="
curl -fsS -c "$COOKIE_A" -b "$COOKIE_A" \
  -X POST --data-urlencode 'id=1' \
  -o /dev/null \
  "http://127.0.0.1:$PORT/aggiungialcarrello.php"
CART_A="$(curl -fsS -c "$COOKIE_A" -b "$COOKIE_A" "http://127.0.0.1:$PORT/carrello.php")"
grep -q 'Aurora' <<<"$CART_A"
! grep -q 'Blue River' <<<"$CART_A"
echo "SESSION_A_CART=PASS"

echo "===== SESSION B ====="
curl -fsS -c "$COOKIE_B" -b "$COOKIE_B" \
  -X POST --data-urlencode 'id=2' \
  -o /dev/null \
  "http://127.0.0.1:$PORT/aggiungialcarrello.php"
CART_B="$(curl -fsS -c "$COOKIE_B" -b "$COOKIE_B" "http://127.0.0.1:$PORT/carrello.php")"
grep -q 'Blue River' <<<"$CART_B"
! grep -q 'Aurora' <<<"$CART_B"
echo "SESSION_B_CART=PASS"

echo "===== CART TABLE / HOMEWORK ====="
grep -q '<table' <<<"$CART_A"
grep -q "Dati per l'ordine" <<<"$CART_A"
grep -q 'Salvataggio ordine: prossima lezione' <<<"$CART_A"
echo "CART_TABLE=PASS"
echo "ORDER_FORM_SKELETON=PASS"

echo "===== DATABASE ISOLATION ====="
ROWS="$(sudo mysql -NBe "SELECT COUNT(*) FROM \`$DB\`.carrello")"
test "$ROWS" = '2'
SESSIONS="$(sudo mysql -NBe "SELECT COUNT(DISTINCT sessionid) FROM \`$DB\`.carrello")"
test "$SESSIONS" = '2'
echo "CART_ROWS=PASS"
echo "SESSION_ISOLATION=PASS"

echo "===== STATIC SAFETY ====="
find "$ROOT" -maxdepth 2 -name '*.php' -print0 | xargs -0 -n1 php -l >/dev/null
if grep -Ei 'Fatal error|Uncaught|Parse error' "$LOG"; then
  echo "PHP_SERVER_ERROR_GATE=FAIL"
  exit 1
fi
echo "PHP_SYNTAX=PASS"
echo "PHP_SERVER_ERROR_GATE=PASS"

echo "===== FINAL ====="
echo "PHP_5_ADD_TO_CART=PASS"
echo "PHP_5_SESSION_ISOLATION=PASS"
echo "PHP_5_CART_TABLE=PASS"
echo "PHP_5_ORDER_FORM_SKELETON=PASS"
echo "PHP_5_RUNTIME=PASS"
