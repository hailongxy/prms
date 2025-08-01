FROM php-kylin-arm64:latest

WORKDIR /var/www/html

COPY . .

RUN chmod 777 /var/www/html -R

EXPOSE 9000

CMD ["php-fpm", "-F", "-y", "/usr/local/php8/etc/php-fpm.conf"]
