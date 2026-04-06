FROM php:8.4-cli

# Instalar extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    unzip curl libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Carpeta de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias
RUN composer install

# Exponer puerto
EXPOSE 8000

# Comando por defecto
CMD php artisan serve --host=0.0.0.0 --port=8000