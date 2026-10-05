#!/bin/bash
set -e
PORT="${PORT:-80}"
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# No external database configured -> run the built-in one
if [ -z "$DB_HOST" ]; then
  echo "Starting built-in MariaDB..."
  service mariadb start
  until mysqladmin ping --silent; do sleep 1; done

  export DB_HOST=127.0.0.1 DB_PORT=3306 DB_NAME=db_freelance DB_USER=freelance
  export DB_PASS="${DB_PASS:-$(head -c 24 /dev/urandom | base64 | tr -dc 'A-Za-z0-9')}"

  mysql -e "CREATE DATABASE IF NOT EXISTS db_freelance;
            CREATE USER IF NOT EXISTS 'freelance'@'127.0.0.1' IDENTIFIED BY '${DB_PASS}';
            ALTER USER 'freelance'@'127.0.0.1' IDENTIFIED BY '${DB_PASS}';
            GRANT ALL ON db_freelance.* TO 'freelance'@'127.0.0.1'; FLUSH PRIVILEGES;"

  if [ -z "$(mysql -N -e "SHOW TABLES FROM db_freelance LIKE 'users'")" ]; then
    echo "Importing database/db_freelance.sql..."
    mysql db_freelance < /var/www/html/database/db_freelance.sql
  fi
fi

# Optional: set the admin password from Render's environment
if [ -n "$ADMIN_PASSWORD" ]; then
  HASH=$(printf '%s' "$ADMIN_PASSWORD" | md5sum | cut -d' ' -f1)
  mysql -h "$DB_HOST" -P "${DB_PORT:-3306}" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" \
    -e "UPDATE users SET password='${HASH}' WHERE username='admin';" || echo "Could not set admin password"
fi

# Pass DB settings through to PHP
for v in DB_HOST DB_PORT DB_NAME DB_USER DB_PASS DB_SSL BASE_URL; do
  [ -n "${!v}" ] && echo "export $v='${!v}'" >> /etc/apache2/envvars
done
echo "PassEnv DB_HOST DB_PORT DB_NAME DB_USER DB_PASS DB_SSL BASE_URL" > /etc/apache2/conf-enabled/passenv.conf 2>/dev/null || true

exec apache2-foreground
