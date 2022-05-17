// require('./bootstrap')

import Vue from 'vue'
import Buefy from 'buefy'
import { createInertiaApp } from '@inertiajs/inertia-vue'
import { InertiaProgress } from '@inertiajs/progress'
import { Inertia } from '@inertiajs/inertia'
import store from './store'

Vue.prototype.$route = route

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    Vue.use(plugin)
    Vue.use(Buefy)

    new Vue({
      store,
      render: h => h(App, props),
    }).$mount(el)
  },
})

InertiaProgress.init({ color: '#4B5563' })

/* Collapse mobile aside menu on route change */
Inertia.on('navigate', (event) => {
  store.commit('asideMobileStateToggle', false)
  store.dispatch('asideDesktopOnlyToggle', false)
})
