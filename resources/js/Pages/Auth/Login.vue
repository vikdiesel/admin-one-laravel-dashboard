<template>
  <full-page>
    <Head title="Login" />
    <div v-if="status" class="notification is-danger">
      {{ status }}
    </div>
    <card-component
      title="Login"
      icon="lock"
    >
      <form
        method="POST"
        @submit.prevent="submit"
      >
        <b-field label="E-mail Address">
          <b-input
            v-model="form.email"
            name="email"
            type="email"
            required
          />
        </b-field>

        <b-field label="Password">
          <b-input
            v-model="form.password"
            type="password"
            name="password"
          />
        </b-field>

        <b-field>
          <b-checkbox
            v-model="form.remember"
            type="is-black"
            class="is-thin"
          >
            Remember me
          </b-checkbox>
        </b-field>

        <hr>

        <div class="level is-mobile">
          <div class="level-left">
            <div class="level-item">
              <b-button
                native-type="submit"
                type="is-black"
                :loading="form.processing"
              >
                Login
              </b-button>
            </div>
            <div v-if="canResetPassword" class="level-item">
              <Link
                :href="$route('password.request')"
                class="button is-text"
              >
                Forgot password?
              </Link>
            </div>
          </div>
          <div class="level-right">
            <div class="level-item">
              <Link
                :href="$route('register')"
                class="button is-text"
              >
                Register
              </Link>  
            </div>
          </div>
        </div>
      </form>
    </card-component>
  </full-page>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue'
import { defineComponent } from '@vue/composition-api'
import CardComponent from '@/components/CardComponent.vue'
import FullPage from '@/Layouts/FullPage.vue'

export default defineComponent({
  name: 'Login',
  components: { CardComponent, FullPage, Head, Link },
  props: {
    canResetPassword: Boolean,
    status: String
  },
  data () {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },
  methods: {
    submit () {
      this.form
        .transform(data => ({
          ...data,
          remember: this.form.remember ? 'on' : ''
        }))
        .post(this.$route('login'), {
          onFinish: () => this.form.reset('password')
        })
    }
  }
})
</script>
