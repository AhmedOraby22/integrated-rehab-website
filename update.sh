#!/usr/bin/env bash
# Pull latest code and refresh Laravel caches (run after git push)
set -euo pipefail

cd /var/www/rehab
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
chown -R www-data:www-data /var/www/rehab
chmod -R 775 storage bootstrap/cache

echo "Update complete."
