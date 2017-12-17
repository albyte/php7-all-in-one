FROM apparena/php7-xdebug
ADD custom-vhost.conf /etc/apache2/sites-available/custom-vhost.conf
ADD php.ini /usr/local/etc/php/php.ini
ENV xdebug_remote_host docker.for.mac
ENV xdebug_remote_port 9000
ENV xdebug_idekey PHPSTORM
ENV docker true
CMD ["apache2-foreground"]