FROM php:7-fpm

# 拡張モジュールをインストール
RUN docker-php-ext-install pdo pdo_mysql