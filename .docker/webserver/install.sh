#!/bin/sh
set -eu

apk --no-cache --update add  \
    apache2 \
    apache2-ssl \
    php83 \
    php83-apache2 \
    php83-xml \
    php83-curl \
    php83-dom \
    php83-mysqli \
    php83-mbstring \
    php83-session \
    php83-ctype \
    php83-pdo_mysql \
    php83-pdo \
    php83-tokenizer

ln -s /usr/bin/php83 /usr/bin/php

rm -rf /tmp/*
rm -rf /var/cache/apk/*
