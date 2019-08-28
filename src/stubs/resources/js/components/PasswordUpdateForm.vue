<template>
  <card-component title="Change Password" icon="lock">
    <form @submit.prevent="submit">
      <b-field horizontal label="Current password" :message="formPasswordCurrentMessage" :type="formPasswordCurrentType">
        <b-input name="password_current" type="password" v-model="form.password_current" required autcomplete="current-password"/>
      </b-field>
      <hr>
      <b-field horizontal label="New password" :message="formPasswordMessage" :type="formPasswordType">
        <b-input name="password" type="password" v-model="form.password" required autocomplete="new-password"/>
      </b-field>
      <b-field horizontal label="New password (confirm)" message="Required. New password one more time">
        <b-input name="password_confirmation" type="password" v-model="form.password_confirmation" required autocomplete="new-password"/>
      </b-field>
      <hr>
      <b-field horizontal>
        <div class="control">
          <button type="submit" class="button is-primary" :class="{'is-loading':isLoading}">
            Submit
          </button>
        </div>
      </b-field>
    </form>
  </card-component>
</template>

<script>
import each from 'lodash/each'
import CardComponent from '@/components/CardComponent'

export default {
  name: 'PasswordUpdateForm',
  components: {
    CardComponent
  },
  data () {
    return {
      isLoading: false,
      errors: {},
      form: {
        password_current: null,
        password: null,
        password_confirmation: null
      }
    }
  },
  computed: {
    formPasswordCurrentType () {
      return this.errors.password_current?'is-danger':null
    },
    formPasswordCurrentMessage () {
      return this.errors.password_current ? this.errors.password_current[0] : 'Required. Your current password'
    },
    formPasswordType () {
      return this.errors.password ? 'is-danger' : null
    },
    formPasswordMessage () {
      return this.errors.password?this.errors.password[0] : 'Required. New password'
    },
  },
  methods: {
    submit () {
      this.isLoading = true
      this.errors = {}
      axios
        .patch('/user/password', this.form)
        .then(r => {
          this.isLoading = false
          this.form.password_current = null
          this.form.password = null
          this.form.password_confirmation = null

          this.$buefy.snackbar.open({
            message: 'Password updated',
            duration: 1000,
            queue: false
          })
        })
        .catch(err => {
          this.isLoading = false

          if (err.response.data.errors) {
            this.errors = err.response.data.errors
          } else {
            this.errors = {
              _all: ['An error occurred']
            }
          }

          each(this.errors, err => {
            this.$buefy.toast.open({
              message: err[0],
              type: 'is-danger',
              queue: false,
              duration: 3000
            })
          })
        })
    }
  }
}
</script>
