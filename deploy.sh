git pull origin main
composer dump-autoload

npm run build

php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
php artisan icons:cache
php artisan filament:optimize