# [Admin One — Free Laravel Dashboard (SPA)](https://justboil.me/bulma-admin-template/one)

![version](https://img.shields.io/badge/version-1.3.6-blue.svg)  ![license](https://img.shields.io/badge/license-MIT-blue.svg)

![Free Laravel Admin Dashboard](https://justboil.me/images/one/preview-free.jpg?v=1.2.0)

**Admin One** is simple, beautiful and free Laravel admin dashboard (built with Vue.js, Bulma & Buefy).

* Built for Laravel 7.x (Laravel 5.8 and Laravel 6.x are also fine)
* Fully-styled auth scaffolding
* Profile & avatar management with back-end
* Full Resource CRUD Sample (with front-end & back-end)
* Free under MIT License
* SPA — Single page app
* Built with Vue.js, Bulma & Buefy
* SCSS sources with variables
* More than 17 custom components
* [Premium version](https://justboil.me/bulma-admin-template/one) available

[JustBoil.me](https://justboil.me) is excited to share this dashboard with community.

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

* Description: https://justboil.me/bulma-admin-template/one
* **Free Laravel Dashboard** Demo: https://admin-one-laravel-free.justboil.me
* **Premium Dashboard** Demo: https://admin-one-laravel.justboil.me

## Quick Start

To install, please follow these steps. **Note:** We assume you start with a fresh Laravel project.

- `cd` to project directory
- `composer require vikdiesel/admin-one-laravel-dashboard --dev`
- `php artisan make:auth` (skip on Laravel 6.x & Laravel 7.x)
- `php artisan preset admin-one`
- `php artisan migrate`
- `php artisan db:seed` (if you get an error, run `php artisan make:seed DummySeeder` &mdash; this does unknown magic, you may delete DummySeeder class after creation)
- `npm install`
- `npm run dev` or `npm run prod`

## Browser Support

We try to make sure Dashboard works well in latest versions of all major browsers

![Chrome](https://justboil.me/images/browsers/chrome.png) ![Firefox](https://justboil.me/images/browsers/firefox.png) ![Microsoft Edge](https://justboil.me/images/browsers/edge.png) ![Opera](https://justboil.me/images/browsers/opera.png) ![Safari](https://justboil.me/images/browsers/safari.png)

## Reporting Issues

JustBoil's free items are limited to community support on GitHub.

The issue list is reserved exclusively for bug reports and feature requests. That means we do not accept usage questions. If you open an issue that does not conform to the requirements, it will be closed.

1. Make sure that you are using the latest version of the Dashboard. Issues for outdated versions are irrelevant
2. Provide steps to reproduce
3. Provide an expected behavior
4. Describe what is actually happening 
5. Platfrom, Browser & version as some issues may be browser specific

## Licensing

- Copyright &copy; 2019-2020 JustBoil.me (https://justboil.me)
- Licensed under MIT

## Package info

Built for Laravel 7.x (Laravel 5.8 and Laravel 6.x are also fine).

In case of errors, just manually merge package's `src/stubs` directory into your app's base directory and install npm dependencies listed in `src/AdminOnePreset.php`

## Useful Links

- [JustBoil.me](https://justboil.me)
- [Affiliate Program](https://justboil.me/info/affiliates)
- [Bulma](https://bulma.io)
- [Buefy](https://buefy.org)
- [Laravel](https://laravel.com)
