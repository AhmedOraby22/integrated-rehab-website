#!/usr/bin/env bash
set -euo pipefail

cd /var/www/rehab

echo "==> Create database (enter MySQL root password when prompted)"
mysql -u root -p < setup-mysql.sql

echo ""
echo "==> Edit .env and set DB_PASSWORD to your MySQL root password"
echo "    nano /var/www/rehab/.env"
read -r -p "Press Enter after DB_PASSWORD is saved in .env..."

echo "==> Laravel setup"
php artisan key:generate --force
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder --force
php artisan db:seed --class=ServiceHighlightSeeder --force
php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

chown -R www-data:www-data /var/www/rehab
chmod -R 775 storage bootstrap/cache

echo ""
echo "Done. Test:"
echo "  https://integratedrehabandphysicaltherapy.com"
echo "  https://integratedrehabandphysicaltherapy.com/phpmyadmin"
echo "  Admin login: /admin/login  (user: admin)"
