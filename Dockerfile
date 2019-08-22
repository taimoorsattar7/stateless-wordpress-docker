FROM hhvm/hhvm:3.18-lts-latest

ENV DEBIAN_FRONTEND noninteractive

# apt stuff
RUN add-apt-repository ppa:nginx/stable && \
    apt-get -qq update && \
    apt-get -y install nginx curl unzip

# "external" stuff
RUN curl https://wordpress.org/latest.zip -o /var/www/latest.zip && \
  cd /var/www && \
  unzip latest.zip

# hhvm stuff
COPY hhvm/server.ini /etc/hhvm
COPY hhvm/php.ini /etc/hhvm

# nginx stuff
COPY nginx.conf /etc/nginx

ADD themes /var/www/wordpress/wp-content

ADD wp-config.php /var/www/wordpress

WORKDIR /srv

ENV PORT 3000
ENV HOST 0.0.0.0

COPY run.sh .
RUN chmod 755 run.sh

CMD ["./run.sh"]
