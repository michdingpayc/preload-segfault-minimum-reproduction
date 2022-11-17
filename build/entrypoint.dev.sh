#!/bin/sh
mount -a

chmod 766 /proc/self/fd/2 #needs permission change at runtime, not in dockerfile

exec su nginx -s /bin/sh -c "php-fpm"
#exec su nginx -s /bin/sh -c "php-fpm -v"
#exec su nginx -s /bin/sh -c "docker-php-entrypoint"
