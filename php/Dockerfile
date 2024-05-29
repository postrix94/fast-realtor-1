FROM php:8.3-apache

WORKDIR /var/www/fast-realtor
RUN apt-get install && apt-get update -y \
    && docker-php-ext-install pdo_mysql  \
    && apt-get install -y bzip2 libbz2-dev \
    && apt-get install -y libzip-dev \
    && apt-get install -y p7zip


RUN docker-php-ext-install zip
RUN apt install -y libxml2-dev
RUN docker-php-ext-install bz2
RUN apt install -y libldap2-dev
RUN apt install -y libxml2-dev
RUN apt install -y curl
RUN docker-php-ext-install soap
RUN docker-php-ext-install dom
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu
RUN docker-php-ext-install ldap
RUN docker-php-ext-install xml

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

COPY ./php/apache/fast-realtor.conf /etc/apache2/sites-available/fast-realtor.conf
#COPY ./php/php.ini /usr/local/etc/php/conf.d

RUN a2enmod rewrite  && a2ensite fast-realtor

RUN service apache2 restart

#RUN chown -R www-data:www-data storage