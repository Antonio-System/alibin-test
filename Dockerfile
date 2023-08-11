FROM php:8.1

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /var/www/html

COPY . .

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


# Copiar wait-for-it.sh al directorio /usr/local/bin/ dentro del contenedor
COPY wait-for-it.sh /var/www/html/wait-for-it.sh
RUN chmod +x /var/www/html/wait-for-it.sh

# Ejecutar las migraciones y el comando de inicio
# RUN wait-for-it.sh db:5432 -- php artisan migrate --force
CMD []