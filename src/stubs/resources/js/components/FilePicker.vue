<template>
  <b-field :label="label" :message="fieldFileMessage" :type="fieldFileType">
    <b-field>
      <b-upload v-model="file" @input="upload">
        <a class="button is-primary">
          <b-icon :icon="uploadButtonIcon" custom-size="default"/>
          <span v-if="uploadButtonText">{{ uploadButtonText }}</span>
        </a>
      </b-upload>
      <div v-if="fileName" class="control">
        <a class="button is-static is-file-upload-label">
          <span :title="fileName">{{ fileName }}</span>
          <span class="delete" @click.prevent="dropFile"></span>
        </a>
      </div>
    </b-field>
  </b-field>
</template>

<script>
import each from 'lodash/each'

export default {
  name: 'FilePicker',
  props: {
    label: {
      type: String,
      default: null,
    },
    message: {
      type: String,
      default: null,
    },
    currentFile: {
      default: null
    }
  },
  data () {
    return {
      errors: {},
      file: null,
      uploadPercent: 0,
      isUploadSuccess: false,
    }
  },
  computed: {
    fieldFileMessage() {
      if (this.errors.file) {
        return this.errors.file[0]
      }

      if (this.isUploadSuccess) {
        return 'File uploaded. Submit to store'
      }

      if (this.uploadPercent) {
        return `Uploading ${this.uploadPercent}%`
      }

      return this.message
    },
    uploadButtonText() {
      return (this.fileName) ? null : 'Pick a file'
    },
    uploadButtonIcon() {
      return (this.fileName) ? 'cloud-sync' : 'cloud-upload'
    },
    fieldFileType() {
      return (this.errors.file) ? 'is-danger' : null
    },
    fileName () {
      if (this.file) {
        return this.file.name
      }

      if (this.currentFile) {
        return this.currentFile
      }

      return null
    }
  },
  methods: {
    upload (file) {
      this.errors = {}
      let formData = new FormData()
      formData.append('file', this.file)
      this.isUploadSuccess = false

      axios
        .post('/files/store', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          },
          onUploadProgress: this.progressEvent
        })
        .then(r => {
          this.isUploadSuccess = true

          // Display success data & then drop it after a little while
          // setTimeout(() => {
          //   this.file = null
          //   this.isUploadSuccess = false
          //   this.uploadPercent = 0
          // }, 1500)

          this.$emit('file-updated', r.data.data)
          this.$emit('file-id-updated', r.data.data.id)
        })
        .catch(err => {
          this.file = null
          this.uploadPercent = 0

          if (err.response.data.errors) {
            this.errors = err.response.data.errors
          } else {
            this.errors = {
              _all: ['Upload error']
            }
          }
          each(this.errors, err => {
            this.$buefy.toast.open({
              message: err[0],
              type: 'is-danger',
              queue: false,
            })
          })
        })
    },
    dropFile () {
      this.file = null
      this.isUploadSuccess = false
      this.uploadPercent = 0

      this.$emit('file-updated', null)
      this.$emit('file-id-updated', null)
    },
    progressEvent (progressEvent) {
      this.uploadPercent = Math.round((progressEvent.loaded * 100) / progressEvent.total)
    }
  }
}
</script>
