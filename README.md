# [Admin One — Free Laravel Bulma Dashboard](https://justboil.me/bulma-admin-template/one)

[![Latest Stable Version](https://poser.pugx.org/vikdiesel/admin-one-laravel-dashboard/version)](https://packagist.org/packages/vikdiesel/admin-one-laravel-dashboard) [![Total Downloads](https://poser.pugx.org/vikdiesel/admin-one-laravel-dashboard/downloads)](https://packagist.org/packages/vikdiesel/admin-one-laravel-dashboard) [![License](https://poser.pugx.org/vikdiesel/admin-one-laravel-dashboard/license)](https://packagist.org/packages/vikdiesel/admin-one-laravel-dashboard)

[![Laravel Vue.js Bulma free admin dashboard](https://justboil.me/images/one/repository-preview-laravel-free.png)](https://admin-one-laravel-free.justboil.me)

**Admin One** is simple, beautiful and free Laravel admin dashboard (built with Vue.js, Bulma & Buefy).

* Built for Laravel 7.x
* Fully-styled auth scaffolding
* Profile & avatar management with back-end
* Full Resource CRUD Sample (with front-end & back-end)
* Built with Vue.js, Bulma, Buefy & Laravel Mix
* SPA — Single page app
* SCSS sources with variables
* Free under MIT License
* [Premium version](https://justboil.me/bulma-admin-template/one) available

## Table of Contents

* [Other versions](#other-versions)
* [Description & Demo](#description--demo)
* [Quick Start](#quick-start)
* [Browser Support](#browser-support)
* [Reporting Issues](#reporting-issues)
* [Licensing](#licensing)
* [Useful Links](#useful-links)

## Other versions

More info on free & premium versions of Admin One Dashboard: https://justboil.me/bulma-admin-template/one

### Vue.js Bulma Admin Dashboard (SPA)

**Free & premium.** Vue.js 2.6 + Vue CLI 3.6 SPA Dashboard

https://github.com/vikdiesel/admin-one-vue-bulma-dashboard

### Bulma Admin Dashboard (HTML)

**Free & premium.** HTML + CSS/SCSS Bulma admin dashboard 

https://github.com/vikdiesel/admin-one-bulma-dashboard

## Description & Demo

#### Description

https://justboil.me/bulma-admin-template/one

#### Free Laravel Dashboard demo

https://admin-one-laravel-free.justboil.me

#### Premium Laravel Dashboard demo

https://admin-one-laravel.justboil.me

## Quick Start

To install, please follow these steps. **Note:** We assume you start with a fresh Laravel project.

- `cd` to project directory
- `composer require vikdiesel/admin-one-laravel-dashboard --dev`
- `composer require laravel/ui`
- `php artisan ui:controllers`
- `php artisan jb:admin-one-preset`
- `php artisan migrate`
- `composer dump-autoload` (otherwise db:seed doesn't work)
- `php artisan db:seed`
- `npm install`
- `npm run dev` or `npm run prod`

## Browser Support

We try to make sure Dashboard works well in latest versions of all major browsers

<img src="https://justboil.me/images/browsers-svg/chrome.svg" width="64" height="64" alt="Chrome"> <img src="https://justboil.me/images/browsers-svg/firefox.svg" width="64" height="64" alt="Firefox"> <img src="https://justboil.me/images/browsers-svg/edge.svg" width="64" height="64" alt="Edge"> <img src="https://justboil.me/images/browsers-svg/safari.svg" width="64" height="64" alt="Safari"> <img src="https://justboil.me/images/browsers-svg/opera.svg" width="64" height="64" alt="Opera">

## Reporting Issues

JustBoil's free items are limited to community support on GitHub.

The issue list is reserved exclusively for bug reports and feature requests. That means we do not accept usage questions. If you open an issue that does not conform to the requirements, it will be closed.

1. Make sure that you are using the latest version of the Dashboard. Issues for outdated versions are irrelevant
2. Provide steps to reproduce
3. Provide an expected behavior
4. Describe what is actually happening 
5. Platform, Browser & version as some issues may be browser specific

## Licensing

- Copyright &copy; 2019-2020 JustBoil.me (https://justboil.me)
- Licensed under MIT

## Package info

Built for Laravel 7.x.

In case of errors (or if you'd like to use Admin One with older Laravel versions), just manually merge package's `src/stubs` directory into your app's base directory and install npm dependencies listed in `src/AdminOnePreset.php`

## Useful Links

- [JustBoil.me](https://justboil.me)
- [Affiliate Program](https://justboil.me/info/affiliates)
- [Bulma](https://bulma.io)
- [Buefy](https://buefy.org)
- [Laravel](https://laravel.com)
