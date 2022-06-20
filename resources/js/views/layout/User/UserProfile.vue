<template>

  <div class="container custom-container-crud mt-3">

      <div class="row">
        <div class="user-panel-title col-xl-12 d-flex justify-content-between align-items-center ps-3">
          <h1>Мой профиль</h1>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>
      </div>

      <div class="row">

        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">{{ user.name }}</h5>
              <p class="text-muted mb-1">Мастер по резке стекла</p>
              <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-success ms-1">Редактировать данные <i class="bi bi-pencil-square"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">ФИО</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ user.name }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email почта</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ user.email }}</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Телефон</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">+7(917) 234-56-78</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Номер отдела</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">Цех 3</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Адрес</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">ул. Пушкина д 3, кв 99</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
  </div>

</template>

<script>

export default {
  name: "UserProfile",

  data() {
    return {
    }
  },

  mounted() {
    this.$store.dispatch("users/getUserData", this.$route.params.id)
  },

  methods: {
  },

  computed: {
    user: {
      get() {
        return this.$store.state.users.currentUser
      }
    },
    loading: {
      get() {
        return this.$store.state.users.loading
      }
    }
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