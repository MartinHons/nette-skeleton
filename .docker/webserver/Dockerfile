FROM alpine:latest

WORKDIR /var/www/localhost/htdocs/

COPY install.sh /install.sh

RUN /install.sh

COPY httpd.conf /etc/apache2/httpd.conf

COPY php.ini /etc/php83/php.ini

EXPOSE 80 443

CMD ["httpd", "-D", "FOREGROUND"]