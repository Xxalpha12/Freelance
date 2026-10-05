FROM php:8.2-apache

# PHP MySQL drivers + a small built-in MariaDB server
RUN apt-get update \
 && apt-get install -y --no-install-recommends mariadb-server \
 && rm -rf /var/lib/apt/lists/* \
 && docker-php-ext-install mysqli pdo_mysql \
 && a2enmod rewrite headers

# Keep MariaDB small enough for Render's free 512 MB instance
RUN printf "[mysqld]\nbind-address=127.0.0.1\ninnodb_buffer_pool_size=32M\nperformance_schema=OFF\nkey_buffer_size=8M\nmax_connections=30\n" \
    > /etc/mysql/mariadb.conf.d/99-small.cnf

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html \
 && chmod +x /var/www/html/start.sh

CMD ["/var/www/html/start.sh"]
