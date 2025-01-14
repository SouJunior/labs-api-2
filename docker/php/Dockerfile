FROM php:8.3.10-fpm

#comes from docker-conmpose
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    redis  \
    && pecl install redis \
      xdebug \
      pcov \
    && docker-php-ext-enable redis xdebug pcov

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Configura o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
 RUN curl --silent --show-error https://getcomposer.org/installer | php && \
     mv composer.phar /usr/local/bin/composer && \
     chmod +x /usr/local/bin/composer && \
     composer self-update --preview
 RUN command -v composer

RUN chown -R www-data:www-data /var/www/html


# Criação de usuário no container para rodar o Composer e Artisan Commands sem ter problema de permissão no arquivo
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user && \
    chown -R $user:$user /var/www/html
USER $user
# make an if for bash for APP_ENV is diferent from production

RUN echo "alias test='php artisan test'" >> ~/.bashrc
RUN echo "alias art='php artisan'" >> ~/.bashrc
RUN echo "alias model='php artisan make:model'" >> ~/.bashrc
RUN echo "alias migrate='php artisan migrate'" >> ~/.bashrc
RUN echo "alias rollback='php artisan migrate:rollback'" >> ~/.bashrc

CMD [ "php-fpm" ]
