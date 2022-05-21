<template>

  <div class="container">
    <div class="row pt-3">
      
      <div class="dashboard-panel__title col-xl-12 pt-2">
        <h1>Мой профиль</h1>
      </div>

      <h2>Моя почта:</h2>

    </div>
  </div>

</template>

<script>
import axios from "../../../../axios/axios-instance";

export default {
  name: "UserProfile",

  data() {
    return {
    }
  },

  mounted() {
    // this.$store.dispatch("users/getUserData")
  },

  methods: {
  },

  computed: {
    getUserData: {
      get() {
        return this.$store.state.users.currentUser
      }
    },
  }
}
</script>



<style scoped lang="scss">

.card_course-picture {
  padding: 10px;
  max-height: 300px;
  object-fit: contain;
}

.card_course-text {
    height: 100px;
    text-indent: 5%;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>