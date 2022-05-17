## Laravel 7.x & 8.x

To install, please follow these steps. **Note:** We assume you start with a fresh Laravel project.

- `cd` to project directory
- Laravel 7.x `composer require vikdiesel/admin-one-laravel-dashboard:1.3.x --dev`
- Laravel 8.x `composer require vikdiesel/admin-one-laravel-dashboard:1.5.x --dev`
- `composer require laravel/ui`
- `php artisan ui:controllers`
- `php artisan ui:auth`
- `php artisan jb:admin-one-preset`
- `npm install`
- `npm run dev` or `npm run prod`
- `php artisan migrate`
- `php artisan db:seed`

## Laravel 9.x

Please follow [guide for Laravel 9.x Jetstream Inertia Vue](https://github.com/vikdiesel/admin-one-laravel-dashboard).