<template>
  <div>
    <modal-trash-box :is-active="isModalActive" :trash-subject="trashObjectName" @confirm="trashConfirm" @cancel="trashCancel"/>
    <b-table
      :checked-rows.sync="checkedRows"
      :checkable="checkable"
      :loading="isLoading"
      :paginated="paginated"
      :per-page="perPage"
      :striped="true"
      :hoverable="true"
      default-sort="name"
      :data="clients">

      <template slot-scope="props">
        <b-table-column class="has-no-head-mobile is-image-cell">
          <div v-if="props.row.avatar" class="image">
            <img :src="props.row.avatar" class="is-rounded">
          </div>
        </b-table-column>
        <b-table-column label="Name" field="name" sortable>
          {{ props.row.name }}
        </b-table-column>
        <b-table-column label="Company" field="company" sortable>
          {{ props.row.company }}
        </b-table-column>
        <b-table-column label="City" field="city" sortable>
          {{ props.row.city }}
        </b-table-column>
        <b-table-column class="is-progress-col" label="Progress" field="progress" sortable>
          <progress class="progress is-small is-primary" :value="props.row.progress" max="100">{{ props.row.progress }}</progress>
        </b-table-column>
        <b-table-column label="Created">
          <small class="has-text-grey is-abbr-like" :title="props.row.created">{{ props.row.created }}</small>
        </b-table-column>
        <b-table-column custom-key="actions" class="is-actions-cell">
          <div class="buttons is-right">
            <router-link :to="{name:'clients.edit', params: {id: props.row.id}}" class="button is-small is-primary">
              <b-icon icon="account-edit" size="is-small"/>
            </router-link>
            <button class="button is-small is-danger" type="button" @click.prevent="trashModal(props.row)">
              <b-icon icon="trash-can" size="is-small"/>
            </button>
          </div>
        </b-table-column>
      </template>

      <section class="section" slot="empty">
        <div class="content has-text-grey has-text-centered">
          <template v-if="isLoading">
            <p>
              <b-icon icon="dots-horizontal" size="is-large"/>
            </p>
            <p>Fetching data...</p>
          </template>
          <template v-else>
            <p>
              <b-icon icon="emoticon-sad" size="is-large"/>
            </p>
            <p>Nothing's here&hellip;</p>
          </template>
        </div>
      </section>
    </b-table>
  </div>
</template>

<script>
import ModalTrashBox from '@/components/ModalTrashBox'

export default {
  name: 'ClientsTableSample',
  components: { ModalTrashBox },
  props: {
    dataUrl: {
      type: String,
      default: null
    },
    checkable: {
      type: Boolean,
      default: false
    }
  },
  data () {
    return {
      isModalActive: false,
      trashObject: null,
      clients: [],
      isLoading: false,
      paginated: false,
      perPage: 10,
      checkedRows: []
    }
  },
  computed: {
    trashObjectName () {
      if (this.trashObject) {
        return this.trashObject.name
      }

      return null
    }
  },
  created () {
    this.getData()
  },
  methods: {
    getData () {
      if (this.dataUrl) {
        this.isLoading = true
        axios
          .get(this.dataUrl)
          .then(r => {
            this.isLoading = false
            if (r.data && r.data.data) {
              if (r.data.data.length > this.perPage) {
                this.paginated = true
              }
              this.clients = r.data.data
            }
          })
          .catch( err => {
            this.isLoading = false
            this.$buefy.toast.open({
              message: `Error: ${e.message}`,
              type: 'is-danger',
              queue: false
            })
          })
      }
    },
    trashModal (trashObject) {
      this.trashObject = trashObject
      this.isModalActive = true
    },
    trashConfirm () {
      this.isModalActive = false

      axios
        .delete(`/clients/${this.trashObject.id}/destroy`)
        .then( r => {
          this.getData()

          this.$buefy.snackbar.open({
            message: `Deleted ${this.trashObject.name}`,
            queue: false
          })
        })
        .catch( err => {
          this.$buefy.toast.open({
            message: `Error: ${err.message}`,
            type: 'is-danger',
            queue: false
          })
        })
    },
    trashCancel () {
      this.isModalActive = false
    }
  }
}
</script>
