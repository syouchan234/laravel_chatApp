# ベースイメージを指定
FROM php:8.2-fpm

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo_mysql

# Composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# コンテナ内の作業ディレクトリを設定
WORKDIR /var/www/html

# ホストからアプリケーションコードをコピー
COPY . .

# Composerパッケージのインストール
RUN composer install

# アプリケーションの設定
COPY .env.example .env
RUN php artisan key:generate

# ポートのエクスポート
EXPOSE 8000

# サーバーの起動
CMD php artisan serve --host=0.0.0.0 --port=8000
