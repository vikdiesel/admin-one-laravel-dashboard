<template>
  <div class="is-user-avatar">
    <img :src="newUserAvatar" :alt="userName">
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  name: 'UserAvatar',
  props: {
    avatar: {
      type: String,
      default: null
    }
  },
  computed: {
    newUserAvatar () {
      if (this.avatar) {
        return this.avatar
      }

      if (this.userAvatar) {
        return this.userAvatar
      }
    },
    ...mapState([
      'userAvatar',
      'userName'
    ])
  }
}
</script>
