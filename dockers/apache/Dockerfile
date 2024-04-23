FROM httpd:2.4

RUN apt update && apt install -y certbot python3-certbot-apache lynx php-zip php-gd
RUN a2enmod http2

#RUN groupadd nc-user
#RUN useradd nc-user -g nc-user
#RUN adduser root nc-user

#RUN certbot certonly -v --agree-tos --webroot \
#    -d thakarn.gizmo-thailand.com \
#    --email tonezzz@hotmail.com \
#    --webroot-path /usr/local/apache2/htdocs

#RUN certbot install --certname thakarn.gizmo-thailand.com
#    --apache \

#    --webroot-path /usr/local/apache2/htdocs
#rm /var/log/letsencrypt/letsencrypt.log
#    --dry-run \
#--apache \
#--apache-vhost-root \
#docker exec -i wp_plugin_viweb_apache apt update && apt install -y certbot python3-certbot-apache lynx
#certbot --apache -d thakarn.gizmo-thailand.com --email tonezzz@hotmail.com -n --agree-tos --webroot-path /usr/local/apache2/htdocs
#docker exec -i wp_plugin_viweb_apache ls /home/nc-user/wp_plugin_viweb/persistent-data/uploads
#certbot --apache -d thakarn.gizmo-thailand.com --email tonezzz@hotmail.com
#docker exec -i wp_plugin_viweb_apache cat /usr/local/apache2/conf/extra/httpd-vhosts.conf
#docker exec -i wp_plugin_viweb_apache certbot --test-cert -d thakarn.gizmo-thailand.com
#docker exec -i wp_plugin_viweb_apache certbot install --certname thakarn.gizmo-thailand.com

#git config --global user.name "Tonezzz"
#git config --global user.email "tonezzz@hotmail.com"

#PHP
#docker exec -i wp_plugin_viweb_apache apt install -y php-gd
#docker exec -i wp_plugin_viweb_apache php -i | grep 'GD\|ImageMagick'
#docker exec -i wp_plugin_viweb_apache ls -la /etc/ssl
#docker exec -i wp_plugin_viweb_apache ls -la /var/ssl
#docker exec -i wp_plugin_viweb_apache a2enmod http2 imagick gd2
#docker exec -i wp_plugin_viweb_apache apachectl configtest
#docker exec -i wp_plugin_viweb_apache ls -la /etc/apache2

#docker exec -i wp_plugin_viweb_php-fpm php -i | grep -i --color gd
#docker exec -i wp_plugin_viweb_php-fpm apt install -y libzip-dev
#docker exec -i wp_plugin_viweb_php-fpm docker-php-ext-configure zip && docker-php-ext-configure gd --with-jpeg --with-libzip  && docker-php-ext-install zip gd
#docker exec -i wp_plugin_viweb_php-fpm docker-php-ext-configure zip
#docker exec -i wp_plugin_viweb_php-fpm docker-php-ext-configure gd --with-jpeg
#docker exec -i wp_plugin_viweb_php-fpm docker-php-ext-configure zip --with-libzip
#docker exec -i wp_plugin_viweb_php-fpm docker-php-ext-install zip gd
#docker exec -i wp_plugin_viweb_php-fpm ls -la /usr/local/lib/php

#docker cp wp_plugin_viweb_apache:/etc/apache2/conf-available ./dockers/apache/config-available
#docker cp ./dockers/apache/config-available/http2.conf wp_plugin_viweb_apache:/etc/apache2/conf-available
