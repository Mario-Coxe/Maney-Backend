# Utilize uma imagem base do PHP-FPM com extensões necessárias
FROM php:8.1-fpm

# Instale as dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    zlib1g-dev \
    libxml2-dev \
    libzip-dev \
    unzip \
    libonig-dev \
    nano

# Instale as extensões do PHP necessárias
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip opcache

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho
WORKDIR /var/www

# Copie o código-fonte do Laravel para o contêiner
COPY . /var/www

# Instale as dependências do projeto
RUN composer install --optimize-autoloader --no-dev

# Copie o arquivo .env.example para .env
COPY .env.example .env

# Gere a chave de aplicação do Laravel
RUN php artisan key:generate

# Crie o link simbólico para a pasta de armazenamento
RUN php artisan storage:link

# Dê permissões de escrita para as pastas storage e bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Instale o supervisor para gerenciar processos
RUN apt-get update && apt-get install -y supervisor

# Copie o arquivo de configuração do supervisor para o contêiner
COPY docker/services/app/supervisord.conf /etc/supervisor/conf.d/laravel-websockets.conf

# Exponha a porta 6001 para o Laravel WebSockets
EXPOSE 6001

# Inicie o supervisor para executar o Laravel WebSockets e o PHP-FPM
CMD ["supervisord", "-n", "-c", "/etc/supervisor/conf.d/laravel-websockets.conf"]
