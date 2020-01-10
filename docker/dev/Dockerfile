FROM php:7.0-fpm

# Retrieve new packages
# Install libicu-dev for php intl extension (required by Symfony)
# Install git (required by Composer)
# Install zip (required by Composer)
RUN apt-get update && apt-get install -qy \
        cron \
        libicu-dev \
        git \
        vim \
        zip \
    && rm -rf /var/lib/apt/lists/* \
    # Install intl, pdo, pdo_mysql extension
    && docker-php-ext-install \
        intl \
        pdo \
        pdo_mysql \
    # Install composer
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    # Set TimeZone
    && cp /usr/share/zoneinfo/Europe/Paris /etc/localtime && echo "Europe/Paris" > /etc/timezone \
    # Add group user And add new user to group user
    && groupadd --gid 1000 user \
    && useradd --uid 1000 --gid user --shell /bin/bash --create-home user

# Copy php.ini file
COPY php.ini /usr/local/etc/php/php.ini
