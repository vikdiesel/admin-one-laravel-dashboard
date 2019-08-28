<template>
  <div>
    <title-bar :title-stack="titleStack"/>
    <hero-bar>
      {{ heroTitle }}
      <router-link slot="right" to="/clients/index" class="button">
        Clients
      </router-link>
    </hero-bar>
    <section class="section is-main-section">
      <tiles>
        <card-component :title="formCardTitle" icon="account-edit" class="tile is-child">
          <form @submit.prevent="submit">
            <template v-if="id">
              <b-field label="ID" horizontal>
                <b-input :value="id" custom-class="is-static" readonly />
              </b-field>
              <hr>
            </template>
            <b-field label="Avatar" horizontal>
              <file-picker @file-id-updated="fileIdUpdated" :current-file="form.avatar_filename"/>
            </b-field>
            <hr>
            <b-field label="Name" message="Client name" horizontal>
              <b-input placeholder="e.g. John Doe" v-model="form.name" required />
            </b-field>
            <b-field label="Company" message="Client's company name" horizontal>
              <b-input placeholder="e.g. Berton & Steinway" v-model="form.company" required />
            </b-field>
            <b-field label="City" message="Client's city" horizontal>
              <b-input placeholder="e.g. Geoffreyton" v-model="form.city" required />
            </b-field>
            <b-field label="Created" horizontal>
              <b-datepicker
                @input="input"
                v-model="form.created_date"
                placeholder="Click to select..."
                icon="calendar-today">
              </b-datepicker>
            </b-field>
            <hr>
            <b-field label="Progress" horizontal>
              <b-slider v-model="form.progress"/>
            </b-field>
            <hr>
            <b-field horizontal>
              <b-button type="is-primary" :loading="isLoading" native-type="submit">Submit</b-button>
            </b-field>
          </form>
        </card-component>
        <card-component v-if="isProfileExists" title="Client Profile" icon="account" class="tile is-child">
          <user-avatar :avatar="item.avatar" :is-current-user="false" class="image has-max-width is-aligned-center"/>
          <hr>
          <b-field label="Name">
            <b-input :value="item.name" custom-class="is-static" readonly/>
          </b-field>
          <b-field label="Company">
            <b-input :value="item.company" custom-class="is-static" readonly/>
          </b-field>
          <b-field label="City">
            <b-input :value="item.city" custom-class="is-static" readonly/>
          </b-field>
          <b-field label="Created">
            <b-input :value="item.created" custom-class="is-static" readonly/>
          </b-field>
          <hr>
          <b-field label="Progress">
            <progress class="progress is-small is-primary" :value="item.progress" max="100">{{ item.progress }}</progress>
          </b-field>
        </card-component>
      </tiles>
    </section>
  </div>
</template>

<script>
import clone from 'lodash/clone'
import TitleBar from '@/components/TitleBar'
import HeroBar from '@/components/HeroBar'
import Tiles from '@/components/Tiles'
import CardComponent from '@/components/CardComponent'
import FilePicker from '@/components/FilePicker'
import UserAvatar from '@/components/UserAvatar'
import Notification from '@/components/Notification'

export default {
  name: 'ClientForm',
  components: { UserAvatar, FilePicker, CardComponent, Tiles, HeroBar, TitleBar, Notification },
  props: {
    id: {
      default: null
    }
  },
  data () {
    return {
      isLoading: false,
      item: null,
      form: this.getClearFormObject(),
      createdReadable: null,
    }
  },
  computed: {
    titleStack () {
      let lastCrumb

      if (this.isProfileExists) {
        lastCrumb = this.form.name
      } else {
        lastCrumb = 'New client'
      }

      return [
        'Admin',
        'Clients',
        lastCrumb
      ]
    },
    heroTitle () {
      if (this.isProfileExists) {
        return this.form.name
      } else {
        return 'Create Client'
      }
    },
    formCardTitle () {
      if (this.isProfileExists) {
        return 'Edit Client'
      } else {
        return 'New Client'
      }
    },
    isProfileExists () {
      return !!this.item
    }
  },
  created () {
    this.getData()
  },
  methods: {
    getClearFormObject () {
      return {
        id: null,
        name: null,
        company: null,
        city: null,
        created_date: new Date(),
        created_mm_dd_yyyy: null,
        progress: 0,
        avatar: null,
        avatar_filename: null,
        file_id: null
      }
    },
    getData () {
      if (this.id) {
        axios
          .get(`/clients/${this.id}`)
          .then(r => {
            this.form = r.data.data
            this.item = clone(r.data.data)

            this.form.created_date = new Date(r.data.data.created_mm_dd_yyyy)
          })
          .catch(e => {
            this.item = null

            this.$buefy.toast.open({
              message: `Error: ${e.message}`,
              type: 'is-danger',
              queue: false
            })
          })
      }
    },
    fileIdUpdated (fileId) {
      this.form.file_id = fileId
      this.form.avatar_filename = null
    },
    input (v) {
      //this.createdReadable = moment(v).format('MMM D, Y').toString()
    },
    submit () {
      this.isLoading = true
      let method = 'post'
      let url = '/clients/store'

      if (this.id) {
        method = 'patch'
        url = `/clients/${this.id}`
      }

      axios({
        method,
        url,
        data: this.form
      }).then(r => {
        this.isLoading = false

        if (!this.id && r.data.data.id) {
          this.$router.push({name: 'clients.edit', params: {id: r.data.data.id}})

          this.$buefy.snackbar.open({
            message: 'Created',
            queue: false
          })
        } else {
          this.item = r.data.data

          this.$buefy.snackbar.open({
            message: 'Updated',
            queue: false
          })
        }
      }).catch(e => {
        this.isLoading = false

        this.$buefy.toast.open({
          message: `Error: ${e.message}`,
          type: 'is-danger',
          queue: false
        })
      })
    }
  },
  watch: {
    id (newValue) {
      this.form = this.getClearFormObject()
      this.item = null

      if (newValue) {
        this.getData()
      }
    }
  }
}
</script>
