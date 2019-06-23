FROM ubuntu:18.04

MAINTAINER Stephane Sumo

RUN apt-get update \
    && apt-get install -y nginx 

FROM mysql:8.0

VOLUME /var/lib/mysql

ENV MYSQL_DATABASE=web_database
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_USER=root
ENV MYSQL_PASSWORD=root

CMD ["mysql"]

FROM php:7.3-fpm

VOLUME /usr/share/nginx/html

CMD ["php"]

FROM nginx:1.15

VOLUME /etc/nginx/conf.d

EXPOSE 8080

CMD ["nginx"]
