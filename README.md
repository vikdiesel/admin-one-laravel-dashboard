# Free Laravel 9.x Vue.js 2.x Buefy Bulma Dashboard

<table>
  <tr>
    <td align="center"><a href="https://vikdiesel.github.io/admin-one-vue-bulma-dashboard/" target="_blank" title="Bulma Vue.js 2.x Buefy free admin dashboard"><img src="https://static.justboil.me/templates/one/repo-bulma-vue.png" /></a></td>
    <td align="center"><a href="https://vikdiesel.github.io/admin-two-vue-bulma-dashboard/" target="_blank" title="Free Bulma Vue 2.x Buefy admin template"><img src="https://static.justboil.me/templates/two/repo-bulma-vue.png" /></a></td>
  </tr>
</table>

This guide will help you integrate your **Laravel Jetstream** application with either [vikdiesel/admin-one-vue-bulma-dashboard](https://github.com/vikdiesel/admin-one-vue-bulma-dashboard) or [vikdiesel/admin-two-vue-bulma-dashboard](https://github.com/vikdiesel/admin-two-vue-bulma-dashboard) Vue Bulma Buefy dashboard.

**Please note:** this document is work in progress, so [some things are missing](#work-in-progress).

Simple, beautiful and free **Vue.js 2.x** **Bulma** **Buefy** admin dashboard for **Laravel 9.x Jetstream Inertia + Vue** stack

* Built with **Vue.js 2.x** **Bulma** and **Buefy**
* **Laravel 9.x Jetstream Inertia + Vue** stack
* Laravel Mix
* Classic **Options API** using `data`, `computed`, `methods`, etc.
* SPA with **Vuex** & **Inertia Router**
* **Styled** scrollbars
* **SCSS sources** with variables
* Reusable components
* Responsive
* Free under MIT License
* [Premium versions](https://justboil.me/bulma-admin-template/) available

## Table of contents

* [Install](#install)
* [Copy styles, components and scripts](#copy-styles-components-and-scripts)
* [Add pages](#add-pages)
* [Fix router links](#fix-router-links)
* [Add Inertia-related stuff](#add-inertia-related-stuff)
* [Work in progress](#work-in-progress)
* [Laravel 7.x & 8.x](#laravel-7x--8x)

## Install

* [Install Laravel](https://laravel.com/docs/installation) application
* [Install Jetstream](https://jetstream.laravel.com/2.x/installation.html) with Inertia + Vue stack
* `cd` to project dir 
* Move `resources/js` folder to `resources-temp/js`. These js files will serve as a reference during development process (just in case, you'll ever need to extract some logic, that is missing here)
* run `npm remove @inertiajs/inertia-vue3 @vue/compiler-sfc @tailwindcss/forms @tailwindcss/typography postcss postcss-import tailwindcss`
* run `npm i vuex@^3 vue@^2 vue-loader@^15 @vue/composition-api @inertiajs/inertia-vue bulma buefy chart.js vue-chartjs numeral sass sass-loader -D`

Replace `postCss()` with `sass()` and `app.scss` with `main.scss` in `webpack.mix.js`:

```javascript
mix.js('resources/js/app.js', 'public/js').vue()
  .sass('resources/scss/main.scss', 'public/css')
  .alias({
    '@': 'resources/js',
  })
```

## Copy styles, components and scripts

Clone either [vikdiesel/admin-one-vue-bulma-dashboard](https://github.com/vikdiesel/admin-one-vue-bulma-dashboard) or [vikdiesel/admin-two-vue-bulma-dashboard](https://github.com/vikdiesel/admin-two-vue-bulma-dashboard) project locally into a separate folder

Next, copy these files **from cloned dashboard project** directory **to laravel project** directory:

* Copy `src/components` `src/store` `src/menu.js` to `resources/js/`
* Copy `src/App.vue` and `src/FullPage.vue` to `resources/Layouts/`
* Copy `src/css` and `src/scss` to `resources/`
* Copy `src/assets/justboil-logo.svg` to `resources/js/images/`
* Delete `resources/css/app.css`
* Copy `resources` directory **from this repository** to **to laravel project**

##### In resources/views/app.blade.php

Replace `app.css` with `main.css`:

```php
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/main.css') }}">
```

Add before `</body>`:

```html
<link href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
```

##### In resources/layouts/App.vue & FullPage.vue

Replace `<router-view />` with `<slot />`

##### In resources/layouts/App.vue

Add `this.$store.dispatch('toggleFullPage', false)` to `created()` lifecycle hook

##### In resources/layouts/FullPage.vue

Add `this.$store.dispatch('toggleFullPage', true)` to `created()` lifecycle hook

Remove `beforeDestroy()` lifecycle hook

##### In resources/layouts/Tiles.vue

Add `import filter from 'lodash/filter'`

Add `filter()` and replace `this.$slots.default` with `slots` in `render()` method, so you'll get:

```javascript
render (createElement) {
    const renderAncestor = elements => createElement(
      // ...
    )

    const slots = filter(this.$slots.default, slot => !!slot.tag)

    if (slots.length <= this.maxPerRow) {
      return renderAncestor(slots)
    } else {
      return createElement(
        'div',
        { attrs: { class: 'is-tiles-wrapper' } },
        chunk(slots, this.maxPerRow).map(group => {
          return renderAncestor(group)
        })
      )
    }
  }
```

## Add Pages

Let's just add first page. You can repeat these steps for other pages, if you wish to. If you've followed previous steps, there's already `resources/js/Pages/HomeExample.vue` for your reference.

First, copy `src/views/Home.vue` (original dashboard project) to `resources/js/Pages/` (your Laravel project).

Add `Head`. Then, wrap page contents into `App` Layout component:

```vue
<template>
<app>
  <Head title="Dashboard" />
  <title-bar :title-stack="titleStack" />
  <!-- ... -->
</app>
</template>
<script>
import { Head } from '@inertiajs/inertia-vue'
import App from '@/Layouts/App.vue'
// ...

export default defineComponent({
  name: 'Home',
  components: {
    Head,
    App,
    // ...
  }
  // ...
})
</script>
```

Add route in `routes/web.php`. There's a `/dashboard` route already defined by default, so just replace `Inertia::render('Dashboard')` with `Inertia::render('Home')`:

```php
Route::get('/dashboard', function () {
  return Inertia::render('Home');
})->name('dashboard');
```

## Fix router links

Here we replace router-link with Inertia Link.

##### resources/js/menu.js

Optionally, you can pass menu via Inertia shared props, so it's going to be controlled with PHP. Here we'd just use JS.

`to` should be replaced with `route` which specifies route name defined in `routes/web.php`. For external links `href` should be used instead. Here's an example for `menu.js`:

```javascript
export default [
  'General',
  [
    {
      route: 'dashboard',
      icon: mdiDesktopMac,
      label: 'Dashboard'
    },
    {
      href: 'https://example.com/',
      icon: mdiDesktopMac,
      label: 'Example.com'
    }
  ]
]
```

Route names reflect ones defined in `routes/web.php`:

```php
Route::get('/dashboard', function () {
  return Inertia::render('Home');
})->name('dashboard');
```

Now, let's update vue files, to make them work with route names and Inertia links.

##### resources/js/components/AsideMenuItem.vue

Add `Link` import to `<script>`:

```vue
<script>
import { Link } from '@inertiajs/inertia-vue'
// ...
</script>
```

##### resources/js/components/AsideMenuItem.vue

Replace `componentIs` in `computed{}` with:

```vue
<script>
export default defineComponent({
  // ...
  computed: {
    componentIs () {
      return this.item.route ? Link : 'a'
    }
    // ...
  }
  // ...
})
</script>
```

Replace `<component>` attrs with:

```vue
<template>
<component
  :is="componentIs"
  :href="item.route ? $route(item.route) : item.href"
  :target="item.target"
  :class="{ 'has-icon': !!item.icon, 'has-dropdown-icon': hasDropdown, 'is-active': item.route && $route().current(item.route) }"
  @click="menuClick"
>
  <!-- ... -->
</component>
</template>
```

##### .vue files in resources/js/ containing <router-link>

Import and register `Link` component:

```vue
<script>
import { Link } from '@inertiajs/inertia-vue'
// ...

export default defineComponent({
  components: {
    Link
    // ...
  }
  // ...
})
</script>
```

Replace `<router-link>` with `<Link>`:

```vue
<template>
<Link
  :href="$route('dashboard')"
  class="navbar-item"
  :class="{ 'is-active': $route().current('dashboard') }"
>
  <!-- ... -->
</Link>
</template>
```

##### resources/js/components/NavBar.vue

Replace `this.$router` with `Inertia`:

```vue
<script>
import { Inertia } from '@inertiajs/inertia'
// ...

export default defineComponent({
  // ...
  mounted () {
    Inertia.on('navigate', (event) => {
      this.isMenuActive = false
    })
  }
  // ...
})
</script>
```

## Add Inertia-related stuff

##### resources/js/components/UserAvatar.vue

Fix `newAvatar` computed property, so it fetches profile photo from backend:

```vue
<script>
export default defineComponent({
  // ...
  computed: {
    newAvatar () {
      return this.avatar ? this.avatar : this.$page.props.user.profile_photo_url
    }
  }
})
</script>
```

##### resources/js/components/NavBar.vue

Update `userName` and `logout`:

```vue
<script>
export default defineComponent({
  // ...
  computed: {
    // ...
    userName () {
      return this.$page.props.user.name
    },
    ...mapState([
      'isAsideMobileExpanded',
      'isNavBarVisible',
      // remove 'userName'
    ])
  },
  methods: {
    // ...
    logout () {
      Inertia.post(route('logout'))
    }
  }
  // ...
})
</script>
```

## Work in progress

As mentioned, this guide is WIP - work in progress. Contributions open. Here's the list of what's missing right now:

* Pages for resources/Pages/API
* Pages for resources/Pages/Auth (except Login.vue and Register.vue)
* Pages for resources/Pages/Profile
* Unused default Jetstream files list

## Laravel 7.x & 8.x

If you're using an older version of Laravel, please follow [Laravel 7.x & 8.x guide](https://github.com/vikdiesel/admin-one-laravel-dashboard/tree/master/.laravel-7x-8x).
