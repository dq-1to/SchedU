FROM php:8.3-fpm

# 必要拡張（最低限）
RUN docker-php-ext-install pdo pdo_mysql

# あると便利（任意）
# RUN apt-get update && apt-get install -y libzip-dev libicu-dev \
#     && docker-php-ext-install zip intl opcache
