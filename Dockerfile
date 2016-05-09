FROM debian:jessie
MAINTAINER Kenyon Haliwell <kenyon@moveyourmountain.org>
RUN apt-get update && \
    apt-get -y install curl git && \
    echo "\ndeb http://packages.dotdeb.org jessie all\ndeb-src http://packages.dotdeb.org jessie all" >> /etc/apt/sources.list && \
    curl -O https://www.dotdeb.org/dotdeb.gpg && apt-key add dotdeb.gpg && \
    rm dotdeb.gpg && \
    apt-get update && \
    mkdir -p /run/php && \
	apt-get -y install nginx php7.0 php7.0-fpm php7.0-mysql php7.0-mcrypt && \
	apt-get clean && \
	curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer && \
	rm -rf /var/www/html
COPY nginx-default.conf /etc/nginx/sites-available/default
RUN mkdir -p /var/www/accounts/code/public
WORKDIR /var/www/accounts

ENTRYPOINT service nginx restart && service php7.0-fpm restart && bash