FROM php:7.2-apache

RUN apt-get update && \
    apt-get install wget unzip libldap2-dev libsqlite3-dev libpq-dev -y && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/
RUN docker-php-ext-install ldap pdo pdo_sqlite pdo_pgsql pdo_mysql\
    && a2enmod rewrite

RUN wget https://github.com/YOURLS/YOURLS/archive/master.zip
RUN unzip master.zip -d /var/www/html
RUN mkdir -p /var/www/html/user/plugins/db
RUN mkdir -p /var/www/html/user/plugins/ldap
COPY plugin.php /var/www/html/user/plugins/db/plugin.php
RUN wget https://raw.githubusercontent.com/k3a/yourls-ldap-plugin/master/plugin.php -O /var/www/html/user/plugins/ldap/plugin.php

EXPOSE 80
