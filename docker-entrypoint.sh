#!/bin/bash
set -e

# Ensure web root ownership and permissions at container startup.
if [ -d "/var/www/html" ]; then
  chown -R www-data:www-data /var/www/html
  find /var/www/html -type d -exec chmod 755 {} \;
  find /var/www/html -type f -exec chmod 644 {} \;
fi

exec "$@"
