<template>
  <full-page>
    <Head title="Register" />
    <card-component
      title="Register"
      icon="account"
    >
      <form
        method="POST"
        @submit.prevent="submit"
      >
        <b-field label="Name">
          <b-input
            v-model="form.name"
            name="name"
            required
            autocomplete="name"
          />
        </b-field>

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
            required
            autocomplete="new-password"
          />
        </b-field>

        <b-field label="Confirm Password">
          <b-input
            v-model="form.password_confirmation"
            type="password"
            name="password_confirmation"
            required
            autocomplete="new-password"
          />
        </b-field>

        <b-field v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
          <b-checkbox
            v-model="form.terms"
            type="is-black"
            class="is-thin"
          >
            I agree to the <a target="_blank" :href="route('terms.show')">Terms of Service</a> and <a target="_blank" :href="route('policy.show')">Privacy Policy</a>
          </b-checkbox>
        </b-field>

        <hr>

        <b-field grouped>
          <div class="control">
            <b-button
              native-type="submit"
              type="is-black"
              :loading="form.processing"
            >
              Register
            </b-button>
          </div>
          <div class="control">
            <Link
              :href="$route('login')"
              class="button is-text"
            >
              Already registered?
            </Link>
          </div>
        </b-field>
      </form>
    </card-component>
  </full-page>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue';
import { defineComponent } from '@vue/composition-api'
import CardComponent from '@/components/CardComponent.vue'
import FullPage from '@/Layouts/FullPage.vue'

export default defineComponent({
  name: 'Login',
  components: { CardComponent, FullPage, Head, Link },
  data () {
    return {
      form: this.$inertia.form({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        terms: false,
      })
    }
  },
  methods: {
    submit () {
      this.form.post(this.$route('register'), {
        onFinish: () => this.form.reset('password', 'password_confirmation'),
      })
    }
  }
})
</script>
