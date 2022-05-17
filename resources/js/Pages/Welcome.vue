<script>
import { Link } from '@inertiajs/inertia-vue'
import { defineComponent } from '@vue/composition-api'

export default defineComponent({
  name: 'Login',
  components: { Link },
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String
  },
  data () {
    return {
      isMenuActive: false
    }
  },
  created () {
    this.$store.dispatch('toggleFullPage', true)
  }
})
</script>

<template>
  <nav class="navbar">
    <div class="navbar-brand">
      <a
        role="button"
        class="navbar-burger"
        :class="{ 'is-active': isMenuActive }"
        aria-label="menu"
        aria-expanded="false"
        @click.prevent="isMenuActive = !isMenuActive"
      >
        <span aria-hidden="true" />
        <span aria-hidden="true" />
        <span aria-hidden="true" />
      </a>
    </div>
    <div
      class="navbar-menu fadeIn animated faster"
      :class="{ 'is-active': isMenuActive }"
    >
      <div
        v-if="canLogin"
        class="navbar-end"
      >
        <Link
          v-if="$page.props.user"
          :href="$route('dashboard')"
          class="navbar-item"
        >
          Dashboard
        </Link>
        <template v-else>
          <Link
            :href="$route('login')"
            class="navbar-item"
          >
            Log in
          </Link>
          <Link
            v-if="canRegister"
            :href="$route('register')"
            class="navbar-item"
          >
            Register
          </Link>
        </template>
      </div>
    </div>
  </nav>
</template>
