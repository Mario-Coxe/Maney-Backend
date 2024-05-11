FROM php:8.1-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    curl \
    git \
    jpegoptim optipng pngquant gifsicle \
    locales \
    unzip \
    vim \
    zip \
    zlib1g-dev libzip-dev \
    && docker-php-ext-install zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions

# Graphics Draw
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Multibyte String
RUN apt-get update && apt-get install -y libonig-dev && docker-php-ext-install mbstring

# Miscellaneous
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install exif
RUN docker-php-ext-install pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Install Cron
RUN apt-get update && apt-get install -y cron
RUN echo "* * * * * root php /var/www/artisan schedule:run >> /var/log/cron.log 2>&1" >> /etc/crontab
RUN touch /var/log/cron.log

# Instale o supervisor para gerenciar processos
RUN apt-get update && apt-get install -y supervisor

# Copie o arquivo de configuração do supervisor para o contêiner
COPY ./supervisord.conf /etc/supervisor/conf.d/laravel-websockets.conf

# Exponha a porta 6001 para o Laravel WebSockets
EXPOSE 6001

# Copie o arquivo de script para o contêiner
COPY start.sh /start.sh

# Dê permissão de execução para o arquivo de script
RUN chmod +x /start.sh

# Defina o comando CMD para executar o arquivo de script
CMD ["/start.sh"]
