#!/usr/bin/env bash
# Deploy Integrated Rehab website on Ubuntu VPS with Nginx + PHP 8.2 + MySQL
# Usage: sudo bash deploy.sh yourdomain.com

set -euo pipefail

DOMAIN="${1:-integratedrehabandphysicaltherapy.com}"
APP_DIR="/var/www/rehab"
PHP_SOCK="/var/run/php/php8.2-fpm.sock"

if [[ $EUID -ne 0 ]]; then
  echo "Run as root: sudo bash deploy.sh yourdomain.com"
  exit 1
fi

echo "==> Checking PHP extensions..."
php -m | grep -q bcmath || apt install -y php8.2-bcmath

echo "==> Installing Composer dependencies..."
cd "$APP_DIR"
sudo -u www-data composer install --no-dev --optimize-autoloader

if [[ ! -f .env ]]; then
  echo "==> Creating .env from .env.example..."
  cp .env.example .env
  echo ""
  echo "IMPORTANT: Edit $APP_DIR/.env before continuing."
  echo "Set DB_PASSWORD, ADMIN_PASSWORD, MAIL_PASSWORD, APP_URL=https://$DOMAIN"
  echo "Set APP_ENV=production, APP_DEBUG=false, ADMIN_SIGNUP_ENABLED=false"
  echo ""
  read -r -p "Press Enter after you have saved .env..."
fi

echo "==> Laravel setup..."
php artisan key:generate --force
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder --force
php artisan db:seed --class=ServiceHighlightSeeder --force
php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Fixing permissions..."
chown -R www-data:www-data "$APP_DIR"
chmod -R 775 storage bootstrap/cache

echo "==> Creating Nginx site..."
cat > "/etc/nginx/sites-available/rehab" <<NGINX
server {
    listen 80;
    server_name ${DOMAIN} www.${DOMAIN};
    root ${APP_DIR}/public;
    index index.php;
    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:${PHP_SOCK};
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
NGINX

ln -sf /etc/nginx/sites-available/rehab /etc/nginx/sites-enabled/rehab
nginx -t
systemctl reload nginx

echo ""
echo "Deployment complete (HTTP)."
echo "Next: point DNS A record for $DOMAIN to this server IP, then run:"
echo "  certbot --nginx -d $DOMAIN -d www.$DOMAIN"
echo ""
echo "Test:"
echo "  https://$DOMAIN"
echo "  https://$DOMAIN/contact"
echo "  https://$DOMAIN/admin/login"
