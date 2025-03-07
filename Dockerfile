# Usa a imagem do PHP 8.2 com Apache
FROM php:8.2-apache

# Expõe a porta correta para o Render
EXPOSE 8080

# Atualiza os pacotes do sistema e instala dependências
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    git \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip intl pcntl

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos do Laravel para dentro do container
COPY . .

# Instala Composer e dependências do Laravel
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Permissões para storage e cache
RUN chmod -R 775 storage bootstrap/cache

# Aponta o Apache para rodar a pasta public/ do Laravel
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Configura a porta 8080 no Apache
RUN sed -i 's|Listen 80|Listen 8080|' /etc/apache2/ports.conf \
    && sed -i 's|<VirtualHost *:80>|<VirtualHost *:8080>|' /etc/apache2/sites-available/000-default.conf

# Define o Apache para rodar Laravel
CMD ["apache2-foreground"]
