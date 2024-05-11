#!/bin/bash

# Inicie o Supervisor
supervisord -n -c /etc/supervisor/conf.d/laravel-websockets.conf &

# Inicie o cron
cron &

# Inicie o PHP-FPM
php-fpm
